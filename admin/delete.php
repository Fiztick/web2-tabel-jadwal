<?php
include("../connection.php");

if(isset($_GET['id'])) {
    $id = $_GET['id'];

    $query = "DELETE FROM jadwal WHERE id = '$id'";
    $result = mysqli_query($con, $query);

    if($result) {
        header("Location: data_jadwal.php");
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>