=== Plugin Name ===
Contributors: laith3
Tags: lorem ipsum, lorem, ipsum, dummy text, content generator, hipsum, randomtext, lorempixel, lorem pixel, hipsum pixel
Requires at least: 4.1.0
Tested up to: 4.6.1
Stable tag: trunk
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Creates a button on the WordPress editor toolbar to insert a configurable amount of Lorem Ipsum or Gibberish placeholder text and random images.

== Description ==

Hipsum Pixel brings the power of two data services into a single WordPress plugin. "RandomText" grabs dummy text in either Lorem Ipsum or Gibberish format, and your choice of either [LoremPixel](http://lorempixel.com) or [Placekitten](http://placekitten.com) gets randoms images.  LoremPixel also includes multiple image categories.  Hipsum Pixel let's you format the content using HTML tags (p, ol, ul, and h1-h4).  For images, you can set width and height and native WordPress classes for positioning (left, right, center).

### Plugin Features:

*   Add button to editor, which opens a lightbox window with UIa
*   Generate Lorem Ipsum or Gibberish content in HTML tags (p, ol, ul, h1-h4)
*   Generate random images in color or grayscale and from multiple different categories
*   Configurable number of HTML elements and number of words per element
*   Configurable image width and height and alignment using native WordPress classes (left, right, center)
*   Configurable image source under Tools -> Options: either [LoremPixel](http://lorempixel.com) or [Placekitten](http://placekitten.com)
*   Preview results before inserting into post

### Image Categories:

*   Abstract
*   Animals
*   Business
*   Cats
*   City
*   Sports
*   Fashion
*   Nature
*   Food
*   Nightlife
*   People
*   Technics
*   Transport


== Installation ==

1. Upload `hipsum-pixel.php` to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress
1. Optionally change image source under Tools -> Hipsum Pixel Options
1. Go to post or page, click on the "Hipsum Pixel" button
1. Generate content and images, preview, and click "Insert into Post"

== Frequently Asked Questions ==

None yet.  Please post your questions or problems in the support section.

== Screenshots ==

1. Hipsum Pixel button on WordPress editor
1. Hipsum Pixel UI in Lightbox showing render preview
1. Hipsum Pixel UI in Lightbox showing HTML view
1. Hipsum Pixel Setting page


== Changelog ==

= Version 2.0 =
* New feature - added image source options (LoremPixel or PlaceKitten)
* Bug fix - scripts and styles load only on specific admin pages (post/page edit, and Tools -> Hipum Pixel Options) instead of all admin screens
* Bug fix - ability to load images over https by setting image source option to PlaceKitten

= Version 1.0 =
* Initial commit

== Upgrade Notice ==

= 2.0 =
Bug fixes and new features - see changelog