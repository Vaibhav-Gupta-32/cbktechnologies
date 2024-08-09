<?php include('../config/dbconnection.php') ?>
<?php include('../config/session_check.php') ?>
<?php
$tblname = "sthantran";
$tblkey = "id";
$pagename = "विवरण बदले ";
$page_name = basename($_SERVER['PHP_SELF']);

// $vikaskhand_name = "";
$vidhansabha_id = "";
$district_id = "";
$vikaskhand_id = "";
$sector_id = "";
$gram_id = "";
$gram_panchayat_id = "";

// View Id Received
if (isset($_REQUEST['edit_id'])) {
    $edit_id = $_REQUEST['edit_id']; // Add this line
    $edit_query = "SELECT a.*, d.district_name, v.vidhansabha_name, vk.vikaskhand_name, s.sector_name, gp.gram_panchayat_name, g.gram_name 
    ,am.area_name AS area_name
    FROM $tblname a 
    LEFT JOIN district_master d ON a.district_id = d.district_id
    LEFT JOIN vidhansabha_master v ON a.vidhansabha_id = v.vidhansabha_id
    LEFT JOIN vikaskhand_master vk ON a.vikaskhand_id = vk.vikaskhand_id
    LEFT JOIN sector_master s ON a.sector_id = s.sector_id
    LEFT JOIN gram_panchayat_master gp ON a.gram_panchayat_id = gp.gram_panchayat_id
    LEFT JOIN gram_master g ON a.gram_id = g.gram_id
    LEFT JOIN area_master am ON a.area_id = am.area_id
    WHERE a.status=0 and a.$tblkey='$edit_id' 
    ORDER BY a.$tblkey DESC";
    $fetch = mysqli_fetch_array(mysqli_query($conn, $edit_query));
    // $id = $fetch['id'];
    $phone_number = $fetch['phone_number'];
    $name = $fetch['name'];
    $designation = $fetch['designation'];
    $district_id = $fetch['district_id']; // Ensure district_id is an integer
    $vidhansabha_id = $fetch['vidhansabha_id']; // Ensure vidhansabha_id is an integer
    $vikaskhand_id = $fetch['vikaskhand_id']; // Ensure vikaskhand_id is an integer
    $sector_id = $fetch['sector_id']; // Ensure sector_id is an integer
    $gram_panchayat_id = $fetch['gram_panchayat_id'];
    $gram_id = $fetch['gram_id'];
    $area_idd = $fetch['area_id'];
    $district_name = $fetch['district_name'];
    $vidhansabha_name = $fetch['vidhansabha_name'];
    $vikaskhand_name = $fetch['vikaskhand_name'];
    $sector_name = $fetch['sector_name'];
    $gram_panchayat_name = $fetch['gram_panchayat_name'];
    $gram_name = $fetch['gram_name'];
    $file_upload = $fetch['file_upload'];
    $subject = $fetch['subject'];
    $reference = $fetch['reference'];
    $c_designation_place = $fetch['c_designation_place'];
    $f_designation_place = $fetch['f_designation_place'];
    $application_date = $fetch['application_date'];
    $comment = $fetch['comment'];
}
?>

<!-- Start New Swekshanudan Form -->
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
        <hr class="text-info p-2 rounded">
        <div class="row">
            <div class="col-lg-4">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" maxlength="10" name="phone_number" value="<?= $phone_number ?>" id="phone_number" placeholder="आवेदक का फ़ोन नंबर" onkeypress='return event.charCode >= 48 && event.charCode <= 57' required>
                        <label for="phone_number">आवेदक का फ़ोन नंबर <span class="text-danger">*</span></label>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-12 col-sm-12 align-content-center">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="name" id="aavedak" value="<?= $name ?>" placeholder="आवेदक का नाम" required>
                        <input type="hidden" name="edit_id" id="id" value="<?= $edit_id ?>">
                        <label for="aavedak">आवेदक का नाम <span class="text-danger">*</span> </label>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="designation" id="designation" value="<?= $designation ?>" placeholder="पद का नाम" required>
                        <label for="designation">पद का नाम <span class="text-danger">*</span> </label>
                    </div>
                </div>
            </div>

            <!-- for location edit -->
            <?php include('../location/location_edit.php') ?>

            <div class="col-lg-4">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="subject" placeholder="विषय" required name="subject" value="<?= $subject ?>">
                        <label for="subject">विषय का नाम <span class="text-danger">*</span> </label>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="reference" placeholder="द्वारा" required name="reference" value="<?= $reference ?>">
                        <label for="reference">द्वारा <span class="text-danger">*</span> </label>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <input type="date" class="form-control" id="application_date" value="<?= $application_date ?>" placeholder="आवेदन दिनांक" required name="application_date">
                        <label for="application_date">आवेदन दिनांक <span class="text-danger">*</span> </label>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="c_designation_place" placeholder="द्वारा" required name="c_designation_place" value="<?= $c_designation_place ?>">
                        <label for="c_designation_place">वर्तमान पद एवं स्थान <span class="text-danger">*</span> </label>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="f_designation_place" placeholder="द्वारा" required name="f_designation_place" value="<?= $f_designation_place ?>">
                        <label for="f_designation_place">प्रस्तावित पद एवं स्थान <span class="text-danger">*</span> </label>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group shadow">
                    <div class="form-floating mb-3 input-group">
                        <input type="file" class="form-control" id="file_upload" name="file_upload">
                        <label for="file_upload"> अपलोडेड फाइल <span class="text-danger">*</span></label>
                        <span class="input-group-text bg-">
                            <a href="uploads/<?= $file_upload ?>" target="_blank" class="p-0"><i class="fas fa-eye fa-lg"></i></a>
                        </span>
                    </div>
                    <input type="hidden" name="existing_file" value="<?= $file_upload ?>">
                </div>
            </div>

            <div class="col-lg-12">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <textarea class="form-control" id="comment" placeholder="टिप्पणी" required style="height: 150px;" name="comment"><?= $comment ?></textarea>
                        <label for="comment">टिप्पणी <span class="text-danger">*</span> </label>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 text-center mb-3">
                <div class="form-group">
                    <button class="col-12 text-white btn  text-center shadow" id="Update" type="submit" style="background-color:#4ac387;" name="Update"><b>Update</b></button>
                </div>
            </div>
            <div class="col-lg-6 text-center mb-3">
                <div class="form-group">
                    <button class="col-12 text-white btn  text-center shadow btn-info" id="Print" type="submit" name="Print"><b>Print</b></button>
                </div>
            </div>

            <!--  -->
        </div>
    </div>
</form>
<!-- New Swekshanudan close -->