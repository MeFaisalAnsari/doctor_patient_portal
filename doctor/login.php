<?php
include("../connection.php");

$error = false;
if (isset($_POST["login"])) {
    $email = mysqli_real_escape_string($con, $_POST["email"]);
    $password = mysqli_real_escape_string($con, $_POST["password"]);

    $query = mysqli_query($con, "SELECT * FROM doctors WHERE email = '$email' AND password = '$password'");
    $count = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);

    if ($count == 1) {
        session_start();
        $_SESSION["loggedin"] = true;
        $_SESSION["user"] = "doctor";
        $_SESSION["doctor_id"] = $row["doctor_id"];
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
    <title>Doctor Login - Doctor Patient Portal</title>
    <link rel="stylesheet" href="../vendor/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="../vendor/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="../style.css">
</head>

<body>
    <div class="container d-flex justify-content-center align-items-center min-vh-100 text-center">
        <div class="form-container shadow-lg px-4 py-5 rounded-3">
            <h2 class="mb-4">Doctor Login</h2>
            <form action="" method="POST">
                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="fa-solid fa-envelope"></i></span>
                    <input type="email" name="email" class="form-control" placeholder="Email Address" required>
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