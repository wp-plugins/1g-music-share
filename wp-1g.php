<?php
/*
Plugin Name: 亦歌音乐分享
Plugin URI: http://xiaoxing.us/1g1g/
Description: 本插件为你提供一个简便的方式在文章或页面中添加亦歌迷你播放器。This plugin provides you a easy way to put 1g1g-miniplayer into your posts and pages easily.
Version: 1.5.1
Author: Ye Xiaoxing
Author URI: http://xiaoxing.us/
*/

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
    add_options_page('亦歌分享插件设置', '亦歌分享插件', manage_options, '1gshare', 'wp1g_optionpage');
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
<script type="text/javascript" src="../wp-content/plugins/1g-music-share/jscolor.js"></script><div class="wrap"><h2>亦歌分享插件设置</h2>{$message}<form name="form1" method="post" action="options-general.php?page=1gshare"><fieldset class="options"><table width="100%" cellspacing="2" cellpadding="5" class="editform"><tr valign="top"><th width="33%" scope="row">播放器高度（单位：px）</th><td><input type="text" value="{$o['height']}" name="wp1g[height]" size="50" /></td></tr><tr valign="top"><th width="33%" scope="row">播放器宽度（单位：px）</th><td><input type="text" value="{$o['width']}" name="wp1g[width]" size="50"/></td></tr><tr valign="top"><th width="33%" scope="row">亦歌用户名</th><td><input type="text" value="{$o['user']}" name="wp1g[user]" size="50"/></td></tr><tr valign="top"><th width="33%" scope="row">是否自动播放</th><td><input type="radio" value="t" name="wp1g[isauto]"{$cauto}/> 是<br /><input type="radio" value="f" name="wp1g[isauto]"{$cauton}/> 否</td></tr><tr valign="top"><th width="33%" scope="row">背景渐变色1</th><td><input class="color" value="{$o['bgColor1']}" name="wp1g[bgColor1]" size="50"/></td></tr><tr valign="top"><th width="33%" scope="row">背景渐变色2</th><td><input class="color" value="{$o['bgColor2']}" name="wp1g[bgColor2]" size="50"/></td></tr><tr valign="top"><th width="33%" scope="row">文字颜色</th><td><input class="color" value="{$o['textColor']}" name="wp1g[textColor]" size="50"/></td></tr><tr valign="top"><th width="33%" scope="row">边框颜色</th><td><input class="color" value="{$o['borderColor']}" name="wp1g[borderColor]" size="50"/></td></tr><tr valign="top"><th width="33%" scope="row">按钮颜色</th><td><input class="color" value="{$o['btnColor']}" name="wp1g[btnColor]" size="50"/></td></tr><tr valign="top"><th width="33%" scope="row">按钮光晕色</th><td><input class="color" value="{$o['btnGlowColor']}" name="wp1g[btnGlowColor]" size="50"/></td></tr><tr valign="top"><th width="33%" scope="row">重置所有选项？</th><td><input type="checkbox" name="wp1g[resetall]" size="50"/></td></tr></table></fieldset><p class="submit"><input type="submit" name="Submit" value="保存设置" /></p></form><p>捐助链接：</p><a href="http://me.alipay.com/yexiaoxing"> <img alt="" src="https://img.alipay.com/sys/personalprod/style/mc/btn-index.png" /> </a></div>
EOT;
}

add_shortcode('music1g', 'wp1g_func');
add_action('admin_menu', 'wp1g_option');

// Insert Page
function yigeinsert_media_menu($tabs) {
$newtab = array('yigeinsert'=>'亦歌搜索音乐');
return array_merge($tabs, $newtab);
}
add_filter('media_upload_tabs', 'yigeinsert_media_menu');

