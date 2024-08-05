<?php include('../config/dbconnection.php') ?>
<?php include('../config/session_check.php') ?>
<?php
$tblname = "gram_master";
$tblkey = "gram_id";
$pagename = "ग्राम मास्टर";
$gram_name = "";
$gram_id = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['submit_gram'])) {
        // Receive Data From Form
        $gram_name = ucfirst($_POST['gram_name']);
        $gram_panchayat_id = $_POST['gram_panchayat_id'];
        $sector_id = $_POST['sector_id'];
        $vikaskhand_id = $_POST['vikaskhand_id'];
        $vidhansabha_id = $_POST['vidhansabha_id'];
        $district_id = $_POST['district_id'];
        $area_id = $_POST['area_id'];
        $vikaskhand_id = mysqli_real_escape_string($conn, $vikaskhand_id);
        $vidhansabha_id = mysqli_real_escape_string($conn, $vidhansabha_id);
        $district_id = mysqli_real_escape_string($conn, $district_id);
        $sector_id = mysqli_real_escape_string($conn, $sector_id);
        $gram_panchayat_id = mysqli_real_escape_string($conn, $gram_panchayat_id);

        if (isset($_POST['gram_id']) && !empty($_POST['gram_id'])) {
            // echo 'vaibhav' . $_POST['gram_id'];
            // die;
            // Update existing record
            $gram_id = $_POST['gram_id'];
            $update_query = "UPDATE $tblname SET gram_name='$gram_name', gram_panchayat_id='$gram_panchayat_id',sector_id='$sector_id',vikaskhand_id='$vikaskhand_id', vidhansabha_id='$vidhansabha_id', district_id='$district_id', area_id='$area_id' WHERE $tblkey='$gram_id'";
            // echo $update_query;
            // die;
            if (mysqli_query($conn, $update_query)) {
                $msg = "<div class='msg-container'><b class='alert alert-warning msg'>Gram Update Successfully</b></div>";
            } else {
                $msg = "<div class='msg-container'><b class='alert alert-danger msg'>Gram Update Unsuccessfully!!</b></div>";
            }
        } else {
            // Insert new record
            // Check if sector_id already exists for the selected district and vidhansabha
            $check_query = "SELECT * FROM $tblname WHERE gram_panchayat_id='$gram_panchayat_id' AND sector_id = '$sector_id' AND vikaskhand_id='$vikaskhand_id' AND district_id = '$district_id' AND vidhansabha_id = '$vidhansabha_id'";
            // echo $check_query;die;
            $check_result = mysqli_query($conn, $check_query);

            if (mysqli_num_rows($check_result) > 0) {
                // Vikaskhand name already exists
                $msg = "<div class='msg-container'><b class='alert alert-danger msg'>Gram Already Exists!!</b></div>";
            } else {
                // Vikaskhand name does not exist, proceed with insertion
                $insert_query = "INSERT INTO $tblname (gram_name, gram_panchayat_id, sector_id,vikaskhand_id, vidhansabha_id, district_id, area_id) VALUES ('$gram_name', '$gram_panchayat_id', '$sector_id','$vikaskhand_id', '$vidhansabha_id', '$district_id', '$area_id')";
                // echo $insert_query;
                // die;
                if (mysqli_query($conn, $insert_query)) {
                    $msg = "<div class='msg-container'><b class='alert alert-success msg'>Gram Added Successfully</b></div>";
                } else {
                    $msg = "<div class='msg-container'><b class='alert alert-danger msg'>Gram Added Unsuccessfully!!</b></div>";
                }
            }
        }
    }
}

$district_query = "SELECT * FROM district_master";
$district_result = mysqli_query($conn, $district_query);

