
function getTinymce() {
	var win = (!window.frameElement && window.dialogArguments) || opener || parent || top;
	return win.tinymce;
}

var tinymce = getTinymce();
var photoUploadURL = tinymce.photoUploadURL;
var baseUrl = tinymce.baseUrl;

//upload photo
$('#input-photo').fileupload({
	url: photoUploadURL,
	dataType: 'json',
	done: function(data) {
		//console.log(data);
	},
	success: function(data) {
		if (data['status'] == 1) {
			var uploadedPath = baseUrl;
			if (data['container'] == 's3') {
				uploadedPath = data['photo_path'];
			} else {
				uploadedPath += data['photo_path'];
			}

			console.log(uploadedPath);
			var imgItem = '<img data-mce-src="'+uploadedPath+'" src = "'+uploadedPath+'"/>';
			console.log(imgItem);
			tinymce.listPhotos.push(uploadedPath);
			tinymce.EditorManager.activeEditor.insertContent(imgItem);
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