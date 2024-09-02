<?php

class Database {

	private $serverName = "localhost";
	private $dBUserName = "root";
	private $dBPassword = "";
	private $dBName = "login_db";


	function connect() {
		$connection = mysqli_connect( $this->serverName, $this->dBUserName, $this->dBPassword, $this->dBName );

		return $connection;
	}

	function read( $query ) {
		$connect = $this->connect();
		$result  = mysqli_query( $connect, $query );

		if ( ! $result ) {
			return false;
		} else {
			$data = false;
			while ( $row = mysqli_fetch_assoc( $result ) ) {
				$data[] = $row;
			}
			return $data;
		}
	}

	function save( $query ) {
		$connect = $this->connect();
		$result  = mysqli_query( $connect, $query );

		if ( ! $result ) {
			return false;
		} else {
			return true;
		}
	}
}

//$query = "INSERT INTO users (username, email) values ('blabla', 'hahahaha')";
//$query = "select * from users";

//if ( ! $conn ) {
//	die( "Connection failed:" . mysqli_connect_error() );
//}