<?php
include('../config/dbconnection.php'); // Adjust path as needed
include('../config/session_check.php'); // Adjust path as needed

$tblname = "aamantran";
$tblkey = "id";
$pagename = "नया आमंत्रण आवेदन";

// Check if form is submitted
// If form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    // print_r($_FILES); die;
    $name = $_POST['name'];
    $karykram = $_POST['karykram'];
    $sthan = $_POST['sthan'];
    $from_date = $_POST['from_date'];
    $to_date = $_POST['to_date'];
    $aamantran_date = $_POST['aamantran_date'];
    $comment = $_POST['comment'];
    $preshak = $_POST['preshak']; // Getting status from the form
    $karykram_time = $_POST['karykram_time'];
    $file_upload = $_FILES['file_upload']['name'];

    // Handle file upload

    // File upload handling
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["file_upload"]["name"]);
    $uploadOk = 1;
    $fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if file already exists
    if (file_exists($target_file)) {
        echo "<script>alert('Sorry, file already exists.');</script>";
        $msg = "<div class='msg-container'><b class='alert alert-danger msg'>Sorry, file already exists.</b></div>";
        $uploadOk = 0;
    }
    // echo $target_file.'---'.$uploadOk;die;

    // Check file size (500 KB limit)
    if ($_FILES["file_upload"]["size"] > 500000) {
        $msg = "<div class='msg-container'><b class='alert alert-danger msg'>Sorry, your file is too large (limit is 500 KB).</b></div>";
        echo "<script>alert('Sorry, your file is too large (limit is 500 KB).');</script>";
        $uploadOk = 0;
    }

    // Allow certain file formats (JPG, PNG, PDF)
    if ($fileType != "jpg" && $fileType != "png" && $fileType != "pdf") {
        $msg = "<div class='msg-container'><b class='alert alert-danger msg'>Sorry, only JPG, PNG, and PDF files are allowed.</b></div>";
        echo "<script>alert('Sorry, only JPG, PNG, and PDF files are allowed.');</script>";
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

            // Insert data into the invitation_form table
            $sql = "INSERT INTO $tblname (name, karykram, sthan, from_date, to_date, file_upload, aamantran_date, comment,karykram_time,preshak)
            VALUES ('$name', '$karykram', '$sthan', '$from_date', '$to_date', '$file_upload', '$aamantran_date', '$comment','$karykram_time','$preshak')";
            // Execute SQL statement
            // echo $sql;die;
            if (mysqli_query($conn, $sql)) {
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
<!-- Start New charcha Form -->
<form action="" method="POST" enctype="multipart/form-data">
    <div class="container-fluid pt-4 px-4 ">
        <h4 class="text-center fw-bolder text-primary mb-3"><?= $pagename; ?></h4>
        <div class="row mt-5">
            <div class="col-lg-6">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="name" id="name" placeholder="नाम" required>
                        <label for="name">नाम <span class="text-danger">*</span> </label>
                    </div>

                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" maxlength="10" name="karykram" id="karykram" placeholder="कार्यक्रम" required>
                        <label for="karykram">कार्यक्रम<span class="text-danger">*</span></label>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="sthan" placeholder="स्थान का नाम" required name="sthan">
                        <label for="sthan">स्थान का नाम <span class="text-danger">*</span> </label>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="preshak" id="preshak" placeholder="प्रेषक का नाम" required>
                        <label for="preshak">प्रेषक का नाम <span class="text-danger">*</span> </label>
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
                        <input type="date" name="from_date" value="<?= $currentDate ?>" min="<?= $currentDate ?>" class="form-control" id="from_date" placeholder="कब से ">
                        <label for="from_date">दिनांक (कब से)</label>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <input type="date" name="to_date" class="form-control" id="to_date" placeholder="कब तक ">
                        <label for="to_date">दिनांक (कब तक)</label>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group shadow">
                    <div class="form-floating mb-3 ">
                        <input type="file" class="form-control bg-white" id="file_upload" placeholder="फाइल अपलोड करें" required name="file_upload">
                        <label for="file_upload">फाइल अपलोड करें <span class="text-danger">*</span> </label>
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
                        <input type="date" class="form-control" id="aamantran_date" value="<?= $currentDate ?>" placeholder="आवेदन दिनांक" required name="aamantran_date" readonly>
                        <label for="aamantran_date">आवेदन दिनांक <span class="text-danger">*</span> </label>
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
                        <input type="time" class="form-control" id="karykram_time" value="<?= $currentDate ?>" placeholder="कार्यक्रम समय" required name="karykram_time">
                        <label for="karykram_time">कार्यक्रम समय <span class="text-danger">*</span> </label>
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
<!-- New charcha  close -->

<?php include('../includes/footer.php'); ?>