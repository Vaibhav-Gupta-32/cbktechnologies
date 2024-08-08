<?php include('../config/dbconnection.php') ?>
<?php include('../config/session_check.php') ?>
<?php
$tblname = "sthantran";
$tblkey = "id";
$pagename = "अस्वीक्र्त आवेदन";
$page_name = basename($_SERVER['PHP_SELF']);

// Update Form 
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['Update'])) {

    // Ensure all POST variables are set
    $file_no = isset($_POST['file_no']) ? $_POST['file_no'] : '';
    $date = isset($_POST['date']) ? $_POST['date'] : '';
    $aavak_no = isset($_POST['aavak_no']) ? $_POST['aavak_no'] : '';
    $a_phone_number = isset($_POST['a_phone_number']) ? $_POST['a_phone_number'] : '';
    $a_aavedak_name = isset($_POST['a_aavedak_name']) ? $_POST['a_aavedak_name'] : '';
    $a_district_id = isset($_POST['a_district_id']) ? $_POST['a_district_id'] : '';
    $a_vidhansabha_id = isset($_POST['a_vidhansabha_id']) ? $_POST['a_vidhansabha_id'] : '';
    $a_vikaskhand_id = isset($_POST['a_vikaskhand_id']) ? $_POST['a_vikaskhand_id'] : '';
    $a_sector_id = isset($_POST['a_sector_id']) ? $_POST['a_sector_id'] : '';
    $a_gram_panchayat_id = isset($_POST['a_gram_panchayat_id']) ? $_POST['a_gram_panchayat_id'] : '';
    $a_gram_id = isset($_POST['a_gram_id']) ? $_POST['a_gram_id'] : '';
    $a_subject = isset($_POST['a_subject']) ? $_POST['a_subject'] : '';
    $a_reference = isset($_POST['a_reference']) ? $_POST['a_reference'] : '';
    $a_office_name = isset($_POST['a_office_name']) ? $_POST['a_office_name'] : '';
    $a_jaavak_vibhag = isset($_POST['a_jaavak_vibhag']) ? $_POST['a_jaavak_vibhag'] : '';
    $a_kisko_presit = isset($_POST['a_kisko_presit']) ? $_POST['a_kisko_presit'] : '';
    $a_jaavak_date = isset($_POST['a_jaavak_date']) ? $_POST['a_jaavak_date'] : '';
    $a_application_date = isset($_POST['a_application_date']) ? $_POST['a_application_date'] : '';
    $a_mantri_comment = isset($_POST['a_mantri_comment']) ? $_POST['a_mantri_comment'] : '';

    $v_mantri_comment = isset($_POST['v_mantri_comment']) ? $_POST['v_mantri_comment'] : '';
    $v_aavak_vibhag = isset($_POST['v_aavak_vibhag']) ? $_POST['v_aavak_vibhag'] : '';
    $v_subject = isset($_POST['v_subject']) ? $_POST['v_subject'] : '';
    $v_reference = isset($_POST['v_reference']) ? $_POST['v_reference'] : '';
    $v_office_name = isset($_POST['v_office_name']) ? $_POST['v_office_name'] : '';
    $v_jaavak_vibhag = isset($_POST['v_jaavak_vibhag']) ? $_POST['v_jaavak_vibhag'] : '';
    $v_kisko_presit = isset($_POST['v_kisko_presit']) ? $_POST['v_kisko_presit'] : '';
    $v_jaavak_date = isset($_POST['v_jaavak_date']) ? $_POST['v_jaavak_date'] : '';
    $v_aadesh_date = isset($_POST['v_aadesh_date']) ? $_POST['v_aadesh_date'] : '';

    // $a_file_upload_1 = $_POST['a_file_upload_1'];
    // $a_file_upload_2 = $_POST['a_file_upload_2'];
    // $v_file_upload_1 = $_POST['v_file_upload_1'];
    // $v_file_upload_2 = $_POST['v_file_upload_2'];


    if (isset($_POST['edit_id']) && !empty($_POST['edit_id'])) {
        $s_id = $_POST['edit_id'];

        // Check if a new file was uploaded
        if (!empty($file_upload)) {
            // File upload handling
            $uploadOk = "";
            $target_dir = "uploads/";
            $maxSize = 5000000; // 5 MB
            $allowedTypes = ["jpg", "png", "pdf"];

            // Initialize variables
            $a_file_upload1 = $a_file_upload2 = $v_file_upload1 = $v_file_upload2 = ['success' => false, 'filePath' => ''];

            // Call the function for each file upload if the file is set
            if (isset($_FILES['a_file_upload_1']) && !empty($_FILES['a_file_upload_1']['name']))
                $a_file_upload1 = handleFileUpload('a_file_upload_1', $target_dir, $maxSize, $allowedTypes);
            if (isset($_FILES['a_file_upload_2']) && !empty($_FILES['a_file_upload_2']['name']))
                $a_file_upload2 = handleFileUpload('a_file_upload_2', $target_dir, $maxSize, $allowedTypes);
            if (isset($_FILES['v_file_upload_1']) && !empty($_FILES['v_file_upload_1']['name']))
                $v_file_upload1 = handleFileUpload('v_file_upload_1', $target_dir, $maxSize, $allowedTypes);
            if (isset($_FILES['v_file_upload_2']) && !empty($_FILES['v_file_upload_2']['name']))
                $v_file_upload2 = handleFileUpload('v_file_upload_2', $target_dir, $maxSize, $allowedTypes);


            if (!empty($a_file_upload1['success']) || !empty($a_file_upload2['success']) || !empty($v_file_upload1['success']) || !empty($v_file_upload2['success'])) {
                // echo "At least one file was uploaded successfully.";
                $uploadOk = 1;
                $a_file1_path = $a_file_upload1['filePath'];
                $a_file2_path = $a_file_upload2['filePath'];
                $v_file1_path = $v_file_upload1['filePath'];
                $v_file2_path = $v_file_upload2['filePath'];
            } else {
                // echo "File upload failed.";
                $uploadOk = 0;
            }
        } else {
            // No new file uploaded, use the existing file
            $uploaded_file_path = $_POST['existing_file'];
        }

        if ($uploadOk == 1) {
            // Prepare the update query
            $update_query = "UPDATE aavedan SET 
                date = '$date', 
                aavak_no = '$aavak_no', 
                a_phone_number = '$a_phone_number', 
                a_aavedak_name = '$a_aavedak_name', 
                a_district_id = '$a_district_id', 
                a_vidhansabha_id = '$a_vidhansabha_id', 
                a_vikaskhand_id = '$a_vikaskhand_id', 
                a_sector_id = '$a_sector_id', 
                a_gram_panchayat_id = '$a_gram_panchayat_id', 
                a_gram_id = '$a_gram_id', 
                a_subject = '$a_subject', 
                a_reference = '$a_reference', 
                a_office_name = '$a_office_name', 
                a_jaavak_vibhag = '$a_jaavak_vibhag', 
                a_kisko_presit = '$a_kisko_presit', 
                a_jaavak_date = '$a_jaavak_date', 
                a_application_date = '$a_application_date', 
                a_mantri_comment = '$a_mantri_comment',
                v_mantri_comment = '$v_mantri_comment', 
                v_aavak_vibhag = '$v_aavak_vibhag', 
                v_subject = '$v_subject', 
                v_reference = '$v_reference', 
                v_office_name = '$v_office_name', 
                v_jaavak_vibhag = '$v_jaavak_vibhag', 
                v_kisko_presit = '$v_kisko_presit', 
                v_jaavak_date = '$v_jaavak_date', 
                v_aadesh_date = '$v_aadesh_date'
                WHERE $tblkey = '$s_id'";
            echo $update_query;
            die;

            if (mysqli_query($conn, $update_query)) {
                $msg = "<div class='msg-container'><b class='alert alert-warning msg'>Update Successfully</b></div>";
            } else {
                $msg = "<div class='msg-container'><b class='alert alert-danger msg'>Update Not Successfully!!</b></div>";
            }
        } else {
            $msg = "<div class='msg-container'><b class='alert alert-danger msg'>Sorry, your file was not uploaded.</b></div>";
        }
    }
}

