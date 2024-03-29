<?php

include("../connection.php");
session_start();

// Add Doctor
if (isset($_POST["add-doctor"])) {
    $_SESSION["msg"] = true;

    $first_name = mysqli_real_escape_string($con, $_POST["first-name"]);
    $last_name = mysqli_real_escape_string($con, $_POST["last-name"]);
    $email = mysqli_real_escape_string($con, $_POST["email"]);
    $phone = mysqli_real_escape_string($con, $_POST["phone"]);
    $gender = mysqli_real_escape_string($con, $_POST["gender"]);
    $dob = mysqli_real_escape_string($con, $_POST["dob"]);
    $qualification = mysqli_real_escape_string($con, $_POST["qualification"]);
    $specialisation = mysqli_real_escape_string($con, $_POST["specialisation"]);
    $address = mysqli_real_escape_string($con, $_POST["address"]);

    function randomPassword()
    {
        $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
        $pass = array();
        $alphaLength = strlen($alphabet) - 1;
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass);
    }

    $password = randomPassword();

    $insert = mysqli_query($con, "INSERT INTO doctors (first_name, last_name, email, password, gender, dob, phone, address, qualification, specialisation) VALUES ('$first_name', '$last_name', '$email', '$password', '$gender', '$dob', '$phone', '$address', '$qualification', '$specialisation')");
    if ($insert) {
        $_SESSION["alert"] = "success";
        $_SESSION["msg"] = "Doctor added successfully !";

        $to = $email;
        $subject = "Registration Successful - Doctor Patient Portal";
        $message = "Dear Dr. " . $first_name . " " . $last_name . ", you have been successfully registered. These are your credentials." . "\r\n\n";
        $message .= "Email Address: " . $email . "\r\n";
        $message .= "Password: " . $password;
        $headers = "From: Faisal Ansari <xamppfaisal@gmail.com>\r\n";
        mail($to, $subject, $message, $headers);
    } else {
        $_SESSION["alert"] = "danger";
        $_SESSION["msg"] = "Sorry, Doctor could not be added !";
    }

    header("location:doctors");
}

// Update Doctor
if (isset($_POST["update-doctor"])) {
    $_SESSION["msg"] = true;

    $id = $_POST["doctor-id"];
    $first_name = mysqli_real_escape_string($con, $_POST["first-name"]);
    $last_name = mysqli_real_escape_string($con, $_POST["last-name"]);
    $email = mysqli_real_escape_string($con, $_POST["email"]);
    $phone = mysqli_real_escape_string($con, $_POST["phone"]);
    $gender = mysqli_real_escape_string($con, $_POST["gender"]);
    $dob = mysqli_real_escape_string($con, $_POST["dob"]);
    $qualification = mysqli_real_escape_string($con, $_POST["qualification"]);
    $specialisation = mysqli_real_escape_string($con, $_POST["specialisation"]);
    $address = mysqli_real_escape_string($con, $_POST["address"]);

    $update = mysqli_query($con, "UPDATE doctors SET first_name = '$first_name', last_name = '$last_name', email = '$email', phone = '$phone', gender = '$gender', dob = '$dob', qualification = '$qualification', specialisation = '$specialisation', address = '$address' WHERE doctor_id = '$id'");

    if ($update) {
        $_SESSION["alert"] = "success";
        $_SESSION["msg"] = "Doctor updated successfully !";
    } else {
        $_SESSION["alert"] = "danger";
        $_SESSION["msg"] = "Doctor could not be updated !";
    }

    header("location:doctors");
}

// Delete Doctor
if (isset($_GET["delete-doctor"])) {
    $_SESSION["msg"] = true;
    $id = $_GET["delete-doctor"];

    $delete = mysqli_query($con, "DELETE FROM doctors WHERE doctor_id = '$id'");

    if ($delete) {
        $_SESSION["alert"] = "success";
        $_SESSION["msg"] = "Doctor deleted successfully !";
    } else {
        $_SESSION["alert"] = "danger";
        $_SESSION["msg"] = "Doctor could not be deleted !";
    }
    header("location:doctors");
}

// Delete Patient
if (isset($_GET["delete-patient"])) {
    $_SESSION["msg"] = true;
    $id = $_GET["delete-patient"];

    $delete = mysqli_query($con, "DELETE FROM patients WHERE patient_id = '$id'");

    if ($delete) {
        $_SESSION["alert"] = "success";
        $_SESSION["msg"] = "Patient deleted successfully !";
    } else {
        $_SESSION["alert"] = "danger";
        $_SESSION["msg"] = "Patient could not be deleted !";
    }
    header("location:patients");
}

// Delete Appointment
if (isset($_GET["delete-appointment"])) {
    $_SESSION["msg"] = true;
    $id = $_GET["delete-appointment"];

    $delete = mysqli_query($con, "DELETE FROM appointments WHERE appointment_id = '$id'");

    if ($delete) {
        $_SESSION["alert"] = "success";
        $_SESSION["msg"] = "Appointment deleted successfully !";
    } else {
        $_SESSION["alert"] = "danger";
        $_SESSION["msg"] = "Appointment could not be deleted !";
    }
    header("location:appointments");
}

