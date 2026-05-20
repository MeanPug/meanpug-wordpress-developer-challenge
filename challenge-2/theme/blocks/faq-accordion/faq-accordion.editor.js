( function ( wp ) {
    'use strict';

    var el = wp.element.createElement;
    var Fragment = wp.element.Fragment;
    var InspectorControls = wp.blockEditor.InspectorControls;
    var PanelBody = wp.components.PanelBody;
    var TextControl = wp.components.TextControl;
    var TextareaControl = wp.components.TextareaControl;
    var ServerSideRender = wp.serverSideRender;
    var __ = wp.i18n.__;

    function idsToText( ids ) {
        return ( ids || [] ).join( ', ' );
    }
    function textToIds( text ) {
        return ( text || '' )
            .split( ',' )
            .map( function ( s ) { return parseInt( s.trim(), 10 ); } )
            .filter( function ( n ) { return n > 0; } );
    }

    wp.blocks.registerBlockType( 'pugpuggle/faq-accordion', {
        edit: function ( props ) {
            var a = props.attributes;
            var set = props.setAttributes;
            return el( Fragment, null,
                el( InspectorControls, null,
                    el( PanelBody, { title: __( 'FAQ Accordion', 'inf' ), initialOpen: true },
                        el( TextControl, {
                            label: __( 'Heading', 'inf' ),
                            value: a.heading,
                            onChange: function ( v ) { set( { heading: v } ); }
                        } ),
                        el( TextareaControl, {
                            label: __( 'FAQ Post IDs', 'inf' ),
                            help: __( 'Comma-separated list of FAQ post IDs.', 'inf' ),
                            value: idsToText( a.faqIds ),
                            onChange: function ( v ) { set( { faqIds: textToIds( v ) } ); }
                        } )
                    )
                ),
                el( ServerSideRender, {
                    block: 'pugpuggle/faq-accordion',
                    attributes: a
                } )
            );
        },
        save: function () { return null; }
    } );

}( window.wp ) );