// If Approve By Admin 
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['approve'])) {
    $vid = $_POST['id'];
   

    $sql = "UPDATE $tblname SET status='3' WHERE $tblkey='$vid'";
    // echo $sql,'----'.$id;die;
    //    echo $sql;die;
    if (mysqli_query($conn, $sql)) {
        $msg = "<div class='msg-container'><b class='alert alert-success msg'>Approved Successfully</b></div>";
    } else {
        $msg = "<div class='msg-container'><b class='alert alert-danger msg'>Error</b></div>";
    }
}
// Close Approve Admin

// If Reject By Admin
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['UnApprove'])) {
    $id = $_POST['id'];
    // echo 'dasd'.$id;die;
    $sql = "UPDATE $tblname SET status='4' WHERE $tblkey='$id'";
    if (mysqli_query($conn, $sql)) {
        $msg = "<div class='msg-container'><b class='alert alert-success msg'>Unapprove Successfully</b></div>";
    } else {
        $msg = "<div class='msg-container'><b class='alert alert-danger msg'>Error</b></div>";
    }
}
// Close For Reject By Admin
// Search Option With Filter
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['search'])) {
    $district_id = isset($_POST['district_id']) ? $_POST['district_id'] : '';
    $vidhansabha_id = isset($_POST['vidhansabha_id']) ? $_POST['vidhansabha_id'] : '';
    $vikaskhand_id = isset($_POST['vikaskhand_id']) ? $_POST['vikaskhand_id'] : '';
    $sector_id = isset($_POST['sector_id']) ? $_POST['sector_id'] : '';
    $gram_panchayat_id = isset($_POST['gram_panchayat_id']) ? $_POST['gram_panchayat_id'] : '';
    $gram_id = isset($_POST['gram_id']) ? $_POST['gram_id'] : '';
    $phone_number = isset($_POST['phone_number']) ? $_POST['phone_number'] : '';
    $from_date = isset($_POST['from_date']) ? $_POST['from_date'] : '';
    $to_date = isset($_POST['to_date']) ? $_POST['to_date'] : '';
    $area_id = isset($_POST['area_id']) ? $_POST['area_id'] : '';

    // Start building the SQL query
    $sql = "SELECT a.*, d.district_name, v.vidhansabha_name, vk.vikaskhand_name, s.sector_name, gp.gram_panchayat_name, g.gram_name 
    , am.area_name AS area_name
FROM $tblname a 
    LEFT JOIN district_master d ON a.district_id = d.district_id
    LEFT JOIN vidhansabha_master v ON a.vidhansabha_id = v.vidhansabha_id
    LEFT JOIN vikaskhand_master vk ON a.vikaskhand_id = vk.vikaskhand_id
    LEFT JOIN sector_master s ON a.sector_id = s.sector_id
    LEFT JOIN gram_panchayat_master gp ON a.gram_panchayat_id = gp.gram_panchayat_id
    LEFT JOIN gram_master g ON a.gram_id = g.gram_id
      LEFT JOIN area_master am ON a.area_id = am.area_id

    WHERE a.status=0";

    // Add conditions if fields are set
    if (!empty($district_id)) {
        $sql .= " AND a.district_id = '" . mysqli_real_escape_string($conn, $district_id) . "'";
    }
    if (!empty($vidhansabha_id)) {
        $sql .= " AND a.vidhansabha_id = '" . mysqli_real_escape_string($conn, $vidhansabha_id) . "'";
    }
    if (!empty($area_id)) {
        $sql .= " AND a.area_id = '" . mysqli_real_escape_string($conn, $area_id) . "'";
    }
    if (!empty($vikaskhand_id)) {
        $sql .= " AND a.vikaskhand_id = '" . mysqli_real_escape_string($conn, $vikaskhand_id) . "'";
    }
    if (!empty($sector_id)) {
        $sql .= " AND a.sector_id = '" . mysqli_real_escape_string($conn, $sector_id) . "'";
    }
    if (!empty($gram_panchayat_id)) {
        $sql .= " AND a.gram_panchayat_id = '" . mysqli_real_escape_string($conn, $gram_panchayat_id) . "'";
    }
    if (!empty($gram_id)) {
        $sql .= " AND a.gram_id = '" . mysqli_real_escape_string($conn, $gram_id) . "'";
    }
    if (!empty($phone_number)) {
        $sql .= " AND phone_number = '" . mysqli_real_escape_string($conn, $phone_number) . "'";
    }
    if (!empty($from_date) && !empty($to_date)) {
        $sql .= " AND application_date BETWEEN '" . mysqli_real_escape_string($conn, $from_date) . "' AND '" . mysqli_real_escape_string($conn, $to_date) . "'";
    }
    $sql .= " ORDER BY id DESC";
    // echo $sql;die;
} else {
    $sql = "SELECT a.*, d.district_name, v.vidhansabha_name, vk.vikaskhand_name, s.sector_name, gp.gram_panchayat_name, g.gram_name 
    FROM $tblname a 
    LEFT JOIN district_master d ON a.district_id = d.district_id
    LEFT JOIN vidhansabha_master v ON a.vidhansabha_id = v.vidhansabha_id
    LEFT JOIN vikaskhand_master vk ON a.vikaskhand_id = vk.vikaskhand_id
    LEFT JOIN sector_master s ON a.sector_id = s.sector_id
    LEFT JOIN gram_panchayat_master gp ON a.gram_panchayat_id = gp.gram_panchayat_id
    LEFT JOIN gram_master g ON a.gram_id = g.gram_id
    WHERE a.status=4
    ORDER BY a.$tblkey DESC";
}
// echo $sql;
$fetch = mysqli_query($conn, $sql);
//  Close Search

