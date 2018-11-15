<div id="app" class="container">
    <nav class="navbar navbar-expand-lg navbar-light bg-faded">
        <a class="navbar-brand" href="#">Navbar</a>
        <!--<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">-->
        <!--<span class="navbar-toggler-icon"></span>-->
        <!--</button>-->
        <!--<div id="navbarNavDropdown" class="navbar-collapse collapse">-->
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="/"><?= _("Home") ?> <span class="sr-only"><?= _("(current)") ?></span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#"><?= _("A page...") ?></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#"><?= _("Another page...") ?></a>
            </li>
        </ul>
        <ul class="navbar-nav">
            <?php if ($logged === false) : ?>
                <li class="nav-item">
                    <a class="nav-link" href="/users/login"><?= _("Login") ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/users/register"><?= _("Register") ?></a>
                </li>
            <?php else : ?>
                <li class="nav-item">
                    <a class="nav-link" href="/users/logout"><?= _("Logout") ?></a>
                </li>
            <?php endif; ?>
        </ul>
        <!--</div>-->
    </nav>
</div>