<?php include('../dbconnection.php') ?>
<?php include('../session_check.php') ?>
<?php
$tblname = "ग्राम";
$tblkey = "ग्राम_id";
$pagename = "ग्राम";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['submit_gram'])) {
        // Receive Data From Form
        $gram_name = ucfirst($_POST['gram_name']);
        $district_id = $_POST['district_id'];
        $vidhansabha_id = $_POST['vidhansabha_id'];
        $vikaskhand_id = $_POST['vikaskhand_id'];
        $sector_id = $_POST['sector_id'];

        // Escape strings to prevent SQL injection
        $gram_name = mysqli_real_escape_string($conn, $gram_name);
        $district_id = mysqli_real_escape_string($conn, $district_id);
        $vidhansabha_id = mysqli_real_escape_string($conn, $vidhansabha_id);
        $vikaskhand_id = mysqli_real_escape_string($conn, $vikaskhand_id);
        $sector_id = mysqli_real_escape_string($conn, $sector_id);

        // Check if gram_name already exists for the selected district, vidhansabha, vikaskhand, and sector
        $check_query = "SELECT * FROM gram_master WHERE gram_name = '$gram_name' AND district_id = '$district_id' AND vidhansabha_id = '$vidhansabha_id' AND vikaskhand_id = '$vikaskhand_id' AND sector_id = '$sector_id'";
        $check_result = mysqli_query($conn, $check_query);

        if (mysqli_num_rows($check_result) > 0) {
            // Gram name already exists
            echo "<b class='text-danger'>Error: Gram Name already exists!</b>";
        } else {
            // Gram name does not exist, proceed with insertion
            $sql = "INSERT INTO gram_master (gram_name, district_id, vidhansabha_id, vikaskhand_id, sector_id) VALUES ('$gram_name', '$district_id', '$vidhansabha_id', '$vikaskhand_id', '$sector_id')";
            if (mysqli_query($conn, $sql)) {
                echo "<b class='text-success'>Gram Name Added Successfully</b>";
            } else {
                echo "<b class='text-danger'>Error: " . mysqli_error($conn) . "</b>";
            }
        }
    }
}
?>

<?php include('includes/header.php') ?>
<?php include('includes/sidebar.php') ?>
<?php include('includes/navbar.php') ?>


