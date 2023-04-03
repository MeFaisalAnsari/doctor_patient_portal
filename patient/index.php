<?php include("includes/header.php") ?>
<?php
$query = mysqli_query($con, "SELECT * FROM appointments WHERE patient_id = '$patient_id'");
$appointments_booked = mysqli_num_rows($query);

$query = mysqli_query($con, "SELECT * FROM medical_history WHERE patient_id = '$patient_id'");
$medical_history = mysqli_num_rows($query);

?>

<div class="container my-5">
    <h1><i class="fa-solid fa-dashboard me-2"></i> Dashboard</h1>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-4 col-12">
            <div class="shadow rounded-4 border-start border-5 border-primary p-4">
                <h5 class="text-uppercase">Appointments Booked</h5>
                <div class="d-flex justify-content-between">
                    <span class="fs-1 text-primary"><?php echo $appointments_booked ?></span>
                    <i class="fa-solid fa-calendar-days fa-3x text-dark text-opacity-25"></i>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-12">
            <div class="shadow rounded-4 border-start border-5 border-primary p-4">
                <h5 class="text-uppercase">Medical History</h5>
                <div class="d-flex justify-content-between">
                    <span class="fs-1 text-primary"><?php echo $medical_history ?></span>
                    <i class="fa-solid fa-clock-rotate-left fa-3x text-dark text-opacity-25"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include("includes/footer.php") ?>