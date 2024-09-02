<?php

class Login {

	private $error = "";

	public function evaluate( $data ) {
		$username = addslashes( $data["username"] );
		$password = addslashes( $data["password"] );

		$query = "select * from users where email = '$username' or username = '$username' limit 1";

		$DB     = new Database();
		$result = $DB->read( $query );

		if ( $result ) {
			$row = $result[0];

			if($password == $row['password']) {
				$_SESSION['musicmanager_userid'] = $row['userid'];
				header("location: index.php");
			} else {
				$this->error = "Incorrect email or password";
			}
		} else {
			$this->error = "Incorrect email or password";
		}

		if ( empty( $username ) || empty( $password ) ) {
			$this->error = "Empty inputs";
		}
		return $this->error;
	}

	public function check_login($id) {
		$query = "select userid from users where userid = '$id' limit 1";

		$DB     = new Database();
		$result = $DB->read( $query );

		if($result) {
			return true;
		}

		return false;
	}
}