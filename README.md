# Hipoul
Hipoul is a Wordpress theme designed explicitly for [poul.org](https://poul.org)

## Docs
####What file refers to what:
#####Default templates
* index.php:
    the most generic file in the theme - everything defaults to it
* style.css:
    fundamental style file, holds the styling for all the theme parts
* front-page.php:
    homepage body
* header.php:
    head, body, header and navbar
* footer.php:
    footer and social links
* loop.php:
    generic posts looper
* loop-page.php:
    formats a single page
* loop-single.php:
    formats the single post
* comments.php:
    outputs the comments

#####Custom templates
* page-events.php:
    outputs all the posts
    
#####Custom includes
* includes/theme-setup.php:
    general setup, such as db and settings
* includes/theme-functions.php:
    social links, and avatars
* includes/theme-loop.php:
    excerpts, post navigation, post images, and dates handling
* includes/theme-menu.php:
    custom classes to build a sane-formatted menu
* includes/theme-comments.php:
    comment layout
* includes/theme-shortcodes.php:
    handles shortcodes in posts
