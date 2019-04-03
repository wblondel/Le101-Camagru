<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="robots" content="noimageindex, noarchive">
<title>
    <?php if (isset($singleImage)) : ?>
        <?php
        $title = $singleImage->username . " " . _("on") . " " . App::getInstance()->title . _(':') . ' &#34;' . $singleImage->getLongDesc() . '&#34;';
        $description = sprintf(ngettext("%d Like", "%d Likes", $singleImage->likesNb), $singleImage->likesNb) . ", " . sprintf(ngettext("%d Comment", "%d Comments", $singleImage->commentsNb), $singleImage->commentsNb) . " - " . $title;
        echo $title;
        ?>
    <?php else : ?>
        <?php if (isset($pageTitle)) : ?>
            <?php echo $pageTitle . ' &bull; '; ?>
        <?php endif ?>
        <?php echo App::getInstance()->title; ?>
    <?php endif ?>
</title>

<?php if (isset($singleImage)) : ?>
    <meta content="<?= $description ?>" name="description"/>
    <meta property="og:site_name" content="<?= App::getInstance()->title; ?>"/>
    <meta property="og:title" content="<?= $title; ?>"/>
    <meta property="og:image" content="https://camagru.fr<?= $singleImage->getFilePath(); ?>"/>
    <meta property="og:description" content="<?= $description ?>"/>
    <meta property="og:url" content="https://camagru.fr/i/<?= $singleImage->id ?>/"/>
    <meta name="medium" content="image"/>
<?php endif ?>
