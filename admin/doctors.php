<?php include("includes/header.php") ?>
<?php
// $_SESSION["msg"] = true;
// $_SESSION["alert"] = "danger";
// $_SESSION["msg"] = "this is alert message";
?>

<div class="container my-5 d-flex justify-content-between align-items-center">
    <h1><i class="fa-solid fa-user-doctor me-2"></i> Doctors</h1>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addDoctor">
        Add New <i class="fa-solid fa-plus ms-2"></i>
    </button>
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
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">List of all Doctors</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered w-100 py-2 text-center" id="doctorTable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Mobile No.</th>
                        <th>Gender</th>
                        <th>Age</th>
                        <th>Qualifaction</th>
                        <th>Specialisation</th>
                        <th>Address</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    $query = mysqli_query($con, "SELECT * FROM doctors WHERE status = '1' ORDER BY doctor_id DESC");
                    while ($row = mysqli_fetch_assoc($query)) {
                        $dob = $row["dob"];
                        $age = (date("Y") - date("Y", strtotime($dob)));
                    ?>
                        <tr>
                            <td><?php echo $i ?></td>
                            <td class="text-nowrap">Dr. <?php echo $row["first_name"] . " " . $row["last_name"] ?></td>
                            <td><?php echo $row["email"] ?></td>
                            <td><?php echo $row["phone"] ?></td>
                            <td class="text-capitalize"><?php echo $row["gender"] ?></td>
                            <td><?php echo $age ?></td>
                            <td><?php echo $row["qualification"] ?></td>
                            <td><?php echo $row["specialisation"] ?></td>
                            <td><?php echo $row["address"] ?></td>
                            <td>
                                <a href="#editDoctor<?php echo $row['doctor_id'] ?>" data-bs-toggle="modal"><i class="fas fa-edit text-primary"></i></a>
                                <div class="modal fade" id="editDoctor<?php echo $row['doctor_id'] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit Doctor</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form action="code.php" method="POST" enctype="multipart/form-data">
                                                <div class="modal-body">
                                                    <input type="hidden" name="doctor-id" value="<?php echo $row['doctor_id'] ?>">
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
                                                    <div class="d-flex align-items-center mt-2" style="gap:10px">
                                                        <label class="m-0">D.O.B.</label>
                                                        <input type="date" name="dob" placeholder="D.O.B." value="<?php echo $row['dob'] ?>" class="form-control" required>
                                                    </div>
                                                    <input type="text" name="qualification" placeholder="Qualification" value="<?php echo $row['qualification'] ?>" class="form-control mt-3" required>
                                                    <input type="text" name="specialisation" placeholder="Specialisation" value="<?php echo $row['specialisation'] ?>" class="form-control mt-3" required>
                                                    <textarea name="address" class="form-control mt-3" placeholder="Address" required><?php echo $row['address'] ?></textarea>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                    <button type="submit" name="update-doctor" class="btn btn-primary">Update</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <a href="#deleteDoctor<?php echo $row['doctor_id'] ?>" data-bs-toggle="modal"><i class="fa-solid fa-trash-can text-danger"></i></a>
                                <div class="modal fade" id="deleteDoctor<?php echo $row['doctor_id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Doctor</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Dr. <?php echo $row["first_name"] . " " . $row["last_name"] ?> will be deleted permenently!</p>
                                                <p>Are you sure ?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                                                <a href="code.php?delete-doctor=<?php echo $row['doctor_id'] ?>" class="btn btn-danger">Yes</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    <?php
                        $i++;
                    }
                    ?>
                </tbody>
            </table>

        </div>
    </div>
</div>

<!-- <div class="card shadow mb-4 my-5 mx-5">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Doctors pending for Approval</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered w-100 py-2 text-center">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Action</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Mobile No.</th>
                        <th>Gender</th>
                        <th>Age</th>
                        <th>Qualifaction</th>
                        <th>Specialisation</th>
                        <th>Address</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    $query = mysqli_query($con, "SELECT * FROM doctors WHERE status = '0' ORDER BY doctor_id DESC");
                    while ($row = mysqli_fetch_assoc($query)) {
                        $dob = $row["dob"];
                        $age = (date("Y") - date("Y", strtotime($dob)));
                    ?>
                        <tr>
                            <td><?php echo $i ?></td>
                            <td class="d-flex flex-column" style="gap: 10px"><a href="code.php?approve-doctor=<?php echo $row['doctor_id'] ?>" class="btn btn-success">Approve</a> <a href="code.php?reject-doctor=<?php echo $row['doctor_id'] ?>" class="btn btn-danger">Reject</a></td>
                            <td class="text-nowrap">Dr. <?php echo $row["first_name"] . " " . $row["last_name"] ?></td>
                            <td><?php echo $row["email"] ?></td>
                            <td><?php echo $row["phone"] ?></td>
                            <td class="text-capitalize"><?php echo $row["gender"] ?></td>
                            <td><?php echo $age ?></td>
                            <td><?php echo $row["qualification"] ?></td>
                            <td><?php echo $row["specialisation"] ?></td>
                            <td><?php echo $row["address"] ?></td>
                        </tr>
                    <?php
                        $i++;
                    }
                    ?>
                </tbody>
            </table>

        </div>
    </div>
</div> -->
<div class="modal fade" id="addDoctor" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Add New Doctor</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="code.php" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <input type="text" name="first-name" placeholder="First Name" class="form-control" required>
                        </div>
                        <div class="col">
                            <input type="text" name="last-name" placeholder="Last Name" class="form-control" required>
                        </div>
                    </div>
                    <input type="email" name="email" placeholder="Email Address" class="form-control mt-3" required>
                    <input type="number" name="phone" placeholder="Mobile Number" class="form-control mt-3" required>
                    <div class="mt-3">
                        Gender: &nbsp;
                        <input type="radio" name="gender" value="male" id="male" required> <label for="male">Male</label> &nbsp;
                        <input type="radio" name="gender" value="female" id="female"> <label for="female">Female</label>
                    </div>
                    <div class="d-flex align-items-center mt-2" style="gap:10px">
                        <label class="m-0">D.O.B.</label>
                        <input type="date" name="dob" placeholder="D.O.B." class="form-control" required>
                    </div>
                    <input type="text" name="qualification" placeholder="Qualification" class="form-control mt-3" required>
                    <input type="text" name="specialisation" placeholder="Specialisation" class="form-control mt-3" required>
                    <textarea name="address" class="form-control mt-3" placeholder="Address" required></textarea>
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" name="add-doctor" class="btn btn-primary">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include("includes/footer.php") ?>