function media_yigeinsert_process() {
media_upload_header();
$wp1g_plugin_url= WP_PLUGIN_URL.'/'.str_replace(basename( __FILE__),"",plugin_basename(__FILE__));
//原window.php
?>
<script type="text/javascript">var xmlHttp;function showHint(){str=document.getElementById("wplay").value;xmlHttp=GetXmlHttpObject();if(xmlHttp==null){alert("Browser does not support HTTP Request");return;}var url="<?php echo $wp1g_plugin_url; ?>search.php";url=url+"?q="+encodeURIComponent(str);xmlHttp.onreadystatechange=stateChanged;xmlHttp.open("GET",url,true);xmlHttp.send(null);document.getElementById("searchlists").innerHTML='<p>获取搜索结果中...<p>'}function stateChanged(){if(xmlHttp.readyState==4||xmlHttp.readyState=="complete"){if(xmlHttp.status==200){document.getElementById("searchlists").innerHTML=xmlHttp.responseText}}}function GetXmlHttpObject(){var xmlHttp=null;try{xmlHttp=new XMLHttpRequest()}catch(e){try{xmlHttp=new ActiveXObject("Msxml2.XMLHTTP")}catch(e){xmlHttp=new ActiveXObject("Microsoft.XMLHTTP")}}return xmlHttp}function enterIn(evt){var evt=evt?evt:(window.event?window.event:null);if(evt.keyCode==13){showHint()}}function insert1gByID(id){var tagtext;var play=id;var autoplay=document.getElementById("autoplay_search").checked;tagtext='[music1g play=#'+play+' autoplay='+autoplay+']';var win=window.dialogArguments||opener||parent||top;win.send_to_editor(tagtext);return false}</script>
<style type="text/css">body{font-size:13px;font-family:"微软雅黑","文泉驿微米黑","Comic Sans MS"}
#listbox{font-size:12px;font-family:"微软雅黑","文泉驿微米黑","Comic Sans MS"}
#sharebutton{width:30px;color:#099}
</style>
</head><body>
<table><tbody><tr><td width="400px"><p style="font-size: 13px;" align="center">请输入歌手、歌名、专辑名进行搜索</p></td></tr><tr><td width="400px"><input type="checkbox" id="autoplay_search" /> 自动播放</td></tr><tr><td align="center"><input type="text" id="wplay" size="40px" style="font-size: 13px;" onkeydown="enterIn(event);" /><input type="button" id="insert2" value="搜索" onClick="showHint();" style="font-size: 13px;" /></td></tr></tbody></table><div id="searchlists"></div>
<?php
}
function yigeinsert_media_menu_handle() {
    return wp_iframe( 'media_yigeinsert_process');
}
add_action('media_upload_yigeinsert', 'yigeinsert_media_menu_handle');


// Insert Favorite
function yigefav_media_menu($tabs) {
$newtab = array('yigefav'=>'亦歌收藏的音乐');
return array_merge($tabs, $newtab);
}
add_filter('media_upload_tabs', 'yigefav_media_menu');

