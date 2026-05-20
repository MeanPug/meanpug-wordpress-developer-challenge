( function ( wp ) {
    'use strict';

    var el = wp.element.createElement;
    var Fragment = wp.element.Fragment;
    var InspectorControls = wp.blockEditor.InspectorControls;
    var PanelBody = wp.components.PanelBody;
    var TextControl = wp.components.TextControl;
    var TextareaControl = wp.components.TextareaControl;
    var ToggleControl = wp.components.ToggleControl;
    var ServerSideRender = wp.serverSideRender;
    var __ = wp.i18n.__;

    wp.blocks.registerBlockType( 'pugpuggle/cta-banner', {
        edit: function ( props ) {
            var a = props.attributes;
            var set = props.setAttributes;
            return el( Fragment, null,
                el( InspectorControls, null,
                    el( PanelBody, { title: __( 'CTA Banner', 'inf' ), initialOpen: true },
                        el( TextControl, {
                            label: __( 'Heading', 'inf' ),
                            value: a.heading,
                            onChange: function ( v ) { set( { heading: v } ); }
                        } ),
                        el( TextareaControl, {
                            label: __( 'Body', 'inf' ),
                            value: a.body,
                            onChange: function ( v ) { set( { body: v } ); }
                        } ),
                        el( TextControl, {
                            label: __( 'CTA URL', 'inf' ),
                            value: a.ctaUrl,
                            onChange: function ( v ) { set( { ctaUrl: v } ); }
                        } ),
                        el( TextControl, {
                            label: __( 'CTA Label', 'inf' ),
                            value: a.ctaTitle,
                            onChange: function ( v ) { set( { ctaTitle: v } ); }
                        } ),
                        el( ToggleControl, {
                            label: __( 'Open in new tab', 'inf' ),
                            checked: a.ctaNewTab,
                            onChange: function ( v ) { set( { ctaNewTab: v } ); }
                        } )
                    )
                ),
                el( ServerSideRender, {
                    block: 'pugpuggle/cta-banner',
                    attributes: a
                } )
            );
        },
        save: function () { return null; }
    } );

}( window.wp ) );
