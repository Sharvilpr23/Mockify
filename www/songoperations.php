<?php
    include_once 'includes/connection.php';
?>

<html>
<body>
<?php
    $status = $_POST['status'];
    echo "<center><h1>$status</h1></center>";
    $song_id = mysqli_real_escape_string($conn, $_POST['song_id']);
    $song_name = mysqli_real_escape_string($conn, $_POST['song_name']);
    $duration = mysqli_real_escape_string($conn, $_POST['len']);
    $listen_count = mysqli_real_escape_string($conn, $_POST['listen_count']);
    $album_id = mysqli_real_escape_string($conn, $_POST['album_id']);

    if ($status == "Add Song")
    {
        echo $status;
        echo $song_id;
        echo $song_name;
        echo $duration;
        echo $listen_count;
        echo $album_id;

        $query = "INSERT into Song (songid, songname, duration, listencount, albumid)
                    VALUES (?, ?, ?, ?, ?);";

        $stmt = mysqli_stmt_init($conn);

        if(mysqli_stmt_prepare($stmt, $query)){

            mysqli_stmt_bind_param($stmt, "isdii", $song_id, $song_name, $duration, $listen_count, $album_id);
            mysqli_stmt_execute($stmt);
        }
        else{
            echo "Fail";
        }
        mysqli_close($conn);
        header("Location: ./songs.php?success");
    }
    else if ($status == 'Search Song')
    {  
        $query = "SELECT * FROM Song WHERE songname = ? OR albumid = ?";

        $stmt = mysqli_stmt_init($conn);

        if(mysqli_stmt_prepare($stmt, $query)){

            mysqli_stmt_bind_param($stmt, "si", $song_name, $album_id);
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
        }
        else{
            echo "Fail";
        }
        echo "<br><center><a href='songs.php'>Return to Songs Menu</a></center>";
        mysqli_close($conn);
    }
    else if ($status == 'Remove Song')
    {
        $query = "DELETE FROM Song WHERE songid = ? OR songname = ?;";

        $stmt = mysqli_stmt_init($conn);

        if(mysqli_stmt_prepare($stmt, $query)){

            mysqli_stmt_bind_param($stmt, "is", $song_id, $song_name);
            mysqli_stmt_execute($stmt);
        }
        else{
            echo "Fail";
        }
        mysqli_close($conn);
        header("Location: ./songs.php?success");
    }
    
?>

</body>
</html>