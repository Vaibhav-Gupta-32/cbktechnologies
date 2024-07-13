<?php include('../dbconnection.php') ?>
<?php include('../session_check.php') ?>
<?php
$tblname = "Aavedak";
$tblkey = "id";
$pagename = "आवेदक";
if (isset($_REQUEST['id']))
    $id = $_REQUEST['id'];
// View Id Recived
if ($id) {
    $sql = "SELECT a.*, d.district_name, v.vidhansabha_name, vk.vikaskhand_name, s.sector_name, gp.gram_panchayat_name, g.gram_name 
    FROM swekshanudan a 
    LEFT JOIN district_master d ON a.district_id = d.district_id
    LEFT JOIN vidhansabha_master v ON a.vidhansabha_id = v.vidhansabha_id
    LEFT JOIN vikaskhand_master vk ON a.vikaskhand_id = vk.vikaskhand_id
    LEFT JOIN sector_master s ON a.sector_id = s.sector_id
    LEFT JOIN gram_panchayat_master gp ON a.gram_panchayat_id = gp.gram_panchayat_id
    LEFT JOIN gram_master g ON a.gram_id = g.gram_id
    ORDER BY a.id DESC";
    $fetch = mysqli_fetch_array(mysqli_query($conn, $sql));
    $id = $fetch['id'];
    $name = $fetch['name'];
    $phone_number = $fetch['phone_number'];
    $designation = $fetch['designation'];
    $district_id = $fetch['district_id'];
    $vidhansabha_name = $fetch['vidhansabha_name'];
    $vikaskhand_name = $fetch['vikaskhand_name'];
    $sector_name = $fetch['sector_name'];
    $gram_panchayat_name = $fetch['gram_panchayat_name'];
    $gram_name = $fetch['gram_name'];
    $subject = $fetch['subject'];
    $reference = $fetch['reference'];
    $expectations_amount = $fetch['expectations_amount'];
    $application_date = $fetch['application_date'];
    // $application_date =date("d-m-Y",strtotime($fetch['application_date'])); 
    $comment = $fetch['comment'];
    $file_upload = $fetch['file_upload'];
}
// Close For Buinding Db To form Data 


// Update the record in the database
//         $update_query = "UPDATE swekshanudan SET 
//             name = '$name', 
//             phone_number = '$phone_number', 
//             designation = '$designation', 
//             district_id = $district_id, 
//             vidhansabha_id = $vidhansabha_id, 
//             vikaskhand_id = $vikaskhand_id, 
//             sector_id = $sector_id, 
//             gram_panchayat_id = '$gram_panchayat_id', 
//             gram_id = '$gram_id', 
//             subject = '$subject', 
//             reference = '$reference', 
//             expectations_amount = $expectations_amount, 
//             application_date = '$application_date', 
//             comment = '$comment',
//             file_upload = '$file_upload' 
//             WHERE id = $id";

//         if (mysqli_query($conn, $update_query)) {
//             echo "Record updated successfully";
//         } else {
//             echo "Error updating record: " . mysqli_error($conn);
// }

//     // Fetch the existing record
//     $id = intval($_GET['id']);
//     $query = "SELECT * FROM swekshanudan WHERE id = $id";
//     $result = mysqli_query($conn, $query);
//     $row = mysqli_fetch_assoc($result);
//     
?>
<!-- Include jQuery library -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Start New Swekshanudan Form -->
<style>
    input[type="file"]::file-selector-button {
        color: #00698f;
        /* change the text color to blue */
        background-color: white;
        /* change the background color to light gray */
        border: none;
    }
</style>
<form action="" method="POST" enctype="multipart/form-data">
    <div class="container-fluid pt-4 px-4 ">
        <h4 class="text-center fw-bolder text-primary mb-3"><?= $pagename; ?></h4>
        <hr class="text-info p-2 rounded">
        <div class="row">
            <div class="col-lg-4 col-md-12 col-sm-12 align-content-center">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="name" id="aavedak" value="<?= $name ?>" placeholder="आवेदक का नाम" required>
                        <label for="aavedak">आवेदक का नाम <span class="text-danger">*</span> </label>
                    </div>

                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" maxlength="10" name="phone_number" value="<?= $phone_number ?>" id="phone_number" placeholder="आवेदक का फ़ोन नंबर" onkeypress='return event.charCode >= 48 && event.charCode <= 57' required>
                        <label for="phone_number">आवेदक का फ़ोन नंबर <span class="text-danger">*</span></label>
                    </div>
                </div>
            </div>


            <div class="col-lg-4">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="designation" id="designation" value="<?= $designation ?>" placeholder="पद का नाम" required>
                        <label for="designation">पद का नाम <span class="text-danger">*</span> </label>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 text-center mb-3">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
