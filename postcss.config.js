export default {
    plugins: {
        'postcss-rtlcss': {
            rtl: 'rtl',
            ltr: 'ltr',
            dirSelector: '[dir]',
            safeBothPrefix: true
        }
    }
};
