<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
      integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<link rel="stylesheet" href="/css/common.css" type="text/css" media="all">

<?php if (isset($res)) : ?>
    <?php if (array_key_exists('css', $res)) : ?>
        <?php foreach ($res['css'] as $filename) : ?>
            <link rel="stylesheet" href="/css/<?= $filename ?>" type="text/css" media="all">
        <?php endforeach; ?>
    <?php endif ?>
<?php endif ?>