// Delete BLood Donation
if (isset($_GET["delete-blood-donation"])) {
    $_SESSION["msg"] = true;
    $id = $_GET["delete-blood-donation"];

    $delete = mysqli_query($con, "DELETE FROM blood_donation WHERE blood_donation_id = '$id'");

    if ($delete) {
        $_SESSION["alert"] = "success";
        $_SESSION["msg"] = "Blood Donation deleted successfully !";
    } else {
        $_SESSION["alert"] = "danger";
        $_SESSION["msg"] = "Blood Donation could not be deleted !";
    }
    header("location:blood-donation");
}

// Delete Organ Donation
if (isset($_GET["delete-organ-donation"])) {
    $_SESSION["msg"] = true;
    $id = $_GET["delete-organ-donation"];

    $delete = mysqli_query($con, "DELETE FROM organ_donation WHERE organ_donation_id = '$id'");

    if ($delete) {
        $_SESSION["alert"] = "success";
        $_SESSION["msg"] = "Organ Donation deleted successfully !";
    } else {
        $_SESSION["alert"] = "danger";
        $_SESSION["msg"] = "Organ Donation could not be deleted !";
    }
    header("location:organ-donation");
}

// Add Blood Bank
if (isset($_POST["add-blood"])) {
    $_SESSION["msg"] = true;

    $blood_type = mysqli_real_escape_string($con, $_POST["blood-type"]);
    $quantity = mysqli_real_escape_string($con, $_POST["quantity"]);
    $expiry_date = mysqli_real_escape_string($con, $_POST["expiry-date"]);
    $location = mysqli_real_escape_string($con, $_POST["location"]);

    $insert = mysqli_query($con, "INSERT INTO blood_bank (blood_type, quantity, expiry_date, location) VALUES ('$blood_type', '$quantity', '$expiry_date', '$location')");
    if ($insert) {
        $_SESSION["alert"] = "success";
        $_SESSION["msg"] = "Blood added successfully !";
    } else {
        $_SESSION["alert"] = "danger";
        $_SESSION["msg"] = "Sorry, Blood could not be added !";
    }

    header("location:blood-bank");
}

// Update Blood Quantity
if (isset($_POST["update-blood-quantity"])) {
    $_SESSION["msg"] = true;

    $id = $_POST["blood-bank-id"];
    $quantity = mysqli_real_escape_string($con, $_POST["quantity"]);

    $update = mysqli_query($con, "UPDATE blood_bank SET quantity = '$quantity' WHERE blood_bank_id = '$id'");

    if ($update) {
        $_SESSION["alert"] = "success";
        $_SESSION["msg"] = "Blood quantity updated successfully !";
    } else {
        $_SESSION["alert"] = "danger";
        $_SESSION["msg"] = "Blood quantity could not be updated !";
    }

    header("location:blood-bank");
}

// Delete BLood Bank
if (isset($_GET["delete-blood-bank"])) {
    $_SESSION["msg"] = true;
    $id = $_GET["delete-blood-bank"];

    $delete = mysqli_query($con, "DELETE FROM blood_bank WHERE blood_bank_id = '$id'");

    if ($delete) {
        $_SESSION["alert"] = "success";
        $_SESSION["msg"] = "Blood deleted successfully !";
    } else {
        $_SESSION["alert"] = "danger";
        $_SESSION["msg"] = "Blood could not be deleted !";
    }
    header("location:blood-bank");
}

// Add Organ Bank
if (isset($_POST["add-organ"])) {
    $_SESSION["msg"] = true;

    $organ_type = mysqli_real_escape_string($con, $_POST["organ-type"]);
    $quantity = mysqli_real_escape_string($con, $_POST["quantity"]);
    $expiry_date = mysqli_real_escape_string($con, $_POST["expiry-date"]);
    $location = mysqli_real_escape_string($con, $_POST["location"]);

    $insert = mysqli_query($con, "INSERT INTO organ_bank (organ_type, quantity, expiry_date, location) VALUES ('$organ_type', '$quantity', '$expiry_date', '$location')");
    if ($insert) {
        $_SESSION["alert"] = "success";
        $_SESSION["msg"] = "Organ added successfully !";
    } else {
        $_SESSION["alert"] = "danger";
        $_SESSION["msg"] = "Sorry, Organ could not be added !";
    }

    header("location:organ-bank");
}

// Update Organ Quantity
if (isset($_POST["update-organ-quantity"])) {
    $_SESSION["msg"] = true;

    $id = $_POST["organ-bank-id"];
    $quantity = mysqli_real_escape_string($con, $_POST["quantity"]);

    $update = mysqli_query($con, "UPDATE organ_bank SET quantity = '$quantity' WHERE organ_bank_id = '$id'");

    if ($update) {
        $_SESSION["alert"] = "success";
        $_SESSION["msg"] = "Organ quantity updated successfully !";
    } else {
        $_SESSION["alert"] = "danger";
        $_SESSION["msg"] = "Organ quantity could not be updated !";
    }

    header("location:organ-bank");
}

// Delete Organ Bank
if (isset($_GET["delete-organ-bank"])) {
    $_SESSION["msg"] = true;
    $id = $_GET["delete-organ-bank"];

    $delete = mysqli_query($con, "DELETE FROM organ_bank WHERE organ_bank_id = '$id'");

    if ($delete) {
        $_SESSION["alert"] = "success";
        $_SESSION["msg"] = "Organ deleted successfully !";
    } else {
        $_SESSION["alert"] = "danger";
        $_SESSION["msg"] = "Organ could not be deleted !";
    }
    header("location:organ-bank");
}

// Logout
if (isset($_GET["logout"])) {
    session_unset();
    session_destroy();

    header("location:login");
    exit;
}
