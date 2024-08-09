<div class="col-lg-4">
    <div class="form-group shadow">
        <div class="form-floating mb-3">
            <select name="district_id" id="districtSelect" class="form-select form-control bg-white">
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
            <select name="vidhansabha_id" id="vidhansabhaSelect" class="form-select form-control bg-white" required>
                <option>विधानसभा का नाम चुनें</option>
                <?php
                if (isset($vidhansabha_id) && !empty($vidhansabha_id)) {
                    $vidhansabha_query = "SELECT * FROM vidhansabha_master WHERE district_id = '$a_district_id'";
                    $vidhansabha_result = mysqli_query($conn, $vidhansabha_query);
                    while ($vidhansabha_row = mysqli_fetch_assoc($vidhansabha_result)) {
                        $selected = ($vidhansabha_row['vidhansabha_id'] == $vidhansabha_id) ? 'selected' : '';
                        echo "<option value='" . $vidhansabha_row['vidhansabha_id'] . "' $selected>" . $vidhansabha_row['vidhansabha_name'] . "</option>";
                    }
                }
                ?>
            </select>
            <label for="vidhansabha">विधानसभा का नाम चुनें <span class="text-danger">*</span></label>
        </div>
    </div>
</div>

<div class="col-lg-4">
    <div class="form-group shadow">
        <div class="form-floating mb-3">
            <select name="area_id" id="areaSelect" class="form-select form-control bg-white">
                <option>क्षेत्र का नाम चुनें</option>
                <?php
                if (isset($area_idd) && !empty($area_idd)) {
                    $area_query = "SELECT * FROM area_master WHERE 1";
                    $area_result = mysqli_query($conn, $area_query);
                    while ($area_row = mysqli_fetch_assoc($area_result)) {
                        $selected = ($area_row['area_id'] == $area_idd) ? 'selected' : '';
                        echo "<option value='" . $area_row['area_id'] . "' $selected>" . $area_row['area_name'] . "</option>";
                    }
                }
                ?>
            </select>
            <label for="areaSelect">क्षेत्र का नाम चुनें <span class="text-danger">*</span></label>
        </div>
    </div>
</div>

<div class="col-lg-4">
    <div class="form-group shadow">
        <div class="form-floating mb-3">
            <select name="vikaskhand_id" id="vikaskhandSelect" class="form-select form-control bg-white">
                <option selected>विकासखंड का नाम चुनें</option>
                <?php
                if (isset($vikaskhand_id) && !empty($vikaskhand_id)) {
                    $vikaskhand_query = "SELECT * FROM vikaskhand_master WHERE vidhansabha_id = '$vidhansabha_id'";
                    $vikaskhand_result = mysqli_query($conn, $vikaskhand_query);
                    while ($vikaskhand_row = mysqli_fetch_assoc($vikaskhand_result)) {
                        $selected = ($vikaskhand_row['vikaskhand_id'] == $vikaskhand_id) ? 'selected' : '';
                        echo "<option value='" . $vikaskhand_row['vikaskhand_id'] . "' $selected>" . $vikaskhand_row['vikaskhand_name'] . "</option>";
                    }
                }
                ?>
            </select>
            <label for="vikaskhand">विकासखंड का नाम चुनें <span class="text-danger">*</span></label>
        </div>
    </div>
</div>

<div class="col-lg-4">
    <div class="form-group shadow">
        <div class="form-floating mb-3">
            <select name="sector_id" id="sectorSelect" class="form-select form-control bg-white">
                <option selected>सेक्टर का नाम चुनें</option>
                <?php
                if (isset($sector_id) && !empty($sector_id)) {
                    $sector_query = "SELECT * FROM sector_master WHERE vikaskhand_id = '$vikaskhand_id'";
                    $sector_result = mysqli_query($conn, $sector_query);
                    while ($sector_row = mysqli_fetch_assoc($sector_result)) {
                        $selected = ($sector_row['sector_id'] == $sector_id) ? 'selected' : '';
                        echo "<option value='" . $sector_row['sector_id'] . "' $selected>" . $sector_row['sector_name'] . "</option>";
                    }
                }
                ?>
            </select>
            <label for="sector">सेक्टर का नाम चुनें <span class="text-danger">*</span></label>
        </div>
    </div>
</div>
<div class="col-lg-4">
    <div class="form-group shadow">
        <div class="form-floating mb-3">
            <select name="gram_panchayat_id" id="gramPanchayatSelect" class="form-select form-control bg-white">
                <option selected>ग्राम पंचायत का नाम चुनें</option>
                <?php
                if (isset($gram_panchayat_id) && !empty($gram_panchayat_id)) {
                    $gram_panchayat_query = "SELECT * FROM gram_panchayat_master WHERE sector_id = '$sector_id'";
                    $gram_panchayat_result = mysqli_query($conn, $gram_panchayat_query);
                    while ($gram_panchayat_row = mysqli_fetch_assoc($gram_panchayat_result)) {
                        $selected = ($gram_panchayat_row['gram_panchayat_id'] == $gram_panchayat_id) ? 'selected' : '';
                        echo "<option value='" . $gram_panchayat_row['gram_panchayat_id'] . "' $selected>" . $gram_panchayat_row['gram_panchayat_name'] . "</option>";
                    }
                }
                ?>
            </select>
            <label for="gram_panchayt">ग्राम पंचायत का नाम चुनें <span class="text-danger">*</span></label>
        </div>
    </div>
</div>
<div class="col-lg-4">
    <div class="form-group shadow">
        <div class="form-floating mb-3">
            <select class="form-select" id="gramSelect" name="gram_id">
                <option selected>ग्राम का नाम चुनें</option>
                <?php
                if (isset($gram_id) && !empty($gram_id)) {
                    $gram_query = "SELECT * FROM gram_master WHERE gram_panchayat_id='$gram_panchayat_id'";
                    $gram_result = mysqli_query($conn, $gram_query);
                    while ($gram_row = mysqli_fetch_assoc($gram_result)) {
                        $selected = ($gram_row['gram_id'] == $gram_id) ? 'selected' : '';
                        echo "<option value='" . $gram_row['gram_id'] . "' $selected>" . $gram_row['gram_name'] . "</option>";
                    }
                }
                ?>
            </select>
            <label for="gram">ग्राम का नाम चुनें <span class="text-danger">*</span></label>
        </div>
    </div>
</div>