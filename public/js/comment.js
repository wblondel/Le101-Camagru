function processCommentForms()
{
    var commentForms = document.querySelectorAll(".form-image-comment");

    Array.prototype.forEach.call(commentForms, function (commentForm, i) {
        var button = commentForm.querySelector("button[type=submit]");

        commentForm.addEventListener('submit', function (e) {
            e.preventDefault();

            var data = new FormData(commentForm);
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

                        commentsList = commentForm.parentElement.getElementsByClassName("commentList")[0];
                        commentToAppend = document.createElement('li');
                        commentToAppend.innerHTML = results['comment'];
                        commentsList.prepend(commentToAppend);
                    }
                    commentFormTextbox = commentForm.querySelector("input[type=text]");
                    commentFormTextbox.value = null;
                    button.removeAttribute('disabled');
                    commentFormTextbox.focus();
                }
            };

            if (!button.hasAttribute('disabled')) {
                button.setAttribute('disabled', '');
            }

            xhr.open('POST', commentForm.getAttribute('action'), true);
            xhr.setRequestHeader('X-Requested-With', 'xmlhttprequest');
            xhr.send(data);
        });
    });
}

addLoadEvent(processCommentForms);