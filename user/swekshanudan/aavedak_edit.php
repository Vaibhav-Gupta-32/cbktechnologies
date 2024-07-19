<?php include('../config/dbconnection.php') ?>
<?php include('../config/session_check.php') ?>
<?php
$tblname = "swekshanudan";
$tblkey = "id";
$pagename = "विवरण बदले ";

// $vikaskhand_name = "";
$vidhansabha_id = "";
$district_id = "";
$vikaskhand_id = "";
$sector_id = "";
$gram_id = "";
$gram_panchayat_id = "";

// Fetch districts for dropdown
$district_query = "SELECT * FROM district_master";
$district_result = mysqli_query($conn, $district_query);

// View Id Received
if (isset($_REQUEST['edit_id'])) {
    $edit_id = $_REQUEST['edit_id']; // Add this line
    $edit_query = "SELECT * FROM $tblname WHERE $tblkey='$edit_id'";
    $fetch = mysqli_fetch_array(mysqli_query($conn, $edit_query));
    $id = $fetch['id'];
    $name = $fetch['name'];
    $phone_number = $fetch['phone_number'];
    $designation = $fetch['designation'];
    $district_id = $fetch['district_id'];
    $vidhansabha_id = $fetch['vidhansabha_id'];
    $vikaskhand_id = $fetch['vikaskhand_id'];
    $sector_id = $fetch['sector_id'];
    $gram_panchayat_id = $fetch['gram_panchayat_id'];
    $gram_id = $fetch['gram_id'];
    $subject = $fetch['subject'];
    $reference = $fetch['reference'];
    $expectations_amount = $fetch['expectations_amount'];
    $application_date = $fetch['application_date'];
    $comment = $fetch['comment'];
    $file_upload = $fetch['file_upload'];
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
            <div class="col-lg-4 col-md-12 col-sm-12 align-content-center">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="name" id="aavedak" value="<?= $name ?>" placeholder="आवेदक का नाम" required>
                        <input type="hidden"  name="edit_id" id="id" value="<?=$id ?>">
                        <label for="aavedak">आवेदक का नाम <span class="text-danger">*</span> </label>
                    </div>

                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" maxlength="10" name="phone_number" value="<?= $phone_number ?>" id="phone_number" placeholder="आवेदक का फ़ोन नंबर" onkeypress='return event.charCode >= 48 && event.charCode <= 57' required>
                        <label for="phone_number">आवेदक का फ़ोन नंबर <span class="text-danger">*</span></label>
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
            <div class="col-lg-4 text-center mb-3">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
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
                        <label for="districtSelect">जिले का नाम चुनें <span class="text-danger">*</span></label>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <select name="vidhansabha_id" id="vidhansabhaSelect" class="form-select form-control bg-white" required>
                            <option>विधानसभा का नाम चुनें</option>
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
                        <label for="vidhansabha">विधानसभा का नाम चुनें <span class="text-danger">*</span></label>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <select name="vikaskhand_id" id="vikaskhandSelect" class="form-select form-control bg-white">
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
                        <label for="vikaskhand">विकासखंड का नाम चुनें <span class="text-danger">*</span></label>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <select name="sector_id" id="sectorSelect" class="form-select form-control bg-white">
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
                        <label for="sector">सेक्टर का नाम चुनें <span class="text-danger">*</span></label>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
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
                        <label for="gram_panchayt">ग्राम पंचायत का नाम चुनें <span class="text-danger">*</span></label>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <select class="form-select" id="gramSelect" name="gram_id">
                            <option selected>ग्राम का नाम चुनें</option>
                            <?php
                            if (isset($gram_id) && !empty($gram_id)) {
                                $gram_query = "SELECT * FROM gram_master WHERE gram_panchayat_id='$gram_panchayat_id'";
                                $gram_result = mysqli_query($conn, $gram_query);
                                while ($gram_row = mysqli_fetch_assoc($gram_result)) {
                                    $selected = ($gram_row['gram_id'] == $gram_id) ? 'selected' : '';
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
                    <div class="form-floating mb-3 input-group">
                        <input type="file" class="form-control" id="file_upload" name="file_upload">
                        <label for="file_upload"> अपलोडेड फाइल <span class="text-danger">*</span></label>
                        <span class="input-group-text bg-">
                            <a href="uploads/swekshanudan/<?= $file_upload ?>" target="_blank" class="p-0"><i class="fas fa-eye fa-lg"></i></a>
                        </span>
                    </div>
                    <input type="hidden" name="existing_file" value="<?= $file_upload ?>">
                </div>
            </div>
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
                        <input type="text" class="form-control" id="expectations_amount" placeholder="आपेक्षित राशि" required name="expectations_amount" onkeypress='return event.charCode >= 48 && event.charCode <= 57' value="<?= $expectations_amount ?>">
                        <label for="expectations_amount">आपेक्षित राशि <span class="text-danger">*</span> </label>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <?php
                        // Set default current date
                        $currentDate = date('Y-m-d'); // Format: YYYY-MM-DD
                        ?>
                        <input type="date" class="form-control" id="update_date" value="<?= $currentDate ?>" placeholder="अपडेट दिनांक" required name="update_date" readonly>
                        <label for="update_date">अपडेट दिनांक <span class="text-danger">*</span> </label>
                    </div>
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
                    <button class="col-12 text-white btn  text-center shadow" id="Update" type="submit" onclick="update(<?=$id ?>)" style="background-color:#4ac387;" name="Update"><b>Update</b></button>
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