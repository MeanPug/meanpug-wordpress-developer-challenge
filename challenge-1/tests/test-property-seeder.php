<?php
/**
 * Tests for PropertySeeder.
 *
 * @package infra
 */

namespace Inf\Tests\Seeder;

use Inf\Seeder\PropertySeeder;
use WP_UnitTestCase;

/**
 * @group seeder
 */
class PropertySeederTest extends WP_UnitTestCase {

    /**
     * Seeder should create 12 sample properties when none exist.
     */
    public function test_run_creates_properties() {
        $this->assertEquals( 0, $this->count_properties() );

        PropertySeeder::run();

        $this->assertEquals( 12, $this->count_properties() );
    }

    /**
     * Seeder should be idempotent: running twice should not duplicate.
     */
    public function test_run_is_idempotent() {
        PropertySeeder::run();
        $first_count = $this->count_properties();

        PropertySeeder::run();
        $this->assertEquals( $first_count, $this->count_properties() );
    }

    /**
     * Created properties should have correct meta.
     */
    public function test_properties_have_meta() {
        PropertySeeder::run();

        $posts = get_posts( array(
            'post_type'      => 'property',
            'posts_per_page' => 1,
        ) );

        $this->assertNotEmpty( $posts );

        $post = $posts[0];
        $this->assertNotEmpty( get_post_meta( $post->ID, '_inf_price', true ) );
        $this->assertNotEmpty( get_post_meta( $post->ID, '_inf_location', true ) );
    }

    /**
     * Helper: count published properties.
     *
     * @return int
     */
    private function count_properties(): int {
        return (int) wp_count_posts( 'property' )->publish;
    }
}
