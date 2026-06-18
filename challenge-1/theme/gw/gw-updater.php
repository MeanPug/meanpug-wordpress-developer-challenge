<?php
/**
 * GlitchWood Core Updater
 *
 * Módulo para actualizar /gw/gw-core/ desde un servidor central.
 */

namespace GlitchWood\GWCoreUpdater;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * URL del manifest remoto.
 * Debe devolver un JSON con al menos:
 * {
 *   "version": "1.2.0",
 *   "zip_url": "https://glitchwood.com/gw-core/gw-core-1.2.0.zip",
 *   "checksum": "sha256:xxxxxxxx"
 * }
 */
define(
    'GWCORE_REMOTE_MANIFEST_URL',
    'https://raw.githubusercontent.com/LuigiLibet/gw-core/main/manifest.json'
);

/**
 * Devuelve el manifest remoto como array asociativo.
 */
function gwcore_get_remote_manifest() {
    $response = wp_remote_get( GWCORE_REMOTE_MANIFEST_URL, [
        'timeout' => 20,
    ] );

    if ( is_wp_error( $response ) ) {
        $error_msg = $response->get_error_message();
        gwcore_log( 'Error al obtener manifest remoto: ' . ( $error_msg ?? 'Error desconocido' ) );
        return false;
    }

    $code = wp_remote_retrieve_response_code( $response );
    if ( $code !== 200 ) {
        gwcore_log( 'Manifest remoto respondió con código HTTP ' . $code );
        return false;
    }

    $body = wp_remote_retrieve_body( $response );
    $data = json_decode( $body, true );

    if ( ! is_array( $data ) || empty( $data['version'] ) || empty( $data['zip_url'] ) ) {
        gwcore_log( 'Manifest remoto inválido o incompleto.' );
        return false;
    }

    return $data;
}

/**
 * Determina si hay una actualización disponible comparando con GW_CORE_VERSION.
 */
function gwcore_is_update_available() {
    if ( ! defined( 'GW_CORE_VERSION' ) ) {
        // Si no hay versión local, asumimos que hay "algo" por instalar.
        return true;
    }

    $manifest = gwcore_get_remote_manifest();
    if ( ! $manifest ) {
        return false;
    }

    return version_compare( $manifest['version'], GW_CORE_VERSION, '>' );
}

/**
 * Acción principal de actualización.
 * - Descarga el zip
 * - Verifica checksum (si existe)
 * - Hace backup de /gw/gw-core/
 * - Reemplaza por contenido nuevo
 * - Actualiza gw-core-version.php
 */
