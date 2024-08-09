<?php include('../config/dbconnection.php') ?>
<?php include('../config/session_check.php') ?>
<?php
$tblname = "protocol_details";
$tblkey = "id";
$pagename = "प्रोटोकॉल";
$currentDate = date('Y-m-d');

// If Presit For Print Data By Admin 
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['summit'])) {
    $protocol_id = $_POST['protocol_id'];
    $cpp_name = $_POST['cpp_name'];
    $cpp_designation = $_POST['cpp_designation'];
    // $anudan_prapt_add = $_POST['anudan_prapt_add'];

    $sql = "UPDATE $tblname SET status='2', cpp_name='$cpp_name', cpp_designation='$cpp_designation', cpp_create_date='$currentDate' WHERE $tblkey ='$protocol_id'";
    // echo $sql; die;
    if (mysqli_query($conn, $sql)) {
        $msg = "<div class='msg-container'><b class='alert alert-success msg'>Approved Successfully</b></div>";

    } else {
        $msg = "<div class='msg-container'><b class='alert alert-danger msg'>Not Approved!! </b></div>";
    }
}

// Update query
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['Update'])) {
    $edit_id = $_POST['edit_id'];
    // $edit_query = "SELECT * FROM $tblname WHERE $tblkey='$edit_id'";
    // $fetch = mysqli_fetch_array(mysqli_query($conn, $edit_query));
    $kramank_no = $_POST['kramank_no'];
    $protocol_date = $_POST['protocol_date'];
    $travel_date = $_POST['travel_date'];
    $days = $_POST['days'];
    $entry_time = $_POST['entry_time'];
    $exit_time = $_POST['exit_time'];
    $madhyam = $_POST['madhyam'];
    $district_id = $_POST['district_id'];
    $details = $_POST['details'];

    $update_query = "UPDATE protocol_details SET 
                      kramank_no='$kramank_no', 
                      protocol_date='$protocol_date', 
                      travel_date='$travel_date', 
                      days='$days', 
                      entry_time='$entry_time', 
                      exit_time='$exit_time', 
                      madhyam='$madhyam', 
                      district_id='$district_id',
                      details='$details' 
                      WHERE id='$edit_id'";
    // echo $update_query;die;
    if (mysqli_query($conn, $update_query)) {
        $msg = "<div class='msg-container'><b class='alert alert-warning msg'>Update Successfully</b></div>";
    } else {
        $msg = "<div class='msg-container'><b class='alert alert-danger msg'>Update Not Successfully!!</b></div>";
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['search'])) {
    $district_id = isset($_POST['district_id']) ? $_POST['district_id'] : '';
    $travel_date = isset($_POST['travel_date']) ? $_POST['travel_date'] : '';
    $days = isset($_POST['days']) ? $_POST['days'] : '';
    // $to_date = isset($_POST['to_date']) ? $_POST['to_date'] : '';

    // Start building the SQL query
    $sql = "SELECT a.*, d.district_name FROM protocol_details a INNER JOIN district_master d ON a.district_id = d.district_id WHERE 1";

    // Add conditions if fields are set
    if (!empty($district_id)) {
        $sql .= " AND a.district_id = '" . mysqli_real_escape_string($conn, $district_id) . "'";
    }
    if (!empty($travel_date)) {
        $sql .= " AND a.travel_date = '" . mysqli_real_escape_string($conn, $travel_date) . "'";
    }
    if (!empty($days)) {
        $sql .= " AND a.days = '" . mysqli_real_escape_string($conn, $days) . "'";
    }
    $sql .= " ORDER BY id DESC";
    // echo $sql;die;
} else {
    $sql = "SELECT p.*, d.district_name FROM protocol_details p INNER JOIN district_master d ON p.district_id = d.district_id WHERE status=2";
}

// $fetch=mysqli_query($conn,"select * from protocol_details where 1");
$fetch = mysqli_query($conn, $sql);
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

