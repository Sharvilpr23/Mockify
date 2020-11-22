<html>
<body>
<?php
    include_once 'includes/connection.php';

    $status = $_POST['status'];
    echo "<center><h1>$status</h1></center>";

    $playlist_id = $_POST['playlist_id'];
    $playlist_name = $_POST['playlist_name'];

    if ($status = 'Display Songs in the Playlist')
    {

        // Display songs from the Playlist

        mysqli_close($conn);
    }
    else if ($status = 'Add Song to the Playlist')
    {  
        // Add Song to the playlist

        mysqli_close($conn);
    }
    header("Location: ./artists.php?success");
?>

</body>
</html>