/**
 * Webpack file for JavaScript assets.
 */

// Import modules.
const config = require( './config' );
const path   = require( 'path' );
const clean  = require( 'clean-webpack-plugin' );

module.exports = {

        mode : 'production',

        entry : config.scripts,

        output : {
                path     : config.paths.output.scripts,
                filename : config.filenames.scripts
        },

        module : {
                rules : [
                        {
                                test : /\.js$/,
                                loader : [ 'babel-loader' ]
                        }
                ]
        },

        plugins : [
                new clean( config.paths.output.scripts, {
                        root : config.paths.root
                } )
        ]
};
