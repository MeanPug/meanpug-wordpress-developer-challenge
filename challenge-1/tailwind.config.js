module.exports = {
    content: [
        './theme/**/*.php',
        './theme/**/*.js'
    ],
    theme: {
        fontFamily: {
        },
        extend: {
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
            },
             maxWidth: {
                'screen-3xl': '1760px',
            },
            colors: {
                'airbnb-pink': '#FF385C',
                'airbnb-pink-dark': '#E31C5F',
                'airbnb-text': '#222222',
                'airbnb-muted': '#717171',
                'airbnb-soft': '#F7F7F7',
                'airbnb-border': '#DDDDDD',
            }
        }
    },
    variants: {},
    plugins: []
};
