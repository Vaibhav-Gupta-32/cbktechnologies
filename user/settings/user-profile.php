<?php include('../config/dbconnection.php') ?>
<?php include('../config/session_check.php') ?>
<?php
$pagename = "User Profile Informations";
$tblname = 'userlogin';
// All Globle Variable
// echo $current_date = date("d-m-Y"); // Format: 09/08/24
$current_date = date("Y-m-d"); // Format: 2024-08-09

$username = $_SESSION['username'];

// Feach Data From Database
// $sql = "SELECT * FROM `userlogin` WHERE username = '$username'";
$sql = "SELECT 
a.*,
dm.district_name AS district_name,
vm2.vidhansabha_name AS vidhansabha_name,
vm3.vikaskhand_name AS vikaskhand_name,
sm.sector_name AS sector_name,
gpm.gram_panchayat_name AS gram_panchayat_name,
gm.gram_name AS gram_name,
am.area_name AS area_name

FROM 
$tblname a
LEFT JOIN district_master dm ON a.district_id = dm.district_id
LEFT JOIN vidhansabha_master vm2 ON a.vidhansabha_id = vm2.vidhansabha_id
LEFT JOIN vikaskhand_master vm3 ON a.vikaskhand_id = vm3.vikaskhand_id
LEFT JOIN sector_master sm ON a.sector_id = sm.sector_id
LEFT JOIN gram_panchayat_master gpm ON a.gram_panchayat_id = gpm.gram_panchayat_id
LEFT JOIN gram_master gm ON a.gram_id = gm.gram_id
LEFT JOIN area_master am ON a.area_id = am.area_id

WHERE 
 username = '$username'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $id = $row['id'];
    $username = $row['username'];
    $password = $row['password'];
    $email = $row['email'];
    $mobile_no = $row['mobile_no'];
    $salt = $row['salt'];
    $created_at = $row['created_at'];
    $name = $row['name'];
    $profile_update_date = $row['profile_update_date'];
    $district_id = $row['district_id'];
    $district_name = $row['district_name'];
    $vidhansabha_id = $row['vidhansabha_id'];
    $vidhansabha_name = $row['vidhansabha_name'];
    $area_id = $row['area_id'];
    $area_name = $row['area_name'];
    $vikaskhand_id = $row['vikaskhand_id'];
    $vikaskhand_name = $row['vikaskhand_name'];
    $sector_id = $row['sector_id'];
    $sector_name = $row['sector_name'];
    $gram_panchayat_id = $row['gram_panchayat_id'];
    $gram_panchayat_name = $row['gram_panchayat_name'];
    $gram_id = $row['gram_id'];
    $gram_name = $row['gram_name'];
    $profile_img = $row['profile_img'];
    $status = $row['status'];
} else {
    // Handle case when no data is found
    $id = $username = $password = $email = $mobile_no = $salt = $created_at =
        $name = $mobile_no = $profile_update_date = $district_id = $vidhansabha_id =
        $area_id = $vikaskhand_id = $sector_id = $gram_panchayat_id = $gram_id =
        $profile_img = $status = null;
}


// Update And Save Button 
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['Update'])) {
    // print_r($_POST);die;
    $id = $_POST['id'];
    $name = $_POST['name'];
    $profile_update_date = date('Y-m-d');
    $district_id = $_POST['district_id'];
    $vidhansabha_id = $_POST['vidhansabha_id'];
    $area_id = $_POST['area_id'];
    $vikaskhand_id = $_POST['vikaskhand_id'];
    $sector_id = $_POST['sector_id'];
    $gram_panchayat_id = $_POST['gram_panchayat_id'];
    $gram_id = $_POST['gram_id'];
    $profile_img = $_FILES['profile_img']['name'];

    // File upload logic
    if (!empty($profile_img)) {
        $target_dir = "uploads/";
        $file_extension = pathinfo($_FILES["profile_img"]["name"], PATHINFO_EXTENSION);
        $target_file = $target_dir . "Profile-" . $username . "." . $file_extension;
        $file_path = "Profile-" . $username . "." . $file_extension;
        // echo $target_file;die;
        move_uploaded_file($_FILES["profile_img"]["tmp_name"], $target_file);
    }

    // Update query
    $update_query = "UPDATE userlogin SET 
    name = '$name', 
    profile_update_date = '$profile_update_date', 
    district_id = '$district_id', 
    vidhansabha_id = '$vidhansabha_id', 
    area_id = '$area_id', 
    vikaskhand_id = '$vikaskhand_id', 
    sector_id = '$sector_id', 
    gram_panchayat_id = '$gram_panchayat_id', 
    gram_id = '$gram_id', 
    profile_img = '$file_path',
    status = 1
    WHERE username = '$username'";

    if (mysqli_query($conn, $update_query)) {
        $msg = "<div class='msg-container'><b class='alert alert-warning msg'>Update Successfully</b></div>";
    } else {
        $msg = "<div class='msg-container'><b class='alert alert-danger msg'>Update Unsuccessfully</b></div>";
    }
}

