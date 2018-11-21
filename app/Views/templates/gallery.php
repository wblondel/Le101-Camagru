<!doctype html>
<html lang="<?= substr($lang, 0, 2); ?>">
<head>
    <?php require 'shared/headers.php';?>
</head>

<body>
<?php require 'shared/top_navbar.php'; ?>

<?= $content; ?>

<?php require 'shared/footer.php';?>
<?php require 'shared/css_js.php';?>
</body>
</html>