/**
 * Theme Export Script
 *
 * Exports the production-ready theme with only the files and folders needed for
 * uploading to a site or zipping. Edit the `files` or `folders` variables if
 * you need to change something.
 *
 * @package   Mythic
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright 2018 Justin Tadlock
 * @link      https://themehybrid.com/themes/mythic
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0-or-later
 */

// Import required packages.
const mix     = require( 'laravel-mix' );
const rimraf  = require( 'rimraf' );
const fs      = require( 'fs' );

// Folder name to export the files to.
let exportPath = 'mythic';

// Theme root-level files to include.
let files = [
	'style.css',
	'changelog.md',
	'functions.php',
	'index.php',
	'license.md',
	'readme.md',
//	'readme.txt',        // Required for WordPress.org theme review.
	'screenshot.png'
];

// Folders to include.
let folders = [
	'app',
	'dist',
	'resources/lang',
//	'resources/js',      // Required for WordPress.org theme review.
//	'resources/scss',    // Required for WordPress.org theme review.
	'resources/views',
	'vendor'
];

// Delete the previous export to start clean.
rimraf.sync( exportPath );

// Loop through the root files and copy them over.
files.forEach( file => {

	if ( fs.existsSync( file ) ) {
		mix.copy( file, `${exportPath}/${file}` );
	}
} );

// Loop through the folders and copy them over.
folders.forEach( folder => {

	if ( fs.existsSync( folder ) ) {
		mix.copyDirectory( folder, `${exportPath}/${folder}` );
	}
} );

// Delete the `vendor/bin` and `vendor/composer/installers` folder, which can
// get left over, even in production. Mix will also create an additional
// `mix-manifest.json` file in the root, which we don't need.
mix.then( () => {

	let files = [
		'mix-manifest.json',
		`${exportPath}/vendor/bin`,
	 	`${exportPath}/vendor/composer/installers`
	];

	files.forEach( file => {
		rimraf.sync( file );
	} );
} );
