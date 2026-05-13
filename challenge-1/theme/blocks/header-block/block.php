<?php
if (isset($block['data']['is_preview'])) :    /* rendering in inserter preview  */
  $clean_name = str_replace('acf/', '', $block['name']);
  echo '<img src="' . get_template_directory_uri() . '/blocks/' . $clean_name . '/preview.png" style="width:100%; height:auto;">';
else : ?>
    <section class="inf-block inf-header">
        <div class="inf-header__logo">
            <img class="inf-header__logo-img" src="<?php echo get_template_directory_uri();?>/assets/images/airbnblogo.png" alt="Airpug" />
        </div>
        <button class="inf-header__toggle" aria-label="Abrir menú" aria-expanded="false">
            <span></span>
            <span></span>
            <span></span>
        </button>
        <nav class="inf-header__nav">
            <ul class="inf-header__menu">
                <li class="inf-header__menu-item ">
                    <img class="inf-header__user-img" src="<?php echo get_template_directory_uri();?>/assets/images/main-menu/lang.png" alt="Airpug" />
                </li>
                <li class="inf-header__menu-item active">
                    <a class="inf-header__menu-link" href="#">Host your home</a>
                </li>
                <li class="inf-header__menu-item">
                    <a class="inf-header__menu-link" href="#">Host an experience</a>
                </li>
                <li class="inf-header__menu-item">
                    <a class="inf-header__menu-link" href="#">Help</a>
                </li>
                <li class="inf-header__menu-item user">
                    <a class="inf-header__menu-link" href="#">Bobby The Pug</a>
                    <img class="inf-header__user-img" src="<?php echo get_template_directory_uri();?>/assets/images/main-menu/jorgepug.png" alt="Airpug" />
                    <span class="inf-header__notifications">3</span>
                </li>
            </ul>
        </nav>
    </section>
<?php endif ?>

