<?php include("includes/header.php") ?>

<div class="container my-5 d-flex justify-content-between align-items-center">
    <h1><i class="fa-solid fa-calendar-days me-2"></i> Appointments</h1>
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
        <h6 class="m-0 font-weight-bold text-primary">List of Scheduled Appointments</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered w-100 py-2 text-center" id="scheduledAppointmentsTable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Patient</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Reason</th>
                        <th>Medical History</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    $query = mysqli_query($con, "SELECT appointments.*, patients.patient_id, patients.first_name, patients.last_name FROM appointments JOIN patients ON appointments.patient_id = patients.patient_id WHERE appointment_status = 'scheduled' AND doctor_id = '$doctor_id' ORDER BY appointment_id DESC");
                    while ($row = mysqli_fetch_assoc($query)) {
                        $patient_id = $row["patient_id"];
                        $appointment_id = $row["appointment_id"];
                        $patient_name = $row["first_name"] . " " . $row["last_name"];
                    ?>
                        <tr>
                            <td><?php echo $i ?></td>
                            <td><?php echo $row["first_name"] . " " . $row["last_name"] ?></td>
                            <td><?php echo date("d-m-Y", strtotime($row["appointment_date"])) ?></td>
                            <td><?php echo date("H:i", strtotime($row["appointment_time"])) ?></td>
                            <td><?php echo $row["appointment_reason"] ?></td>
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
                            <td><a href="#completeAppointment<?php echo $appointment_id ?>" data-bs-toggle="modal" class="btn btn-success">Complete</a> <a href="#cancelAppointment<?php echo $appointment_id ?>" data-bs-toggle="modal" class="btn btn-danger">Cancel</a></td>
                            <div class="modal fade" id="completeAppointment<?php echo $appointment_id ?>" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5">Change Appointment Status</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="code.php" method="POST">
                                            <div class="modal-body">
                                                <input type="hidden" name="appointment-id" value="<?php echo $appointment_id ?>">
                                                <input type="hidden" name="patient-id" value="<?php echo $patient_id ?>">
                                                <input type="date" name="diagnosis-date" class="form-control" value="<?php echo date("Y-m-d") ?>" required>
                                                <input type="text" name="medical-condition" placeholder="Medical Condition" class="form-control mt-3" required>
                                                <input type="text" name="treatment" placeholder="Treatment" class="form-control mt-3" required>
                                                <input type="text" name="medication" placeholder="Medication" class="form-control mt-3" required>
                                                <textarea name="notes" class="form-control mt-3" placeholder="Notes" required></textarea>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" name="complete-appointment" class="btn btn-success">Mark as Complete</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="modal fade" id="cancelAppointment<?php echo $appointment_id ?>" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5">Change Appointment Status</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p class="text-center">Do you really want to cancel your appointment with <?php echo $patient_name ?> ?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                                            <a href="code.php?cancel-appointment=<?php echo $appointment_id ?>" class="btn btn-danger">Yes</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
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

<div class="card shadow mb-4 mx-5">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">List of all Completed Appointments</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered w-100 py-2 text-center" id="completedAppointmentsTable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Patient</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Reason</th>
                        <th>Medical History</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    $query = mysqli_query($con, "SELECT appointments.*, patients.patient_id, patients.first_name, patients.last_name FROM appointments JOIN patients ON appointments.patient_id = patients.patient_id WHERE appointment_status = 'completed' AND doctor_id = '$doctor_id' ORDER BY appointment_id DESC");
                    while ($row = mysqli_fetch_assoc($query)) {
                        $patient_id = $row["patient_id"];
                    ?>
                        <tr>
                            <td><?php echo $i ?></td>
                            <td><?php echo $row["first_name"] . " " . $row["last_name"] ?></td>
                            <td><?php echo date("d-m-Y", strtotime($row["appointment_date"])) ?></td>
                            <td><?php echo date("H:i", strtotime($row["appointment_time"])) ?></td>
                            <td><?php echo $row["appointment_reason"] ?></td>
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