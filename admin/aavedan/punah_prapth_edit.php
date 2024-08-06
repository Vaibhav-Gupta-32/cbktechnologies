<?php include('../config/dbconnection.php') ?>
<?php include('../config/session_check.php') ?>
<?php
$tblname = "aavedan";
$tblkey = "id";
$pagename = "विवरण बदले";

// $vikaskhand_name = "";
$vidhansabha_id = "";
$district_id = "";
$vikaskhand_id = "";
$sector_id = "";
$gram_id = "";
$gram_panchayat_id = "";
$name="";




// Fetch districts for dropdown
$district_query = "SELECT * FROM district_master";
$district_result = mysqli_query($conn, $district_query);
// echo $_REQUEST['edit_id'];
// View Id Received
if (isset($_REQUEST['edit_id'])) {
    $edit_id = $_REQUEST['edit_id']; // Add this line
    $edit_query = "SELECT * FROM $tblname WHERE $tblkey='$edit_id'";
    // echo $edit_query;die;
    $fetch = mysqli_fetch_array(mysqli_query($conn, $edit_query));
    $id = $fetch['id'];
    $file_no = $fetch['file_no'];
    $date = $fetch['date'];
    $aavak_no = $fetch['aavak_no'];
    $choose_aavedak_vibhag = $fetch['choose_aavedak_vibhag'];
    $a_phone_number = $fetch['a_phone_number'];
    $a_aavedak_name = $fetch['a_aavedak_name'];
    $a_district_id = $fetch['a_district_id'];
    $a_vidhansabha_id = $fetch['a_vidhansabha_id'];
    $a_vikaskhand_id = $fetch['a_vikaskhand_id'];
    $a_sector_id = $fetch['a_sector_id'];
    $a_gram_panchayat_id = $fetch['a_gram_panchayat_id'];
    $a_gram_id = $fetch['a_gram_id'];
    // $a_vidhansabha_name = $fetch['a_vidhansabha_name'];
    // $a_vikaskhand_name = $fetch['a_vikaskhand_name'];
    // $a_sector_name = $fetch['a_sector_name'];
    // $a_gram_panchayat_name = $fetch['a_gram_panchayat_name'];
    // $a_gram_name = $fetch['a_gram_name'];
    $a_subject = $fetch['a_subject'];
    $a_reference = $fetch['a_reference'];
    $a_file_upload_1 = $fetch['a_file_upload_1'];
    $a_office_name = $fetch['a_office_name'];
    $a_jaavak_vibhag = $fetch['a_jaavak_vibhag'];
    $a_kisko_presit = $fetch['a_kisko_presit'];
    $a_jaavak_date = $fetch['a_jaavak_date'];
    $a_application_date = $fetch['a_application_date'];
    $a_file_upload_2 = $fetch['a_file_upload_2'];
    $a_mantri_comment = $fetch['a_mantri_comment'];
    $a_punah_prapth = $fetch['a_punah_prapth'];
    $a_punah_prapth_date = $fetch['a_punah_prapth_date'];
    $area_idd = $fetch['area_id'];
    
    $v_mantri_comment = $fetch['v_mantri_comment'];
    $v_aavak_vibhag = $fetch['v_aavak_vibhag'];
    $v_subject = $fetch['v_subject'];
    $v_reference = $fetch['v_reference'];
    $v_file_upload_1 = $fetch['v_file_upload_1'];
    $v_office_name = $fetch['v_office_name'];
    $v_jaavak_vibhag = $fetch['v_jaavak_vibhag'];
    $v_kisko_presit = $fetch['v_kisko_presit'];
    $v_jaavak_date = $fetch['v_jaavak_date'];
    $v_aadesh_date = $fetch['v_aadesh_date'];
    $v_file_upload_2 = $fetch['v_file_upload_2'];
    $v_punah_prapth = $fetch['v_punah_prapth'];
    $v_punah_prapth_date = $fetch['v_punah_prapth_date'];
}
?>




