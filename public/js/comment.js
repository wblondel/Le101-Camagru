function processCommentForms()
{
    var forms_comment = document.querySelectorAll(".form-image-comment");

    Array.prototype.forEach.call(forms_comment, function (form_content, i) {
        var button = form_content.querySelector("button[type=submit]");

        form_content.addEventListener('submit', function (e) {
            e.preventDefault();

            var data = new FormData(form_content);
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

            xhr.open('POST', form_content.getAttribute('action'), true);
            xhr.setRequestHeader('X-Requested-With', 'xmlhttprequest');
            xhr.send(data);
        });
    });
}

addLoadEvent(processCommentForms);