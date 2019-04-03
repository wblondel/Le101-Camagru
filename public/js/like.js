window.onload = function () {
    var forms = document.querySelectorAll(".image-like");

    Array.prototype.forEach.call(forms, function (form, i) {
        var button = form.querySelector("button[type=submit]");
        var buttonText = button.textContent;

        form.addEventListener('submit', function (e) {
            e.preventDefault();

            var data = new FormData(form);
            // remove this and replace with csrf
            data.append("test", "test");
            var xhr = new XMLHttpRequest();

            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4) {
                    if (xhr.status != 200) {
                        console.log("Can't like.");
                    } else {
                        var results = JSON.parse(xhr.responseText);
                        console.log(results);
                        button.textContent = results["likes"];
                    }
                }
            };

            xhr.open('POST', form.getAttribute('action'), true);
            xhr.setRequestHeader('X-Requested-With', 'xmlhttprequest');
            xhr.send(data);
        });
    });
};