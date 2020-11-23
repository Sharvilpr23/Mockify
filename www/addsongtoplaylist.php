<?php
    include_once 'includes/connection.php';
?>
<html>
<head>
    <link rel="stylesheet" href="index.css">
    <title>M | albums</title>
</head>
<body>
<?php
    $song_name = $_POST['song_name'];
    $playlist_name = $_POST['playlist_name'];
    echo "<center><h1>$song_name</h1></center>";    
    $query = "insert into PlaylistSong select Playlist.playlistid,Song.songid from Playlist,Song where Playlist.playlistname = ? and songname = ?;";

    $stmt = mysqli_stmt_init($conn);

    if(mysqli_stmt_prepare($stmt, $query)){

        mysqli_stmt_bind_param($stmt, "is", $playlist_id, $playlist_name);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
    }
    else{
        echo "Fail";
    }
    header("Location: ./playlists.php?success");
    mysqli_close($conn);
?>