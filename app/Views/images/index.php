<main role="main">
    <section class="jumbotron text-center">
        <div class="container">
            <h1 class="jumbotron-heading"><?= _("You can be cool too") ?></h1>
            <p class="lead text-muted"><?= _("Show off how cool you are by donec suscipit nulla ut massa fringilla aliquet a id elit. Sed porta lobortis lectus ac scelerisque. Aenean eget urna nulla. Vestibulum sed nisl eu tortor dignissim ultricies.") ?></p>
            <p>
                <a href="/i/new" class="btn btn-primary my-2"><?= _("Take a picture") ?></a>
            </p>
        </div>
    </section>

    <div class="album py-5 bg-light">
        <div class="container">
            <?php if (App::getInstance()->getSession()->hasFlashes()) : ?>
                <?php foreach (App::getInstance()->getSession()->getFlashes() as $type => $message) : ?>
                    <div class="alert alert-<?= $type; ?>" role="alert">
                        <?= $message; ?>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
            <div class="row">
                <?php foreach ($images as $image) : ?>
                    <div class="col-md-4">
                        <div class="card mb-4 box-shadow">
                            <img class="card-img-top lazy-load" height="0" data-src="<?= $image->getFilePath() ?>"
                                 src="" alt="<?= $image->getAlt() ?>">
                            <noscript><img class="card-img-top" src="<?= $image->getFilePath() ?>"
                                           alt="<?= $image->getAlt() ?>"></noscript>
                            <div class="card-body">
                                <p class="card-text"><?= $image->getShortDesc() ?><br><small>@<?= $image->username ?></small></p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                        <a href="<?= $image->getURL() ?>">
                                            <button type="button"
                                                    class="btn btn-sm btn-outline-secondary"><?= _("View") ?></button>
                                        </a>
                                        <button type="button"
                                                class="btn btn-sm btn-outline-secondary"><?= _("Like") ?></button>
                                    </div>
                                    <small class="text-muted my-tooltip"><?= $image->getElapsedTime() ?>
                                        <span class="my-tooltiptext"><?= $image->getCreationDate() ?></span>
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</main>
