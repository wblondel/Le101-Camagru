<!doctype html>
<html lang="<?= substr("fr-FR.utf8", 0, 2); ?>">
<head>
    <?php require 'shared/headers.php';?>
    <?php require 'shared/css.php';?>
</head>

<body>
<?php require 'shared/top_navbar.php'; ?>

<?php if (App::getInstance()->getSession()->hasFlashes()) : ?>
    <?php foreach (App::getInstance()->getSession()->getFlashes() as $type => $message) : ?>
        <div class="alert alert-<?= $type; ?>" role="alert">
            <?= $message; ?>
        </div>
    <?php endforeach; ?>
<?php endif; ?>

<?= $content; ?>

<?php require 'shared/footer.php';?>
<?php require 'shared/js.php';?>
</body>
</html>