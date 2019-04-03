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
                            <img class="card-img-top lazy-load" height="0" data-src="<?= $image->getFilePath() ?>"
                                 src="" alt="<?= $image->getAlt() ?>">
                            <noscript><img class="card-img-top" src="<?= $image->getFilePath() ?>"
                                           alt="<?= $image->getAlt() ?>"></noscript>
                            <div class="card-body">
                                <p class="card-text"><?= $image->getShortDesc() ?><br><small>@<?= $image->username ?></small></p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                        <a href="<?= $image->getURL() ?>">
                                            <button type="button" class="btn btn-sm btn-outline-secondary"><?= _("View") ?></button>
                                        </a>
                                        <form action="/react/<?= $image->id ?>" method="POST" class="image-like">
                                            <input type="hidden" id="reactType" name="reactType" value="<?= ($image->liked_by_user ? '0': '1') ;?>">
                                            <button type="submit" class="btn btn-sm btn-outline-secondary <?= ($image->liked_by_user ? 'active' : '') ;?>"><?= _("Like") ?><?= " (" . $image->likes . ")"?></button>
                                        </form>
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