<div class="container-fluid pt-4 px-4">
    <form method="post">
        <div class="row text-center align-items-center">
            <h5 class="text-center fw-bolder text-primary mb-3">नया ग्राम जोड़ें</h5>

            <div class="col-lg-4 text-center mb-3">
                <select name="district_id" id="districtSelect" class="form-select form-control border-success" required>
                    <?php
                    // Fetch districts for dropdown
                    $district_query = "SELECT * FROM district_master";
                    $district_result = mysqli_query($conn, $district_query);
                    ?>

                    <option selected>जिले का नाम चुनें</option>
                    <?php
                    while ($district_row = mysqli_fetch_assoc($district_result)) {
                        echo "<option value='" . $district_row['district_id'] . "'>" . $district_row['district_name'] . "</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="col-lg-4 text-center mb-3">
                <select name="vidhansabha_id" id="vidhansabhaSelect" class="form-select form-control border-success" required>
                    <option selected>विधानसभा का नाम चुनें</option>
                    <!-- Options for vidhansabha will go here -->
                </select>
            </div>

            <div class="col-lg-4 text-center mb-3">
                <select name="vikaskhand_id" id="vikaskhandSelect" class="form-select form-control border-success" required>
                    <option selected>विकासखंड का नाम चुनें</option>
                    <!-- Option Load By AJAX -->

                </select>
            </div>

            <div class="col-lg-4 text-center mb-3">
                <select name="sector_id" id="sectorSelect" class="form-select form-control border-success" required>
                    <option selected>सेक्टर का नाम चुनें</option>
                    <!-- Options for sectors will go here -->
                </select>
            </div>
            <div class="col-lg-4 text-center mb-3">
                <select name="sector_id" id="gramPanchayatSelect" class="form-select form-control border-success" required>
                    <option selected>ग्राम पंचायत का नाम चुनें</option>
                    <!-- Options for panchayat will go here -->
                </select>
            </div>

            <div class="col-lg-4 text-center mb-3">
                <input type="text" name="gram_name" class="form-control border-success" placeholder="ग्राम का नाम" required>
            </div>

            <div class="col-lg-6 text-center mb-3">
                <button name="submit_gram" class="form-control text-center text-white btn text-center shadow" type="submit" style="background-color:#4ac387;"><b>Save</b></button>
            </div>

            <div class="col-lg-6 text-center mb-3">
                <button name="cancel_gram" class="form-control text-center text-white btn text-center shadow" type="reset" style="background-color:#57c2fc;"><b>Cancel</b></button>
            </div>
        </div>
    </form>

    <!-- Gram Master Table -->
    <div class="row">
        <div class="col-sm-12 col-lg-12">
            <div class="bg-light rounded" style="overflow-y: scroll;">
                <h5 class="mb-4 text-center mt-2 text-success fw-bolder">ग्राम की सूची</h5>
                <table class="table table-striped">
                    <thead class="head">
                        <tr>
                            <th scope="col">क्रमाक</th>
                            <th scope="col">ग्राम का नाम</th>
                            <th scope="col">ग्राम पंचायत</th>
                            <th scope="col">सेक्टर</th>
                            <th scope="col">विकासखंड</th>
                            <th scope="col">विधानसभा</th>
                            <th scope="col">जिला</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT g.gram_id, g.gram_name, gp.gram_panchayat_name, v.vikaskhand_name, vs.vidhansabha_name, d.district_name, s.sector_name
        FROM gram_master g
        JOIN vikaskhand_master v ON g.vikaskhand_id = v.vikaskhand_id
        JOIN vidhansabha_master vs ON g.vidhansabha_id = vs.vidhansabha_id
        JOIN district_master d ON g.district_id = d.district_id
        JOIN sector_master s ON g.sector_id = s.sector_id
        JOIN gram_panchayat_master gp ON g.gram_panchayat_id = gp.gram_panchayat_id
        ORDER BY g.gram_id DESC";
                        $fetch = mysqli_query($conn, $sql);
                        $i = 1;
                        while ($row = mysqli_fetch_array($fetch)) {
                        ?>
                            <tr>
                                <td><?= $i++ ?></td>
                                <td><?= $row['gram_name'] ?></td>
                                <td><?= $row['gram_panchayat_name'] ?></td>
                                <td><?= $row['sector_name'] ?></td>
                                <td><?= $row['vikaskhand_name'] ?></td>
                                <td><?= $row['vidhansabha_name'] ?></td>
                                <td><?= $row['district_name'] ?></td>
                                <td class="d-flex justify-content-center flex-row action">
                                    <a href="#"><i class="fas fa-pen me-2" title="Edit"></i></a>
                                    <a href="#"><i class="fas fa-trash-alt me-2" title="Delete"></i></a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>


                </table>
            </div>
        </div>
    </div>
</div>

<!-- Script -->
<script>
    // For Vidhansabha
    $(document).ready(function() {
        $('#districtSelect').change(function() {
            var district_id = $(this).val();
            alert("Selected District ID: " + district_id);
            $.ajax({
                url: 'get_vidhansabha.php',
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
                url: 'get_vikaskhand.php',
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
                url: 'get_sector.php', // Replace with your PHP file to fetch sectors
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
    // For Gram Panchayat
    // For Sector Load 
    $(document).ready(function() {
        $('#sectorSelect').change(function() {
            var sector_id = $(this).val();
            alert("Selected Vikaskhand ID: " + sector_id);
            $.ajax({
                url: 'get_gram_panchayat.php', // Replace with your PHP file to fetch sectors
                type: 'POST',
                data: {
                    sector_id: sector_id
                },
                success: function(data) {
                    var gram_panchayats = JSON.parse(data);
                    $('#gramPanchayatSelect').empty();
                    $('#gramPanchayatSelect').append('<option selected>ग्राम का नाम चुनें</option>');
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
</script>
<!--  -->



<?php include('includes/footer.php'); ?>