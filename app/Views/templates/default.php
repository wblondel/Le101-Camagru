<!doctype html>
<html lang="en">
<head>
    <?php require "shared/html.head.php"; ?>
</head>

<body>

<?php require "shared/html.body.header.php"; ?>

<?php if (App::getInstance()->getSession()->hasFlashes()) : ?>
    <?php foreach (App::getInstance()->getSession()->getFlashes() as $type => $message) : ?>
        <div class="alert alert-<?= $type; ?>" role="alert">
            <?= $message; ?>
        </div>
    <?php endforeach; ?>
<?php endif; ?>

<?php require "default/html.body.main.php"; ?>

<?php require "shared/html.body.footer.php"; ?>

<?php if (isset($customjs)) : ?>
    <?php foreach ($customjs as $filename) : ?>
        <script src="<?= $filename; ?>"></script>
    <?php endforeach; ?>
<?php endif ?>

</body>
</html>
