<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
<link rel="stylesheet" href="/css/common.css" type="text/css" media="all">

<?php if (isset($res)) : ?>
    <?php if (array_key_exists('css', $res)) : ?>
        <?php foreach ($res['css'] as $filename) : ?>
            <link rel="stylesheet" href="<?= $filename ?>" type="text/css" media="all">
        <?php endforeach; ?>
    <?php endif ?>

    <?php if (array_key_exists('js', $res)) : ?>
        <?php foreach ($res['js'] as $filename) : ?>
            <script src="<?= $filename; ?>"></script>
        <?php endforeach; ?>
    <?php endif ?>
<?php endif ?>