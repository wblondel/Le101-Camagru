<!doctype html>
<html lang=<?= $current_language ?>>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title><?php if (isset($page_title)) { echo $page_title; ?> | <?php}?><?= App::getInstance()->title;?></title>
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
                <?php if (App::getInstance()->getSession()->hasFlashes()) : ?>
                    <?php foreach (App::getInstance()->getSession()->getFlashes() as $type => $message) : ?>
                        <div class="alert alert-<?= $type; ?>" role="alert">
                            <?= $message; ?>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
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