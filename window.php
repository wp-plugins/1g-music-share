<?php
$wpconfig = realpath("../../../wp-config.php");
if (!file_exists($wpconfig))  {
	echo "Could not found wp-config.php. Error in path :\n\n".$wpconfig ;	
	die;	
}
require_once($wpconfig);
require_once(ABSPATH.'/wp-admin/admin.php');
global $wpdb;
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>插入音乐</title>	
	<script language="javascript" type="text/javascript" src="<?php echo get_option('siteurl') ?>/wp-includes/js/tinymce/tiny_mce_popup.js"></script>
	<script language="javascript" type="text/javascript" src="<?php echo get_option('siteurl') ?>/wp-includes/js/tinymce/utils/form_utils.js"></script>
	<script language="javascript" type="text/javascript" src="<?php echo get_option('siteurl') ?>/wp-content/plugins/1g-music-share/tinymce.js"></script>
	<script language="javascript" type="text/javascript" src="<?php echo get_option('siteurl') ?>/wp-content/plugins/1g-music-share/getsearch.js"></script>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<script type="text/javascript">
function enterIn(evt){
  var evt=evt?evt:(window.event?window.event:null);//兼容IE和FF
  if (evt.keyCode==13){
  showHint();
}
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
}
</style>
</head>
	<body>
<!-- <form onsubmit="insertLink();return false;" action="#"> -->
		<table >
         <tbody>
         <tr><td width="400px"><p style="font-size: 13px;" align="center">请输入歌手、歌名、专辑名进行搜索</p></td></tr>
            <tr><td align="center"><input type="text" id="wplay" size="40px"  style="font-size: 13px;" onkeydown="enterIn(event);" />
              <input type="button" id="insert2" value="搜索" onClick="showHint();"  style="font-size: 13px;" /></td>
            </tr>
         </tbody>
         </table>
		<div id="searchlists">
		</div>
</body>
</html>