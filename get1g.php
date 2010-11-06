<?php
$doc = simplexml_load_file("http://search.1g1g.com/public/songs?encoding=utf8&query=".mb_convert_encoding($_GET['q'], "UTF-8","GB2312,UTF-8"));
echo '<label>搜索结果：</label>';
echo '<ul id="musicSearchResult" style="list-style-image:none;list-style:none;">';
$search = "";
foreach ($doc->songlist->song as $item) {
  echo '<li>';
  echo $item->name.' - '.$item->singer.' - '.$item->album;
  echo '<span class="music_sp_color" onclick="insertWP1GMPcode(';
  echo $item->id;
  echo ')">分享</span></li>';
}
echo  '</ul>';
?>