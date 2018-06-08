<main role="main">
    <?php require "html.body.main.section.php" ?>

    <div class="album py-5 bg-light">
        <div class="container">
            <?php require ROOT . '/app/Views/templates/shared/flashes.php'; ?>
            <div class="row">

                <?php for ($x = 0; $x <= 100; $x++) : ?>
                <div class="col-md-4">
                    <div class="card mb-4 box-shadow">
                        <img class="card-img-top lazy-load" data-src="https://picsum.photos/348/225?random=<?= $x ?>" src="" alt="Card image cap">
                        <noscript><img class="card-img" src="https://picsum.photos/348/225?random=<?= $x ?>" alt="Card image cap"></noscript>
                        <div class="card-body">
                            <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-sm btn-outline-secondary">View</button>
                                    <button type="button" class="btn btn-sm btn-outline-secondary">Like</button>
                                </div>
                                <small class="text-muted">9 mins</small>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endfor; ?>
            </div>
        </div>
    </div>
</main>

