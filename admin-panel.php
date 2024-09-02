<?php

include("classes/admin.php");
include( "classes/signup.php" );
$user  = new Admin();
$users = $user->get_users();

if ( $user_data["user_role"] == "admin" ) {
	echo "<div class='admin-panel'>
			<div><h2 class='mm-h2-black'>Admin panel</h2></div>
			<div class='users-table-grid users-table-grid-header'>
				<div class='mm-text-black'>User id</div>
				<div class='mm-text-black'>Role</div>
				<div class='mm-text-black'>Email</div>
				<div class='mm-text-black'>Username</div>
				<div class='mm-text-black'>Remove user</div>	
			</div>";
	if ( $users ) {
		foreach ( $users as $row ) {
			echo "	<div class='users-table-grid'>	
						<div class='mm-text-black'>{$row['userid']}</div>
						<div class='mm-text-black'>{$row['user_role']}</div>
						<div class='mm-text-black'>{$row['email']}</div>
						<div class='mm-text-black'>{$row['username']}</div>
				  		<form method='post'>
				  			<input type='hidden' name='userid' value='{$row['userid']}'>
							<button type='submit' name='delete-user'><i class='fa-solid fa-xmark fa-xl'></i></button>
				  		</form>
				  		</div>";

			if ( isset( $_POST['delete-user'] ) && isset( $_POST['userid'] ) && $_POST['userid'] == $row['userid'] ) {
				$delete      = new Admin();
				$delete_user = $delete->delete_users( $row['userid'] );
				echo "<script> window.location.href='profile.php'</script>";
			}
		}
	}
	echo "<form class='mm-flex-column mm-gap-10 add-user-form' method='post'>
        <h4>Add new user</h4>
        <div>
			<input placeholder='First Name...' class='first-name-input' type='text' name='first_name'>
        </div>
        <div>
			<input placeholder='Last Name...' class='last-name-input' type='text' name='last_name'>
        </div>
        <div>
			<input placeholder='Email...' class='email-input' type='email' name='email'>
        </div>
        <div>
			<input placeholder='Username...' class='username-input' type='text' name='username'>
        </div>
        <div>
			<input placeholder='Password...' class='password-input' type='password' name='password'>
        </div>
        <div>
        	<input placeholder='Repeat password...' class='password-input' type='password' name='pwdrepeat'>
		</div>
		<div>
        	<input placeholder='User role...' class='password-input' type='text' name='user_role'>
		</div>
        <button name='add-user' class='mm-button' type='submit'>Add user</button>
    </form>";

	if ( isset( $_POST['add-user'] ) ) {
		$signup = new Signup();
		$result = $signup->evaluate( $_POST );
		if ( $result == "Empty inputs" ) {
			echo "<p class='added-user-message'>Fill in all fields.</p>";
		} else if ( $result == "Invalid username" ) {
			echo "<p class='added-user-message'>Choose a proper username.</p>";
		} else if ( $result == "Use the same password" ) {
			echo "<p class='added-user-message'>Use the same password.</p>";
		} else if ( $result == "Username already in use" ) {
			echo "<p class='added-user-message'>Username already in use.</p>";
		} else if ( $result == "Too short" ) {
			echo "<p class='added-user-message'>Username and password must contain at least 8 characters.</p>";
		} else if ( $result == "Email already in use" ) {
			echo "<p class='added-user-message'>Email already in use.</p>";
		} else if ( $result == "" ) {
			echo "<script> window.location.href='profile.php'</script>";
			echo "<p class='added-user-message'>User added succesfully</p> ";
		}
	}

	echo "<form class='mm-flex-column mm-gap-10 add-user-form' method='post'>
				<h4>Change user role by username</h4>
				<input placeholder='Username...' type='text' name='username'>
				<input placeholder='New user role...' type='text' name='user_role'>
				<button class='mm-button' name='change-user-role'>Submit</button>
			</form>
			</div>";

	if ( isset( $_POST['change-user-role'] ) ) {
		$update      = new Admin();
		$update_user = $update->update_user( $_POST );

		echo "<script> window.location.href='profile.php'</script>";
	}
}
