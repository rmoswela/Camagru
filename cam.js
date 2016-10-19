var video = document.querySelector("#videoElement");//get the video element
var canvas = document.querySelector('canvas'); //get the canvas element
var ctx = canvas.getContext('2d');
var localMediaStream = null;

//var idx = 0;
//var filters = ['grayscale', 'blur', 'brightness', 'contrast','hue-rotate', 'saturate', 'invert','']

//to make sure it works cross browser
navigator.getUserMedia = navigator.getUserMedia || navigator.webkitGetUserMedia || navigator.mozGetUserMedia || navigator.msGetUserMedia || navigator.oGetUserMedia;

//ensure it works cross browser
window.URL = window.URL || window.mozURL || window.webkitURL;

if (navigator.getUserMedia)
{
	navigator.getUserMedia({video: true, audio: true}, handleVideo, videoError);
}
else
{
	if (!fallback())
	{
		alert("getUserMedia is not supported in your browser");
	}
	else
		fallback();
}

//function used if the browser does not support getUserMedia
function fallback(e)
{
	video.src = 'fallbackvideo.webm';
}

//function called calling video is successful
function handleVideo(stream)
{
	//set the video element to receive input from the webcam
	video.src = window.URL.createObjectURL(stream);
	localMediaStream = stream;
}

//function called if there is error accessing the webcam
function videoError(e)
{
	document.write("Error accessing your webcam");
}

function snapShot()
{
	if (localMediaStream)
	{
		//change the size of the canvas image
		//canvas.width = 100px;
		//canvas.height = 100px;
		ctx.drawImage(video, 0, 0);//draw the video frame to the canvas

		//extract image data from canvas in base64
		//encode png format or you could use image/jpeg
		var imgData = canvas.toDataURL('image/png');
		imgData = imgData.replace('data:image/png; base64,', '');

		//JSON encode it
		var postData = JSON.stringify({ imageData: imgData });

		//post to server
		/*$.ajax({
			url: '[host]',
			type: 'POST',
			data: postData,
			contentType: 'application/json'});*/
		//remember that this data is encoded and you have decode first
		//and serialize the array to be stored in the server
		//.done(function(respond){console.log("done: " + respond);})
		//.fail(function(respond){console.log("fail");})
		//.always(function(respond){console.log("always");})

		document.querySelector('img').src = canvas.toDataURL('image/png');//filter images
	}
}

/*//filter images
  function changeFilter(e)
  {
  var el = e.target;
  el.className = '';
  var effect = filters[idx++ % filters.length]; //loop through filters
  if (effect)
  {
  el.classList.add(effect);
  }
  }*/

//document.querySelector('video').addEventListener('click', changeFilter, false);
video.addEventListener('click',snapShot, false);
