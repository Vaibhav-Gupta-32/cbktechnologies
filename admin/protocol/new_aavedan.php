<?php include('../config/dbconnection.php') ?>
<?php include('../config/session_check.php') ?>
<?php
$tblname = "protocol_details";
$tblkey = "id";
$pagename = "नया प्रोटोकॉल दर्ज करे |";



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

    if (empty($_POST['district_id'])) {
        $errors[] = 'जिला आईडी आवश्यक है';
    } else {
        $district_id = mysqli_real_escape_string($conn, trim($_POST['district_id']));
    }
    // =======================
      // Collect multiple entries
      $entry_times = isset($_POST['entry_time']) ? $_POST['entry_time'] : [];
      $exit_times = isset($_POST['exit_time']) ? $_POST['exit_time'] : [];
      $madhyams = isset($_POST['madhyam']) ? $_POST['madhyam'] : [];
      $details_arr = isset($_POST['details']) ? $_POST['details'] : [];
  
      if (empty($entry_times) || empty($exit_times) || empty($madhyams) || empty($details_arr)) {
          $errors[] = 'सभी फ़ील्ड्स आवश्यक हैं';
      } else {
          foreach ($entry_times as $entry_time) {
              if (empty($entry_time)) {
                  $errors[] = 'प्रवेश का समय आवश्यक है';
                  break;
              }
          }
          
          foreach ($exit_times as $exit_time) {
              if (empty($exit_time)) {
                  $errors[] = 'बाहर निकलने का समय आवश्यक है';
                  break;
              }
          }
          foreach ($madhyams as $madhyam) {
              if (empty($madhyam)) {
                  $errors[] = 'माध्यम आवश्यक है';
                  break;
              }
          }
          foreach ($details_arr as $detail) {
              if (empty($detail)) {
                  $errors[] = 'विवरण आवश्यक है';
                  break;
              }
          }
      }
    // =======================


    if (empty($errors)) {
        $entry_time_json = json_encode($entry_times, JSON_UNESCAPED_UNICODE);
        $exit_time_json = json_encode($exit_times, JSON_UNESCAPED_UNICODE);
        $madhyam_json = json_encode($madhyams, JSON_UNESCAPED_UNICODE);
        $details_json = json_encode($details_arr, JSON_UNESCAPED_UNICODE);
        
        $sql = "INSERT INTO $tblname (kramank_no, protocol_date, travel_date, days, entry_time, exit_time, madhyam, district_id, details, create_date) VALUES ('$kramank_no', '$protocol_date', '$travel_date', '$days', '$entry_time_json', '$exit_time_json', '$madhyam_json', '$district_id', '$details_json', CURRENT_TIMESTAMP)";
        // echo $sql;die;
        if (mysqli_query($conn, $sql)) {
            $msg = "<div class='msg-container'><b class='alert alert-success msg'>New Record Created Successfully.</b></div>";
        } else {
            // echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            $msg = "<div class='msg-container'><b class='alert alert-danger msg'>New Record Created Unsuccessfully!!</b></div>";
        }
    } else {
        foreach ($errors as $error) {
            // echo "<p style='color: red;'>$error</p>";
            $msg = "<div class='msg-container'><b class='alert alert-danger msg'>Something Went Wrong!!</b></div>";
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

    .form-group {
        margin-bottom: 15px;
    }

    .shadow {
        /* box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 15px; */
    }

    .remove-btn {
        margin-top: 30px;
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
            <div id="formContainer">
                <div class="col-lg-6">
                    <div class="form-group shadow">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="madhyam" placeholder="माध्यम" required name="madhyam">
                            <label for="madhyam">माध्यम<span class="text-danger">*</span> : </label>
                        </div>
                    </div>
                </div>
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
                <div class="col-lg-12">
                    <div class="form-group shadow">
                        <div class="form-floating mb-3">
                            <textarea class="form-control" id="comment" placeholder="टिप्पणी" required style="height: 80px;" name="details"></textarea>
                            <label for="comment">विवरण<span class="text-danger">*</span> : </label>
                        </div>
                    </div>
                </div>
                <button type="button" class="btn btn-primary" id="addMore">Add More</button>
            </div>
            <div class="col-lg-12 text-center">
                <div class="form-group">
                    <button class="col-6 text-white btn  text-center shadow" type="submit" style="background-color:#4ac387;" name="submit"><b>Submit</b></button>
                </div>
            </div>
        </div>
    </div>
</form>

<script>
    document.getElementById('addMore').addEventListener('click', function() {
        let formContainer = document.getElementById('formContainer');
        let newFields = document.createElement('div');
        newFields.className = 'row';

        newFields.innerHTML = `
        <div class="col-lg-6">
            <div class="form-group shadow">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" placeholder="माध्यम" required name="madhyam">
                    <label>माध्यम<span class="text-danger">*</span> : </label>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group shadow">
                <div class="form-floating mb-3">
                    <input type="time" class="form-control" placeholder=" " required name="entry_time">
                    <label>आगमन<span class="text-danger">*</span> : </label>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group shadow">
                <div class="form-floating mb-3">
                    <input type="time" class="form-control" placeholder=" " required name="exit_time">
                    <label>प्रस्थान<span class="text-danger">*</span> :</label>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="form-group shadow">
                <div class="form-floating mb-3">
                    <textarea class="form-control" placeholder="टिप्पणी" required style="height: 80px;" name="details"></textarea>
                    <label>विवरण<span class="text-danger">*</span> : </label>
                </div>
            </div>
        </div>
        <div class="col-lg-12 text-end">
            <button type="button" class="btn btn-danger remove-btn">Remove</button>
        </div>
    `;

        formContainer.appendChild(newFields);

        newFields.querySelector('.remove-btn').addEventListener('click', function() {
            formContainer.removeChild(newFields);
        });
    });
</script>
<?php include('../includes/footer.php'); ?>