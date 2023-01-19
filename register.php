<?php

include 'connection.php';

error_reporting(0);

session_start();

if(isset($_SESSION['username'])) {
    header("Location: index.php");
}

if(isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $cpassword = md5($_POST['cpassword']);

    if($password == $cpassword) {
        $sql = "SELECT * FROM users WHERE username = '$username'";
        $result = mysqli_query($con, $sql);
        if(!$result->num_rows > 0) {
            $sql = "INSERT INTO users (username, password) VALUES ('$username', '$password')";
            $result = mysqli_query($con, $sql);
            if($result) {
                echo "<script>alert('Selamat, Registrasi berhasil!')</script>";
                reset_post();
                sleep(1);
            } else {
                echo "<script>alert('Terjadi kesalahan')</script>"; 
                reset_post();
            }
        } else {
            echo "<script>alert('Username Sudah Terdaftar')</script>";
            reset_post();
        }
    } else {
        echo "<script>alert('Password Tidak Sesuai')</script>";
        reset_post();
    }

    header('Location:index.php');
}

function reset_post() {
    $username = "";
    $password = "";
    $cpassword = "";
    $_POST['username'] = "";
    $_POST['password'] = "";
    $_POST['cpassword'] = "";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link rel="stylesheet" href="css/style.css">

    <style>
        .form-control {
            width: 50%;
        }
    </style>
    
</head>
<body>
    <div align="center" class="container mt-5">
        <div class="w-500">
            <form action="" method="POST" class="shadow p-3 mb-5 bg-body rounded form-control">
                <p class="text-center" style="font-size:2rem; font weight: 800;">Register</p>
                <div class="mb-3">
                    <input type="text" placeholder="Username" name="username" value="" required>
                </div>
                <div class="mb-3">
                    <input type="password" placeholder="Password" name="password" value="" required>
                </div>
                <div class="mb-3">
                    <input type="password" placeholder="Confirm Password" name="cpassword" value="" required>
                </div>
                <div class="mb-3">
                    <button class="btn btn-primary" name="submit">Register</button>
                </div>
                <p>Anda sudah punya akun? <a href="index.php">Login</a> </p>
            </form>
        </div>
    </div>
</body>
</html>