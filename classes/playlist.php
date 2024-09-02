<?php

class Playlist {

	private $error = "";

	function create_playlist( $data, $userid ) {

		if ( ! empty( $data["playlist_name"] ) ) {
			$playlist_name = addslashes( $data["playlist_name"] );
			$playlistid    = $this->create_playlistid();

			$query = "insert into playlist (playlist_name, playlistid, userid) 
					  values ('$playlist_name', '$playlistid', '$userid')";

			$DB = new Database();
			$DB->save( $query );
		} else {
			$this->error = "Type something.";
		}

		return $this->error;
	}

	function get_playlist( $id ) {
		$query = "select * from playlist where userid = '$id' order by id desc limit 10";

		$DB     = new Database();
		$result = $DB->read( $query );

		if ( $result ) {
			return $result;
		} else {
			return false;
		}
	}

	function delete_playlist( $playlistid ) {
		$query = "delete from playlist where playlistid = '$playlistid' limit 1";

		$DB     = new Database();
		$result = $DB->save( $query );

		if ( $result ) {
			return $this->error;
		}
	}

	function update_playlist_name( $playlistid, $playlistname ) {
		$query = "update playlist set playlist_name = '$playlistname' where playlistid = '$playlistid'";

		$DB     = new Database();
		$result = $DB->save( $query );

		if ( $result ) {
			return $this->error;
		}
	}


	private
	function create_playlistid() {
		$length = rand( 4, 19 );
		$number = "";
		for ( $i = 0; $i < $length; $i ++ ) {
			$new_rand = rand( 0, 9 );
			$number   = $number . $new_rand;
		}

		return $number;
	}
}
