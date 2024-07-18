<?php include('../config/dbconnection.php') ?>
<?php include('../config/session_check.php') ?>
<?php
$tblname = "vikaskhand_master";
$tblkey = "vikaskhand_id";
$pagename = "Vikaskhand Master";

// Initialize variables
$vikaskhand_name = "";
$vidhansabha_id = "";
$district_id = "";
$vikaskhand_id = "";

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['submit_vikaskhand'])) {
        // Receive Data From Form
        $vikaskhand_name = ucfirst($_POST['vikaskhand_name']);
        $vidhansabha_id = $_POST['vidhansabha_id'];
        $district_id = $_POST['district_id'];
        $vikaskhand_name = mysqli_real_escape_string($conn, $vikaskhand_name);
        $vidhansabha_id = mysqli_real_escape_string($conn, $vidhansabha_id);
        $district_id = mysqli_real_escape_string($conn, $district_id);

        if (isset($_POST['vikaskhand_id']) && !empty($_POST['vikaskhand_id'])) {
            // Update existing record
            $vikaskhand_id = $_POST['vikaskhand_id'];
            $update_query = "UPDATE $tblname SET vikaskhand_name='$vikaskhand_name', vidhansabha_id='$vidhansabha_id', district_id='$district_id' WHERE $tblkey='$vikaskhand_id'";
            if (mysqli_query($conn, $update_query)) {
                $msg = "<div class='msg-container'><b class='alert alert-warning msg'>Vikaskhand Update Successfully</b></div>";
            } else {
                $msg = "<div class='msg-container'><b class='alert alert-danger msg'>Vikaskhand Update Unsuccessfully!!</b></div>";
            }
        } else {
            // Insert new record
            // Check if vikaskhand_name already exists for the selected district and vidhansabha
            $check_query = "SELECT * FROM $tblname WHERE vikaskhand_name = '$vikaskhand_name' AND district_id = '$district_id' AND vidhansabha_id = '$vidhansabha_id'";
            $check_result = mysqli_query($conn, $check_query);

            if (mysqli_num_rows($check_result) > 0) {
                // Vikaskhand name already exists
                $msg = "<div class='msg-container'><b class='alert alert-danger msg'>Vikaskhand already Exists!!</b></div>";
            } else {
                // Vikaskhand name does not exist, proceed with insertion
                $insert_query = "INSERT INTO $tblname (vikaskhand_name, vidhansabha_id, district_id) VALUES ('$vikaskhand_name', '$vidhansabha_id', '$district_id')";
                if (mysqli_query($conn, $insert_query)) {
                    $msg = "<div class='msg-container'><b class='alert alert-success msg'>Vikaskhand Added Successfully</b></div>";
                } else {
                    $msg = "<div class='msg-container'><b class='alert alert-danger msg'>Vikaskhand Added Unsuccessfully!!</b></div>";
                }
            }
        }
    }
}

$district_query = "SELECT * FROM district_master";
$district_result = mysqli_query($conn, $district_query);

// Handle edit request
if (isset($_GET['edit_id'])) {
    $vikaskhand_id = $_GET['edit_id'];
    $edit_query = "SELECT * FROM $tblname WHERE $tblkey='$vikaskhand_id'";
    $edit_result = mysqli_query($conn, $edit_query);
    if ($row = mysqli_fetch_assoc($edit_result)) {
        $vikaskhand_name = $row['vikaskhand_name'];
        $vidhansabha_id = $row['vidhansabha_id'];
        $district_id = $row['district_id'];
    }
}
?>
<?php include('../includes/header.php') ?>
<?php include('../includes/sidebar.php') ?>
<?php include('../includes/navbar.php') ?>

