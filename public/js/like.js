var getHttpRequest = function () {
    var httpRequest = false;

    if (window.XMLHttpRequest) { // Mozilla, Safari,...
        httpRequest = new XMLHttpRequest();
        if (httpRequest.overrideMimeType) {
            httpRequest.overrideMimeType('text/xml');
        }
    } else if (window.ActiveXObject) { // IE
        try {
            httpRequest = new ActiveXObject("Msxml2.XMLHTTP");
        } catch (e) {
            try {
                httpRequest = new ActiveXObject("Microsoft.XMLHTTP");
            } catch (e) {
                // test
            }
        }
    }

    if (!httpRequest) {
        alert('Abandon :( Impossible de créer une instance XMLHTTP');
        return false;
    }

    return httpRequest
};

window.onload = function () {
    var forms = document.querySelectorAll(".image-like");

    Array.prototype.forEach.call(forms, function (form, i) {
        var button = form.querySelector("button[type=submit]");
        var buttonText = button.textContent;

        form.addEventListener('submit', function (e) {
            e.preventDefault();

            var data = new FormData(form);
            // remove this and replace with csrf
            formData.append("test", "test");
            var xhr = getHttpRequest();

            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4) {
                    if (xhr.status != 200) {
                        console.log("Can't like.");
                    } else {
                        var results = JSON.parse(xhr.responseText);
                        console.log(results);
                    }
                }
            };

            xhr.open('POST', form.getAttribute('action'), true);
            xhr.setRequestHeader('X-Requested-With', 'xmlhttprequest');
            xhr.send(data);
        });
    });
};