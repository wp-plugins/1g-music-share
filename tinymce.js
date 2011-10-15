function init() {
	tinyMCEPopup.resizeToInnerSize();
}

function getCheckedValue(radioObj) {
	if(!radioObj)
		return "";
	var radioLength = radioObj.length;
	if(radioLength == undefined)
		if(radioObj.checked)
			return radioObj.value;
		else
			return "";
	for(var i = 0; i < radioLength; i++) {
		if(radioObj[i].checked) {
			return radioObj[i].value;
		}
	}
	return "";
}

function insert1gByID(id) {

	var tagtext;
	var play = id;
	var autoplay = document.getElementById("autoplay_search").checked;

	tagtext = '[music1g play=#' + play + ' autoplay=' + autoplay + ']';

	window.tinyMCE.execInstanceCommand('content', 'mceInsertContent', false, tagtext);
	tinyMCEPopup.editor.execCommand('mceRepaint');
	tinyMCEPopup.close();
	return;
}

function insert1gByFavID(id) {

	var tagtext;
	var play = id;
	var autoplay = document.getElementById("autoplay_fav").checked;

	tagtext = '[music1g play=#' + play + ' autoplay=' + autoplay + ']';

	window.tinyMCE.execInstanceCommand('content', 'mceInsertContent', false, tagtext);
	tinyMCEPopup.editor.execCommand('mceRepaint');
	tinyMCEPopup.close();
	return;
}

function insert1gByURL() {

	var tagtext;
	var play = document.getElementById("wplay_url").value;
    play = play.replace(/\s/g,"&nbsp"); 
	var autoplay = document.getElementById("autoplay_url").checked;
	tagtext = '[music1g play=' + play + ' autoplay=' + autoplay + ']';

	window.tinyMCE.execInstanceCommand('content', 'mceInsertContent', false, tagtext);
	tinyMCEPopup.editor.execCommand('mceRepaint');
	tinyMCEPopup.close();
	return;
}