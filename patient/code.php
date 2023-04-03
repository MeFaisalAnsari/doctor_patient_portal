<?php

include("../connection.php");
session_start();

// Book Appointment
if (isset($_POST["book-appointment"])) {
    $_SESSION["msg"] = true;

    $patient_id = $_POST["patient-id"];
    $doctor_id = $_POST["doctor-id"];
    $appointment_date = mysqli_real_escape_string($con, $_POST["appointment-date"]);
    $appointment_time = mysqli_real_escape_string($con, $_POST["appointment-time"]);
    $appointment_reason = mysqli_real_escape_string($con, $_POST["appointment-reason"]);
    $appointment_status = 'scheduled';

    $insert = mysqli_query($con, "INSERT INTO appointments (patient_id, doctor_id, appointment_date, appointment_time, appointment_reason, appointment_status) VALUES ('$patient_id', '$doctor_id', '$appointment_date', '$appointment_time', '$appointment_reason', '$appointment_status')");
    if ($insert) {
        $_SESSION["alert"] = "success";
        $_SESSION["msg"] = "Appointment Scheduled successfully !";
    } else {
        $_SESSION["alert"] = "danger";
        $_SESSION["msg"] = "Sorry, Appoinment could not be scheduled !";
    }

    header("location:appointments");
}

// Donate Blood
if (isset($_POST["donate-blood"])) {
    $_SESSION["msg"] = true;

    $donor_id = $_POST["donor-id"];
    $donation_date = mysqli_real_escape_string($con, $_POST["donation-date"]);
    $blood_group = mysqli_real_escape_string($con, $_POST["blood-group"]);
    $location = mysqli_real_escape_string($con, $_POST["location"]);

    $insert = mysqli_query($con, "INSERT INTO blood_donation (donor_id, donation_date, blood_group, location) VALUES ('$donor_id', '$donation_date', '$blood_group', '$location')");
    if ($insert) {
        $_SESSION["alert"] = "success";
        $_SESSION["msg"] = "Blood donation scheduled successfully. Kindly visit the selected location to donate blood";
    } else {
        $_SESSION["alert"] = "danger";
        $_SESSION["msg"] = "Sorry, Blood donation could not be scheduled !";
    }

    header("location:blood-donation");
}

// Logout
if (isset($_GET["logout"])) {
    session_unset();
    session_destroy();

    header("location:login");
    exit;
}
