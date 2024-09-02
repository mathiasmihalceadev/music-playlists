<?php
include_once 'header.php';
include( "classes/connect.php" );
include( "classes/login.php" );
include( "classes/user.php" );
include( "classes/playlist.php" );


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

$playlist  = new Playlist();
$id        = $_SESSION['musicmanager_userid'];
$playlists = $playlist->get_playlist( $id );

?>

<section style="padding-bottom: 500px" class="profile-page">
    <div class="profile-page-container">
        <div>
            <div class="details-container mm-flex-space-between">
                <div class="mm-flex-column mm-gap-20">
                    <h3 class="mm-h2-black">Hi, <?php echo $user_data["username"]; ?>!</h3>
                    <div class="mm-flex-column mm-gap-10">
                        <h4>Details</h4>
                        <ul class="mm-flex-column mm-gap-10">
                            <li>
                                <div>
                                    <h5>Name</h5>
                                    <p><?php echo $user_data["first_name"] . " " . $user_data["last_name"]; ?></p>
                                </div>
                            </li>
                            <li>
                                <div>
                                    <h5>Email</h5>
                                    <p><?php echo $user_data["email"]; ?></p>
                                </div>
                            </li>
                            <li>
                                <form method="post">
                                    <button class="mm-button delete-user-button" type="submit" name="delete-account">Delete account</button>
                                </form>
								<?php if ( isset( $_POST['delete-account'] ) ) {
									$user   = new User();
									$result = $user->delete_user( $id );
                                    session_start();
									session_unset();
									session_destroy();
									header("location: index.php");
								} ?>
                            </li>
                            <li>
                                <form method="post" id="update-username-form" class="update-username-form mm-d-none">
                                    <input type="text" name="updated-username" value="<?php $user_data['username'] ?>">
                                    <button class="mm-button delete-user-button" type="submit" name="update-username">Change username</button>
                                </form>
                                <a class="mm-button edit-user-button" id="edit-username">Edit username</a>
                                <script>
                                    let num = true;

                                    $("#edit-username").click(function () {
                                        if (num === true) {
                                            $('#update-username-form').removeClass('mm-d-none');
                                            num = false;
                                        } else {
                                            $('#update-username-form').addClass('mm-d-none');
                                            num = true;
                                        }
                                    });
                                </script>
								<?php if ( isset( $_POST['update-username'] ) ) {
									$user   = new User();
									$result = $user->update_username( $id, $_POST['updated-username'] );

									if ( $result == "" ) {
										echo "<script> window.location.href='profile.php'</script>";
									}
								} ?>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="profile-page-img-container"><img src="img/no-profile-img.png" alt=""></div>
            </div>
			<?php
			if ( $user_data['user_role'] == 'admin' ) {
				include( "admin-panel.php" );
			}

			?>
            <div class="playlists-container">
                <div class="mm-flex-align-items-center mm-gap-20">
                    <h2 class="mm-h2-white">My playlists</h2>
                    <a id="add-playlist-btn" class="add-playlist-btn mm-button mm-flex-align-items-center mm-gap-10"><i class="fa-solid fa-plus"></i>Add new</a>
                </div>
                <div class="add-playlist mm-d-none">
                    <form class="mm-flex mm-gap-10" method="post">
                        <label for="playlist_name">Playlist Name</label>
                        <input type="text" name="playlist_name" class="input-playlist-name">
                        <button type="submit" name="create-playlist" class="mm-button">Add</button>
                    </form>
                </div>
                <div class="">
                    <div><?php
						if ( isset( $_POST['create-playlist'] ) ) {
							$playlist = new Playlist();
							$result   = $playlist->create_playlist( $_POST, $id );

							if ( $result == "" ) {
								echo "<script> window.location.href='profile.php'</script>";
								echo "<p id='playlist-add-message' class='mm-text-white'>Playlist added succesfully.</p>";
							} else {
								echo "<p id='playlist-add-message' class='mm-text-white'>Something went wrong.</p>";
							}
						}
						?>
                    </div>

                    <div class="playlists-list">
                        <ul class="mm-list-style-none">
							<?php if ( $playlists ) {
								foreach ( $playlists as $row ) {
									echo "<li class='mm-text-white'>
                                            <div class='mm-text-white mm-flex-column mm-gap-10 mm-padding-10 playlist-name-container'>
                                                <h4 id='playlist-name-{$row['playlistid']}'>{$row['playlist_name']}</h4>
                                                <form id='update-playlist-form-{$row['playlistid']}' method='post' class='update-form mm-d-none'>
                                                    <input type='hidden' name='playlistid' value='{$row['playlistid']}'>

                                                    <input type='text' value='{$row['playlist_name']}' name='new-playlist-name'>
                                                    <button class='mm-button' type='submit' name='edit-playlist-name'>Edit</button>
                                                </form>
                                                <a href='playlist.php?playlistid={$row['playlistid']}'>    
                                                    <i class='fa-solid fa-play'></i>
                                                </a>
                                            </div>
                                            
                                            <div class='mm-flex-align-items-center mm-gap-10'>
                                                <form method='post' class='edit-playlist-form'>
                                                    <input type='hidden' name='playlistid' value='{$row['playlistid']}'>
                                                    <button class='delete-playlist-button' type='submit' name='delete-playlist' >Delete</button>
                                                </form>
                                                <a class='edit-playlist-button-style edit-playlist-button-{$row['playlistid']}'>Edit</a>
                                            </div>
                                            
                                            <script>
                                                let num2 = true;
                                                
                                                $('.edit-playlist-button-{$row['playlistid']}').click(function () {
                                                      if(num2 === true) {
                                                          $('#update-playlist-form-{$row['playlistid']}').removeClass('mm-d-none');
                                                          $('#playlist-name-{$row['playlistid']}').addClass('mm-d-none');
                                                          num2 = false;
                                                      } else {
                                                          $('#update-playlist-form-{$row['playlistid']}').addClass('mm-d-none');
                                                          $('#playlist-name-{$row['playlistid']}').removeClass('mm-d-none');
                                                          num2 = true;
                                                      }
                                                });  
                                            </script>
                                            ";

									if ( isset ( $_POST['delete-playlist'] ) && isset ( $_POST['playlistid'] ) && $_POST['playlistid'] == $row['playlistid'] ) {
										$playlist = new Playlist();
										$result   = $playlist->delete_playlist( $row['playlistid'] );

										if ( $result == "" ) {
											echo "<script> window.location.href='profile.php'</script>";
										}
									}
									if ( isset ( $_POST['edit-playlist-name'] ) && isset ( $_POST['playlistid'] ) && $_POST['playlistid'] == $row['playlistid'] ) {
										$playlist = new Playlist();
										$result   = $playlist->update_playlist_name( $row['playlistid'], $_POST['new-playlist-name'] );

										if ( $result == "" ) {
											echo "<script> window.location.href='profile.php'</script>";
										}
									}
								}
							}

							?>
                        </ul>
                    </div>
                </div>

            </div>
</section>
<?php include ("footer.php"); ?>
<script>
    let num3 = true

    $("#add-playlist-btn").click(function () {
        if (num3 === true) {
            $(".add-playlist").removeClass("mm-d-none");
            $("#playlist-add-message").addClass("mm-d-none");
            num3 = false
        } else {
            $(".add-playlist").addClass("mm-d-none");
            $("#playlist-add-message").removeClass("mm-d-none");
            num3 = true;
        }
    });
</script>



