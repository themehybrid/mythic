module.exports = {
        parser : 'postcss-scss',
        plugins : {
                'postcss-import'  : {},
                'postcss-cssnext' : {},
                'cssnano'         : {
                        // postcss-cssnext already does autoprefixer.
                        autoprefixer: false
                }
        }
}
