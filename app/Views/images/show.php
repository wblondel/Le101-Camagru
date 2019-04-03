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
                <div class="col-md-6">
                    <div class="card mb-4 box-shadow">
                        <img class="card-img-top lazy-load" height="0" data-src="<?= $singleImage->getFilePath() ?>"
                             src="" alt="<?= $singleImage->getAlt() ?>">
                        <noscript><img class="card-img-top" src="<?= $singleImage->getFilePath() ?>"
                                       alt="<?= $singleImage->getAlt() ?>"></noscript>
                        <div class="card-body">
                            <p class="card-text"><?= $singleImage->getShortDesc() ?><br><small><a href="/u/<?= $singleImage->username ?>">@<?= $singleImage->username ?></a></small></p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                    <a href="<?= $singleImage->getURL() ?>">
                                        <button type="button" class="btn btn-sm btn-outline-secondary"><?= _("View") ?></button>
                                    </a>
                                    <form action="/react/<?= $singleImage->id ?>" method="POST" class="image-like">
                                        <input type="hidden" class="reactType" name="reactType" value="<?= ($singleImage->liked_by_user ? '0': '1') ;?>">
                                        <button type="submit" class="btn btn-sm btn-outline-secondary <?= ($singleImage->liked_by_user ? 'active' : '') ;?>"><?= _("Like") ?><?= " (" . $singleImage->likes . ")"?></button>
                                    </form>
                                </div>
                                <small class="text-muted my-tooltip"><?= $singleImage->getElapsedTime() ?>
                                    <span class="my-tooltiptext"><?= $singleImage->getCreationDate() ?></span>
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="detailBox">
                        <div class="titleBox">
                            <label>Comment Box</label>
                        </div>
                        <div class="commentBox">
                            <p class="commentBoxDescription">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                        </div>
                        <div class="actionBox">
                            <ul class="commentList">
                                <?php foreach ($comments as $comment) : ?>
                                <li>
                                    <div class="commenterImage">
                                        <img src="https://placekitten.com/50/50">
                                    </div>
                                    <div class="commentText">
                                        <p><?= $comment->comment;?></p><span class="date sub-text"><?= $comment->getCreationDate() ?></span>
                                    </div>
                                </li>
                                <?php endforeach; ?>
                            </ul>
                            <form class="form-inline" role="form">
                                <div class="form-group">
                                    <input class="form-control" type="text" placeholder="Your comments" />
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-default">Add</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
