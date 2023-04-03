<?php include("includes/header.php") ?>

<div class="container my-5 d-flex justify-content-between align-items-center">
    <h1><i class="fa-solid fa-user me-2"></i> My Profile</h1>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editProfile">
        Edit <i class="fa-solid fa-pencil ms-2"></i>
    </button>
</div>
<div class="modal fade" id="editProfile" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit Profile</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="code.php" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <input type="hidden" name="patient-id" value="<?php echo $row['patient_id'] ?>">
                    <div class="row">
                        <div class="col">
                            <input type="text" name="first-name" placeholder="First Name" value="<?php echo $row['first_name'] ?>" class="form-control" required>
                        </div>
                        <div class="col">
                            <input type="text" name="last-name" placeholder="Last Name" value="<?php echo $row['last_name'] ?>" class="form-control" required>
                        </div>
                    </div>
                    <input type="email" name="email" placeholder="Email Address" value="<?php echo $row['email'] ?>" class="form-control mt-3" required>
                    <input type="number" name="phone" placeholder="Mobile Number" value="<?php echo $row['phone'] ?>" class="form-control mt-3" required>
                    <div class="mt-3 text-start">
                        Gender: &nbsp;
                        <?php
                        $gender = $row["gender"];
                        if ($gender == "male") {
                        ?>
                            <input type="radio" name="gender" value="male" id="male" checked required> <label for="male">Male</label> &nbsp;
                            <input type="radio" name="gender" value="female" id="female"> <label for="female">Female</label>
                        <?php
                        } else {
                        ?>
                            <input type="radio" name="gender" value="male" id="male" required> <label for="male">Male</label> &nbsp;
                            <input type="radio" name="gender" value="female" id="female" checked required> <label for="female">Female</label>
                        <?php } ?>
                    </div>
                    <div class="d-flex align-items-center mt-3" style="gap:10px">
                        <label class="m-0">D.O.B.</label>
                        <input type="date" name="dob" placeholder="D.O.B." value="<?php echo $row['dob'] ?>" class="form-control" required>
                    </div>
                    <textarea name="address" class="form-control mt-3" placeholder="Address" required><?php echo $row['address'] ?></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" name="update-patient" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
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
                        <td class="text-capitalize"><?php echo $row["gender"] ?></td>
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