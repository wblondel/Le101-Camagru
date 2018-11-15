<?php if (App::getInstance()->getSession()->hasFlashes()) : ?>
    <?php foreach (App::getInstance()->getSession()->getFlashes() as $type => $message) : ?>
        <div class="alert alert-<?= $type; ?>" role="alert">
            <?= $message; ?>
        </div>
    <?php endforeach; ?>
<?php endif; ?>