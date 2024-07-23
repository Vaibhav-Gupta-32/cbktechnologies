<?php include('../config/dbconnection.php') ?>
<?php include('../config/session_check.php') ?>
<?php
$tblname = "swekshanudan";
$tblkey = "id";
$pagename = "नया आवेदन भरे";



if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    // Input validation
    $errors = [];
    
    if (empty($_POST['kramank_no'])) {
        $errors[] = 'क्रमांक संख्या आवश्यक है';
    } else {
        $kramank_no = mysqli_real_escape_string($conn, trim($_POST['kramank_no']));
    }
    
    if (empty($_POST['protocol_date'])) {
        $errors[] = 'प्रोटोकॉल की तारीख आवश्यक है';
    } else {
        $protocol_date = mysqli_real_escape_string($conn, trim($_POST['protocol_date']));
    }
    
    if (empty($_POST['travel_date'])) {
        $errors[] = 'यात्रा की तारीख आवश्यक है';
    } else {
        $travel_date = mysqli_real_escape_string($conn, trim($_POST['travel_date']));
    }
    
    if (empty($_POST['days'])) {
        $errors[] = 'दिन आवश्यक हैं';
    } else {
        $days = mysqli_real_escape_string($conn, trim($_POST['days']));
    }
    
    if (empty($_POST['entry_time'])) {
        $errors[] = 'प्रवेश का समय आवश्यक है';
    } else {
        $entry_time = mysqli_real_escape_string($conn, trim($_POST['entry_time']));
    }
    
    if (empty($_POST['exit_time'])) {
        $errors[] = 'बाहर निकलने का समय आवश्यक है';
    } else {
        $exit_time = mysqli_real_escape_string($conn, trim($_POST['exit_time']));
    }
    
    if (empty($_POST['madhyam'])) {
        $errors[] = 'माध्यम आवश्यक है';
    } else {
        $madhyam = mysqli_real_escape_string($conn, trim($_POST['madhyam']));
    }
    
    if (empty($_POST['district_id'])) {
        $errors[] = 'जिला आईडी आवश्यक है';
    } else {
        $district_id = mysqli_real_escape_string($conn, trim($_POST['district_id']));
    }

    if (empty($errors)) {
        // Check if record exists for update, otherwise insert
        if (isset($_POST['id']) && !empty($_POST['id'])) {
            $id = mysqli_real_escape_string($conn, trim($_POST['id']));
            $sql = "UPDATE travel_details SET 
                        kramank_no='$kramank_no', 
                        protocol_date='$protocol_date', 
                        travel_date='$travel_date', 
                        days='$days', 
                        entry_time='$entry_time', 
                        exit_time='$exit_time', 
                        madhyam='$madhyam', 
                        district_id='$district_id', 
                        update_date=CURRENT_TIMESTAMP 
                    WHERE id='$id'";
        } else {
            $sql = "INSERT INTO travel_details (
                        kramank_no, 
                        protocol_date, 
                        travel_date, 
                        days, 
                        entry_time, 
                        exit_time, 
                        madhyam, 
                        district_id, 
                        create_date
                    ) VALUES (
                        '$kramank_no', 
                        '$protocol_date', 
                        '$travel_date', 
                        '$days', 
                        '$entry_time', 
                        '$exit_time', 
                        '$madhyam', 
                        '$district_id', 
                        CURRENT_TIMESTAMP
                    )";
        }

        if (mysqli_query($conn, $sql)) {
            echo "Record saved successfully";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    } else {
        foreach ($errors as $error) {
            echo "<p style='color: red;'>$error</p>";
        }
    }
}

// mysqli_close($conn);
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
        <?php if (isset($msg)) echo $msg; ?>
        <h4 class="text-center fw-bolder text-primary mb-3"><?= $pagename; ?></h4>
        <div class="row mt-5">
            <div class="col-lg-6 col-md-12 col-sm-12 align-content-center">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="kramank_no" id="kramank_no" placeholder="क्रमांक" required>
                        <label for="kramank_no">क्रमांक<span class="text-danger">*</span> : </label>
                    </div>

                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <input type="date" class="form-control" name="protocol_date" id="protocol_date" placeholder="दिनांक (जब प्रोटोकॉल जारी हुआ)" required value="">
                        <label for="protocol_date">दिनांक (जब प्रोटोकॉल जारी हुआ)<span class="text-danger">*</span> :</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-lg-6">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <input type="date" class="form-control" id="travel_date" placeholder=" " required name="travel_date">
                        <label for="travel_date">दौरा कार्यक्रम दिनांक<span class="text-danger">*</span> : </label>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <select class="form-select" id="days" placeholder=" " required name="days">
                            <option value="">कृपया एक दिन चुनें</option>
                            <option value="Sunday">रविवार</option>
                            <option value="Monday">सोमवार</option>
                            <option value="Tuesday">मंगलवार</option>
                            <option value="Wednesday">बुधवार</option>
                            <option value="Thursday">गुरुवार</option>
                            <option value="Friday">शुक्रवार</option>
                            <option value="Saturday">शनिवार</option>
                        </select>
                        <label for="day">दिन<span class="text-danger">*</span> : </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-lg-6">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <input type="time" class="form-control" id="entry_time" placeholder=" " required name="entry_time">
                        <label for="entry_time">आगमन<span class="text-danger">*</span> : </label>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <input type="time" class="form-control" id="exit_time" placeholder=" " required name="exit_time">
                        <label for="exit_time">प्रस्थान<span class="text-danger">*</span> :</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-lg-6">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <textarea class="form-control" id="comment" placeholder="टिप्पणी" required style="height: 80px;" name="comment"></textarea>
                        <label for="comment">विवरण<span class="text-danger">*</span> : </label>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="madhyam" placeholder="माध्यम" required name="madhyam" >
                        <label for="madhyam">माध्यम<span class="text-danger">*</span> : </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-5">
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
       
        </div>
    </div>
</form>
<!-- New Swekshanudan close -->

<?php include('../includes/footer.php'); ?>