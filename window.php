<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>插入音乐</title>
	<script language="javascript" type="text/javascript" src="/wp-includes/js/tinymce/tiny_mce_popup.js"></script>
	<script language="javascript" type="text/javascript" src="/wp-content/plugins/1g-music-share/tinymce.js"></script>
	<script language="javascript" type="text/javascript" src="/wp-content/plugins/1g-music-share/getsearch.js"></script>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<style type="taxt/css" >
body{
    font-family:"微软雅黑","宋体","Lucida Grande";
    font-size:12px;
}
p, h1, form, button{border:0; margin:0; padding:0;}
.spacer{clear:both; height:1px;}
input{
    float:left;
    font-size:12px;
    padding:4px 2px;
    border:solid 1px #aacfe4;
    width:210px;
    margin:2px 0 20px 10px;
}</style>

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
</head>
	<body id="link" onload="tinyMCEPopup.executeOnLoad('init();');document.body.style.display='';" style="display: none" class="stylized">
<!-- <form onsubmit="insertLink();return false;" action="#"> -->
	    <p><label  for="wplay">请输入歌手、歌名、专辑名进行搜索</label></p>
             <p><input type="text" id="wplay" onkeydown="KeyDown()" />
            <input type="button" id="insert" value="搜索" onClick="showHint();" /></p>
		<div id="searchquery">
		</div>
		<div id="searchlists">
		</div>
<div style="float: right"  class="stylized">
			    <input class="stylized" type="button" id="insert" name="insert" value="插入" onclick="insertWP1GMPcode();" />
	  </div>
</body>
</html>