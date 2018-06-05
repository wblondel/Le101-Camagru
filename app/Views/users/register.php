<form class="form-signin" method="post">
    <?= $form->input('username', 'Username', ['placeholder' => 'Username', 'required' => true]); ?>
    <?= $form->input('email', 'Email', ['type' => 'email', 'placeholder' => 'Username', 'required' => true]); ?>
    <?= $form->input('password', 'Password', ['type' => 'password', 'placeholder' => 'Password', 'required' => true]); ?>
    <?= $form->submit('Register'); ?>
</form>