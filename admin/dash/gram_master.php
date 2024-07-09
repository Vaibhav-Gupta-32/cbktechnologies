<?php include('../dbconnection.php') ?>
<?php include('../session_check.php') ?>
<?php
$tblname = "Aavedak";
$tblkey = "id";
$pagename = "आवेदक";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['submit'])) {
        // recive Data From Form 
        $district_name = ucfirst($_POST['district_name']);

        $district_name = mysqli_real_escape_string($conn, $district_name);
        $check_query = "SELECT * FROM district_master WHERE district_name = '$district_name'";
        $check_result = mysqli_query($conn, $check_query);

        if (mysqli_num_rows($check_result) > 0) {
            // District name already exists
            echo "<b class='text-danger'>Error: District already exists!</b>";
        } else {
            // District name does not exist, proceed with insertion
            $sql = "INSERT INTO district_master (district_name) VALUES ('$district_name')";
            if (mysqli_query($conn, $sql)) {
                echo "<b class='text-success'>District Added Successfully</b>";
            } else {
                echo "<b class='text-danger'>Error: " . mysqli_error($conn) . "</b>";
            }
        }
    }
}

?>
<?php include('includes/header.php') ?>
<?php include('includes/sidebar.php') ?>
<?php include('includes/navbar.php') ?>


<div class="container-fluid pt-4 px-4">
    <form method="post">
        <div class="row text-center align-items-center">
            <h5 class="text-center fw-bolder text-primary mb-3">नया ग्राम जोड़ें</h5>

            <div class="col-lg-4 text-center mb-3">
                <select name="district_id" class="form-select form-control border-success" required>
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
            </div>

            <div class="col-lg-4 text-center mb-3">
                <select name="vidhansabha_id" class="form-select form-control border-success" required>
                    <option selected>विधानसभा का नाम चुनें</option>
                    <!-- Options for vidhansabha will go here -->
                </select>
            </div>

            <div class="col-lg-4 text-center mb-3">
                <select name="vikaskhand_id" class="form-select form-control border-success" required>
                    <option selected>विकासखंड का नाम चुनें</option>
                    <!-- Options for vikaskhand will go here -->
                </select>
            </div>

            <div class="col-lg-4 text-center mb-3">
                <select name="sector_id" class="form-select form-control border-success" required>
                    <option selected>सेक्टर का नाम चुनें</option>
                    <!-- Options for sectors will go here -->
                </select>
            </div>
            <div class="col-lg-4 text-center mb-3">
                <select name="sector_id" class="form-select form-control border-success" required>
                    <option selected>ग्राम पंचायत का नाम चुनें</option>
                    <!-- Options for panchayat will go here -->
                </select>
            </div>

            <div class="col-lg-4 text-center mb-3">
                <input type="text" name="gram_name" class="form-control border-success" placeholder="ग्राम का नाम" required>
            </div>

            <div class="col-lg-6 text-center mb-3">
                <button name="submit_gram" class="form-control text-center text-white btn text-center shadow" type="submit" style="background-color:#4ac387;"><b>Save</b></button>
            </div>

            <div class="col-lg-6 text-center mb-3">
                <button name="cancel_gram" class="form-control text-center text-white btn text-center shadow" type="reset" style="background-color:#57c2fc;"><b>Cancel</b></button>
            </div>
        </div>
    </form>

    <!-- Gram Master Table -->
    <div class="row">
        <div class="col-sm-12 col-lg-12">
            <div class="bg-light rounded" style="overflow-y: scroll;">
                <h5 class="mb-4 text-center mt-2 text-success fw-bolder">ग्राम की सूची</h5>
                <table class="table table-striped">
                    <thead class="head">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">ग्राम का नाम</th>
                            <th scope="col">जिला</th>
                            <th scope="col">विधानसभा</th>
                            <th scope="col">विकासखंड</th>
                            <th scope="col">सेक्टर</th>
                            <th scope="col">क्रिया</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">1</th>
                            <td>Example Gram</td>
                            <td>Example District</td>
                            <td>Example Vidhansabha</td>
                            <td>Example Vikaskhand</td>
                            <td>Example Sector</td>
                            <td class="d-flex justify-content-center flex-row action">
                                <a href="#"><i class="fas fa-pen me-2" title="Edit"></i></a>
                                <a href="#"><i class="fas fa-trash-alt me-2" title="Delete"></i></a>
                            </td>
                        </tr>
                        <!-- Additional rows will go here -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php include('includes/footer.php'); ?>