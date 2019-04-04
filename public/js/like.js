window.onload = function () {
    var forms_like = document.querySelectorAll(".image-like");

    Array.prototype.forEach.call(forms_like, function (form_like, i) {
        var button = form_like.querySelector("button[type=submit]");
        var buttonText = button.textContent;

        form_like.addEventListener('submit', function (e) {
            e.preventDefault();

            var data = new FormData(form_like);
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
                            form_like.getElementsByClassName('reactType')[0].value = 1;
                        } else if (results["liked_by_user"] === 1) {
                            button.classList.add('active');
                            form_like.getElementsByClassName('reactType')[0].value = 0;
                        }
                    }
                }
            };

            xhr.open('POST', form_like.getAttribute('action'), true);
            xhr.setRequestHeader('X-Requested-With', 'xmlhttprequest');
            xhr.send(data);
        });
    });
};