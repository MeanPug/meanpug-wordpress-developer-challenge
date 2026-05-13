<?php
if (isset($block['data']['is_preview'])) :    /* rendering in inserter preview  */
  $clean_name = str_replace('acf/', '', $block['name']);
  echo '<img src="' . get_template_directory_uri() . '/blocks/' . $clean_name . '/preview.png" style="width:100%; height:auto;">';
else : ?>
    <section class="inf-block inf-topribbon">
        <h3>
            Get the latest on our COVID-19 response and cancellation policies.
            <a href="#">
                Learn More.
            </a>
        </h3>
    </section>
<?php endif ?>