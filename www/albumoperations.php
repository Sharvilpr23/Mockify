<?php
    include_once 'includes/connection.php';
?>

<html>
<body>
<?php
    $status = $_POST['status'];
    echo "<center><h1>$status</h1></center>";

    $album_id = $_POST['album_id'];
    $album_name = $_POST['album_name'];
    $artist_id = $_POST['artist_id'];
    $artist_name = $_POST['artist_name'];
    $genre = $_POST['genre'];
    $release_date = $_POST['release_date'];

    if ($status == 'Add Album')
    {
        $query1 = "INSERT into Album (albumid, albumname, genre, releaseDate)
                    VALUES (?, ?, ?, ?);";
        $query2 = "INSERT into ArtistAlbum (albumid, artistid)
                    VALUES (?, ?)";
        $query3 = "INSERT into Artist (aritistid, artistname)
                    VALUES (?, ?)";

        $stmt = mysqli_stmt_init($conn);

        if(mysqli_stmt_prepare($stmt, $query1)){

            mysqli_stmt_bind_param($stmt, "isss", $album_id, $album_name, $genre, $release_date);
            mysqli_stmt_execute($stmt);
        }
        else{
            echo "Fail";
        }
        mysqli_close($conn);
        header("Location: ./songs.php?success");

        // Prompt for Songs to be added to the album
    }
    else if ($status == 'Search Album')
    {  
        $query = "SELECT * FROM Album WHERE albumname = ?";

        $stmt = mysqli_stmt_init($conn);

        if(mysqli_stmt_prepare($stmt, $query)){

            mysqli_stmt_bind_param($stmt, "s", $album_name);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            echo "<center>";
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
            echo "</center>";
        }
        else{
            echo "Fail";
        }
        mysqli_close($conn);
    }
    else if ($status == 'Remove Album')
    {
        $query = "DELETE FROM Album WHERE albumid = ? OR albumname = ?;";

        $stmt = mysqli_stmt_init($conn);

        if(mysqli_stmt_prepare($stmt, $query)){

            mysqli_stmt_bind_param($stmt, "is", $album_id, $album_name);
            mysqli_stmt_execute($stmt);
        }
        else{
            echo "Fail";
        }
        mysqli_close($conn);
        header("Location: ./albums.php?success");
    }
?>
    <br>
    <center>
    <a href="albums.php">Return to Albums Menu</a>
    </center>
</body>
</html>