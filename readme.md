# WPSF Framework
A Lightweight and easy-to-use WordPress Options Framework. It is a free framework for building theme options. Save your time!

## Screenshot
[![WPSF Framework Screenshot](http://wpsf.github.io/s3/theme-modern.jpg)](https://wpsf.github.io/s3/front-animation.gif)

## [Documentation](https://wpsf.gitbooks.io/docs/)
Read the documentation for details [documentation](https://wpsf.gitbooks.io/docs/)

## Installation
##### A) Usage as Theme
* Download zip file from github repository
* Extract download zip on `themename/wpsf-framework` folder under your theme directory
* Add framework include code on your theme `themename/functions.php` file

```php
require_once dirname( __FILE__ ) .'/wpsf-framework/wpsf-framework.php';
// -(or)-
require_once get_template_directory() .'/wpsf-framework/wpsf-framework.php';
```

* Yay! Right now you are ready to configure framework, metaboxes, taxonomies, wp customize, shortcoder
* Take a look for config files from `themename/wpsf-framework/config` folder
* Read for more from [documentation](https://wpsf.gitbooks.io/docs/)

##### B) Usage as Plugin
* Download zip file from github repository
* **Way1** Extract download zip on `wp-content/plugins/wpsf-framework` folder under your plugin directory
* **Way2** Upload zip file from `wordpess plugins panel -> add new -> upload plugin`
* Active WPSF Framework plugin from wordpress plugins panel
* Yay! Right now you are ready to configure framework, metaboxes, taxonomies, wp customize, shortcoder
* Take a look for config files from `wp-content/plugins/wpsf-framework/config` folder also you can manage config files from theme directory. see overriding files method.
* Read for more from [documentation](https://wpsf.gitbooks.io/docs/)


## Overriding Files
You can override an existing file without change `themename/wpsf-framework` folder. just create one `themename/wpsf-framework-override` folder on your theme directory. for eg:

```php
themename/wpsf-framework-override/config/framework.config.php
themename/wpsf-framework-override/functions/constants.php
themename/wpsf-framework-override/fields/text/text.php
```

## Features
- Options Framework
- Metabox Framework
- Taxonomy Framework
- WP Customize Framework
- Shortcode Generator
- Supports Child Themes
- Validate Fields
- Sanitize Fields
- Localization
- Fields Dependencies
- Supports Multilangual Fields
- Reset/Restore/Export/Import Options
- and so much more...

## Options Fields
- Text
- Textarea
- Checkbox
- Radio
- Select
- Number
- Icons
- Group
- Image
- Upload
- Gallery
- Sorter
- Wysiwyg
- Switcher
- Background
- Color Picker
- Multi Checkbox
- Checkbox Image Select
- Radio Image Select
- Typography
- Backup
- Heading
- Sub Heading
- Fieldset
- Notice
- and **extendable** fields

## License
WPSF Framework is **free** to use both personal and commercial. If you used commercial, **please credit**.
Read more about GNU [license.txt](http://www.gnu.org/licenses/gpl-3.0.txt)



## The Latest Updates
#### 0.5Beta
* First Version

See [changelog](CHANGELOG.md)

## Contributers
* [@chandrika1892](http://github.com/chandrika1892)

