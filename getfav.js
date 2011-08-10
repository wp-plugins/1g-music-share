var xmlHttp

function showFav(user)
{
str = user
xmlHttp=GetXmlHttpObject()
if (xmlHttp==null)
  {
  alert ("Browser does not support HTTP Request")
  return
  } 
var url="getfav.php"
url=url+"?user="+str
xmlHttp.onreadystatechange=stateChangedFav 
xmlHttp.open("GET",url,true)
xmlHttp.send(null)
document.getElementById("searchlistsfav").innerHTML='<p>获取收藏记录中...<p>'
} 

function showFav_input()
{
str = document.getElementById("wplay_user").value
xmlHttp=GetXmlHttpObject()
if (xmlHttp==null)
  {
  alert ("Browser does not support HTTP Request")
  return
  } 
var url="getfav.php"
url=url+"?user="+str
xmlHttp.onreadystatechange=stateChangedFav 
xmlHttp.open("GET",url,true)
xmlHttp.send(null)
document.getElementById("searchlistsfav").innerHTML='<p>获取收藏记录中...<p>'
} 

function stateChangedFav() 
{ 
if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
 { 
if (xmlHttp.status == 200) { 
 document.getElementById("searchlistsfav").innerHTML=xmlHttp.responseText 
 } 
}
}

function GetXmlHttpObject()
{
var xmlHttp=null;
try
 {
 // Firefox, Opera 8.0+, Safari
 xmlHttp=new XMLHttpRequest();
 }
catch (e)
 {
 // Internet Explorer
 try
  {
  xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
  }
 catch (e)
  {
  xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
 }
return xmlHttp;
}
