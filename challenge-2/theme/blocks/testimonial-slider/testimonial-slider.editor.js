( function ( wp ) {
    'use strict';

    var el = wp.element.createElement;
    var Fragment = wp.element.Fragment;
    var InspectorControls = wp.blockEditor.InspectorControls;
    var PanelBody = wp.components.PanelBody;
    var TextControl = wp.components.TextControl;
    var ServerSideRender = wp.serverSideRender;
    var __ = wp.i18n.__;

    wp.blocks.registerBlockType( 'pugpuggle/testimonial-slider', {
        edit: function ( props ) {
            var a = props.attributes;
            var set = props.setAttributes;
            return el( Fragment, null,
                el( InspectorControls, null,
                    el( PanelBody, { title: __( 'Testimonial Slider', 'inf' ), initialOpen: true },
                        el( TextControl, {
                            label: __( 'Heading', 'inf' ),
                            value: a.heading,
                            onChange: function ( v ) { set( { heading: v } ); }
                        } ),
                        el( TextControl, {
                            label: __( 'Limit', 'inf' ),
                            type: 'number',
                            min: 1,
                            value: a.limit,
                            onChange: function ( v ) { set( { limit: parseInt( v, 10 ) || 0 } ); }
                        } )
                    )
                ),
                el( ServerSideRender, {
                    block: 'pugpuggle/testimonial-slider',
                    attributes: a
                } )
            );
        },
        save: function () { return null; }
    } );

}( window.wp ) );
