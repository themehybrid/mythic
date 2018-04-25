// Import configuration.
const config = require( './config' );

// Import modules.
const path    = require( 'path'    );
const webpack = require( 'webpack' );

// Import plugins.
const BrowserSyncPlugin           = require( 'browser-sync-webpack-plugin'            );
const CleanWebpackPlugin          = require( 'clean-webpack-plugin'                   );
const CopyWebpackPlugin           = require( 'copy-webpack-plugin'                    );
const ExtraneousFileCleanupPlugin = require( 'webpack-extraneous-file-cleanup-plugin' );
const ImageminPlugin              = require( 'imagemin-webpack-plugin'                ).default;
const imageminMozjpeg             = require( 'imagemin-mozjpeg'                       );
const MiniCssExtractPlugin        = require( 'mini-css-extract-plugin'                );
const SimpleProgressWebpackPlugin = require( 'simple-progress-webpack-plugin'         );
const WebpackWatchedGlobEntries   = require( 'webpack-watched-glob-entries-plugin'    );

/**
 * Export our module for Webpack.
 *
 * @since  1.0.0
 * @access public
 * @return function
 */
module.exports = env => {

        return {
                // Set the mode based on whether we're in production or dev.
                mode : env.production ? 'production' : 'development',

                // Only generate source maps if we're in a dev environment.
                devtool : env.production ? undefined : 'source-maps',

                entry : WebpackWatchedGlobEntries.getEntries( config.entry ),

                output : {
                        path     : config.paths.dist,
                        filename : config.output.scripts.filename
                },

                // Console stats output.
                // @link https://webpack.js.org/configuration/stats/#stats
                stats : 'minimal',

                // External objects.
                externals : config.externals,

                // Resolve settings.
                resolve : config.resolve,

                // Performance settings.
                performance : {
                        hints : false
                },

                // Build rules to handle asset files.
                module : {
                        rules : [
                                // Scripts.
                                {
                                        test    : /\.js$/,
                                        exclude : /node_modules/,
                                        use     : {
                                                loader  : 'babel-loader',
                                                options : {
                                                        presets : [ '@babel/preset-env' ]
                                                }
                                        }
                                },

                                // Styles.
                                {
                                        test    : /\.s[ac]ss$/,
                                        include : config.paths.styles,
                                        use     : [
                                                MiniCssExtractPlugin.loader,
                                                {
                                                        loader  : 'css-loader',
                                                        options : {
                                                                sourceMap : ! env.production
                                                        }
                                                },
                                                {
                                                        loader : 'postcss-loader',
                                                        options : {
                                                                sourceMap : ! env.production,
                                                                config    : {
                                                                        path : './resources/build/postcss.config.js'
                                                                }
                                                        }
                                                },
                                                {
                                                        loader  : 'sass-loader',
                                                        options : {
                                                                sourceMap : ! env.production
                                                        }
                                                }
                                        ]
                                },

                                // Fonts.
                                {
                                        test    : /\.(eot|ttf|woff|woff2|svg)(\?\S*)?$/,
                                        include : config.paths.fonts,
                                        loader  : 'file-loader',
                                        options : {
                                                publicPath : config.paths.relative,
                                                name       : config.output.fonts.filename
                                        }
                                },

                                // Images.
                                {
                                        test      : /\.(png|jpe?g|gif|svg)$/,
                                        include   : config.paths.images,
                                        loader    : 'file-loader',
                                        options   : {
                                                context    : config.paths.images,
                                                publicPath : config.paths.relative,
                                                name       : config.output.images.filename,
                                                emitFile   : false
                                        }
                                }
                        ]
                },

                // Plugins.
                plugins : [

                        // Allow for globbed entries for easier config.
                        new WebpackWatchedGlobEntries(),

                        // Clean the `dist` folder on build.
                        //new CleanWebpackPlugin( config.paths.dist, { root : config.paths.root } ),

                        // Removes the extra JS file created when using Sass/CSS
                        // files for entries until this is fixed.
                        // @link https://github.com/webpack-contrib/extract-text-webpack-plugin/issues/518
                        new ExtraneousFileCleanupPlugin( {
                                extensions : [ '.js' ],
                                minBytes   : env.production ? 1024 : 3076
                        } ),

                        // Make a nicer output for builds.
                        new SimpleProgressWebpackPlugin( {
                                format : 'compact'
                        } ),

                        // Extract CSS into individual files.
                        new MiniCssExtractPlugin( {
                                filename : config.output.styles.filename
                        } ),

                        // Copy static assets to the `dist` folder.
                        new CopyWebpackPlugin( [ {
                                from    : '**/*.{jpg,jpeg,png,gif,svg,eot,ttf,woff,woff2}',
                                to      : config.output.static.filename,
                                context : config.paths.assets
                        } ] ),

                        // Minify and optimize image/SVG files.
			new ImageminPlugin( {
				test     : /\.(jpe?g|png|gif|svg)$/i,
				optipng  : {
                                        optimizationLevel : 3
                                },
				gifsicle : {
                                        optimizationLevel : 3
                                },
				pngquant : {
                                        quality : '65-90',
                                        speed   : 4
                                },
				svgo: {
					plugins: [
                                                { removeUnknownsAndDefaults : false },
                                                { cleanupIDs : false }
                                        ],
				},
				plugins: [
                                        imageminMozjpeg( { quality : 75 } )
                                ],
				disable: ! env.production
			} ),

                        // Run BrowserSync.
                        new BrowserSyncPlugin( config.settings.browserSync, {
                                // Prevent BrowserSync from reloading the page
                                // and let Webpack Dev Server take care of this.
                                reload : false
                        } )
                ]
        }
};
