<?php
/*
Plugin Name:1g-music-share
Plugin URI: http://blog.1g1g.info/wp-plugin/
Description: This plugin inserts 1g1g-miniplayer into your posts and pages easily.（插入亦歌迷你播放器到你的文章或页面中）
Version: 1.3.3
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
		'autoplay' => 'error',
	), $atts));
if ($play=="error")
  	return '<p>在处理1g-music-player代码时出错。您可能并未设置play参数。</p>';
else

    $o = wp1g_get_options();
    	if ($autoplay=="error")
  		$autoplay=($o['isauto'] == 't') ? 'true' : 'false';
    $ygCode = <<<EOT
        <object type="application/x-shockwave-flash" data="http://public.1g1g.com/miniplayer/miniPlayer.swf" width="{$o['width']}" height="{$o['height']}" id="1gMiniPlayer">
            <param name="movie" value="http://public.1g1g.com/miniplayer/miniPlayer.swf" />
            <param name="allowScriptAccess" value="always" />
            <param name="FlashVars" value="play={$play}&isAutoPlay={$autoplay}&textColor=0x{$o['textColor']}&bgColor1=0x{$o['bgColor1']}&bgColor2=0x{$o['bgColor2']}&borderColor=0x{$o['borderColor']}&btnColor=0x{$o['btnColor']}&btnGlowColor=0x{$o['btnGlowColor']}" />
            <param name="wmode" value ="transparent" />
        </object>
EOT;
	return $ygCode;
}

function wp1g_get_options(){
	$defaults = array();
	$defaults['width'] = '200';
	$defaults['height'] = '24';
	$defaults['isauto'] = 'f';
	$defaults['user'] = '';

	$defaults['bgColor1'] = 'eeeeee';
	$defaults['textColor'] = '000000';
	$defaults['bgColor2'] = 'dddddd';
	$defaults['borderColor'] = '999999';
	$defaults['btnColor'] = '0160e6';
	$defaults['btnGlowColor'] = '2da0fd';

	$options = get_option('wp1gsettings');
	if (!is_array($options)){
		$options = $defaults;
		update_option('wp1gsettings', $options);
	}
	if (!isset($options['bgColor1'])) {
		$options = $defaults;
		update_option('wp1gsettings', $options);
	}
	return $options;
}
	
function wp1g_option() {
    add_options_page('亦歌分享插件设置', '亦歌分享插件', manage_options, 'wp-1g.php', 'wp1g_optionpage');
}

function wp1g_optionpage() {
		if ($_POST['wp1g']){
			update_option('wp1gsettings', $_POST['wp1g']);
			$message = '<div class="updated"><p><strong>设置已保存。</strong></p></div>';
			if ($_POST['wp1g']['resetall']){
	$defaults = array();
	$defaults['width'] = '200';
	$defaults['height'] = '24';
	$defaults['isauto'] = 'f';
	$defaults['user'] = '';

	$defaults['bgColor1'] = 'eeeeee';
	$defaults['textColor'] = '000000';
	$defaults['bgColor2'] = 'dddddd';
	$defaults['borderColor'] = '999999';
	$defaults['btnColor'] = '0160e6';
	$defaults['btnGlowColor'] = '2da0fd';
				update_option('wp1gsettings', $defaults);
				$message = '<div class="updated"><p><strong>设置已重置。</strong></p></div>';
			}
		}

		$o = wp1g_get_options();

		$cauto= ($o['isauto'] == 't') ? ' checked="checked"' : '';
		$cauton= ($o['isauto'] == 't') ? '' : ' checked="checked"';
		echo <<<EOT
		<script type="text/javascript" src="../wp-content/plugins/1g-music-share/jscolor/jscolor.js"></script>
		<div class="wrap">
			<h2>亦歌分享插件设置</h2>
			{$message}
			<form name="form1" method="post" action="options-general.php?page=wp-1g.php">

			<fieldset class="options">
				<table width="100%" cellspacing="2" cellpadding="5" class="editform">
					<tr valign="top">
						<th width="33%" scope="row">播放器高度（单位：px）</th>
						<td><input type="text" value="{$o['height']}" name="wp1g[height]" size="50" /></td>
					</tr>
					<tr valign="top">
						<th width="33%" scope="row">播放器宽度（单位：px）</th>
						<td><input type="text" value="{$o['width']}" name="wp1g[width]" size="50"/></td>
					</tr>
					<tr valign="top">
						<th width="33%" scope="row">亦歌用户名</th>
						<td><input type="text" value="{$o['user']}" name="wp1g[user]" size="50"/></td>
					</tr>
					<tr valign="top">
						<th width="33%" scope="row">是否自动播放</th>
						<td>
							<input type="radio" value="t" name="wp1g[isauto]"{$cauto}/> 是<br />
							<input type="radio" value="f" name="wp1g[isauto]"{$cauton}/> 否
						</td>
					</tr>
					
					<tr valign="top">
						<th width="33%" scope="row">背景渐变色1</th>
						<td><input class="color" value="{$o['bgColor1']}" name="wp1g[bgColor1]" size="50"/></td>
					</tr>
					<tr valign="top">
						<th width="33%" scope="row">背景渐变色2</th>
						<td><input class="color" value="{$o['bgColor2']}" name="wp1g[bgColor2]" size="50"/></td>
					</tr>
					<tr valign="top">
						<th width="33%" scope="row">文字颜色</th>
						<td><input class="color" value="{$o['textColor']}" name="wp1g[textColor]" size="50"/></td>
					</tr>
					<tr valign="top">
						<th width="33%" scope="row">边框颜色</th>
						<td><input class="color" value="{$o['borderColor']}" name="wp1g[borderColor]" size="50"/></td>
					</tr>
					<tr valign="top">
						<th width="33%" scope="row">按钮颜色</th>
						<td><input class="color" value="{$o['btnColor']}" name="wp1g[btnColor]" size="50"/></td>
					</tr>
					<tr valign="top">
						<th width="33%" scope="row">按钮光晕色</th>
						<td><input class="color" value="{$o['btnGlowColor']}" name="wp1g[btnGlowColor]" size="50"/></td>
					</tr>
					<tr valign="top">
						<th width="33%" scope="row">重置所有选项？</th>
						<td><input type="checkbox" name="wp1g[resetall]" size="50"/></td>
					</tr>
				</table>
			</fieldset>
			<p class="submit">
				<input type="submit" name="Submit" value="保存设置" />
			</p>
			</form>
		</div>
EOT;
}
 

// Add Media Button to Upload Area
function wp_1gmp_mediabutton($context) {
	$wp1g_plugin_url= WP_PLUGIN_URL.'/'.str_replace(basename( __FILE__),"",plugin_basename(__FILE__));
	$flashbutton_html = <<<EOF
<a href="javascript:wp1g_upload_mediabtn_click();" id="addupload_media_btn" title="添加亦歌迷你播放器"><img id="wp1gmediabutton" src="{$wp1g_plugin_url}note_20.png" alt="添加亦歌迷你播放器"></a><script type="text/javascript">
function wp1g_upload_mediabtn_click(){document.getElementById("content").focus();tinyMCE.activeEditor.execCommand('wp1gmp');}
if(document.getElementById("dashboard_quick_press")){document.getElementById("wp1gmediabutton").style.display="none";}
</script>
EOF;
	$wp_customized_mediabutton = '%s'.$flashbutton_html;
	return sprintf($context, $wp_customized_mediabutton);
}
add_filter('media_buttons_context', 'wp_1gmp_mediabutton');


add_shortcode('music1g', 'wp1g_func');
add_filter('tiny_mce_before_init', 'wp1gmp_mce_valid_elements', 0);
add_filter('tiny_mce_version', 'wp1gmp_change_tinymce_version');
add_action('init', 'wp1gmp_addbuttons');
add_action('admin_menu', 'wp1g_option');

add_filter('comment_text','do_shortcode');
?>
