<section class="h-100">
    <div class="container h-100">
        <div class="row justify-content-md-center h-100">
            <div class="card-wrapper">
                <div class="brand">
                    <a href="/">
                        <img src="/img/logo.jpg">
                    </a>
                </div>
                <?php require ROOT . '/app/Views/templates/shared/flashes.php'; ?>
                <div class="card fat">
                    <div class="card-body">
                        <?= $content; ?>
                    </div>
                </div>
                <?php require ROOT . '/app/Views/templates/card-form/html.body.section.footer.php'; ?>
            </div>
        </div>
    </div>
</section>