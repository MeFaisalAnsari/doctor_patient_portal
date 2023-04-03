<?php
include("../connection.php");

$error = false;
if (isset($_POST["login"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $query = mysqli_query($con, "SELECT * FROM admin WHERE username = '$username' AND password = '$password'");
    $row = mysqli_num_rows($query);

    if ($row > 0) {
        session_start();
        $_SESSION["loggedin"] = true;
        $_SESSION["user"] = "admin";
        header("location:index");
    } else {
        $error = true;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Doctor Patient Portal</title>
    <link rel="stylesheet" href="../vendor/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="../vendor/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="../style.css">
</head>

<body>
    <div class="container d-flex justify-content-center align-items-center min-vh-100 text-center">
        <div class="form-container shadow-lg px-4 py-5 rounded-3">
            <h2 class="mb-4">Admin Login</h2>
            <form action="" method="POST">
                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
                    <input type="text" name="username" class="form-control" placeholder="Username" required>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="fa-solid fa-key"></i></span>
                    <input type="password" name="password" class="form-control" placeholder="Password" required>
                </div>
                <?php if ($error) { ?>
                    <small class="text-danger d-inline-block mb-3">Wrong Email or Password !</small>
                <?php } ?>
                <button type="submit" name="login" class="btn btn-primary w-100">Login</button>
            </form>
        </div>
    </div>
</body>

</html>