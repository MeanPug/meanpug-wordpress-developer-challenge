<?php
if (isset($block['data']['is_preview'])) :    /* rendering in inserter preview  */
  $clean_name = str_replace('acf/', '', $block['name']);
  echo '<img src="' . get_template_directory_uri() . '/blocks/' . $clean_name . '/preview.png" style="width:100%; height:auto;">';
else : ?>
  <section class="inf-block inf-logo-block logo-block-wrapper flex items-center justify-center py-8 bg-gray-100">
          <div class="pug-logo">TEST</div>
  </section>
<?php endif ?>

