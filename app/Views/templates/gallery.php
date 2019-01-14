<!doctype html>
<html lang="<?= substr("fr-FR.utf8", 0, 2); ?>">
<head>
    <?php require 'shared/headers.php';?>
    <?php require 'shared/css.php';?>
</head>

<body>
<?php require 'shared/top_navbar.php'; ?>

<?= $content; ?>

<?php require 'shared/footer.php';?>
<?php require 'shared/js.php';?>
</body>
</html>