// Docu : http://wiki.moxiecode.com/index.php/TinyMCE:Create_plugin/3.x#Creating_your_own_plugins

(function() {
	// Load plugin specific language pack
	tinymce.PluginManager.requireLangPack('wp1gmp');
	 
	tinymce.create('tinymce.plugins.wp1gmp', {
		
		init : function(ed, url) {
		// Register the command so that it can be invoked by using tinyMCE.activeEditor.execCommand('mceExample');

			ed.addCommand('wp1gmp', function() {
				ed.windowManager.open({
					file : url + '/window.php',
					width : 400,
					height : 168,
					inline : 1
				}, {
					plugin_url : url // Plugin absolute URL
				});
			});

			// Register example button
			ed.addButton('wp1gmp', {
				title : '亦歌',
				cmd : 'wp1gmp',
				image : url + '/note_20.png'
			});
			
			// Add a node change handler, selects the button in the UI when a image is selected
			ed.onNodeChange.add(function(ed, cm, n) {
				cm.setActive('wp1gmp', n.nodeName == 'IMG');
			});
		},
		createControl : function(n, cm) {
			return null;
		},
		getInfo : function() {
			return {
					longname  : '1g-music-share',
					author 	  : 'Ye Xiaoxing',
					authorurl : 'http://blog.1g1g.info',
					infourl   : 'http://blog.1g1g.info',
					version   : "0.5"
			};
		}
	});

	// Register plugin
	tinymce.PluginManager.add('wp1gmp', tinymce.plugins.wp1gmp);
})();


