<?php include('../config/dbconnection.php') ?>
<?php include('../config/session_check.php') ?>
<?php
$tblname = "aavedan";
$tblkey = "id";
$pagename = "नया आवेदन भरे";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    // Retrieve posted values
    $mantri_comment = mysqli_real_escape_string($conn, $_POST['mantri_comment']);
    $date = mysqli_real_escape_string($conn, $_POST['date']);
    $file_no = mysqli_real_escape_string($conn, $_POST['file_no']);
    $aadesh_date = mysqli_real_escape_string($conn, $_POST['aadesh_date']);
    $jaavak_date = mysqli_real_escape_string($conn, $_POST['jaavak_date']);
    $kisko_presit = mysqli_real_escape_string($conn, $_POST['kisko_presit']);
    $jaavak_vibhag = mysqli_real_escape_string($conn, $_POST['jaavak_vibhag']);
    $office_name = mysqli_real_escape_string($conn, $_POST['office_name']);
    // $file_upload = $_FILES['file_upload']; // Note: $_FILES for file uploads
    $reference = mysqli_real_escape_string($conn, $_POST['reference']);
    $subject = mysqli_real_escape_string($conn, $_POST['subject']);
    $aavak_vibhag = mysqli_real_escape_string($conn, $_POST['aavak_vibhag']);
    $aavak_no = mysqli_real_escape_string($conn, $_POST['aavak_no']);
    $choose_aavedak_vibhag = mysqli_real_escape_string($conn, $_POST['choose_aavedak_vibhag']);

    // File upload handling
    $target_dir = "uploads/";
    $file_upload = $_FILES['file_upload']['name'];
    $target_file = $target_dir . basename($_FILES["file_upload"]["name"]);
    $uploadOk = 1;
    $fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    // print_r($_POST);die;
    // Check if file already exists
    if (file_exists($target_file)) {
        $msg = "<div class='msg-container'><b class='alert alert-danger msg'>Sorry, file already exists.</b></div>";
        $uploadOk = 0;
    }

    // Check file size (500 KB limit)
    if ($_FILES["file_upload"]["size"] > 500000) {
        $msg = "<div class='msg-container'><b class='alert alert-danger msg'>Sorry, your file is too large (limit is 500 KB).</b></div>";
        $uploadOk = 0;
    }

    // Allow certain file formats (JPG, PNG, PDF)
    if ($fileType != "jpg" && $fileType != "png" && $fileType != "pdf") {
        $msg = "<div class='msg-container'><b class='alert alert-danger msg'>Sorry, only JPG, PNG, and PDF files are allowed.</b></div>";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        $msg = "<div class='msg-container'><b class='alert alert-danger msg'>Sorry, your file was not uploaded.</b></div>";
    } else {
        // Attempt to upload file
        if (move_uploaded_file($_FILES["file_upload"]["tmp_name"], $target_file)) {
            // File uploaded successfully, proceed with database insertion
            // Prepare SQL statement
            // Prepare SQL statement
            $sql = "INSERT INTO $tblname 
(date, file_no, mantri_comment, aadesh_date, jaavak_date, kisko_presit, jaavak_vibhag, office_name, file_upload, reference, subject, aavak_vibhag, aavak_no, choose_aavedak_vibhag) 
VALUES 
('$date', '$file_no', '$mantri_comment', '$aadesh_date', '$jaavak_date', '$kisko_presit', '$jaavak_vibhag', '$office_name', '$file_upload', '$reference', '$subject', '$aavak_vibhag', '$aavak_no', '$choose_aavedak_vibhag')";

            // Execute SQL statement
            if ($conn->query($sql) === TRUE) {
                $msg = "<div class='msg-container'><b class='alert alert-success msg'>New Record Created Successfully.</b></div>";
            } else {
                $msg = "<div class='msg-container'><b class='alert alert-danger msg'>New Record Created Unsuccessfully!!</b></div>";
            }
        } else {
            $msg = "<div class='msg-container'><b class='alert alert-danger msg'>Sorry, there was an error uploading your file.</b></div>";
        }
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
                        <input type="text" class="form-control" name="file_no" id="file_no" placeholder=" " required onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                        <label for="file_no">फाइल क्र <span class="text-danger">*</span> </label>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <input type="date" class="form-control" maxlength="10" name="date" id="date" placeholder=" " onkeypress='return event.charCode >= 48 && event.charCode <= 57' required>
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
                            <input type="radio" class="form-check-input" name="choose_aavedak_vibhag" value="1" id="choose_aavedak_vibhag_1" required>
                            <label class="form-check-label" for="choose_aavedak_vibhag_1">आवेदक <span class="text-danger">*</span></label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input type="radio" class="form-check-input" name="choose_aavedak_vibhag" value="2" id="choose_aavedak_vibhag_2" required>
                            <label class="form-check-label" for="choose_aavedak_vibhag_2">विभाग <span class="text-danger">*</span></label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-5" id="vibhag_form">
            <!-- विभाग का form  -->
                <div class="col-lg-12">
                    <div class="form-group shadow">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="subject" placeholder="विषय" required name="subject">
                            <label for="subject">विषय <span class="text-danger">*</span> </label>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group shadow">
                        <div class="form-floating mb-3">
                            <select class="form-select" id="aavak_vibhag" name="aavak_vibhag" required>
                                <option selected>आवक विभाग नाम चुनें</option>
                                <?php
                                $vibhag_result = mysqli_query($conn, "select * from vibhag_master where 1");
                                mysqli_data_seek($vibhag_result, 0); // Reset pointer to fetch districts again
                                while ($vibhag_row = mysqli_fetch_assoc($vibhag_result)) {
                                    $selected = ($vibhag_row['vibhag_id'] == $vibhag_id) ? 'selected' : '';
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
                            <input type="text" class="form-control" id="reference" placeholder="द्वारा" required name="reference">
                            <label for="reference">द्वारा <span class="text-danger">*</span> </label>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="form-group shadow">
                        <div class="form-floating mb-3 ">
                            <input type="file" class="form-control bg-white" id="file_upload" placeholder="फाइल अपलोड करें" required name="file_upload">
                            <label for="file_upload">फाइल अपलोड करें <span class="text-danger">*</span> </label>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="form-group shadow">
                        <div class="form-floating mb-3">
                            <select class="form-select" id="office_name" name="office_name" required>
                                <option>ऑफिस का नाम चुनें</option>
                                <option value="टेक्नोलॉजी 1">टेक्नोलॉजी 1</option>
                                <option value="टेक्नोलॉजी 2">टेक्नोलॉजी 2</option>
                            </select>
                            <label for="office_name">ऑफिस <span class="text-danger">*</span></label>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group shadow">
                        <div class="form-floating mb-3">
                            <select class="form-select" id="jaavak_vibhag" name="jaavak_vibhag" required>
                                <option selected>जावक विभाग का नाम चुनें</option>
                                <?php
                                $vibhag_result = mysqli_query($conn, "select * from vibhag_master where 1");
                                mysqli_data_seek($vibhag_result, 0); // Reset pointer to fetch districts again
                                while ($vibhag_row = mysqli_fetch_assoc($vibhag_result)) {
                                    $selected = ($vibhag_row['vibhag_id'] == $vibhag_id) ? 'selected' : '';
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
                            <input type="text" class="form-control" name="kisko_presit" id="kisko_presit" placeholder="पद का नाम" required>
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
                            <input type="date" class="form-control" id="jaavak_date" value="<?= $currentDate ?>" placeholder="आवेदन दिनांक" required name="jaavak_date">
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
                            <input type="date" class="form-control" id="aadesh_date" value="<?= $currentDate ?>" placeholder="आवेदन दिनांक" required name="aadesh_date">
                            <label for="aadesh_date">आदेश दिनांक <span class="text-danger">*</span> </label>
                        </div>
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="form-group shadow">
                        <div class="form-floating mb-3">
                            <textarea class="form-control" id="mantri_comment" placeholder="टिप्पणी" required style="height: 150px;" name="mantri_comment"></textarea>
                            <label for="mantri_comment">मंत्री जी की टिप <span class="text-danger">*</span> </label>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 text-center">
                <div class="form-group">
                    <button class="col-12 text-white btn  text-center shadow" type="submit" style="background-color:#4ac387;" name="submit"><b>Submit</b></button>
                </div>
            </div>

        </div>
        <div class="row mt-5" id="aavedak_form">
            <!-- आवेदक का form -->
                    <div class="col-lg-6 col-md-12 col-sm-12 align-content-center">
                        <div class="form-group shadow">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="name" id="aavedak" placeholder="आवेदक का नाम" required>
                                <label for="aavedak">आवेदक का नाम <span class="text-danger">*</span> </label>
                            </div>

                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group shadow">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" maxlength="10" name="phone_number" id="phone_number" placeholder="आवेदक का फ़ोन नंबर" onkeypress='return event.charCode >= 48 && event.charCode <= 57' required>
                                <label for="phone_number">आवेदक का फ़ोन नंबर <span class="text-danger">*</span></label>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 text-center mb-3">
                        <div class="form-group shadow">
                            <div class="form-floating mb-3">
                                <select name="district_id" id="districtSelect" class="form-select form-control bg-white" required>
                                    <?php
                                    // Fetch districts for dropdown
                                    $district_query = "SELECT * FROM district_master";
                                    $district_result = mysqli_query($conn, $district_query);
                                    ?>

                                    <option selected>जिले का नाम चुनें</option>
                                    <?php
                                    while ($district_row = mysqli_fetch_assoc($district_result)) {
                                        echo "<option value='" . $district_row['district_id'] . "'>" . $district_row['district_name'] . "</option>";
                                    }
                                    ?>
                                </select>
                                <label for="districtSelect">जिले का नाम चुनें <span class="text-danger">*</span></label>

                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="form-group shadow">
                            <div class="form-floating mb-3">
                                <select name="vidhansabha_id" id="vidhansabhaSelect" class="form-select form-control bg-white " required>
                                    <option selected>विधानसभा का नाम चुनें</option>
                                    <!-- Options for vidhansabha will go here -->
                                </select>
                                <label for="vidhansabha">विधानसभा का नाम चुनें <span class="text-danger">*</span></label>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group shadow">
                            <div class="form-floating mb-3">
                                <select name="vikaskhand_id" id="vikaskhandSelect" class="form-select form-control bg-white" required>
                                    <option selected>विकासखंड का नाम चुनें</option>
                                    <!-- Option Load By AJAX -->

                                </select>
                                <label for="vikaskhand">विकासखंड का नाम चुनें <span class="text-danger">*</span> </label>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="form-group shadow">
                            <div class="form-floating mb-3">
                                <select name="sector_id" id="sectorSelect" class="form-select form-control bg-white" required>
                                    <option selected>सेक्टर का नाम चुनें</option>
                                    <!-- Options for sectors will go here -->
                                </select>
                                <label for="sector">सेक्टर का नाम चुनें <span class="text-danger">*</span> </label>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="form-group shadow">
                            <div class="form-floating mb-3">
                                <select name="gram_panchayat_id" id="gramPanchayatSelect" class="form-select form-control bg-white" required>
                                    <option selected>ग्राम पंचायत का नाम चुनें</option>
                                    <!-- Options for panchayat will go here -->
                                </select>
                                <label for="gram_panchayt">ग्राम पंचायत का नाम चुनें <span class="text-danger">*</span> </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group shadow">
                            <div class="form-floating mb-3">
                                <select class="form-select" id="gramSelect" name="gram_id" required>
                                    <option selected>ग्राम का नाम चुनें</option>
                                    <!-- by load ajax -->
                                </select>
                                <label for="gram">ग्राम का नाम चुनें <span class="text-danger">*</span></label>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group shadow">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="subject" placeholder="विषय" required name="subject">
                                <label for="subject">विषय का नाम <span class="text-danger">*</span> </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group shadow">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="reference" placeholder="द्वारा" required name="reference">
                                <label for="reference">द्वारा <span class="text-danger">*</span> </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group shadow">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="designation" id="designation" placeholder="पद का नाम" required>
                                <label for="designation">वर्त्तमान पद एवं स्थान <span class="text-danger">*</span> </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group shadow">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="designation" id="designation" placeholder="पद का नाम" required>
                                <label for="designation">प्रस्तावित पद एवं स्थान <span class="text-danger">*</span> </label>
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
                                <input type="date" class="form-control" id="application_date" value="<?= $currentDate ?>" placeholder="आवेदन दिनांक" required name="application_date">
                                <label for="application_date">आवेदन की तिथि <span class="text-danger">*</span> </label>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group shadow">
                                <div class="form-floating mb-3 ">
                                    <input type="file" class="form-control bg-white" id="file_upload" placeholder="फाइल अपलोड करें" required name="file_upload">
                                    <label for="file_upload">आवेदन <span class="text-danger">*</span> </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group shadow">
                                <div class="form-floating mb-3">
                                    <textarea class="form-control" id="comment" placeholder="टिप्पणी" required style="height: 150px;" name="comment"></textarea>
                                    <label for="comment">टिप्पणी <span class="text-danger">*</span> </label>
                                </div>
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
</form>
<!-- New aavedan close -->
<script>
    document.getElementById('choose_aavedak_vibhag_1').addEventListener('click', function(event) {
        document.getElementById('aavedak_form').style.display = 'block';
        document.getElementById('vibhag_form').style.display = 'none';
    });

    document.getElementById('choose_aavedak_vibhag_2').addEventListener('click', function(event) {
        document.getElementById('aavedak_form').style.display = 'none';
        document.getElementById('vibhag_form').style.display = 'block';
    });
</script>
<?php include('../includes/footer.php'); ?>