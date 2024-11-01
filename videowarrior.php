<?php
/*
Plugin Name: VideoWarrior
Plugin URI: http://www.der-beweis.de/b/videowarrior/
Description: Yet another plugin to include Videos from Youtube, Vimeo and Google Video!
Version: 1.0.5
Author: Sixtus
Author URI: http://www.der-beweis.de/b/

Instructions

Copy the file you unzipped into the wp-content/plugins folder of WordPress, 
then go to Administration > Plugins, and activtate it.

Find more information in the readme file or at http://www.der-beweis.de/b/videowarrior/
*/

// Configuration:
//Here you can change the text of the direct link to the videos:
$ylink = "Direktlink zum Video auf Youtube"; //Change here for Youtube
$vlink = "Direktlink zum Video auf Vimeo"; //Change here for Vimeo
$glink = "Direktlink zum Video auf Google-Video"; //Change here for Google Video

// YOUTUBE

/*
To insert Videos from YouTube into your Posts, please insert the following code:
Example URI: http://youtube.com/watch?v=zyyCcjbrWOM
Code for you Post: [youtube zyyCcjbrWOM]
*/

define("YOUTUBE_WIDTH", 425);
define("YOUTUBE_HEIGHT", 350);
define("YOUTUBE_REGEXP", "/\[youtube ([[:print:]]+)\]/");
define("YOUTUBE_TARGET", "<object type=\"application/x-shockwave-flash\" width=\"".YOUTUBE_WIDTH."\" height=\"".YOUTUBE_HEIGHT."\" data=\"http://www.youtube.com/v/###URL###\"><param name=\"movie\" value=\"http://www.youtube.com/v/###URL###\" /><param name=\"wmode\" value=\"transparent\" /><param name=\"allowFullScreen\" value=\"true\" /></object><br /><a href=\"http://www.youtube.com/watch?v=###URL###\">$ylink</a>");

function youtube_plugin_callback($match)
{
	$output = YOUTUBE_TARGET;
	$output = str_replace("###URL###", $match[1], $output);
	return ($output);
}

function youtube_plugin($content)
{
	return (preg_replace_callback(YOUTUBE_REGEXP, 'youtube_plugin_callback', $content));
}

add_filter('the_content', 'youtube_plugin');
add_filter('comment_text', 'youtube_plugin');

// Vimeo

/*
To insert Videos from Vimeo into your Posts, please insert the following code:
Example URI: http://www.vimeo.com/2273770
Code for you Post: [vimeo 2273770]
*/

define("VIMEO_WIDTH", 400);
define("VIMEO_HEIGHT", 225);
define("VIMEO_REGEXP", "/\[vimeo ([[:print:]]+)\]/");
define("VIMEO_TARGET", "<object type=\"application/x-shockwave-flash\" width=\"".VIMEO_WIDTH."\" height=\"".VIMEO_HEIGHT."\" data=\"http://vimeo.com/moogaloop.swf?clip_id=###URL###\"><param name=\"movie\" value=\"http://vimeo.com/moogaloop.swf?clip_id=###URL###\" /><param name=\"allowfullscreen\" value=\"true\" /></object><br /><a href=\"http://vimeo.com/###URL###\">$vlink</a>");


function vimeo_plugin_callback($match)
{
	$output = VIMEO_TARGET;
	$output = str_replace("###URL###", $match[1], $output);
	return ($output);
}

function vimeo_plugin($content)
{
	return (preg_replace_callback(VIMEO_REGEXP, 'vimeo_plugin_callback', $content));
}

add_filter('the_content', 'vimeo_plugin');
add_filter('comment_text', 'vimeo_plugin');


// GOOGLE VIDEO

/*
To insert Videos from Google Video into your Posts, please insert the following code:
Example URI: http://video.google.de/videoplay?docid=2332307822694154571
Code for you Post: [googlevideo 2332307822694154571]
*/

define("GOOGLEVIDEO_WIDTH", 400);
define("GOOGLEVIDEO_HEIGHT", 350);
define("GOOGLEVIDEO_REGEXP", "/\[googlevideo ([[:print:]]+)\]/");
define("GOOGLEVIDEO_TARGET", "<object type=\"application/x-shockwave-flash\" width=\"".GOOGLEVIDEO_WIDTH."\" height=\"".GOOGLEVIDEO_HEIGHT."\" data=\"http://video.google.com/googleplayer.swf?docid=###URL###\"><param name=\"movie\" value=\"http://video.google.com/googleplayer.swf?docid=###URL###\" /><param name=\"wmode\" value=\"transparent\" /><param name=\"allowFullScreen\" value=\"true\" /></object><br /><a href=\"http://video.google.de/videoplay?docid=###URL###\">$glink</a>");


function googlevideo_plugin_callback($match)
{
	$output = GOOGLEVIDEO_TARGET;
	$output = str_replace("###URL###", $match[1], $output);
	return ($output);
}

function googlevideo_plugin($content)
{
	return (preg_replace_callback(GOOGLEVIDEO_REGEXP, 'googlevideo_plugin_callback', $content));
}

add_filter('the_content', 'googlevideo_plugin');
add_filter('comment_text', 'googlevideo_plugin');


?>
