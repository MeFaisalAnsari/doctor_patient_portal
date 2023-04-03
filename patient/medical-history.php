<?php include("includes/header.php") ?>

<div class="container my-5">
    <h1><i class="fa-solid fa-clock-rotate-left me-2"></i> Medical History</h1>
</div>

<div class="card shadow mb-4 mx-5">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Medical History</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered w-100 py-2 text-center" id="appointmentsTable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Date</th>
                        <th>Medical Condition</th>
                        <th>Treatment</th>
                        <th>Medication</th>
                        <th>Notes</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    $query = mysqli_query($con, "SELECT * FROM medical_history WHERE patient_id = '$patient_id' ORDER BY diagnosis_date DESC");
                    while ($row = mysqli_fetch_assoc($query)) {
                    ?>
                        <tr>
                            <td><?php echo $i ?></td>
                            <td><?php echo date("d-m-Y", strtotime($row["diagnosis_date"])) ?></td>
                            <td><?php echo $row["medical_condition"] ?></td>
                            <td><?php echo $row["treatment"] ?></td>
                            <td><?php echo $row["medication"] ?></td>
                            <td><?php echo $row["notes"] ?></td>
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

<div class="modal fade" id="bookAppointment" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Book New Appointment</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="code.php" method="POST">
                <div class="modal-body">
                    <input type="hidden" name="patient-id" value="<?php echo $patient_id ?>">
                    <table class="w-100">
                        <select class="form-control mb-3" name="doctor-id" required>
                            <option value="">-- Select Doctor --</option>
                            <?php
                            $query = mysqli_query($con, "SELECT * FROM doctors");
                            while ($row = mysqli_fetch_assoc($query)) {
                            ?>
                                <option value="<?php echo $row['doctor_id'] ?>">Dr. <?php echo $row['first_name'] . " " . $row["last_name"] ?> (<?php echo $row["specialisation"] ?>)</option>
                            <?php } ?>
                        </select>
                        <tr>
                            <td>Appointment Date : </td>
                            <td><input type="date" name="appointment-date" class="form-control" required></td>
                        </tr>
                        <tr>
                            <td>Appointment Time : </td>
                            <td><input type="time" name="appointment-time" class="form-control mt-3" required></td>
                        </tr>
                    </table>
                    <input type="text" name="appointment-reason" placeholder="Appointment Reason" class="form-control mt-3" required>
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" name="book-appointment" class="btn btn-primary">Book</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include("includes/footer.php") ?>