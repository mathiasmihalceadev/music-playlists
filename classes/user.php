<?php

class User {

	public function get_data($id) {

		$query = "select * from users where userid = '$id' limit 1";

		$DB = new Database();
		$result = $DB->read($query);

		if($result){
			$row= $result[0];
			return $row;
		} else {
			return false;
		}
	}

	public function delete_user( $id ) {
		$query = "delete from users where userid = '$id' limit 1";

		$DB     = new Database();
		$DB->save( $query );

		return $this->error;
	}


	public function update_username ($id, $username ) {
		$query = "update users set username = '$username' where userid = '$id'";

		$DB     = new Database();
		$DB->save( $query );

		return $this->error;
	}

}

