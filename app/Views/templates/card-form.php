<!doctype html>
<html lang="<?= substr("fr-FR.utf8", 0, 2); ?>">
<head>
    <?php require 'shared/headers.php'; ?>
    <?php require 'shared/css.php'; ?>

    <script src='https://www.google.com/recaptcha/api.js?render=6Lfp6ZsUAAAAABXVFIvCFaK19RIHpILl3OzIvJdM'></script>

    <script>
        grecaptcha.ready(function () {
            grecaptcha.execute('6Lfp6ZsUAAAAABXVFIvCFaK19RIHpILl3OzIvJdM', {action: 'action_name'})
                .then(function (token) {
                    var recaptchaResponse = document.getElementById('recaptchaResponse');
                    recaptchaResponse.value = token;
                    document.getElementById('submit').removeAttribute('disabled');
                });
        });
    </script>
</head>

<body class="my-login-page">
<section class="h-100">
    <div class="container h-100">
        <div class="row justify-content-md-center h-100">
            <div class="card-wrapper">
                <div class="brand">
                    <a href="/">
                        <img src="/img/logo.jpg">
                    </a>
                </div>
                <?php require 'shared/flashes.php'; ?>
                <div class="card fat">
                    <div class="card-body">
                        <?= $content; ?>
                    </div>
                </div>
                <div class="footer">
                    Copyright &copy; 2018 &mdash; LOLILOL Company
                </div>
            </div>
        </div>
    </div>
</section>

<?php require 'shared/js.php'; ?>
</body>
</html>
