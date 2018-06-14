<main role="main">
    <section class="jumbotron text-center">
        <div class="container">
            <h1 class="jumbotron-heading">You can be cool too</h1>
            <p class="lead text-muted">Show off how cool you are by donec suscipit nulla ut massa fringilla aliquet a id elit. Sed porta lobortis lectus ac scelerisque. Aenean eget urna nulla. Vestibulum sed nisl eu tortor dignissim ultricies.</p>
            <p>
                <a href="index.php?p=images.new" class="btn btn-primary my-2">Take a picture</a>
            </p>
        </div>
    </section>

    <div class="album py-5 bg-light">
        <div class="container">
            <?php require ROOT . '/app/Views/templates/shared/flashes.php'; ?>
            <div class="row">
                <?php foreach ($pics as $pic) : ?>
                    <div class="col-md-4">
                        <div class="card mb-4 box-shadow">
                            <img class="card-img-top lazy-load" data-src="<?= $pic['url'] ?>" src="" alt="<?= $pic['alt'] ?>">
                            <noscript><img class="card-img" src="<?= $pic['url'] ?>" alt="<?= $pic['alt'] ?>"></noscript>
                            <div class="card-body">
                                <p class="card-text"><?= $pic['desc'] ?></p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-outline-secondary">View</button>
                                        <button type="button" class="btn btn-sm btn-outline-secondary">Like</button>
                                    </div>
                                    <small class="text-muted my-tooltip"><?= $pic['created_at'] ?>
                                        <span class="my-tooltiptext"><?= $pic['created_at_nat'] ?></span>
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

