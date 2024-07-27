<?php include('../config/dbconnection.php') ?>
<?php include('../config/session_check.php') ?>
<?php
$tblname = "aavedan";
$tblkey = "id";
$pagename = "विवरण बदले ";

// View Id Received
if (isset($_REQUEST['edit_id'])) {
$edit_id = $_REQUEST['edit_id'];
    $sql = mysqli_query($conn, "SELECT *, 
    v.vibhag_name AS aavak_vibhag_name, 
    vm.vibhag_name AS jaavak_vibhag_name
FROM $tblname 
LEFT JOIN vibhag_master v ON aavak_vibhag = v.vibhag_id
LEFT JOIN vibhag_master vm ON jaavak_vibhag = vm.vibhag_id
WHERE status=0 and $tblkey='$edit_id'
ORDER BY $tblkey DESC");
// echo 'asdas'.$sql;
 $fetch = mysqli_fetch_array($sql);
 // Retrieve posted values
 $mantri_comment = $fetch['mantri_comment'];
 $edit_id = $fetch['id'];
 $date = $fetch['date'];
 $file_no = $fetch['file_no'];
 $aadesh_date = $fetch['aadesh_date'];
 $jaavak_date = $fetch['jaavak_date'];
 $kisko_presit = $fetch['kisko_presit'];
 $jaavak_vibhag = $fetch['jaavak_vibhag'];
 $office_name = $fetch['office_name'];
 $file_upload = $fetch['file_upload']; // Note: $_FILES for file uploads
 $reference = $fetch['reference'];
 $subject = $fetch['subject'];
 $aavak_vibhag = $fetch['aavak_vibhag'];
 $aavak_no = $fetch['aavak_no'];
 $choose_aavedak_vibhag = $fetch['choose_aavedak_vibhag'];
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
        <div class="row mt-5">
            <input type="hidden" class="form-control" name="edit_id" id="edit_id" placeholder=" " value="<?= $edit_id ?>" >
            <div class="col-lg-6 col-md-12 col-sm-12 align-content-center">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="file_no" id="file_no" placeholder=" " value="<?= $file_no ?>" >
                        <label for="file_no">फाइल क्र <span class="text-danger">*</span> </label>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <input type="date" class="form-control" maxlength="10" name="date" id="date" placeholder=" " value="<?= $date ?>" >
                        <label for="date">दिनांक<span class="text-danger">*</span></label>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" maxlength="10" name="aavak_no" id="aavak_no" placeholder=" " value="<?= $aavak_no ?>" >
                        <label for="aavak_no">आवक क्र <span class="text-danger">*</span></label>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group shadow">
                    <div class="form-floating mb-3 border-3 d-flex align-items-center" style="height: 55px;" >
                        <div class="form-check form-check-inline">
                            <input type="radio" class="form-check-input" name="choose_aavedak_vibhag" value="1" id="choose_aavedak_vibhag_1" <?= $choose_aavedak_vibhag == '1' ? 'checked' : '' ?> >
                            <label class="form-check-label" for="choose_aavedak_vibhag_1">आवेदक <span class="text-danger">*</span></label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input type="radio" class="form-check-input" name="choose_aavedak_vibhag" value="2" id="choose_aavedak_vibhag_2" <?= $choose_aavedak_vibhag == '2' ? 'checked' : '' ?> >
                            <label class="form-check-label" for="choose_aavedak_vibhag_2">विभाग <span class="text-danger">*</span></label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="subject" placeholder="विषय" name="subject" value="<?= $subject ?>" >
                        <label for="subject">विषय <span class="text-danger">*</span> </label>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <select class="form-select" id="aavak_vibhag" name="aavak_vibhag" >
                            <option selected>आवक विभाग नाम चुनें</option>
                            <?php
                            $vibhag_result = mysqli_query($conn, "select * from vibhag_master where 1");
                            mysqli_data_seek($vibhag_result, 0); // Reset pointer to fetch districts again
                            while ($vibhag_row = mysqli_fetch_assoc($vibhag_result)) {
                                $selected = ($vibhag_row['vibhag_id'] == $aavak_vibhag) ? 'selected' : '';
                                echo "<option value='" . $vibhag_row['vibhag_id'] . "' $selected>" . $vibhag_row['vibhag_name'] . "</option>";
                            }
                            ?>
                        </select>
                        <label for="aavak_vibhag">आवक विभाग <span class="text-danger">*</span></label>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="reference" placeholder="द्वारा" name="reference" value="<?= $reference ?>" >
                        <label for="reference">द्वारा <span class="text-danger">*</span> </label>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="form-group shadow">
                    <div class="form-floating mb-3 input-group">
                        <input type="file" class="form-control" id="file_upload" name="file_upload" value="<?= $file_upload ?>" >
                        <input type="hidden" class="form-control" id="existing_file" name="existing_file" value="<?= $file_upload ?>" >
                        <label for="existing_file"> अपलोडेड फाइल </label>
                        <span class="input-group-text bg-">
                            <a href="uploads/<?= $file_upload ?>" target="_blank" class=" p-0"><i class="fas fa-eye fa-lg"></i></a>
                        </span>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <select class="form-select" id="office_name" name="office_name" >
                            <option>ऑफिस का नाम चुनें</option>
                            <option value="टेक्नोलॉजी 1">टेक्नोलॉजी 1</option>
                            <option value="टेक्नोलॉजी 2">टेक्नोलॉजी 2</option>
                        </select>
                        <label for="office_name">ऑफिस <span class="text-danger">*</span></label>
                        <script>
                            document.getElementById('office_name').value = "<?= $office_name ?>";
                        </script>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <select class="form-select" id="jaavak_vibhag" name="jaavak_vibhag" >
                            <option selected>जावक विभाग का नाम चुनें</option>
                            <?php
                            $vibhag_result = mysqli_query($conn, "select * from vibhag_master where 1");
                            mysqli_data_seek($vibhag_result, 0); // Reset pointer to fetch districts again
                            while ($vibhag_row = mysqli_fetch_assoc($vibhag_result)) {
                                $selected = ($vibhag_row['vibhag_id'] == $jaavak_vibhag) ? 'selected' : '';
                                echo "<option value='" . $vibhag_row['vibhag_id'] . "' $selected>" . $vibhag_row['vibhag_name'] . "</option>";
                            }
                            ?>
                        </select>
                        <label for="jaavak_vibhag">जावक विभाग <span class="text-danger">*</span></label>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="kisko_presit" id="kisko_presit" placeholder="पद का नाम" value="<?= $kisko_presit ?>" >
                        <label for="kisko_presit">किसको प्रेषित किया गया <span class="text-danger">*</span> </label>
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
                        <input type="date" class="form-control" id="jaavak_date" placeholder="आवेदन दिनांक" name="jaavak_date" value="<?= $jaavak_date ?>" >
                        <label for="jaavak_date">जावक दिनांक <span class="text-danger">*</span> </label>
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
                        <input type="date" class="form-control" id="aadesh_date" placeholder="आवेदन दिनांक" name="aadesh_date" value="<?= $aadesh_date ?>" >
                        <label for="aadesh_date">आदेश दिनांक <span class="text-danger">*</span> </label>
                    </div>
                </div>
            </div>

            <div class="col-lg-12">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <textarea class="form-control" id="mantri_comment" placeholder="टिप्पणी" style="height: 150px;" name="mantri_comment" ><?= $mantri_comment ?></textarea>
                        <label for="mantri_comment">मंत्री जी की टिप <span class="text-danger">*</span> </label>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 text-center mb-3">
                <div class="form-group">
                    <button class="col-12 text-white btn  text-center shadow" id="approve" type="submit" style="background-color:#4ac387;" name="Update"><b>Update</b></button>
                </div>
            </div>


            <!--  -->
        </div>
    </div>
</form>