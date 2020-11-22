<?php
    include_once 'includes/connection.php';
?>

<html>
<head>
    <link rel="stylesheet" href="index.css">
    <title>M | albums</title>
</head>

<body>
    <h2>
        <center>Albums</center>
    </h2>
    <center>
    <?php
        $result = mysqli_query($conn, "SELECT * FROM Album;");
        echo "<table border='1'>
            <tr>
            <th>Album id</th>
            <th>Album name</th>
            <th>Genre</th>
            <th>Release Date</th>
            </tr>";
        while($row = mysqli_fetch_array($result))
        {
            // Figure out how to print artist
            echo "<tr>";
            echo "<td>" . $row['albumid'] . "</td>";
            echo "<td>" . $row['albumname'] . "</td>";
            echo "<td>" . $row['genre'] . "</td>";
            echo "<td>" . $row['releasedate'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
        mysqli_close($conn);
    ?>
    <center>
    <br>
    <center>
    <form action = "albumoperations.php" method = "post">
        <label for="album_id">Album ID</label>
        <input type = "number" id = "album_id" name = "album_id">
        <label for="album_name">Album Name</label>
        <input type = "text" id = "album_name" name = "album_name">
        <label for="artist_id">Artist ID</label>
        <input type = "number" id = "artist_id" name = "artist_id">
        <label for="artist_name">Artist Name</label>
        <input type = "text" id = "artist_name" name = "artist_name">
        <label for="genre">Genre</label>
        <input type = "text" id = "genre" name = "genre">
        <label for="release_date">Release Date</label>
        <input type = "date" id = "release_date" name = "release_date">
        <br>
        <br>
        <table>
            <select size = 3 id = status name = status>
                <option>Add Album</option>
                <option>Search Album</option>
                <option>Remove Album</option>
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
