<?php include('../config/dbconnection.php') ?>
<?php include('../config/session_check.php') ?>
<?php
$tblname = "hospital_master";
$tblkey = "id";
$pagename = "Hospital Master";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['submit'])) {
        // recive Data From Form 
        $name = ucfirst($_POST['name']);
        $address = ucfirst($_POST['address']);
        $contact = $_POST['contact'];

        $name = mysqli_real_escape_string($conn, $name);
        $address = mysqli_real_escape_string($conn, $address);
        $contact = mysqli_real_escape_string($conn, $contact);
        $check_query = "SELECT * FROM $tblname WHERE name = '$name' ";
        $check_result = mysqli_query($conn, $check_query);

        if (mysqli_num_rows($check_result) > 0) {
            // Hospital name already exists
            $msg = "<div class='msg-container'><b class='alert alert-danger msg'>Hospital already exists!</b></div>";
        } else {
            // Hospital name does not exist, proceed with insertion
            $sql = "INSERT INTO $tblname (name, address, contact) VALUES ('$name', '$address', '$contact')";
            if (mysqli_query($conn, $sql)) {
                $msg = "<div class='msg-container'><b class='alert alert-success msg'>Hospital Added Successfully</b></div>";
            } else {
                $msg = "<div class='msg-container'><b class='alert alert-danger msg'>Hospital Added Unsuccessfully!!</b></div>";
            }
        }
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['edit_hospital'])) {
        // echo "<script>alert('dcasdas')</script>";
        $id = ucfirst($_POST['id']);
        $name = ucfirst($_POST['name']);
        $address = ucfirst($_POST['address']);
        $contact = $_POST['contact'];

        $name = mysqli_real_escape_string($conn, $name);
        $address = mysqli_real_escape_string($conn, $address);
        $contact = mysqli_real_escape_string($conn, $contact);

        // Check if Hospital_name already exists
        $check_query = "SELECT * FROM $tblname WHERE $tblkey='$id'";
        // echo 'sddss'. $check_query;die;
        $check_result = mysqli_query($conn, $check_query);

        if (mysqli_num_rows($check_result) > 0) {
            $sql = "UPDATE $tblname SET name = '$name', address = '$address', contact = '$contact' WHERE $tblkey='$id'";
            if (mysqli_query($conn, $sql)) {
                $msg = "<div class='msg-container'><b class='alert alert-warning msg'>Hospital Update Successfully</b></div>";
            } else {
                $msg = "<div class='msg-container'><b class='alert alert-danger msg'>Hospital Update Unsuccessfully!!</b></div>";
            }
        }
    }
}

?>
<?php include('../includes/header.php') ?>
<?php include('../includes/sidebar.php') ?>
<?php include('../includes/navbar.php') ?>

