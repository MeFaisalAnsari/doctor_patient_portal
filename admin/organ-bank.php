<?php include("includes/header.php") ?>

<div class="container my-5 d-flex justify-content-between align-items-center">
    <h1><i class="fa-solid fa-lungs me-2"></i> Organ Bank</h1>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addOrgan">
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
        <h6 class="m-0 font-weight-bold text-primary">List of Organs Available</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered w-100 py-2 text-center" id="organTable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Organ Type</th>
                        <th>Quantity</th>
                        <th>Expiry Date</th>
                        <th>Location</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    $query = mysqli_query($con, "SELECT * FROM organ_bank ORDER BY expiry_date ASC");
                    while ($row = mysqli_fetch_assoc($query)) {
                    ?>
                        <tr>
                            <td><?php echo $i ?></td>
                            <td><?php echo $row["organ_type"] ?></td>
                            <td><?php echo $row["quantity"] ?>
                                <a href="#editQuantity<?php echo $row['organ_bank_id'] ?>" class="ms-2" data-bs-toggle="modal"><i class="fas fa-edit text-primary"></i></a>
                                <div class="modal fade" id="editQuantity<?php echo $row['organ_bank_id'] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit Organ Quantity</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form action="code.php" method="POST" enctype="multipart/form-data">
                                                <div class="modal-body text-start">
                                                    <input type="hidden" name="organ-bank-id" value="<?php echo $row['organ_bank_id'] ?>">
                                                    <label for="quantity">Enter Quantity:</label>
                                                    <input type="number" name="quantity" id="quantity" value="<?php echo $row['quantity'] ?>" class="form-control mt-3" required>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                    <button type="submit" name="update-organ-quantity" class="btn btn-primary">Update</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td><?php echo date("d-m-Y", strtotime($row["expiry_date"])) ?></td>
                            <td><?php echo $row["location"] ?></td>
                            <td>
                                <a href="#deleteOrgan<?php echo $row['organ_bank_id'] ?>" data-bs-toggle="modal"><i class="fa-solid fa-trash-can text-danger"></i></a>
                                <div class="modal fade" id="deleteOrgan<?php echo $row['organ_bank_id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Organ</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Do you really want to remove this from organ bank ?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                                                <a href="code.php?delete-organ-bank=<?php echo $row['organ_bank_id'] ?>" class="btn btn-danger">Yes</a>
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

<div class="modal fade" id="addOrgan" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Add Organ</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="code.php" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <select class="form-control" name="organ-type" required>
                        <option value="">-- Organ Type --</option>
                        <option value="Kidney">Kidney</option>
                        <option value="Heart">Heart</option>
                        <option value="Liver">Liver</option>
                        <option value="Lungs">Lungs</option>
                        <option value="Pancreas">Pancreas</option>
                        <option value="Intestine">Intestine</option>
                    </select>
                    <input type="number" name="quantity" placeholder="Enter Quantity" class="mt-3 form-control" required>
                    <table class="w-100 mt-3">
                        <tr>
                            <td>Expiry Date: </td>
                            <td><input type="date" name="expiry-date" class="form-control" required></td>
                        </tr>
                    </table>
                    <select class="form-control mt-3" name="location" required>
                        <option value="">-- Select Location --</option>
                        <option value="Community Hospital">Community Hospital</option>
                        <option value="Red Cross Organ Center">Red Cross Organ Center</option>
                        <option value="City Medical Center">City Medical Center</option>
                        <option value="Community Organ Drive">Community Organ Drive</option>
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" name="add-organ" class="btn btn-primary">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include("includes/footer.php") ?>