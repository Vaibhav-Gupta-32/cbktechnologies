
<?php include('../dbconnection.php') ?>
<?php include('../session_check.php') ?>
<?php
$tblname = "vikaskhand_master";
$tblkey = "vikaskhand_id";
$pagename = "Vikaskhand Master";

// Assuming $conn is your MySQL connection object
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['submit_vikaskhand'])) {
        // Receive Data From Form
        $vikaskhand_name = ucfirst($_POST['vikaskhand_name']);
        $vidhansabha_id = $_POST['vidhansabha_id'];
        $district_id = $_POST['district_id'];
        $vikaskhand_name = mysqli_real_escape_string($conn, $vikaskhand_name);
        $vidhansabha_id = mysqli_real_escape_string($conn, $vidhansabha_id);
        $district_id = mysqli_real_escape_string($conn, $district_id);

        // Check if vikaskhand_name already exists for the selected district and vidhansabha
        $check_query = "SELECT * FROM vikaskhand_master WHERE vikaskhand_name = '$vikaskhand_name' AND district_id = '$district_id' AND vidhansabha_id = '$vidhansabha_id'";
        $check_result = mysqli_query($conn, $check_query);

        if (mysqli_num_rows($check_result) > 0) {
            // Vikaskhand name already exists
            echo "<b class='text-danger'>Error: Vikaskhand already exists!</b>";
        } else {
            // Vikaskhand name does not exist, proceed with insertion
            $sql = "INSERT INTO vikaskhand_master (vikaskhand_name, vidhansabha_id, district_id) VALUES ('$vikaskhand_name', '$vidhansabha_id', '$district_id')";
            if (mysqli_query($conn, $sql)) {
                echo "<b class='text-success'>Vikaskhand Added Successfully</b>";
            } else {
                echo "<b class='text-danger'>Error: " . mysqli_error($conn) . "</b>";
            }
        }
    }
}

// Fetch vidhansabhas for dropdown
// $vidhansabha_query = "SELECT v.vidhansabha_id, v.vidhansabha_name, d.district_name 
//                       FROM vidhansabha_master v 
//                       JOIN district_master d ON v.district_id = d.district_id";
// $vidhansabha_result = mysqli_query($conn, $vidhansabha_query);

// mysqli_data_seek($vidhansabha_result, 0); // Reset pointer to fetch districts again
// while ($vidhansabha_row = mysqli_fetch_assoc($vidhansabha_result)) {
//     echo "<option value='" . $vidhansabha_row['vidhansabha_id'] . "'>" . $vidhansabha_row['vidhansabha_name'] . "</option>";
// }


// Fetch districts for dropdown
$district_query = "SELECT * FROM district_master";
$district_result = mysqli_query($conn, $district_query);
?>
<?php include('includes/header.php') ?>
<?php include('includes/sidebar.php') ?>
<?php include('includes/navbar.php') ?>


<!--Vikaskhand  -->
<div class="container-fluid pt-4 px-4">
    <!-- Form Vikaskhand -->
    <form method="post">
    <div class="row text-center align-items-center">
       
            <h5 class="text-center fw-bolder text-primary mb-3">नया विकासखंड का नाम जोड़ें</h5>

            
            <div class="col-lg-6 text-center mb-3">
                <select name="district_id" id="districtSelect" class="form-select form-control border-success" required>
                    <option selected>जिले का नाम चुनें</option>
                    <?php
                    mysqli_data_seek($district_result, 0); // Reset pointer to fetch districts again
                    while ($district_row = mysqli_fetch_assoc($district_result)) {
                        echo "<option value='" . $district_row['district_id'] . "'>" . $district_row['district_name'] . "</option>";
                    }
                    ?>
                </select>
            </div>
            
           
            <div class="col-lg-6 text-center mb-3">
    <select name="vidhansabha_id" id="vidhansabhaSelect"class="form-select form-control border-success" required>
    <option selected>विधानसभा का नाम चुनें</option>
<!-- Option Load By AJAX -->
    </select>
     </div>
            <div class="col-lg-6 text-center mb-3">
                <input type="text" name="vikaskhand_name" class="form-control border-success" placeholder="विकासखंड का नाम" required>
            </div>

            <div class="col-lg-3 text-center mb-3">
                <button name="submit_vikaskhand" class="form-control text-center text-white btn text-center shadow" type="submit" style="background-color:#4ac387;"><b>Save</b></button>
            </div>

            <div class="col-lg-3 text-center mb-3">
                <button name="cancel_vikaskhand" class="form-control text-center text-white btn text-center shadow" type="reset" style="background-color:#57c2fc;"><b>Cancel</b></button>
            </div>
    </div>
    </form>
    <!-- Vikaskhand Master Table -->
    <div class="row">
        <div class="col-sm-12 col-lg-12">
            <div class="bg-light rounded" style="overflow-y: scroll;">
                <h5 class="mb-4 text-center mt-2 text-success fw-bolder">विकासखंड की सूची</h3>
                <table class="table table-striped">
                    <thead class="head">
                        <tr>
                            <th scope="col">क्रमांक</th>
                            <th scope="col">विकासखंड का नाम</th>
                            <th scope="col">विधानसभा</th>
                            <th scope="col">जिला</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        $sql = "SELECT v.*, v.vikaskhand_name, vs.vidhansabha_name, d.district_name 
                               , v.vikaskhand_id FROM vikaskhand_master v 
                                JOIN vidhansabha_master vs ON v.vidhansabha_id = vs.vidhansabha_id 
                                JOIN district_master d ON v.district_id = d.district_id 
                                ORDER BY v.vikaskhand_id DESC";
                        $fetch = mysqli_query($conn, $sql);
                        while ($row = mysqli_fetch_array($fetch)) {
                        ?>
                            <tr>
                                <th scope="row"><?= $i++ ?></th>
                                <td><?= $row['vikaskhand_name'] ?></td>
                                <td><?= $row['vidhansabha_name'] ?></td>
                                <td><?= $row['district_name'] ?></td>
                                <td class="d-flex justify-content-center flex-row action">
                                    <a href="#"><i class="fas fa-pen me-2" title="Edit"></i></a>
                                    <a href="#" onclick="confirmDelete(<?=$row['vikaskhand_id'];?>, '<?=$tblname; ?>' ,'<?=$tblkey?>')"><i class="fas fa-trash-alt me-2" title="Delete"></i></a>
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
    $(document).ready(function() {
        $('#districtSelect').change(function() {
            var district_id = $(this).val();
           // alert("Selected District ID: " + district_id);
            $.ajax({
                url: 'ajax/get_vidhansabha.php',
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
</script>

<!--  -->

<?php include('includes/footer.php'); ?>






