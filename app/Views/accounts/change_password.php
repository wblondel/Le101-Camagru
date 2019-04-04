<h4 class="card-title"><?= _("Reset Password") ?></h4>
<form method="POST">

    <div class="form-group">
        <label for="old_password"><?= _("Old Password") ?></label>
        <input id="old_password" type="password" class="form-control" name="old_password" value="" required autofocus data-eye>
        <?php if (isset($errors["old_password"])) : ?>
            <div class="invalid-feedback" style="display:block;"><?= $errors["old_password"]; ?></div>
        <?php endif ?>
    </div>

    <div class="form-group">
        <label for="password"><?= _("New Password") ?></label>
        <input id="password" type="password" class="form-control" name="password" value="" required autofocus data-eye>
        <?php if (isset($errors["password"])) : ?>
            <div class="invalid-feedback" style="display:block;"><?= $errors["password"]; ?></div>
        <?php endif ?>
    </div>

    <div class="form-group">
        <label for="password_confirm"><?= _("New Password (confirmation)") ?></label>
        <input id="password_confirm" type="password" class="form-control" name="password_confirm" required data-eye>
        <?php if (isset($errors["password_confirm"])) : ?>
            <div class="invalid-feedback" style="display:block;"><?= $errors["password_confirm"]; ?></div>
        <?php endif ?>
    </div>

    <div class="form-text text-muted">
        <?= _('Your password must be at least 8 characters, and contain at least one uppercase letter,
                one lowercase letter, one digit, and one special character.') ?>
    </div>

    <div class="form-group m-0">
        <button type="submit" id="submit" class="btn btn-primary btn-block" disabled>
            <?= _("Change password") ?>
        </button>
    </div>
    <div class="mt-4 text-center">
        <a href="/accounts/edit"><?= _("Editez votre profil") ?></a>
    </div>

    <div class="form-group">
        <input type="hidden" name="recaptcha_response" id="recaptchaResponse">
    </div>
</form>
