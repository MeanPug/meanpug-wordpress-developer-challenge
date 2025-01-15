<section class="hero-section relative bg-blue-900 text-white">
  <div class="relative container-fluid mx-auto grid lg:grid-cols-[2fr_1fr] gap-8 items-center py-16">
    <div class="space-y-4 hero-left">
      <h2 class="text-white playfair-font">A legacy of excellence, <span class="yellow-text-brand">built for today's challenges</span></h2>
      <h1 class="outfit-font">Joseph, Hollander & Craft LLC</h1>
      <p class="text-2xl font-semibold yellow-text-brand playfair-font">Excellence When You Need It</p>
      <p class="hero-text text-white">
        In and out of court, Joseph, Hollander & Craft's <span class="yellow-text-brand">top-rated</span> attorneys deliver the top-quality, strategic legal counsel you have been looking for.
        We are by your side when the outcome is personal and the result is life-changing.
      </p>
      <div class="flex flex-wrap gap-4">
        <a href="#contact" class="button-red-styling">Get a Free Consultation</a>
        <a href="#meet-our-firm" class="button-yellow-styling">Meet Our Firm</a>
      </div>
      <p class="text-sm text-white">*Available 24/7 & Obligation-Free</p>

      <div class="flex gap-8 text-left mt-8 hero-icons">
        <div class="flex flex-col text-left border-r border-dashed border-gray-300 last:border-0 px-6">
            <img src="/wp-content/uploads/2025/01/icon1.png" alt="Icon 1" class="h-12 w-12 mb-2">
            <p class="outfit-font text-xl font-bold">+100</p>
            <p class="text-sm">years in service</p>
        </div>
        <div class="flex flex-col text-left border-r border-dashed border-gray-300 last:border-0 px-6">
            <img src="/wp-content/uploads/2025/01/icon2.png" alt="Icon 2" class="h-12 w-12 mb-2">
            <p class="outfit-font text-xl font-bold">$90m</p>
            <p class="text-sm">recovered in cases</p>
        </div>
        <div class="flex flex-col text-left border-r border-dashed border-gray-300 last:border-0 px-6">
            <img src="/wp-content/uploads/2025/01/icon3.png" alt="Icon 3" class="h-12 w-12 mb-2">
            <p class="outfit-font text-xl font-bold">+80</p>
            <p class="text-sm">verdicts</p>
        </div>
        <div class="flex flex-col text-left">
            <img src="/wp-content/uploads/2025/01/icon4.png" alt="Icon 4" class="h-12 w-12 mb-2">
            <p class="outfit-font text-xl font-bold">0%</p>
            <p class="text-sm">fees until we win</p>
        </div>
        </div>
    </div>

    <div class="hero-form bg-opacity-60 p-8 shadow-lg">
      <h3>Thank you for taking this essential first step in your quest for justice. We will review your case details and follow up very soon.</h3>
      <div class="space-y-4">
        <?php echo do_shortcode('[contact-form-7 id="94eb284" title="Hero Contact Form"]'); ?>
      </div>
      <p class="text-sm text-white mt-4">We will use and protect your data in accordance with our <a href="#" class="underline">Privacy Policy</a>.</p>
    </div>
  </div>
</section>

<div class="bg-blue-900 text-white social-proof-bellow-hero">
    <div class="container-fluid mx-auto flex items-center">
        <div class="flex-shrink-0">
            <img src="/wp-content/uploads/2025/01/jhc-small-logo.jpg" alt="JH&C Logo" class="h-42">
        </div>

        <div class="flex-grow amount-number-data">
            <div class="grid grid-cols-4 gap-4">
                <?php
                $args = array(
                    'post_type' => 'case_results',
                    'posts_per_page' => 4, 
                );
                $case_results = new WP_Query($args);

                if ($case_results->have_posts()):
                    while ($case_results->have_posts()): $case_results->the_post();
                        $case_type = get_field('case_type');
                        $amount_won = get_field('amount_won');
                ?>
                    <div class="text-left">
                        <p class="case-type uppercase"><?php echo esc_html($case_type); ?></p>
                        <p class="amount-number font-bold"><?php echo esc_html($amount_won); ?></p>
                    </div>
                <?php
                    endwhile;
                    wp_reset_postdata();
                endif;
                ?>
            </div>
            <div class="button-amount-bellow-hero">
            <a href="/case-results" class="text-blue-900 font-bold ">
                SEE ALL CASE RESULTS →
            </a>
        </div>
        </div>

        
    </div>
</div>

<section class="relative bg-white py-16 about-section">
  <div class="container-fluid mx-auto grid lg:grid-cols-2 gap-8 items-center">
    <div class="lg:col-span-1 about-section-left-content">
      <h2>Joseph, Hollander & Craft</h2>
      <h3>We are always by your side</h3>
      <div class="w-20 h-1 bg-yellow-600 mb-6"></div>
      <p class="text-gray-700 leading-relaxed mb-6">Joseph, Hollander & Craft is a premier Heartland law firm serving the criminal, civil, and family law needs of clients across Kansas and Missouri. When you want the attorney standing beside you to be skilled, prepared, and effective, you can rely on JHC to get the job done.</p>
      <p class="text-gray-700 leading-relaxed mb-6">We protect children and property in divorce cases. We pursue personal injury relief for victims of auto collisions, fires, and other tragic accidents. We help doctors, nurses, judges, attorneys, accountants, real estate agents, and other professionals protect their licenses and continue their hard-earned practices.</p>
      <p class="text-gray-700 leading-relaxed mb-6">Joseph, Hollander & Craft operates according to the maxim, <em>in omnia paratus</em>, meaning “ready for anything.” That is our motto. Instilled in the firm by its founders and carried through decades in action, the attorneys at JHC are disciplined workers, lifelong learners, and always preparing for what is ahead.</p>
      <div class="flex flex-wrap gap-4 mt-6">
        <img src="/wp-content/uploads/2025/01/Logos.png" alt="Logos" class="h-15">
      </div>
      <div class="mt-8">
        <button class="button-red-styling transition">GET A FREE CONSULTATION</button>
      </div>
      <p class="text-sm text-gray-500 mt-4">*Available 24/7 & Obligation-Free Consultation</p>
    </div>
    <div class="hidden lg:block">
      <img src="/wp-content/uploads/2025/01/Images-About-Section.jpg" alt="Team Photo" class="w-full h-auto object-cover">
    </div>
  </div>
</section>
