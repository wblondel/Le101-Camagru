//L’ensemble de votre application devra être au minimum compatible sur Firefox (>= 41) et Chrome (>= 46)

// Older browsers might not implement mediaDevices at all, so we set an empty object first
if (navigator.mediaDevices === undefined) {
    navigator.mediaDevices = {};
}

// Some browsers partially implement mediaDevices. We can't just assign an object
// with getUserMedia as it would overwrite existing properties.
// Here, we will just add the getUserMedia property if it's missing.
if (navigator.mediaDevices.getUserMedia === undefined) {
    navigator.mediaDevices.getUserMedia = function (constraints) {

        // First get ahold of the legacy getUserMedia, if present
        var getUserMedia = navigator.webkitGetUserMedia || navigator.mozGetUserMedia;

        // Some browsers just don't implement it - return a rejected promise with an error
        // to keep a consistent interface
        if (!getUserMedia) {
            return Promise.reject(new Error('getUserMedia is not implemented in this browser'));
        }

        // Otherwise, wrap the call to the old navigator.getUserMedia with a Promise
        return new Promise(function (resolve, reject) {
            getUserMedia.call(navigator, constraints, resolve, reject);
        });
    }
}

navigator.mediaDevices.getUserMedia({audio: false, video: true})
    .then(function (stream) {
        var video = document.getElementById("video");
        var button = document.getElementById('startbutton');

        // Older browsers may not have srcObject
        if ("srcObject" in video) {
            video.srcObject = stream;
        } else {
            // Avoid using this in new browsers, as it is going away.
            video.src = window.URL.createObjectURL(stream);
        }
        video.onloadedmetadata = function (e) {
            video.play();
        };

        button.addEventListener("click", function () {
            var canvas = document.getElementById("canvas");
            canvas.width = video.clientWidth;
            canvas.height = video.clientHeight;
            var c2d = canvas.getContext("2d");
            c2d.drawImage(video, 0, 0, canvas.width, canvas.height);
            var image = document.getElementById("photo");
            image.src = canvas.toDataURL("image/png");
        })
    })
    .catch(function (err) {
        console.log(err.name + ": " + err.message);
    });



// add a clickEventListener to all effects
var effects = document.querySelectorAll(".effect");

Array.prototype.forEach.call(effects, function (effect, i) {
    effect.addEventListener("click", function (e) {
        e.preventDefault();

        var effectImgElement = effect.getElementsByTagName('img')[0];
        var effectCanvas = document.getElementById("effect-canvas").getContext("2d");
        effectCanvas.drawImage(effectImgElement, 0, 0, effectImgElement.width, effectImgElement.height);
    })
});



function previewFile() {
    var preview = document.getElementById("photo");
    var file = document.querySelector('input[type=file]').files[0];
    var reader = new FileReader();
    var imageType = /image.*/;

    reader.addEventListener("load", function () {
        preview.src = reader.result;
    }, false);

    if (file.type.match(imageType)) {
        if (file) {
            reader.readAsDataURL(file);
        }
    }
}
