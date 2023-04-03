<?php include("includes/header.php") ?>
<?php
$query = mysqli_query($con, "SELECT * FROM appointments WHERE doctor_id = '$doctor_id' AND appointment_status = 'completed'");
$appointments_completed = mysqli_num_rows($query);

$query = mysqli_query($con, "SELECT * FROM appointments WHERE doctor_id = '$doctor_id' AND appointment_status = 'scheduled'");
$appointments_scheduled = mysqli_num_rows($query);
?>

<div class="container my-5">
    <h1><i class="fa-solid fa-dashboard me-2"></i> Dashboard</h1>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-4 col-12">
            <div class="shadow rounded-4 border-start border-5 border-success p-4">
                <h5 class="text-uppercase">Patients Checked</h5>
                <div class="d-flex justify-content-between">
                    <span class="fs-1 text-success"><?php echo $appointments_completed ?></span>
                    <i class="fa-solid fa-user fa-3x text-dark text-opacity-25"></i>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-12">
            <div class="shadow rounded-4 border-start border-5 border-warning p-4">
                <h5 class="text-uppercase">Scheduled Appointments</h5>
                <div class="d-flex justify-content-between">
                    <span class="fs-1 text-warning"><?php echo $appointments_scheduled ?></span>
                    <i class="fa-solid fa-calendar-days fa-3x text-dark text-opacity-25"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include("includes/footer.php") ?>