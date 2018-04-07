/**
 * Webpack configuration file.
 *
 * This file stores all the configuration for using Webpack with the theme. It
 * is imported into the other Webpack files to get the correct settings.
 */

// Import modules.
const path = require( 'path' );

// Export the configuration module.
//
// @todo Once node natively supports ES6+ `import` and `export`, wrap each object
// into its own module.
module.exports = {

        // Common configuration module.
        common : {
                root : path.resolve( __dirname, '../../' ),
        },

        // JavaScript configuration. This is imported into the `scripts.js` build
        // file and used to bundle all of your theme's JavaScript.
        scripts : {

                // The entry point (input) Webpack will use to create your output.
                // These are your JavaScript files for the theme. Add any
                // additional files to the object below.
                // @link https://webpack.js.org/concepts/#entry
                entry : {
                        'app'                : './resources/scripts/app/index.js',
                        'customize-controls' : './resources/scripts/customize-controls/index.js',
                        'customize-preview'  : './resources/scripts/customize-preview/index.js'
                },

                // The output is where you want your bundled JavaScript files to
                // appear. The `path` is the folder where all your files will be
                // output. The `filename` is the key from the `entry` object.
                // @link https://webpack.js.org/concepts/#output
                output : {
                        path     : path.resolve( __dirname, '../../dist/scripts' ),
                        filename : '[name].js'
                },

                // Custom settings for JavaScript handling.
                settings : {
                        sourceMaps : false
                }
        },

        // Stylesheet configuration. This is imported into the `styles.js` build
        // file and used to bundle all of your theme's stylesheets.
        styles : {

                // The entry point (input) Webpack will use to create your output.
                // These are your stylesheet files for the theme. Add any
                // additional files to the object below.
                // @link https://webpack.js.org/concepts/#entry
                entry : {
                        'screen' : './resources/styles/screen.scss'
                },

                // The output is where you want your bundled stylesheet files to
                // appear. The `path` is the folder where all your files will be
                // output. The `filename` is the key from the `entry` object.
                // @link https://webpack.js.org/concepts/#output
                output : {
                        path     : path.resolve( __dirname, '../../dist/styles' ),
                        filename : '[name].css'
                },

                // Custom settings for stylesheet handling.
                settings : {
                        sourceMaps   : false,
                        styleLint    : {},
                        autoprefixer : {
                                browsers : [ 'last 2 versions', '> 1%' ],
                        }
                }
        }
};
