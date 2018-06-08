<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="">
<meta name="author" content="">

<title><?= App::getInstance()->title;?></title>

<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">

<link rel="stylesheet" href="css/common.css" type="text/css" media="all">

<?php if (isset($customcss)) : ?>
    <?php foreach ($customcss as $filename) : ?>
        <link rel="stylesheet" href="<?= $filename ?>" type="text/css" media="all">
    <?php endforeach; ?>
<?php endif ?>