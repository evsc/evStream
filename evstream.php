<?php
/*
Plugin Name: evstream
Plugin URI: http://www.evsc.net
Description: Streaming local posts, vi.zualize.us images, del.icio.us links, last.fm tags, hypem songs, ...
Version: 1.0
Author: evsc
Author URI: http://www.evsc.net
License: A "Slug" license name e.g. GPL2
*/

define("PLUGIN_DIRECTORY", dirname(__FILE__)); 



class evStream_Item {
	var $id;
	var $content;
	var $timestamp;
	var $time;
	var $type;

	function __construct($args = NULL) {
		
		if ( function_exists('get_option') ) { // For Wordpress
			$options = get_option(OPTIONS_NAME);
		}
		
		if ( isset($args) ) {  // Replaces Wordpress options or sets options for standalone
			foreach ( $args as $key => $option ) {
				$options[$key] = $option;
			}
		}
		
		$this->id = -1;
		$this->content = '---';
		$this->timestamp = 0;
		$this->time = 0;
		$this->type = 'default';
		
	}

	function setId($no) {
		$this->id = $no;
	}

	function setContent($c) {
		$this->content = $c;
	}

	function setTimeStamp($ts) {
		$this->timestamp = $ts;
	}

	function setTime($t) {
		$this->time = $t;
	}
	
	function setType($ty) {
		$this->type = $ty;
	}
}

function new_file_get_contents($url) {
	$ch = curl_init();
	$timeout = 10;
	curl_setopt ($ch, CURLOPT_URL, $url);
	curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
	$file_contents = curl_exec($ch); 
	curl_close($ch);
	return $file_contents;
}


function evstream_admin() {  
        include('evstream_admin.php'); 
}  

function evstream_style() {
	echo '<link rel="stylesheet" type="text/css" href="';
	echo WP_PLUGIN_URL.'/evstream/evstream_style.css';
	echo '" />';
}

function get_evStream() {  
        include('evstream_get.php'); 
} 
		
function evstream_admin_actions() {
         add_options_page("evStream", "evStream", 1, "evStream", "evstream_admin");
}

add_action('admin_menu', 'evstream_admin_actions');
add_action('wp_head', 'evstream_style');


?>