/**
 * Theme Bundle Process
 *
 * Creates a bundle of the production-ready theme with only the files and
 * folders needed for uploading to a site or zipping. Edit the `files` or
 * `folders` variables if you need to change something.
 *
 * @package   Mythic
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright Copyright (c) 2018, Justin Tadlock
 * @link      https://themehybrid.com/themes/mythic
 * @license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

// Import required packages.
const { mix } = require( 'laravel-mix' );
const rimraf  = require( 'rimraf' );

// Folder name to bundle the files in.
let bundlePath = 'mythic';

// Theme root-level files to include.
let files = [
	'style.css',
	'changelog.md',
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
//	'resources/js',      // Required for WordPress.org theme review.
//	'resources/scss',    // Required for WordPress.org theme review.
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

// Delete the `vendor/bin` and `vendor/composer/installers` folder, which can
// get left over, even in production.
mix.then( () => {

	let folders = [
		`${bundlePath}/vendor/bin`,
	 	`${bundlePath}/vendor/composer/installers`
	];

	folders.forEach( folder => {
		rimraf.sync( folder );
	} );
} );
