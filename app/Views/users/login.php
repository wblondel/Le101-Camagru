<?php if($errors): ?>
    <div class="alert alert-danger">
        Wrong user and/or password.
    </div>
<?php endif; ?>

<form class="form-signin" method="post">
    <?= $form->input('username', 'Username', ['placeholder' => 'Username']); ?>
    <?= $form->input('password', 'Password', ['type' => 'password', 'placeholder' => 'Password']); ?>
    <?= $form->submit('Login'); ?>
</form>


