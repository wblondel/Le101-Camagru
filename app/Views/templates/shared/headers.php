<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="robots" content="noimageindex, noarchive">
<title>
    <?php if (isset($single_image)) : ?>
        <?php
            $title = $user->username . " sur " . App::getInstance()->title . ' : ' . '"' . $single_image->getLongDesc() . '"';
            $description = $single_image->likesNb . "mentions J'aime, " . $single_image->commentsNb . " commentaires - " . $title;
            echo $title;
        ?>
    <?php else : ?>
        <?php if (isset($page_title)) : ?>
            <?php echo $page_title . ' &bull; '; ?>
        <?php endif ?>
        <?php echo App::getInstance()->title; ?>
    <?php endif ?>
</title>

<?php if (isset($single_image)) : ?>
    <meta content="<?= $description ?>" name="description" />
    <meta property="og:site_name" content="<?= App::getInstance()->title;?>" />
    <meta property="og:title" content="<?= $title;?>" />
    <meta property="og:image" content="https://camagru.fr<?= $single_image->getFilePath(); ?>" />
    <meta property="og:description" content="<?= $description ?>" />
    <meta property="og:url" content="https://camagru.fr/images/<?= $single_image->id?>/"/>
    <meta name="medium" content="image"/>
<?php endif ?>