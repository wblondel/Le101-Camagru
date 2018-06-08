<div id="app" class="container">
    <nav class="navbar navbar-expand-lg navbar-light bg-faded">
        <a class="navbar-brand" href="#">Navbar</a>
        <!--<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">-->
            <!--<span class="navbar-toggler-icon"></span>-->
        <!--</button>-->
        <!--<div id="navbarNavDropdown" class="navbar-collapse collapse">-->
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="index.php?p=images">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">A page...</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Another page...</a>
                </li>

            </ul>
            <ul class="navbar-nav">
                <?php if ($logged === false) : ?>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?p=users.login">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?p=users.register">Register</a>
                </li>
                <?php else : ?>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?p=users.logout">Logout</a>
                </li>
                <?php endif; ?>
            </ul>
        <!--</div>-->
    </nav>
</div>