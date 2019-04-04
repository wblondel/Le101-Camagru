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
                             src="" alt="<?= htmlentities($singleImage->getAlt()) ?>">
                        <noscript><img class="card-img-top" src="<?= $singleImage->getFilePath() ?>"
                                       alt="<?= htmlentities($singleImage->getAlt()) ?>"></noscript>
                        <div class="card-body">
                            <p class="card-text"><?= htmlentities($singleImage->description) ?><br><small><a href="/u/<?= $singleImage->username ?>">@<?= $singleImage->username ?></a></small></p>
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
                                        <p><?= htmlentities($comment->comment);?></p><span class="date sub-text"><?= $comment->getCreationDate() ?></span>
                                    </div>
                                </li>
                                <?php endforeach; ?>
                            </ul>
                            <form action="/c/add/<?= $singleImage->id ?>" method="post" class="form-image-comment">
                                <div class="form-row">
                                    <div class="col-10">
                                        <label class="sr-only" for="commentContent">Your comment</label>
                                        <input type="text" class="form-control mb-2 mr-sm-2" id="commentContent" name="commentContent" placeholder="Your comment">
                                    </div>
                                    <div class="col">
                                        <button type="submit" class="btn btn-primary mb-2">Add</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
