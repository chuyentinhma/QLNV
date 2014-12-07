
function getTinymce() {
	var win = (!window.frameElement && window.dialogArguments) || opener || parent || top;
	return win.tinymce;
}

var tinymce = getTinymce();
var audioUploadURL = tinymce.audioUploadURL;
var baseUrl = tinymce.baseUrl;


//upload photo
$('#input-audio').fileupload({
	url: audioUploadURL,
	dataType: 'json',
	done: function(data) {
		//console.log(data);
	},
	success: function(data) {
		if (data['status'] == 1) {
			var uploadedPath = baseUrl;
			if (data['container'] == 's3') {
				uploadedPath = data['audio_path'];
			} else {
				uploadedPath += data['audio_path'];
			}
			var audioItem = '<audio id="' + data['file_name'] + '" controls data-mce-src="'+uploadedPath+'"  src="' + uploadedPath + '">' +
					'Your browser does not support the audio element.' +
					'</audio>';
			tinymce.listAudios.push(uploadedPath);
			tinymce.EditorManager.activeEditor.insertContent(audioItem);
			tinymce.EditorManager.activeEditor.windowManager.close(window);
		}
		else {
			$("#message").show();
			$("#message").html(data['messages']);
		}

	},
	progressall: function(e, data) {
		var progress = parseInt(data.loaded / data.total * 100, 10);
		$('#progress .bar').css(
				'width',
				progress + '%'
				);
	}
});