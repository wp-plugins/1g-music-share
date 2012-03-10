<?php
if(!$_GET['user'])
{
echo 'Have not set the 1g1g.com username, please go to<a href="options-general.php?page=wp-1g.php">Setting Page</a> to set it.';
}
else
{
$doc = simplexml_load_file("http://www.1g1g.com/list/load.jsp?type=pool&start=0&magic=566462981&encoding=utf8&number=130&username=".$_GET['user']);
echo '<label style="font-size:12px">'.$_GET['user']."'s fav log:</label>";
echo '<table id="listbox" width="370">';
foreach ($doc->songlist->song as $item) {
  echo '<tr><th width="320" >';
  echo $item->name.' - '.$item->singer.' - '.$item->album;
  echo '</th><th width="38" id="sharebutton" ><div onClick="javascript:insert1gByFavID(';
  echo $item->id;
  echo ')">Share!</div></th></tr>';
}
echo  '</table>';
}
?>
