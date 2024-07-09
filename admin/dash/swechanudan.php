<?php include('../dbconnection.php') ?>
<?php include('../session_check.php') ?>
<?php
$tblname = "swekshanudan";
$tblkey = "id";
$pagename = "Register New Swekshanudan";


// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    // Database connection
    //include('dbconnection.php'); // Include your database connection script

    // Collect form data
    $name = trim($_POST['name']);
    $phone_number = trim($_POST['phone_number']);
    $designation = trim($_POST['designation']);
    $vidhansabha = trim($_POST['vidhansabha']);
    $vikaskhand = trim($_POST['vikaskhand']);
    $sector = trim($_POST['sector']);
    $gram_panchayt = trim($_POST['gram_panchayt']);
    $gram = trim($_POST['gram']);
    $subject = trim($_POST['subject']);
    $reference = trim($_POST['reference']);
    $expectations_amount = trim($_POST['expectations_amount']);
    $application_date = trim($_POST['application_date']);
    $file_upload = $_FILES['file_upload']['name'];
    $comment = trim($_POST['comment']);

    $cnt = mysqli_query($conn, "select * from $tblname where phone_number='$phone_number' and name='$name'");

    if (mysqli_num_rows($cnt) > 0) {
        echo '<script>alert("Record Already Registered!")</script>';
    } else {

        if (isset($file_upload)) {
            $target_dir = "uploads/swechanudan/"; // directory where file will be uploaded
            $target_file = $target_dir . basename($_FILES["file_upload"]["name"]);
            $uploadOk = 1;
            $fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

            // Check if file already exists
            if (file_exists($target_file)) {
                echo "Sorry, file already exists.";
                $uploadOk = 0;
            }

            // Check file size
            if ($_FILES["file_upload"]["size"] > 500000) {
                echo "Sorry, your file is too large.";
                $uploadOk = 0;
            }

            // Allow certain file formats
            if ($fileType != "jpg" && $fileType != "png" && $fileType != "pdf" && $fileType != "docx") {
                echo "Sorry, only JPG, PNG, PDF, and DOCX files are allowed.";
                $uploadOk = 0;
            }

            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
                echo "Sorry, your file was not uploaded.";
                // if everything is ok, try to upload file
            } else {
                if (move_uploaded_file($_FILES["file_upload"]["tmp_name"], $target_file)) {
                    echo "The file " . htmlspecialchars(basename($_FILES["file_upload"]["name"])) . " has been uploaded.";
                } else {
                    echo "Sorry, there was an error uploading your file.";
                }
            }
        } else {
        }
        // Prepare SQL statement
        $sql = "INSERT INTO $tblname 
            (name, phone_number, designation, vidhansabha, vikaskhand, sector, gram_panchayt, gram, subject, reference, expectations_amount, application_date, file_upload, comment) 
            VALUES 
            ('$name', '$phone_number', '$designation', '$vidhansabha', '$vikaskhand', '$sector', '$gram_panchayt', '$gram', '$subject', '$reference', '$expectations_amount', '$application_date', '$file_upload', '$comment')";

        echo $sql;
        die;
        // Execute SQL statement
        if (mysqli_query($conn, $sql)) {
            echo "Record inserted successfully!";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }

    // Close database connection
    mysqli_close($conn);
}
?>
<?php include('includes/header.php') ?>
<?php include('includes/sidebar.php') ?>
<?php include('includes/navbar.php') ?>

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
                        <select class="form-select" id="vidhansabha" name="vidhansabha" required>
                            <!-- <option selected>विधानसभा चुनें </option> -->
                            <option value="अरूणाचल प्रदेश">अरूणाचल प्रदेश</option>
                            <option value="असम">असम</option>
                            <option value="3बिहार">बिहार</option>
                            <option value="छत्तीसगढ़">छत्तीसगढ़</option>
                        </select>
                        <label for="vidhansabha">विधानसभा का नाम चुनें <span class="text-danger">*</span></label>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <select class="form-select" id="vikaskhand" name="vikaskhand" required>
                            <option value="दुर्ग">दुर्ग</option>
                            <option value="पाटन">पाटन</option>
                            <option value="रायपुर">रायपुर</option>
                        </select>
                        <label for="vikaskhand">विकासखंड का नाम चुनें <span class="text-danger">*</span> </label>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <select class="form-select" id="sector" name="sector" required>
                            <option value="धरसींवा">धरसींवा</option>
                            <option value="तिल्दा">तिल्दा</option>
                            <option value="आरंग">आरंग</option>
                            <option value="अभनपुर">अभनपुर</option>
                        </select>
                        <label for="sector">सेक्टर का नाम चुनें <span class="text-danger">*</span> </label>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <select class="form-select" id="gram_panchayt" name="gram_panchayt" required>
                            <option value="पहला">पहला</option>
                            <option value="दूसरा">दूसरा</option>
                            <option value="तीसरा">तीसरा</option>
                        </select>
                        <label for="gram_panchayt">ग्राम पंचायत का नाम चुनें <span class="text-danger">*</span> </label>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <select class="form-select" id="gram" name="gram" required>
                            <option value="पहला">पहला</option>
                            <option value="दूसरा">दूसरा</option>
                            <option value="तीसरा">तीसरा</option>
                        </select>
                        <label for="gram">ग्राम का नाम चुनें <span class="text-danger">*</span></label>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="subject" placeholder="विषय" required name="subject">
                        <label for="subject">विषय का नाम <span class="text-danger">*</span> </label>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="reference" placeholder="द्वारा" required name="reference">
                        <label for="reference">द्वारा <span class="text-danger">*</span> </label>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="expectations_amount" placeholder="आपेक्षित राशि" required name="expectations_amount" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                        <label for="expectations_amount">आपेक्षित राशि <span class="text-danger">*</span> </label>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <input type="date" class="form-control" id="application_date" placeholder="आवेदन दिनांक" required name="application_date">
                        <label for="application_date">आवेदन दिनांक <span class="text-danger">*</span> </label>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group shadow">
                    <div class="form-floating mb-3 " >
                        <input type="file" class="form-control bg-white" id="file_upload" placeholder="फाइल अपलोड करें" required name="file_upload">
                        <label for="file_upload" >फाइल अपलोड करें <span class="text-danger">*</span> </label>
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

<?php include('includes/footer.php'); ?>