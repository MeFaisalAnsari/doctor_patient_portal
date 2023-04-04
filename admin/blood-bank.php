<?php include("includes/header.php") ?>

<div class="container my-5 d-flex justify-content-between align-items-center">
    <h1><i class="fa-solid fa-droplet me-2"></i> Blood Bank</h1>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addBlood">
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
        <h6 class="m-0 font-weight-bold text-primary">List of Blood Available</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered w-100 py-2 text-center" id="bloodTable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Blood Type</th>
                        <th>Quantity</th>
                        <th>Expiry Date</th>
                        <th>Location</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    $query = mysqli_query($con, "SELECT * FROM blood_bank ORDER BY expiry_date ASC");
                    while ($row = mysqli_fetch_assoc($query)) {
                    ?>
                        <tr>
                            <td><?php echo $i ?></td>
                            <td><?php echo $row["blood_type"] ?></td>
                            <td><?php echo $row["quantity"] ?> ml
                                <a href="#editQuantity<?php echo $row['blood_bank_id'] ?>" class="ms-2" data-bs-toggle="modal"><i class="fas fa-edit text-primary"></i></a>
                                <div class="modal fade" id="editQuantity<?php echo $row['blood_bank_id'] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit Blood Quantity</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form action="code.php" method="POST" enctype="multipart/form-data">
                                                <div class="modal-body text-start">
                                                    <input type="hidden" name="blood-bank-id" value="<?php echo $row['blood_bank_id'] ?>">
                                                    <label for="quantity">Enter Quantity (in ml):</label>
                                                    <input type="number" name="quantity" id="quantity" value="<?php echo $row['quantity'] ?>" class="form-control mt-3" required>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                    <button type="submit" name="update-blood-quantity" class="btn btn-primary">Update</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td><?php echo date("d-m-Y", strtotime($row["expiry_date"])) ?></td>
                            <td><?php echo $row["location"] ?></td>
                            <td>
                                <a href="#deleteBlood<?php echo $row['blood_bank_id'] ?>" data-bs-toggle="modal"><i class="fa-solid fa-trash-can text-danger"></i></a>
                                <div class="modal fade" id="deleteBlood<?php echo $row['blood_bank_id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Blood</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Do you really want to remove this from blood bank ?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                                                <a href="code.php?delete-blood-bank=<?php echo $row['blood_bank_id'] ?>" class="btn btn-danger">Yes</a>
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

<div class="modal fade" id="addBlood" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Add Blood</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="code.php" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <select class="form-control" name="blood-type" required>
                        <option value="">-- Blood Type --</option>
                        <option value="A+">A+</option>
                        <option value="A-">A-</option>
                        <option value="B+">B+</option>
                        <option value="B-">B-</option>
                        <option value="AB+">AB+</option>
                        <option value="AB-">AB-</option>
                        <option value="O+">O+</option>
                        <option value="O-">O-</option>
                    </select>
                    <input type="number" name="quantity" placeholder="Enter Quantity (in ml)" class="mt-3 form-control" required>
                    <table class="w-100 mt-3">
                        <tr>
                            <td>Expiry Date: </td>
                            <td><input type="date" name="expiry-date" class="form-control" required></td>
                        </tr>
                    </table>
                    <select class="form-control mt-3" name="location" required>
                        <option value="">-- Select Location --</option>
                        <option value="Community Hospital">Community Hospital</option>
                        <option value="Red Cross Blood Center">Red Cross Blood Center</option>
                        <option value="City Medical Center">City Medical Center</option>
                        <option value="Community Blood Drive">Community Blood Drive</option>
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" name="add-blood" class="btn btn-primary">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include("includes/footer.php") ?>