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

<!-- District Form -->
<!-- Add New District Name -->
<div class="container-fluid pt-4 px-4">
    <form method="post">
     <!-- Table End -->
     <div class="row text-center align-items-center">
            <h4 class="text-center fw-bolder text-primary mb-3">नए जिला का नाम जोड़ें</h4>
            <div class="col-lg-4 text-center mb-3">
                <input type="text" name="district_name" class="form-control border-success" id="mobile" placeholder="जिला का नाम" required>
            </div>
            <div class="col-lg-4 text-center mb-3">
                <button name="submit" class="form-control text-center text-white btn  text-center shadow" type="submit" style="background-color:#4ac387;"><b>Save</b></button>
            </div>
            <div class="col-lg-4  text-center mb-3">
                <button name="cancel" class="col-lg-4 form-control text-center text-white btn  text-center shadow" type="submit" style="background-color:#57c2fc;"><b>Cancel</b></button>
            </div>
        </div>
    </form>
        <!-- Table Start -->
        <div class="row">
            <div class="col-sm-12 col-lg-12">
                <div class="bg-light rounded table-h">
                    <h5 class="mb-4 text-center mt-2 text-success fw-bolder">जिलों की सूची</h6>
                    <table class="table table-striped">
                        <thead class="head">
                            <tr>
                                <th scope="col">क्रमांक</th>
                                <th scope="col">जिला का नाम</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            $sql = "SELECT * FROM district_master ORDER BY district_id DESC";
                            $fetch = mysqli_query($conn, $sql);
                            while ($row = mysqli_fetch_array($fetch)) {
                            ?>
                                <tr>
                                    <th scope="row"><?= $i++ ?></th>
                                    <td><?= $row['district_name'] ?></td>
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
<!-- District Form Close  -->



<?php include('includes/footer.php'); ?>