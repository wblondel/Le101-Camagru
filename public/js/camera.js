//L’ensemble de votre application devra être au minimum compatible sur Firefox (>= 41) et Chrome (>= 46)

var effectCanvas = document.getElementById("effect-canvas");
var effectCanvasContext = effectCanvas.getContext("2d");
var effectImgElement;

// add a clickEventListener to all effects
var effects = document.querySelectorAll(".effect");

Array.prototype.forEach.call(effects, function (effect, i) {
    effect.addEventListener("click", function (e) {
        e.preventDefault();
        effectImgElement = effect.getElementsByTagName('img')[0];
        drawImage();
    })
});

function drawImage()
{
    effectCanvas.width = effectImgElement.width;
    effectCanvas.height = effectImgElement.height;
    effectCanvasContext.drawImage(effectImgElement, 0, 0, effectImgElement.width, effectImgElement.height);
}

// ------------------------------------------------------------------------------------------------


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
            // change maxheight of history list
            var historyList = document.getElementById("pictures-history");
            historyList.style.maxHeight = video.clientHeight + "px";

            // Get a screenshot of the video
            var screenshotCanvas = document.getElementById("screenshot-canvas");
            screenshotCanvas.width = video.clientWidth;
            screenshotCanvas.height = video.clientHeight;
            var screenshotCanvasContext = screenshotCanvas.getContext("2d");
            screenshotCanvasContext.drawImage(video, 0, 0, screenshotCanvas.width, screenshotCanvas.height);
            var screenshotDataURI = screenshotCanvas.toDataURL('image/jpeg');

            // Get the effect
            var effectDataURI = effectCanvas.toDataURL('image/jpeg');

            // Get position of effect
            var effectPosition = [effectCanvas.clientTop, effectCanvas.clientLeft];

            // Send image to PHP
            var formData = new FormData;
            formData.append("screenshot", screenshotDataURI);
            formData.append("effect", effectDataURI);
            formData.append("position", effectPosition);
            var xhr = new XMLHttpRequest();

            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4) {
                    if (xhr.status != 200) {
                        console.log("Can't comment.");
                    } else {
                        var results = JSON.parse(xhr.responseText);
                        console.log(results);

                        var imageToPut = results['imageFilename'];

                        var picturesHistory = document.getElementById("pictures-history");
                        divToAppend = document.createElement('li');
                        divToAppend.innerHTML = '<img src="/uploads/pictures/' + imageToPut + '" class="img-fluid" alt="' + imageToPut + '">';
                        picturesHistory.prepend(divToAppend);
                        // Write the image to the history
                        /*
                        var canvas = document.getElementById("canvas");
                        canvas.width = video.clientWidth;
                        canvas.height = video.clientHeight;
                        var c2d = canvas.getContext("2d");
                        c2d.drawImage(video, 0, 0, canvas.width, canvas.height);
                        var image = document.getElementById("photo");
                        image.src = canvas.toDataURL("image/png");
                        */

                    }
                }
            };

            xhr.open('POST', '/i/new', true);
            xhr.setRequestHeader('X-Requested-With', 'xmlhttprequest');
            xhr.send(formData);
        })
    })
    .catch(function (err) {
        console.log(err.name + ": " + err.message);
    });


// ----------------------------------------------



// ----------------------------

function previewFile()
{
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
