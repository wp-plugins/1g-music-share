<?php
$doc = simplexml_load_file("http://search.1g1g.com/public/songs?encoding=utf8&query=".mb_convert_encoding($_GET['q'], "UTF-8","GB2312,UTF-8"));
echo '<label for="wp1gmp_play">搜索结果：</label>';
echo '<td><select id="wp1gmp_play" name="wp1gmp_play" style="width: 200px">';
$search = "";
foreach ($doc->songlist->song as $item) {
  echo '<option value="#';
  echo $item->id;
  echo '">';
  echo $item->name.' - '.$item->singer.' - '.$item->album;
  echo '</option>';
}
echo  '</select>';
?>