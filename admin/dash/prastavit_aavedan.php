<?php include('../dbconnection.php') ?>
<?php include('../session_check.php') ?>
<?php
$tblname = "Aavedak";
$tblkey = "id";
$pagename = "प्रस्तावित आवेदन";
?>
<?php include('includes/header.php') ?>
<?php include('includes/sidebar.php') ?>
<?php include('includes/navbar.php') ?>
<style>
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
            <div class="col-lg-4">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <select class="form-select" id="vidhansabha" required>
                            <!-- <option selected>विधानसभा चुनें </option> -->
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                        <label for="vidhansabha">विधानसभा का नाम चुनें <span class="text-danger">*</span></label>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <select class="form-select" id="sector" required>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                        <label for="sector">सेक्टर का नाम चुनें <span class="text-danger">*</span> </label>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <select class="form-select" id="gram" required>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                        <label for="gram">ग्राम का नाम चुनें <span class="text-danger">*</span></label>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="mobile" placeholder="आवेदक का फ़ोन नंबर" required onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                        <label for="mobile">आवेदक का फ़ोन नंबर <span class="text-danger">*</span></label>
                    </div>

                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <input type="date" class="form-control" id="to-date" placeholder="कब से " required>
                        <label for="to-date">कब से <span class="text-danger">*</span> </label>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <input type="date" class="form-control" id="from-date" placeholder="कब तक" required>
                        <label for="from-date">कब तक <span class="text-danger">*</span> </label>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 text-center">
                <div class="form-group">
                    <a href="swechanudan.php" target="_blank" rel="noopener noreferrer">
                    <button class=" text-white btn  text-center shadow" type="submit" style="background-color:#5ca7fb;"><b>Add New</b></button>
                    </a>
                </div>
            </div>
            <div class="col-lg-4 text-center">
                <div class="form-group ">
                    <button class="col-lg-4 text-white btn  text-center shadow" type="submit" style="background-color:#4ac387;"><b>Approve</b></button>

                </div>
            </div>
            <div class="col-lg-4 text-center">
                <div class="form-group ">
                    <button class="col-lg-4 text-white btn  text-center shadow" type="submit" style="background-color:#57c2fc;"><b>Search</b></button>
                </div>
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
                WHERE a.status=1
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
                    <a href="#"  onclick="view(<?= $row['id'] ?>)"><i class="fas fa-eye me-2 " title="View"></i></a>
                    <a href="#" onclick="edit(<?= $row['id'] ?>)"><i class="fas fa-pen me-2 " title="Edit"></i></a>
                    <a href="" onclick="confirmDelete(<?=$row['id']; ?>, '<?php echo $tblname; ?>', '<?=$tblkey?>')"><i class="fas fa-trash-alt me-2 " title="Delete"></i></a>
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
                <h5 class="modal-title" id="myModalLabel">प्रस्तावित आवेदन विवरण</h5>
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
                <h5 class="modal-title" id="myModalLabel">प्रस्तावित आवेदन विवरण</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!-- Modal Body -->
            <div class="modal-body">
                <!-- This will be replaced with the content from view.php -->
            </div>
        </div>
    </div>
</div>

<script>
    // function view(v_id){
    function view(v_id) {
        $.ajax({
            type: 'POST',
            url: 'prastavit_view.php',
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

<script>
       function confirmDelete(id, tableName) {
        alert(id + tableName);
            if (confirm("क्या आप वाकई इस रिकॉर्ड को हटाना चाहते हैं?")) {
                $.ajax({
                    type: 'POST',
                    url: 'delete.php',
                    data: JSON.stringify({ id: id, table: tableName }),
                    contentType: 'application/json',
                    success: function(response) {
                        alert(response);
                        location.reload(); // Optionally, reload the page to reflect changes
                    },
                    error: function(xhr, status, error) {
                        alert("Error: " + xhr.responseText);
                    }
                });
            }
        }
    </script>

<?php include('includes/footer.php'); ?>