/**
 * Webpack file for stylesheet assets.
 */

 // Import styles configuration.
 const { styles } = require( './config' );

// Import modules
const path              = require( 'path' );
const ExtractTextPlugin = require( 'extract-text-webpack-plugin');

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
