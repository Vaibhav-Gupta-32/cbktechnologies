<?php include('../config/dbconnection.php') ?>
<?php include('../config/session_check.php') ?>
<?php
$tblname = "protocol_details";
$tblkey = "id";
$pagename = "विवरण बदले ";

// $edit_id = $_REQUEST['edit_id'];
$kramank_no = "";
$protocol_date = "";
$travel_date = "";
$days = "";
$entry_time = "";
$exit_time = "";
$madhyam = "";
$district_id = "";

// Update query
if (isset($_REQUEST['edit_id'])) {
    $edit_id = $_REQUEST['edit_id'];
    $edit_query = "SELECT * FROM $tblname WHERE $tblkey='$edit_id'";
    $fetch = mysqli_fetch_array(mysqli_query($conn, $edit_query));
    $kramank_no = $fetch['kramank_no'];
    $protocol_date = $fetch['protocol_date'];
    $travel_date = $fetch['travel_date'];
    $days = $fetch['days'];
    $entry_time = $fetch['entry_time'];
    $exit_time = $fetch['exit_time'];
    $madhyam = $fetch['madhyam'];
    $district_id = $fetch['district_id'];
    $details = $fetch['details'];

    // $update_query = "UPDATE protocol_details SET 
    //                   kramank_no='$kramank_no', 
    //                   protocol_date='$protocol_date', 
    //                   travel_date='$travel_date', 
    //                   days='$days', 
    //                   entry_time='$entry_time', 
    //                   exit_time='$exit_time', 
    //                   madhyam='$madhyam', 
    //                   district_id='$district_id',
    //                   details='$details' 
    //                   WHERE id='$edit_id'";

    // if (mysqli_query($conn, $update_query)) {
    //   echo "Record updated successfully";
    // } else {
    //   echo "Error updating record: " . mysqli_error($conn);
    // }
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
            <div class="col-lg-6 col-md-12 col-sm-12 align-content-center">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">

                        <input type="hidden" class="form-control" name="edit_id" id="edit_id" placeholder=" " required value="<?= $edit_id; ?>">
                        <input type="text" class="form-control" name="kramank_no" id="kramank_no" placeholder="क्रमांक" required value="<?= $kramank_no; ?>">
                        <label for="kramank_no">क्रमांक<span class="text-danger">*</span> : </label>
                    </div>

                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <input type="date" class="form-control" name="protocol_date" id="protocol_date" placeholder="दिनांक (जब प्रोटोकॉल जारी हुआ)" required value="<?= $protocol_date; ?>">
                        <label for="protocol_date">दिनांक (जब प्रोटोकॉल जारी हुआ)<span class="text-danger">*</span> :</label>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <input type="date" class="form-control" id="travel_date" placeholder=" " required name="travel_date" value="<?= $travel_date; ?>">
                        <label for="travel_date">दौरा कार्यक्रम दिनांक<span class="text-danger">*</span> : </label>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <select class="form-select" id="days" placeholder=" " required name="days">
                            <option value="">कृपया एक दिन चुनें</option>
                            <option value="रविवार" <?php if ($days == "रविवार") echo "selected"; ?>>रविवार</option>
                            <option value="सोमवार" <?php if ($days == "सोमवार") echo "selected"; ?>>सोमवार</option>
                            <option value="मंगलवार" <?php if ($days == "मंगलवार") echo "selected"; ?>>मंगलवार</option>
                            <option value="बुधवार" <?php if ($days == "बुधवार") echo "selected"; ?>>बुधवार</option>
                            <option value="गुरुवार" <?php if ($days == "गुरुवार") echo "selected"; ?>>गुरुवार</option>
                            <option value="शुक्रवार" <?php if ($days == "शुक्रवार") echo "selected"; ?>>शुक्रवार</option>
                            <option value="शनिवार" <?php if ($days == "शनिवार") echo "selected"; ?>>शनिवार</option>
                        </select>
                        <label for="day">दिन<span class="text-danger">*</span> : </label>
                    </div>
                    <script>
                        document.getElementById('days').value = "<?= $days; ?>";
                    </script>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <input type="time" class="form-control" id="entry_time" placeholder=" " required name="entry_time" value="<?= $entry_time; ?>">
                        <label for="entry_time">आगमन<span class="text-danger">*</span> : </label>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <input type="time" class="form-control" id="exit_time" placeholder=" " required name="exit_time" value="<?= $exit_time; ?>">
                        <label for="exit_time">प्रस्थान<span class="text-danger">*</span> :</label>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 text-center mb-3">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <select name="district_id" id="districtSelect" class="form-select form-control bg-white" required>
                            <option selected>जिले का नाम चुनें</option>
                            <?php
                            $district_query = "SELECT * FROM district_master";
                            $district_result = mysqli_query($conn, $district_query);
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

            <div class="col-lg-6">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="madhyam" placeholder="माध्यम" required name="madhyam" value="<?= $madhyam; ?>">
                        <label for="madhyam">माध्यम<span class="text-danger">*</span> : </label>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <textarea class="form-control" id="details" placeholder="टिप्पणी" required style="height: 80px;" name="details"><?= $details ?></textarea>
                        <label for="details">विवरण<span class="text-danger">*</span> : </label>
                    </div>
                </div>
            </div>

            <!-- button -->
            <div class="col-lg-6 text-center mb-3">
                <div class="form-group">
                    <button class="col-12 text-white btn  text-center shadow" id="Update" type="submit" style="background-color:#4ac387;" name="Update"><b>Update</b></button>
                </div>
            </div>

            <!--  -->
        </div>
    </div>
</form>
<!-- New Swekshanudan close -->