// Build with Laravel Mix.
// @link https://laravel.com/docs/5.6/mix

const { mix } = require('laravel-mix');
const ImageminPlugin = require('imagemin-webpack-plugin').default;
const CopyWebpackPlugin = require('copy-webpack-plugin');
const imageminMozjpeg = require('imagemin-mozjpeg');

// Set the BrowserSync proxy URL.
const browserSyncUrl = 'theme-development.localhost';

// Set path to our generated assets.
mix.setPublicPath( 'dist' );

// Compile JavaScript.
mix.js( 'resources/scripts/app.js',                'scripts' ).sourceMaps();
mix.js( 'resources/scripts/customize-controls.js', 'scripts' ).sourceMaps();
mix.js( 'resources/scripts/customize-preview.js',  'scripts' ).sourceMaps();

// Compile SASS/CSS.
var sassConfig = {
	outputStyle : 'expanded',
	indentType  : 'tab',
	indentWidth : 1
};

var cssOptions = {
	postCss        : [ require('postcss-preset-env')() ],
	processCssUrls : false
};

mix.sass( 'resources/styles/screen.scss', 'styles', sassConfig ).sourceMaps().options( cssOptions );

// Generate a manifest file for cache busting.
// Append a unique hash for production only assets.
if( mix.inProduction() ) {
	mix.version();
}

// Add our own Webpack config options.
// Here we are using CopyWebpackPlugin rather than the `.copy` mix method
// as we want to minimize images too, and mix doesn't currently have a
// built in method to handle this.
mix.webpackConfig( {

	stats : 'minimal',
	performance : { hints: false },
	// Prevent certain dependencies being included in bundles.
	// @link https://webpack.js.org/configuration/externals/#externals
	externals: {
		jquery : 'jQuery'
	},
	plugins: [
		new CopyWebpackPlugin( [
			{
				from: 'resources/img',
				to: 'img'
			},
			{
				from: 'resources/svg',
				to: 'svg'
			},
			{
				from: 'resources/fonts',
				to: 'fonts'
			}
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
			plugins: [ imageminMozjpeg( { quality : 75 } ) ]
		} )
	]
} );

// monitor files for changes and inject your changes into the browser.
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
