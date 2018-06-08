<!doctype html>
<html lang="en">
<head>
    <?php require "shared/html.head.php"; ?>
</head>

<body>

<?php require "card-form/html.body.section.php"; ?>

<?php if (isset($customjs)) : ?>
    <?php foreach ($customjs as $filename) : ?>
        <script src="<?= $filename; ?>"></script>
    <?php endforeach; ?>
<?php endif ?>

</body>
</html>
