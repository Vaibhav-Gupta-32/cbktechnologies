<?php include('../config/dbconnection.php') ?>
<?php include('../config/session_check.php') ?>
<?php
$tblname = "vidhansabha_master";
$tblkey = "vidhansabha_id";
$pagename = "Vidhansabha Master";

// Initialize variables
$vidhansabha_name = "";
$district_id = "";
$vidhansabha_id = "";

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['submit_vidhansabha'])) {
        // Receive Data From Form
        $vidhansabha_name = ucfirst($_POST['vidhansabha_name']);
        $district_id = $_POST['district_id'];
        $vidhansabha_name = mysqli_real_escape_string($conn, $vidhansabha_name);
        $district_id = mysqli_real_escape_string($conn, $district_id);

        if (!empty($_POST['vidhansabha_id'])) {
            // Update existing vidhansabha
            $vidhansabha_id = $_POST['vidhansabha_id'];
            $sql = "UPDATE $tblname SET vidhansabha_name='$vidhansabha_name', district_id='$district_id' WHERE $tblkey='$vidhansabha_id'";
            if (mysqli_query($conn, $sql)) {
                $msg = "<div class='msg-container'><b class='alert alert-warning msg'>Vidhansabha Update Successfully</b></div>";
            } else {
                $msg = "<div class='msg-container'><b class='alert alert-danger msg'>Vidhansabha Update Unsuccessfully!!</b></div>";
            }
        } else {
            // Insert new vidhansabha
            // Check if vidhansabha_name already exists
            $check_query = "SELECT * FROM $tblname WHERE vidhansabha_name = '$vidhansabha_name' AND district_id = '$district_id'";
            $check_result = mysqli_query($conn, $check_query);

            if (mysqli_num_rows($check_result) > 0) {
                // Vidhansabha name already exists
                $msg = "<div class='msg-container'><b class='alert alert-danger msg'>Vidhansabha Already Exists!!</b></div>";
            } else {
                // Vidhansabha name does not exist, proceed with insertion
                $sql = "INSERT INTO $tblname (vidhansabha_name, district_id) VALUES ('$vidhansabha_name', '$district_id')";
                if (mysqli_query($conn, $sql)) {
                    $msg = "<div class='msg-container'><b class='alert alert-success msg'>Vidhansabha Added Successfully</b></div>";
                } else {
                    $msg = "<div class='msg-container'><b class='alert alert-danger msg'>Vidhansabha Added Unsuccessfully!!</b></div>";
                }
            }
        }
    }
}

// Fetch districts for dropdown
$district_query = "SELECT * FROM district_master";
$district_result = mysqli_query($conn, $district_query);

// Fetch vidhansabha details if edit is requested
if (isset($_GET['edit_id'])) {
    $vidhansabha_id = $_GET['edit_id'];
    $edit_query = "SELECT * FROM vidhansabha_master WHERE vidhansabha_id='$vidhansabha_id'";
    $edit_result = mysqli_query($conn, $edit_query);
    $edit_row = mysqli_fetch_assoc($edit_result);
    $vidhansabha_name = $edit_row['vidhansabha_name'];
    $district_id = $edit_row['district_id'];
}
?>

<?php include('../includes/header.php') ?>
<?php include('../includes/sidebar.php') ?>
<?php include('../includes/navbar.php') ?>

<div class="container-fluid pt-4 px-4">
    <!-- Form Vidhansabha -->
    <div class="row text-center align-items-center">
        <form method="post" class="row text-center align-items-center">
            <h5 class="text-center fw-bolder text-primary mb-3">नया विधानसभा का नाम जोड़ें</h5>
            <div class="col-lg-6 text-center mb-3">
                <select name="district_id" class="form-select form-control border-success" required>
                    <option selected>जिले का नाम चुनें</option>
                    <?php
                    while ($district_row = mysqli_fetch_assoc($district_result)) {
                        $selected = ($district_row['district_id'] == $district_id) ? "selected" : "";
                        echo "<option value='" . $district_row['district_id'] . "' $selected>" . $district_row['district_name'] . "</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="col-lg-6 text-center mb-3">
                <input type="text" name="vidhansabha_name" class="form-control border-success" placeholder="विधानसभा का नाम" value="<?= $vidhansabha_name ?>" required>
            </div>
            <div class="col-lg-6 text-center mb-3">
                <button name="submit_vidhansabha" class="form-control text-center text-white btn text-center shadow" type="submit" style="background-color:#4ac387;"><b>Save</b></button>
            </div>
            <div class="col-lg-6 text-center mb-3">
                <button name="cancel_vidhansabha" class="form-control text-center text-white btn text-center shadow" type="submit" style="background-color:#57c2fc;"><b>Cancel</b></button>
            </div>
            <input type="hidden" name="vidhansabha_id" value="<?= $vidhansabha_id ?>">
        </form>

        <!-- Vidhansabha Master Table -->
        <div class="row">
            <div class="col-sm-12 col-lg-12">
                <div class="bg-light rounded table-h">
                    <h5 class="mb-4 text-center mt-2 text-success fw-bolder">विधानसभा की सूची</h5>
                    <table class="table table-striped">
                        <thead class="head">
                            <tr>
                                <th scope="col">क्रमांक</th>
                                <th scope="col">विधानसभा का नाम</th>
                                <th scope="col">जिला</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            $sql = "SELECT v.*, v.vidhansabha_name, d.district_name 
                                    FROM vidhansabha_master v 
                                    JOIN district_master d ON v.district_id = d.district_id 
                                    ORDER BY v.vidhansabha_id DESC";
                            $fetch = mysqli_query($conn, $sql);
                            while ($row = mysqli_fetch_array($fetch)) {
                            ?>
                                <tr>
                                    <th scope="row"><?= $i++ ?></th>
                                    <td><?= $row['vidhansabha_name'] ?></td>
                                    <td><?= $row['district_name'] ?></td>
                                    <td class="d-flex justify-content-center flex-row action">
                                        <a href="?edit_id=<?= $row['vidhansabha_id'] ?>"><i class="fas fa-pen me-2" title="Edit"></i></a>
                                        <a class="text-danger " href="#" onclick="confirmDelete(<?= $row['vidhansabha_id']; ?>, '<?= $tblname; ?>', '<?= $tblkey ?>')"><i class="fas fa-trash-alt me-2" title="Delete"></i></a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('../includes/footer.php'); ?>
