/**
 * Webpack configuration file.
 *
 * This file stores all the configuration for using Webpack with the theme. It
 * is imported into the other Webpack files to get the correct settings. This is
 * where theme authors might want to add any additional script/style/etc. files
 * that they want processed other than the defaults.
 *
 * @package   ABC
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright Copyright (c) 2018, Justin Tadlock
 * @link      https://themehybrid.com/themes/abc
 * @license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

// Import modules.
const path = require( 'path' );

/**
 * Common configuration.
 *
 * @since  1.0.0
 * @access public
 * @var    object
 */
var common = {
        root : path.resolve( __dirname, '../../' )
};

/**
 * JavaScript configuration. This is imported into the `scripts.js` build file
 * and used to bundle all of your theme's JavaScript.
 *
 * @since  1.0.0
 * @access public
 * @var    object
 */
var scripts = {

        // The entry point (input) Webpack will use to create your output. These
        // are your JavaScript files for the theme. Add any additional files to
        // the object below.
        // @link https://webpack.js.org/concepts/#entry
        entry : {
                'app'                : './resources/scripts/app/index.js',
                'customize-controls' : './resources/scripts/customize-controls/index.js',
                'customize-preview'  : './resources/scripts/customize-preview/index.js'
        },

        // The output is where you want your bundled JavaScript files to appear.
        // The `path` is the folder where all your files will be output. The
        // `filename` is the key from the `entry` object.
        // @link https://webpack.js.org/concepts/#output
        output : {
                path     : path.resolve( __dirname, '../../dist/scripts' ),
                filename : '[name].js'
        },

        // Custom settings for JavaScript handling.
        settings : {
                sourceMaps : false
        }
};

/**
 * Stylesheet configuration. This is imported into the `styles.js` build file
 * and used to bundle all of your theme's stylesheets.
 *
 * @since  1.0.0
 * @access public
 * @var    object
 */
var styles = {

        // The entry point (input) Webpack will use to create your output. These
        // are your stylesheet files for the theme. Add any additional files to
        // the object below.
        // @link https://webpack.js.org/concepts/#entry
        entry : {
                'screen' : './resources/styles/screen.scss'
        },

        // The output is where you want your bundled stylesheet files to appear.
        // The `path` is the folder where all your files will be output. The
        // `filename` is the key from the `entry` object.
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
};

// Export our modules.
module.exports = {
        common,
        scripts,
        styles
};