<!-- Vikaskhand Form -->
<div class="container-fluid pt-4 px-4">
    <!-- Form Vikaskhand -->
    <form method="post">
        <div class="row text-center align-items-center">
            <h5 class="text-center fw-bolder text-primary mb-3">नया विकासखंड का नाम जोड़ें</h5>
            <div class="col-lg-6 text-center mb-3">
                <select name="district_id" id="districtSelect" class="form-select form-control border-success" required>
                    <option selected>जिले का नाम चुनें</option>
                    <?php
                    mysqli_data_seek($district_result, 0); // Reset pointer to fetch districts again
                    while ($district_row = mysqli_fetch_assoc($district_result)) {
                        $selected = ($district_row['district_id'] == $district_id) ? 'selected' : '';
                        echo "<option value='" . $district_row['district_id'] . "' $selected>" . $district_row['district_name'] . "</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="col-lg-6 text-center mb-3">
                <select name="vidhansabha_id" id="vidhansabhaSelect" class="form-select form-control border-success" required>
                    <option selected>विधानसभा का नाम चुनें</option>
                    <?php
                    if (isset($vidhansabha_id) && !empty($vidhansabha_id)) {
                        $vidhansabha_query = "SELECT * FROM vidhansabha_master WHERE district_id = '$district_id'";
                        $vidhansabha_result = mysqli_query($conn, $vidhansabha_query);
                        while ($vidhansabha_row = mysqli_fetch_assoc($vidhansabha_result)) {
                            $selected = ($vidhansabha_row['vidhansabha_id'] == $vidhansabha_id) ? 'selected' : '';
                            echo "<option value='" . $vidhansabha_row['vidhansabha_id'] . "' $selected>" . $vidhansabha_row['vidhansabha_name'] . "</option>";
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="col-lg-6 text-center mb-3">
                <input type="text" name="vikaskhand_name" class="form-control border-success" placeholder="विकासखंड का नाम" value="<?= $vikaskhand_name ?>" required>
            </div>
            <input type="hidden" name="vikaskhand_id" value="<?= $vikaskhand_id ?>">
            <div class="col-lg-3 text-center mb-3">
                <button name="submit_vikaskhand" class="form-control text-center text-white btn text-center shadow" type="submit" style="background-color:#4ac387;"><b>Save</b></button>
            </div>
            <div class="col-lg-3 text-center mb-3">
                <button name="cancel_vikaskhand" class="form-control text-center text-white btn text-center shadow" type="reset" style="background-color:#57c2fc;"><b>Cancel</b></button>
            </div>
        </div>
    </form>
    <!-- Vikaskhand Master Table -->
    <div class="row">
        <div class="col-sm-12 col-lg-12">
            <div class="bg-light rounded" style="overflow-y: scroll;">
                <h5 class="mb-4 text-center mt-2 text-success fw-bolder">विकासखंड की सूची</h5>
                <table class="table table-striped">
                    <thead class="head">
                        <tr>
                            <th scope="col">क्रमांक</th>
                            <th scope="col">विकासखंड का नाम</th>
                            <th scope="col">विधानसभा</th>
                            <th scope="col">जिला</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        $sql = "SELECT v.*, v.vikaskhand_name, vs.vidhansabha_name, d.district_name 
                                FROM vikaskhand_master v 
                                JOIN vidhansabha_master vs ON v.vidhansabha_id = vs.vidhansabha_id 
                                JOIN district_master d ON v.district_id = d.district_id 
                                ORDER BY v.vikaskhand_id DESC";
                        $fetch = mysqli_query($conn, $sql);
                        while ($row = mysqli_fetch_array($fetch)) {
                        ?>
                            <tr>
                                <th scope="row"><?= $i++ ?></th>
                                <td><?= $row['vikaskhand_name'] ?></td>
                                <td><?= $row['vidhansabha_name'] ?></td>
                                <td><?= $row['district_name'] ?></td>
                                <td class="d-flex justify-content-center flex-row action">
                                    <a href="?edit_id=<?= $row['vikaskhand_id'] ?>"><i class="fas fa-pen me-2" title="Edit"></i></a>
                                    <a class="text-danger " href="#" onclick="confirmDelete(<?= $row['vikaskhand_id'] ?>, '<?= $tblname ?>', '<?= $tblkey ?>')"><i class="fas fa-trash-alt me-2" title="Delete"></i></a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<?php include('../includes/footer.php'); ?>