function gwcore_run_update() {
    global $wp_filesystem;
    
    if ( ! current_user_can( 'manage_options' ) ) {
        return new \WP_Error( 'gwcore_permissions', 'No tienes permisos para actualizar GlitchWood Core.' );
    }

    // Ensure filesystem is initialized
    if ( empty( $wp_filesystem ) ) {
        require_once ABSPATH . '/wp-admin/includes/file.php';
        WP_Filesystem();
    }

    $manifest = gwcore_get_remote_manifest();
    if ( ! $manifest ) {
        return new \WP_Error( 'gwcore_manifest', 'No se pudo obtener el manifest remoto.' );
    }

    $zip_url  = isset( $manifest['zip_url'] ) ? $manifest['zip_url'] : null;
    $version  = isset( $manifest['version'] ) ? $manifest['version'] : null;
    $checksum = isset( $manifest['checksum'] ) ? $manifest['checksum'] : null;

    // Validar que zip_url no sea null antes de descargar
    if ( empty( $zip_url ) || ! is_string( $zip_url ) ) {
        return new \WP_Error( 'gwcore_invalid_url', 'La URL del ZIP no es válida.' );
    }

    // Descargar zip a archivo temporal
    $tmp_file = download_url( $zip_url );

    if ( is_wp_error( $tmp_file ) ) {
        $error_msg = $tmp_file->get_error_message();
        gwcore_log( 'Error descargando zip: ' . ( $error_msg ?? 'Error desconocido' ) );
        return $tmp_file;
    }
    
    // Ensure tmp_file is never null before using it
    // download_url() might return null in some edge cases, and WordPress functions don't handle null well
    if ( is_null( $tmp_file ) || ! is_string( $tmp_file ) || empty( $tmp_file ) ) {
        return new \WP_Error( 'gwcore_invalid_tmp_file', 'El archivo temporal descargado no es válido.' );
    }

    // Verificación opcional del checksum
    if ( $checksum && strpos( $checksum, 'sha256:' ) === 0 ) {
        $expected = substr( $checksum, strlen( 'sha256:' ) );
        $actual   = hash_file( 'sha256', $tmp_file );

        if ( ! hash_equals( $expected, $actual ) ) {
            $wp_filesystem->delete( $tmp_file );
            gwcore_log( 'Checksum SHA256 no coincide. Abortando actualización.' );
            return new \WP_Error( 'gwcore_checksum', 'El archivo descargado no pasó la verificación de integridad.' );
        }
    }

    $theme_dir  = get_stylesheet_directory();
    
    // Ensure theme_dir is a valid string
    $theme_dir = is_string( $theme_dir ) && ! empty( $theme_dir ) ? $theme_dir : get_stylesheet_directory();
    if ( ! is_string( $theme_dir ) || empty( $theme_dir ) ) {
        return new \WP_Error( 'gwcore_invalid_theme_dir', 'No se pudo determinar el directorio del tema.' );
    }
    
    // Ensure theme_dir is never null before passing to trailingslashit
    // trailingslashit() calls untrailingslashit() which uses rtrim(), and rtrim() doesn't accept null in PHP 8.1+
    $theme_dir_safe = is_null( $theme_dir ) || ! is_string( $theme_dir ) ? (string) get_stylesheet_directory() : (string) $theme_dir;
    $gw_dir = trailingslashit( $theme_dir_safe ) . 'gw';
    
    // Ensure gw_dir is a valid string before using trailingslashit again
    if ( ! is_string( $gw_dir ) || empty( $gw_dir ) || is_null( $gw_dir ) ) {
        return new \WP_Error( 'gwcore_invalid_gw_dir', 'No se pudo construir el directorio gw.' );
    }
    
    // Ensure gw_dir is never null before passing to trailingslashit
    $gw_dir_safe = (string) $gw_dir;
    $target_dir = trailingslashit( $gw_dir_safe ) . 'gw-core';

    // Carpeta temporal para descomprimir
    $temp_dir = trailingslashit( $gw_dir_safe ) . 'gw-core-temp';

    if ( $wp_filesystem->is_dir( $temp_dir ) ) {
        $wp_filesystem->rmdir( $temp_dir, true );
    }

    $wp_filesystem->mkdir( $temp_dir, FS_CHMOD_DIR );

    // Validar que tmp_file y temp_dir no sean null antes de descomprimir
    if ( empty( $tmp_file ) || ! is_string( $tmp_file ) ) {
        gwcore_log( 'Error: tmp_file es inválido antes de descomprimir.' );
        return new \WP_Error( 'gwcore_invalid_tmp_file', 'El archivo temporal no es válido.' );
    }
    if ( empty( $temp_dir ) || ! is_string( $temp_dir ) ) {
        gwcore_log( 'Error: temp_dir es inválido antes de descomprimir.' );
        return new \WP_Error( 'gwcore_invalid_temp_dir', 'El directorio temporal no es válido.' );
    }
    
    // Ensure tmp_file and temp_dir are valid strings before passing to unzip_file
    if ( is_null( $tmp_file ) || ! is_string( $tmp_file ) || empty( $tmp_file ) ) {
        return new \WP_Error( 'gwcore_invalid_tmp_file', 'El archivo temporal no es válido antes de descomprimir.' );
    }
    if ( is_null( $temp_dir ) || ! is_string( $temp_dir ) || empty( $temp_dir ) ) {
        return new \WP_Error( 'gwcore_invalid_temp_dir', 'El directorio temporal no es válido antes de descomprimir.' );
    }
    
    $result = unzip_file( $tmp_file, $temp_dir );
    $wp_filesystem->delete( $tmp_file );

    if ( is_wp_error( $result ) ) {
        $error_msg = $result->get_error_message();
        gwcore_log( 'Error al descomprimir zip: ' . ( $error_msg ?? 'Error desconocido' ) );
        $wp_filesystem->rmdir( $temp_dir, true );
        return $result;
    }

    // Buscar init.php en diferentes estructuras posibles del ZIP
    $new_core_dir = null;
    
    // Caso 1: Archivos directamente en la raíz del ZIP
    $init_path_1 = $temp_dir . '/init.php';
    if ( ! is_null( $temp_dir ) && is_string( $temp_dir ) && ! empty( $temp_dir ) && $wp_filesystem->exists( $init_path_1 ) ) {
        $new_core_dir = $temp_dir;
        gwcore_log( 'Estructura detectada: archivos directamente en la raíz del ZIP.' );
    }
    // Caso 2: Archivos dentro de carpeta gw-core/
    elseif ( ! is_null( $temp_dir ) && is_string( $temp_dir ) && ! empty( $temp_dir ) ) {
        $gw_core_path = $temp_dir . '/gw-core';
        $init_path_2 = $temp_dir . '/gw-core/init.php';
        if ( $wp_filesystem->is_dir( $gw_core_path ) && $wp_filesystem->exists( $init_path_2 ) ) {
            $new_core_dir = $gw_core_path;
            gwcore_log( 'Estructura detectada: archivos dentro de carpeta gw-core/.' );
        }
    }
    // Caso 3: Buscar recursivamente init.php (puede haber una carpeta contenedora con otro nombre)
    else {
        $found = gwcore_find_init_file( $temp_dir, $wp_filesystem );
        if ( $found ) {
            $new_core_dir = dirname( $found );
            gwcore_log( 'Estructura detectada: init.php encontrado en ' . ( $new_core_dir ?? 'desconocido' ) );
        }
    }

    // Si no se encontró init.php, listar contenido para debugging
    if ( ! $new_core_dir ) {
        $contents = gwcore_list_directory_contents( $temp_dir, $wp_filesystem );
        gwcore_log( 'El zip no contiene un gw-core válido (falta init.php).' );
        gwcore_log( 'Contenido del ZIP descomprimido: ' . $contents );
        $wp_filesystem->rmdir( $temp_dir, true );
        return new \WP_Error( 
            'gwcore_invalid_zip', 
            'El paquete descargado no tiene la estructura esperada. Revisa el log para ver el contenido del ZIP.'
        );
    }

    // Hacer backup de la versión anterior
    // Ensure gw_dir is never null before passing to trailingslashit
    $gw_dir_safe_backup = is_null( $gw_dir ) || ! is_string( $gw_dir ) ? '' : (string) $gw_dir;
    if ( empty( $gw_dir_safe_backup ) ) {
        $gw_dir_safe_backup = (string) get_stylesheet_directory() . '/gw';
    }
    $backup_dir = trailingslashit( $gw_dir_safe_backup ) . 'gw-core-backup-' . date( 'Ymd-His' );

    if ( $wp_filesystem->is_dir( $target_dir ) ) {
        $wp_filesystem->move( $target_dir, $backup_dir );
    }

    // Mover el nuevo gw-core a su lugar
    if ( ! $wp_filesystem->move( $new_core_dir, $target_dir ) ) {
        gwcore_log( 'No se pudo mover el nuevo gw-core a su destino.' );
        // Intentar restaurar backup
        if ( $wp_filesystem->is_dir( $backup_dir ) ) {
            $wp_filesystem->move( $backup_dir, $target_dir );
        }
        $wp_filesystem->rmdir( $temp_dir, true );
        return new \WP_Error( 'gwcore_move_failed', 'No se pudo colocar el nuevo gw-core en su lugar.' );
    }

    // Limpiar temporales
    $wp_filesystem->rmdir( $temp_dir, true );

    // Actualizar versión local, si se proporcionó en el manifest
    if ( $version ) {
        gwcore_update_local_version( $version );
    }

    gwcore_log( 'Actualización completada correctamente a la versión ' . ( $version ?? 'desconocida' ) );

    return true;
}

