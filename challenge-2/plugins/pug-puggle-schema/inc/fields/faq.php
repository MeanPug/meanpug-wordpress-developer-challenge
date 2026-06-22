<?php
/**
 * FAQ Schema field group.
 *
 * Read by `mp_output_additional_schema_for_post()`, which consumes
 * `schema_faq_items` (a repeater of question/answer pairs) on both posts and
 * practice areas to emit FAQPage schema.
 *
 * Defined once here with an OR'd location rule so the field name stays unique —
 * defining it separately on each post type would collide on the shared `name`.
 *
 * @package PugPuggleSchema
 */

defined( 'ABSPATH' ) || exit;

/**
 * Register the FAQ schema fields.
 *
 * @return void
 */
function pps_register_faq_fields() {
	acf_add_local_field_group(
		array(
			'key'      => 'group_pps_faq_schema',
			'title'    => __( 'FAQ Schema', 'pug-puggle-schema' ),
			'fields'   => array(
				array(
					'key'          => 'field_pps_schema_faq_items',
					'label'        => __( 'FAQ Items', 'pug-puggle-schema' ),
					'name'         => 'schema_faq_items',
					'type'         => 'repeater',
					'instructions' => __( 'Question/answer pairs emitted as FAQPage structured data.', 'pug-puggle-schema' ),
					'layout'       => 'row',
					'button_label' => __( 'Add FAQ', 'pug-puggle-schema' ),
					'sub_fields'   => array(
						array(
							'key'   => 'field_pps_faq_question',
							'label' => __( 'Question', 'pug-puggle-schema' ),
							'name'  => 'question',
							'type'  => 'text',
						),
						array(
							'key'       => 'field_pps_faq_answer',
							'label'     => __( 'Answer', 'pug-puggle-schema' ),
							'name'      => 'answer',
							'type'      => 'textarea',
							'new_lines' => 'wpautop',
						),
					),
				),
			),
			'location' => array(
				array(
					array(
						'param'    => 'post_type',
						'operator' => '==',
						'value'    => 'post',
					),
				),
				array(
					array(
						'param'    => 'post_type',
						'operator' => '==',
						'value'    => 'practice-area',
					),
				),
			),
			'active'   => true,
		)
	);
}
