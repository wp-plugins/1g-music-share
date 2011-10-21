<?php
$wpconfig = realpath("../../../wp-config.php");
if (!file_exists($wpconfig))  {
	echo "Could not found wp-config.php. Maybe you use it in none WordPress site. Error in path :\n\n".$wpconfig ;	
	die;	
}
require_once($wpconfig);
require_once(ABSPATH.'/wp-admin/admin.php');
require_once(ABSPATH.'/wp-load.php');
global $wpdb;
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>插入亦歌播放器</title>
	<script language="javascript" type="text/javascript" src="getsearch.js"></script>
	<script language="javascript" type="text/javascript" src="getfav.js"></script>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<?php
wp_admin_css( 'global', true );
wp_admin_css( 'wp-admin', true );
?>

<script type="text/javascript">
function enterIn(evt){
    var evt=evt?evt:(window.event?window.event:null);
    if (evt.keyCode==13){
        showHint();
    }
}
function d(id) { return document.getElementById(id); }
function flipTab(n) {
	for (i=1;i<=4;i++) {
		c = d('content'+i.toString());
		t = d('tab'+i.toString());
		if ( n == i ) {
            c.className = '';
            t.className = 'current';
		} else {
			c.className = 'hidden';
			t.className = '';
		}
	}
}
function insert1gByID(id) {

	var tagtext;
	var play = id;
	var autoplay = document.getElementById("autoplay_search").checked;

	tagtext = '[music1g play=#' + play + ' autoplay=' + autoplay + ']';


	var win = window.dialogArguments || opener || parent || top;
	win.send_to_editor(tagtext );
	return false;
}

function insert1gByFavID(id) {

	var tagtext;
	var play = id;
	var autoplay = document.getElementById("autoplay_fav").checked;

	tagtext = '[music1g play=#' + play + ' autoplay=' + autoplay + ']';

	var win = window.dialogArguments || opener || parent || top;
	win.send_to_editor(tagtext );
	return false;
}

function insert1gByURL() {

	var tagtext;
	var play = document.getElementById("wplay_url").value;
    play = play.replace(/\s/g,"&nbsp"); 
	var autoplay = document.getElementById("autoplay_url").checked;
	tagtext = '[music1g play=' + play + ' autoplay=' + autoplay + ']';

	var win = window.dialogArguments || opener || parent || top;
	win.send_to_editor(tagtext );
	return false;
}
</script>
<style type="text/css">
body {
	font-family: "微软雅黑", "文泉驿微米黑", "Comic Sans MS";
	font-size: 13px;
}
#listbox {
	font-family: "微软雅黑", "文泉驿微米黑", "Comic Sans MS";
	font-size: 12px;
}
#sharebutton {
	color: #099;
	width: 30px;
}
#tabs {
	padding: 15px 15px 3px;
	background-color: #f1f1f1;
	border-bottom: 1px solid #dfdfdf;
}
#tabs li {
	display: inline;
}
#tabs a.current {
	background-color: #fff;
	border-color: #dfdfdf;
	border-bottom-color: #fff;
	color: #d54e21;
}
#tabs a {
	color: #2583AD;
	padding: 6px;
	border-width: 1px 1px 0;
	border-style: solid solid none;
	border-color: #f1f1f1;
	text-decoration: none;
}
#tabs a:hover {
	color: #d54e21;
}
#flipper {
	margin: 0;
	padding: 5px 20px 10px;
	background-color: #fff;
	border-left: 1px solid #dfdfdf;
	border-bottom: 1px solid #dfdfdf;
}
* html {
    overflow-x: hidden;
    overflow-y: scroll;
}
#flipper div p {
	margin-top: 0.4em;
    margin-bottom: 0.8em;
	text-align: justify;
}
</style>
</head>
	<body>
<ul id="tabs">
	<li><a id="tab1" href="javascript:flipTab(1)" title="搜索音乐" accesskey="1" tabindex="1" class="current">搜索音乐</a></li>
	<li><a id="tab2" href="javascript:flipTab(2)" title="通过URL添加" accesskey="2" tabindex="2">通过URL添加</a></li>
	<li><a id="tab3" href="javascript:flipTab(3)" title="从亦歌收藏中添加" accesskey="3" tabindex="3">从亦歌收藏中添加</a></li>
</ul>
<div id="flipper" class="wrap">

<div id="content1">
	<table><tbody>
        <tr><td width="400px"><p style="font-size: 13px;" align="center">请输入歌手、歌名、专辑名进行搜索</p></td></tr>
	<tr><td width="400px"><input type="checkbox" id="autoplay_search" /> 自动播放</td></tr>
        <tr><td align="center"><input type="text" id="wplay" size="40px"  style="font-size: 13px;" onkeydown="enterIn(event);" />
            <input type="button" id="insert2" value="搜索" onClick="showHint();"  style="font-size: 13px;" /></td>
        </tr>
    </tbody></table>
    <div id="searchlists"></div>
</div>

<div id="content2" class="hidden">
	<table><tbody>
        <tr><td width="400px"><p style="font-size: 13px;" align="center">请输入歌曲URL（仅支持mp3格式）</p></td></tr>
	<tr><td width="400px"><input type="checkbox" id="autoplay_url" /> 自动播放</td></tr>
        <tr><td align="center"><input type="text" id="wplay_url" size="40px"  style="font-size: 13px;" />
            <input type="button" id="insert2" value="插入" onClick="insert1gByURL();"  style="font-size: 13px;" /></td>
        </tr>
    </tbody></table>
</div>

<div id="content3" class="hidden">
	<table><tbody>
	<tr><td width="400px"><input type="checkbox" id="autoplay_fav" /> 自动播放</td></tr>
        <tr><td width="400px"><p style="font-size: 13px;" align="center">请输入亦歌用户名</p></td></tr>
        <tr><td align="center"><input type="text" id="wplay_user" size="40px"  style="font-size: 13px;" value="<?php $options = get_option('wp1gsettings');echo $options['user']; ?>" />
            <input type="button" id="insert2" value="读取" onClick="showFav_input();" style="font-size: 13px;"  /></td>
        </tr>
    </tbody></table>
    <div id="searchlistsfav"></div>
</div>
<?php
$options = get_option('wp1gsettings');
if(isset($options['user']))
	echo '<script type="text/javascript">showFav("'.$options['user'].'");</script>';
?>
</body>
</html>
