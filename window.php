<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>插入音乐</title>
	<script language="javascript" type="text/javascript" src="/wp-includes/js/tinymce/tiny_mce_popup.js"></script>
	<script language="javascript" type="text/javascript" src="/wp-content/plugins/1g-music-share/tinymce.js"></script>
	<script language="javascript" type="text/javascript" src="/wp-content/plugins/1g-music-share/getsearch.js"></script>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<script language="javascript">
function KeyDown()
{
　　if (event.keyCode == 13)
　　{
　　　　event.returnValue=false;
　　　　event.cancel = true;
　　　　showHint();
　　}
}
</script>
<style type="text/css">
body {
	font-family: "微软雅黑", "文泉驿微米黑", "Comic Sans MS";
	font-size: 13px;
}
#musicSearchResult ul {
font-size:14px;
height: 85px;
list-style-image:none;list-style:none;
}
#musicSearchResult li {
font-size:14px;
border-bottom: 1px solid #CCC;
clear: both;
}
#musicSearchResult li span {
clear: both;
float: right;
}
#musicSearchResult .music_sp_color {
color: #046F9E;
}
</style>
</head>
	<body>
<!-- <form onsubmit="insertLink();return false;" action="#"> -->
		<table >
         <tbody>
         <tr><td width="400px"><p style="font-size: 13px;" align="center">请输入歌手、歌名、专辑名进行搜索</p></td></tr>
            <tr><td align="center"><input type="text" id="wplay" onkeydown="KeyDown()" size= "42px"  style="font-size: 13px;"/>
              <input type="button" id="insert2" value="搜索" onClick="showHint();"  style="font-size: 13px;" /></td>
            </tr>
         </tbody>
         </table>
		<div id="searchlists">
		</div>
</body>
</html>