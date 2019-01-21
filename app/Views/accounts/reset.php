<h4 class="card-title"><?= _("Reset Password") ?></h4>
<form method="POST">

    <div class="form-group">
        <label for="password"><?= _("Password") ?></label>
        <input id="password" type="password" class="form-control" name="password" value="" required autofocus data-eye>
        <?php if (isset($errors["password"])) : ?>
            <div class="invalid-feedback" style="display:block;"><?= $errors["password"]; ?></div>
        <?php endif ?>
    </div>

    <div class="form-group">
        <label for="password_confirm"><?= _("Password (confirmation)") ?></label>
        <input id="password_confirm" type="password" class="form-control" name="password_confirm" required data-eye>
        <?php if (isset($errors["password"])) : ?>
            <div class="invalid-feedback" style="display:block;"><?= $errors["password_confirm"]; ?></div>
        <?php endif ?>
    </div>

    <div class="form-text text-muted">
        <?= _('Your password must be at least 8 characters, and contain at least one uppercase letter,
                one lowercase letter, one digit, and one special character.') ?>
    </div>

    <div class="form-group no-margin">
        <button type="submit" class="btn btn-primary btn-block">
            <?= _("Change password") ?>
        </button>
    </div>

    <div class="form-group">
        <input type="hidden" name="recaptcha_response" id="recaptchaResponse">
    </div>
</form>
