<?php include('../dbconnection.php') ?>
<?php include('../session_check.php') ?>
<?php
$tblname = "Aavedak";
$tblkey = "id";
$pagename = "आवेदक";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['submit_yojna'])) {
        // Receive Data From Form 
        $yojna_name = ucfirst($_POST['yojna_name']);
        $yojna_name = mysqli_real_escape_string($conn, $yojna_name);

        // Check if yojna_name already exists
        $check_query = "SELECT * FROM yojna_master WHERE yojna_name = '$yojna_name'";
        $check_result = mysqli_query($conn, $check_query);

        if (mysqli_num_rows($check_result) > 0) {
            // Yojna name already exists
            echo "<b class='text-danger'>Error: Yojna already exists!</b>";
        } else {
            // Yojna name does not exist, proceed with insertion
            $sql = "INSERT INTO yojna_master (yojna_name) VALUES ('$yojna_name')";
            if (mysqli_query($conn, $sql)) {
                echo "<b class='text-success'>Yojna Added Successfully</b>";
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

<!-- Add New Yojna Name Form -->
<!-- Yojna Master Table -->
<div class="container-fluid pt-4 px-4">
    <form method="post">
        <!-- Form to Add New Yojna Name -->
        <div class="row text-center align-items-center">
            <h4 class="text-center fw-bolder text-primary mb-3">नई योजना का नाम जोड़ें</h4>
            <div class="col-lg-4 text-center mb-3">
                <input type="text" name="yojna_name" class="form-control border-success" placeholder="योजना का नाम" required>
            </div>
            <div class="col-lg-4 text-center mb-3">
                <button name="submit_yojna" class="form-control text-center text-white btn  text-center shadow" type="submit" style="background-color:#4ac387;"><b>Save</b></button>
            </div>
            <div class="col-lg-4 text-center mb-3">
                <button name="cancel_yojna" class="form-control text-center text-white btn  text-center shadow" type="submit" style="background-color:#57c2fc;"><b>Cancel</b></button>
            </div>
        </div>
    </form>
    <div class="row">
        <div class="col-sm-12 col-lg-12">
            <div class="bg-light rounded table-h">
                <h5 class="mb-4 text-center mt-2 text-success fw-bolder">योजनाओं की सूची</h6>
                <table class="table table-striped">
                    <thead class="head">
                        <tr>
                            <th scope="col">क्रमांक</th>
                            <th scope="col">योजना का नाम</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        $sql = "SELECT * FROM yojna_master ORDER BY yojna_id DESC";
                        $fetch = mysqli_query($conn, $sql);
                        while ($row = mysqli_fetch_array($fetch)) {
                        ?>
                            <tr>
                                <th scope="row"><?= $i++ ?></th>
                                <td><?= $row['yojna_name'] ?></td>
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