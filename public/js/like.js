window.onload = function () {
    var forms = document.querySelectorAll(".image-like");

    Array.prototype.forEach.call(forms, function (form, i) {
        var button = form.querySelector("button[type=submit]");
        var buttonText = button.textContent;

        form.addEventListener('submit', function (e) {
            e.preventDefault();

            var data = new FormData(form);
            // TODO: Replace with real CSRF token
            data.append("csrf", "test");
            var xhr = new XMLHttpRequest();

            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4) {
                    if (xhr.status != 200) {
                        console.log("Can't like.");
                    } else {
                        var results = JSON.parse(xhr.responseText);
                        console.log(results);
                        button.textContent = buttonText.replace(/\((.+?)\)/g, "("+results["likes"]+")");

                        if (results["liked_by_user"] === 0) {
                            button.classList.remove('active');
                            document.getElementById('reactType').value = 1;
                        } else if (results["liked_by_user"] === 1) {
                            button.classList.add('active');
                            document.getElementById('reactType').value = 0;
                        }
                    }
                }
            };

            xhr.open('POST', form.getAttribute('action'), true);
            xhr.setRequestHeader('X-Requested-With', 'xmlhttprequest');
            xhr.send(data);
        });
    });
};