<?php include('../config/dbconnection.php') ?>
<?php include('../config/session_check.php') ?>
<?php
$tblname = "aamantran";
$tblkey = "id";
$pagename = " स्वीकृत आमंत्रण आवेदन";
// $msg="";

// Update Form 
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['Update'])) {
    $name = $_POST['name'];
    $karykram = $_POST['karykram'];
    $sthan = $_POST['sthan'];
    $from_date = $_POST['from_date'];
    $to_date = $_POST['to_date'];
    $aamantran_date = $_POST['aamantran_date'];
    $comment = $_POST['comment'];
    $preshak = $_POST['preshak'];
    $file_upload = $_FILES['file_upload']['name'];

    if (isset($_POST['edit_id']) && !empty($_POST['edit_id'])) {
        $s_id = $_POST['edit_id'];

        // Check if a new file was uploaded
        if (!empty($file_upload)) {
            // Handle file upload logic
            $target_dir = "uploads/";
            $target_file = $target_dir . basename($file_upload);

            // Move the uploaded file to the target directory
            if (move_uploaded_file($_FILES['file_upload']['tmp_name'], $target_file)) {
                // File upload successful
                $uploaded_file_path = $target_file;
            } else {
                // Handle error
                $error_message = "Sorry, there was an error uploading your file.";
            }
        } else {
            // No new file uploaded, use the existing file
            $uploaded_file_path = $_POST['existing_file'];
        }
        // Save the form data along with the file path to the database
        $update_query = "UPDATE $tblname SET 
                        name = '$name', 
                        karykram = '$karykram',
                        sthan = '$sthan', 
                        from_date = '$from_date', 
                        to_date = '$to_date', 
                        aamantran_date = '$aamantran_date', 
                        comment = '$comment', 
                        preshak = '$preshak', 
                        file_upload = '$uploaded_file_path'
                    WHERE $tblkey = '$s_id'";

        if (mysqli_query($conn, $update_query)) {
            $msg = "<div class='msg-container'><b class='alert alert-warning msg'>Update Successfully</b></div>";
        } else {
            $msg = "<div class='msg-container'><b class='alert alert-danger msg'>Update Not Successfully!!</b></div>";
        }
    }
}

// If Approve By Admin 
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['approve'])) {
    $vid = $_POST['id'];
    $view_comment = $_POST['view_comment'];

    $sql = "UPDATE $tblname SET status=1, view_comment='$view_comment' WHERE $tblkey='$vid'";

    if (mysqli_query($conn, $sql)) {
        $msg = "<div class='msg-container'><b class='alert alert-success msg'>Approved Successfully</b></div>";
    } else {
        $msg = "<div class='msg-container'><b class='alert alert-danger msg'>Error</b></div>";
    }
}

// If Reject By Admin
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['UnApprove'])) {
    $id = $_REQUEST['id'];
    $sql = "UPDATE $tblname SET status='rejected' WHERE $tblkey='$id'";
    if (mysqli_query($conn, $sql)) {
        $msg = "<div class='msg-container'><b class='alert alert-success msg'>Unapprove Successfully</b></div>";
    } else {
        $msg = "<div class='msg-container'><b class='alert alert-danger msg'>Error</b></div>";
    }
}
// Close For Reject By Admin
// Search Option With Filter

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['search'])) {
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $karykram = isset($_POST['karykram']) ? $_POST['karykram'] : '';
    $sthan = isset($_POST['sthan']) ? $_POST['sthan'] : '';
    $from_date = isset($_POST['from_date']) ? $_POST['from_date'] : '';
    $to_date = isset($_POST['to_date']) ? $_POST['to_date'] : '';

    // Start building the SQL query
    $sql = "SELECT * FROM $tblname WHERE status=1";

    // Add conditions if fields are set
    if (!empty($name)) {
        $sql .= " AND name LIKE '%" . mysqli_real_escape_string($conn, $name) . "%'";
    }
    if (!empty($karykram)) {
        $sql .= " AND karykram LIKE '%" . mysqli_real_escape_string($conn, $karykram) . "%'";
    }
    if (!empty($sthan)) {
        $sql .= " AND sthan LIKE '%" . mysqli_real_escape_string($conn, $sthan) . "%'";
    }
    if (!empty($from_date) && !empty($to_date)) {
        $sql .= " AND from_date >= '" . mysqli_real_escape_string($conn, $from_date) . "' AND to_date <= '" . mysqli_real_escape_string($conn, $to_date) . "'";
    }
    if (!empty($status)) {
        $sql .= " AND status = '" . mysqli_real_escape_string($conn, $status) . "'";
    }

    $sql .= " ORDER BY id DESC";
} else {
    $sql = "SELECT * FROM $tblname WHERE status=1 ORDER BY id DESC";
}


$fetch = mysqli_query($conn, $sql);
//  Close Search

