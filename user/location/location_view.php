<div class="col-lg-4">
    <div class="form-group shadow">
        <div class="form-floating mb-3">
            <select name="district_id" id="districtSelect" class="form-select form-control" disabled>
                <?php
                // Fetch districts for dropdown
                $district_query = "SELECT * FROM district_master";
                $district_result = mysqli_query($conn, $district_query);
                ?>

                <option selected>जिला का नाम चुनें</option>
                <?php
                while ($district_row = mysqli_fetch_assoc($district_result)) {
                    $selected = ($district_row['district_id'] == $district_id) ? 'selected' : '';
                    echo "<option value='" . $district_row['district_id'] . "' $selected>" . $district_row['district_name'] . "</option>";
                }
                ?>
            </select>
            <label for="districtSelect">जिला <span class="text-danger">*</span></label>

        </div>
    </div>
</div>
<div class="col-lg-4">
    <div class="form-group shadow">
        <div class="form-floating mb-3">
            <input type="text" name="vidhansabha_id" id="vidhansabhaSelect" class="form-control" value="<?= $vidhansabha_name ?>" readonly>
            <label for="vidhansabha">विधानसभा का नाम </label>
        </div>
    </div>
</div>
<div class="col-lg-4">
    <div class="form-group shadow">
        <div class="form-floating mb-3">
            <input type="text" name="area_id" id="areaSelect" class="form-control" value="<?= $area_name ?>" readonly>
            <label for="vidhansabha">क्षेत्र का नाम </label>
        </div>
    </div>
</div>
<div class="col-lg-4">
    <div class="form-group shadow">
        <div class="form-floating mb-3">
            <input type="text" name="vikaskhand_id" id="vikaskhandSelect" class=" form-control " value="<?= $vikaskhand_name ?>" readonly>
            <label for="vikaskhand">विकासखंड का नाम </label>
        </div>
    </div>
</div>
<div class="col-lg-4">
    <div class="form-group shadow">
        <div class="form-floating mb-3">
            <input type="text" name="sector_id" id="sectorSelect" class=" form-control " value="<?= $sector_name ?>" readonly>
            <label for="sector">सेक्टर का नाम </label>
        </div>
    </div>
</div>
<div class="col-lg-4">
    <div class="form-group shadow">
        <div class="form-floating mb-3">
            <input type="text" name="gram_panchayat_id" id="gramPanchayatSelect" class=" form-control" value="<?= $gram_panchayat_name ?>" readonly>
            <label for="gram_panchayt">ग्राम पंचायत का नाम </label>
        </div>
    </div>
</div>
<div class="col-lg-4">
    <div class="form-group shadow">
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="gramSelect" name="gram_id" value="<?= $gram_name ?>" readonly>
            <label for="gram">ग्राम का नाम </label>
        </div>
    </div>
</div>