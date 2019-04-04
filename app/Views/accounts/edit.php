<h4 class="card-title"><?= _("Edit Profile") ?></h4>
<form method="POST">

    <div class="form-group">
        <label for="username"><?= _("Username") ?></label>
        <input id="username" type="text" class="form-control" name="username" placeholder="Username" value="<?= $userInfo->username ?>" required autofocus>
        <?php if (isset($errors["username"])) : ?>
            <div class="invalid-feedback" style="display:block;"><?= $errors["username"]; ?></div>
        <?php endif ?>
    </div>

    <div class="form-group">
        <label for="email"><?= _("E-Mail Address") ?></label>
        <input id="email" type="email" class="form-control" name="email" placeholder="Email" value="<?= $userInfo->email ?>" required>
        <?php if (isset($errors["email"])) : ?>
            <div class="invalid-feedback" style="display:block;"><?= $errors["email"]; ?></div>
        <?php endif ?>
    </div>

    <div class="form-group">
        <div class="custom-checkbox custom-control">
            <input type="checkbox" name="receive_email_on_comment" id="receive_email_on_comment" class="custom-control-input" <?= ($userInfo->receive_email_on_comment ? 'checked' : '')?>>
            <label for="receive_email_on_comment" class="custom-control-label"><?= _("Receive an email when someone comments on my images") ?></label>
            <?php if (isset($errors["receive_email_on_comment"])) : ?>
                <div class="invalid-feedback" style="display:block;"><?= $errors["receive_email_on_comment"]; ?></div>
            <?php endif ?>
        </div>
    </div>

    <div class="form-group no-margin">
        <button type="submit" id="submit" class="btn btn-primary btn-block" disabled>
            <?= _("Save") ?>
        </button>
    </div>
    <div class="mt-4 text-center">
        <a href="/accounts/password/change"><?= _("Modify your password") ?></a>
    </div>
    <div class="mt-4 text-center">
        <a href="/accounts/logout"><?= _("Logout") ?></a>
    </div>

    <div class="form-group">
        <input type="hidden" name="recaptcha_response" id="recaptchaResponse">
    </div>
</form>
