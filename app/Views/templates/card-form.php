<!doctype html>
<html lang=<?= $current_language ?>>
<head>
    <?php require 'shared/headers.php';?>
</head>

<body>
<section class="h-100">
    <div class="container h-100">
        <div class="row justify-content-md-center h-100">
            <div class="card-wrapper">
                <div class="brand">
                    <a href="/">
                        <img src="/img/logo.jpg">
                    </a>
                </div>
                <?php require 'shared/flashes.php';?>
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

<?php require 'shared/css_js.php';?>
</body>
</html>