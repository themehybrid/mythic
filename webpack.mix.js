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

// Set the BrowserSync proxy URL.
const browserSyncUrl = 'theme-development.localhost';

// SASS and CSS configuration.
var sassConfig = {
	outputStyle : 'expanded',
	indentType  : 'tab',
	indentWidth : 1
};

var cssConfig = {
	postCss        : [ require( 'postcss-preset-env' )() ],
	processCssUrls : false
};

// Sets the path to the generated assets. By default, this is the `/dist` folder
// in the theme. If doing something custom, make sure to change this everywhere.
mix.setPublicPath( 'dist' );

// Compile JavaScript.
mix.js( 'resources/scripts/app.js',                'scripts' ).sourceMaps();
mix.js( 'resources/scripts/customize-controls.js', 'scripts' ).sourceMaps();
mix.js( 'resources/scripts/customize-preview.js',  'scripts' ).sourceMaps();

// Compile SASS/CSS.
mix.sass( 'resources/styles/screen.scss', 'styles', sassConfig ).sourceMaps().options( cssConfig );

// Generate a manifest file for cache busting.
// Append a unique hash for production only assets.
if ( mix.inProduction() ) {
	mix.version();
}

// Add custom Webpack configuration.
//
// Laravel Mix doesn't currently have a built-in method for minimizing images,
// so we're going to use the `CopyWebpackPlugin` instead of `.copy()` for
// processing and copying our images over to their distribution folder.
mix.webpackConfig( {

	stats       : 'minimal',
	performance : { hints: false },
	// Prevent certain dependencies being included in bundles.
	// @link https://webpack.js.org/configuration/externals/#externals
	externals   : { jquery : 'jQuery' },
	plugins     : [
		new CopyWebpackPlugin( [
			{ from : 'resources/img',   to : 'img' },
			{ from : 'resources/svg',   to : 'svg' },
			{ from : 'resources/fonts', to : 'fonts' }
		] ),
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
			plugins : [ imageminMozjpeg( { quality : 75 } ) ]
		} )
	]
} );

// Monitor files for changes and inject your changes into the browser.
mix.browserSync( {
	proxy : browserSyncUrl,
	files : [
		"**/*.{jpg,jpeg,png,gif,svg,eot,ttf,woff,woff2}",
		"resources/views/**/*.php",
		"app/**/*.php"
	]
} );

// Disable processing asset URLs in Sass files.
mix.options( { processCssUrls : false } );
