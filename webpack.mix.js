/**
 * Laravel Mix configuration file.
 *
 * Laravel Mix is a layer built on top of WordPress that simplifies much of the
 * complexity of building out a Webpack configuration file. Use this file to
 * configure how your assets are handled in the build process.
 *
 * @link https://laravel.com/docs/5.6/mix
 *
 * @package   Mythic
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright Copyright (c) 2018, Justin Tadlock
 * @link      https://themehybrid.com/themes/mythic
 * @license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

// Import required packages.
const { mix }           = require( 'laravel-mix' );
const ImageminPlugin    = require( 'imagemin-webpack-plugin' ).default;
const CopyWebpackPlugin = require( 'copy-webpack-plugin' );
const imageminMozjpeg   = require( 'imagemin-mozjpeg' );
const rimraf            = require( 'rimraf' );

/*
 * -----------------------------------------------------------------------------
 * Theme Bundle Process
 * -----------------------------------------------------------------------------
 * Creates a bundle of the production-ready theme with only the files and
 * folders needed for uploading to a site or zipping. Edit the `files` or
 * `folders` variables if you need to change something.
 * -----------------------------------------------------------------------------
 */

if ( process.env.bundle ) {

	// Folder name to bundle the files in.
	let bundlePath = 'mythic';

	// Theme root-level files to include.
	let files = [
		'style.css',
		'functions.php',
		'index.php',
		'license.md',
		'readme.md',
		'screenshot.png'
	];

	// Folders to include.
	let folders = [
		'app',
		'dist',
		'resources/lang',
	//	'resources/js',      // Required for WordPress.org.
	//	'resources/scss',    // Required for WordPress.org.
		'resources/views',
		'vendor'
	];

	// Delete the previous bundle to start clean.
	rimraf.sync( bundlePath );

	// Loop through the root files and copy them over.
	files.forEach( file => {
		mix.copy( file, `${bundlePath}/${file}` );
	} );

	// Loop through the folders and copy them over.
	folders.forEach( folder => {
		mix.copyDirectory( folder, `${bundlePath}/${folder}` );
	} );

	// Bail early because we don't need to do anything else after this point.
	// Everything else following below is for the build process.
	return;
}

/*
 * -----------------------------------------------------------------------------
 * Build Process
 * -----------------------------------------------------------------------------
 * The section below handles processing, compiling, transpiling, and combining
 * all of the theme's assets into their final location. This is the meat of the
 * build process.
 * -----------------------------------------------------------------------------
 */

/*
 * Sets the development path to assets. By default, this is the `/resources`
 * folder in the theme.
 */
const devPath  = 'resources';

/*
 * Sets the path to the generated assets. By default, this is the `/dist` folder
 * in the theme. If doing something custom, make sure to change this everywhere.
 */
mix.setPublicPath( 'dist' );

/*
 * Set Laravel Mix options.
 *
 * @link https://laravel.com/docs/5.6/mix#postcss
 * @link https://laravel.com/docs/5.6/mix#url-processing
 */
mix.options( {
	postCss        : [ require( 'postcss-preset-env' )() ],
	processCssUrls : false
} );

/*
 * Builds sources maps for assets.
 *
 * @link https://laravel.com/docs/5.6/mix#css-source-maps
 */
mix.sourceMaps();

/*
 * Versioning and cache busting. Append a unique hash for production assets. If
 * you only want versioned assets in production, do a conditional check for
 * `mix.inProduction()`.
 *
 * @link https://laravel.com/docs/5.6/mix#versioning-and-cache-busting
 */
mix.version();

/*
 * Compile JavaScript.
 *
 * @link https://laravel.com/docs/5.6/mix#working-with-scripts
 */
mix.js( `${devPath}/js/app.js`,                'js' )
   .js( `${devPath}/js/customize-controls.js`, 'js' )
   .js( `${devPath}/js/customize-preview.js`,  'js' );

/*
 * Compile CSS. Mix supports Sass, Less, Stylus, and plain CSS, and has functions
 * for each of them.
 *
 * @link https://laravel.com/docs/5.6/mix#working-with-stylesheets
 * @link https://laravel.com/docs/5.6/mix#sass
 * @link https://github.com/sass/node-sass#options
 */

// Sass configuration.
var sassConfig = {
	outputStyle : 'expanded',
	indentType  : 'tab',
	indentWidth : 1
};

// Compile SASS/CSS.
mix.sass( `${devPath}/scss/screen.scss`,             'css', sassConfig )
   .sass( `${devPath}/scss/editor.scss`,             'css', sassConfig )
   .sass( `${devPath}/scss/customize-controls.scss`, 'css', sassConfig );

/*
 * Add custom Webpack configuration.
 *
 * Laravel Mix doesn't currently minimize images while using its `.copy()`
 * function, so we're using the `CopyWebpackPlugin` for processing and copying
 * images into the distribution folder.
 *
 * @link https://laravel.com/docs/5.6/mix#custom-webpack-configuration
 * @link https://webpack.js.org/configuration/
 */
mix.webpackConfig( {
	stats       : 'minimal',
	devtool     : mix.inProduction() ? false : 'source-map',
	performance : { hints  : false    },
	externals   : { jquery : 'jQuery' },
	resolve     : {
		alias : {
			// Alias for Hybrid Core assets.
			// Import from `hybrid/js` or `~hybrid/scss`.
			hybrid : path.resolve( __dirname, 'vendor/justintadlock/hybrid-core/src/resources/' )
		}
	},
	plugins     : [
		// @link https://github.com/webpack-contrib/copy-webpack-plugin
		new CopyWebpackPlugin( [
			{ from : `${devPath}/img`,   to : 'img'   },
			{ from : `${devPath}/svg`,   to : 'svg'   },
			{ from : `${devPath}/fonts`, to : 'fonts' }
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
					{ cleanupIDs                : false },
					{ removeViewBox             : false },
					{ removeUnknownsAndDefaults : false }
				]
			},
			plugins : [
				// @link https://github.com/imagemin/imagemin-mozjpeg
				imageminMozjpeg( { quality : 75 } )
			]
		} )
	]
} );

/*
 * Monitor files for changes and inject your changes into the browser.
 *
 * @link https://laravel.com/docs/5.6/mix#browsersync-reloading
 */
mix.browserSync( {
	proxy : 'localhost',
	port  : 8080,
	files : [
		'**/*.{css,js,jpg,jpeg,png,gif,svg,eot,ttf,woff,woff2}',
		`${devPath}/views/**/*.php`,
		'app/**/*.php',
		'functions.php'
	]
} );
