 <?php
if(!$_GET['user'])
{
echo 'æ~\ªè®¾ç½®äº¦æ­~Lç~T¨æ~H·å~P~Mï¼~Lè¯·å~\¨<a href="options-general.php?page=wp-1g.php">è®¾ç½®é¡µ</a>è®¾ç½®';
}
else
(
 $doc = simplexml_load_file("http://www.1g1g.com/list/load.jsp?type=pool&start=0&magic=566462981&encoding=utf8&number=130&username=".mb_convert_encoding($_GET['user'], "UTF-8","GB2312,UTF-8"));
echo '<label style="font-size:12px;">用户'.$_GET['user'].'的收藏记录</label>';
echo '<table id="listbox" width="370">';
foreach ($doc->songlist->song as $item) {
  echo '<tr><th width="320" >';
  echo $item->name.' - '.$item->singer.' - '.$item->album;
  echo '</th><th width="38" id="sharebutton" ><div onClick="javascript:insert1gByFavID(';
  echo $item->id;
  echo ')">分享</div></th></tr>';
}
echo  '</table>';
}
 ?>