<select name="district_id" id="districtSelect" class="form-select form-control bg-white" onchange="vidhansabhaChange(this.value)">
    <?php
    // Fetch districts for dropdown
    $district_query = "SELECT * FROM district_master";
    $district_result = mysqli_query($conn, $district_query);
    ?>

    <option value="">-- Select --</option>
    <?php
    while ($district_row = mysqli_fetch_assoc($district_result)) {
        $selected = ($district_row['district_id'] == $fetch['district_id']) ? 'selected' : '';
        echo "<option value='" . $district_row['district_id'] . "' " . $selected . ">" . $district_row['district_name'] . "</option>";
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
                            <option selected>विधानसभा का नाम चुनें</option>
                            <!-- Options for vidhansabha will go here -->
                        </select>
                        <script>  
                        // document.getElementById('vidhansabhaSelect').value="1";
                        </script>
                        <label for="vidhansabha">विधानसभा का नाम चुनें </label>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <select name="vikaskhand_id" id="vikaskhandSelect" class="form-select form-control bg-white">
                            <option selected>विकासखंड का नाम चुनें</option>
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
                            <option selected>सेक्टर का नाम चुनें</option>
                            <!-- Options for sectors will go here -->
                        </select>
                        <label for="sector">सेक्टर का नाम चुनें </label>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <select name="sector_id" id="gramPanchayatSelect" class="form-select form-control bg-white">
                            <option selected>ग्राम पंचायत का नाम चुनें</option>
                            <!-- Options for panchayat will go here -->
                        </select>
                        <label for="gram_panchayt">ग्राम पंचायत का नाम चुनें </label>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <select class="form-select" id="gramSelect" name="gram">
                            <option selected>ग्राम का नाम चुनें</option>
                            <!-- by load ajax -->
                        </select>
                        <label for="gram">ग्राम का नाम चुनें </label>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group shadow">
                    <div class="form-floating mb-3 ">
                        <input type="file" class="form-control bg-white" id="file_upload" placeholder="फाइल अपलोड करें" required name="file_upload">
                        <label for="file_upload">फाइल अपलोड करें <span class="text-danger">*</span> </label>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="subject" placeholder="विषय" required name="subject">
                        <label for="subject">विषय का नाम <span class="text-danger">*</span> </label>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="reference" placeholder="द्वारा" required name="reference">
                        <label for="reference">द्वारा <span class="text-danger">*</span> </label>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <input type="date" class="form-control" id="application_date" value="" placeholder="आवेदन दिनांक" required name="application_date">
                        <label for="application_date">आवेदन दिनांक <span class="text-danger">*</span> </label>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="expectations_amount" placeholder="आपेक्षित राशि" required name="expectations_amount" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                        <label for="expectations_amount">आपेक्षित राशि <span class="text-danger">*</span> </label>
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
                        <input type="date" class="form-control" id="update_date" value="<?= $currentDate ?>" placeholder="अपडेट दिनांक" required name="update_date">
                        <label for="update_date">अपडेट दिनांक <span class="text-danger">*</span> </label>
                    </div>
                </div>
            </div>

            <div class="col-lg-12">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <textarea class="form-control" id="comment" placeholder="टिप्पणी" required style="height: 150px;" name="comment"></textarea>
                        <label for="comment">टिप्पणी <span class="text-danger">*</span> </label>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 text-center mb-3">
                <div class="form-group">
                    <button class="col-12 text-white btn  text-center shadow" id="Update" type="submit" style="background-color:#4ac387;" name="Update"><b>Update</b></button>
                </div>
            </div>
            <div class="col-lg-6 text-center mb-3">
                <div class="form-group">
                    <button class="col-12 text-white btn  text-center shadow btn-info" id="Print" type="submit" name="Print"><b>Print</b></button>
                </div>
            </div>

            <!--  -->
        </div>
    </div>
</form>
<!-- New Swekshanudan close -->

<!-- Script For DropDown List -->
<!-- <a href="../"></a> -->
<script>





    // For Vidhansabha
    // 
    // function vidhansabhaChange(dis_id)
    $(document).ready(function() {
        $('#districtSelect').change(function() {
            var district_id = $(this).val();
            alert("Selected District ID: " + district_id);
            $.ajax({
                url: 'ajax/get_vidhansabha.php',
                type: 'POST',
                data: {
                    district_id: district_id
                },
                success: function(data) {
                    var vidhansabha = JSON.parse(data);
                    $('#vidhansabhaSelect').empty();
                    $('#vidhansabhaSelect').append('<option selected>विधानसभा का नाम चुनें</option>');
                    $.each(vidhansabha, function(index, vidhansabha) {
                        $('#vidhansabhaSelect').append('<option value="' + vidhansabha.vidhansabha_id + '">' + vidhansabha.vidhansabha_name + '</option>');
                    });
                }
            });
        });
    });

$(document).ready(function()) {
        $('#districtSelect').change(function())
}
    // For Vikaskhand
    $(document).ready(function() {
        $('#vidhansabhaSelect').change(function() {
            var vidhansabha_id = $(this).val();
            //alert("Selected Vidhansabha ID: " + vidhansabha_id);
            $.ajax({
                url: 'ajax/get_vikaskhand.php',
                type: 'POST',
                data: {
                    vidhansabha_id: vidhansabha_id
                },
                success: function(data) {
                    var vikaskhand = JSON.parse(data);
                    $('#vikaskhandSelect').empty();
                    $('#vikaskhandSelect').append('<option selected>विकासखंड का नाम चुनें</option>');
                    $.each(vikaskhand, function(index, vikaskhand) {
                        $('#vikaskhandSelect').append('<option value="' + vikaskhand.vikaskhand_id + '">' + vikaskhand.vikaskhand_name + '</option>');
                    });
                },
                error: function(xhr, status, error) {
                    console.error('Error: ' + status + ' - ' + error);
                }
            });
        });
    });
    // For Sector Load 
    $(document).ready(function() {
        $('#vikaskhandSelect').change(function() {
            var vikaskhand_id = $(this).val();
            //alert("Selected Vikaskhand ID: " + vikaskhand_id);
            $.ajax({
                url: 'ajax/get_sector.php', // Replace with your PHP file to fetch sectors
                type: 'POST',
                data: {
                    vikaskhand_id: vikaskhand_id
                },
                success: function(data) {
                    var sectors = JSON.parse(data);
                    $('#sectorSelect').empty();
                    $('#sectorSelect').append('<option selected>सेक्टर का नाम चुनें</option>');
                    $.each(sectors, function(index, sector) { // Changed variable name to 'sector' to avoid conflict
                        $('#sectorSelect').append('<option value="' + sector.sector_id + '">' + sector.sector_name + '</option>'); // Corrected selector
                    });
                },
                error: function(xhr, status, error) {
                    console.error('Error: ' + status + ' - ' + error);
                }
            });
        });
    });
    // For Gram Panchayat From Sector id 
    $(document).ready(function() {
        $('#sectorSelect').change(function() {
            var sector_id = $(this).val();
            //alert("Selected Sector ID: " + sector_id);
            $.ajax({
                url: 'ajax/get_gram_panchayat.php', // Replace with your PHP file to fetch sectors
                type: 'POST',
                data: {
                    sector_id: sector_id
                },
                success: function(data) {
                    var gram_panchayats = JSON.parse(data);
                    $('#gramPanchayatSelect').empty();
                    $('#gramPanchayatSelect').append('<option selected>ग्राम पंचायत का नाम चुनें</option>');
                    $.each(gram_panchayats, function(index, gram_panchayat) { // Changed variable name to ', gram_panchayat_name' to avoid conflict
                        $('#gramPanchayatSelect').append('<option value="' + gram_panchayat.gram_panchayat_id + '">' + gram_panchayat.gram_panchayat_name + '</option>'); // Corrected selector
                    });
                },
                error: function(xhr, status, error) {
                    console.error('Error: ' + status + ' - ' + error);
                }
            });
        });
    });

    //   For Grams  By Panchayat
    $(document).ready(function() {
        $('#gramPanchayatSelect').change(function() {
            var gram_panchayat_id = $(this).val();
            //   alert("Selected Gram Panchayat ID: " + gram_panchayat_id);
            $.ajax({
                url: 'ajax/get_gram.php', // Replace with your PHP file to fetch gram
                type: 'POST',
                data: {
                    gram_panchayat_id: gram_panchayat_id
                },
                success: function(data) {
                    var grams = JSON.parse(data);
                    $('#gramSelect').empty();
                    $('#gramSelect').append('<option selected>ग्राम का नाम चुनें</option>');
                    $.each(grams, function(index, gram) { // Changed variable name to ', gram_panchayat_name' to avoid conflict
                        $('#gramSelect').append('<option value="' + gram.gram_id + '">' + gram.gram_name + '</option>'); // Corrected selector
                    });
                },
                error: function(xhr, status, error) {
                    console.error('Error: ' + status + ' - ' + error);
                }
            });
        });
    });
</script>

<!--  -->