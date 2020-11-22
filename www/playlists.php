<?php
    include_once 'includes/connection.php';
?>

<html>
<head>
    <link rel="stylesheet" href="index.css">
    <title>M | playlists</title>
</head>

<body>
    <h2>
        <center>Playlists</center>
    </h2>
    <center>
    <?php
        $result = mysqli_query($conn, "SELECT * FROM Playlist;");
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

        mysqli_close($conn);
    ?>
    <center>
    <br>
    <center>
    <form action = "playlistoperations.php" method = "post">
        <label for="playlist_id">Playlist ID</label>
        <input type = "number" id = "playlist_id" name = "playlist_id">
        <label for="playlist_name">Playlist Name</label>
        <input type = "text" id = "playlist_name" name = "playlist_name">
        <br><br>
        <table>
            <select size = 2 id = status name = status>
                <option>Display Songs in the Playlist</option>
                <option>Add Song to the Playlist</option>
            <select>
        </table>
        <br>
        <input type = "submit" value = "Submit">
    </form>
    </center>
    <br>
    <center>
        <a href = "index.php">Return to mainpage</a>
    </center>
</body>
</html>
