<?php 
// $page_name="";
if($page_name == 'new_aavedan.php' || $page_name == 'new_chikitsa_seva.php' || $page_name == 'new_chikitsa.php' || $page_name == 'swekshanudan.php' || $page_name == 'new_sthantran.php')
$field_size='col-lg-6';
else
$field_size='col-lg-4';

?>

<div class="<?=$field_size?>">
    <div class="form-group shadow">
        <div class="form-floating mb-3">
            <select name="district_id" id="districtSelect" class="form-select form-control bg-white">
                <?php
                // Fetch districts for dropdown
                $district_query = "SELECT * FROM district_master";
                $district_result = mysqli_query($conn, $district_query);
                ?>

                <option value="">जिला का नाम चुनें</option>
                <?php
                while ($district_row = mysqli_fetch_assoc($district_result)) {
                    echo "<option value='" . $district_row['district_id'] . "'>" . $district_row['district_name'] . "</option>";
                }
                ?>
            </select>
            <label for="districtSelect">जिला <span class="text-danger">*</span></label>

        </div>
    </div>
</div>
<div class="<?=$field_size?>">
    <div class="form-group shadow">
        <div class="form-floating mb-3">
            <select name="vidhansabha_id" id="vidhansabhaSelect" class="form-select form-control bg-white ">
                <option value="">विधानसभा का नाम चुनें</option>
                <!-- Options for vidhansabha will go here -->
            </select>
            <label for="vidhansabha">विधानसभा<span class="text-danger">*</span></label>
        </div>
    </div>
</div>

<div class="<?=$field_size?>">
    <div class="form-group shadow">
        <div class="form-floating mb-3">
            <select name="area_id" id="areaSelect" class="form-select form-control bg-white">
                <option value="">क्षेत्र का नाम चुनें</option>
                <!-- Options for area will go here -->

            </select>
            <label for="areaSelect">क्षेत्र का नाम चुनें <span class="text-danger">*</span></label>
        </div>
    </div>
</div>

<div class="<?=$field_size?>">
    <div class="form-group shadow">
        <div class="form-floating mb-3">
            <select name="vikaskhand_id" id="vikaskhandSelect" class="form-select form-control bg-white">
                <option value="">विकासखंड का नाम चुनें</option>
                <!-- Option Load By AJAX -->

            </select>
            <label for="vikaskhand">विकासखंड <span class="text-danger">*</span> </label>
        </div>
    </div>
</div>
<div class="<?=$field_size?>">
    <div class="form-group shadow">
        <div class="form-floating mb-3">
            <select name="sector_id" id="sectorSelect" class="form-select form-control bg-white">
                <option value="">सेक्टर का नाम चुनें</option>
                <!-- Options for sectors will go here -->
            </select>
            <label for="sector">सेक्टर <span class="text-danger">*</span> </label>
        </div>
    </div>
</div>
<div class="<?=$field_size?>">
    <div class="form-group shadow">
        <div class="form-floating mb-3">
            <select name="gram_panchayat_id" id="gramPanchayatSelect" class="form-select form-control bg-white">
                <option value="">ग्राम पंचायत का नाम चुनें</option>
                <!-- Options for panchayat will go here -->
            </select>
            <label for="gram_panchayt">ग्राम पंचायत <span class="text-danger">*</span> </label>
        </div>
    </div>
</div>
<div class="<?=$field_size?>">
    <div class="form-group shadow">
        <div class="form-floating mb-3">
            <select class="form-select" id="gramSelect" name="gram_id">
                <option value="">ग्राम का नाम चुनें</option>
                <!-- by load ajax -->
            </select>
            <label for="gram">ग्राम <span class="text-danger">*</span></label>
        </div>
    </div>
</div>