/**
 * Actualiza el archivo gw/gw-core-version.php con la nueva versión.
 */
function gwcore_update_local_version( $new_version ) {
    global $wp_filesystem;
    
    // Ensure filesystem is initialized
    if ( empty( $wp_filesystem ) ) {
        require_once ABSPATH . '/wp-admin/includes/file.php';
        WP_Filesystem();
    }
    
    $theme_dir      = get_stylesheet_directory();
    // Ensure theme_dir is never null before passing to trailingslashit
    $theme_dir_safe_version = is_null( $theme_dir ) || ! is_string( $theme_dir ) ? (string) get_stylesheet_directory() : (string) $theme_dir;
    $version_file   = trailingslashit( $theme_dir_safe_version ) . 'gw/gw-core-version.php';
    $secret_default = defined( 'GW_CORE_UPDATE_SECRET' ) ? GW_CORE_UPDATE_SECRET : 'CAMBIA_ESTE_VALOR_POR_UNO_SEGURO';

    $php = "<?php\n";
    $php .= "if ( ! defined( 'ABSPATH' ) ) { exit; }\n\n";
    $php .= "/**\n * GlitchWood Core shared module\n * Archivo generado automáticamente.\n */\n\n";
    $php .= "define( 'GW_CORE_VERSION', '" . esc_sql( $new_version ) . "' );\n";
    $php .= "define( 'GW_CORE_UPDATE_SECRET', '" . esc_sql( $secret_default ) . "' );\n";

    $wp_filesystem->put_contents( $version_file, $php, FS_CHMOD_FILE );
}

