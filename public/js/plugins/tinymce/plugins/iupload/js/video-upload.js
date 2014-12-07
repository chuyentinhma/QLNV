
function getTinymce() {
	var win = (!window.frameElement && window.dialogArguments) || opener || parent || top;
	return win.tinymce;
}

var tinymce = getTinymce();
var videoUploadURL = tinymce.videoUploadURL;
var baseUrl = tinymce.baseUrl;


//upload photo
$('#input-video').fileupload({
	url: videoUploadURL,
	dataType: 'json',
	done: function(data) {
		//console.log(data);
	},
	success: function(data) {
		if (data['status'] == 1) {
			var uploadedPath = baseUrl;
			if (data['container'] == 's3') {
				uploadedPath = data['video_path'];
			} else {
				uploadedPath += data['video_path'];
			}

			//var videoItem = '<div class="audio-item"><p>Video appended<p><video id="videoSample" class="video-js vjs-default-skin" controls width="660" height="275" preload="auto" poster="http://video-js.zencoder.com/oceans-clip.png"><source type="video/mp4" src="'+uploadedPath+'"></video></div>';
			var videoItem = '<video controls id="' + data['file_name'] + '" class="video-js vjs-default-skin" controls width="660" height="275" preload="auto" poster="http://video-js.zencoder.com/oceans-clip.png">' +
					'<source type="video/webm" data-mce-src="' + uploadedPath + '"  src="' + uploadedPath + '">' +
					'</video>';
			tinymce.listVideos.push(uploadedPath);
			tinymce.EditorManager.activeEditor.insertContent(videoItem);
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