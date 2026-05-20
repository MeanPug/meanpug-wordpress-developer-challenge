( function ( wp ) {
    'use strict';

    var el = wp.element.createElement;
    var Fragment = wp.element.Fragment;
    var InspectorControls = wp.blockEditor.InspectorControls;
    var PanelBody = wp.components.PanelBody;
    var TextControl = wp.components.TextControl;
    var ServerSideRender = wp.serverSideRender;
    var __ = wp.i18n.__;

    wp.blocks.registerBlockType( 'pugpuggle/office-map', {
        edit: function ( props ) {
            var a = props.attributes;
            var set = props.setAttributes;
            return el( Fragment, null,
                el( InspectorControls, null,
                    el( PanelBody, { title: __( 'Office Map', 'inf' ), initialOpen: true },
                        el( TextControl, {
                            label: __( 'Heading', 'inf' ),
                            value: a.heading,
                            onChange: function ( v ) { set( { heading: v } ); }
                        } )
                    )
                ),
                el( ServerSideRender, {
                    block: 'pugpuggle/office-map',
                    attributes: a
                } )
            );
        },
        save: function () { return null; }
    } );

}( window.wp ) );
