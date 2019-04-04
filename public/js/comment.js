window.onload = function () {
    var forms = document.querySelectorAll(".form-image-comment");

    Array.prototype.forEach.call(forms, function (form, i) {
        var button = form.querySelector("button[type=submit]");

        form.addEventListener('submit', function (e) {
            e.preventDefault();

            var data = new FormData(form);
            // TODO: Replace with real CSRF token
            data.append("csrf", "test");
            var xhr = new XMLHttpRequest();

            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4) {
                    if (xhr.status != 200) {
                        console.log("Can't comment.");
                    } else {
                        var results = JSON.parse(xhr.responseText);
                        console.log(results);

                        // add comment to div
                    }
                }
            };

            xhr.open('POST', form.getAttribute('action'), true);
            xhr.setRequestHeader('X-Requested-With', 'xmlhttprequest');
            xhr.send(data);
        });
    });
};