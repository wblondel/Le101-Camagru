<h4 class="card-title"><?= _("Login") ?></h4>
<form method="POST">

    <div class="form-group">
        <label for="username"><?= _("Username") ?></label>
        <input id="username" type="text" class="form-control" name="username" value="" tabindex="1" required autofocus>
    </div>

    <div class="form-group">
        <label for="password"><?= _("Password") ?>
            <a href="/accounts/forgot" class="float-right" tabindex="5">
                <?= _("Forgot Password?") ?>
            </a>
        </label>
        <input id="password" type="password" class="form-control" name="password" tabindex="2" required data-eye>
    </div>

    <div class="form-group">
        <label>
            <input type="checkbox" name="remember" tabindex="3"> <?= _("Remember Me") ?>
        </label>
    </div>

    <div class="form-group no-margin">
        <button type="submit" class="btn btn-primary btn-block" tabindex="4">
            <?= _("Login") ?>
        </button>
    </div>
    <div class="margin-top20 text-center">
        <?= _("Don't have an account?") ?> <a href="/accounts/register" tabindex="6"><?= _("Create One") ?></a>
    </div>
</form>
