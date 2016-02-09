<?php
/**
 * Configuration file For GnuSBot
 *  all configuration vars should go here
 */


// this folder is used to save a file for feed
// the file is used to control which posts are alredy posted
// this will present a future problem, since the file size will increase over time
// a better solution would be to store only the last post-id published for the feed
// and make calculations from there
define("GSB_PATH_CONTROL_FILES", dirname(__FILE__)."/../data/");

// max number of posts from the feed to publish in case more than one is found as unpublished
define("GSB_MAX_PUBLISH", 1);

// gnusocial api & accounts where to publish new feed entries
// it was thought from the scratch to publish on several accounts/nodes if needed
$gnusbot_api = Array();
$gnusbot_api[] = Array(
    "api_uri" => "https://SITE.HERE/api/statuses/update.xml",
    "username" => "USERNAME_HERE",
    "password" => "PASSWORD_HERE"
);


// list of rss feeds to explore and post
$gnusbot_feeds = Array();
$gnusbot_feeds[] = Array("url"=> "http://www.creativecommons.uy/feed/", "ref"=> "#CCuruguay");
//$gnusbot_feeds[] = Array("url"=> "http://musicalibre.uy/feed/", "ref"=> "musicalibre.uy");;








?>
