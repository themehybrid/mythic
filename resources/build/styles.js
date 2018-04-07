/**
 * Webpack file for stylesheet assets.
 */

// Import modules
const config            = require( './config' );
const path              = require( 'path' );
const ExtractTextPlugin = require( 'extract-text-webpack-plugin');

// Styles config.
const styles = config.styles;

// Export our module for Webpack.
module.exports = {

        mode : 'production',

        entry : styles.entry,

        output : {
                path     : styles.output.path,
                filename : styles.output.filename
        },

        module : {
                rules : [
                        {
                                test : /\.s[ac]ss$/,
                                use  : ExtractTextPlugin.extract( {
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
                new ExtractTextPlugin( styles.output.filename )
        ]
};
