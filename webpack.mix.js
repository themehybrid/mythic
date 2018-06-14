/**
 * Laravel Mix configuration file.
 *
 * This file stores all the configuration for using Laravel Mix as our primary
 * build tool for the theme. Laravel Mix is a layer built on top of Webpack that
 * simplifies much of the complexity of Webpack's configuration, and is well
 * suited for projects like WordPress themes.
 *
 * @link https://laravel.com/docs/5.6/mix
 *
 * @package   ABC
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright Copyright (c) 2018, Justin Tadlock
 * @link      https://themehybrid.com/themes/abc
 * @license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

// Import required packages.
const { mix }           = require( 'laravel-mix' );
const ImageminPlugin    = require( 'imagemin-webpack-plugin' ).default;
const CopyWebpackPlugin = require( 'copy-webpack-plugin' );
const imageminMozjpeg   = require( 'imagemin-mozjpeg' );

// Sets the path to the generated assets. By default, this is the `/dist` folder
// in the theme. If doing something custom, make sure to change this everywhere.
mix.setPublicPath( 'dist' );

// Set Laravel Mix options.
//
// @link https://laravel.com/docs/5.6/mix#postcss
// @link https://laravel.com/docs/5.6/mix#url-processing
mix.options( {
	postCss        : [ require( 'postcss-preset-env' )() ],
	processCssUrls : false
} );

// Builds sources maps for assets.
//
// @link https://laravel.com/docs/5.6/mix#css-source-maps
mix.sourceMaps();

// Versioning and cache busting. Append a unique hash for production assets.
//
// @link https://laravel.com/docs/5.6/mix#versioning-and-cache-busting
if ( mix.inProduction() ) {
	mix.version();
}

// Compile JavaScript.
//
// @link https://laravel.com/docs/5.6/mix#working-with-scripts
mix.js( 'resources/scripts/app.js',                'scripts' )
   .js( 'resources/scripts/customize-controls.js', 'scripts' )
   .js( 'resources/scripts/customize-preview.js',  'scripts' )

// Compile SASS and CSS.
//
// @link https://laravel.com/docs/5.6/mix#working-with-stylesheets
// @link https://laravel.com/docs/5.6/mix#sass
// @link https://github.com/sass/node-sass#options

// Sass configuration.
var sassConfig = {
	outputStyle : 'expanded',
	indentType  : 'tab',
	indentWidth : 8
};

// Compile SASS/CSS.
mix.sass( 'resources/styles/screen.scss', 'styles', sassConfig );

// Add custom Webpack configuration.
//
// Laravel Mix doesn't currently have a built-in method for minimizing images,
// so we're going to use the `CopyWebpackPlugin` instead of `.copy()` for
// processing and copying our images over to their distribution folder.
//
// @link https://laravel.com/docs/5.6/mix#custom-webpack-configuration
mix.webpackConfig( {
	stats       : 'minimal',
	performance : { hints  : false    },
	externals   : { jquery : 'jQuery' },
	plugins     : [
		// @link https://github.com/webpack-contrib/copy-webpack-plugin
		new CopyWebpackPlugin( [
			{ from : 'resources/img',   to : 'img' },
			{ from : 'resources/svg',   to : 'svg' },
			{ from : 'resources/fonts', to : 'fonts' }
		] ),
		// @link https://github.com/Klathmon/imagemin-webpack-plugin
		new ImageminPlugin( {
			test     : /\.(jpe?g|png|gif|svg)$/i,
			disable  : process.env.NODE_ENV !== 'production',
			optipng  : { optimizationLevel : 3 },
			gifsicle : { optimizationLevel : 3 },
			pngquant : {
				quality : '65-90',
				speed   : 4
			},
			svgo : {
				plugins : [
					{ removeUnknownsAndDefaults : false },
					{ cleanupIDs : false },
					{ removeViewBox : false }
				]
			},
			plugins : [
				// @link https://github.com/imagemin/imagemin-mozjpeg
				imageminMozjpeg( { quality : 75 } )
			]
		} )
	]
} );

// Monitor files for changes and inject your changes into the browser.
//
// @link https://laravel.com/docs/5.6/mix#browsersync-reloading
mix.browserSync( {
	proxy : 'theme-development.localhost',
	files : [
		"**/*.{jpg,jpeg,png,gif,svg,eot,ttf,woff,woff2}",
		"resources/views/**/*.php",
		"app/**/*.php"
	]
} );
