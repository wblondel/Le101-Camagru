<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="robots" content="noimageindex, noarchive">
<title>
    <?php
    if (isset($image)) {
        // This means we are viewing an image
        $title = $user->username . _(" sur ") . App::getInstance()->title . _(' : ') . '"' . $image->getLongDesc() . '"';
        $description = $image->likesNb . "mentions J'aime, " . $image->commentsNb . " commentaires - " . $title;
        echo $title;
    } else {
        // Show the page title before the app name, if there is one
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

<!--<link rel="alternate" href="echo $current_url_no_param;" hreflang="x-default" />-->


<!-- for locale in locales
{
<link rel="alternate" href="echo $current_url_no_param . "?hl=" . $locale;?>" hreflang="echo $locale;" />
}-->