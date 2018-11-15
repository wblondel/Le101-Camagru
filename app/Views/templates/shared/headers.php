<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="robots" content="noimageindex, noarchive">
<title>
    <?php
    if (isset($image)) {
        $title = $user->username . " sur " . App::getInstance()->title . ' : ' . '"' . $image->getLongDesc() . '"';
        $description = $image->likesNb . "mentions J'aime, " . $image->commentsNb . " commentaires - " . $title;
        echo $title;
    } else {
        if (isset($page_title)) {
            echo $page_title . ' &bull; ';
        }
        echo App::getInstance()->title;
    }
    ?>
</title>

<?php
if (isset($image)) { ?>
    <meta content="<?= $description ?>" name="description" />
    <meta property="og:site_name" content="<?= App::getInstance()->title;?>" />
    <meta property="og:title" content="<?= $title;?>" />
    <meta property="og:image" content="https://camagru.fr<?= $image->getFilePath(); ?>" />
    <meta property="og:description" content="<?= $description ?>" />
    <meta property="og:url" content="https://camagru.fr/images/<?= $image->id?>/"/>
    <meta name="medium" content="image"/>
<?php}?>