module.exports = {
    content: [
        './theme/**/*.php',
        './theme/**/*.js'
    ],
    // Classes typed by editors in the Gutenberg "Additional CSS class" field live
    // in post_content (DB), which Tailwind's content scanner never reads. The
    // safelist below force-generates the common utility families so editors can
    // use them anywhere without touching theme files.
    safelist: [
        { pattern: /^(m|p)[trblxy]?-(auto|px|0|0\.5|1|1\.5|2|2\.5|3|3\.5|4|5|6|7|8|9|10|11|12|14|16|20|24|32|40|48|56|64)$/, variants: ['sm', 'md', 'lg', 'xl', '2xl'] },

        { pattern: /^(w|h)-(auto|full|screen|fit|min|max|0|px|1|2|3|4|5|6|8|10|12|16|20|24|32|40|48|56|64)$/, variants: ['sm', 'md', 'lg', 'xl', '2xl'] },
        { pattern: /^(min-w|min-h)-(0|full|fit|min|max|screen)$/, variants: ['sm', 'md', 'lg', 'xl', '2xl'] },
        { pattern: /^max-w-(none|xs|sm|md|lg|xl|2xl|3xl|4xl|5xl|6xl|7xl|full|prose|screen-sm|screen-md|screen-lg|screen-xl|screen-2xl)$/, variants: ['sm', 'md', 'lg', 'xl', '2xl'] },
        { pattern: /^max-h-(none|full|screen|0|px|1|2|4|8|12|16|24|32|40|48|56|64|96)$/, variants: ['sm', 'md', 'lg', 'xl', '2xl'] },

        { pattern: /^rounded(-(none|sm|md|lg|xl|2xl|3xl|full))?(-(t|b|l|r|tl|tr|bl|br))?$/, variants: ['sm', 'md', 'lg', 'xl', '2xl'] },

        { pattern: /^text-(xs|sm|base|lg|xl|2xl|3xl|4xl|5xl|6xl|7xl|left|center|right|justify)$/, variants: ['sm', 'md', 'lg', 'xl', '2xl'] },
        { pattern: /^font-(thin|light|normal|medium|semibold|bold|extrabold|black)$/, variants: ['sm', 'md', 'lg', 'xl', '2xl'] },
        { pattern: /^(leading|tracking)-(none|tight|snug|normal|relaxed|loose|wider|widest|wide)$/, variants: ['sm', 'md', 'lg', 'xl', '2xl'] },
        { pattern: /^(underline|no-underline|italic|not-italic|uppercase|lowercase|capitalize|normal-case)$/, variants: ['sm', 'md', 'lg', 'xl', '2xl'] },

        { pattern: /^(text|bg|border)-(white|black|transparent|current)$/, variants: ['sm', 'md', 'lg', 'xl', '2xl'] },
        { pattern: /^(text|bg|border)-(slate|gray|zinc|neutral|stone|red|orange|amber|yellow|lime|green|emerald|teal|cyan|sky|blue|indigo|violet|purple|fuchsia|pink|rose)-(50|100|200|300|400|500|600|700|800|900|950)$/, variants: ['sm', 'md', 'lg', 'xl', '2xl'] },

        { pattern: /^(block|inline-block|inline|flex|inline-flex|grid|inline-grid|hidden|table|table-cell)$/, variants: ['sm', 'md', 'lg', 'xl', '2xl'] },
        { pattern: /^(items|justify|content|self|place-items|place-content)-(start|end|center|between|around|evenly|stretch|baseline|auto)$/, variants: ['sm', 'md', 'lg', 'xl', '2xl'] },
        { pattern: /^flex-(row|row-reverse|col|col-reverse|wrap|nowrap|1|auto|initial|none)$/, variants: ['sm', 'md', 'lg', 'xl', '2xl'] },
        { pattern: /^(grid-cols|grid-rows|col-span|row-span)-(1|2|3|4|5|6|7|8|9|10|11|12|none|full)$/, variants: ['sm', 'md', 'lg', 'xl', '2xl'] },
        { pattern: /^gap(-(x|y))?-(0|0\.5|1|2|3|4|5|6|8|10|12|16|20|24)$/, variants: ['sm', 'md', 'lg', 'xl', '2xl'] },

        { pattern: /^border(-(0|2|4|8))?$/, variants: ['sm', 'md', 'lg', 'xl', '2xl'] },
        { pattern: /^shadow(-(sm|md|lg|xl|2xl|inner|none))?$/, variants: ['sm', 'md', 'lg', 'xl', '2xl'] },

        { pattern: /^(static|fixed|absolute|relative|sticky)$/, variants: ['sm', 'md', 'lg', 'xl', '2xl'] },
        { pattern: /^(top|bottom|left|right|inset)-(0|auto|full|1|2|4|6|8)$/, variants: ['sm', 'md', 'lg', 'xl', '2xl'] },
        { pattern: /^z-(0|10|20|30|40|50|auto)$/, variants: ['sm', 'md', 'lg', 'xl', '2xl'] },

        { pattern: /^opacity-(0|5|10|20|25|30|40|50|60|70|75|80|90|95|100)$/, variants: ['sm', 'md', 'lg', 'xl', '2xl'] },
        { pattern: /^overflow(-(x|y))?-(auto|hidden|visible|scroll)$/, variants: ['sm', 'md', 'lg', 'xl', '2xl'] },
    ],
    theme: {
        fontFamily: {
            sans: [
                '"Figtree"',
                'ui-sans-serif',
                'system-ui',
                '-apple-system',
                'BlinkMacSystemFont',
                '"Segoe UI"',
                'Roboto',
                '"Helvetica Neue"',
                'Arial',
                'sans-serif',
                '"Apple Color Emoji"',
                '"Segoe UI Emoji"',
                '"Segoe UI Symbol"',
                '"Noto Color Emoji"'
            ]
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
            }
        }
    },
    variants: {},
    plugins: []
};
