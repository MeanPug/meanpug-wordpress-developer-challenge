( function ( wp ) {
    'use strict';

    var el = wp.element.createElement;
    var Fragment = wp.element.Fragment;
    var InspectorControls = wp.blockEditor.InspectorControls;
    var MediaUpload = wp.blockEditor.MediaUpload;
    var PanelBody = wp.components.PanelBody;
    var TextControl = wp.components.TextControl;
    var TextareaControl = wp.components.TextareaControl;
    var ToggleControl = wp.components.ToggleControl;
    var Button = wp.components.Button;
    var ServerSideRender = wp.serverSideRender;
    var __ = wp.i18n.__;

    function ctaPanel( title, a, set, keys ) {
        return el( PanelBody, { title: title, initialOpen: false },
            el( TextControl, {
                label: __( 'URL', 'inf' ),
                value: a[ keys.url ],
                onChange: function ( v ) { var p = {}; p[ keys.url ] = v; set( p ); }
            } ),
            el( TextControl, {
                label: __( 'Label', 'inf' ),
                value: a[ keys.title ],
                onChange: function ( v ) { var p = {}; p[ keys.title ] = v; set( p ); }
            } ),
            el( ToggleControl, {
                label: __( 'Open in new tab', 'inf' ),
                checked: a[ keys.newTab ],
                onChange: function ( v ) { var p = {}; p[ keys.newTab ] = v; set( p ); }
            } )
        );
    }

    wp.blocks.registerBlockType( 'pugpuggle/hero-banner', {
        edit: function ( props ) {
            var a = props.attributes;
            var set = props.setAttributes;
            return el( Fragment, null,
                el( InspectorControls, null,
                    el( PanelBody, { title: __( 'Content', 'inf' ), initialOpen: true },
                        el( TextControl, {
                            label: __( 'Heading', 'inf' ),
                            value: a.heading,
                            onChange: function ( v ) { set( { heading: v } ); }
                        } ),
                        el( TextareaControl, {
                            label: __( 'Subheading', 'inf' ),
                            value: a.subheading,
                            onChange: function ( v ) { set( { subheading: v } ); }
                        } )
                    ),
                    ctaPanel( __( 'Primary CTA', 'inf' ), a, set, { url: 'primaryCtaUrl', title: 'primaryCtaTitle', newTab: 'primaryCtaNewTab' } ),
                    ctaPanel( __( 'Secondary CTA', 'inf' ), a, set, { url: 'secondaryCtaUrl', title: 'secondaryCtaTitle', newTab: 'secondaryCtaNewTab' } ),
                    el( PanelBody, { title: __( 'Background Image', 'inf' ), initialOpen: false },
                        el( MediaUpload, {
                            onSelect: function ( media ) { set( { backgroundImageId: media.id, backgroundImageUrl: media.url } ); },
                            allowedTypes: [ 'image' ],
                            value: a.backgroundImageId,
                            render: function ( o ) {
                                return el( Fragment, null,
                                    a.backgroundImageUrl
                                        ? el( 'img', { src: a.backgroundImageUrl, style: { maxWidth: '100%', height: 'auto', marginBottom: 8 } } )
                                        : null,
                                    el( Button, {
                                        onClick: o.open,
                                        variant: 'secondary'
                                    }, a.backgroundImageUrl ? __( 'Replace Image', 'inf' ) : __( 'Select Image', 'inf' ) ),
                                    a.backgroundImageUrl
                                        ? el( Button, {
                                            onClick: function () { set( { backgroundImageId: 0, backgroundImageUrl: '' } ); },
                                            variant: 'link',
                                            isDestructive: true,
                                            style: { marginLeft: 8 }
                                        }, __( 'Remove', 'inf' ) )
                                        : null
                                );
                            }
                        } )
                    )
                ),
                el( ServerSideRender, {
                    block: 'pugpuggle/hero-banner',
                    attributes: a
                } )
            );
        },
        save: function () { return null; }
    } );

}( window.wp ) );
