<?php

include("../connection.php");
session_start();

// Complete Appointment
if (isset($_POST["complete-appointment"])) {
    $_SESSION["msg"] = true;

    $appointment_id = $_POST["appointment-id"];
    $patient_id = $_POST["patient-id"];
    $diagnosis_date = mysqli_real_escape_string($con, $_POST["diagnosis-date"]);
    $medical_condition = mysqli_real_escape_string($con, $_POST["medical-condition"]);
    $treatment = mysqli_real_escape_string($con, $_POST["treatment"]);
    $medication = mysqli_real_escape_string($con, $_POST["medication"]);
    $notes = mysqli_real_escape_string($con, $_POST["notes"]);

    $update = mysqli_query($con, "UPDATE appointments SET appointment_status = 'completed' WHERE appointment_id = '$appointment_id'");

    if ($update) {
        $insert = mysqli_query($con, "INSERT INTO medical_history (patient_id, medical_condition, diagnosis_date, treatment, medication, notes) VALUES ('$patient_id', '$medical_condition', '$diagnosis_date', '$treatment', '$medication', '$notes')");
        if ($insert) {
            $_SESSION["alert"] = "success";
            $_SESSION["msg"] = "Appointment completed successfully !";
        }
    } else {
        $_SESSION["alert"] = "danger";
        $_SESSION["msg"] = "Appointment could not be completed !";
    }

    header("location:appointments");
}

// Cancel Appointment
if (isset($_GET["cancel-appointment"])) {
    $_SESSION["msg"] = true;
    $id = $_GET["cancel-appointment"];
    $patient_id = $_GET["patient-id"];
    $doctor_name = $_GET["doctor"];

    $update = mysqli_query($con, "UPDATE appointments SET appointment_status = 'cancelled' WHERE appointment_id = '$id'");

    if ($update) {
        $_SESSION["alert"] = "success";
        $_SESSION["msg"] = "Appointment cancelled successfully !";

        $select = mysqli_query($con, "SELECT * FROM patients WHERE patient_id = '$patient_id'");
        $row = mysqli_fetch_assoc($select);

        $patient_name = $row["first_name"] . " " . $row["last_name"];
        $patient_email = $row["email"];

        $to = $patient_email;
        $subject = "Appointment Cancelled - Doctor Patient Portal";
        $message = "Dear " . $patient_name . ", your appointment with Dr. " . $doctor_name . " is cancelled due to some reason, please try to book again." . "\r\n\n";
        $headers = "From: Faisal Ansari <xamppfaisal@gmail.com>\r\n";
        mail($to, $subject, $message, $headers);
    } else {
        $_SESSION["alert"] = "danger";
        $_SESSION["msg"] = "Appointment could not be cancellled !";
    }
    header("location:appointments");
}

// Logout
if (isset($_GET["logout"])) {
    session_unset();
    session_destroy();

    header("location:login");
    exit;
}
