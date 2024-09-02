<?php
include_once 'header.php';
include( "classes/connect.php" );
include( "classes/login.php" );
?>

<div class="mm-login-container mm-flex-column mm-gap-20">
    <h2 class="mm-h2-white">Login</h2>
    <form class="mm-signup-form mm-flex-column mm-gap-20" method="post">
        <div class="mm-flex-column mm-gap-10">
            <label for="username">Username/Email</label>
            <input type="text" name="username">
        </div>
        <div class="mm-flex-column mm-gap-10">
            <label for="passwod">Password</label>
            <input type="password" name="password">
        </div>
        <button class="mm-button" type="submit" name="submit">Login</button>
        <p class="login-message-pre">Not registered yet? <a class="signup-link" href="signup.php">Sign Up!</a></p>
    </form>
	<?php
	if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
		$login = new Login();
		$result = $login->evaluate( $_POST );
        if ($result == "Incorrect email or password") {
	        echo "<p class='login-message'>Incorrect username or password.</p>";
        }
        if ($result == "Empty inputs") {
	        echo "<p class='login-message'>Fill in all fields.</p>";
        }
    }
    ?>
</div>F
<style>
    .login-message {
        color: var(--purple);
        text-align: center;
        font-weight: 400;
        font-size: 16px;
    }

    .login-message-pre {
        color: var(--white);
        text-align: center;
        font-weight: 400;
        font-size: 16px;
    }

    .signup-link {
        color: var(--purple);
        text-decoration: underline;
    }
</style>

<?php include_once 'footer.php' ?>

