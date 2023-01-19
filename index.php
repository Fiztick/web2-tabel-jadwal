<?php 
include('connection.php'); 

error_reporting(0);

session_start();

session_regenerate_id(true);

if(isset($_POST['submit'])){
    if($_SESSION["Captcha"] != $_POST["nilaiCaptcha"]) {
        echo "<script>alert('Captcha yang dimasukkan salah')</script>";
    } else { 

        $username = $_POST['username'];
        $password = md5($_POST['password']);

        $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
        $result = mysqli_query($con, $sql);
        if($result->num_rows > 0) {
            $row = mysqli_fetch_assoc($result);
            $_SESSION['username'] = $row['username'];
            if(isset($_SESSION['username'])){
                header("Location: dashboard.php");
            }
        } else {
            echo "<script>alert('Username atau password salah')</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

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
                <p class="text-center" style="font-size:2rem; font weight: 800;">Login</p>
                <div class="mb-3">
                    <input type="text" placeholder="Username" name="username" value="" required>
                </div>
                <div class="mb-3">
                    <input type="password" placeholder="Password" name="password" value="" required>
                </div>
                <div class="mb-3">
                    <img src="captcha.php" alt="gambar">
                    <input name="nilaiCaptcha" value="" maxlength="6">
                </div>
                <div class="mb-3">
                    <button class="btn btn-primary" name="submit">Login</button>
                </div>
                <p>Anda belum punya akun? <a href="register.php">Register</a> </p>
            </form>
        </div>
    </div>
</body>
</html>

