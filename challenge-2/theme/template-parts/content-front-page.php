<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <section class="challenge-2-hero" style="padding: 4rem 1rem; max-width: 1120px; margin: 0 auto;">
        <div style="display: flex; flex-wrap: wrap; gap: 2rem; align-items: flex-start;">
            <div style="flex: 1 1 400px; min-width: 320px;">
                <p style="text-transform: uppercase; letter-spacing: .18em; color: #007cba; font-weight: 700; margin-bottom: 1rem;">Law Firm of Pug &amp; Puggle, ESQ.</p>
                <h1 style="font-size: clamp(2.5rem, 4vw, 4rem); margin: 0 0 1rem; line-height: 1.05;">Legal services for people who need a trusted advocate.</h1>
                <p style="font-size: 1rem; line-height: 1.75; color: #333; max-width: 36rem; margin-bottom: 1.75rem;">We build case strategy, represent clients in high-stakes litigation, and help families secure outcomes with care and experience.</p>
                <div style="display: grid; gap: 1rem; max-width: 320px;">
                    <a href="#contact" style="display: inline-block; background: #007cba; color: #fff; text-decoration: none; padding: 0.95rem 1.4rem; border-radius: 999px; text-align: center;">Request a Consultation</a>
                    <a href="#cases" style="display: inline-block; background: transparent; color: #007cba; border: 1px solid #007cba; text-decoration: none; padding: 0.95rem 1.4rem; border-radius: 999px; text-align: center;">View Case Results</a>
                </div>
            </div>
            <div id="contact" style="flex: 1 1 360px; min-width: 320px; max-width: 420px; background: #f5f8fb; border-radius: 24px; padding: 2rem;">
                <h2 style="margin-top: 0; font-size: 1.25rem;">Contact Our Team</h2>
                <?php echo do_shortcode( '[law_firm_contact_form]' ); ?>
            </div>
        </div>
    </section>
</article>
