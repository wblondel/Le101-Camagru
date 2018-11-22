<h4 class="card-title"><?= _("Register") ?></h4>
<form method="POST">

    <div class="form-group">
        <label for="username"><?= _("Username") ?></label>
        <input id="username" type="text" class="form-control" name="username" required autofocus>
        <?php if (isset($errors["username"])) : ?>
        <div class="invalid-feedback"><?= $errors["username"]; ?></div>
        <?php endif ?>
    </div>

    <div class="form-group">
        <label for="email"><?= _("E-Mail Address") ?></label>
        <input id="email" type="email" class="form-control" name="email" required>
        <?php if (isset($errors["email"])) : ?>
            <div class="invalid-feedback"><?= $errors["email"]; ?></div>
        <?php endif ?>
    </div>

    <div class="form-group">
        <label for="password"><?= _("Password") ?></label>
        <input id="password" type="password" class="form-control" name="password" required data-eye>
        <?php if (isset($errors["password"])) : ?>
            <div class="invalid-feedback"><?= $errors["password"]; ?></div>
        <?php endif ?>
    </div>

    <div class="form-group">
        <label>
            <input type="checkbox" name="agree" value="1"> <?= _("I agree to the Terms and Conditions") ?>
        </label>
    </div>

    <div class="form-group no-margin">
        <button type="submit" class="btn btn-primary btn-block">
            <?= _("Register") ?>
        </button>
    </div>
    <div class="margin-top20 text-center">
        <?= _("Already have an account?") ?> <a href="/users/login">Login</a>
    </div>
</form>
