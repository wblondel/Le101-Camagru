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
                        <img class="card-img-top lazy-load" data-src="<?= $single_image->getFilePath() ?>" src="" alt="<?= $single_image->getAlt() ?>">
                        <noscript><img class="card-img-top" src="<?= $single_image->getFilePath() ?>" alt="<?= $single_image->getAlt() ?>"></noscript>
                        <div class="card-body">
                            <p class="card-text"><?= $single_image->getShortDesc() ?></p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                    <a href="<?= $single_image->getURL() ?>"><button type="button" class="btn btn-sm btn-outline-secondary"><?= _("View") ?></button></a>
                                    <button type="button" class="btn btn-sm btn-outline-secondary"><?= _("Like") ?></button>
                                </div>
                                <small class="text-muted my-tooltip"><?= $single_image->getElapsedTime() ?>
                                    <span class="my-tooltiptext"><?= $single_image->getCreationDate() ?></span>
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

