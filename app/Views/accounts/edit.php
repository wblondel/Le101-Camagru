<h4 class="card-title"><?= _("Edit Profile") ?></h4>
<form method="POST">

    <div class="form-group">
        <label for="username"><?= _("Username") ?></label>
        <input id="username" type="text" class="form-control" name="username" placeholder="Username" required autofocus>
        <?php if (isset($errors["username"])) : ?>
            <div class="invalid-feedback" style="display:block;"><?= $errors["username"]; ?></div>
        <?php endif ?>
    </div>

    <div class="form-group">
        <label for="email"><?= _("E-Mail Address") ?></label>
        <input id="email" type="email" class="form-control" name="email" placeholder="Email" required>
        <?php if (isset($errors["email"])) : ?>
            <div class="invalid-feedback" style="display:block;"><?= $errors["email"]; ?></div>
        <?php endif ?>
    </div>

    <div class="form-group no-margin">
        <button type="submit" id="submit" class="btn btn-primary btn-block" tabindex="4" disabled>
            <?= _("Save") ?>
        </button>
    </div>

    <div class="form-group">
        <input type="hidden" name="recaptcha_response" id="recaptchaResponse">
    </div>
</form>
