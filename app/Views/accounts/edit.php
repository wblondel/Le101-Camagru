<h4 class="card-title"><?= _("Edit Profile") ?></h4>
<form method="POST">
    <div class="form-group row">
        <label for="username" class="col-sm-2 col-form-label"><?= _("Username") ?></label>
        <div class="col-sm-10">
            <input id="username" type="text" class="form-control" name="username" placeholder="Username" required autofocus>
            <?php if (isset($errors["username"])) : ?>
                <div class="invalid-feedback" style="display:block;"><?= $errors["username"]; ?></div>
            <?php endif ?>
        </div>
    </div>

    <div class="form-group row">
        <label for="email" class="col-sm-2 col-form-label"><?= _("E-Mail Address") ?></label>
        <div class="col-sm-10">
            <input id="email" type="email" class="form-control" name="email" placeholder="Email" required>
            <?php if (isset($errors["email"])) : ?>
                <div class="invalid-feedback" style="display:block;"><?= $errors["email"]; ?></div>
            <?php endif ?>
        </div>
    </div>

    <div class="form-group row">
        <div class="col-sm-10">
            <button type="submit" id="submit" class="btn btn-primary" disabled><?= _("Save") ?></button>
        </div>
    </div>

    <div class="form-group">
        <input type="hidden" name="recaptcha_response" id="recaptchaResponse">
    </div>
</form>
