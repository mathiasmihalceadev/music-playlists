<?php

class Signup {

	private $error = "";

	public function evaluate( $data ) {
		$first_name = addslashes( $data["first_name"] );
		$last_name  = addslashes( $data["last_name"] );
		$email      = addslashes( $data["email"] );
		$username   = addslashes( $data["username"] );
		$password   = addslashes( $data["password"] );
		$pwdrepeat  = addslashes( $data["pwdrepeat"] );
		$user_role  = addslashes( $data["user_role"] );

		//Username in use error

		$query_username = "select * from users where username = '$username' limit 1";

		$DB              = new Database();
		$result_username = $DB->read( $query_username );

		if ( $result_username ) {
			$this->error = "Username already in use";
		}

		//Email in use error

		$query_email = "select * from users where email = '$email' limit 1";

		$DB           = new Database();
		$result_email = $DB->read( $query_email );

		if ( $result_email ) {
			$this->error = "Email already in use";
		}

		if ( strlen( $username ) < 8 || strlen( $password ) < 8 ) {
			$this->error = "Too short";
		}

		if ( ! preg_match( "/^[a-zA-Z0-9]*$/", $username ) ) {
			$this->error = "Invalid username";
		}

		if ( $pwdrepeat != $password ) {
			$this->error = "Use the same password";
		}


		if ( empty( $first_name ) || empty( $last_name ) || empty( $email ) || empty( $username ) || empty( $password ) || empty( $pwdrepeat ) ) {
			$this->error = "Empty inputs";
		}

		if ( $this->error == "Empty inputs" ) {
			return $this->error;
		} else if ( $this->error == "Invalid username" ) {
			return $this->error;
		} else if ( $this->error == "Too short" ) {
			return $this->error;
		} else if ( $this->error == "Use the same password" ) {
			return $this->error;
		} else if ( $this->error == "Username already in use" ) {
			return $this->error;
		} else if ( $this->error == "Email already in use" ) {
			return $this->error;
		} else if ( $this->error == "" ) {
			$this->create_user( $data );
		}
	}

	public
	function create_user(
		$data
	) {

		$first_name = addslashes( $data["first_name"] );
		$last_name  = addslashes( $data["last_name"] );
		$email      = addslashes( $data["email"] );
		$username   = addslashes( $data["username"] );
		$password   = addslashes( $data["password"] );
		$user_role  = addslashes( $data["user_role"] );


		$userid = $this->create_userid();
		//		$url_address = strtolower( $first_name ) . "." strtolower( $last_name );

		$query = "insert into users (userid, first_name, last_name, email, username, password, user_role ) values ('$userid', '$first_name', '$last_name', '$email','$username', '$password', '$user_role')";

		$DB = new Database();
		$DB->save( $query );
	}

	private
	function create_userid() {
		$length = rand( 4, 19 );
		$number = "";
		for ( $i = 0; $i < $length; $i ++ ) {
			$new_rand = rand( 0, 9 );
			$number   = $number . $new_rand;
		}

		return $number;
	}
}

//if ( isset( $_POST["submit"] ) ) {
//
//	$name      = $_POST["name"];
//	$email     = $_POST["email"];
//	$username  = $_POST["uid"];
//	$pwd       = $_POST["pwd"];
//	$pwdRepeat = $_POST["pwdrepeat"];
//
//	require_once 'dbh.inc.php';
//	require_once 'functions.inc.php';
//
//	if ( emptyInputSignup( $name, $email, $username, $pwd, $pwdRepeat ) !== false ) {
//		header( "location: ../signup.php?error=emptyinput" );
//		exit();
//	}
//
//	if ( invalidUid( $username ) !== false ) {
//		header( "location: ../signup.php?error=invaliduid" );
//		exit();
//	}
//
//	if ( invalidEmail( $email ) !== false ) {
//		header( "location: ../signup.php?error=invalidemail" );
//		exit();
//	}
//
//	if ( pwdMatch( $pwd, $pwdRepeat ) !== false ) {
//		header( "location: ../signup.php?error=passwordsdontmatch" );
//		exit();
//	}
//
//	if ( uidExists( $conn, $username, $email ) !== false ) {
//		header( "location: ../signup.php?error=usernametaken" );
//		exit();
//	}
//
//	createUser( $conn, $name, $email, $username, $pwd );
//
//} else {
//	header( "location: ../signup.php" );
//	exit();
//}
