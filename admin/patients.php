<?php include("includes/header.php") ?>

<div class="container my-5 d-flex justify-content-between align-items-center">
    <h1><i class="fa-solid fa-user me-2"></i> Patients</h1>
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
        <h6 class="m-0 font-weight-bold text-primary">List of all Patients</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered w-100 py-2 text-center" id="patientTable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Mobile No.</th>
                        <th>Gender</th>
                        <th>Age</th>
                        <th>Address</th>
                        <th>History</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    $query = mysqli_query($con, "SELECT * FROM patients ORDER BY patient_id DESC");
                    while ($row = mysqli_fetch_assoc($query)) {
                        $patient_id = $row["patient_id"];
                        $dob = $row["dob"];
                        $age = (date("Y") - date("Y", strtotime($dob)));
                    ?>
                        <tr>
                            <td><?php echo $i ?></td>
                            <td class="text-nowrap"><?php echo $row["first_name"] . " " . $row["last_name"] ?></td>
                            <td><?php echo $row["email"] ?></td>
                            <td><?php echo $row["phone"] ?></td>
                            <td class="text-capitalize"><?php echo $row["gender"] ?></td>
                            <td><?php echo $age ?></td>
                            <td><?php echo $row["address"] ?></td>
                            <td><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#medicalHistory<?php echo $row['patient_id'] ?>">
                                    View
                                </button>
                                <div class="modal fade" id="medicalHistory<?php echo $row['patient_id'] ?>">
                                    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="staticBackdropLabel">Medical History of <?php echo $row["first_name"] . " " . $row["last_name"] ?></h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <?php
                                                $j = 1;
                                                $medical_history = mysqli_query($con, "SELECT * FROM medical_history WHERE patient_id  = $patient_id ORDER BY diagnosis_date DESC");
                                                $count = mysqli_num_rows($medical_history);
                                                if ($count > 0) {
                                                    while ($row = mysqli_fetch_assoc($medical_history)) {
                                                ?>
                                                        <table class="table table-bordered text-start mb-4">
                                                            <tr class="bg-light">
                                                                <th colspan="2"><i class="fa-solid fa-calendar-days me-2"></i> <?php echo  date("d-m-Y", strtotime($row["diagnosis_date"])) ?></th>
                                                            </tr>
                                                            <tr>
                                                                <td>Medical Condition</td>
                                                                <td><?php echo $row["medical_condition"] ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Treatment</td>
                                                                <td><?php echo $row["treatment"] ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Medication</td>
                                                                <td><?php echo $row["medication"] ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Notes</td>
                                                                <td><?php echo $row["notes"] ?></td>
                                                            </tr>
                                                        </table>
                                                <?php
                                                        $j++;
                                                    }
                                                } else {
                                                    echo "<h4 class='my-3 text-black-50'>No Previous Medical History</h4>";
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </td>
                            <td>
                                <a href="#deletePatient<?php echo $row['patient_id'] ?>" data-bs-toggle="modal"><i class="fa-solid fa-trash-can text-danger"></i></a>
                                <div class="modal fade" id="deletePatient<?php echo $row['patient_id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Patient</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p><?php echo $row["first_name"] . " " . $row["last_name"] ?> will be deleted permenently!</p>
                                                <p>Are you sure ?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                                                <a href="code.php?delete-patient=<?php echo $row['patient_id'] ?>" class="btn btn-danger">Yes</a>
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