<?php

// new code to pull action group from an options page into a template file.

class MeanpugTestActionGroupFieldinOptions {
    public static function present($cloned_field_name) { ?>

        <div class="footer social extra-cta">
	    <?php 
		
			$extra_cta_raw = get_field($cloned_field_name, 'options');

			$extra_cta_array = array($extra_cta_raw);
			$alignment = $extra_cta_array[0]['alignment'];
			$extra_cta_loop = $extra_cta_array[0]['actions'];

            if ($extra_cta_loop != '') :

			foreach ($extra_cta_loop as $cta): ?>

			<div class="button-group button-group--align-<?php echo $alignment ?>">
				<?php
				
					$link = $cta['link']['url'];
					$type = $cta['display'];
					$seo_text = $cta['seo_text'];
					if( '' == $seo_text ){
						$seo_text = $cta['link']['title'];
					}
					$ada_text = '';
					if( '' != ( $ada_text = $cta['ada_text'] ) ){
						$ada_text = '<span class="screen-reader-text">' . esc_html( $ada_text ) . '</span>';
					}

				?>
					<a class="button <?php echo $type ?>"><?php echo esc_html( $cta['link']['title'] ) . $ada_text; ?></a>
			</div>

			<?php endforeach; 
            endif;
            ?>

	</div>
<?php

    }
}

