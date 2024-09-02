<?php
include_once 'header.php';
include( "classes/connect.php" );
include( "classes/signup.php" );

?>

<div class="mm-signup-container mm-flex-column mm-gap-20">
    <h2 class="mm-h2-white">Sign Up</h2>
    <form class="mm-signup-form mm-flex-column mm-gap-20" action="signup.php" method="post">
        <div class="mm-flex-column mm-gap-10">
            <label for="first_name">First Name</label>
            <input class="first-name-input" type="text" name="first_name">
        </div>
        <div class="mm-flex-column mm-gap-10">
            <label for="last_name">Last Name</label>
            <input class="last-name-input" type="text" name="last_name">
        </div>
        <div class="mm-flex-column mm-gap-10">
            <label for="email">Email</label>
            <input class="email-input" type="email" name="email">
        </div>
        <div class="mm-flex-column mm-gap-10">
            <label for="username">Username</label>
            <input class="username-input" type="text" name="username">
        </div>
        <div class="mm-flex-column mm-gap-10">
            <label for="password">Password</label>
            <input class="password-input" type="password" name="password">
        </div>
        <div class="mm-flex-column mm-gap-10">
            <label for="pwdrepeat">Repeat Password</label>
            <input class="repeat-password-input" type="password" name="pwdrepeat">
        </div>
        <input type="hidden" class="repeat-password-input" type="text" name="user_role">
        <button class="mm-button" type="submit">Sign Up</button>
    </form>

	<?php

	if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
		$signup = new Signup();
		$result = $signup->evaluate( $_POST );
		if ( $result == "Empty inputs" ) {
			echo "<p class='signup-message'>Fill in all fields.</p>;";
		} else if ( $result == "Invalid username" ) {
			echo "<p class='signup-message'>Choose a proper username.</p>;";
		} else if ( $result == "Username already in use" ) {
			echo "<p class='signup-message'>Username already in use.</p>;";
		} else if ( $result == "Too short" ) {
			echo "<p class='signup-message'>Username and password must contain at least 8 characters.</p>;";
		} else if ( $result == "Email already in use" ) {
			echo "<p class='signup-message'>Email already in use.</p>;";
		} else if ( $result == "" ) {
			echo " <p class='signup-message-succes'>You have signed up! Now <a href='login.php' class='login-link'>login.</a></p> ";
		}
	}

	?>
    <!--	//-->
    <!--	//	if ( isset( $_GET["error"] ) ) {-->
    <!--	//		if ( $_GET["error"] == "emptyinput" ) {-->
    <!--	//			echo "<p class='signup-message'>Fill in all fields.</p>;-->
    <!--	//			      <script>-->
    <!--	//			          jQuery( '.name-input' ).addClass( 'warning-field' );-->
    <!--	//                      jQuery( '.email-input' ).addClass( 'warning-field' );-->
    <!--	//                      jQuery( '.username-input' ).addClass( 'warning-field' );-->
    <!--	//                      jQuery( '.password-input' ).addClass( 'warning-field' );-->
    <!--	//                      jQuery( '.repeat-password-input' ).addClass( 'warning-field' );-->
    <!--	//                  </script>;";-->
    <!--	//		} else if ( $_GET["error"] == "invaliduid" ) {-->
    <!--	//			echo "<p class='signup-message'>Choose a proper username.</p>;-->
    <!--	//                  <script>-->
    <!--	//                      jQuery( '.username-input' ).addClass( 'warning-field' );-->
    <!--	//                  </script>";-->
    <!--	//        } else if ( $_GET["error"] == "invaildemail" ) {-->
    <!--	//			echo " <p class='signup-message'>Choose a proper email.</p>;-->
    <!--	//                   <script>-->
    <!--	//                      jQuery( '.email-input' ).addClass( 'warning-field' );-->
    <!--	//                   </script>";-->
    <!--	//        } else if ( $_GET["error"] == "passwordsdontmatch" ) {-->
    <!--	//			echo " <p class='signup-message'>Use the same password.</p>;-->
    <!--	//                   <script>-->
    <!--	//                      jQuery( '.email-input' ).addClass( 'warning-field' );-->
    <!--	//                   </script>";-->
    <!--	//		} else if ( $_GET["error"] == "stmtfailes" ) {-->
    <!--	//			echo " <p class='signup-message'>Something went wrong. Try again!</p> ";-->
    <!--	//		} else if ( $_GET["error"] == "usernametaken" ) {-->
    <!--	//			echo " <p class='signup-message'>The username or the email is already taken.</p>;-->
    <!--	//			       <script>-->
    <!--	//                      jQuery( '.username-input' ).addClass( 'warning-field' );-->
    <!--	//                   </script>";-->
    <!--	//		} else if ( $_GET["error"] == "none" ) {-->
    <!--	//			echo " <p class='signup-message-succes'>You have signed up! Now <a href='login.php' class='login-link'>login.</a></p> ";-->
    <!--	//		}-->
    <!--	//	}-->
    <!--	//-->
    <!--	//	-->
</div>
<style>
    .signup-message-succes {
        color: var(--white);
        text-align: center;
        font-weight: 400;
        font-size: 16px;
    }

    .signup-message {
        color: var(--purple);
        text-align: center;
        font-weight: 400;
        font-size: 16px;
    }

    .warning-field {
        border: 1px solid;
        padding: 10px;
        box-shadow: 0 0 10px var(--purple) inset;
    }

    .login-link {
        color: var(--purple);
        text-decoration: underline;
    }
</style>


<?php include_once 'footer.php' ?>
