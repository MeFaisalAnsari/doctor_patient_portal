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
        <h6 class="m-0 font-weight-bold text-primary">List of all Appointments</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered w-100 py-2 text-center" id="appointmentTable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Patient</th>
                        <th>Doctor</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Reason</th>
                        <th>Status</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    $query = mysqli_query($con, "SELECT appointments.*, patients.first_name AS patient_first_name, patients.last_name AS patient_last_name, doctors.first_name AS doctor_first_name, doctors.last_name AS doctor_last_name FROM appointments JOIN patients ON appointments.patient_id = patients.patient_id  JOIN doctors ON appointments.doctor_id = doctors.doctor_id ORDER BY appointment_id DESC");
                    while ($row = mysqli_fetch_assoc($query)) {
                    ?>
                        <tr>
                            <td><?php echo $i ?></td>
                            <td><?php echo $row["patient_first_name"] . " " . $row["patient_last_name"] ?></td>
                            <td>Dr. <?php echo $row["doctor_first_name"] . " " . $row["doctor_last_name"] ?></td>
                            <td><?php echo date("d-m-Y", strtotime($row["appointment_date"])) ?></td>
                            <td><?php echo date("H:i", strtotime($row["appointment_time"])) ?></td>
                            <td><?php echo $row["appointment_reason"] ?></td>
                            <td>
                                <?php
                                $status = $row["appointment_status"];
                                if ($status == 'completed') {
                                    echo '<button class="btn btn-success">Completed</button>';
                                } elseif ($status == 'cancelled') {
                                    echo '<button class="btn btn-danger">Cancelled</button>';
                                } else {
                                    echo '<button class="btn btn-warning">Scheduled</button>';
                                }
                                ?>
                            </td>
                            <td>
                                <a href="#deleteAppointment<?php echo $row['appointment_id'] ?>" data-bs-toggle="modal"><i class="fa-solid fa-trash-can text-danger"></i></a>
                                <div class="modal fade" id="deleteAppointment<?php echo $row['appointment_id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Appointment</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>This appointment will be deleted permenently!</p>
                                                <p>Are you sure ?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                                                <a href="code.php?delete-appointment=<?php echo $row['appointment_id'] ?>" class="btn btn-danger">Yes</a>
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