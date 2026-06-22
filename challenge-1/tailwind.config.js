module.exports = {
    content: [
        './theme/**/*.php',
        './theme/**/*.js'
    ],
    theme: {
        fontFamily: {
        },
        extend: {
            colors: {
                // "The Dog House" brand palette (Airbnb-inspired, pug-approved).
                doghouse: '#FF5A5F',
                'doghouse-dark': '#E0484D',
                'doghouse-ink': '#222222',
                'doghouse-muted': '#717171',
                'doghouse-line': '#DDDDDD',
                'doghouse-bg': '#F7F7F7'
            },
            fontFamily: {
                brand: ['Circular', 'ui-sans-serif', 'system-ui', '-apple-system', 'Segoe UI', 'Roboto', 'Helvetica', 'Arial', 'sans-serif']
            },
            aspectRatio: {
                listing: '20 / 19'
            },
            zIndex: {
                '-10': '-10'
            },
            inset: {
                '1/2': '50%'
            },
            backgroundColor: {
                transparent: 'transparent'
            },
            margin: {
                '-18': '-4.5rem'
            },
            maxHeight: {
                96: '24rem'
            }
        }
    },
    variants: {},
    plugins: []
};
