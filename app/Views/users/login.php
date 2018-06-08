<h4 class="card-title">Login</h4>
<form method="POST">

    <div class="form-group">
        <label for="username">Username</label>
        <input id="username" type="text" class="form-control" name="username" value="" required autofocus>
    </div>

    <div class="form-group">
        <label for="password">Password
            <a href="index.php?p=users.forgot" class="float-right">
                Forgot Password?
            </a>
        </label>
        <input id="password" type="password" class="form-control" name="password" required data-eye>
    </div>

    <div class="form-group">
        <label>
            <input type="checkbox" name="remember"> Remember Me
        </label>
    </div>

    <div class="form-group no-margin">
        <button type="submit" class="btn btn-primary btn-block">
            Login
        </button>
    </div>
    <div class="margin-top20 text-center">
        Don't have an account? <a href="index.php?p=users.register">Create One</a>
    </div>
</form>
