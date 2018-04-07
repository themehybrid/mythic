/**
 * Webpack file for JavaScript assets.
 */

// Import modules.
const config = require( './config' );
const path   = require( 'path' );

// Scripts config.
const scripts = config.scripts;

// Export our module for Webpack.
module.exports = {

        mode : 'production',

        entry : scripts.entry,

        output : {
                path     : scripts.output.path,
                filename : scripts.output.filename
        },

        module : {
                rules : [
                        {
                                test    : /\.js$/,
                                exclude : /(node_modules|bower_components)/,
                                use     : {
                                        loader  : 'babel-loader',
                                        options : {
                                                presets: [ '@babel/preset-env' ]
                                        }
                                }
                        }
                ]
        },

        plugins : []
};