?>

<?php include('../includes/header.php') ?>
<?php include('../includes/sidebar.php') ?>
<?php include('../includes/navbar.php') ?>

<!-- aavedak search start -->
<div class="container-fluid pt-4 px-4">
    <h4 class="text-center fw-bolder text-primary mb-3"><?= $pagename; ?></h4>
    <form action="" method="post">
        <div class="row">

            <div class="col-lg-6">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <input type="date" name="from_date" class="form-control" id="from_date" placeholder="कब से ">
                        <label for="from_date">कब से</label>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <?php
                        // Set default current date
                        $currentDate = date('Y-m-d'); // Format: YYYY-MM-DD
                        ?>
                        <input type="date" name="to_date" value="<?= $currentDate ?>" class="form-control" id="to_date" placeholder="कब तक ">
                        <label for="to_date">कब तक</label>
                    </div>
                </div>
            </div>

            <!-- btn -->
            <!-- 1 -->
            <div class="col-lg-4 text-center mb-3">
                <a name="Add_New" onclick="location.href='new_aamantran.php';" class="form-control text-center text-white btn text-center shadow bg-primary" style="background-color:#4ac387;"><b>Add New</b></a>
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
<!-- Table Start -->
<div class="container-fluid px-4">
    <div class="row">
        <div class="col-sm-12 col-lg-12">
            <h6 class="mb-4 text-center mt-2 pt-3 "><?= $pagename; ?> सूची</h6>
            <div class=" rounded" style="overflow-y: scroll;">

                <table class="table table-striped border shadow">
                    <thead class=" head">

                        <tr class="text-center">
                            <th scope="col">क्रमांक</th>
                            <th scope="col">कार्यक्रम का नाम</th>
                            <th scope="col">कब से </th>
                            <th scope="col">कब तक </th>
                            <th scope="col">समय</th>
                            <th scope="col">स्थान</th>
                            <th scope="col">प्रेषक/द्वारा</th>
                            <th scope="col">टिपणी</th>
                            <th scope="col">स्वीक्रत टिपणी</th>
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
                                <td><?= $row['karykram'] ?></td>
                                <td><?= date("d-m-Y", strtotime($row['from_date'])) ?></td>
                                <td><?= date("d-m-Y", strtotime($row['to_date'])) ?></td>
                                <td><?php
                                    $time = $row['karykram_time'];
                                    $dateTime = new DateTime($time);
                                    echo $dateTime->format('g:i A'); // Formats to '3:50 PM'
                                    ?>
                                </td>
                                <td><?= $row['sthan'] ?></td>
                                <td><?= $row['preshak'] ?></td>
                                <td><?= $row['comment'] ?></td>
                                <td><?= $row['view_comment'] ?></td>
                                <td class="action">
                                    <a href="#" onclick="view(<?= $row['id'] ?>)"><i class="fas fa-eye me-2 " title="View"></i></a>
                                    &nbsp;
                                    <!-- &nbsp; -->
                                    <!-- <a href="#" onclick="edit(<?= $row['id'] ?>)"><i class="fas fa-pen me-2 " title="Edit"></i></a>
                                    &nbsp; -->
                                    <!-- &nbsp; -->
                                    <a href="#" onclick="window.open('print_sveekrit_details.php?id=<?= $row['id'] ?>','_blank')"><i class="fas fa-solid fa-print" title="Print-Presit"></i></a>
                                    &nbsp;
                                    &nbsp;
                                    <!-- <a class="text-danger " href="#" onclick="confirmDelete(<?= $row['id']; ?>, '<?php echo $tblname; ?>', '<?= $tblkey ?>')"><i class="fas fa-trash-alt me-2 " title="Delete"></i></a> -->
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- Table End -->

<!-- The View Modal -->
<div class="modal fade" id="myModal-view" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel"><?= $pagename; ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!-- Modal Body -->
            <div class="modal-body">
                <!-- This will be replaced with the content from view.php -->
            </div>
        </div>
    </div>
</div>

<!-- The Edit Modal -->
<div class="modal fade" id="myModal-edit" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel"><?= $pagename; ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!-- Modal Body -->
            <div class="modal-body">
                <!-- This will be replaced with the content from view.php -->
            </div>
        </div>
    </div>
</div>

<!-- modal Scripts  -->
<script>
    function view(v_id) {
        //  alert(v_id);
        $.ajax({
            type: 'POST',
            url: 'sveekrt_view.php',
            data: {
                id: v_id
            },
            success: function(data) {
                $('#myModal-view').find('.modal-body').html(data);
                $('#myModal-view').modal('show');
            }
        });
    }

    function edit(e_id) {
        // alert('dsa');
        $.ajax({
            type: 'POST',
            url: 'sveekrt_aavedan_edit.php',
            data: {
                edit_id: e_id
            },
            success: function(data) {
                $('#myModal-edit').find('.modal-body').html(data);
                $('#myModal-edit').modal('show');
            }
        });
    }
