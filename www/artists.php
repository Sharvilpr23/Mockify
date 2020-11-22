<?php
    include_once 'includes/connection.php';
?>

<html>
<head>
    <link rel="stylesheet" href="index.css">
    <title>M | artists</title>
</head>

<body>
    <h2>
        <center>Artists</center>
    </h2>
    <center>
    <?php
        $result = mysqli_query($conn, "SELECT * FROM Artist;");
        echo "<table border='1'>
            <tr>
            <th>Artist id</th>
            <th>Artist name</th>
            </tr>";
        while($row = mysqli_fetch_array($result))
        {
            echo "<tr>";
            echo "<td>" . $row['artistid'] . "</td>";
            echo "<td>" . $row['artistname'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";

        mysqli_close($conn);
    ?>
    <center>
    <br>
    <center>
    <form action = "artistoperations.php" method = "post">
        <label for="artist_id">Artist ID</label>
        <input type = "number" id = "artist_id" name = "artist_id">
        <label for="artist_name">Artist Name</label>
        <input type = "text" id = "artist_name" name = "artist_name">
        <br><br>
        <table>
            <select size = 3 id = status name = status>
                <option>Add Artist</option>
                <option>List Artist's Songs</option>
                <option>List Artist's Albums</option>
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
