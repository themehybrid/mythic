/**
 * Exports the PostCSS configuration.
 */
module.exports = ( { file, options, env } ) => ( {
        plugins : {
                'postcss-import' : {},
                'postcss-cssnext' : {},
                'autoprefixer'    : env === 'production',
                'cssnano'         : env === 'production'
        }
} );
