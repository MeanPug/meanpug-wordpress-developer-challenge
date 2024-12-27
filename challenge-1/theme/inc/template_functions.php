<?php

function inf_get_asset_url($path) {
    return sprintf('%s/assets/%s', get_template_directory_uri(), $path);
}

function inf_acf_link($link_field, $class='') {
  printf('<a href=%s class="%s">%s</a>', $link_field['url'], $class, $link_field['title']);
}

function display_user_meta() {
  $current_user = wp_get_current_user();
  
  if ( is_user_logged_in() ) {
      $user_name = $current_user->first_name;
      $avatar = get_avatar( $current_user->ID, 24, );
      
      echo '<p>' . esc_html( $user_name ) . '</p>' . $avatar . '';      
  }
}