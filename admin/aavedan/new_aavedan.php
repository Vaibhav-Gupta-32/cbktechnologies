<?php include('../config/dbconnection.php') ?>
<?php include('../config/session_check.php') ?>
<?php
$tblname = "aavedan";
$tblkey = "id";
$pagename = "नया आवेदन भरे";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    // Retrieve posted values
    $file_no = mysqli_real_escape_string($conn, $_POST['file_no']);
    $date = mysqli_real_escape_string($conn, $_POST['date']);
    $aavak_no = mysqli_real_escape_string($conn, $_POST['aavak_no']);
    $choose_aavedak_vibhag = mysqli_real_escape_string($conn, $_POST['choose_aavedak_vibhag']);
    $a_phone_number = mysqli_real_escape_string($conn, $_POST['a_phone_number']);
    $a_aavedak_name = mysqli_real_escape_string($conn, $_POST['a_aavedak_name']);
    $a_district_id = mysqli_real_escape_string($conn, $_POST['a_district_id']);
    $a_vidhansabha_id = mysqli_real_escape_string($conn, $_POST['a_vidhansabha_id']);
    $a_vikaskhand_id = mysqli_real_escape_string($conn, $_POST['a_vikaskhand_id']);
    $a_sector_id = mysqli_real_escape_string($conn, $_POST['a_sector_id']);
    $a_gram_panchayat_id = mysqli_real_escape_string($conn, $_POST['a_gram_panchayat_id']);
    $a_gram_id = mysqli_real_escape_string($conn, $_POST['a_gram_id']);
    $area_id = mysqli_real_escape_string($conn, $_POST['area_id']);
    $a_subject = mysqli_real_escape_string($conn, $_POST['a_subject']);
    $a_reference = mysqli_real_escape_string($conn, $_POST['a_reference']);
    $a_office_name = mysqli_real_escape_string($conn, $_POST['a_office_name']);
    $a_jaavak_vibhag = mysqli_real_escape_string($conn, $_POST['a_jaavak_vibhag']);
    $a_kisko_presit = mysqli_real_escape_string($conn, $_POST['a_kisko_presit']);
    $a_jaavak_date = mysqli_real_escape_string($conn, $_POST['a_jaavak_date']);
    $a_application_date = mysqli_real_escape_string($conn, $_POST['a_application_date']);
    $a_mantri_comment = mysqli_real_escape_string($conn, $_POST['a_mantri_comment']);

    $v_aavak_vibhag = mysqli_real_escape_string($conn, $_POST['v_aavak_vibhag']);
    $v_subject = mysqli_real_escape_string($conn, $_POST['v_subject']);
    $v_reference = mysqli_real_escape_string($conn, $_POST['v_reference']);
    $v_office_name = mysqli_real_escape_string($conn, $_POST['v_office_name']);
    $v_jaavak_vibhag = mysqli_real_escape_string($conn, $_POST['v_jaavak_vibhag']);
    $v_kisko_presit = mysqli_real_escape_string($conn, $_POST['v_kisko_presit']);
    $v_jaavak_date = mysqli_real_escape_string($conn, $_POST['v_jaavak_date']);
    $v_aadesh_date = mysqli_real_escape_string($conn, $_POST['v_aadesh_date']);
    $v_mantri_comment = mysqli_real_escape_string($conn, $_POST['v_mantri_comment']);
    // $a_file_upload_1 = $_FILES['a_file_upload_1'];
    // $a_file_upload_2 = $_FILES['a_file_upload_2'];
    // $v_file_upload_1 = $_FILES['v_file_upload_1'];
    // $v_file_upload_2 = $_FILES['v_file_upload_2'];

    //    ===================================================================================
    // File upload handling
    $uploadOk = "";
    $target_dir = "uploads/";
    $maxSize = 5000000; // 5 MB
    $allowedTypes = ["jpg", "png", "pdf"];

    // Initialize variables
    $a_file_upload1 = $a_file_upload2 = $v_file_upload1 = $v_file_upload2 = ['success' => false, 'filePath' => ''];

    // Call the function for each file upload if the file is set
    if (isset($_FILES['a_file_upload_1']) && !empty($_FILES['a_file_upload_1']['name']))
        $a_file_upload1 = handleFileUpload('a_file_upload_1', $target_dir, $maxSize, $allowedTypes);
    if (isset($_FILES['a_file_upload_2']) && !empty($_FILES['a_file_upload_2']['name']))
        $a_file_upload2 = handleFileUpload('a_file_upload_2', $target_dir, $maxSize, $allowedTypes);
    if (isset($_FILES['v_file_upload_1']) && !empty($_FILES['v_file_upload_1']['name']))
        $v_file_upload1 = handleFileUpload('v_file_upload_1', $target_dir, $maxSize, $allowedTypes);
    if (isset($_FILES['v_file_upload_2']) && !empty($_FILES['v_file_upload_2']['name']))
        $v_file_upload2 = handleFileUpload('v_file_upload_2', $target_dir, $maxSize, $allowedTypes);


    // Debug information for file paths
    // echo "<pre>";
    // print_r($a_file_upload1);
    // print_r($a_file_upload2);
    // print_r($v_file_upload1);
    // print_r($v_file_upload2);
    // echo "</pre>";

    // die;
    if (!empty($a_file_upload1['success']) || !empty($a_file_upload2['success']) || !empty($v_file_upload1['success']) || !empty($v_file_upload2['success'])) {
        // echo "At least one file was uploaded successfully.";
        $uploadOk = 1;
        $a_file1_path = $a_file_upload1['filePath'];
        $a_file2_path = $a_file_upload2['filePath'];
        $v_file1_path = $v_file_upload1['filePath'];
        $v_file2_path = $v_file_upload2['filePath'];
    } else {
        // echo "File upload failed.";
        $uploadOk = 0;
    }
    // die;
    //    ===================================================================================


    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 1) {
        $sql = "INSERT INTO $tblname (file_no, date, aavak_no, choose_aavedak_vibhag, a_phone_number, a_aavedak_name, a_district_id, a_vidhansabha_id, a_vikaskhand_id, a_sector_id, a_gram_panchayat_id, a_gram_id, a_subject, a_reference, a_file_upload_1, a_office_name, a_jaavak_vibhag, a_kisko_presit, a_jaavak_date, a_application_date, a_file_upload_2, a_mantri_comment, v_aavak_vibhag, v_subject, v_reference, v_file_upload_1, v_office_name, v_jaavak_vibhag, v_kisko_presit, v_jaavak_date, v_aadesh_date, v_file_upload_2, v_mantri_comment, status, area_id) VALUES ('$file_no', '$date', '$aavak_no', '$choose_aavedak_vibhag', '$a_phone_number', '$a_aavedak_name', '$a_district_id', '$a_vidhansabha_id', '$a_vikaskhand_id', '$a_sector_id', '$a_gram_panchayat_id', '$a_gram_id', '$a_subject', '$a_reference', '$a_file1_path', '$a_office_name', '$a_jaavak_vibhag', '$a_kisko_presit', '$a_jaavak_date', '$a_application_date', '$a_file2_path', '$a_mantri_comment', '$v_aavak_vibhag', '$v_subject', '$v_reference', '$v_file1_path', '$v_office_name', '$v_jaavak_vibhag', '$v_kisko_presit', '$v_jaavak_date', '$v_aadesh_date', '$v_file2_path', '$v_mantri_comment', '0', '$area_id')";
        // echo $sql;
        if (mysqli_query($conn, $sql)) {
            $msg = "<div class='msg-container'><b class='alert alert-success msg'>Data inserted successfully.</b></div>";
        } else {
            $msg = "<div class='msg-container'><b class='alert alert-danger msg'>Error: " . $sql . "<br>" . mysqli_error($conn) . "</b></div>";
        }
    } else {
        $msg = "<div class='msg-container'><b class='alert alert-danger msg'>Sorry, your file was not uploaded.</b></div>";
    }
}
?>

