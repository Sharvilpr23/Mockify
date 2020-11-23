<?php
    include_once 'includes/connection.php';
?>

<html>
<head>
    <link rel="stylesheet" href="index.css">
    <title>M | songs</title>
</head>
<body>
<?php
    $status = $_POST['status'];
    echo "<center><h1>$status</h1></center>";

    $song_id = mysqli_real_escape_string($conn, $_POST['song_id']);
    $song_name = mysqli_real_escape_string($conn, $_POST['song_name']);
    $album_id = mysqli_real_escape_string($conn, $_POST['album_id']);
    $duration = mysqli_real_escape_string($conn, $_POST['duration']);
    $listen_count = mysqli_real_escape_string($conn, $_POST['listen_count']);

    if ($status == "Add Song")
    {
        $query = "INSERT into Song (songid, songname, albumid, duration, listencount)
                    VALUES (?, ?, ?, ?, ?);";

        $stmt = mysqli_stmt_init($conn);

        if(mysqli_stmt_prepare($stmt, $query)){

            mysqli_stmt_bind_param($stmt, "isdii", $song_id, $song_name, $album_id, $duration, $listen_count);
            mysqli_stmt_execute($stmt);
        }
        else{
            echo "Fail";
        }
        mysqli_close($conn);
        header("Location: ./songs.php");
    }
    else if ($status == 'Search Song')
    {  
        $query = "SELECT * FROM Song WHERE songid = ? OR songname = ?";

        $stmt = mysqli_stmt_init($conn);

        if(mysqli_stmt_prepare($stmt, $query)){

            mysqli_stmt_bind_param($stmt, "is", $song_id, $song_name);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            echo "<center><table border='1'>
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
                echo "<td>" . $row['albumid'] . "</td>";
                echo "<td>" . $row['duration'] . "</td>";
                echo "<td>" . $row['listencount'] . "</td>";
                echo "</tr>";
            }
            echo "</table></center>";
        }
        else {
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
        header("Location: ./songs.php");
    }
    
?>

</body>
</html>