/**
 * Editor script for the airpnp/listing-cards block.
 *
 * Renders a client-side skeleton grid in the editor that mirrors the
 * frontend layout. Card count tracks the `limit` attribute live, with
 * no backend roundtrip. Inline styles intentionally — front-page.css
 * (where the Tailwind utilities live) is gated on is_front_page() and
 * is not loaded in the editor.
 *
 * Written without JSX so it runs through the existing @babel/preset-env
 * Gulp pipeline without needing @babel/preset-react.
 *
 * @package Airpnp
 */
(function (blocks, element, blockEditor, components, i18n) {
    var el = element.createElement;
    var Fragment = element.Fragment;
    var __ = i18n.__;
    var useBlockProps = blockEditor.useBlockProps;
    var InspectorControls = blockEditor.InspectorControls;
    var PanelBody = components.PanelBody;
    var RangeControl = components.RangeControl;

    var FALLBACK_PALETTE = ['#FDE68A', '#6EE7B7', '#D6D3D1'];

    function renderSkeletonCard(index) {
        var bg = FALLBACK_PALETTE[index % FALLBACK_PALETTE.length];

        return el(
            'article',
            {
                key: 'airpnp-skeleton-card-' + index,
                className: 'airpnp-listings-skeleton-card',
                style: { display: 'block' }
            },
            el(
                'div',
                {
                    style: {
                        position: 'relative',
                        aspectRatio: '4 / 3',
                        borderRadius: '0.75rem',
                        overflow: 'hidden',
                        background: bg
                    }
                },
                el(
                    'span',
                    {
                        'aria-hidden': 'true',
                        style: {
                            position: 'absolute',
                            top: '0.75rem',
                            left: '0.75rem',
                            background: '#ffffff',
                            color: '#1c1917',
                            fontSize: '0.65rem',
                            fontWeight: 700,
                            textTransform: 'uppercase',
                            letterSpacing: '0.05em',
                            padding: '0.25rem 0.5rem',
                            borderRadius: '0.25rem'
                        }
                    },
                    __('New', 'inf')
                )
            ),
            el('div', {
                style: {
                    marginTop: '0.75rem',
                    height: '12px',
                    width: '60%',
                    background: '#E7E5E4',
                    borderRadius: '4px'
                }
            }),
            el('div', {
                style: {
                    marginTop: '0.5rem',
                    height: '10px',
                    width: '35%',
                    background: '#F5F5F4',
                    borderRadius: '4px'
                }
            })
        );
    }

    blocks.registerBlockType('airpnp/listing-cards', {
        edit: function (props) {
            var attributes = props.attributes;
            var setAttributes = props.setAttributes;
            var limit = Math.max(1, Math.min(12, parseInt(attributes.limit, 10) || 3));
            var blockProps = useBlockProps();

            var cards = [];
            for (var i = 0; i < limit; i++) {
                cards.push(renderSkeletonCard(i));
            }

            return el(
                Fragment,
                null,
                el(
                    InspectorControls,
                    null,
                    el(
                        PanelBody,
                        { title: __('Layout', 'inf') },
                        el(RangeControl, {
                            label: __('Number of cards', 'inf'),
                            value: attributes.limit,
                            min: 1,
                            max: 12,
                            onChange: function (v) { setAttributes({ limit: v }); }
                        })
                    )
                ),
                el(
                    'div',
                    blockProps,
                    el(
                        'section',
                        {
                            'aria-label': __('Featured stays (preview)', 'inf'),
                            style: {
                                maxWidth: '80rem',
                                margin: '0 auto',
                                padding: '1.5rem 0'
                            }
                        },
                        el(
                            'div',
                            {
                                style: {
                                    display: 'grid',
                                    gridTemplateColumns: 'repeat(auto-fit, minmax(220px, 1fr))',
                                    gap: '1.5rem'
                                }
                            },
                            cards
                        )
                    )
                )
            );
        },

        save: function () {
            // Server-rendered via render.php — return null so save() emits no markup.
            return null;
        }
    });
})(
    window.wp.blocks,
    window.wp.element,
    window.wp.blockEditor,
    window.wp.components,
    window.wp.i18n
);
