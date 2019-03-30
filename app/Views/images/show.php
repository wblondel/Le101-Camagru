<main role="main">
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
                <div class="col-md-4">
                    <div class="card mb-4 box-shadow">
                        <img class="card-img-top lazy-load" height="0" data-src="<?= $singleImage->getFilePath() ?>"
                             src="" alt="<?= $singleImage->getAlt() ?>">
                        <noscript><img class="card-img-top" src="<?= $singleImage->getFilePath() ?>"
                                       alt="<?= $singleImage->getAlt() ?>"></noscript>
                        <div class="card-body">
                            <p class="card-text"><?= $singleImage->getShortDesc() ?></p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                    <a href="<?= $singleImage->getURL() ?>">
                                        <button type="button"
                                                class="btn btn-sm btn-outline-secondary"><?= _("View") ?></button>
                                    </a>
                                    <button type="button"
                                            class="btn btn-sm btn-outline-secondary"><?= _("Like") ?></button>
                                </div>
                                <small class="text-muted my-tooltip"><?= $singleImage->getElapsedTime() ?>
                                    <span class="my-tooltiptext"><?= $singleImage->getCreationDate() ?></span>
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
