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
 * Webpack configuration. This is pulled into `index.js`.
 *
 * @since  1.0.0
 * @access public
 * @var    object
 */
module.exports = {

        // The entry point (input) Webpack will use to create your output. Add
        // any additional files to the object below. Note that we're using the
        // output folder and filename with extension as the property.
        // @link https://webpack.js.org/concepts/#entry
        entry : {

                // Scripts.
                'scripts/app.js'                : './resources/scripts/app/index.js',
                'scripts/customize-controls.js' : './resources/scripts/customize-controls/index.js',
                'scripts/customize-preview.js'  : './resources/scripts/customize-preview/index.js',

                // Styles.
                'styles/screen.css' : './resources/styles/screen.scss'
        },

        // The output is where you want your bundled  files to appear. The `path`
        // is the folder where all your files will be output. The `filename` is
        // the key from the `entry` object.
        // @link https://webpack.js.org/concepts/#output
        output : {
                path     :  path.resolve( __dirname, '../../dist' ),
                filename : '[name]'
        },

        // Custom settings.
        settings : {
                sourceMaps   : false,
                styleLint    : {},
                autoprefixer : {
                        browsers : [ 'last 2 versions', '> 1%' ],
                }
        }
};
