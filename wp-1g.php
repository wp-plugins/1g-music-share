<?php
/*
Plugin Name:1g-music-share
Plugin URI: http://blog.1g1g.info/wp-plugin/
Description: This plugin inserts 1g1g-miniplayer into your posts and pages easily.（插入亦歌迷你播放器到你的文章或页面中）
Version: 0.9.1
Author: Ye Xiaoxing
Author URI: http://me.1g1g.info/
*/
function wp1gmp_addbuttons() {
	// Add only in Rich Editor mode
	if ( get_user_option('rich_editing') == 'true') {
	// add the button for wp25 in a new way
		add_filter("mce_external_plugins", "add_wp1gmp_tinymce_plugin", 5);
		add_filter('mce_buttons', 'register_wp1gmp_button', 5);
	}
}

function register_wp1gmp_button($buttons) {
	array_push($buttons, "separator", "wp1gmp");
	return $buttons;
}

function add_wp1gmp_tinymce_plugin($plugin_array) {
	$plugin_array['wp1gmp'] = get_option('siteurl').'/wp-content/plugins/1g-music-share/editor_plugin.js';	
	return $plugin_array;
}

function wp1gmp_mce_valid_elements($init) {
	if ( isset( $init['extended_valid_elements'] ) 
	&& ! empty( $init['extended_valid_elements'] ) ) {
		$init['extended_valid_elements'] .= ',' . 'pre[lang|line|escaped]';
	} else {
		$init['extended_valid_elements'] = 'pre[lang|line|escaped]';
	}
	return $init;
}

function wp1gmp_change_tinymce_version($version) {
	return ++$version;
}

function wp1g_func($atts) {
	extract(shortcode_atts(array(
		'play' => 'error',
	), $atts));
if ($play=="error")
  	return '在处理亦歌代码时出错。您并未设置play参数。';
else
	return '<object type="application/x-shockwave-flash" data="http://public.1g1g.com/miniplayer/miniPlayer.swf" width="200px" height="24px" id="1gMiniPlayer"><param name="movie" value="http://public.1g1g.com/miniplayer/miniPlayer.swf" /><param name="allowScriptAccess" value="always" /><param name="FlashVars" value="play='.$play.'"/><param name="wmode" value ="transparent" /></object>';
}

add_shortcode('music1g', 'wp1g_func');
add_filter('tiny_mce_before_init', 'wp1gmp_mce_valid_elements', 0);
add_filter('tiny_mce_version', 'wp1gmp_change_tinymce_version');
add_action('init', 'wp1gmp_addbuttons');
?>