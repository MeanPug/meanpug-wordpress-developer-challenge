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

    wp.blocks.registerBlockType( 'pugpuggle/practice-areas-grid', {
        edit: function ( props ) {
            var a = props.attributes;
            var set = props.setAttributes;
            return el( Fragment, null,
                el( InspectorControls, null,
                    el( PanelBody, { title: __( 'Practice Areas Grid', 'inf' ), initialOpen: true },
                        el( TextControl, {
                            label: __( 'Heading', 'inf' ),
                            value: a.heading,
                            onChange: function ( v ) { set( { heading: v } ); }
                        } ),
                        el( TextareaControl, {
                            label: __( 'Intro', 'inf' ),
                            value: a.intro,
                            onChange: function ( v ) { set( { intro: v } ); }
                        } ),
                        el( TextControl, {
                            label: __( 'Limit', 'inf' ),
                            type: 'number',
                            min: 1,
                            value: a.limit,
                            onChange: function ( v ) { set( { limit: parseInt( v, 10 ) || 0 } ); }
                        } ),
                        el( TextControl, {
                            label: __( 'Category Term ID', 'inf' ),
                            help: __( '0 = all categories.', 'inf' ),
                            type: 'number',
                            min: 0,
                            value: a.category,
                            onChange: function ( v ) { set( { category: parseInt( v, 10 ) || 0 } ); }
                        } )
                    )
                ),
                el( ServerSideRender, {
                    block: 'pugpuggle/practice-areas-grid',
                    attributes: a
                } )
            );
        },
        save: function () { return null; }
    } );

}( window.wp ) );
