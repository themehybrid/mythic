/**
 * Webpack configuration file.
 *
 * This file stores all the configuration for using Webpack with the theme. It
 * is imported into the other Webpack files to get the correct settings. This is
 * where theme authors might want to add any additional settings.
 *
 * @package   ABC
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright Copyright (c) 2018, Justin Tadlock
 * @link      https://themehybrid.com/themes/abc
 * @license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

const path = require('path');

/**
 * Webpack configuration. This is pulled into `webpack.config.js`.
 *
 * @since  1.0.0
 * @access public
 * @var    object
 */
module.exports = {

        // Project paths.
        paths : {
                root     : path.resolve( __dirname, '../../'     ),
                dist     : path.resolve( __dirname, '../../dist' ),
                assets   : path.resolve( __dirname, '../'        ),
                fonts    : path.resolve( __dirname, '../fonts'   ),
                images   : path.resolve( __dirname, '../img'     ),
                svg      : path.resolve( __dirname, '../svg'     ),
                scripts  : path.resolve( __dirname, '../scripts' ),
                styles   : path.resolve( __dirname, '../styles'  ),
                relative : '../'
        },

        // The entry point (input) Webpack will use to create your output. Add
        // any additional entries to the object below.
        // @link https://webpack.js.org/concepts/#entry
        entry : [

                // Scripts.
                './resources/scripts/*.js',

                // Styles.
                './resources/styles/*.scss'
        ],

        // The output is where you want your bundled  files to appear.
        // @link https://webpack.js.org/concepts/#output
        output : {
                fonts   : { filename : 'fonts/[path][name].[ext]' },
                images  : { filename : 'img/[path][name].[ext]'   },
                svg     : { filename : 'svg/[path][name].[ext]'   },
                scripts : { filename : 'scripts/[name].js'        },
                styles  : { filename : 'styles/[name].css'        },
                static  : { filename : '[path][name].[ext]'       }
        },

        // List of libraries which will be provided within application scripts
        // as external.
        // @link https://webpack.js.org/configuration/externals/
        externals : {
                jquery : 'jQuery'
        },

        // Custom settings for other build features.
        settings : {
                sourceMaps : true,
                styleLint  : {},
                browserSync : {
                        host        : 'localhost',
                        port        : 3000,
                        proxy       : 'http://development.test',
                        open        : false,
                        reloadDelay : 500,
                        files       : [
                                '*.php',
                                'app/**/*.php',
                                'resources/views/**/*.php',
                                'resources/scripts/**/*.js',
                                'resources/styles/**/*.{sass,scss}',
                                'resources/img/**/*.{jpg,jpeg,png,gif}',
                                'resources/svg/**/*.svg',
                                'resources/fonts/**/*.{eot,ttf,woff,woff2,svg}'
                        ]
                }
        }
};
