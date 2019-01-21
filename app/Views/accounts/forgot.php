<h4 class="card-title"><?= _("Forgot Password") ?></h4>
<form method="POST">

    <div class="form-group">
        <label for="email"><?= _("E-Mail Address") ?></label>
        <input id="email" type="email" class="form-control" name="email" value="" required autofocus>

        <?php if (isset($errors["email"])) : ?>
            <div class="invalid-feedback" style="display:block;"><?= $errors["email"]; ?></div>
        <?php endif ?>

        <div class="form-text text-muted">
            <?= _('By clicking "Reset Password" we will send a password reset link') ?>
        </div>
    </div>

    <div class="form-group no-margin">
        <button type="submit" class="btn btn-primary btn-block">
            <?= _("Reset Password") ?>
        </button>
    </div>

    <div class="form-group">
        <input type="hidden" name="recaptcha_response" id="recaptchaResponse">
    </div>
</form>