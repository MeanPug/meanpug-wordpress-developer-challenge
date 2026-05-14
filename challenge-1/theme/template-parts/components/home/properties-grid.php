<section class="container mx-auto px-4 md:px-8 mt-12 mb-16">
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
        <?php
        $properties = [
            [
                'location' => 'Aspen, Colorado',
                'title' => 'Modern Glass Cabin in the Woods',
                'host' => 'Hosted by Sarah',
                'dates' => 'Oct 12 - 17',
                'price' => 350,
                'rating' => 4.96,
                'is_new' => true,
                'image' => 'house1.webp',
                'taxonomies' => ['Cabin', 'Amazing views']
            ],
            [
                'location' => 'Bali, Indonesia',
                'title' => 'Luxury Villa with Infinity Pool',
                'host' => 'Hosted by Wayan',
                'dates' => 'Nov 01 - 08',
                'price' => 850,
                'rating' => 4.85,
                'is_new' => false,
                'image' => 'house2.webp',
                'taxonomies' => ['Villa', 'Tropical']
            ],
            [
                'location' => 'Swiss Alps, Switzerland',
                'title' => 'Minimalist A-Frame Retreat',
                'host' => 'Hosted by Thomas',
                'dates' => 'Dec 15 - 22',
                'price' => 220,
                'rating' => 4.99,
                'is_new' => false,
                'image' => 'house3.webp',
                'taxonomies' => ['A-Frame', 'Skiing']
            ],
            [
                'location' => 'Kyoto, Japan',
                'title' => 'Traditional Machiya with Zen Garden',
                'host' => 'Hosted by Kenji',
                'dates' => 'Mar 10 - 15',
                'price' => 180,
                'rating' => 4.92,
                'is_new' => false,
                'image' => 'house2.webp',
                'taxonomies' => ['Historical', 'Zen']
            ],
            [
                'location' => 'Santorini, Greece',
                'title' => 'Cliffside Cave House',
                'host' => 'Hosted by Elena',
                'dates' => 'Jun 05 - 12',
                'price' => 450,
                'rating' => 4.98,
                'is_new' => true,
                'image' => 'house3.webp',
                'taxonomies' => ['Cave House', 'Ocean view']
            ],
            [
                'location' => 'Patagonia, Chile',
                'title' => 'Eco-dome Off The Grid',
                'host' => 'Hosted by Mateo',
                'dates' => 'Jan 20 - 28',
                'price' => 310,
                'rating' => 4.88,
                'is_new' => false,
                'image' => 'house1.webp',
                'taxonomies' => ['Off-grid', 'National Park']
            ],
        ];

        foreach ($properties as $property) {
            get_template_part('template-parts/components/home/card', 'property', $property);
        }
        ?>
    </div>
</section>