/**
 * Busca recursivamente el archivo init.php dentro de un directorio.
 */
function gwcore_find_init_file( $dir, $wp_filesystem ) {
    // Try using dirlist first (works with most filesystem methods)
    if ( method_exists( $wp_filesystem, 'dirlist' ) ) {
        $items = $wp_filesystem->dirlist( $dir );
        
        if ( $items ) {
            foreach ( $items as $item => $details ) {
                // Ensure dir is never null before passing to trailingslashit
                $dir_safe = is_null( $dir ) || ! is_string( $dir ) ? '' : (string) $dir;
                $path = trailingslashit( $dir_safe ) . $item;
                
                if ( $item === 'init.php' && isset( $details['type'] ) && $details['type'] === 'f' ) {
                    return $path;
                }
                
                if ( isset( $details['type'] ) && $details['type'] === 'd' ) {
                    $found = gwcore_find_init_file( $path, $wp_filesystem );
                    if ( $found ) {
                        return $found;
                    }
                }
            }
        }
    }
    
    // Fallback: use native PHP functions if available (for direct filesystem)
    if ( is_dir( $dir ) ) {
        $iterator = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator( $dir, \RecursiveDirectoryIterator::SKIP_DOTS ),
            \RecursiveIteratorIterator::SELF_FIRST
        );
        
        foreach ( $iterator as $file ) {
            if ( $file->isFile() && $file->getFilename() === 'init.php' ) {
                return $file->getPathname();
            }
        }
    }
    
    return false;
}

/**
 * Lista el contenido de un directorio para debugging.
 */
