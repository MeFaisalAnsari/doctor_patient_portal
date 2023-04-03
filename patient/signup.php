<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Signup - Doctor Patient Portal</title>
    <link rel="stylesheet" href="../vendor/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="../vendor/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="../style.css">
</head>

<body>
    <div class="mx-5 mt-5">
        <?php if (isset($_SESSION["msg"]) && $_SESSION["msg"] == true) { ?>
            <div class="alert alert-<?php echo $_SESSION["alert"] ?> alert-dismissible fade show" role="alert">
                <?php echo $_SESSION["msg"] ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php }
        $_SESSION["msg"] = false;
        ?>
    </div>
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="form-container shadow border mb-5 px-4 pt-5 pb-3 rounded-3">
            <h2 class="mb-4 text-center">Patient Registration</h2>
            <form action="code.php" method="POST">
                <div class="row">
                    <div class="col">
                        <input type="text" name="first-name" class="form-control" placeholder="First Name" required>
                    </div>
                    <div class="col">
                        <input type="text" name="last-name" class="form-control" placeholder="Last Name" required>
                    </div>
                </div>
                <input type="email" name="email" class="form-control mt-3" placeholder="Email Address" required>
                <div class="mt-3">
                    Gender: &nbsp;
                    <input type="radio" name="gender" value="male" id="male" required> <label for="male">Male</label> &nbsp;
                    <input type="radio" name="gender" value="female" id="female"> <label for="female">Female</label>
                </div>
                <div class="d-flex align-items-center mt-3" style="gap:10px">
                    <label class="m-0">D.O.B.</label>
                    <input type="date" name="dob" placeholder="D.O.B." class="form-control" required>
                </div>
                <input type="number" name="phone" class="form-control mt-3" placeholder="Phone Number" required>
                <textarea name="address" class="form-control mt-3" placeholder="Address" required></textarea>
                <input type="password" name="password" class="form-control mt-3" placeholder="Create Password" required>
                <button type="submit" name="signup" class="btn btn-primary w-100 mt-3">Register</button>
            </form>
            <p class="mt-3 text-center">Already have an account? <a href="login">Login</a></p>
        </div>
    </div>
    <script src="../vendor/bootstrap/bootstrap.bundle.min.js"></script>
</body>

</html>