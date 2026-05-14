<?php
$practice_query = new WP_Query([
    'post_type' => 'practice_area',
    'posts_per_page' => 6,
    'orderby' => 'date',
    'order' => 'DESC'
]);

if ($practice_query->have_posts()): ?>

    <section class="pb-16 bg-slate-950">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl font-black text-slate-900 dark:text-white mb-12 flex items-center gap-4">
                Our Expertise & Specialists
                <div class="h-1 flex-grow bg-slate-200 dark:bg-slate-800 rounded-full"></div>
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php
                while ($practice_query->have_posts()):
                    $practice_query->the_post();
                    $attorneys = get_field('related_attorneys');
                    ?>
                    <div
                        class="group flex flex-col bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-3xl p-8 transition-all hover:shadow-2xl hover:-translate-y-1">

                        <div class="flex items-start justify-between mb-6">
                            <a href="<?php the_permalink(); ?>" class="text-slate-400 hover:text-sky-500 transition-colors">
                                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                </svg>
                            </a>
                        </div>

                        <h3 class="text-xl font-extrabold text-slate-900 dark:text-white mb-2"><?php the_title(); ?></h3>
                        <p class="text-sm text-slate-500 dark:text-slate-400 mb-8 line-clamp-2"><?php echo get_the_excerpt(); ?>
                        </p>

                        <div class="mt-auto pt-6 border-t border-slate-100 dark:border-slate-800">
                            <p class="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-3">Lead Specialists</p>

                            <ul class="space-y-2">
                                <?php
                                if ($attorneys):
                                    foreach ($attorneys as $attorney):
                                        $name = get_the_title($attorney->ID);
                                        $link = get_permalink($attorney->ID);
                                        ?>
                                        <li>
                                            <a href="<?php echo esc_url($link); ?>"
                                                class="group/link flex items-center text-sm font-bold text-slate-700 dark:text-slate-300 hover:text-sky-600 dark:hover:text-sky-400 transition-colors">
                                                <span
                                                    class="mr-2 text-sky-500 opacity-50 group-hover/link:opacity-100 transition-opacity">→</span>
                                                <?php echo esc_html($name); ?>
                                            </a>
                                        </li>
                                    <?php
                                    endforeach;
                                else:
                                    if (current_user_can('manage_options')): ?>
                                        <li
                                            class="text-[10px] text-amber-500 font-bold bg-amber-50 dark:bg-amber-950/30 px-3 py-2 rounded-lg border border-amber-100 dark:border-amber-900/50">
                                             Admin: Assign attorneys in the editor.
                                        </li>
                                    <?php else: ?>
                                        <li class="text-xs italic text-slate-400">Team being assigned...</li>
                                    <?php endif;
                                endif;
                                ?>
                            </ul>
                        </div>
                    </div>
                    <?php
                endwhile;
                wp_reset_postdata();
                ?>
            </div>
        </div>
    </section>

<?php else: ?>
    <?php
    if (current_user_can('manage_options')): ?>
        <div class="p-12 text-center border-2 border-dashed border-slate-200 my-6 rounded-3xl">
            <h3 class="text-slate-900 font-bold">Dev Hint: No Practice Areas Found</h3>
            <p class="text-slate-500 text-sm">Create posts in "Practice Areas" to display this section. <br> Don't forget to use
                the ACP plugin.
            </p>
        </div>
    <?php endif; ?>
<?php endif; ?>