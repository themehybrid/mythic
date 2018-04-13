/**
 * Webpack file for JavaScript assets.
 */

// Import scripts configuration.
const { scripts } = require( './config' );

// Import modules.
const path = require( 'path' );

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