?>

<?php include('../includes/header.php') ?>
<?php include('../includes/sidebar.php') ?>
<?php include('../includes/navbar.php') ?>
<!-- For search bar -->
<?php include('../location/search.php') ?>

<!-- Table Start -->
<div class="container-fluid px-4">
    <div class="row">
        <div class="col-sm-12 col-lg-12">
            <h6 class="mb-4 text-center mt-2 pt-3 "><?= $pagename; ?> सूची</h6>
            <div class=" rounded" style="overflow-y: scroll;">

                <table class="table table-striped border shadow">
                    <thead class=" head">
                        <tr class="text-center text-nowrap">
                            <th scope="col">क्रमांक</th>
                            <th scope="col">आवेदक का नाम</th>
                            <th scope="col">विषय</th>
                            <th scope="col">विधानसभा</th>
                            <th scope="col">वर्त्तमान पद</th>
                            <th scope="col">प्रस्तावित पद</th>
                            <th scope="col">आवेदन दिनांक</th>
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
                                <td><?= $row['name'] ?></td>
                                <td><?= $row['subject'] ?></td>
                                <td><?= $row['vidhansabha_name'] ?></td>
                                <td><?= $row['c_designation_place'] ?></td>
                                <td><?= $row['f_designation_place'] ?></td>
                                <td><?= date("d-m-Y", strtotime($row['application_date'])) ?></td>
                                <td class="action">
                                    <a href="#" onclick="view(<?= $row['id'] ?>)"><i class="fas fa-eye me-2 " title="View"></i></a>
                                    <!-- &nbsp; -->
                                    &nbsp;
                                    <a href="#" onclick="edit(<?= $row['id'] ?>)"><i class="fas fa-pen me-2 " title="Edit"></i></a>
                                    <!-- &nbsp; -->
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
            url: 'asveekrt_view.php',
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
            url: 'aavedan_edit.php',
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