<?php include("includes/header.php") ?>

<div class="container my-5 d-flex justify-content-between align-items-center">
    <h1><i class="fa-solid fa-hand-holding-medical me-2"></i> Organ Donation</h1>
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
        <h6 class="m-0 font-weight-bold text-primary">List of All Donors</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered w-100 py-2 text-center" id="organTable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Donor Name</th>
                        <th>Organ Type</th>
                        <th>Date</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    $query = mysqli_query($con, "SELECT organ_donation.*, patients.first_name, patients.last_name FROM organ_donation JOIN patients ON organ_donation.donor_id = patients.patient_id ORDER BY donation_date DESC");
                    while ($row = mysqli_fetch_assoc($query)) {
                    ?>
                        <tr>
                            <td><?php echo $i ?></td>
                            <td><?php echo $row["first_name"] . " " . $row["last_name"] ?></td>
                            <td><?php echo $row["organ_type"] ?></td>
                            <td><?php echo date("d-m-Y", strtotime($row["donation_date"])) ?></td>
                            <td>
                                <a href="#deleteOrganDonation<?php echo $row['organ_donation_id'] ?>" data-bs-toggle="modal"><i class="fa-solid fa-trash-can text-danger"></i></a>
                                <div class="modal fade" id="deleteOrganDonation<?php echo $row['organ_donation_id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Organ Donation</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>This entry of <?php echo $row["first_name"] . " " . $row["last_name"] ?> will be deleted permenently!</p>
                                                <p>Are you sure ?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                                                <a href="code.php?delete-organ-donation=<?php echo $row['organ_donation_id'] ?>" class="btn btn-danger">Yes</a>
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

<?php include("includes/footer.php") ?>