<h4 class="card-title"><?= _("Login") ?></h4>
<form method="POST">

    <div class="form-group">
        <label for="username"><?= _("Username") ?></label>
        <input id="username" type="text" class="form-control" name="username" value="" required autofocus>
    </div>

    <div class="form-group">
        <label for="password"><?= _("Password") ?>
            <a href="/users/forgot" class="float-right">
                <?= _("Forgot Password?") ?>
            </a>
        </label>
        <input id="password" type="password" class="form-control" name="password" required data-eye>
    </div>

    <div class="form-group">
        <label>
            <input type="checkbox" name="remember"> <?= _("Remember Me") ?>
        </label>
    </div>

    <div class="form-group no-margin">
        <button type="submit" class="btn btn-primary btn-block">
            <?= _("Login") ?>
        </button>
    </div>
    <div class="margin-top20 text-center">
        <?= _("Don't have an account?") ?> <a href="/users/register"><?= _("Create One") ?></a>
    </div>
</form>
