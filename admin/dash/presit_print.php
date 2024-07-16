<?php include('../dbconnection.php') ?>
<?php include('../session_check.php') ?>
<?php
$tblname = "swekshanudan";
$tblkey = "id";
$pagename = "प्रिंट विवरण";
// For Showing data On View If Admin View  
if (isset($_REQUEST['id']))
    $id = $_REQUEST['id'];
// View Id Recived



?>

<!-- Start  Form -->
<form action="" method="POST" enctype="multipart/form-data">
    <div class="container-fluid px-4 ">
        <h4 class="text-center fw-bolder text-primary mb-3"><?= $pagename; ?></h4>
        <hr class="text-success p-2 rounded">
        <div class="row">
            <!--For ID-->
            <input type="hidden"  name="presit_id" id="presit_id" value="<?=$id ?>">
            <!-- ID -->
            <div class="col-lg-6 col-md-12 col-sm-12 align-content-center">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control border-dark" name="ptr_sender" id="ptr_sender" placeholder="पत्र भेजने वाले का नाम " required>
                        <label for="ptr_sender">पत्र भेजने वाले का नाम <span class="text-danger">*</span></label>
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
                        <input type="date" class="form-control border-dark" id="presit_date" value="<?=$currentDate?>"  name="presit_date" placeholder="स्वीकृत प्रेषित दिनांक " required readonly>
                        <label for="presit_date">स्वीकृत प्रेषित दिनांक <span class="text-danger">*</span></label>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control border-dark" name="anudan_prapt_add" id="anudan_prapt_add" placeholder="स्थान जहाँ से स्वेच्छानुदान प्राप्त करना हैं !.. ">
                        <label for="anudan_prapt_add"><small>स्थान जहाँ से स्वेच्छानुदान प्राप्त करना हैं !.. </small><span class="text-danger">*</span></label>
                    </div>
                </div>
            </div>


       
     
            <div class="col-lg-12 text-center mb-3">
                <div class="form-group">
                    <button class="col-12 text-white btn  text-center shadow" id="presit_summit" type="submit" style="background-color:#4ac387;" name="presit_summit"><b>Summit</b></button>
                </div>
            </div>
  <!--  -->
        </div>
    </div>
</form>
<!--Modal Body close -->

<!-- Script -->

<script>
    // For Vidhansabha
    $(document).ready(function() {
        $('#districtSelect').change(function() {
            var district_id = $(this).val();
            // alert("Selected District ID: " + district_id);
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
            // alert("Selected Vidhansabha ID: " + vidhansabha_id);
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
            // alert("Selected Vikaskhand ID: " + vikaskhand_id);
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
            //  alert("Selected Sector ID: " + sector_id);
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
            // alert("Selected Gram Panchayat ID: " + gram_panchayat_id);
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