function media_yigefav_process() {
media_upload_header();
$wp1g_plugin_url= WP_PLUGIN_URL.'/'.str_replace(basename( __FILE__),"",plugin_basename(__FILE__));
//原window.php
?>
<script type="text/javascript">function showFav(user){str=user;xmlHttp=GetXmlHttpObject();if(xmlHttp==null){alert("Browser does not support HTTP Request");return;}var url="<?php echo $wp1g_plugin_url; ?>fav.php";url=url+"?auto=1&user="+encodeURIComponent(str);xmlHttp.onreadystatechange=stateChangedFav;xmlHttp.open("GET",url,true);xmlHttp.send(null);document.getElementById("searchlistsfav").innerHTML='<p>获取收藏记录中...<p>';}function showFav_input(){str=document.getElementById("wplay_user").value;xmlHttp=GetXmlHttpObject();if(xmlHttp==null){alert("Browser does not support HTTP Request");return;}var url="<?php echo $wp1g_plugin_url; ?>fav.php";url=url+"?user="+str;xmlHttp.onreadystatechange=stateChangedFav;xmlHttp.open("GET",url,true);xmlHttp.send(null);document.getElementById("searchlistsfav").innerHTML='<p>获取收藏记录中...<p>';}function stateChangedFav(){if(xmlHttp.readyState==4||xmlHttp.readyState=="complete"){if(xmlHttp.status==200){document.getElementById("searchlistsfav").innerHTML=xmlHttp.responseText;}}}function enterIn_fav(evt){var evt=evt?evt:(window.event?window.event:null);if(evt.keyCode==13){showFav_input();}}function insert1gByFavID(id){var tagtext;var play=id;var autoplay=document.getElementById("autoplay_fav").checked;tagtext='[music1g play=#'+play+' autoplay='+autoplay+']';var win=window.dialogArguments||opener||parent||top;win.send_to_editor(tagtext);return false;}function GetXmlHttpObject(){var xmlHttp=null;try{xmlHttp=new XMLHttpRequest()}catch(e){try{xmlHttp=new ActiveXObject("Msxml2.XMLHTTP")}catch(e){xmlHttp=new ActiveXObject("Microsoft.XMLHTTP")}}return xmlHttp}</script>
<style type="text/css">body{font-size:13px;font-family:"微软雅黑","文泉驿微米黑","Comic Sans MS"}
#listbox{font-size:12px;font-family:"微软雅黑","文泉驿微米黑","Comic Sans MS"}
#sharebutton{width:30px;color:#099;cursor:pointer;}</style>
<table><tbody><tr><td width="400px"><p style="font-size: 13px;" align="center">请输入亦歌用户名</p></td></tr><tr><td align="center"><input type="text" onkeydown="enterIn_fav(event);" id="wplay_user" size="40px" style="font-size: 13px;" value="<?php $options = get_option('wp1gsettings');echo $options['user']; ?>" /><input type="button" id="insert2" value="读取" onClick="showFav_input();" style="font-size: 13px;" /></td></tr><tr><td width="400px"><input type="checkbox" id="autoplay_fav" /> 自动播放</td></tr></tbody></table><div id="searchlistsfav"></div>
<?php
$options = get_option('wp1gsettings');
if(isset($options['user']))
	echo '<script type="text/javascript">showFav("'.$options['user'].'");</script>';
?>
<?php
}
function yigefav_media_menu_handle() {
    return wp_iframe( 'media_yigefav_process');
}
add_action('media_upload_yigefav', 'yigefav_media_menu_handle');


// Insert MP3
function yigemp_media_menu($tabs) {
$newtab = array('yigemp'=>'插入MP3音乐');
return array_merge($tabs, $newtab);
}
add_filter('media_upload_tabs', 'yigemp_media_menu');

function media_yigemp_process() {
media_upload_header();
$wp1g_plugin_url= WP_PLUGIN_URL.'/'.str_replace(basename( __FILE__),"",plugin_basename(__FILE__));
//原window.php
?>
<script type="text/javascript">function insert1gByURL(){var tagtext;var play=document.getElementById("wplay_url").value;play=play.replace(/\s/g,"&nbsp");var autoplay=document.getElementById("autoplay_url").checked;tagtext='[music1g play='+play+' autoplay='+autoplay+']';var win=window.dialogArguments||opener||parent||top;win.send_to_editor(tagtext);return false}</script>
<style type="text/css">body{font-size:13px;font-family:"微软雅黑","文泉驿微米黑","Comic Sans MS"}
#listbox{font-size:12px;font-family:"微软雅黑","文泉驿微米黑","Comic Sans MS"}
#sharebutton{width:30px;color:#099}
</style>
<table><tbody><tr><td width="400px"><p style="font-size: 13px;" align="center">请输入歌曲URL（仅支持mp3格式）</p></td></tr><tr><td width="400px"><input type="checkbox" id="autoplay_url" /> 自动播放</td></tr><tr><td align="center"><input type="text" id="wplay_url" size="40px" style="font-size: 13px;" /><input type="button" id="insert2" value="插入" onClick="insert1gByURL();" style="font-size: 13px;" /></td></tr></tbody></table>

<?php
}
function yigemp_media_menu_handle() {
    return wp_iframe( 'media_yigemp_process');
}
add_action('media_upload_yigemp', 'yigemp_media_menu_handle');

/* Add settings link on plugin page */
add_filter("plugin_action_links_" . plugin_basename(__FILE__), 'wp1g_settings_link');

function wp1g_settings_link($links) {
  $settings_link = '<a href="options-general.php?page=1gshare">设置</a>&nbsp;|&nbsp;<a href="http://www.yeeg.com">亦歌官网</a>';
  array_unshift($links, $settings_link);
  return $links;
}

?>