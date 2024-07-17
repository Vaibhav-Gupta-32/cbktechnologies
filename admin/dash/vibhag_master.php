<?php include('../dbconnection.php') ?>
<?php include('../session_check.php') ?>
<?php
$tblname = "vibhag_master";
$tblkey = "vibhag_id";
$pagename = "विभाग मास्टर";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['submit_vibhag'])) {
        // Receive Data From Form 
        $vibhag_name = ucfirst($_POST['vibhag_name']);
        $vibhag_name = mysqli_real_escape_string($conn, $vibhag_name);

        // Check if vibhag_name already exists
        $check_query = "SELECT * FROM $tblname WHERE $tblkey = '$vibhag_name'";
        $check_result = mysqli_query($conn, $check_query);

        if (mysqli_num_rows($check_result) > 0) {
            // Vibhag name already exists
            $msg = "<div class='msg-container'><b class='alert alert-danger msg'>Vibhag already exists!</b></div>";
        } else {
            // Vibhag name does not exist, proceed with insertion
            $sql = "INSERT INTO $tblname (vibhag_name) VALUES ('$vibhag_name')";
            if (mysqli_query($conn, $sql)) {
                $msg = "<div class='msg-container'><b class='alert alert-success msg'>Vibhag Added Successfully</b></div>";

            } else {
                $msg = "<div class='msg-container'><b class='alert alert-danger msg'>Vibhag Added Unsuccessfully!!</b></div>";

            }
        }
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['edit_vibhag'])) {
        // echo "<script>alert('dcasdas')</script>";
        $vibhag_id = ucfirst($_POST['vibhag_id']);
        $vibhag_name = ucfirst($_POST['vibhag_name']);
        $vibhag_name = mysqli_real_escape_string($conn, $vibhag_name);

        // Check if vibhag_name already exists
        $check_query = "SELECT * FROM $tblname WHERE $tblkey='$vibhag_id'";
        // echo 'sddss'. $check_query;die;
        $check_result = mysqli_query($conn, $check_query);

        if (mysqli_num_rows($check_result) > 0) {
            $sql = "UPDATE $tblname SET vibhag_name='$vibhag_name' WHERE $tblkey='$vibhag_id'";
            if (mysqli_query($conn, $sql)) {
                $msg = "<div class='msg-container'><b class='alert alert-warning msg'>Vibhag Update Successfully</b></div>";           

            } else {
                $msg = "<div class='msg-container'><b class='alert alert-danger msg'>Vibhag Update Unsuccessfully!!</b></div>";

            }
        }
    }
}

?>
<?php include('includes/header.php') ?>
<?php include('includes/sidebar.php') ?>
<?php include('includes/navbar.php') ?>
<!-- Add New Vibhag Name Form -->

<div class="container-fluid pt-4 px-4">
    <form method="post" id="addForm">
        <!-- Form to Add New Vibhag Name -->
        <div class="row text-center align-items-center">
            <h4 class="text-center fw-bolder text-primary mb-3">नया विभाग का नाम जोड़ें</h4>
            <div class="col-lg-4 text-center mb-3">
                <input type="text" name="vibhag_name" class="form-control border-success" placeholder="विभाग का नाम" required>
            </div>
            <div class="col-lg-4 text-center mb-3">
                <button name="submit_vibhag" class="form-control text-center text-white btn  text-center shadow" type="submit" style="background-color:#4ac387;"><b>Save</b></button>
            </div>
            <div class="col-lg-4 text-center mb-3">
                <button name="cancel_vibhag" class="form-control text-center text-white btn  text-center shadow" type="reset" style="background-color:#57c2fc;"><b>Cancel</b></button>
            </div>
        </div>
    </form>
    <form method="post" id="editForm" class="d-none">
        <!-- Form to Edit Vibhag Name -->
        <div class="row text-center align-items-center">
            <h4 class="text-center fw-bolder text-primary mb-3">विभाग का नाम अपडेट करें</h4>
            <input type="hidden" name="vibhag_id" id="vibhag_id">
            <div class="col-lg-4 text-center mb-3">
                <input type="text" name="vibhag_name" id="edit_vibhag_name" class="form-control border-success" placeholder="विभाग का नाम" required>
            </div>
            <div class="col-lg-4 text-center mb-3">
                <button name="edit_vibhag" class="form-control text-center text-white btn text-center shadow" type="submit" style="background-color:#4ac387;"><b>Update</b></button>
            </div>
            <div class="col-lg-4 text-center mb-3">
                <button class="form-control text-center text-white btn text-center shadow" type="cancle" style="background-color:#57c2fc;"><b>Cancel</b></button>
            </div>
        </div>
    </form>
    <!-- Vibhag Master Table -->
    <div class="row">
        <div class="col-sm-12 col-lg-12">
            <div class="bg-light rounded table-h">
                <h5 class="mb-4 text-center mt-2 text-success fw-bolder">विभागों की सूची</h6>
                    <table class="table table-striped">
                        <thead class="head">
                            <tr>
                                <th scope="col">क्रमांक</th>
                                <th scope="col">विभाग का नाम</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            $sql = "SELECT * FROM $tblname ORDER BY $tblkey DESC";
                            $fetch = mysqli_query($conn, $sql);
                            while ($row = mysqli_fetch_array($fetch)) {
                            ?>
                                <tr>
                                    <th scope="row"><?= $i++ ?></th>
                                    <td><?= $row['vibhag_name'] ?></td>
                                    <td class="d-flex justify-content-center flex-row action">
                                        <a href="#" id="switch_edit" class="edit-btn" data-id="<?= $row[$tblkey]; ?>" data-name="<?= htmlspecialchars($row['vibhag_name']); ?>"><i class="fas fa-pen me-2" title="Edit"></i></a>
                                        <a href="#" onclick="confirmDelete(<?= $row[$tblkey]; ?>, '<?= $tblname; ?>' ,'<?= $tblkey ?>')"><i class="fas fa-trash-alt me-2" title="Delete"></i></a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('switch_edit').addEventListener('click', function(event) {
        event.preventDefault();
        const addForm = document.getElementById('addForm');
        const editForm = document.getElementById('editForm');
        const switchLink = document.getElementById('switch_edit');

        if (addForm.classList.contains('d-none')) {
            addForm.classList.remove('d-none');
            editForm.classList.add('d-none');
            // switchLink.textContent = 'Login with OTP';
        } else {
            addForm.classList.add('d-none');
            editForm.classList.remove('d-none');
            // switchLink.textContent = 'Login with Username/Password';
        }
    });

    // Event listener for edit buttons
    document.querySelectorAll('.edit-btn').forEach(button => {
        button.addEventListener('click', function(event) {
            event.preventDefault();
            const id = this.getAttribute('data-id');
            const name = this.getAttribute('data-name');

            // Populate the edit form
            document.getElementById('vibhag_id').value = id;
            document.getElementById('edit_vibhag_name').value = name;

            // Switch forms
            document.getElementById('addForm').classList.add('d-none');
            document.getElementById('editForm').classList.remove('d-none');
        });
    });
</script>


<?php include('includes/footer.php'); ?>