<?php include('../config/dbconnection.php') ?>
<?php include('../config/session_check.php') ?>
<?php
$tblname = "maananeey_master";
$tblkey = "maananeey_id";
$pagename = "माननीय  मास्टर";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['submit_maananeey'])) {
        // Receive Data From Form 
        $maananeey_info = ucfirst($_POST['maananeey_info']);
        $maananeey_info = mysqli_real_escape_string($conn, $maananeey_info);

        // Check if maananeey_info already exists
        $check_query = "SELECT * FROM $tblname WHERE maananeey_info = '$maananeey_info'";
        $check_result = mysqli_query($conn, $check_query);

        if (mysqli_num_rows($check_result) > 0) {
            // maananeey name already exists
            echo "<b class='text-danger'>Error: maananeey already exists!</b>";
        } else {
            // maananeey name does not exist, proceed with insertion
            $sql = "INSERT INTO $tblname (maananeey_info) VALUES ('$maananeey_info')";
            if (mysqli_query($conn, $sql)) {
                echo "<b class='text-success'>maananeey Added Successfully</b>";
            } else {
                echo "<b class='text-danger'>Error: " . mysqli_error($conn) . "</b>";
            }
        }
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['edit_maananeey'])) {
        // echo "<script>alert('dcasdas')</script>";
        $maananeey_id = ucfirst($_POST['maananeey_id']);
        $maananeey_info = ucfirst($_POST['maananeey_info']);
        $maananeey_info = mysqli_real_escape_string($conn, $maananeey_info);

        // Check if maananeey_info already exists
        $check_query = "SELECT * FROM $tblname WHERE $tblkey='$maananeey_id'";
        // echo 'sddss'. $check_query;die;
        $check_result = mysqli_query($conn, $check_query);

        if (mysqli_num_rows($check_result) > 0) {
            $sql = "UPDATE $tblname SET maananeey_info='$maananeey_info' WHERE $tblkey='$maananeey_id'";
            if (mysqli_query($conn, $sql)) {
                echo "<b class='text-success'>maananeey Update Successfully</b>";
            } else {
                echo "<b class='text-danger'>Error: " . mysqli_error($conn) . "</b>";
            }
        }
    }
}
?>
<?php include('../includes/header.php') ?>
<?php include('../includes/sidebar.php') ?>
<?php include('../includes/navbar.php') ?>

<!-- Add New maananeey Name Form -->
<!-- maananeey Master Table -->
<div class="container-fluid pt-4 px-4">
    <form method="post" id="addForm">
        <!-- Form to Add New maananeey Name -->
        <div class="row text-center align-items-center">
            <h4 class="text-center fw-bolder text-primary mb-3">नई माननीय का विवरण जोड़ें</h4>
            <div class="col-lg-12 text-center">
            <div class="form-floating mb-3">
                <input type="text" name="maananeey_info" class="form-control border-success" placeholder="माननीय का विवरण" required>
                <label for="aavedak">माननीय का विवरण<span class="text-danger">*</span> </label>
                </div>
            </div>
            <div class="col-lg-6 text-center mb-3">
                <button name="submit_maananeey" class="form-control text-center text-white btn  text-center shadow" type="submit" style="background-color:#4ac387;"><b>Save</b></button>
            </div>
            <div class="col-lg-6 text-center mb-3">
                <button name="cancel_maananeey" class="form-control text-center text-white btn  text-center shadow" type="reset" style="background-color:#57c2fc;"><b>Cancel</b></button>
            </div>
        </div>
    </form>
       <form method="post" id="editForm" class="d-none">
        <!-- Form to Edit maananeey Name -->
        <div class="row text-center align-items-center">
            <h4 class="text-center fw-bolder text-primary mb-3">माननीय का विवरण अपडेट करें</h4>
            <input type="hidden" name="maananeey_id" id="maananeey_id">
            <div class="col-lg-12 text-center">
            <div class="form-floating mb-3">
                <input type="text" name="maananeey_info" id="edit_maananeey_info" class="form-control border-success" placeholder="माननीय का विवरण" required>
                <label for="aavedak">माननीय का विवरण<span class="text-danger">*</span> </label>
            </div>
            </div>
            <div class="col-lg-6 text-center mb-3">
                <button name="edit_maananeey" class="form-control text-center text-white btn text-center shadow" type="submit" style="background-color:#4ac387;"><b>Update</b></button>
            </div>
            <div class="col-lg-6 text-center mb-3">
                <button class="form-control text-center text-white btn text-center shadow" type="cancle" style="background-color:#57c2fc;"><b>Cancel</b></button>
            </div>
        </div>
    </form>
    <div class="row">
        <div class="col-sm-12 col-lg-12">
            <div class="bg-light rounded table-h">
                <h5 class="mb-4 text-center mt-2 text-success fw-bolder">माननीय  मास्टर की सूची</h6>
                <table class="table table-striped">
                    <thead class="head">
                        <tr>
                            <th scope="col">क्रमांक</th>
                            <th scope="col">माननीय का विवरण</th>
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
                                <td><?= $row['maananeey_info'] ?></td>
                                <td class="d-flex justify-content-center flex-row action">
                                <a href="#" id="switch_edit" class="edit-btn" data-id="<?= $row[$tblkey]; ?>" data-name="<?= htmlspecialchars($row['maananeey_info']); ?>"><i class="fas fa-pen me-2" title="Edit"></i></a>
                                <a class="text-danger " href="#" onclick="confirmDelete(<?=$row[$tblkey];?>, '<?=$tblname; ?>' ,'<?=$tblkey?>')"><i class="fas fa-trash-alt me-2" title="Delete"></i></a>
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
            document.getElementById('maananeey_id').value = id;
            document.getElementById('edit_maananeey_info').value = name;

            // Switch forms
            document.getElementById('addForm').classList.add('d-none');
            document.getElementById('editForm').classList.remove('d-none');
        });
    });
</script>

<?php include('../includes/footer.php'); ?>