?>
<?php include('../includes/header.php') ?>
<?php include('../includes/sidebar.php') ?>
<?php include('../includes/navbar.php') ?>
<!--  -->
<!-- Main Code For Logig -->

<style>
    input[type="file"]::file-selector-button {
        color: #00698f;
        /* change the text color to blue */
        background-color: transparent;
        /* change the background color to light gray */
        border: none;
    }
</style>
<form action="" method="POST" enctype="multipart/form-data">
    <div class="container-fluid px-4 ">
        <h4 class="text-center fw-bolder text-primary mb-3"><?= $pagename; ?></h4>
        <hr class="text-danger p-2 rounded">
        <div class="row">
            <!--For ID-->
            <input type="hidden" name="id" id="id" value="<?= $id ?>">
            <!-- ID -->
            <div class="col-lg-4 col-md-12 col-sm-12 align-content-center">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="name" id="name" value="<?= $name ?>" readonly>
                        <label for="name">आवेदक का नाम </label>
                    </div>

                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" maxlength="10" name="mobile_no" id="mobile_no" value="<?= $mobile_no ?>" readonly>
                        <label for="mobile_no">आवेदक का फ़ोन नंबर </label>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <input type="date" class="form-control" id="profile_update_date" name="profile_update_date" value="<?= $current_date ?>" readonly>
                        <label for="profile_update_date">अपडेट दिनांक</label>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <select name="district_id" id="districtSelect" class="form-select form-control">
                            <?php
                            // Fetch districts for dropdown
                            $district_query = "SELECT * FROM district_master";
                            $district_result = mysqli_query($conn, $district_query);
                            ?>

                            <option selected>जिला का नाम चुनें</option>
                            <?php
                            while ($district_row = mysqli_fetch_assoc($district_result)) {
                                $selected = ($district_row['district_id'] == $district_id) ? 'selected' : '';
                                echo "<option value='" . $district_row['district_id'] . "' $selected>" . $district_row['district_name'] . "</option>";
                            }
                            ?>
                        </select>
                        <label for="districtSelect">जिला <span class="text-danger">*</span></label>

                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <input type="text" name="vidhansabha_id" id="vidhansabhaSelect" class="form-control" value="<?= $vidhansabha_name ?>" readonly>
                        <label for="vidhansabha">विधानसभा का नाम </label>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <input type="text" name="area_id" id="areaSelect" class="form-control" value="<?= $area_name ?>" readonly>
                        <label for="vidhansabha">क्षेत्र का नाम </label>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <input type="text" name="vikaskhand_id" id="vikaskhandSelect" class=" form-control " value="<?= $vikaskhand_name ?>" readonly>
                        <label for="vikaskhand">विकासखंड का नाम </label>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <input type="text" name="sector_id" id="sectorSelect" class=" form-control " value="<?= $sector_name ?>" readonly>
                        <label for="sector">सेक्टर का नाम </label>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <input type="text" name="gram_panchayat_id" id="gramPanchayatSelect" class=" form-control" value="<?= $gram_panchayat_name ?>" readonly>
                        <label for="gram_panchayt">ग्राम पंचायत का नाम </label>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="gramSelect" name="gram_id" value="<?= $gram_name ?>" readonly>
                        <label for="gram">ग्राम का नाम </label>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group shadow">
                    <div class="form-floating mb-3 input-group">
                        <input type="file" class="form-control bg-white" id="profile_img" name="profile_img" value="<?= $profile_img ?>">
                        <label for="profile_img"> अपलोड प्रोफाइल इमेज </label>
                        <span class="input-group-text bg-">
                            <a href="uploads/<?= $profile_img ?>" target="_blank" class=" p-0"><i class="fas fa-eye fa-lg"></i></a>
                        </span>
                    </div>
                </div>
            </div>
            <!--  -->

            <div class="col-lg-6 text-center mb-3">
                <div class="form-group">
                    <button class="col-12 text-white btn  text-center shadow" id="Update" type="submit" style="background-color:#4ac387;" name="Update"><b>Update & Save</b></button>
                </div>
            </div>
            <div class="col-lg-6 text-center mb-3">
                <div class="form-group">
                    <button class="col-12 text-white btn  text-center shadow btn-warning" id="Edit" type="submit" name="Edit"><b>Edit <i class="fa-solid fa-user-pen"></i></b></button>
                </div>
            </div>

            <!--  -->
        </div>
    </div>
</form>
<?php include('../includes/footer.php'); ?>