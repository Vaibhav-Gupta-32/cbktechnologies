<?php include('../dbconnection.php') ?>
<?php include('../session_check.php') ?>
<?php
$tblkey = "id";
$pagename = "प्राप्त आवेदन";

// Search Option Button 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $vidhansabha = $_POST['vidhansabha'];
    $sector = $_POST['sector'];
    $gram = $_POST['gram'];
    $mobile = $_POST['mobile'];
    $to_date = $_POST['to_date'];
    $from_date = $_POST['from_date'];

    $sql = "SELECT * FROM swekshanudan WHERE 
            vidhansabha = '$vidhansabha' AND 
            sector = '$sector' AND 
            gram = '$gram' AND 
            mobile = '$mobile' AND 
            application_date BETWEEN '$to_date' AND '$from_date'
            ORDER BY id DESC";
} else {
    $sql = "SELECT * FROM swekshanudan WHERE 1 ORDER BY id DESC";
}

$fetch = mysqli_query($conn, $sql);
?>
<!--  -->

?>
<?php include('includes/header.php') ?>
<?php include('includes/sidebar.php') ?>
<?php include('includes/navbar.php') ?>
<style>
    .action{  
        display:flex;
        /* justify-content: center;
        align-items: center; */
    }
    .action a {
        text-decoration: none;
        color: #666;
        transition: color 0.2s ease;
  
    }

    .action a:hover {
        color: #337ab7;
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

                    <option selected>जिले का नाम चुनें</option>
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
                    <option selected>विधानसभा का नाम चुनें</option>
                    <!-- Options for vidhansabha will go here -->
                </select>
                        <label for="vidhansabha">विधानसभा का नाम चुनें </label>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                    <select name="vikaskhand_id" id="vikaskhandSelect" class="form-select form-control bg-white" >
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
                        <label for="sector">सेक्टर का नाम चुनें  </label>
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
                        <label for="gram_panchayt">ग्राम पंचायत का नाम चुनें  </label>
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
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="mobile" placeholder="आवेदक का फ़ोन नंबर"  onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                        <label for="mobile">आवेदक का फ़ोन नंबर </label>
                    </div>

                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <input type="date" class="form-control" id="to-date" placeholder="कब से ">
                        <label for="to-date">कब से </label>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <input type="date" class="form-control" id="from-date" placeholder="कब तक" >
                        <label for="from-date">कब तक </label>
                    </div>
                </div>
            </div>
            <!-- btn -->
            <!-- 1 -->
            <div class="col-lg-4 text-center mb-3">
                <a name="Add_New" onclick="location.href='swechanudan.php';" class="form-control text-center text-white btn text-center shadow bg-primary" style="background-color:#4ac387;"><b>Add New</b></a>
            </div>
            <!-- 2 -->
            <div class="col-lg-4 text-center mb-3">
                <div name="Select" onclick="" class="form-control text-center text-white btn text-center shadow" style="background-color:#4ac387;"><b>Print List</b></div>
            </div>
            <!-- 3 -->
            <div class="col-lg-4 text-center mb-3">
                <button name="Search" class="form-control text-center text-white btn text-center shadow bg-info" type="submit"><b>Search</b></button>
            </div>
        </div>
    </form>
</div>
<!-- aavedak search End -->

<!-- Table Start -->
<!-- Table Start -->
<div class="container-fluid px-4">
    <div class="row">
        <div class="col-sm-12 col-lg-12">
        <h6 class="mb-4 text-center mt-2 pt-3 "><?= $pagename; ?> सूची</h6>
            <div class=" rounded" style="overflow-y: scroll;">
                
                <table class="table table-striped border shadow">
                    <thead class=" head">
                        <tr>
                            <th scope="col">क्रमांक</th>
                            <th scope="col">आवेदक का नाम</th>
                            <th scope="col">मोबाइल नंबर</th>
                            <!-- <th scope="col">आवेदक का ईमेल</th> -->
                            <th scope="col">विषय</th>
                            <!-- <th scope="col">द्वार</th>
                            <th scope="col"> पद </th> -->
                            <th scope="col">आपेक्षित राशि</th>
                            <th scope="col">आवेदन दिनांक</th>
                            <th scope="col">टिप्पणी</th>
                            <!-- <th scope="col">ग्राम</th>
                            <th scope="col">पंचायत</th>
                            <th scope="col">सेक्टर</th>
                            <th scope="col">विकासखंड</th> -->
                            <th scope="col">विधानसभा</th>
                            <th scope="col">जिला</th>
                            <th scope="col">Action</th>

                        </tr>
                    </thead>
                    <tbody>
        <?php
        $i = 1;
        $sql = "SELECT a.*, d.district_name, v.vidhansabha_name, vk.vikaskhand_name, s.sector_name, gp.gram_panchayat_name, g.gram_name 
                FROM swekshanudan a 
                LEFT JOIN district_master d ON a.district_id = d.district_id
                LEFT JOIN vidhansabha_master v ON a.vidhansabha_id = v.vidhansabha_id
                LEFT JOIN vikaskhand_master vk ON a.vikaskhand_id = vk.vikaskhand_id
                LEFT JOIN sector_master s ON a.sector_id = s.sector_id
                LEFT JOIN gram_panchayat_master gp ON a.gram_panchayat_id = gp.gram_panchayat_id
                LEFT JOIN gram_master g ON a.gram_id = g.gram_id
                ORDER BY a.id DESC";
        $fetch = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_array($fetch)) {
        ?>
            <tr>
                <th scope="row"><?= $i++ ?></th>
                <td><?= $row['name'] ?></td>
                <td><?= $row['phone_number'] ?></td>
                <td><?= $row['subject'] ?></td>
                <td><?= $row['expectations_amount'] ?></td>
                <td><?= date("d-m-Y", strtotime($row['application_date'])) ?></td>
                <td><?= $row['comment'] ?></td>
                <td><?= $row['vidhansabha_name'] ?></td>
                <td><?= $row['district_name'] ?></td>
                <td class="action">
                    <a href="#" onclick="view(<?= $row['id'] ?>)"><i class="fas fa-eye me-2 " title="View"></i></a>
                    <a href="#" onclick="edit(<?= $row['id'] ?>)"><i class="fas fa-pen me-2 " title="Edit"></i></a>
                    
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

<!-- The View Modal -->
<div class="modal fade" id="myModal-view" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">प्राप्त आवेदन विवरण</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!-- Modal Body -->
            <div class="modal-body">
                <!-- This will be replaced with the content from view.php -->
            </div>
        </div>
    </div>
</div>

<!-- The Edit Modal -->
<div class="modal fade" id="myModal-edit" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">आवेदन विवरण बदले </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!-- Modal Body -->
            <div class="modal-body">
                <!-- This will be replaced with the content from view.php -->
            </div>
        </div>
    </div>
</div>
<!-- modal Scripts  -->
<script>
    // function view(v_id){
    function view(v_id) {
         alert(v_id);
        $.ajax({
            type: 'POST',
            url: 'view.php',
            data: {
                id: v_id
            },
            success: function(data) {
                $('#myModal-view').find('.modal-body').html(data);
                $('#myModal-view').modal('show');
            }
        });
    }

    function edit(e_id) {
        // alert('dsa');
        $.ajax({
            type: 'POST',
            url: 'edit.php',
            data: {
                id: e_id
            },
            success: function(data) {
                $('#myModal-edit').find('.modal-body').html(data);
                $('#myModal-edit').modal('show');
            }
        });
    }
    //   setTimeout(()=>{
    //   document.getElementById('subs_msg1').innerHTML = "";
    // },2000);

    // }
</script>


    <!-- Close Modal And Table View Scripts -->


<!-- Script For DropDown List -->

<script>
    // For Vidhansabha
    $(document).ready(function() {
        $('#districtSelect').change(function() {
            var district_id = $(this).val();
          //  alert("Selected District ID: " + district_id);
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

<?php include('includes/footer.php'); ?>