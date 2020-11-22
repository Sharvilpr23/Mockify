<?php
    include_once 'includes/connection.php';
?>

<html>
<head>
    <link rel="stylesheet" href="index.css">
    <title>M | songs</title>
</head>

<body>
    <center><h1>Songs</h1></center>
    <center>
    <?php
        $result =$conn->query("SELECT * FROM Song;");
        echo "<table border='1'>
            <tr>
            <th>Song id</th>
            <th>Song name</th>
            <th>Duration</th>
            <th>Listen Count</th>
            <th>Album id</th>
            </tr>";
        while($row = mysqli_fetch_array($result))
        {
            echo "<tr>";
            echo "<td>" . $row['songid'] . "</td>";
            echo "<td>" . $row['songname'] . "</td>";
            echo "<td>" . $row['duration'] . "</td>";
            echo "<td>" . $row['listencount'] . "</td>";
            echo "<td>" . $row['albumid'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";


    ?>
    </center>
    <br>
    <center>
    <form action = "songoperations.php" method = "post">
        <label for="song_id">Song ID</label>
        <input type = "number" id = "song_id" name = "song_id">
        <label for="song_name">Song Name</label>
        <input type = "text" id = "song_name" name = "song_name">
        <label for="len">Length</label>
        <input type = "number" id = "len" name = "len">
        <label for="listen_count">Listen Count</label>
        <input type = "number" id = "listen_count" name = "listen_count">
        <label for="album_id">Album ID</label>
        <input type = "number" id = "album_id" name = "album_id">
        <br>
        <br>
        <table>
            <select size = 3 id = status name = status>
                <option>Add Song</option>
                <option>Search Song</option>
                <option>Remove Song</option>
            <select>
        </table>
        <br>
        <input type = "submit" value = "Submit">
    </center> 
    </form>
    <br>
    <center>
        <a href = "index.php">Return to mainpage</a>
    </center>
</body>
</html>
