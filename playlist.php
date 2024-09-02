<?php
include_once 'header.php';
include( "classes/connect.php" );
include( "classes/login.php" );
include( "classes/user.php" );
include( "classes/playlist.php" );
include( "classes/song.php" );

//check if user is logged in
if ( isset( $_SESSION['musicmanager_userid'] ) && is_numeric( $_SESSION['musicmanager_userid'] ) ) {
	$id     = $_SESSION['musicmanager_userid'];
	$login  = new Login();
	$result = $login->check_login( $id );

	if ( $result ) {
		$user      = new User();
		$user_data = $user->get_data( $id );

		if ( ! $user_data ) {
			header( "location: login.php" );
		}
	} else {
		header( "location: login.php" );
		die();
	}
} else {
	header( "location: login.php" );
	die();
}

$playlist   = new Playlist();
$id         = $_SESSION['musicmanager_userid'];
$playlists  = $playlist->get_playlist( $id );
$playlistid = $_GET['playlistid'];

$song  = new Song();
$songs = $song->get_song( $playlistid );


?>

<div class="mm-container" style="padding-bottom: 900px">
    <div>
		<?php if ( $playlists ) {
			foreach ( $playlists as $row ) {
				if ( $row['playlistid'] == $_GET['playlistid'] ) {
					echo " <div class='mm-flex-align-items-center mm-gap-20'>
                                <h2 class='mm-h2-white'> {$row['playlist_name']}</h2>
                                <a class='mm-button add-song-button'>Add song</a>
                           </div> ";
				}
			}
		}
		?>
    </div>
    <div>
		<?php if ( isset( $_POST['save'] ) ) {
			$playlistid = $_GET['playlistid'];
			$song       = new Song();
			$result     = $song->create_song( $playlistid, $_FILES );
			if ( $result == "" ) {
				header( "location: playlist.php?playlistid={$playlistid}" );
				die();
				echo "<p>Song added succesfully.</p>";
			} else if ( $result == "File exists" ) {
				echo "<p class='song-add-error'>File already exists on the server.</p>";
			} else if ( $result == "File type" ) {
				echo "<p class='song-add-error'>Please, choose an mp3 format audio.</p>";
			}

		} ?>
    </div>
    <div>
        <form id="upload-files" enctype="multipart/form-data" method="POST" class="upload-files-form mm-d-none">
            <input type="file" name="song_path" class="audio-files">
            <button type="submit" name="save" class="submit-files-button mm-button">Submit</button>
        </form>
    </div>
    <div class='song-list'>
		<?php if ( $songs ) {
			foreach ( $songs as $row ) {
				echo "<div class='song-list-item'>
                        <div class='mm-flex-space-between'>
                            <p class='song-title'> {$row['song_name']}</p>
                        
                            <audio controls>
                                <source src='{$row['song_path']}' type='audio/mpeg'>
                            </audio>
                            
                        </div>
                        
                        <form method='post'>
                            <input type='hidden' name='songid' value='{$row['songid']}'>
                            <button class='delete-playlist-button' type='submit' name='delete_song'>Delete</button>
                        </form>
                      </div>
                        ";
				{
					if ( isset ( $_POST['delete_song'] ) && isset ( $_POST['songid'] ) && $_POST['songid'] == $row['songid'] ) {
						$song   = new Song();
						$result = $song->delete_song( $row['songid'] );

						if ( $result == "" ) {

							echo "<script> window.location.href='playlist.php?playlistid=$playlistid'</script>";


						}
					}
				}
			}
		}
		?>
    </div>

</div>
</div>
<?php include( "footer.php" ); ?>
<script>
    $(".add-song-button").click(function () {
        $("#upload-files").removeClass("mm-d-none");
        $(".song-add-error").addClass("mm-d-none");
    });
</script>