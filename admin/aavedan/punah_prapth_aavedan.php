<?php include('../config/dbconnection.php') ?>
<?php include('../config/session_check.php') ?>
<?php
$tblname = "aavedan";
$tblkey = "id";
$pagename = "पुनः प्राप्त आवेदन";
$page_name = basename($_SERVER['PHP_SELF']);
// Update Form 
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['Update'])) {

    // Ensure all POST variables are set
    $file_no = isset($_POST['file_no']) ? $_POST['file_no'] : '';
    $date = isset($_POST['date']) ? $_POST['date'] : '';
    $aavak_no = isset($_POST['aavak_no']) ? $_POST['aavak_no'] : '';
    $a_phone_number = isset($_POST['a_phone_number']) ? $_POST['a_phone_number'] : '';
    $a_aavedak_name = isset($_POST['a_aavedak_name']) ? $_POST['a_aavedak_name'] : '';
    $district_id = isset($_POST['district_id']) ? $_POST['district_id'] : '';
    $vidhansabha_id = isset($_POST['vidhansabha_id']) ? $_POST['vidhansabha_id'] : '';
    $vikaskhand_id = isset($_POST['vikaskhand_id']) ? $_POST['vikaskhand_id'] : '';
    $sector_id = isset($_POST['sector_id']) ? $_POST['sector_id'] : '';
    $gram_panchayat_id = isset($_POST['gram_panchayat_id']) ? $_POST['gram_panchayat_id'] : '';
    $gram_id = isset($_POST['gram_id']) ? $_POST['gram_id'] : '';
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
            $a_uploaded_file_path_1 = isset($_POST['a_existing_file_1']) ? $_POST['a_existing_file_1'] : "" ;
            $a_uploaded_file_path_2 = isset($_POST['a_existing_file_2']) ? $_POST['a_existing_file_2'] : "" ;
            $v_uploaded_file_path_1 = isset($_POST['v_existing_file_1']) ? $_POST['v_existing_file_1'] : "" ;
            $v_uploaded_file_path_2 = isset($_POST['v_existing_file_2']) ? $_POST['v_existing_file_2'] : "" ;

            if($a_uploaded_file_path_1 > 0 || $a_uploaded_file_path_2 > 0 || $v_uploaded_file_path_1 > 0 || $v_uploaded_file_path_2 > 0){
                $uploadOk = 1;
            }
        }

        if ($uploadOk == 1) {
            // Prepare the update query
            $update_query = "UPDATE $tblname SET 
                date = '$date', 
                aavak_no = '$aavak_no', 
                a_phone_number = '$a_phone_number', 
                a_aavedak_name = '$a_aavedak_name', 
                district_id = '$district_id', 
                vidhansabha_id = '$vidhansabha_id', 
                vikaskhand_id = '$vikaskhand_id', 
                sector_id = '$sector_id', 
                gram_panchayat_id = '$gram_panchayat_id', 
                gram_id = '$gram_id', 
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
                v_aadesh_date = '$v_aadesh_date',
                a_file_upload_1 = '$a_uploaded_file_path_1',
                a_file_upload_2 = '$a_uploaded_file_path_2',
                v_file_upload_1 = '$v_uploaded_file_path_1',
                v_file_upload_2 = '$v_uploaded_file_path_2'

                WHERE $tblkey = '$s_id'";
            // echo $update_query;
            // die;

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
    $id = $_REQUEST['id'];
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

    // Start building the SQL query
    $sql = "SELECT a.*, d.district_name, v.vidhansabha_name, vk.vikaskhand_name, s.sector_name, gp.gram_panchayat_name, g.gram_name 
    FROM $tblname a 
    LEFT JOIN district_master d ON a.district_id = d.district_id
    LEFT JOIN vidhansabha_master v ON a.vidhansabha_id = v.vidhansabha_id
    LEFT JOIN vikaskhand_master vk ON a.vikaskhand_id = vk.vikaskhand_id
    LEFT JOIN sector_master s ON a.sector_id = s.sector_id
    LEFT JOIN gram_panchayat_master gp ON a.gram_panchayat_id = gp.gram_panchayat_id
    LEFT JOIN gram_master g ON a.gram_id = g.gram_id
    WHERE a.status=0";

    // Add conditions if fields are set
    if (!empty($district_id)) {
        $sql .= " AND a.district_id = '" . mysqli_real_escape_string($conn, $district_id) . "'";
    }
    if (!empty($vidhansabha_id)) {
        $sql .= " AND a.vidhansabha_id = '" . mysqli_real_escape_string($conn, $vidhansabha_id) . "'";
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
    $sql = "SELECT 
  a.*,
  vm.vibhag_name AS a_vibhag_name,
  dm.district_name AS district_name,
  vm2.vidhansabha_name AS vidhansabha_name,
  vm3.vikaskhand_name AS vikaskhand_name,
  sm.sector_name AS sector_name,
  gpm.gram_panchayat_name AS gram_panchayat_name,
  gm.gram_name AS gram_name,
  vm4.vibhag_name AS v_vibhag_name,
  vm5.vibhag_name AS v_aavak_vibhag

FROM 
  $tblname a
  LEFT JOIN vibhag_master vm ON a.a_jaavak_vibhag = vm.vibhag_id
  LEFT JOIN district_master dm ON a.district_id = dm.district_id
  LEFT JOIN vidhansabha_master vm2 ON a.vidhansabha_id = vm2.vidhansabha_id
  LEFT JOIN vikaskhand_master vm3 ON a.vikaskhand_id = vm3.vikaskhand_id
  LEFT JOIN sector_master sm ON a.sector_id = sm.sector_id
  LEFT JOIN gram_panchayat_master gpm ON a.gram_panchayat_id = gpm.gram_panchayat_id
  LEFT JOIN gram_master gm ON a.gram_id = gm.gram_id
  LEFT JOIN vibhag_master vm4 ON a.v_jaavak_vibhag = vm4.vibhag_id
  LEFT JOIN vibhag_master vm5 ON a.v_aavak_vibhag = vm4.vibhag_id

WHERE 
  a.status = '2'
ORDER BY 
  $tblkey DESC;";
}
// echo $sql;
$fetch = mysqli_query($conn, $sql);
//  Close Search
 
?>

<?php include('../includes/header.php') ?>
<?php include('../includes/sidebar.php') ?>
<?php include('../includes/navbar.php') ?>
<?php include('../location/search.php') ?>
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
                        <tr class="text-center text-nowrap">
                            <th scope="col">क्रमांक</th>
                            <th scope="col">फाइल क्र</th>
                            <th scope="col">आवक क्र</th>
                            <th scope="col">आवक विभाग/आवेदक</th>
                            <th scope="col">विषय</th>
                            <th scope="col">आदेश दिनांक</th>
                            <th scope="col">जावक क्र</th>
                            <th scope="col">किसे प्रेषित किया गया </th>
                            <th scope="col">जावक दिनांक</th>
                            <th scope="col">Action</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        while ($row = mysqli_fetch_array($fetch)) {
                            $choose_aavedak_vibhag = $row['choose_aavedak_vibhag'];
                        ?>
                            <tr class=" text-center">
                                <th scope="row"><?= $i++ ?></th>
                                <td><?= $row['file_no'] ?></td>
                                <td><?= $row['aavak_no'] ?></td>
                                <td><?php if ($choose_aavedak_vibhag == 1) {
                                        echo $row['a_vibhag_name'];
                                    } else {
                                        echo $row['v_vibhag_name'];
                                    } ?></td>
                                <td><?php if ($choose_aavedak_vibhag == 1) {
                                        echo $row['a_subject'];
                                    } else {
                                        echo $row['v_subject'];
                                    } ?></td>
                                <td><?php if ($choose_aavedak_vibhag == 1) {
                                        echo date('d-m-Y', strtotime($row['a_application_date']));
                                    } else {
                                        echo date('d-m-Y', strtotime($row['v_aadesh_date']));
                                    } ?></td>
                                <td>null </td>
                                <td><?php if ($choose_aavedak_vibhag == 1) {
                                        echo $row['a_kisko_presit'];
                                    } else {
                                        echo $row['v_kisko_presit'];
                                    } ?></td>
                                <td><?php if ($choose_aavedak_vibhag == 1) {
                                        echo date('d-m-Y', strtotime($row['a_jaavak_date']));
                                    } else {
                                        echo date('d-m-Y', strtotime($row['v_jaavak_date']));
                                    } ?></td>

                                <td class="action">
                                    <a href="#" onclick="view(<?= $row['id'] ?>)"><i class="fas fa-eye me-2 " title="View"></i></a>
                                    &nbsp;
                                    &nbsp;
                                    <a href="#" onclick="edit(<?= $row['id'] ?>)"><i class="fas fa-pen me-2 " title="Edit"></i></a>
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
            url: 'punah_prapth_view.php',
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
            url: 'punah_prapth_edit.php',
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