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
                airbnb: '#FF385C',
                'airbnb-dark': '#C1143F',
                'airbnb-btn': '#DE1E4F',
                'banner-bg': '#F2F2F2',
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