function gwcore_list_directory_contents( $dir, $wp_filesystem, $prefix = '', $max_depth = 3, $current_depth = 0 ) {
    $output = array();
    
    if ( $current_depth >= $max_depth ) {
        return '... (profundidad máxima alcanzada)';
    }
    
    // Try using dirlist first
    if ( method_exists( $wp_filesystem, 'dirlist' ) ) {
        $items = $wp_filesystem->dirlist( $dir );
        
        if ( ! $items ) {
            return 'Directorio vacío';
        }
        
        foreach ( $items as $item => $details ) {
            $type = isset( $details['type'] ) && $details['type'] === 'd' ? '[DIR]' : '[FILE]';
            $output[] = $prefix . $type . ' ' . $item;
            
            if ( isset( $details['type'] ) && $details['type'] === 'd' ) {
                // Ensure dir is never null before passing to trailingslashit
                $dir_safe_list = is_null( $dir ) || ! is_string( $dir ) ? '' : (string) $dir;
                $subdir = trailingslashit( $dir_safe_list ) . $item;
                $subcontents = gwcore_list_directory_contents( $subdir, $wp_filesystem, $prefix . '  ', $max_depth, $current_depth + 1 );
                if ( $subcontents && $subcontents !== 'Directorio vacío' ) {
                    $output[] = $subcontents;
                }
            }
        }
    }
    // Fallback: use native PHP
    elseif ( is_dir( $dir ) ) {
        $items = scandir( $dir );
        $items = array_diff( $items, array( '.', '..' ) );
        
        if ( empty( $items ) ) {
            return 'Directorio vacío';
        }
        
        foreach ( $items as $item ) {
            // Ensure dir is never null before passing to trailingslashit
            $dir_safe_fallback = is_null( $dir ) || ! is_string( $dir ) ? '' : (string) $dir;
            $path = trailingslashit( $dir_safe_fallback ) . $item;
            $type = is_dir( $path ) ? '[DIR]' : '[FILE]';
            $output[] = $prefix . $type . ' ' . $item;
            
            if ( is_dir( $path ) ) {
                $subcontents = gwcore_list_directory_contents( $path, $wp_filesystem, $prefix . '  ', $max_depth, $current_depth + 1 );
                if ( $subcontents && $subcontents !== 'Directorio vacío' ) {
                    $output[] = $subcontents;
                }
            }
        }
    } else {
        return 'No se puede leer el directorio';
    }
    
    return implode( "\n", $output );
}

/**
 * Elimina un directorio de forma recursiva.
 */
function gwcore_rrmdir( $dir ) {
    if ( ! is_dir( $dir ) ) {
        return;
    }
    $items = scandir( $dir );
    foreach ( $items as $item ) {
        if ( $item === '.' || $item === '..' ) {
            continue;
        }
        $path = $dir . DIRECTORY_SEPARATOR . $item;
        if ( is_dir( $path ) ) {
            gwcore_rrmdir( $path );
        } else {
            @unlink( $path );
        }
    }
    @rmdir( $dir );
}

/**
 * Logging básico a wp-content/uploads/gwcore-update.log
 */
function gwcore_log( $message ) {
    global $wp_filesystem;
    
    $upload_dir = wp_upload_dir();
    
    // Check if upload_dir has error or if basedir is null/empty
    if ( isset( $upload_dir['error'] ) && $upload_dir['error'] !== false ) {
        // If there's an error, use fallback path
        $basedir_value = WP_CONTENT_DIR . '/uploads';
    } else {
        $basedir_value = isset( $upload_dir['basedir'] ) ? $upload_dir['basedir'] : '';
    }
    
    // Additional check: if basedir_value is null, use fallback
    if ( is_null( $basedir_value ) || empty( $basedir_value ) ) {
        $basedir_value = WP_CONTENT_DIR . '/uploads';
    }
    
    // Ensure basedir_value is a valid string before using trailingslashit
    if ( ! is_string( $basedir_value ) || empty( $basedir_value ) ) {
        // Fallback to wp-content/uploads if basedir is not available
        $basedir_value = WP_CONTENT_DIR . '/uploads';
    }
    
    // Ensure basedir_value is not null before passing to trailingslashit
    if ( is_null( $basedir_value ) ) {
        $basedir_value = WP_CONTENT_DIR . '/uploads';
    }
    
    // Ensure basedir_value is a valid non-null string before trailingslashit
    $basedir_value = is_string( $basedir_value ) && ! is_null( $basedir_value ) ? $basedir_value : ( WP_CONTENT_DIR . '/uploads' );
    
    // Final check: ensure basedir_value is never null before passing to trailingslashit
    // trailingslashit() calls untrailingslashit() which uses rtrim(), and rtrim() doesn't accept null in PHP 8.1+
    if ( is_null( $basedir_value ) || ! is_string( $basedir_value ) ) {
        $basedir_value = WP_CONTENT_DIR . '/uploads';
    }
    
    // Use a safe wrapper for trailingslashit that handles null
    $basedir_safe = (string) $basedir_value;
    $log_file = trailingslashit( $basedir_safe ) . 'gwcore-update.log';
    
    // Final validation: ensure log_file is a valid string
    if ( ! is_string( $log_file ) || empty( $log_file ) || is_null( $log_file ) ) {
        // Ultimate fallback: use wp-content directly
        $log_file = WP_CONTENT_DIR . '/gwcore-update.log';
    }

    $line = '[' . date( 'Y-m-d H:i:s' ) . '] ' . $message . PHP_EOL;
    
    // Try to use filesystem if available, fallback to file_put_contents
    // Ensure log_file is valid before passing to WordPress functions
    if ( ! is_null( $log_file ) && is_string( $log_file ) && ! empty( trim( $log_file ) ) ) {
        if ( ! empty( $wp_filesystem ) ) {
            // Validate log_file one more time before passing to WordPress filesystem
            $log_file_safe = is_string( $log_file ) && ! is_null( $log_file ) ? $log_file : WP_CONTENT_DIR . '/gwcore-update.log';
            $existing = $wp_filesystem->exists( $log_file_safe ) ? $wp_filesystem->get_contents( $log_file_safe ) : '';
            $wp_filesystem->put_contents( $log_file_safe, $existing . $line, FS_CHMOD_FILE );
        } else {
            @file_put_contents( $log_file, $line, FILE_APPEND );
        }
    }
}