// Handle edit request
if (isset($_GET['edit_id'])) {
    $gram_id = $_GET['edit_id'];
    $edit_query = "SELECT * FROM $tblname WHERE $tblkey='$gram_id'";
    $edit_result = mysqli_query($conn, $edit_query);
    if ($row = mysqli_fetch_assoc($edit_result)) {
        $gram_name = $row['gram_name'];
        $gram_panchayat_id = $row['gram_panchayat_id'];
        $sector_id = $row['sector_id'];
        $vikaskhand_id = $row['vikaskhand_id'];
        $vidhansabha_id = $row['vidhansabha_id'];
        $district_id = $row['district_id'];
        $area_idd = $row['area_id'];
    }
}
?>

<?php include('../includes/header.php') ?>
<?php include('../includes/sidebar.php') ?>
<?php include('../includes/navbar.php') ?>


<div class="container-fluid pt-4 px-4">
    <form method="post">
        <div class="row text-center align-items-center">
            <h5 class="text-center fw-bolder text-primary mb-3">नया ग्राम जोड़ें</h5>

            <div class="col-lg-4 text-center mb-3">
                <select name="district_id" id="districtSelect" class="form-select form-control bg-white" required>
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

            <div class="col-lg-4 text-center mb-3">
                <select name="vidhansabha_id" id="vidhansabhaSelect" class="form-select form-control bg-white" required>
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

            <div class="col-lg-4 text-center mb-3">
                <select name="area_id" id="areaSelect" class="form-select form-control bg-white" required>
                    <option selected>क्षेत्र का नाम चुनें</option>
                    <?php
                    if (isset($area_idd) && !empty($area_idd)) {
                        $area_query = "SELECT * FROM area_master WHERE 1";
                        $area_result = mysqli_query($conn, $area_query);
                        while ($area_row = mysqli_fetch_assoc($area_result)) {
                            $selected = ($area_row['area_id'] == $area_idd) ? 'selected' : '';
                            echo "<option value='" . $area_row['area_id'] . "' $selected>" . $area_row['area_name'] . "</option>";
                        }
                    }
                    ?>
                </select>
            </div>

            <div class="col-lg-6 text-center mb-3">
                <select name="vikaskhand_id" id="vikaskhandSelect" class="form-select form-control bg-white" required>
                    <option selected>विकासखंड का नाम चुनें</option>
                    <?php
                    if (isset($vikaskhand_id) && !empty($vikaskhand_id)) {
                        $vikaskhand_query = "SELECT * FROM vikaskhand_master WHERE vidhansabha_id = '$vidhansabha_id'";
                        $vikaskhand_result = mysqli_query($conn, $vikaskhand_query);
                        while ($vikaskhand_row = mysqli_fetch_assoc($vikaskhand_result)) {
                            $selected = ($vikaskhand_row['vikaskhand_id'] == $vikaskhand_id) ? 'selected' : '';
                            echo "<option value='" . $vikaskhand_row['vikaskhand_id'] . "' $selected>" . $vikaskhand_row['vikaskhand_name'] . "</option>";
                        }
                    }
                    ?>

                </select>
            </div>

            <div class="col-lg-6 text-center mb-3">
                <select name="sector_id" id="sectorSelect" class="form-select form-control bg-white" required>
                    <option selected>सेक्टर का नाम चुनें</option>
                    <?php
                    if (isset($sector_id) && !empty($sector_id)) {
                        $sector_query = "SELECT * FROM sector_master WHERE vikaskhand_id = '$vikaskhand_id'";
                        $sector_result = mysqli_query($conn, $sector_query);
                        while ($sector_row = mysqli_fetch_assoc($sector_result)) {
                            $selected = ($sector_row['sector_id'] == $sector_id) ? 'selected' : '';
                            echo "<option value='" . $sector_row['sector_id'] . "' $selected>" . $sector_row['sector_name'] . "</option>";
                        }
                    }
                    ?>
                </select>
            </div>

            <div class="col-lg-6 text-center mb-3">
                <select name="gram_panchayat_id" id="gramPanchayatSelect" class="form-select form-control bg-white">
                    <option selected>ग्राम पंचायत का नाम चुनें</option>
                    <?php
                    if (isset($gram_panchayat_id) && !empty($gram_panchayat_id)) {
                        $gram_panchayat_query = "SELECT * FROM gram_panchayat_master WHERE sector_id = '$sector_id'";
                        $gram_panchayat_result = mysqli_query($conn, $gram_panchayat_query);
                        while ($gram_panchayat_row = mysqli_fetch_assoc($gram_panchayat_result)) {
                            $selected = ($gram_panchayat_row['gram_panchayat_id'] == $gram_panchayat_id) ? 'selected' : '';
                            echo "<option value='" . $gram_panchayat_row['gram_panchayat_id'] . "' $selected>" . $gram_panchayat_row['gram_panchayat_name'] . "</option>";
                        }
                    }
                    ?>
                </select>
            </div>

            <div class="col-lg-6 text-center mb-3">
                <input type="text" name="gram_name" class="form-control" placeholder="ग्राम का नाम" required value="<?= $gram_name ?>">
                <?php if (isset($_GET['edit_id'])) { ?>
                    <input type="hidden" name="gram_id" value="<?= $gram_id ?>">
                <?php } ?>
            </div>

            <div class="col-lg-6 text-center mb-3">
                <button name="submit_gram" class="form-control text-center text-white btn text-center shadow" type="submit" style="background-color:#4ac387;"><b>Save</b></button>
            </div>

            <div class="col-lg-6 text-center mb-3">
                <button name="cancel_gram" class="form-control text-center text-white btn text-center shadow" type="reset" style="background-color:#57c2fc;"><b>Cancel</b></button>
            </div>
        </div>
    </form>

    <!-- Gram Master Table -->
    <div class="row">
        <div class="col-sm-12 col-lg-12">
            <div class="bg-light rounded" style="overflow-y: scroll;">
                <h5 class="mb-4 text-center mt-2 text-success fw-bolder">ग्राम की सूची</h5>
                <table class="table table-striped">
                    <thead class="head">
                        <tr>
                            <th scope="col">क्रमाक</th>
                            <th scope="col">ग्राम का नाम</th>
                            <th scope="col">ग्राम पंचायत</th>
                            <th scope="col">सेक्टर</th>
                            <th scope="col">विकासखंड</th>
                            <th scope="col">क्षेत्र</th>
                            <th scope="col">विधानसभा</th>
                            <th scope="col">जिला</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT g.gram_id, g.gram_name, gp.gram_panchayat_name, v.vikaskhand_name, vs.vidhansabha_name, d.district_name, s.sector_name, a.area_name
        FROM $tblname g
        JOIN vikaskhand_master v ON g.vikaskhand_id = v.vikaskhand_id
        JOIN vidhansabha_master vs ON g.vidhansabha_id = vs.vidhansabha_id
        JOIN district_master d ON g.district_id = d.district_id
        JOIN sector_master s ON g.sector_id = s.sector_id
        JOIN gram_panchayat_master gp ON g.gram_panchayat_id = gp.gram_panchayat_id
        JOIN area_master a ON g.area_id = a.area_id 
        ORDER BY g.$tblkey DESC";
                        $fetch = mysqli_query($conn, $sql);
                        $i = 1;
                        while ($row = mysqli_fetch_array($fetch)) {
                        ?>
                            <tr>
                                <td><?= $i++ ?></td>
                                <td><?= $row['gram_name'] ?></td>
                                <td><?= $row['gram_panchayat_name'] ?></td>
                                <td><?= $row['sector_name'] ?></td>
                                <td><?= $row['vikaskhand_name'] ?></td>
                                <td><?= $row['area_name'] ?></td>
                                <td><?= $row['vidhansabha_name'] ?></td>
                                <td><?= $row['district_name'] ?></td>
                                <td class="d-flex justify-content-center flex-row action">
                                    <a href="?edit_id=<?= $row['gram_id'] ?>"><i class="fas fa-pen me-2" title="Edit"></i></a>
                                    <a class="text-danger " href="#" onclick="confirmDelete(<?= $row['gram_id']; ?>, '<?= $tblname; ?>' ,'<?= $tblkey ?>')"><i class="fas fa-trash-alt me-2" title="Delete"></i></a>
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