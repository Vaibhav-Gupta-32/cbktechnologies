<?php include('../config/dbconnection.php') ?>
<?php include('../config/session_check.php') ?>
<?php
$tblname = "aavedan";
$tblkey = "id";
$pagename = "विवरण बदले ";

// View Id Received
if (isset($_REQUEST['edit_id'])) {
    $edit_id = $_REQUEST['edit_id'];

    $sql = mysqli_query($conn, "SELECT 
  a.*,
  vm.vibhag_name AS a_vibhag_name,
  dm.district_name AS a_district_name,
  vm2.vidhansabha_name AS a_vidhansabha_name,
  vm3.vikaskhand_name AS a_vikaskhand_name,
  sm.sector_name AS a_sector_name,
  gpm.gram_panchayat_name AS a_gram_panchayat_name,
  gm.gram_name AS a_gram_name,
  vm4.vibhag_name AS v_vibhag_name,
  vm5.vibhag_name AS v_aavak_vibhag

FROM 
  $tblname a
  LEFT JOIN vibhag_master vm ON a.a_jaavak_vibhag = vm.vibhag_id
  LEFT JOIN district_master dm ON a.a_district_id = dm.district_id
  LEFT JOIN vidhansabha_master vm2 ON a.a_vidhansabha_id = vm2.vidhansabha_id
  LEFT JOIN vikaskhand_master vm3 ON a.a_vikaskhand_id = vm3.vikaskhand_id
  LEFT JOIN sector_master sm ON a.a_sector_id = sm.sector_id
  LEFT JOIN gram_panchayat_master gpm ON a.a_gram_panchayat_id = gpm.gram_panchayat_id
  LEFT JOIN gram_master gm ON a.a_gram_id = gm.gram_id
  LEFT JOIN vibhag_master vm4 ON a.v_jaavak_vibhag = vm4.vibhag_id
  LEFT JOIN vibhag_master vm5 ON a.v_aavak_vibhag = vm4.vibhag_id

WHERE 
  a.status = '0' and a.$tblkey='$edit_id'
  ");
    $fetch = mysqli_fetch_array($sql);
    // Retrieve posted values
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
    $a_vidhansabha_name = $fetch['a_vidhansabha_name'];
    $a_vikaskhand_name = $fetch['a_vikaskhand_name'];
    $a_sector_name = $fetch['a_sector_name'];
    $a_gram_panchayat_name = $fetch['a_gram_panchayat_name'];
    $a_gram_name = $fetch['a_gram_name'];
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
}

?>
<style>
    input[type="file"]::file-selector-button {
        color: #00698f;
        /* change the text color to blue */
        background-color: transparent;
        /* change the background color to light gray */
        border: none;
    }
</style>

<!-- Start aavedan view Form -->
<form action="" method="POST" enctype="multipart/form-data">
    <div class="container-fluid pt-4 px-4 ">
        <h4 class="text-center fw-bolder text-primary mb-3"><?= $pagename; ?></h4>
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
                <div class="form-group shadow">
                    <div class="form-floating mb-3 border-3 d-flex align-items-center" style="height: 55px;">
                        <div class="form-check form-check-inline">
                            <input type="radio" class="form-check-input" name="choose_aavedak_vibhag" value="1" <?= ($choose_aavedak_vibhag == 1) ? 'checked' : ''; ?>>
                            <label class="form-check-label" for="choose_aavedak_vibhag_1">आवेदक <span class="text-danger">*</span></label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input type="radio" class="form-check-input" name="choose_aavedak_vibhag" value="2" <?= ($choose_aavedak_vibhag == 2) ? 'checked' : ''; ?>>
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
                            <input type="text" class="form-control " maxlength="10" name="a_phone_number" id="a_phone_number" placeholder=" " value="<?= $a_phone_number ?>">
                            <label for="a_phone_number">आवेदक का फ़ोन नंबर <span class="text-danger">*</span></label>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group shadow">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" name="a_aavedak_name" id="a_aavedak_name" placeholder=" " value="<?= $a_aavedak_name ?>">
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
                            <select name="a_vikaskhand_id" id="vikaskhandSelect" class="form-select form-control bg-white">
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
                            <select name="a_sector_id" id="sectorSelect" class="form-select form-control bg-white">
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
                            <select name="a_gram_panchayat_id" id="gramPanchayatSelect" class="form-select form-control bg-white">
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
                            <select class="form-select" id="gramSelect" name="a_gram_id">
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
                            <input type="text" class="form-control" id="a_file_upload_1" name="a_file_upload_1" value="<?= $a_file_upload_1 ?>">
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
                            <input type="text" class="form-control" name="a_kisko_presit" id="a_kisko_presit" placeholder="पद का नाम" value="<?= $a_kisko_presit ?>">
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
                <div class="col-lg-6">
                    <div class="form-group shadow">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="a_application_date" value="<?= $a_application_date ?>" placeholder="आवेदन दिनांक" name="a_application_date">
                            <label for="a_application_date">आदेश दिनांक<span class="text-danger">*</span> </label>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group shadow">
                        <div class="form-floating mb-3 input-group">
                            <input type="text" class="form-control" id="a_file_upload_2" name="a_file_upload_2" value="<?= $a_file_upload_2 ?>">
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
                <div class="col-lg-12 text-center">
                    <div class="form-group">
                        <button class="col-12 text-white btn  text-center shadow" type="submit" style="background-color:#4ac387;" name="submit"><b>Submit</b></button>
                    </div>
                </div>
                <!--  -->
            </div>
        </div>
    <?php } else if ($choose_aavedak_vibhag == 2) { ?>
        <div class="container-fluid px-4 " id="vibhag_form">
            <div class="row">
                <!-- विभाग का form  -->
                <div class="col-lg-6">
                    <div class="form-group shadow">
                        <div class="form-floating mb-3">
                            <select class="form-select" id="v_aavak_vibhag" name="v_aavak_vibhag">
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
                            <input type="text" class="form-control" id="v_subject" placeholder="विषय" name="v_subject" value="<?= $v_subject ?>">
                            <label for="v_subject">विषय <span class="text-danger">*</span> </label>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group shadow">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="v_reference" placeholder="द्वारा" name="v_reference" value="<?= $v_reference ?>">
                            <label for="v_reference">द्वारा <span class="text-danger">*</span> </label>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group shadow">
                        <div class="form-floating mb-3 input-group">
                            <input type="text" class="form-control" id="v_file_upload_1" name="v_file_upload_1" value="<?= $v_file_upload_1 ?>">
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
                            <select class="form-select" id="v_office_name" name="v_office_name">
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
                            <select class="form-select" id="v_jaavak_vibhag" name="v_jaavak_vibhag">
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
                            <input type="text" class="form-control" name="v_kisko_presit" id="v_kisko_presit" placeholder="पद का नाम" value="<?= $v_kisko_presit ?>">
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
                            <input type="text" class="form-control" id="v_jaavak_date" placeholder="आवेदन दिनांक" name="v_jaavak_date" value="<?= date('d-m-Y', strtotime($v_jaavak_date)); ?>">
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
                            <input type="text" class="form-control" id="v_aadesh_date" placeholder="आवेदन दिनांक" name="v_aadesh_date" value="<?= date('d-m-Y', strtotime($v_aadesh_date)); ?>">
                            <label for="v_aadesh_date">आदेश दिनांक <span class="text-danger">*</span> </label>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group shadow">
                        <div class="form-floating mb-3 input-group">
                            <input type="text" class="form-control" id="v_file_upload_2" name="v_file_upload_2" value="<?= $v_file_upload_2 ?>">
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
                            <textarea class="form-control" id="v_mantri_comment" placeholder="टिप्पणी" style="height: 150px;" name="v_mantri_comment"><?= $v_mantri_comment ?></textarea>
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
    <?php } ?>
</form>
<!-- aavedan view close -->