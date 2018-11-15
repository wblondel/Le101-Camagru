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
                <?php foreach ($images as $image) : ?>
                    <div class="col-md-4">
                        <div class="card mb-4 box-shadow">
                            <img class="card-img-top lazy-load" data-src="<?= $image['url'] ?>" src="" alt="<?= $image['alt'] ?>">
                            <noscript><img class="card-img" src="<?= $image['url'] ?>" alt="<?= $image['alt'] ?>"></noscript>
                            <div class="card-body">
                                <p class="card-text"><?= $image['desc'] ?></p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-outline-secondary"><?= _("View") ?></button>
                                        <button type="button" class="btn btn-sm btn-outline-secondary"><?= _("Like") ?></button>
                                    </div>
                                    <small class="text-muted my-tooltip"><?= $image['created_at'] ?>
                                        <span class="my-tooltiptext"><?= $image['created_at_nat'] ?></span>
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