<!-- Hospital Form -->
<!-- Add New Hospital Name -->
<div class="container-fluid pt-4 px-4">
    <form method="post" id="addForm">
     <!-- Table End -->
     <div class="row text-center align-items-center">
            <h4 class="text-center fw-bolder text-primary mb-3">नया हॉस्पिटल का नाम जोड़े </h4>
            <div class="col-lg-4 text-center mb-3">
                <input type="text" name="name" class="form-control border-success" id="name" placeholder="हॉस्पिटल का नाम" required>
            </div>
            <div class="col-lg-4 text-center mb-3">
                <input type="text" name="address" class="form-control border-success" id="address" placeholder="हॉस्पिटल का पता">
            </div>
            <div class="col-lg-4 text-center mb-3">
                <input type="text" name="contact" maxlength="10" onkeypress='return event.charCode >= 48 && event.charCode <= 57' class="form-control border-success" id="contact" placeholder="हॉस्पिटल का नंबर">
            </div>
     
            <div class="col-lg-6 text-center mb-3">
                <button name="submit" class="form-control text-center text-white btn  text-center shadow" type="submit" style="background-color:#4ac387;"><b>Save</b></button>
            </div>
            <div class="col-lg-6  text-center mb-3">
                <button name="cancel" class="col-lg-4 form-control text-center text-white btn  text-center shadow" type="reset" style="background-color:#57c2fc;"><b>Cancel</b></button>
            </div>
        </div>
    </form>
    <form method="post" id="editForm" class="d-none">
        <!-- Form to Edit Hospital Name -->
        <div class="row text-center align-items-center">
            <h4 class="text-center fw-bolder text-primary mb-3">हॉस्पिटल का विवरण बदले </h4>
            <div class="col-lg-4 text-center mb-3">
                <input type="hidden" name="id" class="form-control border-success" id="id" placeholder="हॉस्पिटल का नाम" required>
                <input type="text" name="name" class="form-control border-success" id="edit_name" placeholder="हॉस्पिटल का नाम" required>
            </div>
            <div class="col-lg-4 text-center mb-3">
                <input type="text" name="address" class="form-control border-success" id="edit_address" placeholder="हॉस्पिटल का पता">
            </div>
            <div class="col-lg-4 text-center mb-3">
                <input type="text" name="contact" maxlength="10" onkeypress='return event.charCode >= 48 && event.charCode <= 57' class="form-control border-success" id="edit_contact" placeholder="हॉस्पिटल का नंबर">
            </div>
     
            <div class="col-lg-6 text-center mb-3">
                <button name="edit_hospital" class="form-control text-center text-white btn  text-center shadow" type="submit" style="background-color:#4ac387;"><b>Update</b></button>
            </div>
            <div class="col-lg-6  text-center mb-3">
                <button name="cancel" class="col-lg-4 form-control text-center text-white btn  text-center shadow" type="cancel" style="background-color:#57c2fc;"><b>Cancel</b></button>
            </div>
        </div>
    </form>
        <!-- Table Start -->
        <div class="row">
            <div class="col-sm-12 col-lg-12">
                <div class="bg-light rounded table-h">
                    <h5 class="mb-4 text-center mt-2 text-success fw-bolder">जिलों की सूची</h6>
                    <table class="table table-striped">
                        <thead class="head">
                            <tr>
                                <th scope="col">क्रमांक</th>
                                <th scope="col">हॉस्पिटल  का नाम</th>
                                <th scope="col">हॉस्पिटल का पता </th>
                                <th scope="col">हॉस्पिटल का नंबर </th>
                                <th scope="col">Action </th>
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
                                    <td><?= $row['name'] ?></td>
                                    <td><?= $row['address'] ?></td>
                                    <td><?= $row['contact'] ?></td>
                                    <td class="d-flex justify-content-center flex-row action">
                                    <a href="#" id="switch_edit" class="edit-btn" data-id="<?= $row[$tblkey]; ?>" data-name="<?= htmlspecialchars($row['name']); ?>" data-address="<?= htmlspecialchars($row['address']);?>" data-contact="<?= htmlspecialchars($row['contact']); ?>"><i class="fas fa-pen me-2" title="Edit"></i></a>
                                    <a class="text-danger " href="#" onclick="confirmDelete(<?=$row['id'];?>, '<?=$tblname; ?>' ,'<?=$tblkey?>')"><i class="fas fa-trash-alt me-2" title="Delete"></i></a>
                                        
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
</div>
<!-- Hospital Form Close  -->

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
            const address = this.getAttribute('data-address');
            const contact = this.getAttribute('data-contact');

            // Populate the edit form
            document.getElementById('id').value = id;
            document.getElementById('edit_name').value = name;
            document.getElementById('edit_address').value = address;
            document.getElementById('edit_contact').value = contact;

            // Switch forms
            document.getElementById('addForm').classList.add('d-none');
            document.getElementById('editForm').classList.remove('d-none');
        });
    });
</script>

<?php include('../includes/footer.php'); ?>