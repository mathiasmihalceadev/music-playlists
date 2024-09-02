<?php

class Admin {

	private $error = "";

	public function get_users() {

		$query = "select * from users";

		$DB     = new Database();
		$result = $DB->read( $query );

		if ( $result ) {
			return $result;
		} else {
			return false;
		}
	}


//	public function evaluate_user( $data ) {
//		$first_name = addslashes( $data["first_name"] );
//		$last_name  = addslashes( $data["last_name"] );
//		$email      = addslashes( $data["email"] );
//		$username   = addslashes( $data["username"] );
//		$password   = addslashes( $data["password"] );
//		$user_role  = addslashes( $data["user_role"] );
//
//		//Username in use error
//
//		$query_username = "select * from users where username = '$username' limit 1";
//
//		$DB              = new Database();
//		$result_username = $DB->read( $query_username );
//
//		if ( $result_username ) {
//			$this->error = "Username already in use";
//		}
//
//		//Email in use error
//
//		$query_email = "select * from users where email = '$email' limit 1";
//
//		$DB           = new Database();
//		$result_email = $DB->read( $query_email );
//
//		if ( $result_email ) {
//			$this->error = "Email already in use";
//		}
//
//		if ( strlen( $username ) < 8 || strlen( $password ) < 8 ) {
//			$this->error = "Too short";
//		}
//
//		if ( empty( $first_name ) || empty( $last_name ) || empty( $email ) || empty( $username ) || empty( $password ) || empty( $pwdrepeat ) ) {
//			$this->error = "Empty inputs";
//		}
//
//		if ( $this->error == "" ) {
//			$this->create_user_admin( $data );
//		}
//	}
//
//	public
//	function create_user_admin(
//		$data
//	) {
//
//		$first_name = addslashes( $data["first_name"] );
//		$last_name  = addslashes( $data["last_name"] );
//		$email      = addslashes( $data["email"] );
//		$username   = addslashes( $data["username"] );
//		$password   = addslashes( $data["password"] );
//		$user_role  = addslashes( $data["user_role"] );
//
//
//		$userid = $this->create_userid();
//		//		$url_address = strtolower( $first_name ) . "." strtolower( $last_name );
//
//		$query = "insert into users (userid, first_name, last_name, email, username, password, user_role ) values ('$userid', '$first_name', '$last_name', '$email','$username', '$password', '$user_role')";
//
//		$DB = new Database();
//		$DB->save( $query );
//	}

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

	public function delete_users( $id ) {
		$query = "delete from users where userid = '$id' limit 1";

		$DB = new Database();
		$DB->save( $query );

		return $this->error;
	}

	public function update_user( $data ) {
		$username  = addslashes( $data['username'] );
		$user_role = addslashes( $data['user_role'] );

		$query = "update users set user_role = '$user_role' where username = '$username'";

		$DB = new Database();
		$DB->save( $query );
	}
}