<!-- Staring page -->
<?php include('../includes/header.php') ?>
<?php include('../includes/sidebar.php') ?>
<?php include('../includes/navbar.php') ?>

<style>
    input[type="file"]::file-selector-button {
        color: #00698f;
        /* change the text color to blue */
        background-color: white;
        /* change the background color to light gray */
        border: none;
    }
</style>
<!-- Start New aavedan Form -->
<form action="" method="POST" enctype="multipart/form-data">
    <div class="container-fluid pt-4 px-4 ">
        <h4 class="text-center fw-bolder text-primary mb-3"><?= $pagename; ?></h4>
        <div class="row mt-5">
            <div class="col-lg-6 col-md-12 col-sm-12 align-content-center">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="file_no" id="file_no" placeholder=" " onkeypress='return event.charCode >= 48 && event.charCode <= 57' required>
                        <label for="file_no">फाइल क्र <span class="text-danger">*</span> </label>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <input type="date" class="form-control" maxlength="10" name="date" id="date" placeholder=" " required>
                        <label for="date">दिनांक<span class="text-danger">*</span></label>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" maxlength="10" name="aavak_no" id="aavak_no" placeholder=" " onkeypress='return event.charCode >= 48 && event.charCode <= 57' required>
                        <label for="aavak_no">आवक क्र <span class="text-danger">*</span></label>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group shadow">
                    <div class="form-floating mb-3 border-3 d-flex align-items-center" style="height: 55px;">
                        <div class="form-check form-check-inline">
                            <input type="radio" class="form-check-input" name="choose_aavedak_vibhag" value="1" id="choose_aavedak_vibhag_1" onchange="formChange(this.value)" checked>
                            <label class="form-check-label" for="choose_aavedak_vibhag_1">आवेदक <span class="text-danger">*</span></label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input type="radio" class="form-check-input" name="choose_aavedak_vibhag" value="2" id="choose_aavedak_vibhag_2" onchange="formChange(this.value)">
                            <label class="form-check-label" for="choose_aavedak_vibhag_2">विभाग <span class="text-danger">*</span></label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid px-4" id="aavedak_form">
        <div class="row">
            <!-- आवेदक का form -->
            <div class="col-lg-6">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" maxlength="10" name="a_phone_number" id="a_phone_number" placeholder="आवेदक का फ़ोन नंबर" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                        <label for="a_phone_number">आवेदक का फ़ोन नंबर <span class="text-danger">*</span></label>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="a_aavedak_name" id="a_aavedak_name" placeholder="आवेदक का नाम">
                        <label for="a_aavedak_name">आवेदक का नाम <span class="text-danger">*</span> </label>
                    </div>

                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <select name="a_district_id" id="districtSelect" class="form-select form-control bg-white">
                            <?php
                            // Fetch districts for dropdown
                            $district_query = "SELECT * FROM district_master";
                            $district_result = mysqli_query($conn, $district_query);
                            ?>

                            <option value=" ">जिला का नाम चुनें</option>
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
            <div class="col-lg-6">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <select name="a_vidhansabha_id" id="vidhansabhaSelect" class="form-select form-control bg-white ">
                            <option value=" ">विधानसभा का नाम चुनें</option>
                            <!-- Options for vidhansabha will go here -->
                        </select>
                        <label for="vidhansabha">विधानसभा<span class="text-danger">*</span></label>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <select name="area_id" id="areaSelect" class="form-select form-control bg-white">
                            <option >क्षेत्र का नाम चुनें</option>
                            <!-- Options for area will go here -->
                             
                        </select>
                        <label for="areaSelect">क्षेत्र का नाम चुनें <span class="text-danger">*</span></label>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <select name="a_vikaskhand_id" id="vikaskhandSelect" class="form-select form-control bg-white">
                            <option value=" ">विकासखंड का नाम चुनें</option>
                            <!-- Option Load By AJAX -->

                        </select>
                        <label for="vikaskhand">विकासखंड <span class="text-danger">*</span> </label>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <select name="a_sector_id" id="sectorSelect" class="form-select form-control bg-white">
                            <option value=" ">सेक्टर का नाम चुनें</option>
                            <!-- Options for sectors will go here -->
                        </select>
                        <label for="sector">सेक्टर <span class="text-danger">*</span> </label>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <select name="a_gram_panchayat_id" id="gramPanchayatSelect" class="form-select form-control bg-white">
                            <option value=" ">ग्राम पंचायत का नाम चुनें</option>
                            <!-- Options for panchayat will go here -->
                        </select>
                        <label for="gram_panchayt">ग्राम पंचायत <span class="text-danger">*</span> </label>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <select class="form-select" id="gramSelect" name="a_gram_id">
                            <option value=" ">ग्राम का नाम चुनें</option>
                            <!-- by load ajax -->
                        </select>
                        <label for="gram">ग्राम <span class="text-danger">*</span></label>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="a_subject" placeholder="विषय" name="a_subject">
                        <label for="a_subject">विषय का नाम <span class="text-danger">*</span> </label>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="a_reference" placeholder="द्वारा" name="a_reference">
                        <label for="a_reference">द्वारा <span class="text-danger">*</span> </label>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group shadow">
                    <div class="form-floating mb-3 ">
                        <input type="file" class="form-control bg-white" id="a_file_upload_1" placeholder="फाइल अपलोड करें" name="a_file_upload_1">
                        <label for="a_file_upload_1">फाइल अपलोड करे <span class="text-danger">*</span> </label>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <select class="form-select" id="a_office_name" name="a_office_name">
                            <option value=" ">ऑफिस का नाम चुनें</option>
                            <option value="टेक्नोलॉजी 1">टेक्नोलॉजी 1</option>
                            <option value="टेक्नोलॉजी 2">टेक्नोलॉजी 2</option>
                        </select>
                        <label for="a_office_name">ऑफिस <span class="text-danger">*</span></label>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <select class="form-select" id="a_jaavak_vibhag" name="a_jaavak_vibhag">
                            <option value=" ">जावक विभाग का नाम चुनें</option>
                            <?php
                            $vibhag_result = mysqli_query($conn, "select * from vibhag_master where 1");
                            mysqli_data_seek($vibhag_result, 0); // Reset pointer to fetch districts again
                            while ($vibhag_row = mysqli_fetch_assoc($vibhag_result)) {
                                $selected = ($vibhag_row['vibhag_id'] == $vibhag_id) ? 'selected' : '';
                                echo "<option value='" . $vibhag_row['vibhag_id'] . "' $selected>" . $vibhag_row['vibhag_name'] . "</option>";
                            }
                            ?>
                        </select>
                        <label for="a_jaavak_vibhag">जावक विभाग <span class="text-danger">*</span></label>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="a_kisko_presit" id="a_kisko_presit" placeholder="पद का नाम">
                        <label for="a_kisko_presit">किसको प्रेषित किया गया <span class="text-danger">*</span> </label>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <?php
                        // Set default current date
                        $currentDate = date('Y-m-d'); // Format: YYYY-MM-DD
                        ?>
                        <input type="date" class="form-control" id="a_jaavak_date" value="<?= $currentDate ?>" placeholder="आवेदन दिनांक" name="a_jaavak_date">
                        <label for="a_jaavak_date">जावक दिनांक<span class="text-danger">*</span> </label>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <?php
                        // Set default current date
                        $currentDate = date('Y-m-d'); // Format: YYYY-MM-DD
                        ?>
                        <input type="date" class="form-control" id="a_application_date" value="<?= $currentDate ?>" placeholder="आवेदन दिनांक" name="a_application_date">
                        <label for="a_application_date">आदेश दिनांक<span class="text-danger">*</span> </label>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group shadow">
                    <div class="form-floating mb-3 ">
                        <input type="file" class="form-control bg-white" id="a_file_upload_2" placeholder="फाइल अपलोड करें" name="a_file_upload_2">
                        <label for="a_file_upload_2">फाइल अपलोड करें <span class="text-danger">*</span> </label>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <textarea class="form-control" id="a_mantri_comment" placeholder="टिप्पणी" style="height: 150px;" name="a_mantri_comment"></textarea>
                        <label for="a_mantri_comment">मंत्री जी की टिप <span class="text-danger">*</span> </label>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 text-center">
                <div class="form-group">
                    <button class="col-12 text-white btn  text-center shadow" type="submit" style="background-color:#4ac387;" name="submit"><b>Submit</b></button>
                </div>
            </div>
            <!--  -->
        </div>
    </div>

    <div class="container-fluid px-4 " id="vibhag_form">
        <div class="row">
            <!-- विभाग का form  -->
            <div class="col-lg-6">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <select class="form-select" id="v_aavak_vibhag" name="v_aavak_vibhag">
                            <option value=" ">विभाग चुनें</option>
                            <?php
                            $vibhag_result = mysqli_query($conn, "select * from vibhag_master where 1");
                            mysqli_data_seek($vibhag_result, 0); // Reset pointer to fetch districts again
                            while ($vibhag_row = mysqli_fetch_assoc($vibhag_result)) {
                                $selected = ($vibhag_row['vibhag_id'] == $vibhag_id) ? 'selected' : '';
                                echo "<option value='" . $vibhag_row['vibhag_id'] . "' $selected>" . $vibhag_row['vibhag_name'] . "</option>";
                            }
                            ?>
                        </select>
                        <label for="v_aavak_vibhag">आवक विभाग <span class="text-danger">*</span></label>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="v_subject" placeholder="विषय" name="v_subject">
                        <label for="v_subject">विषय <span class="text-danger">*</span> </label>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="v_reference" placeholder="द्वारा" name="v_reference">
                        <label for="v_reference">द्वारा <span class="text-danger">*</span> </label>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group shadow">
                    <div class="form-floating mb-3 ">
                        <input type="file" class="form-control bg-white" id="v_file_upload_1" placeholder="फाइल अपलोड करें" name="v_file_upload_1">
                        <label for="v_file_upload_1">फाइल अपलोड करें <span class="text-danger">*</span> </label>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <select class="form-select" id="v_office_name" name="v_office_name">
                            <option value=" ">ऑफिस का नाम चुनें</option>
                            <option value="टेक्नोलॉजी 1">टेक्नोलॉजी 1</option>
                            <option value="टेक्नोलॉजी 2">टेक्नोलॉजी 2</option>
                        </select>
                        <label for="v_office_name">ऑफिस <span class="text-danger">*</span></label>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <select class="form-select" id="v_jaavak_vibhag" name="v_jaavak_vibhag">
                            <option value=" ">जावक विभाग का नाम चुनें</option>
                            <?php
                            $vibhag_result = mysqli_query($conn, "select * from vibhag_master where 1");
                            mysqli_data_seek($vibhag_result, 0); // Reset pointer to fetch districts again
                            while ($vibhag_row = mysqli_fetch_assoc($vibhag_result)) {
                                $selected = ($vibhag_row['vibhag_id'] == $vibhag_id) ? 'selected' : '';
                                echo "<option value='" . $vibhag_row['vibhag_id'] . "' $selected>" . $vibhag_row['vibhag_name'] . "</option>";
                            }
                            ?>
                        </select>
                        <label for="v_jaavak_vibhag">जावक विभाग <span class="text-danger">*</span></label>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="v_kisko_presit" id="v_kisko_presit" placeholder="पद का नाम">
                        <label for="v_kisko_presit">किसको प्रेषित किया गया <span class="text-danger">*</span> </label>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <?php
                        // Set default current date
                        $currentDate = date('Y-m-d'); // Format: YYYY-MM-DD
                        ?>
                        <input type="date" class="form-control" id="v_jaavak_date" placeholder="आवेदन दिनांक" name="v_jaavak_date">
                        <label for="v_jaavak_date">जावक दिनांक <span class="text-danger">*</span> </label>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <?php
                        // Set default current date
                        $currentDate = date('Y-m-d'); // Format: YYYY-MM-DD
                        ?>
                        <input type="date" class="form-control" id="v_aadesh_date" placeholder="आवेदन दिनांक" name="v_aadesh_date">
                        <label for="v_aadesh_date">आदेश दिनांक <span class="text-danger">*</span> </label>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group shadow">
                    <div class="form-floating mb-3 ">
                        <input type="file" class="form-control bg-white" id="v_file_upload_2" placeholder="फाइल अपलोड करें" name="v_file_upload_2">
                        <label for="v_file_upload_2">फाइल अपलोड करें <span class="text-danger">*</span> </label>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <textarea class="form-control" id="v_mantri_comment" placeholder="टिप्पणी" style="height: 150px;" name="v_mantri_comment"></textarea>
                        <label for="v_mantri_comment">मंत्री जी की टिप <span class="text-danger">*</span> </label>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 text-center">
                <div class="form-group">
                    <button class="col-12 text-white btn  text-center shadow" type="submit" style="background-color:#4ac387;" name="submit"><b>Submit</b></button>
                </div>
            </div>
        </div>
    </div>

</form>
<!-- New aavedan close -->
<script>
    function formChange(aa) {
        // Get the radio buttons and forms
        const radioAavedak = document.getElementById('choose_aavedak_vibhag_1');
        const radioVibhag = document.getElementById('choose_aavedak_vibhag_2');
        const aavedakForm = document.getElementById('aavedak_form');
        const vibhagForm = document.getElementById('vibhag_form');

        // Toggle forms based on the value of aa
        if (aa == 1) {
            aavedakForm.style.display = 'block';
            vibhagForm.style.display = 'none';
        } else if (aa == 2) {
            aavedakForm.style.display = 'none';
            vibhagForm.style.display = 'block';
        }
    }
    window.onload = function() {
        formChange(1);
    };
</script>
<?php include('../includes/footer.php'); ?>