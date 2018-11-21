<h4 class="card-title"><?= _("Reset Password") ?></h4>
<form method="POST">

    <div class="form-group">
        <label for="username"><?= _("Password") ?></label>
        <input id="password" type="password" class="form-control" name="password" value="" required autofocus data-eye>
    </div>

    <div class="form-group">
        <label for="password"><?= _("Password (confirmation)") ?></label>
        <input id="password_confirm" type="password" class="form-control" name="password_confirm" required data-eye>
    </div>

    <div class="form-group no-margin">
        <button type="submit" class="btn btn-primary btn-block">
            <?= _("Change password") ?>
        </button>
    </div>
</form>
