<!doctype html>
<html lang="en">
<head>
    <?php require "shared/html.head.php"; ?>
</head>

<body>

<?php require "card-form/html.body.section.php"; ?>

<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">

<link rel="stylesheet" href="/css/common.css" type="text/css" media="all">

<?php if (isset($customcss)) : ?>
    <?php foreach ($customcss as $filename) : ?>
        <link rel="stylesheet" href="<?= $filename ?>" type="text/css" media="all">
    <?php endforeach; ?>
<?php endif ?>

<?php if (isset($customjs)) : ?>
    <?php foreach ($customjs as $filename) : ?>
        <script src="<?= $filename; ?>"></script>
    <?php endforeach; ?>
<?php endif ?>

</body>
</html>