</script>
<!-- Close Modal And Table View Scripts -->


<?php include('../includes/footer.php'); ?>




<?php include('../config/dbconnection.php') ?>
<?php include('../config/session_check.php') ?>
<?php
$tblname = "aamantran";
$tblkey = "id";
$pagename = "आमंत्रण प्राप्त आवेदन";


// Search Option With Filter
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['search'])) {
    $from_date = isset($_POST['from_date']) ? $_POST['from_date'] : '';
    $to_date = isset($_POST['to_date']) ? $_POST['to_date'] : '';
    $status = isset($_POST['status']) ? $_POST['status'] : '';
    $karykram = isset($_POST['karykram']) ? $_POST['karykram'] : '';

    // Start building the SQL query
    $sql = "SELECT * FROM $tblname WHERE 1";

    // Add conditions if fields are set
    if (!empty($from_date) && !empty($to_date)) {
        $sql .= " AND aamantran_date BETWEEN '" . mysqli_real_escape_string($conn, $from_date) . "' AND '" . mysqli_real_escape_string($conn, $to_date) . "'";
    }
    if (!empty($status)) {
        $sql .= " AND status = '" . mysqli_real_escape_string($conn, $status) . "'";
    }
    if (!empty($karykram)) {
        $sql .= " AND karykram = '" . mysqli_real_escape_string($conn, $karykram) . "'";
    }

    $sql .= " ORDER BY id DESC";
} else {
    $sql = "SELECT * FROM $tblname ORDER BY $tblkey DESC";
}

$fetch = mysqli_query($conn, $sql);

?>

<?php include('../includes/header.php') ?>
<?php include('../includes/sidebar.php') ?>
<?php include('../includes/navbar.php') ?>

<!-- aavedak search start -->
<div class="container-fluid pt-4 px-4">
    <h4 class="text-center fw-bolder text-primary mb-3"><?= $pagename; ?></h4>
    <form action="" method="post">
        <div class="row">
            <div class="col-lg-4 text-center mb-3">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <input type="date" name="from_date" class="form-control" id="from_date" placeholder="From Date">
                        <label for="from_date">From Date</label>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <input type="date" name="to_date" class="form-control" id="to_date" placeholder="To Date">
                        <label for="to_date">To Date</label>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <select name="status" class="form-select form-control bg-white">
                            <option value="" selected>Select Status</option>
                            <option value="pending">Pending</option>
                            <option value="approved">Approved</option>
                            <option value="rejected">Rejected</option>
                        </select>
                        <label for="status">Status</label>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <input type="text" name="karykram" class="form-control" id="karykram" placeholder="Karykram">
                        <label for="karykram">Karykram</label>
                    </div>
                </div>
            </div>

            <!-- btn -->
            <div class="col-lg-4 text-center mb-3">
                <a name="Add_New" onclick="location.href='aamantran.php';" class="form-control text-center text-white btn text-center shadow bg-primary"><b>Add New</b></a>
            </div>
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
            <div class="rounded" style="overflow-y: scroll;">
                <table class="table table-striped border shadow">
                    <thead class="head">
                        <tr class="text-center">
                            <th scope="col">क्रमांक</th>
                            <th scope="col">आवेदक का नाम</th>
                            <th scope="col">कार्यक्रम</th>
                            <th scope="col">स्थान</th>
                            <th scope="col">आमंत्रण दिनांक</th>
                            <th scope="col">टिप्पणी</th>
                            <th scope="col">प्रेषक</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (mysqli_num_rows($fetch) > 0) {
                            $i = 1;
                            while ($row = mysqli_fetch_assoc($fetch)) {
                        ?>
                                <tr class="text-center">
                                    <td><?= $i++; ?></td>
                                    <td><?= $row['name']; ?></td>
                                    <td><?= $row['karykram']; ?></td>
                                    <td><?= $row['sthan']; ?></td>
                                    <td><?= $row['aamantran_date']; ?></td>
                                    <td><?= $row['comment']; ?></td>
                                    <td><?= $row['preshak']; ?></td>
                                    <td>
                                        <?php if ($row['status'] == 'pending') { ?>
                                            <span class="badge bg-warning">Pending</span>
                                        <?php } elseif ($row['status'] == 'approved') { ?>
                                            <span class="badge bg-success">Approved</span>
                                        <?php } else { ?>
                                            <span class="badge bg-danger">Rejected</span>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <a href="aamantran_edit.php?id=<?= $row['id']; ?>" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
                                        <a href="aamantran_delete.php?id=<?= $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this record?');"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                        <?php
                            }
                        } else {
                            echo '<tr><td colspan="9" class="text-center">No records found</td></tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- Table End -->

<?php include('../includes/footer.php') ?>