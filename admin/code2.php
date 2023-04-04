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