<?php include('../config/dbconnection.php') ?>
<?php include('../config/session_check.php') ?>
<?php
$tblname = "aavedan";
$tblkey = "id";
$pagename = "विवरण ";
$page_name = basename($_SERVER['PHP_SELF']); 
// For Showing data On View If Admin View  
if (isset($_REQUEST['id']))
    $id = $_REQUEST['id'];
// View Id Recived
if ($id) {
    $sql = "SELECT 
  a.*,
  vm.vibhag_name AS a_vibhag_name,
  dm.district_name AS district_name,
  vm2.vidhansabha_name AS vidhansabha_name,
  vm3.vikaskhand_name AS vikaskhand_name,
  sm.sector_name AS sector_name,
  gpm.gram_panchayat_name AS gram_panchayat_name,
  gm.gram_name AS gram_name,
  vm4.vibhag_name AS v_vibhag_name,
  vm5.vibhag_name AS v_aavak_vibhag,
  am.area_name AS area_name

FROM 
  $tblname a
  LEFT JOIN vibhag_master vm ON a.a_jaavak_vibhag = vm.vibhag_id
  LEFT JOIN district_master dm ON a.district_id = dm.district_id
  LEFT JOIN vidhansabha_master vm2 ON a.vidhansabha_id = vm2.vidhansabha_id
  LEFT JOIN vikaskhand_master vm3 ON a.vikaskhand_id = vm3.vikaskhand_id
  LEFT JOIN sector_master sm ON a.sector_id = sm.sector_id
  LEFT JOIN gram_panchayat_master gpm ON a.gram_panchayat_id = gpm.gram_panchayat_id
  LEFT JOIN gram_master gm ON a.gram_id = gm.gram_id
  LEFT JOIN vibhag_master vm4 ON a.v_jaavak_vibhag = vm4.vibhag_id
  LEFT JOIN vibhag_master vm5 ON a.v_aavak_vibhag = vm5.vibhag_id
  LEFT JOIN area_master am ON a.area_id = am.area_id

WHERE 
  a.status = '0' and a.$tblkey='$id'
ORDER BY 
  a.$tblkey DESC";
    // echo 'id :'.$id.'----'. $sql; 
    $run = mysqli_query($conn, $sql);
    $fetch = mysqli_fetch_array($run);
    // Retrieve posted values
    $file_no = $fetch['file_no'];
    $date = $fetch['date'];
    $aavak_no = $fetch['aavak_no'];
    $choose_aavedak_vibhag = $fetch['choose_aavedak_vibhag'];
    $a_phone_number = $fetch['a_phone_number'];
    $a_aavedak_name = $fetch['a_aavedak_name'];
    $district_id = $fetch['district_id'];
    $vidhansabha_id = $fetch['vidhansabha_id'];
    $vikaskhand_id = $fetch['vikaskhand_id'];
    $sector_id = $fetch['sector_id'];
    $gram_panchayat_id = $fetch['gram_panchayat_id'];
    $gram_id = $fetch['gram_id'];
    $vidhansabha_name = $fetch['vidhansabha_name'];
    $vikaskhand_name = $fetch['vikaskhand_name'];
    $sector_name = $fetch['sector_name'];
    $gram_panchayat_name = $fetch['gram_panchayat_name'];
    $gram_name = $fetch['gram_name'];
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
    $area_name = $fetch['area_name'];

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
        <hr class="text-danger p-2 rounded">
        <div class="row mt-5">
            <div class="col-lg-6 align-content-center">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="file_no" id="file_no" placeholder=" " required value="<?= $file_no ?>" readonly>
                        <label for="file_no">फाइल क्र <span class="text-danger">*</span> </label>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" maxlength="10" name="date" id="date" placeholder=" " required readonly value="<?= date('d-m-Y', strtotime($date)) ?>">
                        <label for="date">दिनांक<span class="text-danger">*</span></label>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" maxlength="10" name="aavak_no" id="aavak_no" placeholder=" " required readonly value="<?= $aavak_no ?>">
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
                            <input type="hidden" class="form-control " name="id" id="id" placeholder=" " value="<?= $id ?>">
                            <input type="text" class="form-control " maxlength="10" name="a_phone_number" id="a_phone_number" placeholder=" " value="<?= $a_phone_number ?>" readonly>
                            <label for="a_phone_number">आवेदक का फ़ोन नंबर <span class="text-danger">*</span></label>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group shadow">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" name="a_aavedak_name" id="a_aavedak_name" placeholder=" " value="<?= $a_aavedak_name ?>" readonly>
                            <label for="a_aavedak_name">आवेदक का नाम <span class="text-danger">*</span> </label>
                        </div>

                    </div>
                </div>

                <!-- for location view -->
                <?php include('../location/location_view.php') ?>

                <div class="col-lg-4">
                    <div class="form-group shadow">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="a_subject" placeholder="विषय" name="a_subject" value="<?= $a_subject ?>" readonly>
                            <label for="a_subject">विषय का नाम <span class="text-danger">*</span> </label>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group shadow">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="a_reference" placeholder="द्वारा" name="a_reference" value="<?= $a_reference ?>" readonly>
                            <label for="a_reference">द्वारा <span class="text-danger">*</span> </label>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group shadow">
                        <div class="form-floating mb-3 input-group">
                            <input type="text" class="form-control" id="a_file_upload_1" name="a_file_upload_1" value="<?= $a_file_upload_1 ?>" readonly>
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
                            <select class="form-select" id="a_office_name" name="a_office_name" disabled>
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
                            <select class="form-select" id="a_jaavak_vibhag" name="a_jaavak_vibhag" disabled>
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
                            <input type="text" class="form-control" name="a_kisko_presit" id="a_kisko_presit" placeholder="पद का नाम" value="<?= $a_kisko_presit ?>" readonly>
                            <label for="a_kisko_presit">किसको प्रेषित किया गया <span class="text-danger">*</span> </label>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group shadow">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="a_jaavak_date" value="<?= $a_jaavak_date ?>" placeholder="आवेदन दिनांक" name="a_jaavak_date" readonly>
                            <label for="a_jaavak_date">जावक दिनांक<span class="text-danger">*</span> </label>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group shadow">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="a_application_date" value="<?= $a_application_date ?>" placeholder="आवेदन दिनांक" name="a_application_date" readonly>
                            <label for="a_application_date">आदेश दिनांक<span class="text-danger">*</span> </label>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group shadow">
                        <div class="form-floating mb-3 input-group">
                            <input type="text" class="form-control" id="a_file_upload_2" name="a_file_upload_2" value="<?= $a_file_upload_2 ?>" readonly>
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
                            <textarea class="form-control" id="a_mantri_comment" placeholder="टिप्पणी" style="height: 150px;" name="a_mantri_comment" readonly><?= $a_mantri_comment ?></textarea>
                            <label for="a_mantri_comment">मंत्री जी की टिप <span class="text-danger">*</span> </label>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 text-center mb-3">
                    <div class="form-group">
                        <button class="col-12 text-white btn  text-center shadow" id="approve" type="submit" style="background-color:#4ac387;" name="approve"><b>Approve</b></button>
                    </div>
                </div>
                <div class="col-lg-6 text-center mb-3">
                    <div class="form-group">
                        <button class="col-12 text-white btn  text-center shadow btn-danger" id="UnApprove" type="submit" name="UnApprove"><b>UnApprove</b></button>
                    </div>
                </div>
                <!--  -->
            </div>
        </div>
    <?php } else if ($choose_aavedak_vibhag == 2) { ?>
        <div class="container-fluid px-4 " id="vibhag_form">
            <div class="row">
                <!-- विभाग का form  -->
                <input type="hidden" class="form-control " name="id" id="id" placeholder=" " value="<?= $id ?>">
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
                <div class="col-lg-6 text-center mb-3">
                    <div class="form-group">
                        <button class="col-12 text-white btn  text-center shadow" id="approve" type="submit" style="background-color:#4ac387;" name="approve"><b>Approve</b></button>
                    </div>
                </div>
                <div class="col-lg-6 text-center mb-3">
                    <div class="form-group">
                        <button class="col-12 text-white btn  text-center shadow btn-danger" id="UnApprove" type="submit" name="UnApprove"><b>UnApprove</b></button>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
</form>
<!-- aavedan view close -->