<?php include("includes/header.php") ?>
<?php
$query = mysqli_query($con, "SELECT * FROM patients");
$patient_count = mysqli_num_rows($query);

$query = mysqli_query($con, "SELECT * FROM doctors");
$doctor_count = mysqli_num_rows($query);

$query = mysqli_query($con, "SELECT * FROM appointments");
$appointment_count = mysqli_num_rows($query);

$query = mysqli_query($con, "SELECT * FROM blood_donation");
$blood_donation_count = mysqli_num_rows($query);

$query = mysqli_query($con, "SELECT * FROM organ_donation");
$organ_donation_count = mysqli_num_rows($query);
?>

<div class="container my-5">
    <h1><i class="fa-solid fa-dashboard me-2"></i> Dashboard</h1>
</div>
<div class="container mb-5">
    <div class="row">
        <div class="col-md-4 col-12">
            <div class="shadow rounded-4 border-start border-5 border-primary p-4">
                <h5 class="text-uppercase">Number of Doctors</h5>
                <div class="d-flex justify-content-between">
                    <span class="fs-1 text-primary"><?php echo $doctor_count ?></span>
                    <i class="fa-solid fa-user-doctor fa-3x text-dark text-opacity-25"></i>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-12">
            <div class="shadow rounded-4 border-start border-5 border-primary p-4">
                <h5 class="text-uppercase">Number of Patients</h5>
                <div class="d-flex justify-content-between">
                    <span class="fs-1 text-primary"><?php echo $patient_count ?></span>
                    <i class="fa-solid fa-user fa-3x text-dark text-opacity-25"></i>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-12">
            <div class="shadow rounded-4 border-start border-5 border-primary p-4">
                <h5 class="text-uppercase">Appointments Booked</h5>
                <div class="d-flex justify-content-between">
                    <span class="fs-1 text-primary"><?php echo $appointment_count ?></span>
                    <i class="fa-solid fa-calendar-days fa-3x text-dark text-opacity-25"></i>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-12 mt-4">
            <div class="shadow rounded-4 border-start border-5 border-primary p-4">
                <h5 class="text-uppercase">Blood Donations</h5>
                <div class="d-flex justify-content-between">
                    <span class="fs-1 text-primary"><?php echo $blood_donation_count ?></span>
                    <i class="fa-solid fa-hand-holding-droplet fa-3x text-dark text-opacity-25"></i>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-12 mt-4">
            <div class="shadow rounded-4 border-start border-5 border-primary p-4">
                <h5 class="text-uppercase">Organ Donations</h5>
                <div class="d-flex justify-content-between">
                    <span class="fs-1 text-primary"><?php echo $organ_donation_count ?></span>
                    <i class="fa-solid fa-hand-holding-medical fa-3x text-dark text-opacity-25"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include("includes/footer.php") ?>