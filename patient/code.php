<?php

include("../connection.php");
session_start();

// Signup
if (isset($_POST["signup"])) {
    $_SESSION["msg"] = true;

    $first_name = mysqli_real_escape_string($con, $_POST["first-name"]);
    $last_name = mysqli_real_escape_string($con, $_POST["last-name"]);
    $email = mysqli_real_escape_string($con, $_POST["email"]);
    $phone = mysqli_real_escape_string($con, $_POST["phone"]);
    $dob = mysqli_real_escape_string($con, $_POST["dob"]);
    $gender = mysqli_real_escape_string($con, $_POST["gender"]);
    $address = mysqli_real_escape_string($con, $_POST["address"]);
    $password = mysqli_real_escape_string($con, $_POST["password"]);

    $select  = mysqli_query($con, "SELECT * FROM patients WHERE email = '$email'");
    $count = mysqli_num_rows($select);

    if ($count > 0) {
        $_SESSION["alert"] = "warning";
        $_SESSION["msg"] = "Email already exist! Please <a href='login'>login</a> to continue";
        header("location:signup");
        exit;
    } else {
        $insert = mysqli_query($con, "INSERT INTO patients (first_name, last_name, email, password, dob, gender, phone, address) VALUES ('$first_name', '$last_name', '$email', '$password', '$dob', '$gender', '$phone', '$address')");
        if ($insert) {
            $_SESSION["alert"] = "success";
            $_SESSION["msg"] = "Account created successfully !";
            header("location:login");
            exit;
        } else {
            $_SESSION["alert"] = "danger";
            $_SESSION["msg"] = "Sorry, something went wrong !";
            header("location:signup");
            exit;
        }
    }
}

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
    $location = mysqli_real_escape_string($con, $_POST["location"]);

    $insert = mysqli_query($con, "INSERT INTO blood_donation (donor_id, donation_date, location) VALUES ('$donor_id', '$donation_date', '$location')");
    if ($insert) {
        $_SESSION["alert"] = "success";
        $_SESSION["msg"] = "Blood donation scheduled successfully. Kindly visit " . $location . " on " . date("d-m-Y", strtotime($donation_date)) . " to donate blood";
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
