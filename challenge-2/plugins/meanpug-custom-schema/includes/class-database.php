<?php
declare( strict_types=1 );

namespace MeanPug\CustomSchema;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Database {

    private const TABLE_NAME = 'case_inquiries';

    public function init(): void {}

    public static function create_tables(): void {
        global $wpdb;

        $table_name      = $wpdb->prefix . self::TABLE_NAME;
        $charset_collate = $wpdb->get_charset_collate();

        $sql = "CREATE TABLE {$table_name} (
            id bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
            full_name varchar(100) NOT NULL DEFAULT '',
            email varchar(100) NOT NULL DEFAULT '',
            phone varchar(30) NOT NULL DEFAULT '',
            practice_area_id bigint(20) UNSIGNED NOT NULL DEFAULT 0,
            message text NOT NULL,
            status varchar(20) NOT NULL DEFAULT 'new',
            submitted_at datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY (id),
            KEY practice_area_id (practice_area_id),
            KEY status (status)
        ) {$charset_collate};";

        require_once ABSPATH . 'wp-admin/includes/upgrade.php';
        dbDelta( $sql );

        update_option( 'meanpug_schema_db_version', MEANPUG_SCHEMA_VERSION );
    }

    public static function insert_inquiry( array $data ): int|false {
        global $wpdb;

        $table_name = $wpdb->prefix . self::TABLE_NAME;

        $inserted = $wpdb->insert(
            $table_name,
            [
                'full_name'        => sanitize_text_field( $data['full_name'] ?? '' ),
                'email'            => sanitize_email( $data['email'] ?? '' ),
                'phone'            => sanitize_text_field( $data['phone'] ?? '' ),
                'practice_area_id' => absint( $data['practice_area_id'] ?? 0 ),
                'message'          => sanitize_textarea_field( $data['message'] ?? '' ),
                'status'           => 'new',
                'submitted_at'     => current_time( 'mysql' ),
            ],
            [ '%s', '%s', '%s', '%d', '%s', '%s', '%s' ]
        );

        return $inserted ? $wpdb->insert_id : false;
    }

    public static function get_inquiries( string $status = '' ): array {
        global $wpdb;

        $table_name = $wpdb->prefix . self::TABLE_NAME;

        if ( ! empty( $status ) ) {
            $results = $wpdb->get_results(
                $wpdb->prepare(
                    "SELECT * FROM {$table_name} WHERE status = %s ORDER BY submitted_at DESC",
                    $status
                )
            );
        } else {
            $results = $wpdb->get_results(
                "SELECT * FROM {$table_name} ORDER BY submitted_at DESC"
            );
        }

        return $results ?? [];
    }

    public static function update_inquiry_status( int $id, string $status ): bool {
        global $wpdb;

        $table_name = $wpdb->prefix . self::TABLE_NAME;

        $allowed_statuses = [ 'new', 'contacted', 'closed' ];

        if ( ! in_array( $status, $allowed_statuses, true ) ) {
            return false;
        }

        $updated = $wpdb->update(
            $table_name,
            [ 'status' => $status ],
            [ 'id'     => $id ],
            [ '%s' ],
            [ '%d' ]
        );

        return $updated !== false;
    }
}