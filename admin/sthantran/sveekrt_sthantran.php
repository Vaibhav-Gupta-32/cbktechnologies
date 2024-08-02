<?php include('../config/dbconnection.php') ?>
<?php include('../config/session_check.php') ?>
<?php
$tblname = "sthantran";
$tblkey = "id";
$pagename = "स्वीकृत आवेदन";
$currentDate = date('Y-m-d');

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
    $sql = "SELECT a.*, d.district_name, v.vidhansabha_name, vk.vikaskhand_name, s.sector_name, gp.gram_panchayat_name, g.gram_name 
    FROM $tblname a 
    LEFT JOIN district_master d ON a.district_id = d.district_id
    LEFT JOIN vidhansabha_master v ON a.vidhansabha_id = v.vidhansabha_id
    LEFT JOIN vikaskhand_master vk ON a.vikaskhand_id = vk.vikaskhand_id
    LEFT JOIN sector_master s ON a.sector_id = s.sector_id
    LEFT JOIN gram_panchayat_master gp ON a.gram_panchayat_id = gp.gram_panchayat_id
    LEFT JOIN gram_master g ON a.gram_id = g.gram_id
    WHERE a.status=1
    ORDER BY a.$tblkey DESC";
}

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
    <h4 class="text-center fw-bolder text-primary mb-3"><?= $pagename; ?></h4>
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

            <div class="col-lg-4">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <select name="vidhansabha_id" id="vidhansabhaSelect" class="form-select form-control bg-white ">
                            <option value="" selected>विधानसभा का नाम चुनें</option>
                            <!-- Options for vidhansabha will go here -->
                        </select>
                        <label for="vidhansabha">विधानसभा का नाम चुनें </label>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <select name="vikaskhand_id" id="vikaskhandSelect" class="form-select form-control bg-white">
                            <option value="" selected disabled>विकासखंड का नाम चुनें</option>
                            <!-- Option Load By AJAX -->

                        </select>
                        <label for="vikaskhand">विकासखंड का नाम चुनें </label>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <select name="sector_id" id="sectorSelect" class="form-select form-control bg-white">
                            <option value="" selected>सेक्टर का नाम चुनें</option>
                            <!-- Options for sectors will go here -->
                        </select>
                        <label for="sector">सेक्टर का नाम चुनें </label>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <select name="gram_panchayat_id" id="gramPanchayatSelect" class="form-select form-control bg-white">
                            <option value="" selected>ग्राम पंचायत का नाम चुनें</option>
                            <!-- Options for panchayat will go here -->
                        </select>
                        <label for="gram_panchayt">ग्राम पंचायत का नाम चुनें </label>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <select class="form-select" id="gramSelect" name="gram_id">
                            <option value="" selected>ग्राम का नाम चुनें</option>
                            <!-- by load ajax -->
                        </select>
                        <label for="gram">ग्राम का नाम चुनें </label>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <input type="text" name="phone_number" class="form-control" id="phone_number" placeholder="आवेदक का फ़ोन नंबर" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                        <label for="mobile">आवेदक का फ़ोन नंबर </label>
                    </div>

                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <input type="date" name="from_date" class="form-control" id="from_date" placeholder="कब से ">
                        <label for="from_date">कब से</label>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
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
                <a name="Add_New" onclick="location.href='swekshanudan.php';" class="form-control text-center text-white btn text-center shadow bg-primary" style="background-color:#4ac387;"><b>Add New</b></a>
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
                        <tr class="text-center">
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
                                    <!-- <a href="#" onclick="edit(<?= $row['id'] ?>)"><i class="fas fa-pen me-2 " title="Edit"></i></a> -->
                                    <a href="sthantran_print.php?id=<?=$row['id'];?>" target='_blank' ><i class=" fa fa-solid fa-print" title="प्रेषित स्वीकृत आवेदन "></i></a>
                                    <!-- &nbsp; -->
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

<?php include('../includes/footer.php'); ?>