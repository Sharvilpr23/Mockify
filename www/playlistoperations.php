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
    $status = $_POST['status'];
    echo "<center><h1>$status</h1></center>";

    $playlist_id = $_POST['playlist_id'];
    $playlist_name = $_POST['playlist_name'];

    if ($status == 'Create Playlist')
    {
        $query = "INSERT into Playlist (playlistid, playlistname)
                    VALUES (?, ?);";

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

    } 
    else if ($status == 'Search Playlist')
    {
        $query = "SELECT * FROM Playlist WHERE playlistid = ? OR playlistname = ?";

        $stmt = mysqli_stmt_init($conn);

        if(mysqli_stmt_prepare($stmt, $query)){

            mysqli_stmt_bind_param($stmt, "is", $playlist_id, $playlist_name);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            echo "<center>";
            echo "<table border='1'>
            <tr>
            <th>Playlist id</th>
            <th>Playlist name</th>
            </tr>";
            while($row = mysqli_fetch_array($result))
            {
                echo "<tr>";
                echo "<td>" . $row['playlistid'] . "</td>";
                echo "<td>" . $row['playlistname'] . "</td>";
                echo "</tr>";
            }
            echo "</table>";
            echo "</center>";
        }
        else{
            echo "Fail";
        }
        mysqli_close($conn);
    }
    else if ($status == 'Remove Playlist')
    {
        $query = "DELETE FROM Playlist WHERE playlistid = ? OR playlistname = ?;";

        $stmt = mysqli_stmt_init($conn);

        if(mysqli_stmt_prepare($stmt, $query)){

            mysqli_stmt_bind_param($stmt, "is", $playlist_id, $playlist_name);
            mysqli_stmt_execute($stmt);
        }
        else{
            echo "Fail";
        }
        mysqli_close($conn);
        header("Location: ./playlists.php?success");
    }
    else if ($status == 'Display Songs in the Playlist')
    {
        $query = "select * from Song, PlaylistSong,Playlist where Playlist.playlistid = PlaylistSong.playlistid and PlaylistSong.songid = Song.songid and Playlist.playlistname = ?;";
        $stmt = mysqli_stmt_init($conn);

        if(mysqli_stmt_prepare($stmt, $query)){

            mysqli_stmt_bind_param($stmt, "s", $playlist_name);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            echo "<center>";
            echo "<table border='1'>
            <tr>
            <th>Song ID</th>
            <th>Song Name</th>
            <th>Album ID</th>
            <th>Duration</th>
            <th>Listen Count</th>
            </tr>";
            while($row = mysqli_fetch_array($result))
            {
                echo "<tr>";
                echo "<td>" . $row['songid'] . "</td>";
                echo "<td>" . $row['songname'] . "</td>";
                echo "<td>" . $row['albumid'] . "</td>";
                echo "<td>" . $row['duration'] . "</td>";
                echo "<td>" . $row['listencount'] . "</td>";
                echo "</tr>";
            }
            echo "</table>";
            echo "</center>";
        }
        else{
            echo "Fail";
        }
        mysqli_close($conn);

    }
?>
    <br>
    <center>
    <a href="playlists.php">Return to Playlist Menu</a>
    </center>

</body>
</html>