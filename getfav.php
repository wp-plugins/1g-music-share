<?php
if(!$_GET['user'])
{
echo '未设置亦歌用户名，请在<a href="options-general.php?page=wp-1g.php">设置页</a>设置';
}
else
{
if (function_exists('curl_init')){
   $ch=curl_init();
   curl_setopt($ch, CURLOPT_URL, "http://www.micromacer.com/getfav.php?user=".mb_convert_encoding($_GET['user'], "UTF-8","GB2312,UTF-8"));
   curl_setopt($ch, CURLOPT_HEADER, 0);
   curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
   curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; )');
   $content=curl_exec($ch);
   echo $content;
   curl_close($ch);
} 
}
?>
