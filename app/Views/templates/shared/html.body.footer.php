<footer class="text-muted">
    <div class="container">
        <p class="float-right">
            <a href="index.php?p=admin">ADMIN</a>
            <a href="index.php?p=users.register">REGISTER</a>
            <a href="index.php?p=users.login">LOGIN</a>
            <a href="index.php?p=users.logout">LOGOUT</a>
        </p>
        <p>&copy; LOLILOL Company</p>
        <p>Le 101 is a joke.</p>
    </div>
</footer>

<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">

<link rel="stylesheet" href="css/common.css" type="text/css" media="all">

<?php if (isset($customcss)) : ?>
    <?php foreach ($customcss as $filename) : ?>
        <link rel="stylesheet" href="<?= $filename ?>" type="text/css" media="all">
    <?php endforeach; ?>
<?php endif ?>
