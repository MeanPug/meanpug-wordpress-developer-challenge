module.exports = {
    content: [
        './theme/**/*.php',
        './theme/**/*.js'
    ],
    theme: {
        fontFamily: {
            'airbnb': ['Circular', '-apple-system', 'BlinkMacSystemFont', 'Roboto', 'Helvetica Neue', 'sans-serif'],
        },
        extend: {
            colors: {
                'airbnb-pink': '#FF385C',
                'airbnb-dark': '#222222',
                'airbnb-gray': '#717171',
                'airbnb-light': '#F7F7F7',
                'airbnb-border': '#DDDDDD',
            },
            borderRadius: {
                'airbnb': '12px',
                'airbnb-lg': '16px',
                'airbnb-xl': '24px',
            },
            boxShadow: {
                'airbnb': '0 1px 2px rgba(0,0,0,0.08), 0 4px 12px rgba(0,0,0,0.05)',
                'airbnb-hover': '0 2px 4px rgba(0,0,0,0.08), 0 4px 12px rgba(0,0,0,0.08)',
                'airbnb-card': '0 6px 20px rgba(0,0,0,0.2)',
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
