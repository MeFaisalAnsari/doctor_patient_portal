<?php include("includes/header.php") ?>

<div class="container my-5 d-flex justify-content-between align-items-center">
    <h1><i class="fa-solid fa-hand-holding-droplet me-2"></i> Blood Donation</h1>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#donateBlood">
        Donate <i class="fa-solid fa-heart ms-2"></i>
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
        <h6 class="m-0 font-weight-bold text-primary">Your Blood Donation List</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered w-100 py-2 text-center">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Date</th>
                        <th>Location</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    $query = mysqli_query($con, "SELECT * FROM blood_donation WHERE donor_id = '$patient_id' ORDER BY donation_date DESC");
                    while ($row = mysqli_fetch_assoc($query)) {
                    ?>
                        <tr>
                            <td><?php echo $i ?></td>
                            <td><?php echo date("d-m-Y", strtotime($row["donation_date"])) ?></td>
                            <td><?php echo $row["location"] ?></td>
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

<div class="modal fade" id="donateBlood" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Donate Blood</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="code.php" method="POST">
                <div class="modal-body">
                    <input type="hidden" name="donor-id" value="<?php echo $patient_id ?>">
                    <table class="w-100">
                        <tr>
                            <td>Select Date : </td>
                            <td><input type="date" name="donation-date" class="form-control" required></td>
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
                    <button type="submit" name="donate-blood" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include("includes/footer.php") ?>