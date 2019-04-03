<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="robots" content="noimageindex, noarchive">
<title>
    <?php if (isset($singleImage)) : ?>
        <?php
        $title = $singleImage->username . " " . _("on") . " " . App::getInstance()->title . _(':') . ' &#34;' . $singleImage->getLongDesc() . '&#34;';
        $description = sprintf(ngettext("%d Like", "%d Likes", $singleImage->likes), $singleImage->likes) . ", " . sprintf(ngettext("%d Comment", "%d Comments", $singleImage->commentsNb), $singleImage->commentsNb) . " - " . $title;
        echo $title;
        ?>
    <?php else : ?>
        <?php if (isset($pageTitle)) : ?>
            <?php echo $pageTitle . ' &bull; '; ?>
        <?php endif ?>
        <?php echo App::getInstance()->title; ?>
    <?php endif ?>
</title>

<link rel="apple-touch-icon" sizes="57x57" href="/img/favicon/apple-icon-57x57.png">
<link rel="apple-touch-icon" sizes="60x60" href="/img/favicon/apple-icon-60x60.png">
<link rel="apple-touch-icon" sizes="72x72" href="/img/favicon/apple-icon-72x72.png">
<link rel="apple-touch-icon" sizes="76x76" href="/img/favicon/apple-icon-76x76.png">
<link rel="apple-touch-icon" sizes="114x114" href="/img/favicon/apple-icon-114x114.png">
<link rel="apple-touch-icon" sizes="120x120" href="/img/favicon/apple-icon-120x120.png">
<link rel="apple-touch-icon" sizes="144x144" href="/img/favicon/apple-icon-144x144.png">
<link rel="apple-touch-icon" sizes="152x152" href="/img/favicon/apple-icon-152x152.png">
<link rel="apple-touch-icon" sizes="180x180" href="/img/favicon/apple-icon-180x180.png">
<link rel="icon" type="image/png" sizes="192x192"  href="/img/favicon/android-icon-192x192.png">
<link rel="icon" type="image/png" sizes="32x32" href="/img/favicon/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="96x96" href="/img/favicon/favicon-96x96.png">
<link rel="icon" type="image/png" sizes="16x16" href="/img/favicon/favicon-16x16.png">
<link rel="manifest" href="/manifest.json">
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="msapplication-TileImage" content="/img/favicon/ms-icon-144x144.png">
<meta name="theme-color" content="#ffffff">

<?php if (isset($singleImage)) : ?>
    <meta content="<?= $description ?>" name="description"/>
    <meta property="og:site_name" content="<?= App::getInstance()->title; ?>"/>
    <meta property="og:title" content="<?= $title; ?>"/>
    <meta property="og:image" content="https://camagru.fr<?= $singleImage->getFilePath(); ?>"/>
    <meta property="og:description" content="<?= $description ?>"/>
    <meta property="og:url" content="https://camagru.fr/i/<?= $singleImage->id ?>/"/>
    <meta name="medium" content="image"/>
<?php endif ?>
