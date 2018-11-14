<main role="main">
    <div class="album py-5 bg-light">
        <div class="container">
            <?php require ROOT . '/app/Views/templates/shared/flashes.php'; ?>
            <div class="row">
                <div class="col-md-4">
                    <div class="card mb-4 box-shadow">
                        <img class="card-img-top lazy-load" data-src="<?= $image->getFilePath() ?>" src="" alt="<?= $image->getAlt() ?>">
                        <noscript><img class="card-img" src="<?= $image->getFilePath() ?>" alt="<?= $image->getAlt() ?>"></noscript>
                        <div class="card-body">
                            <p class="card-text"><?= $image->getShortDesc() ?></p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                    <a href="<?= $image->getURL() ?>"><button type="button" class="btn btn-sm btn-outline-secondary"><?= _("View") ?></button></a>
                                    <button type="button" class="btn btn-sm btn-outline-secondary"><?= _("Like") ?></button>
                                </div>
                                <small class="text-muted my-tooltip"><?= $image->getElaspedTime() ?>
                                    <span class="my-tooltiptext"><?= $image->getCreationDate() ?></span>
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

