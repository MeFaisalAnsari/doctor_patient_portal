<?php include("includes/header.php") ?>

<div class="container my-5">
    <h1><i class="fa-solid fa-lungs me-2"></i> Organ Bank</h1>
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
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    $query = mysqli_query($con, "SELECT * FROM organ_bank");
                    while ($row = mysqli_fetch_assoc($query)) {
                    ?>
                        <tr>
                            <td><?php echo $i ?></td>
                            <td><?php echo $row["organ_type"] ?></td>
                            <td><?php echo $row["quantity"] ?></td>
                            <td><?php echo date("d-m-Y", strtotime($row["expiry_date"])) ?></td>
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

<?php include("includes/footer.php") ?>