<!-- Include jQuery library
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->

<!-- Start New Prastavit Edit Form -->
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
    <div class="container-fluid pt-4 px-4 ">
        <h4 class="text-center fw-bolder text-primary mb-3"><?= $pagename; ?></h4>
        <hr class="text-danger p-2 rounded">
        <div class="row mt-5">
            <div class="col-lg-6 align-content-center">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="file_no" id="file_no" placeholder=" " required value="<?= $file_no ?>">
                        <label for="file_no">फाइल क्र <span class="text-danger">*</span> </label>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" maxlength="10" name="date" id="date" placeholder=" " required value="<?= date('d-m-Y', strtotime($date)) ?>">
                        <label for="date">दिनांक<span class="text-danger">*</span></label>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" maxlength="10" name="aavak_no" id="aavak_no" placeholder=" " required value="<?= $aavak_no ?>">
                        <label for="aavak_no">आवक क्र <span class="text-danger">*</span></label>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="form-group shadow" style="background-color: #e9ecef;">
                    <div class="form-floating mb-3 border-3 d-flex align-items-center" style="height: 55px;">
                        <div class="form-check form-check-inline">
                            <input type="radio" class="form-check-input" name="choose_aavedak_vibhag" value="1" <?= ($choose_aavedak_vibhag == 1) ? 'checked' : ''; ?> disabled>
                            <label class="form-check-label" for="choose_aavedak_vibhag_1">आवेदक <span class="text-danger">*</span></label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input type="radio" class="form-check-input" name="choose_aavedak_vibhag" value="2" <?= ($choose_aavedak_vibhag == 2) ? 'checked' : ''; ?> disabled>
                            <label class="form-check-label" for="choose_aavedak_vibhag_2">विभाग <span class="text-danger">*</span></label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php if ($choose_aavedak_vibhag == 1) { ?>
        <div class="container-fluid px-4" id="aavedak_form">
            <div class="row">
                <!-- आवेदक का form -->
                <div class="col-lg-4">
                    <div class="form-group shadow">
                        <div class="form-floating mb-3">
                            <input type="hidden" class="form-control " name="edit_id" id="id" placeholder=" " value="<?= $id ?>">
                            <input type="text" class="form-control " maxlength="10" name="a_phone_number" id="a_phone_number" placeholder=" " value="<?= $a_phone_number ?>" >
                            <label for="a_phone_number">आवेदक का फ़ोन नंबर <span class="text-danger">*</span></label>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group shadow">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" name="a_aavedak_name" id="a_aavedak_name" placeholder=" " value="<?= $a_aavedak_name ?>" >
                            <label for="a_aavedak_name">आवेदक का नाम <span class="text-danger">*</span> </label>
                        </div>

                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group shadow">
                        <div class="form-floating mb-3">
                            <select name="a_district_id" id="districtSelect" class="form-select form-control bg-white">
                                <?php
                                // Fetch districts for dropdown
                                $district_query = "SELECT * FROM district_master";
                                $district_result = mysqli_query($conn, $district_query);
                                ?>

                                <option selected>जिला का नाम चुनें</option>
                                <?php
                                while ($district_row = mysqli_fetch_assoc($district_result)) {
                                    $selected = ($district_row['district_id'] == $a_district_id) ? 'selected' : '';
                                    echo "<option value='" . $district_row['district_id'] . "' $selected>" . $district_row['district_name'] . "</option>";
                                }
                                ?>
                            </select>
                            <label for="districtSelect">जिला <span class="text-danger">*</span></label>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group shadow">
                        <div class="form-floating mb-3">
                            <select name="a_vidhansabha_id" id="vidhansabhaSelect" class="form-select form-control bg-white" required>
                                <option>विधानसभा का नाम चुनें</option>
                                <?php
                                if (isset($a_vidhansabha_id) && !empty($a_vidhansabha_id)) {
                                    $vidhansabha_query = "SELECT * FROM vidhansabha_master WHERE district_id = '$a_district_id'";
                                    $vidhansabha_result = mysqli_query($conn, $vidhansabha_query);
                                    while ($vidhansabha_row = mysqli_fetch_assoc($vidhansabha_result)) {
                                        $selected = ($vidhansabha_row['vidhansabha_id'] == $a_vidhansabha_id) ? 'selected' : '';
                                        echo "<option value='" . $vidhansabha_row['vidhansabha_id'] . "' $selected>" . $vidhansabha_row['vidhansabha_name'] . "</option>";
                                    }
                                }
                                ?>
                            </select>
                            <label for="vidhansabha">विधानसभा का नाम चुनें <span class="text-danger">*</span></label>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="form-group shadow">
                        <div class="form-floating mb-3">
                            <select name="area_id" id="areaSelect" class="form-select form-control bg-white" required>
                                <option>क्षेत्र का नाम चुनें</option>
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
                            <label for="areaSelect">क्षेत्र का नाम चुनें <span class="text-danger">*</span></label>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="form-group shadow">
                        <div class="form-floating mb-3">
                            <select name="a_vikaskhand_id" id="vikaskhandSelect" class="form-select form-control bg-white" required>
                                <option selected>विकासखंड का नाम चुनें</option>
                                <?php
                                if (isset($a_vikaskhand_id) && !empty($a_vikaskhand_id)) {
                                    $vikaskhand_query = "SELECT * FROM vikaskhand_master WHERE vidhansabha_id = '$a_vidhansabha_id'";
                                    $vikaskhand_result = mysqli_query($conn, $vikaskhand_query);
                                    while ($vikaskhand_row = mysqli_fetch_assoc($vikaskhand_result)) {
                                        $selected = ($vikaskhand_row['vikaskhand_id'] == $a_vikaskhand_id) ? 'selected' : '';
                                        echo "<option value='" . $vikaskhand_row['vikaskhand_id'] . "' $selected>" . $vikaskhand_row['vikaskhand_name'] . "</option>";
                                    }
                                }
                                ?>
                            </select>
                            <label for="vikaskhand">विकासखंड का नाम चुनें <span class="text-danger">*</span></label>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="form-group shadow">
                        <div class="form-floating mb-3">
                            <select name="a_sector_id" id="sectorSelect" class="form-select form-control bg-white" required>
                                <option selected>सेक्टर का नाम चुनें</option>
                                <?php
                                if (isset($a_sector_id) && !empty($a_sector_id)) {
                                    $sector_query = "SELECT * FROM sector_master WHERE vikaskhand_id = '$a_vikaskhand_id'";
                                    $sector_result = mysqli_query($conn, $sector_query);
                                    while ($sector_row = mysqli_fetch_assoc($sector_result)) {
                                        $selected = ($sector_row['sector_id'] == $a_sector_id) ? 'selected' : '';
                                        echo "<option value='" . $sector_row['sector_id'] . "' $selected>" . $sector_row['sector_name'] . "</option>";
                                    }
                                }
                                ?>
                            </select>
                            <label for="sector">सेक्टर का नाम चुनें <span class="text-danger">*</span></label>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group shadow">
                        <div class="form-floating mb-3">
                            <select name="a_gram_panchayat_id" id="gramPanchayatSelect" class="form-select form-control bg-white" required>
                                <option selected>ग्राम पंचायत का नाम चुनें</option>
                                <?php
                                if (isset($a_gram_panchayat_id) && !empty($a_gram_panchayat_id)) {
                                    $gram_panchayat_query = "SELECT * FROM gram_panchayat_master WHERE sector_id = '$a_sector_id'";
                                    $gram_panchayat_result = mysqli_query($conn, $gram_panchayat_query);
                                    while ($gram_panchayat_row = mysqli_fetch_assoc($gram_panchayat_result)) {
                                        $selected = ($gram_panchayat_row['gram_panchayat_id'] == $a_gram_panchayat_id) ? 'selected' : '';
                                        echo "<option value='" . $gram_panchayat_row['gram_panchayat_id'] . "' $selected>" . $gram_panchayat_row['gram_panchayat_name'] . "</option>";
                                    }
                                }
                                ?>
                            </select>
                            <label for="gram_panchayt">ग्राम पंचायत का नाम चुनें <span class="text-danger">*</span></label>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group shadow">
                        <div class="form-floating mb-3">
                            <select class="form-select" id="gramSelect" class="form-select form-control bg-white" name="a_gram_id" required>
                                <option selected>ग्राम का नाम चुनें</option>
                                <?php
                                if (isset($a_gram_id) && !empty($a_gram_id)) {
                                    $gram_query = "SELECT * FROM gram_master WHERE gram_panchayat_id='$a_gram_panchayat_id'";
                                    $gram_result = mysqli_query($conn, $gram_query);
                                    while ($gram_row = mysqli_fetch_assoc($gram_result)) {
                                        $selected = ($gram_row['gram_id'] == $a_gram_id) ? 'selected' : '';
                                        echo "<option value='" . $gram_row['gram_id'] . "' $selected>" . $gram_row['gram_name'] . "</option>";
                                    }
                                }
                                ?>
                            </select>
                            <label for="gram">ग्राम का नाम चुनें <span class="text-danger">*</span></label>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group shadow">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="a_subject" placeholder="विषय" name="a_subject" value="<?= $a_subject ?>">
                            <label for="a_subject">विषय का नाम <span class="text-danger">*</span> </label>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group shadow">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="a_reference" placeholder="द्वारा" name="a_reference" value="<?= $a_reference ?>">
                            <label for="a_reference">द्वारा <span class="text-danger">*</span> </label>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group shadow">
                        <div class="form-floating mb-3 input-group">
                            <input type="hidden" class="form-control" name="a_existing_file_1" value="<?= $a_file_upload_1 ?>">
                            <input type="file" class="form-control" id="a_file_upload_1" name="a_file_upload_1" value="<?= $a_file_upload_1 ?>">
                            <label for="a_file_upload_1"> अपलोडेड फाइल </label>
                            <span class="input-group-text bg-">
                                <a href="uploads/<?= $a_file_upload_1 ?>" target="_blank" class=" p-0"><i class="fas fa-eye fa-lg"></i></a>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group shadow">
                        <div class="form-floating mb-3">
                            <select class="form-select" id="a_office_name" name="a_office_name">
                                <option>ऑफिस का नाम चुनें</option>
                                <option value="टेक्नोलॉजी 1">टेक्नोलॉजी 1</option>
                                <option value="टेक्नोलॉजी 2">टेक्नोलॉजी 2</option>
                            </select>
                            <label for="a_office_name">ऑफिस <span class="text-danger">*</span></label>
                        </div>
                        <script>
                            document.getElementById('a_office_name').value = "<?= $a_office_name ?>";
                        </script>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group shadow">
                        <div class="form-floating mb-3">
                            <select class="form-select" id="a_jaavak_vibhag" name="a_jaavak_vibhag">
                                <option selected>जावक विभाग का नाम चुनें</option>
                                <?php
                                $vibhag_result = mysqli_query($conn, "select * from vibhag_master where 1");
                                mysqli_data_seek($vibhag_result, 0); // Reset pointer to fetch districts again
                                while ($vibhag_row = mysqli_fetch_assoc($vibhag_result)) {
                                    $selected = ($vibhag_row['vibhag_id'] == $a_jaavak_vibhag) ? 'selected' : '';
                                    echo "<option value='" . $vibhag_row['vibhag_id'] . "' $selected>" . $vibhag_row['vibhag_name'] . "</option>";
                                }
                                ?>
                            </select>
                            <label for="a_jaavak_vibhag">जावक विभाग <span class="text-danger">*</span></label>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group shadow">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" name="a_kisko_presit" id="a_kisko_presit" placeholder="पद का नाम" value="<?= $a_kisko_presit ?>" >
                            <label for="a_kisko_presit">किसको प्रेषित किया गया <span class="text-danger">*</span> </label>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group shadow">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="a_jaavak_date" value="<?= $a_jaavak_date ?>" placeholder="आवेदन दिनांक" name="a_jaavak_date">
                            <label for="a_jaavak_date">जावक दिनांक<span class="text-danger">*</span> </label>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group shadow">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="a_application_date" value="<?= $a_application_date ?>" placeholder="आवेदन दिनांक" name="a_application_date">
                            <label for="a_application_date">आदेश दिनांक<span class="text-danger">*</span> </label>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group shadow">
                        <div class="form-floating mb-3 input-group">
                        <input type="hidden" class="form-control" name="a_existing_file_2" value="<?= $a_file_upload_2 ?>">
                            <input type="file" class="form-control" id="a_file_upload_2" name="a_file_upload_2" value="<?= $a_file_upload_2 ?>">
                            <label for="a_file_upload_2"> अपलोडेड फाइल </label>
                            <span class="input-group-text bg-">
                                <a href="uploads/<?= $a_file_upload_2 ?>" target="_blank" class=" p-0"><i class="fas fa-eye fa-lg"></i></a>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="form-group shadow">
                        <div class="form-floating mb-3">
                            <textarea class="form-control" id="a_mantri_comment" placeholder="टिप्पणी" style="height: 150px;" name="a_mantri_comment"><?= $a_mantri_comment ?></textarea>
                            <label for="a_mantri_comment">मंत्री जी की टिप <span class="text-danger">*</span> </label>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group shadow">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="a_punah_prapth" placeholder=" " value="<?=$a_punah_prapth?>" name="a_punah_prapth">
                            <label for="a_punah_prapth">पुनः प्राप्त<span class="text-danger">*</span> </label>
                        </div>
                    </div>
                </div> 
                <div class="col-lg-6">
                    <div class="form-group shadow">
                        <div class="form-floating mb-3">
                            <input type="date" class="form-control" id="a_punah_prapth_date" placeholder=" " value="<?=$a_punah_prapth_date?>" name="a_punah_prapth_date">
                            <label for="a_punah_prapth_date">पुनः प्राप्त दिनांक<span class="text-danger">*</span> </label>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 text-center">
                    <div class="form-group">
                        <button class="col-12 text-white btn  text-center shadow" type="submit" style="background-color:#4ac387;" name="Update"><b>Submit</b></button>
                    </div>
                </div>
            </div>
        </div>
    <?php } else if ($choose_aavedak_vibhag == 2) { ?>
        <div class="container-fluid px-4 " id="vibhag_form">
            <div class="row">
                <!-- विभाग का form  -->
                <input type="hidden" class="form-control " name="edit_id" id="id" placeholder=" " value="<?= $id ?>">
                <div class="col-lg-6">
                    <div class="form-group shadow">
                        <div class="form-floating mb-3">
                            <select class="form-select" id="v_aavak_vibhag" name="v_aavak_vibhag" disabled>
                                <option>विभाग चुनें</option>
                                <?php
                                $vibhag_result = mysqli_query($conn, "select * from vibhag_master where 1");
                                mysqli_data_seek($vibhag_result, 0); // Reset pointer to fetch districts again
                                while ($vibhag_row = mysqli_fetch_assoc($vibhag_result)) {
                                    $selected = ($vibhag_row['vibhag_id'] == $v_aavak_vibhag) ? 'selected' : '';
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
                            <input type="text" class="form-control" id="v_subject" placeholder="विषय" name="v_subject" value="<?= $v_subject ?>" readonly>
                            <label for="v_subject">विषय <span class="text-danger">*</span> </label>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group shadow">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="v_reference" placeholder="द्वारा" name="v_reference" value="<?= $v_reference ?>" readonly>
                            <label for="v_reference">द्वारा <span class="text-danger">*</span> </label>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group shadow">
                        <div class="form-floating mb-3 input-group">
                        <input type="hidden" class="form-control" name="v_existing_file_1" value="<?= $v_file_upload_1 ?>">
                            <input type="text" class="form-control" id="v_file_upload_1" name="v_file_upload_1" value="<?= $v_file_upload_1 ?>" readonly>
                            <label for="v_file_upload_1"> अपलोडेड फाइल </label>
                            <span class="input-group-text bg-">
                                <a href="uploads/<?= $v_file_upload_1 ?>" target="_blank" class=" p-0"><i class="fas fa-eye fa-lg"></i></a>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group shadow">
                        <div class="form-floating mb-3">
                            <select class="form-select" id="v_office_name" name="v_office_name" disabled>
                                <option>ऑफिस का नाम चुनें</option>
                                <option value="टेक्नोलॉजी 1">टेक्नोलॉजी 1</option>
                                <option value="टेक्नोलॉजी 2">टेक्नोलॉजी 2</option>
                            </select>
                            <label for="v_office_name">ऑफिस <span class="text-danger">*</span></label>
                        </div>
                        <script>
                            document.getElementById('v_office_name').value = "<?= $v_office_name ?>";
                        </script>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group shadow">
                        <div class="form-floating mb-3">
                            <select class="form-select" id="v_jaavak_vibhag" name="v_jaavak_vibhag" disabled>
                                <option>जावक विभाग का नाम चुनें</option>
                                <?php
                                $vibhag_result = mysqli_query($conn, "select * from vibhag_master where 1");
                                mysqli_data_seek($vibhag_result, 0); // Reset pointer to fetch districts again
                                while ($vibhag_row = mysqli_fetch_assoc($vibhag_result)) {
                                    $selected = ($vibhag_row['vibhag_id'] == $v_jaavak_vibhag) ? 'selected' : '';
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
                            <input type="text" class="form-control" name="v_kisko_presit" id="v_kisko_presit" placeholder="पद का नाम" value="<?= $v_kisko_presit ?>" readonly>
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
                            <input type="text" class="form-control" id="v_jaavak_date" placeholder="आवेदन दिनांक" name="v_jaavak_date" readonly value="<?= date('d-m-Y', strtotime($v_jaavak_date)); ?>">
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
                            <input type="text" class="form-control" id="v_aadesh_date" placeholder="आवेदन दिनांक" name="v_aadesh_date" value="<?= date('d-m-Y', strtotime($v_aadesh_date)); ?>" readonly>
                            <label for="v_aadesh_date">आदेश दिनांक <span class="text-danger">*</span> </label>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group shadow">
                        <div class="form-floating mb-3 input-group">
                        <input type="hidden" class="form-control" name="v_existing_file_2" value="<?= $v_file_upload_2 ?>">
                            <input type="text" class="form-control" id="v_file_upload_2" name="v_file_upload_2" value="<?= $v_file_upload_2 ?>" readonly>
                            <label for="v_file_upload_2"> अपलोडेड फाइल </label>
                            <span class="input-group-text bg-">
                                <a href="uploads/<?= $v_file_upload_2 ?>" target="_blank" class=" p-0"><i class="fas fa-eye fa-lg"></i></a>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="form-group shadow">
                        <div class="form-floating mb-3">
                            <textarea class="form-control" id="v_mantri_comment" placeholder="टिप्पणी" style="height: 150px;" name="v_mantri_comment" readonly><?= $v_mantri_comment ?></textarea>
                            <label for="v_mantri_comment">मंत्री जी की टिप <span class="text-danger">*</span> </label>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group shadow">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="v_punah_prapth" placeholder=" " value="<?=$v_punah_prapth?>" name="v_punah_prapth" readonly>
                            <label for="v_punah_prapth">पुनः प्राप्त<span class="text-danger">*</span> </label>
                        </div>
                    </div>
                </div> 
                <div class="col-lg-6">
                    <div class="form-group shadow">
                        <div class="form-floating mb-3">
                            <input type="date" class="form-control" id="v_punah_prapth_date" placeholder=" " value="<?=$v_punah_prapth_date?>" name="v_punah_prapth_date" readonly>
                            <label for="v_punah_prapth_date">पुनः प्राप्त दिनांक<span class="text-danger">*</span> </label>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 text-center">
                    <div class="form-group">
                        <button class="col-12 text-white btn  text-center shadow" type="submit" style="background-color:#4ac387;" name="Update"><b>Submit</b></button>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
</form>
<!-- New Prastavit Edit close -->


<!-- Script For Print button -->

<script>
    $(document).ready(function() {
        $('#Print').on('click', function() {
            // Serialize the form data and store it in the hidden field
            var formData = $('form').serialize();
            $('#form_data').val(formData);

            // Submit the form
            $('form').submit();
        });
    });
</script>

<!-- Print  -->

<!-- Script For DropDown List -->
<script>
    // For Vidhansabha
    // 
    // function vidhansabhaChange(dis_id)
    $(document).ready(function() {
        $('#districtSelect').change(function() {
            var district_id = $(this).val();
            // alert("Selected District ID: " + district_id);
            $.ajax({
                url: 'ajax/get_vidhansabha.php',
                type: 'POST',
                data: {
                    district_id: district_id
                },
                success: function(data) {
                    var vidhansabha = JSON.parse(data);
                    $('#vidhansabhaSelect').empty();
                    $('#vidhansabhaSelect').append('<option>विधानसभा का नाम चुनें</option>');
                    $.each(vidhansabha, function(index, vidhansabha) {
                        $('#vidhansabhaSelect').append('<option value="' + vidhansabha.vidhansabha_id + '">' + vidhansabha.vidhansabha_name + '</option>');
                    });
                    // Pre-select the vidhansabha if editing
                    <?php if (isset($vidhansabha_id) && !empty($vidhansabha_id)) { ?>
                        $('#vidhansabhaSelect').val('<?= $vidhansabha_id ?>');
                    <?php } ?>
                }
            });
        });
        // Trigger the change event if editing an existing record
        <?php if (isset($vidhansabha_id) && !empty($vidhansabha_id)) { ?>
            $('#districtSelect').trigger('change');
        <?php } ?>
    });

    // For Vikaskhand
    $(document).ready(function() {
        $('#vidhansabhaSelect').change(function() {
            var vidhansabha_id = $(this).val();
            //alert("Selected Vidhansabha ID: " + vidhansabha_id);
            $.ajax({
                url: 'ajax/get_vikaskhand.php',
                type: 'POST',
                data: {
                    vidhansabha_id: vidhansabha_id
                },
                success: function(data) {
                    var vikaskhand = JSON.parse(data);
                    $('#vikaskhandSelect').empty();
                    $('#vikaskhandSelect').append('<option selected>विकासखंड का नाम चुनें</option>');
                    $.each(vikaskhand, function(index, vikaskhand) {
                        $('#vikaskhandSelect').append('<option value="' + vikaskhand.vikaskhand_id + '">' + vikaskhand.vikaskhand_name + '</option>');
                    });
                    // Pre-select the vidhansabha if editing
                    <?php if (isset($vikaskhand_id) && !empty($vikaskhand_id)) { ?>
                        $('#vikaskhandSelect').val('<?= $vikaskhand_id ?>');
                    <?php } ?>
                }
            });
        });
        // Trigger the change event if editing an existing record
        <?php if (isset($vikaskhand_id) && !empty($vikaskhand_id)) { ?>
            $('#vidhansabhaSelect').trigger('change');
        <?php } ?>
    });

    // For Sector Load 
    $(document).ready(function() {
        $('#vikaskhandSelect').change(function() {
            var vikaskhand_id = $(this).val();
            //alert("Selected Vikaskhand ID: " + vikaskhand_id);
            $.ajax({
                url: 'ajax/get_sector.php', // Replace with your PHP file to fetch sectors
                type: 'POST',
                data: {
                    vikaskhand_id: vikaskhand_id
                },
                success: function(data) {
                    var sectors = JSON.parse(data);
                    $('#sectorSelect').empty();
                    $('#sectorSelect').append('<option selected>सेक्टर का नाम चुनें</option>');
                    $.each(sectors, function(index, sector) { // Changed variable name to 'sector' to avoid conflict
                        $('#sectorSelect').append('<option value="' + sector.sector_id + '">' + sector.sector_name + '</option>'); // Corrected selector
                    });
                    // Pre-select the vidhansabha if editing
                    <?php if (isset($sector_id) && !empty($sector_id)) { ?>
                        $('#sectorSelect').val('<?= $sector_id ?>');
                    <?php } ?>
                }
            });
        });
        <?php if (isset($sector_id) && !empty($sector_id)) { ?>
            $('#vikaskhandSelect').trigger('change');
        <?php } ?>
    });

    // For Gram Panchayat From Sector id 
    $(document).ready(function() {
        $('#sectorSelect').change(function() {
            var sector_id = $(this).val();
            //alert("Selected Sector ID: " + sector_id);
            $.ajax({
                url: 'ajax/get_gram_panchayat.php', // Replace with your PHP file to fetch sectors
                type: 'POST',
                data: {
                    sector_id: sector_id
                },
                success: function(data) {
                    var gram_panchayats = JSON.parse(data);
                    $('#gramPanchayatSelect').empty();
                    $('#gramPanchayatSelect').append('<option selected>ग्राम पंचायत का नाम चुनें</option>');
                    $.each(gram_panchayats, function(index, gram_panchayat) { // Changed variable name to ', gram_panchayat_name' to avoid conflict
                        $('#gramPanchayatSelect').append('<option value="' + gram_panchayat.gram_panchayat_id + '">' + gram_panchayat.gram_panchayat_name + '</option>'); // Corrected selector
                    });
                    // Pre-select the vidhansabha if editing
                    <?php if (isset($gram_panchayat_name) && !empty($gram_panchayat_name)) { ?>
                        $('#gramPanchayatSelect').val('<?= $gram_panchayat_name ?>');
                    <?php } ?>
                }
            });
        });
        <?php if (isset($gram_panchayat_name) && !empty($gram_panchayat_name)) { ?>
            $('#gramPanchayatSelect').trigger('change');
        <?php } ?>
    });

    //   For Grams  By Panchayat
    $(document).ready(function() {
        $('#gramPanchayatSelect').change(function() {
            var gram_panchayat_id = $(this).val();
            //   alert("Selected Gram Panchayat ID: " + gram_panchayat_id);
            $.ajax({
                url: 'ajax/get_gram.php', // Replace with your PHP file to fetch gram
                type: 'POST',
                data: {
                    gram_panchayat_id: gram_panchayat_id
                },
                success: function(data) {
                    var grams = JSON.parse(data);
                    $('#gramSelect').empty();
                    $('#gramSelect').append('<option selected>ग्राम का नाम चुनें</option>');
                    $.each(grams, function(index, gram) { // Changed variable name to ', gram_panchayat_name' to avoid conflict
                        $('#gramSelect').append('<option value="' + gram.gram_id + '">' + gram.gram_name + '</option>'); // Corrected selector
                    });
                    // Pre-select the vidhansabha if editing
                    <?php if (isset($gram_id) && !empty($gram_id)) { ?>
                        $('#gramSelect').val('<?= $gram_id ?>');
                    <?php } ?>
                }
            });
        });
        <?php if (isset($gram_id) && !empty($gram_id)) { ?>
            $('#gramSelect').trigger('change');
        <?php } ?>
    });
</script>

<!--  -->