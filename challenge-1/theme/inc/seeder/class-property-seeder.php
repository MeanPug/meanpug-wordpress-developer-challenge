<?php
namespace Inf\Seeder;

class PropertySeeder {

    private static array $samples = array(
        array( 'title' => 'Modern Loft in Downtown',       'price' => 180, 'bedrooms' => 1, 'location' => 'San Francisco, CA',   'rating' => 4.92, 'desc' => 'A bright open loft with skylights, polished floors, and city views.' ),
        array( 'title' => 'Cozy Cabin by Lake Tahoe',       'price' => 120, 'bedrooms' => 2, 'location' => 'South Lake Tahoe, CA', 'rating' => 4.95, 'desc' => 'Wood-beamed cabin steps from lake access with fire pit.' ),
        array( 'title' => 'Beach Bungalow Malibu',           'price' => 350, 'bedrooms' => 3, 'location' => 'Malibu, CA',           'rating' => 4.88, 'desc' => 'Oceanfront bungalow with direct beach access and sunset decks.' ),
        array( 'title' => 'Treehouse Retreat Portland',      'price' => 95,  'bedrooms' => 1, 'location' => 'Portland, OR',          'rating' => 4.97, 'desc' => 'Handcrafted treehouse nestled among old-growth trees.' ),
        array( 'title' => 'Mountain Chalet Aspen',           'price' => 420, 'bedrooms' => 4, 'location' => 'Aspen, CO',            'rating' => 4.90, 'desc' => 'Ski-in/ski-out chalet with hot tub and mountain panorama.' ),
        array( 'title' => 'Desert Oasis Joshua Tree',         'price' => 210, 'bedrooms' => 2, 'location' => 'Joshua Tree, CA',       'rating' => 4.93, 'desc' => 'Minimalist pad surrounded by desert landscape stargazing included.' ),
        array( 'title' => 'Vineyard Cottage Napa',           'price' => 280, 'bedrooms' => 2, 'location' => 'Napa, CA',              'rating' => 4.85, 'desc' => 'Charming cottage amid rolling vineyards with breakfast basket.' ),
        array( 'title' => 'Historic Brownstone Brooklyn',     'price' => 195, 'bedrooms' => 1, 'location' => 'Brooklyn, NY',          'rating' => 4.78, 'desc' => 'Restored brownstone apartment with original crown molding.' ),
        array( 'title' => 'Waterfront Condo Key West',        'price' => 310, 'bedrooms' => 2, 'location' => 'Key West, FL',          'rating' => 4.86, 'desc' => 'Canal-front condo with kayak rentals and sunset cruises.' ),
        array( 'title' => 'Rustic Ranch Big Sur',             'price' => 240, 'bedrooms' => 3, 'location' => 'Big Sur, CA',           'rating' => 4.91, 'desc' => 'Clifftop ranch with coastal trails and whale watching.' ),
        array( 'title' => 'Glass House Bend OR',              'price' => 165, 'bedrooms' => 1, 'location' => 'Bend, OR',             'rating' => 4.89, 'desc' => 'Floor-to-ceiling glass house with forest canopy views.' ),
        array( 'title' => 'Canyon Cave Dwelling Sedona',      'price' => 175, 'bedrooms' => 2, 'location' => 'Sedona, AZ',            'rating' => 4.96, 'desc' => 'Unique cave home carved into red rock with vortex energy.' ),
    );

    public static function run(): void {
        global $wpdb;
        $count = $wpdb->get_var(
            $wpdb->prepare( "SELECT COUNT(*) FROM {$wpdb->posts} WHERE post_type = %s AND post_status = %s", 'property', 'publish' )
        );
        if ( (int) $count > 0 ) return;

        self::import_sample_images();

        $images = wp_parse_id_list( $wpdb->get_col( "SELECT ID FROM {$wpdb->posts} WHERE post_type = 'attachment'" ) );

        foreach ( self::$samples as $i => $data ) {
            $post_id = wp_insert_post( array(
                'post_type'    => 'property',
                'post_title'   => $data['title'],
                'post_content' => $data['desc'],
                'post_status'  => 'publish',
            ), true );

            update_post_meta( $post_id, '_inf_price', (int) $data['price'] );
            update_post_meta( $post_id, '_inf_bedrooms', (int) $data['bedrooms'] );
            update_post_meta( $post_id, '_inf_location', sanitize_text_field( $data['location'] ) );
            update_post_meta( $post_id, '_inf_rating', floatval( $data['rating'] ) );

            if ( !empty($images) ) {
                $img_id = $images[ $i % count( $images ) ];
                set_post_thumbnail( $post_id, $img_id );
                update_post_meta( $post_id, '_inf_image_id', $img_id );
            }
        }
    }

    private static function import_sample_images(): void {
        $urls = array(
            'https://images.unsplash.com/photo-1502672260266-1c1ef2d93688?w=800&q=80',
            'https://images.unsplash.com/photo-1518780664697-55e3ad937233?w=800&q=80',
            'https://images.unsplash.com/photo-1499793983690-e29da59ef1c2?w=800&q=80',
            'https://images.unsplash.com/photo-1501785888041-af3ef285b470?w=800&q=80',
            'https://images.unsplash.com/photo-1510798831971-661eb04b3739?w=800&q=80',
            'https://images.unsplash.com/photo-1506126279197-a5fcfe277b28?w=800&q=80',
            'https://images.unsplash.com/photo-1449844908441-8829872d2607?w=800&q=80',
            'https://images.unsplash.com/photo-1464146072230-91cabc968266?w=800&q=80',
            'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?w=800&q=80',
            'https://images.unsplash.com/photo-1523217582762-ceb31dc16c60?w=800&q=80',
            'https://images.unsplash.com/photo-1504280390367-361c6d9f38f4?w=800&q=80',
            'https://images.unsplash.com/photo-1568605114967-8130f3a36994?w=800&q=80',
        );
        require_once ABSPATH . 'wp-admin/includes/file.php';
        require_once ABSPATH . 'wp-admin/includes/media.php';
        require_once ABSPATH . 'wp-admin/includes/image.php';

        foreach ( $urls as $url ) {
            $tmp = download_url( $url );
            if ( is_wp_error( $tmp ) ) continue;
            
            $file_array = array(
                'name' => basename( $url ) . '.jpg',
                'tmp_name' => $tmp
            );
            $id = media_handle_sideload( $file_array, 0 );
            if ( is_wp_error( $id ) ) {
                @unlink( $tmp );
            }
        }
    }
}
