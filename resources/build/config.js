/**
 * Webpack configuration file.
 *
 * This file stores all the configuration for using Webpack with the theme. It
 * is imported into the other Webpack files to get the correct settings.
 */

// Import modules.
const path = require( 'path' );

// Export the settings.
module.exports = {

        // Paths to the folders in our projects. These shouldn't be changed
        // unless you're changing the directory structure of where the theme
        // stores its assets.
        paths : {
                // Project root path. This points to the theme root.
                root   : path.resolve( __dirname, '../../' ),

                // Input paths. These are the paths to our uncompiled resources
                // that we use in development.
                input  : {
                        scripts : path.resolve( __dirname, '../../resources/scripts' ),
                        styles  : path.resolve( __dirname, '../../resources/styles'  ),
                },

                // Output paths. These are the paths to our compiled resources
                // that we use in production.
                output : {
                        scripts : path.resolve( __dirname, '../../dist/scripts' ),
                        styles  : path.resolve( __dirname, '../../dist/styles'  )
                }
        },

        // Configure your scripts. You can make modifications to this object to
        // point to additional scripts or to remove those that you don't need.
        scripts : {
                'app'                : './resources/scripts/app/index.js',
                'customize-controls' : './resources/scripts/customize-controls/index.js',
                'customize-preview'  : './resources/scripts/customize-preview/index.js'
        },

        // Configure your styles. You can make modifications to this object to
        // point to additional styles or to remove those that you don't need.
        styles : {
                'screen' : './resources/styles/screen.scss'
        },

        // How the filenames should look on output. This should probably be left
        // to the settings below unless you want to use a different structure,
        // such as `[name].min.[ext]`, for example.
        filenames : {
                scripts : '[name].js',
                styles  : '[name].css'
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
