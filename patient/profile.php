<?php include("includes/header.php") ?>

<div class="container my-5">
    <h1><i class="fa-solid fa-user me-2"></i> My Profile</h1>
</div>
<div class="mx-5">
    <?php if (isset($_SESSION["msg"]) && $_SESSION["msg"] == true) { ?>
        <div class="alert alert-<?php echo $_SESSION["alert"] ?> alert-dismissible fade show" role="alert">
            <?php echo $_SESSION["msg"] ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php }
    $_SESSION["msg"] = false;
    ?>
</div>
<div class="card shadow mb-4 mx-5">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered py-2 mb-0">
                <tbody>
                    <tr>
                        <td>Name</td>
                        <td><?php echo $row["first_name"] . " " . $row["last_name"] ?></td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td><?php echo $row["email"] ?></td>
                    </tr>
                    <tr>
                        <td>Phone Number</td>
                        <td><?php echo $row["phone"] ?></td>
                    </tr>
                    <tr>
                        <td>Gender</td>
                        <td><?php echo $row["gender"] ?></td>
                    </tr>
                    <tr>
                        <td>Date of Birth</td>
                        <td><?php echo date("m-d-Y", strtotime($row["dob"])) ?></td>
                    </tr>
                    <tr>
                        <td>Address</td>
                        <td><?php echo $row["address"] ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include("includes/footer.php") ?>