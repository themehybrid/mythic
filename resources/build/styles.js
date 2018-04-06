/**
 * Webpack file for stylesheet assets.
 */

// Import modules.
const config            = require( './config' );
const path              = require( 'path' );
const ExtractTextPlugin = require( 'extract-text-webpack-plugin');

module.exports = {

        mode : 'production',

        entry : config.styles,

        output : {
                path     : config.paths.output.styles,
                filename : config.filenames.styles
        },

        module : {
                rules : [
                        {
                                test: /\.scss$/,
                                use : ExtractTextPlugin.extract( {
                                        use: [
                                                { loader : 'css-loader' },
                                                { loader : 'postcss-loader' },
                                                { loader : 'sass-loader' }
                                        ]
                                } )
                        }
                ]
        },

        plugins : [
                new ExtractTextPlugin( config.filenames.styles )
        ]
};
