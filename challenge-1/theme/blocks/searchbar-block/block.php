<?php
if (isset($block['data']['is_preview'])) :    /* rendering in inserter preview  */
  $clean_name = str_replace('acf/', '', $block['name']);
  echo '<img src="' . get_template_directory_uri() . '/blocks/' . $clean_name . '/preview.png" style="width:100%; height:auto;">';
else : ?>
    <section class="inf-block inf-searchbar">
        <nav class="inf-searchbar__nav">
            <ul class="inf-searchbar__menu">
                <li class="inf-searchbar__menu-item active">
                    <a class="inf-searchbar__menu-link" href="#">Places to stay</a>
                </li>
                <li class="inf-searchbar__menu-item">
                    <a class="inf-searchbar__menu-link" href="#">Monthly stays</a>
                </li>
                <li class="inf-searchbar__menu-item">
                    <a class="inf-searchbar__menu-link" href="#">Experiences</a>
                </li>
                <li class="inf-searchbar__menu-item user">
                    <a class="inf-searchbar__menu-link" href="#">Online Experiences</a>
                    <span class="inf-searchbar__notifications">New</span>
                </li>
            </ul>
        </nav>
        <div class="inf-searchbar__form">
            <div class="inf-searchbar__form-group">
                <label class="inf-searchbar__form-label">Location</label>
                <input class="inf-searchbar__form-input" type="text" placeholder="Where are you going?" />
            </div>
            <div class="inf-searchbar__form-divider"></div>
            <div class="inf-searchbar__form-group">
                <label class="inf-searchbar__form-label">Check in / Check out</label>
                <input class="inf-searchbar__form-input" type="text" placeholder="Add dates" />
            </div>
            <div class="inf-searchbar__form-divider"></div>
            <div class="inf-searchbar__form-group">
                <label class="inf-searchbar__form-label">Guests</label>
                <input class="inf-searchbar__form-input" type="text" placeholder="Add guests" />
            </div>
            <button class="inf-searchbar__form-btn">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>
                </svg>
                Search
            </button>
        </div>
    </section>
<?php endif ?>