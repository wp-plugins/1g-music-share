 <?php
$doc = simplexml_load_file("http://search.1g1g.com/public/songs?encoding=utf8&query=".$_GET['q']);
echo '<label style="font-size:12px;">搜索结果：</label>';
echo '<table id="listbox" width="370">';
foreach ($doc->songlist->song as $item) {
  echo '<tr><th width="320" >';
  echo $item->name.' - '.$item->singer.' - '.$item->album;
  echo '</th><th width="38" id="sharebutton" ><div onClick="javascript:insert1gByID(';
  echo $item->id;
  echo ')">分享</div></th></tr>';
}
echo  '</table>';
 ?>
