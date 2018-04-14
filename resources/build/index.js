// Import scripts configuration.
const config = require( './config' );

// Import modules.
const path  = require( 'path' );
const ExtractTextPlugin = require( 'extract-text-webpack-plugin');

// Export our module for Webpack.
module.exports = {

        mode : 'production',

        entry : config.entry,

        output : {
                path     : config.output.path,
                filename : config.output.filename
        },

        module : {
                rules : [
                        {
                                test    : /\.js$/,
                                exclude : /node_modules/,
                                use     : {
                                        loader  : 'babel-loader',
                                        options : {
                                                presets: [ '@babel/preset-env' ]
                                        }
                                },
                        },
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
                new ExtractTextPlugin( config.output.filename )
        ]
};