<!-- aavedak search start -->
<div class="container-fluid pt-4 px-4">
    <h4 class="text-center fw-bolder text-primary mb-3"><?= $pagename; ?> सूची</h4>
    <form action="" method="post">
        <div class="row">
            <div class="col-lg-4 text-center mb-3">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <select name="district_id" id="districtSelect" class="form-select form-control bg-white">
                            <?php
                            // Fetch districts for dropdown
                            $district_query = "SELECT * FROM district_master";
                            $district_result = mysqli_query($conn, $district_query);
                            ?>
                            <option value="" selected>जिले का नाम चुनें</option>
                            <?php
                            while ($district_row = mysqli_fetch_assoc($district_result)) {
                                echo "<option value='" . $district_row['district_id'] . "'>" . $district_row['district_name'] . "</option>";
                            }
                            ?>
                        </select>
                        <label for="districtSelect">जिले का नाम चुनें </label>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 text-center mb-3">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <input class="form-control bg-white" type="date" name="travel_date" id="travel_date">
                        <label for="">यात्रा तारीख </label>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 text-center mb-3">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <select name="days" id="days" class="form-select form-control bg-white">
                            <option value="">कृपया एक दिन चुनें</option>
                            <option value="रविवार">रविवार</option>
                            <option value="सोमवार">सोमवार</option>
                            <option value="मंगलवार">मंगलवार</option>
                            <option value="बुधवार">बुधवार</option>
                            <option value="गुरुवार">गुरुवार</option>
                            <option value="शुक्रवार">शुक्रवार</option>
                            <option value="शनिवार">शनिवार</option>
                        </select>
                        <label for="districtSelect">दिन </label>

                    </div>
                </div>
            </div>
            <!-- btn -->
            <!-- 1 -->
            <div class="col-lg-4 text-center mb-3">
                <a name="Add_New" onclick="location.href='new_aavedan.php';" class="form-control text-center text-white btn text-center shadow bg-primary" style="background-color:#4ac387;"><b>Add New</b></a>
            </div>
            <!-- 2 -->
            <div class="col-lg-4 text-center mb-3">
                <div name="PrintList" onclick="" class="form-control text-center text-white btn text-center shadow" style="background-color:#4ac387;"><b>Print List</b></div>
            </div>
            <!-- 3 -->
            <div class="col-lg-4 text-center mb-3">
                <button name="search" class="form-control text-center text-white btn text-center shadow bg-info" type="submit"><b>Search</b></button>
            </div>
        </div>
    </form>
</div>
<!-- aavedak search End -->

<!-- Table Start -->
<div class="container-fluid px-4">
    <div class="row">
        <div class="col-sm-12 col-lg-12">
            <h6 class="mb-4 text-center mt-2 pt-3 "><?= $pagename; ?> सूची</h6>
            <div class=" rounded" style="overflow-y: scroll;">

                <table class="table table-striped border shadow">
                    <thead class=" head">
                        <tr class="text-center text-nowrap">
                            <th>सि. नं.</th>
                            <th scope="col">क्रमांक नं.</th>
                            <th scope="col">प्रोटोकॉल तारीख</th>
                            <th scope="col">यात्रा तारीख</th>
                            <th scope="col">दिन</th>
                            <th scope="col">आगमन समय</th>
                            <th scope="col">प्रस्थान समय</th>
                            <th scope="col">माध्यम</th>
                            <th scope="col">जिला</th>
                            <th scope="col">विवरण</th>
                            <th scope="col">प्रोटोकॉल बनाई तिथि</th>
                            <th scope="col">Action</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        while ($row = mysqli_fetch_array($fetch)) {
                        ?>
                            <tr class=" text-center">
                                <th scope="row"><?= $i++ ?></th>
                                <td><?= $row['kramank_no'] ?></td>
                                <td><?= date('d-m-Y', strtotime($row['protocol_date'])) ?></td>
                                <td><?= date('d-m-Y', strtotime($row['travel_date'])) ?></td>
                                <td><?= $row['days'] ?></td>
                                <td><?= $row['entry_time'] ?></td>
                                <td><?= $row['exit_time'] ?></td>
                                <td><?= $row['madhyam'] ?></td>
                                <td><?= $row['district_name'] ?></td>
                                <td><?= $row['details'] ?></td>
                                <td><?= date('d-m-Y', strtotime($row['create_date'])) ?></td>
                                <td class="action">
                                    <a href="print_pdf.php?id=<?=$row['id'];?>" target='_blank' ><i class=" fa fa-solid fa-print" title="प्रेषित स्वीकृत आवेदन "></i></a>
                                    &nbsp;
                                    &nbsp;
                                    <a class="text-danger " href="" onclick="confirmDelete(<?= $row['id']; ?>, '<?php echo $tblname; ?>', '<?= $tblkey ?>')"><i class="fas fa-trash-alt me-2 " title="Delete"></i></a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include('../includes/footer.php'); ?>