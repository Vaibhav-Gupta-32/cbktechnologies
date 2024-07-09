<?php include('../dbconnection.php') ?>
<?php include('../session_check.php') ?>
<?php
$tblname = "Aavedak";
$tblkey = "id";
$pagename = "आवेदक";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['submit_vibhag'])) {
        // Receive Data From Form 
        $vibhag_name = ucfirst($_POST['vibhag_name']);
        $vibhag_name = mysqli_real_escape_string($conn, $vibhag_name);

        // Check if vibhag_name already exists
        $check_query = "SELECT * FROM vibhag_master WHERE vibhag_name = '$vibhag_name'";
        $check_result = mysqli_query($conn, $check_query);

        if (mysqli_num_rows($check_result) > 0) {
            // Vibhag name already exists
            echo "<b class='text-danger'>Error: Vibhag already exists!</b>";
        } else {
            // Vibhag name does not exist, proceed with insertion
            $sql = "INSERT INTO vibhag_master (vibhag_name) VALUES ('$vibhag_name')";
            if (mysqli_query($conn, $sql)) {
                echo "<b class='text-success'>Vibhag Added Successfully</b>";
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
<!-- Add New Vibhag Name Form -->

<div class="container-fluid pt-4 px-4">
        <form method="post">
             <!-- Form to Add New Vibhag Name -->
        <div class="row text-center align-items-center">
            <h4 class="text-center fw-bolder text-primary mb-3">नया विभाग का नाम जोड़ें</h4>
            <div class="col-lg-4 text-center mb-3">
                <input type="text" name="vibhag_name" class="form-control border-success" placeholder="विभाग का नाम" required>
            </div>
            <div class="col-lg-4 text-center mb-3">
                <button name="submit_vibhag" class="form-control text-center text-white btn  text-center shadow" type="submit" style="background-color:#4ac387;"><b>Save</b></button>
            </div>
            <div class="col-lg-4 text-center mb-3">
                <button name="cancel_vibhag" class="form-control text-center text-white btn  text-center shadow" type="submit" style="background-color:#57c2fc;"><b>Cancel</b></button>
            </div>
        </div>
        </form>
        <!-- Vibhag Master Table -->
        <div class="row">
            <div class="col-sm-12 col-lg-12">
                <div class="bg-light rounded table-h">
                    <h5 class="mb-4 text-center mt-2 text-success fw-bolder">विभागों की सूची</h6>
                    <table class="table table-striped">
                        <thead class="head">
                            <tr>
                                <th scope="col">क्रमांक</th>
                                <th scope="col">विभाग का नाम</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            $sql = "SELECT * FROM vibhag_master ORDER BY vibhag_id DESC";
                            $fetch = mysqli_query($conn, $sql);
                            while ($row = mysqli_fetch_array($fetch)) {
                            ?>
                                <tr>
                                    <th scope="row"><?= $i++ ?></th>
                                    <td><?= $row['vibhag_name'] ?></td>
                                    <td class="d-flex justify-content-center flex-row action">
                                        <a href="#"><i class="fas fa-pen me-2" title="Edit"></i></a>
                                        <a href="#"><i class="fas fa-trash-alt me-2" title="Delete"></i></a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    
<?php include('includes/footer.php'); ?>
