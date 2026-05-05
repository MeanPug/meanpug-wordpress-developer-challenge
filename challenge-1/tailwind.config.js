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
                'airbnb-pink': '#FF385C',
                'airbnb-dark': '#222222',
                'airbnb-gray': '#717171',
                'airbnb-light': '#F7F7F7',
                'airbnb-border': '#DDDDDD',
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
