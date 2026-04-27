module.exports = {
  content: ['./theme/**/*.php', './theme/**/*.js'],
  theme: {
    fontFamily: {
      sans: [
        'Nunito',
        'Circular',
        '-apple-system',
        'BlinkMacSystemFont',
        '"Segoe UI"',
        'Roboto',
        'sans-serif'
      ]
    },
    extend: {
      colors: {
        'airbnb-pink': '#FF385C',
        'airbnb-pink-dark': '#E61E4D',
        'airbnb-text': '#222222',
        'airbnb-muted': '#717171',
        'airbnb-border': '#ebebeb',
        'airbnb-soft': '#f7f7f7'
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
      },
      maxWidth: {
        'screen-3xl': '1500px'
      }
    }
  },
  variants: {},
  plugins: []
};
