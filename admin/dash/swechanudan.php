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
                    <select name="sector_id" id="gramPanchayatSelect" class="form-select form-control bg-white" required>
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
                        <select class="form-select" id="gramSelect" name="gram" required>
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
                        <input type="text" class="form-control" id="expectations_amount" placeholder="आपेक्षित राशि" required name="expectations_amount" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                        <label for="expectations_amount">आपेक्षित राशि <span class="text-danger">*</span> </label>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <input type="date" class="form-control" id="application_date" placeholder="आवेदन दिनांक" required name="application_date">
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


<!-- Script -->

<script>
    // For Vidhansabha
    $(document).ready(function() {
        $('#districtSelect').change(function() {
            var district_id = $(this).val();
            alert("Selected District ID: " + district_id);
            $.ajax({
                url: 'get_vidhansabha.php',
                type: 'POST',
                data: {
                    district_id: district_id
                },
                success: function(data) {
                    var vidhansabha = JSON.parse(data);
                    $('#vidhansabhaSelect').empty();
                    $('#vidhansabhaSelect').append('<option selected>विधानसभा का नाम चुनें</option>');
                    $.each(vidhansabha, function(index, vidhansabha) {
                        $('#vidhansabhaSelect').append('<option value="' + vidhansabha.vidhansabha_id + '">' + vidhansabha.vidhansabha_name + '</option>');
                    });
                }
            });
        });
    });

    // For Vikaskhand
    $(document).ready(function() {
    $('#vidhansabhaSelect').change(function() {
        var vidhansabha_id = $(this).val();
        alert("Selected Vidhansabha ID: " + vidhansabha_id);
        $.ajax({
            url: 'get_vikaskhand.php',
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
            },
            error: function(xhr, status, error) {
                console.error('Error: ' + status + ' - ' + error);
            }
        });
    });
    });
    // For Sector Load 
    $(document).ready(function() {
    $('#vikaskhandSelect').change(function() {
        var vikaskhand_id = $(this).val();
        alert("Selected Vikaskhand ID: " + vikaskhand_id);
        $.ajax({
            url: 'get_sector.php', // Replace with your PHP file to fetch sectors
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
            },
            error: function(xhr, status, error) {
                console.error('Error: ' + status + ' - ' + error);
            }
        });
    });
});
// For Gram Panchayat
 // For Sector Load 
 $(document).ready(function() {
    $('#sectorSelect').change(function() {
        var sector_id = $(this).val();
        alert("Selected Sector ID: " + sector_id);
        $.ajax({
            url: 'get_gram_panchayat.php', // Replace with your PHP file to fetch sectors
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
            },
            error: function(xhr, status, error) {
                console.error('Error: ' + status + ' - ' + error);
            }
        });
    });
});

//   For Grams  By Panchayat
$(document).ready(function() {
    $('#gramPanchayatSelect').change(function() {
        var gram_panchayat_id = $(this).val();
        alert("Selected Gram Panchayat ID: " + gram_panchayat_id);
        $.ajax({
            url: 'get_gram.php', // Replace with your PHP file to fetch sectors
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
            },
            error: function(xhr, status, error) {
                console.error('Error: ' + status + ' - ' + error);
            }
        });
    });
});



</script>

<!--  -->



<?php include('includes/footer.php'); ?>