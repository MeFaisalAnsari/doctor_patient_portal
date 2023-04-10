<?php
include("../connection.php");

session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true || $_SESSION["user"] != "patient") {
    header("location:login");
    exit;
}

$patient_id = $_SESSION["patient_id"];
$query = mysqli_query($con, "SELECT * FROM patients WHERE patient_id = '$patient_id'");
$row = mysqli_fetch_assoc($query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $row["first_name"] . " " . $row["last_name"] ?> - Doctor Patient Portal</title>
    <link rel="stylesheet" href="../vendor/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="../vendor/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="../vendor/datatables/dataTables.bootstrap5.min.css">
    <link rel="shortcut icon" href="../img/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="../admin-panel.css">
</head>

<body>
    <header class="text-center border-bottom border-3 border-dark bg-primary bg-gradient text-white py-3">
        <h1 class="my-4">Doctor Patient Portal</h1>
        <ul class="nav d-flex justify-content-center gap-3">
            <li><a class="btn btn-light" href="./"><i class="fa-solid fa-dashboard me-2"></i> Dashboard</a></li>
            <li><a class="btn btn-light" href="appointments"><i class="fa-solid fa-calendar-days me-2"></i>
                    Book Appointment</a>
            </li>
            <li><a class="btn btn-light" href="medical-history"><i class="fa-solid fa-clock-rotate-left me-2"></i>
                    Medical History</a>
            </li>
            <li><a class="btn btn-light" href="blood-donation"><i class="fa-solid fa-hand-holding-droplet me-2"></i>
                    Donate Blood</a>
            </li>
            <li><a class="btn btn-light" href="organ-donation"><i class="fa-solid fa-hand-holding-medical me-2"></i>
                    Donate Organ</a>
            </li>
        </ul>
    </header>
    <div class="bg-primary-subtle py-2 px-4 d-flex justify-content-between align-items-center border-bottom border-3 border-dark shadow">
        <h3 class="m-0">Welcome <?php echo $row["first_name"] . " " . $row["last_name"] ?></h3>
        <div>
            <a href="profile" class="btn btn-primary">Profile <i class="fa-solid fa-user ms-1"></i></a>
            <a href="#logoutModal" data-bs-toggle="modal" class="btn btn-danger">Logout <i class="fa-solid fa-power-off"></i></a>
        </div>
    </div>

    <div class="modal fade" id="logoutModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Logout</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Do you really want to logout ?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                    <a class="btn btn-primary" href="code.php?logout">Yes</a>
                </div>
            </div>
        </div>
    </div>