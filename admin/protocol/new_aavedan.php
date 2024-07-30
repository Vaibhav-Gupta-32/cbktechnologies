<?php include('../config/dbconnection.php') ?>
<?php include('../config/session_check.php') ?>
<?php
$tblname = "protocol_details";
$tblkey = "id";
$pagename = "नया प्रोटोकॉल दर्ज करे |";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $kramank_no = mysqli_real_escape_string($conn, trim($_POST['kramank_no']));
    $travel_date = mysqli_real_escape_string($conn, trim($_POST['travel_date']));
    $protocol_date = mysqli_real_escape_string($conn, trim($_POST['protocol_date']));
    $days = mysqli_real_escape_string($conn, trim($_POST['days']));
    $tip = mysqli_real_escape_string($conn, trim($_POST['tip']));
    $district_id = mysqli_real_escape_string($conn, trim($_POST['district_id']));
    // =======================
    // Collect multiple entries
    $entryTimes = $_POST['entry_time'];
    $exitTimes = $_POST['exit_time'];
    $madhyams = $_POST['madhyam'];
    $details = $_POST['details'];

      // Process the data
  foreach ($entryTimes as $key => $entryTime) {
    $exitTime = $exitTimes[$key];
    $madhyam = $madhyams[$key];
    $detail = $details[$key];

    // Create a JSON object to store the data in a single column
    $data = array(
      'entry_time' => $entryTime,
      'exit_time' => $exitTime,
      'madhyam' => $madhyam,
      'details' => $detail
    );
    $json_data = json_encode($data);

    // Insert the data into the database
    // $sql = "INSERT INTO your_table_name (data) VALUES ('$json_data')";
    // mysqli_query($conn, $sql);
  }


        $sql = "INSERT INTO $tblname (kramank_no, protocol_date, travel_date, days, entry_time, exit_time, madhyam, district_id, details, tip, data, create_date) VALUES ('$kramank_no', '$protocol_date', '$travel_date', '$days', '$entryTimes', '$exitTimes', '$madhyams', '$district_id', '$details', $tip, $json_data, CURRENT_TIMESTAMP)";
        // echo $sql;die;
        if (mysqli_query($conn, $sql)) {
            $msg = "<div class='msg-container'><b class='alert alert-success msg'>New Record Created Successfully.</b></div>";
        } else {
            // echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            $msg = "<div class='msg-container'><b class='alert alert-danger msg'>New Record Created Unsuccessfully!!</b></div>";
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

    .form-group {
        margin-bottom: 15px;
    }

    /* .shadow { */
    /* box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 15px; */
    /* } */

    .remove-btn {
        margin-top: 30px;
    }
</style>
<!-- Start New Swekshanudan Form -->
<form action="" method="POST" enctype="multipart/form-data">
    <div class="container-fluid pt-4 px-4 ">
        <h4 class="text-center fw-bolder text-primary mb-3"><?= $pagename; ?></h4>
        <!-- row1 Start-->
        <div class="row mt-5">
            <div class="col-lg-4  align-content-center">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">

                        <input type="text" class="form-control" name="kramank_no" id="kramank_no" placeholder="क्रमांक" required>
                        <label for="kramank_no">क्रमांक<span class="text-danger">*</span> : </label>
                    </div>

                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <input type="date" class="form-control" name="protocol_date" id="protocol_date" placeholder="दिनांक (जब प्रोटोकॉल जारी हुआ)" required value="">
                        <label for="protocol_date">दिनांक (जब प्रोटोकॉल जारी हुआ)<span class="text-danger">*</span> :</label>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
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
                            <option value="रविवार">रविवार</option>
                            <option value="सोमवार">सोमवार</option>
                            <option value="मंगलवार">मंगलवार</option>
                            <option value="बुधवार">बुधवार</option>
                            <option value="गुरुवार">गुरुवार</option>
                            <option value="शुक्रवार">शुक्रवार</option>
                            <option value="शनिवार">शनिवार</option>
                        </select>
                        <label for="day">दिन<span class="text-danger">*</span> : </label>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 text-center">
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
            <div class="col-lg-12">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <textarea class="form-control" id="tip" placeholder="टिप्पणी" required style="height: 150px;" name="tip"></textarea>
                        <label for="tip">टिप <span class="text-danger">*</span> </label>
                    </div>
                </div>
            </div>
        </div>
        <!-- Row1 End -->

        <!--row 2 Start -->
        <div class="row mt-2">
            <div class="col-lg-4">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="madhyam" placeholder="माध्यम" required name="madhyam[]">
                        <label for="madhyam">माध्यम<span class="text-danger">*</span> : </label>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <input type="time" class="form-control" id="entry_time" placeholder=" " required name="entry_time[]">
                        <label for="entry_time">आगमन<span class="text-danger">*</span> : </label>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <input type="time" class="form-control" id="exit_time" placeholder=" " required name="exit_time[]">
                        <label for="exit_time">प्रस्थान<span class="text-danger">*</span> :</label>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <textarea class="form-control" id="comment" placeholder="टिप्पणी" required style="height: 80px;" name="details[]"></textarea>
                        <label for="comment">विवरण<span class="text-danger">*</span> : </label>
                    </div>
                </div>
            </div>
        </div>
        <!-- row2 End-->

        <!-- row3 Start -->
        <div class="addmore-form " id="formContainer">

        </div>
        <!-- row3 End -->
        <div class="row mt-2 ">
            <div class="form-group d-flex justify-content-between">
                <button class="col-lg-4 text-white btn  text-center shadow" type="submit" style="background-color:#4ac387;" name="submit"><b>Submit</b></button>
                <button class=" col-lg-4 btn btn-primary  text-white btn  text-center shadow" type="button" id="addMore" name="addMore">Add More</button>
            </div>
        </div>

    </div>
</form>

<script>
    document.getElementById('addMore').addEventListener('click', function() {
        let formContainer = document.getElementById('formContainer');
        let newFields = document.createElement('div');
        newFields.className = 'row mt-2 pt-2 border-top border-dark border-3 rounded';
        newFields.innerHTML = `
        <div class="col-lg-4">
            <div class="form-group shadow">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" placeholder="माध्यम" required name="madhyam">
                    <label>माध्यम<span class="text-danger">*</span> : </label>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group shadow">
                <div class="form-floating mb-3">
                    <input type="time" class="form-control" placeholder=" " required name="entry_time">
                    <label>आगमन<span class="text-danger">*</span> : </label>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group shadow">
                <div class="form-floating mb-3">
                    <input type="time" class="form-control" placeholder=" " required name="exit_time">
                    <label>प्रस्थान<span class="text-danger">*</span> :</label>
                </div>
            </div>
        </div>
        <div class="col-lg-10">
            <div class="form-group shadow">
                <div class="form-floating">
                    <textarea class="form-control" placeholder="टिप्पणी" required style="height: 80px;" name="details"></textarea>
                    <label>विवरण<span class="text-danger">*</span> : </label>
                </div>
            </div>
        </div>
        <div class="col-lg-2  d-flex justify-content-center align-items-center">
            <div type="button" class=" mt-0 btn btn-danger remove-btn"><i class="fa-solid fa-trash-can"></i> Remove</div>
        </div>
    `;
        formContainer.appendChild(newFields);
        newFields.querySelector('.remove-btn').addEventListener('click', function() {
            formContainer.removeChild(newFields);
        });
    });
</script>
<?php include('../includes/footer.php'); ?>