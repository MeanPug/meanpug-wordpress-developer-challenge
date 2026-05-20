( function ( wp ) {
    'use strict';

    var el = wp.element.createElement;
    var Fragment = wp.element.Fragment;
    var InspectorControls = wp.blockEditor.InspectorControls;
    var PanelBody = wp.components.PanelBody;
    var TextControl = wp.components.TextControl;
    var TextareaControl = wp.components.TextareaControl;
    var Button = wp.components.Button;
    var ServerSideRender = wp.serverSideRender;
    var __ = wp.i18n.__;

    function updateStat( stats, index, key, value ) {
        var copy = stats.map( function ( s ) { return Object.assign( {}, s ); } );
        copy[ index ][ key ] = value;
        return copy;
    }
    function removeStat( stats, index ) {
        return stats.filter( function ( _, i ) { return i !== index; } );
    }
    function addStat( stats ) {
        return stats.concat( [ { value: '', label: '', description: '' } ] );
    }

    wp.blocks.registerBlockType( 'pugpuggle/stats-counter', {
        edit: function ( props ) {
            var a = props.attributes;
            var set = props.setAttributes;
            var stats = Array.isArray( a.stats ) ? a.stats : [];

            var rows = stats.map( function ( stat, i ) {
                return el( PanelBody, { key: i, title: __( 'Stat', 'inf' ) + ' #' + ( i + 1 ), initialOpen: false },
                    el( TextControl, {
                        label: __( 'Value', 'inf' ),
                        value: stat.value || '',
                        onChange: function ( v ) { set( { stats: updateStat( stats, i, 'value', v ) } ); }
                    } ),
                    el( TextControl, {
                        label: __( 'Label', 'inf' ),
                        value: stat.label || '',
                        onChange: function ( v ) { set( { stats: updateStat( stats, i, 'label', v ) } ); }
                    } ),
                    el( TextareaControl, {
                        label: __( 'Description', 'inf' ),
                        value: stat.description || '',
                        onChange: function ( v ) { set( { stats: updateStat( stats, i, 'description', v ) } ); }
                    } ),
                    el( Button, {
                        variant: 'link',
                        isDestructive: true,
                        onClick: function () { set( { stats: removeStat( stats, i ) } ); }
                    }, __( 'Remove stat', 'inf' ) )
                );
            } );

            return el( Fragment, null,
                el( InspectorControls, null,
                    el( PanelBody, { title: __( 'Stats Counter', 'inf' ), initialOpen: true },
                        el( TextControl, {
                            label: __( 'Heading', 'inf' ),
                            value: a.heading,
                            onChange: function ( v ) { set( { heading: v } ); }
                        } )
                    ),
                    rows,
                    el( PanelBody, { title: __( 'Add', 'inf' ), initialOpen: false },
                        el( Button, {
                            variant: 'primary',
                            onClick: function () { set( { stats: addStat( stats ) } ); }
                        }, __( 'Add stat', 'inf' ) )
                    )
                ),
                el( ServerSideRender, {
                    block: 'pugpuggle/stats-counter',
                    attributes: a
                } )
            );
        },
        save: function () { return null; }
    } );

}( window.wp ) );
