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
        </div>
    </div>
</main>

