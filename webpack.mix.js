/**
 * Laravel Mix configuration file.
 *
 * Laravel Mix is a layer built on top of WordPress that simplifies much of the
 * complexity of building out a Webpack configuration file. Use this file to
 * configure how your assets are handled in the build process.
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
mix.js( devPath + '/scripts/app.js',                'scripts' )
   .js( devPath + '/scripts/customize-controls.js', 'scripts' )
   .js( devPath + '/scripts/customize-preview.js',  'scripts' );

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
mix.sass( devPath + '/styles/screen.scss',             'styles', sassConfig )
   .sass( devPath + '/styles/editor.scss',             'styles', sassConfig )
   .sass( devPath + '/styles/customize-controls.scss', 'styles', sassConfig );

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
			// Import from `hybrid/scripts` or `~hybrid/styles`.
			hybrid : path.resolve( __dirname, 'vendor/justintadlock/hybrid-core/src/resources/' )
		}
	},
	plugins     : [
		// @link https://github.com/webpack-contrib/copy-webpack-plugin
		new CopyWebpackPlugin( [
			{ from : devPath + '/img',   to : 'img'   },
			{ from : devPath + '/svg',   to : 'svg'   },
			{ from : devPath + '/fonts', to : 'fonts' }
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
		'**/*.{jpg,jpeg,png,gif,svg,eot,ttf,woff,woff2}',
		devPath + '/views/**/*.php',
		'app/**/*.php'
	]
} );
