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
        <div class="custom-checkbox custom-control">
            <input type="checkbox" name="remember" id="remember" class="custom-control-input" tabindex="3">
            <label for="remember" class="custom-control-label"><?= _("Remember Me") ?></label>
        </div>
    </div>

    <div class="form-group no-margin">
        <button type="submit" id="submit" class="btn btn-primary btn-block" tabindex="4" disabled>
            <?= _("Login") ?>
        </button>
    </div>
    <div class="mt-4 text-center">
        <?= _("Don't have an account?") ?> <a href="/accounts/register" tabindex="6"><?= _("Create One") ?></a>
    </div>

    <div class="form-group">
        <input type="hidden" name="recaptcha_response" id="recaptchaResponse">
    </div>
</form>
