<?php

class Song {
	private $error = "";

	function create_song( $playlistid, $file ) {
		$song_name = addslashes( $file['song_path']['name'] );
		$ext = pathinfo($song_name, PATHINFO_EXTENSION);

		if ( $ext == 'mp3' ) {
			if ( ! file_exists( "upload/" . $song_name ) ) {
				if ( move_uploaded_file( $file["song_path"]["tmp_name"], "upload/" . $song_name ) ) {
					$songid    = $this->create_songid();
					$song_path = "upload/" . $song_name;

					$query = "insert into songs (songid, playlistid, song_name, song_path) 
							  values ( '$songid', '$playlistid', '$song_name', '$song_path')";

					$DB = new Database();
					$DB->save( $query );
				} else {
					$this->error = "Error";
				}
			} else {
				$this->error = "File exists";
			}
		} else {
			$this->error = "File type";
		}


		return $this->error;
	}

	function get_song( $playlistid ) {
		$query = "select * from songs where playlistid = '$playlistid' order by id asc ";

		$DB     = new Database();
		$result = $DB->read( $query );

		if ( $result ) {
			return $result;
		} else {
			return false;
		}
	}

	function delete_song( $songid ) {
		$query = "delete from songs where songid = '$songid' limit 1";

		$DB     = new Database();
		$result = $DB->save( $query );

		if ( $result ) {
			return $this->error;
		}
	}


	private
	function create_songid() {
		$length = rand( 4, 19 );
		$number = "";
		for ( $i = 0; $i < $length; $i ++ ) {
			$new_rand = rand( 0, 9 );
			$number   = $number . $new_rand;
		}

		return $number;
	}
}