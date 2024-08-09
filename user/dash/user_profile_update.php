<?php include('../config/dbconnection.php') ?>
<?php include('../config/session_check.php') ?>
<?php
$pagename = "User Profile Informations";
$current_date = date("Y-m-d"); // Format: 2024-08-09
// All Globle Variable


if(isset($_REQUEST['id']))
echo 'dasas'.json_decode($username=$_REQUEST['id']);

$sql = "SELECT * FROM `userlogin` WHERE username = '$username'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $id = $row['id'];
    $username = $row['username'];

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
                        <input type="text" class="form-control" name="name" id="name" readonly require>
                        <label for="name">आवेदक का नाम </label>
                    </div>

                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" maxlength="10" name="mobile_no" id="mobile_no" value="<?= $mobile_no ?>" readonly require>
                        <label for="mobile_no">आवेदक का फ़ोन नंबर </label>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <input type="date" class="form-control" id="profile_update_date" name="profile_update_date" value="<?= $current_date ?>" readonly require>
                        <label for="profile_update_date">अपडेट दिनांक</label>
                    </div>
                </div>
            </div>
            <div class="<?=$field_size?>">
    <div class="form-group shadow">
        <div class="form-floating mb-3">
            <select name="district_id" id="districtSelect" class="form-select form-control bg-white">
                <?php
                // Fetch districts for dropdown
                $district_query = "SELECT * FROM district_master";
                $district_result = mysqli_query($conn, $district_query);
                ?>

                <option value="">जिला का नाम चुनें</option>
                <?php
                while ($district_row = mysqli_fetch_assoc($district_result)) {
                    echo "<option value='" . $district_row['district_id'] . "'>" . $district_row['district_name'] . "</option>";
                }
                ?>
            </select>
            <label for="districtSelect">जिला <span class="text-danger">*</span></label>

        </div>
    </div>
</div>
<div class="<?=$field_size?>">
    <div class="form-group shadow">
        <div class="form-floating mb-3">
            <select name="vidhansabha_id" id="vidhansabhaSelect" class="form-select form-control bg-white ">
                <option value="">विधानसभा का नाम चुनें</option>
                <!-- Options for vidhansabha will go here -->
            </select>
            <label for="vidhansabha">विधानसभा<span class="text-danger">*</span></label>
        </div>
    </div>
</div>

<div class="<?=$field_size?>">
    <div class="form-group shadow">
        <div class="form-floating mb-3">
            <select name="area_id" id="areaSelect" class="form-select form-control bg-white">
                <option value="">क्षेत्र का नाम चुनें</option>
                <!-- Options for area will go here -->

            </select>
            <label for="areaSelect">क्षेत्र का नाम चुनें <span class="text-danger">*</span></label>
        </div>
    </div>
</div>

<div class="<?=$field_size?>">
    <div class="form-group shadow">
        <div class="form-floating mb-3">
            <select name="vikaskhand_id" id="vikaskhandSelect" class="form-select form-control bg-white">
                <option value="">विकासखंड का नाम चुनें</option>
                <!-- Option Load By AJAX -->

            </select>
            <label for="vikaskhand">विकासखंड <span class="text-danger">*</span> </label>
        </div>
    </div>
</div>
<div class="<?=$field_size?>">
    <div class="form-group shadow">
        <div class="form-floating mb-3">
            <select name="sector_id" id="sectorSelect" class="form-select form-control bg-white">
                <option value="">सेक्टर का नाम चुनें</option>
                <!-- Options for sectors will go here -->
            </select>
            <label for="sector">सेक्टर <span class="text-danger">*</span> </label>
        </div>
    </div>
</div>
<div class="<?=$field_size?>">
    <div class="form-group shadow">
        <div class="form-floating mb-3">
            <select name="gram_panchayat_id" id="gramPanchayatSelect" class="form-select form-control bg-white">
                <option value="">ग्राम पंचायत का नाम चुनें</option>
                <!-- Options for panchayat will go here -->
            </select>
            <label for="gram_panchayt">ग्राम पंचायत <span class="text-danger">*</span> </label>
        </div>
    </div>
</div>
<div class="<?=$field_size?>">
    <div class="form-group shadow">
        <div class="form-floating mb-3">
            <select class="form-select" id="gramSelect" name="gram_id">
                <option value="">ग्राम का नाम चुनें</option>
                <!-- by load ajax -->
            </select>
            <label for="gram">ग्राम <span class="text-danger">*</span></label>
        </div>
    </div>
</div>
            <div class="col-lg-6">
                <div class="form-group shadow">
                    <div class="form-floating mb-3 input-group">
                        <input type="file" class="form-control bg-white" id="profile_img" name="profile_img">
                        <label for="profile_img"> अपलोड प्रोफाइल इमेज </label>
                        <!-- <span class="input-group-text bg-">
                            <a href="uploads/<?= $profile_img ?>" target="_blank" class=" p-0"><i class="fas fa-eye fa-lg"></i></a>
                        </span> -->
                    </div>
                </div>
            </div>
            <!--  -->

            <div class="col-lg-12 text-center mb-3">
                <div class="form-group">
                    <button class="col-12 text-white btn  text-center shadow" id="Update" type="submit" style="background-color:#4ac387;" name="Update"><b>Update & Save</b></button>
                </div>
            </div>
            <!-- <div class="col-lg-6 text-center mb-3">
                <div class="form-group">
                    <button class="col-12 text-white btn  text-center shadow btn-warning" id="Edit" type="submit" name="Edit"><b>Edit <i class="fa-solid fa-user-pen"></i></b></button>
                </div>
            </div> -->

            <!--  -->
        </div>
    </div>
</form>