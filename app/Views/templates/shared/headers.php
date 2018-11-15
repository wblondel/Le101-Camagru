<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="robots" content="noimageindex, noarchive">
<title>
    <?php if (isset($single_image)) : ?>
        <?php
            $title = $user->username . " " . _("on") . " " . App::getInstance()->title . _(':') . ' &#34;' . $single_image->getLongDesc() . '&#34;';
            $description = ngettext("%d Like", "%d Likes", $single_image->likesNb) . ", " . ngettext("%d Comment", "%d Comments", $single_image->commentsNb) . " - " . $title;
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