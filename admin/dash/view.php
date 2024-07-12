<?php include('../dbconnection.php') ?>
<?php include('../session_check.php') ?>
<?php
$tblname = "Aavedak";
$tblkey = "id";
$pagename = " प्राप्त आवेदन ";
// For Showing data On View If Admin View  
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
        $district_name = $fetch['district_name']; 
        $vidhansabha_name = $fetch['vidhansabha_name'];  
        $vikaskhand_name = $fetch['vikaskhand_name']; 
        $sector_name = $fetch['sector_name'];  
        $gram_panchayat_name = $fetch['gram_panchayat_name'];  
        $gram_name = $fetch['gram_name']; 
        $subject = $fetch['subject']; 
        $reference = $fetch['reference']; 
        $expectations_amount = $fetch['expectations_amount']; 
        $application_date =$fetch['application_date']; 
       // $application_date =date("d-m-Y",strtotime($fetch['application_date'])); 
        $comment = $fetch['comment']; 
        $file_upload = $fetch['file_upload']; 
    }
// Close For Buinding Db To form Data 

// If Approve By Admin 


?>
    
<!-- Start New Swekshanudan Form -->

<style>
    input[type="file"]::file-selector-button {
        color: #00698f;
        /* change the text color to blue */
        background-color:transparent;
        /* change the background color to light gray */
        border: none;
    }
</style>

<form action="" method="POST" enctype="multipart/form-data">
    <div class="container-fluid px-4 ">
        <h4 class="text-center fw-bolder text-primary mb-3"><?= $pagename; ?></h4>
        <hr class="text-danger p-2 rounded">
        <div class="row">
            <div class="col-lg-4 col-md-12 col-sm-12 align-content-center">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="name" id="name" value="<?=$name?>" readonly>
                        <label for="name">आवेदक का नाम </label>
                    </div>

                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" maxlength="10" name="phone_number" id="phone_number" value="<?=$phone_number?>" readonly>
                        <label for="phone_number">आवेदक का फ़ोन नंबर </label>
                    </div>
                </div>
            </div>
      

            <div class="col-lg-4">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="designation" id="designation" value="<?=$designation?>" readonly>
                        <label for="designation">पद का नाम </label>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 text-center">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
            <input type="text" name="district_id" id="districtSelect" class=" form-control " value="<?=$district_name?>" readonly>
                <label for="districtSelect">जिले का नाम</label>
                </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                    <input type="text" name="vidhansabha_id" id="vidhansabhaSelect" class="form-control" value="<?=$vidhansabha_name?>" readonly>
                        <label for="vidhansabha">विधानसभा का नाम </label>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                    <input type="text" name="vikaskhand_id" id="vikaskhandSelect" class=" form-control " value="<?=$vikaskhand_name?>" readonly>
                        <label for="vikaskhand">विकासखंड का नाम </label>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                    <input type="text" name="sector_id" id="sectorSelect" class=" form-control " value="<?=$sector_name?>" readonly>
                        <label for="sector">सेक्टर का नाम </label>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                    <input type="text" name="gram_panchayat_id" id="gramPanchayatSelect" class=" form-control" value="<?=$gram_panchayat_name?>" readonly>
                        <label for="gram_panchayt">ग्राम पंचायत का नाम </label>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="gramSelect" name="gram_id" value="<?=$gram_name?>" readonly >
                        <label for="gram">ग्राम का नाम </label>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="subject" name="subject" value="<?=$subject?>" readonly>
                        <label for="subject">विषय का नाम </label>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="reference" name="reference" value="<?=$reference?>" readonly>
                        <label for="reference">द्वारा </label>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
    <div class="form-group shadow">
        <div class="form-floating mb-3 input-group">
            <input type="text" class="form-control" id="file_upload" name="file_upload" value="<?=$file_upload?>" readonly>
            <label for="file_upload" > अपलोडेड फाइल </label>
            <span class="input-group-text bg-">
                <a href="uploads/swechanudan/<?=$file_upload?>" target="_blank"  class=" p-0"><i class="fas fa-eye fa-lg"></i></a>
            </span>
        </div>
    </div>
</div>
            <!--  -->

            <!--  -->
            <div class="col-lg-6">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="expectations_amount" name="expectations_amount" value="<?=$expectations_amount?>" readonly>
                        <label for="expectations_amount">आपेक्षित राशि </label>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <input type="date" class="form-control" id="application_date" name="application_date" value="<?=$application_date?>" readonly>
                        <label for="application_date">आवेदन दिनांक</label>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <textarea type="text" class="form-control" id="comment" style="height: 60px;" name="comment" value="" readonly ><?=$comment?></textarea >
                        <label for="comment">टिप्पणी </label>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="expectations_amount" placeholder="अनुमोदित राशि" required name="anumodit_amount" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                        <label for="anumodit_amount">अनुमोदित राशि <span class="text-danger">*</span> </label>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="aadesh_no" placeholder="आदेश क्रमांक" required name="aadesh_no" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                        <label for="aadesh_no">आदेश क्रमांक <span class="text-danger">*</span> </label>
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
                        <input type="date" class="form-control" id="application_date" value="<?= $currentDate ?>" placeholder="अनुमोदित दिनांक" required name="anumodit_date">
                        <label for="anumodit_date">अनुमोदित दिनांक <span class="text-danger">*</span> </label>
                    </div>
                </div>
            </div>
        
            <div class="col-lg-12">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <textarea class="form-control" id="comment" style="height: 110px;" name="comment" required></textarea>
                        <label for="comment">टिप्पणी </label>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 text-center mb-3">
                <div class="form-group">
                    <button class="col-12 text-white btn  text-center shadow" id="Approve" type="submit" style="background-color:#4ac387;" name="Approve"><b>Approve</b></button>
                </div>
            </div>
            <div class="col-lg-6 text-center mb-3">
                <div class="form-group">
                    <button class="col-12 text-white btn  text-center shadow btn-danger" id="UnApprove" type="submit"  name="UnApprove"><b>UnApprove</b></button>
                </div>
            </div>

            <!--  -->
        </div>
    </div>
</form>
<!-- New Swekshanudan close -->
 
<!-- Script -->

<script>
    // For Vidhansabha
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

    // For Vikaskhand
    $(document).ready(function() {
    $('#vidhansabhaSelect').change(function() {
        var vidhansabha_id = $(this).val();
        alert("Selected Vidhansabha ID: " + vidhansabha_id);
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
        alert("Selected Vikaskhand ID: " + vikaskhand_id);
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
        alert("Selected Sector ID: " + sector_id);
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
        alert("Selected Gram Panchayat ID: " + gram_panchayat_id);
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