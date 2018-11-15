<!doctype html>
<html lang=<?= $current_language ?>>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="robots" content="noimageindex, noarchive">
    <title><?php if (isset($page_title)) { echo $page_title . ' &bull; '; }?><?= App::getInstance()->title;?></title>
</head>

<body>
<div id="app" class="container">
    <nav class="navbar navbar-expand-lg navbar-light bg-faded">
        <a class="navbar-brand" href="#">Navbar</a>
        <!--<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">-->
        <!--<span class="navbar-toggler-icon"></span>-->
        <!--</button>-->
        <!--<div id="navbarNavDropdown" class="navbar-collapse collapse">-->
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="/"><?= _("Home") ?> <span class="sr-only"><?= _("(current)") ?></span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#"><?= _("A page...") ?></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#"><?= _("Another page...") ?></a>
            </li>
        </ul>
        <ul class="navbar-nav">
            <?php if ($logged === false) : ?>
                <li class="nav-item">
                    <a class="nav-link" href="/users/login"><?= _("Login") ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/users/register"><?= _("Register") ?></a>
                </li>
            <?php else : ?>
                <li class="nav-item">
                    <a class="nav-link" href="/users/logout"><?= _("Logout") ?></a>
                </li>
            <?php endif; ?>
        </ul>
        <!--</div>-->
    </nav>
</div>

<?= $content; ?>

<footer class="text-muted">
    <div class="container">
        <p class="float-right">
            <a href="admin"><?= _("ADMIN") ?></a>
            <a href="users/register"><?= _("REGISTER") ?></a>
            <a href="users/login"><?= _("LOGIN") ?></a>
            <a href="users/logout"><?= _("LOGOUT") ?></a>
        </p>
        <p>&copy; LOLILOL Company</p>
        <p><?= _("Le 101 is a joke.") ?></p>
    </div>
</footer>

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
