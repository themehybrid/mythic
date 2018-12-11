# Change Log

## [1.0.2] - 2018-12-11

### Added

- Added in support for the core WP "Media & Text" block.  New stylesheet at `resources/scss/blocks/core/_media-text.scss`.

### Fixed

- Corrected whitespace issues in `composer.json`.
- Bumped `postcss-preset-env` to ^6.4.0 to correct an issue where CSS variables were being output twice.

### Changed

- The core WP `cover-image` block was renamed to `cover` to accommodate different types of media.  Our block stylesheet changed to reflect this.  See `resources/scss/blocks/core/_cover.scss`.
- Now using the `.editor-styles-wrapper` class instead of `.edit-post-visual-editor` for styling the block editor.
- Updated Node and Composer packages.

## [1.0.1] - 2018-10-23

### Added

- Added default style rules for `.wp-smiley` and `.emoji` classes.

### Changed

- Updated Node packages.

### Fixed

- Checks that a file/folder exists before attempting to copy it during the export process.
- Added a missing closing `)` in `resources/scss/utilities/_alignment.scss`.
- Removed the redundant `.align*` styles from `resources/scss/blocks/*`.
- Corrected `.alignleft` and `.alignright` margins, which were backwards.
- Fixed typo in `index.php`.

## [1.0.0] - 2018-09-18

### Added

- Everything's new!
