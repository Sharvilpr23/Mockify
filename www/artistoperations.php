<html>
<body>
<?php
    include_once 'includes/connection.php';

    $status = $_POST['status'];
    echo "<center><h1>$status</h1></center>";

    $artist_id = $_POST['artist_id'];
    $artist_name = $_POST['artist_name'];
    
    if ($status == 'Add Artist')
    {
        $query = "INSERT into Artist (artistid, artistname)
                    VALUES (?, ?);";

        $stmt = mysqli_stmt_init($conn);

        if(mysqli_stmt_prepare($stmt, $query)){

            mysqli_stmt_bind_param($stmt, "is", $artist_id, $artist_name,);
            mysqli_stmt_execute($stmt);
        }
        else{
            echo "Fail";
        }
        mysqli_close($conn);
        header("Location: ./songs.php?success");
    }
    else if ($status == 'List Artist\'s Songs')
    {
        $query = "SELECT * FROM Song
                    WHERE artistid = ?";

        $stmt = mysqli_stmt_init($conn);

        if(mysqli_stmt_prepare($stmt, $query)){

            mysqli_stmt_bind_param($stmt, "i", $artist_id);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            echo "<center><table border='1'>
            <tr>
            <th>Song id</th>
            <th>Song name</th>
            <th>Length</th>
            <th>Listen Count</th>
            <th>Album id</th>
            </tr>";
            while($row = mysqli_fetch_array($result))
            {
                echo "<tr>";
                echo "<td>" . $row['songid'] . "</td>";
                echo "<td>" . $row['songname'] . "</td>";
                echo "<td>" . $row['length'] . "</td>";
                echo "<td>" . $row['listencount'] . "</td>";
                echo "<td>" . $row['albumid'] . "</td>";
                echo "</tr>";
            }
            echo "</table></center>";
        // Prompt for Songs to be added to the album

        mysqli_close($conn);
    }
    else if ($status == 'List Artist\'s Albums')
    {  
        $query = "SELECT * FROM Album
                    WHERE albumid IN  (SELECT albumid FROM ArtistAlbum WHERE artistid = ?)";

        $stmt = mysqli_stmt_init($conn);

        if(mysqli_stmt_prepare($stmt, $query)){

            mysqli_stmt_bind_param($stmt, "i", $artist_id);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
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
        }
        else{
            echo "Fail";
        }
        echo "<br><center><a href='artists.php'>Return to Artist Menu</a></center>";
        mysqli_close($conn);
    }
    //header("Location: ./artists.php?success");
?>

</body>
</html>