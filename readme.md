# ABC - A starter theme for WordPress

ABC (temporary name) is a starter theme project that's currently under active development.

The theme's primary goal is to offer a modern development experience for WordPress theme authors while sticking as close to possible to WordPress standards as we can.  Sometimes those things don't always mesh well.  This theme aims to balance that.

## Requirements

There's a few requirements in order to develop a new theme or contribute back to the project:

* PHP 5.6+ (preferably 7+)
* [Git](https://git-scm.com/) for version control.
* [Composer](https://getcomposer.org/) for managing PHP dependencies.
* [NPM](https://www.npmjs.com/) or [Yarn](https://yarnpkg.com/en/) (your choice) for managing JS dependencies.

You should feel reasonably comfortable using the command line. The theme tries to keep this as simple as possible, but some command line knowledge is necessary in modern development.

## Installation and setup

### Installing the theme

Themes belong in your `wp-content/themes` folder.  You can directly download and install the theme if you wish.  Or, you can use the command line to do so.

First, you must switch to the proper folder:

```
# Go to the themes folder.
cd wp-content/themes
```

Then, clone the theme:

```
# Clone the theme.
git clone -b master git@github.com:justintadlock/abc.git <theme-name>
```

After that, you need to make sure that you're in the proper folder to follow the next steps:

```
# Go the <theme-name> folder.
cd theme-name
```

### Installing PHP dependencies

ABC has the following dependencies, which must be installed for the theme to work:

* [Hybrid Core](https://github.com/justintadlock/hybrid-core).

That's why we need Composer. While still in the command line and at `wp-content/themes/theme-name`, type the following command:

```
composer install
```

### Installing Node dependencies

ABC has many Node dependencies that it uses for the build process.  To install them, you can either use NPM or Yarn.

**NPM command:**

```
npm install
```

**Yarn command:**

```
yarn install
```

## Folder structure

_Note: The folder structure is still under development and could change in the future._

### root

The root theme folder has several files, some of which shouldn't be edited.

* `.editorconfig` - Used for configuring code editors for consistent styles. See: [EditorConfig](http://editorconfig.org/).
* `.gitignore` - Files and folders that Git should ignore when committing and pushing to a repo.
* `composer.json` - Used for listing Composer dependencies.
* `functions.php` - Functions file first called by WordPress to bootstrap the theme.
* `index.php` - Unused fallback template that's required in WP's system.
* `package-lock.json` - Used by NPM to lock dependencies (don't edit).
* `style.css` - Needed by WP to know this is a theme. We use this for configuration, essentially.
* `webpack.mix.js` - Handles the Laravel Mix configuration.
* `yarn.lock` - Used by Yarn to lock dependencies (don't edit).

### /app

The `/app` folder is where your _under-the-hood_ PHP lives.  Use this folder for adding custom functions and classes.  My preferred naming system is the following (feel free to do your own thing):

* `class-{$classname}.php` - File holds a single class.
* `functions-{$group}.php` - File holds a related group of functions.
* `template-{$group}.php` - File holds a related group of template tags.

Also, see the `functions.php` file for how all of these get loaded too.

### /dist

The `/dist` folder is for holding our compiled assets for distribution. These files should not be edited directly.  The sub-folders are organized on par with the sub-folders in `/resources`.

* `scripts` - Holds the compiled scripts.
* `styles` - Holds the compiled stylesheets.

### /resources

The `/resources` folder is where much of the magic of theme development will happen.  This is essentially the stuff that you will be editing the vast majority of the time when creating a theme.

* `fonts` - Font files.
* `img` - PNG, JPG, and most other image files.
* `lang` - POT and any other MO or PO language files.
* `scripts` - JavaScript files.
* `styles` - SCSS/CSS files.
* `svg` - SVG files.
* `views` - The template files for the theme.

## Build Process

This theme utilizes [Laravel Mix](https://laravel.com/docs/5.6/mix) for most of the build process with the theme.

Laravel Mix is a layer built on top of Webpack that makes defining your build process much easier than attempting to write out a custom `webpack.config.js` configuration file.  It simplifies most of the complexity while still allowing you to define custom Webpack config options for more advanced uses.

You may configure the build process to your liking by editing `webpack.mix.js`.

The following is a list of commands you can run from the command line:

```
# Processes all of your assets for a development environment.
npm run dev

# Watches for changes to any files and rebuilds for a development environment.
npm run watch

# Watches for changes to files and syncs with the browser using BrowserSync.
npm run hot

# Processes all of your assets for a production environment.
npm run build

# Lint JavaScript and/or SCSS files.
npm run lint
npm run lint:styles
npm run lint:scripts
```
