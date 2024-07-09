
<?php include('../dbconnection.php') ?>
<?php include('../session_check.php') ?>
<!-- Main Php For This Page  -->
<?php
$tblname = "Aavedak";
$tblkey = "id";
$pagename = "आवेदक";






?><!-- End Main Php For This Page  -->
<!-- Includes -->
<?php include('includes/header.php'); ?>
<?php include('includes/sidebar.php'); ?>
<?php include('includes/navbar.php'); ?>


<!-- Sector Form -->
<div class="container-fluid pt-4 px-4">
    <form method="post">
        <div class="row text-center align-items-center">
            <h5 class="text-center fw-bolder text-primary mb-3">नया सेक्टर का नाम जोड़ें</h5>

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
            <select name="vidhansabha_id" id="vidhansabhaSelect"class="form-select form-control border-success" required>
            <option selected>विधानसभा का नाम चुनें</option>
<!-- Option Load By AJAX -->
    </select>
            </div>

            <div class="col-lg-4 text-center mb-3">
                <select name="vikaskhand_id" class="form-select form-control border-success" required>
                    <option selected>विकासखंड का नाम चुनें</option>
              
                </select>
            </div>

            <div class="col-lg-4 text-center mb-3">
                <input type="text" name="sector_name" class="form-control border-success" placeholder="सेक्टर का नाम" required>
            </div>

            <div class="col-lg-4 text-center mb-3">
                <button name="submit_sector" class="form-control text-center text-white btn text-center shadow" type="submit" style="background-color:#4ac387;"><b>Save</b></button>
            </div>

            <div class="col-lg-4 text-center mb-3">
                <button name="cancel_sector" class="form-control text-center text-white btn text-center shadow" type="reset" style="background-color:#57c2fc;"><b>Cancel</b></button>
            </div>
        </div>
    </form>

<!-- Sector Master Table -->
<div class="row">
    <div class="col-sm-12 col-lg-12">
        <div class="bg-light rounded" style="overflow-y: scroll;">
            <h5 class="mb-4 text-center mt-2 text-success fw-bolder">सेक्टर की सूची</h5>
            <table class="table table-striped">
                <thead class="head">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">सेक्टर का नाम </th>
                        <th scope="col">विकासखंड</th>
                        <th scope="col">विधानसभा</th>
                        <th scope="col">जिला</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                        <tr>
                            <th scope="row">99</th>
                            <td>--</td>
                            <td>00</td>
                            <td>oo</td>
                            <td>ll</td>
                            <td class="d-flex justify-content-center flex-row action">
                                <a href="#"><i class="fas fa-pen me-2" title="Edit"></i></a>
                                <a href="#"><i class="fas fa-trash-alt me-2" title="Delete"></i></a>
                            </td>
                        </tr>
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
                data: {district_id: district_id},
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







</script>

<!--  -->


<?php include('includes/footer.php'); ?>