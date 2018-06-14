<!doctype html>
<html lang="en">
<head>
    <?php require "shared/html.head.php"; ?>
</head>

<body>

<?php require "shared/html.body.header.php"; ?>

<?= $content; ?>

<?php require "shared/html.body.footer.php"; ?>

<?php if (isset($customjs)) : ?>
    <?php foreach ($customjs as $filename) : ?>
        <script src="<?= $filename; ?>"></script>
    <?php endforeach; ?>
<?php endif ?>

</body>
</html>
