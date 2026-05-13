<?php
if (isset($block['data']['is_preview'])) :    /* rendering in inserter preview  */
  $clean_name = str_replace('acf/', '', $block['name']);
  echo '<img src="' . get_template_directory_uri() . '/blocks/' . $clean_name . '/preview.png" style="width:100%; height:auto;">';
else : ?>
    <section class="inf-block inf-hero">
        <div class="inf-hero__img" style="background-image: url('<?php echo get_template_directory_uri();?>/assets/images/hero.jpg')" ></div>
    </section>
<?php endif ?>