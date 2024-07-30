<?php
include('../config/dbconnection.php'); // Adjust path as needed
include('../config/session_check.php'); // Adjust path as needed

$tblname = "nirmaan";
$tblkey = "id";
$pagename = "नया निर्माण आवेदन भरे";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    // Collect form data
    $name = mysqli_real_escape_string($conn, trim($_POST['name']));
    $phone_number = mysqli_real_escape_string($conn, trim($_POST['phone_number']));
    $designation = mysqli_real_escape_string($conn, trim($_POST['designation']));
    $district_id = intval($_POST['district_id']); // Ensure district_id is an integer
    $vidhansabha_id = intval($_POST['vidhansabha_id']); // Ensure vidhansabha_id is an integer
    $vikaskhand_id = intval($_POST['vikaskhand_id']); // Ensure vikaskhand_id is an integer
    $sector_id = intval($_POST['sector_id']); // Ensure sector_id is an integer
    $gram_panchayat_id = mysqli_real_escape_string($conn, trim($_POST['gram_panchayat_id']));
    $gram_id = mysqli_real_escape_string($conn, trim($_POST['gram_id']));
    $subject = mysqli_real_escape_string($conn, trim($_POST['subject']));
    $reference = mysqli_real_escape_string($conn, trim($_POST['reference']));
    $expectations_amount = intval($_POST['expectations_amount']); // Ensure expectations_amount is an integer
    $application_date = mysqli_real_escape_string($conn, trim($_POST['application_date']));
    $comment = mysqli_real_escape_string($conn, trim($_POST['comment']));

    // File upload handling
    $target_dir = "uploads/";
    $file_upload = $_FILES['file_upload']['name'];
    $target_file = $target_dir . basename($_FILES["file_upload"]["name"]);
    $uploadOk = 1;
    $fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

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
            $sql = "INSERT INTO $tblname 
                    (name, phone_number, designation, district_id, vidhansabha_id, vikaskhand_id, sector_id, gram_panchayat_id, gram_id, subject, reference, expectations_amount, application_date, file_upload, comment) 
                    VALUES 
                    ('$name', '$phone_number', '$designation', $district_id, $vidhansabha_id, $vikaskhand_id, $sector_id, '$gram_panchayat_id', '$gram_id', '$subject', '$reference', $expectations_amount, '$application_date', '$file_upload', '$comment')";

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
<!-- Start New Swekshanudan Form -->
<form action="" method="POST" enctype="multipart/form-data">
    <div class="container-fluid pt-4 px-4 ">
        <h4 class="text-center fw-bolder text-primary mb-3"><?= $pagename; ?></h4>
        <div class="row mt-5">
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
                    <div class="form-floating mb-3 " >
                        <input type="file" class="form-control bg-white" id="file_upload" placeholder="फाइल अपलोड करें" required name="file_upload">
                        <label for="file_upload" >फाइल अपलोड करें <span class="text-danger">*</span> </label>
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
                        <label for="designation">पद का नाम <span class="text-danger">*</span> </label>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="expectations_amount" placeholder="आपेक्षित राशि" required name="expectations_amount" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                        <label for="expectations_amount">आपेक्षित राशि <span class="text-danger">*</span> </label>
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
                        <input type="date" class="form-control" id="application_date" value="<?= $currentDate ?>" placeholder="आवेदन दिनांक" required name="application_date" readonly>
                        <label for="application_date">आवेदन दिनांक <span class="text-danger">*</span> </label>
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
            <div class="col-lg-12 text-center">
                <div class="form-group">
                    <button class="col-12 text-white btn  text-center shadow" type="submit" style="background-color:#4ac387;" name="submit"><b>Submit</b></button>
                </div>
            </div>

            <!--  -->
        </div>
    </div>
</form>
<!-- New Swekshanudan close -->

<?php include('../includes/footer.php'); ?>