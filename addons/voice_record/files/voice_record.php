<?php if(boomAllow($addons['addons_access']) && ($addons['custom2'] == 1 || $addons['custom3'] == 1)){ ?>
<script data-cfasync="false">
URL = window.URL || window.webkitURL;

$(document).ready(function(){
	
	let recordingIsActive = false;
	let remainingTime = 0;
	let gumStream;
	let recorder;
	let input;
	let AudioContext = window.AudioContext || window.webkitAudioContext;
	let audioContext;
	
	function voiceRecord(type, recTimer) {
		recorder = undefined;
		const constraints = {audio: true, video: false};
		navigator.mediaDevices.getUserMedia(constraints).then(stream => {
			if (recordingIsActive) return false;
			recordingIsActive = true;
			audioContext = new AudioContext();
			gumStream = stream;
			input = audioContext.createMediaStreamSource(stream);
			recorder = new WebAudioRecorder(input, {
				workerDir: "addons/voice_record/files/",
				encoding: 'mp3',
				numChannels: 2,
				onEncoderLoading: (recorder, encoding) => {
				},
				onEncoderLoaded: (recorder, encoding) => {
				}
			});
			recorder.onComplete = (recorder, blob) => {
				var formData = new FormData();
				formData.append('file', blob);
				formData.append('token', utk);
				<?php if($addons['custom3'] == 1){ ?>
				if(type == 'private'){
					formData.append('target', $('#get_private').attr('value'));
					formData.append('private', 1);
				}
				<?php } ?>
				$.ajax('addons/voice_record/system/blob_chat.php', {
					method: "POST",
					data: formData,
					processData: false,
					contentType: false,
					success: function (response) {
						if(response == 0){
							callSaved(system.error, 3);
						}
						if(response == 1){
							callSaved(system.wrongFile, 3);
						}
						if(response == 2){
							callSaved(system.cannotContact, 3);
						}
						$('#record_'+type).removeClass('fa-spinner fa-spin fa-fw');
						$('#record_'+type).addClass('fa-microphone');
						$('#record_'+type).attr('data', 0);
					},
					error: function () {
					}
				});
			};
			recorder.setOptions({
				timeLimit: recTimer,
				encodeAfterRecord: true,
				mp3: {bitRate: 96}
			});
			recorder.startRecording();
			if (recTimer !== 0) {
				const time_callback = _RemainingTime => {
					if (_RemainingTime === 0 && recordingIsActive) {
						stopRecording(type);
					}
				};
				voiceTimer(recTimer, time_callback);
			}
			$('#record_'+type).attr('data', 1);
			$('#record_'+type).removeClass('fa-microphone');
			$('#record_'+type).addClass('fa-circle voice_recording');

		}).catch((errors) => {
			console.log(errors);
			alert('Please allow microphone access!');
		});

	}
	function stopRecording(type) {
		remainingTime = 0;
		recordingIsActive = false;
		$('#record_'+type).removeClass('fa-circle voice_recording');
		$('#record_'+type).addClass('fa-spinner fa-spin fa-fw');
		gumStream.getAudioTracks()[0].stop();
		recorder.finishRecording();
	}
	function voiceTimer(seconds, cb) {
		remainingTime = seconds;
		setTimeout(() => {
			cb(remainingTime);
			if (remainingTime > 0) {
				voiceTimer(remainingTime - 1, cb);
			}
		}, 1000);
	}
	function runVoiceRecord(item){
		var s = $(item).attr('data');
		var t = $(item).attr('data-type');
		if(s == 0){
			if(t == 'chat'){
				var m = <?php echo $addons['custom4']; ?>;
			}
			if(t == 'private'){
				var m = <?php echo $addons['custom4']; ?>;
			}
			voiceRecord(t, m);
		}
		else {
			stopRecording(t);
		}
	}

	<?php if($addons['custom2'] == 1){?>
	$('<div class="input_item main_item base_main"><i class="fa fa-microphone" data="0" data-type="chat" id="record_chat"></i></div>').insertAfter('#main_input_box');
	<?php }?>
	<?php if($addons['custom3'] == 1){?>
	$('<div class="input_item main_item base_main"><i class="fa fa-microphone" data="0" data-type="private" id="record_private"></i>').insertAfter('#private_input_box');
	<?php } ?>
	$(document).on("click", "#record_chat, #record_private", function(){ 
		runVoiceRecord($(this));
	});
	boomAddCss('addons/voice_record/files/voice_record.css');
	
});
</script>
<script data-cfasync="false" src="addons/voice_record/files/WebAudioRecorder.min.js"></script>
<?php } ?>