/**
 * Página de administración sencilla para disparar la actualización manualmente.
 * Registrada sin aparecer en el menú, pero accesible por URL directa.
 */
function gwcore_register_admin_page() {
    // Use add_menu_page() instead of add_submenu_page() with null parent
    // This avoids passing null to plugin_basename() which causes deprecation warnings in PHP 8.1+
    $hook = add_menu_page(
        'GlitchWood Core',
        'GlitchWood Core',
        'manage_options',
        'gwcore-updater',
        __NAMESPACE__ . '\\gwcore_admin_page'
    );
    
    // Remove from menu to hide it (page is still accessible via direct URL)
    if ( $hook ) {
        remove_menu_page( 'gwcore-updater' );
    }
}
add_action( 'admin_menu', __NAMESPACE__ . '\\gwcore_register_admin_page' );

function gwcore_admin_page() {
    // Initialize filesystem credentials
    $url = wp_nonce_url( 'themes.php?page=gwcore-updater', 'gwcore_update_action' );
    
    if ( isset( $_POST['gwcore_do_update'] ) && check_admin_referer( 'gwcore_update_action', 'gwcore_nonce' ) ) {
        // Request filesystem credentials if needed
        if ( false === ( $creds = request_filesystem_credentials( $url, '', false, false, null ) ) ) {
            return; // Stop here if credentials form is shown
        }
        
        // Initialize filesystem
        if ( ! WP_Filesystem( $creds ) ) {
            request_filesystem_credentials( $url, '', true, false, null );
            return;
        }
        
        $result = gwcore_run_update();
        if ( is_wp_error( $result ) ) {
            echo '<div class="notice notice-error"><p>' . esc_html( $result->get_error_message() ) . '</p></div>';
        } else {
            echo '<div class="notice notice-success"><p>GlitchWood Core actualizado correctamente.</p></div>';
        }
    }

    echo '<div class="wrap">';
    echo '<h1>GlitchWood Core</h1>';

    if ( gwcore_is_update_available() ) {
        echo '<p>Hay una nueva versión disponible.</p>';
    } else {
        echo '<p>Estás utilizando la versión más reciente disponible.</p>';
    }

    echo '<form method="post">';
    wp_nonce_field( 'gwcore_update_action', 'gwcore_nonce' );
    submit_button( 'Actualizar ahora', 'primary', 'gwcore_do_update' );
    echo '</form>';

    if ( defined( 'GW_CORE_VERSION' ) ) {
        echo '<p><strong>Versión local:</strong> ' . esc_html( GW_CORE_VERSION ) . '</p>';
    }
    echo '</div>';
}

