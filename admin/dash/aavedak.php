<?php include('../dbconnection.php') ?>
<?php include('../session_check.php') ?>
<?php
$tblname = "Aavedak";
$tblkey = "id";
$pagename = "आवेदक";
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
                    <button class=" text-white btn  text-center shadow" type="submit" style="background-color:#5ca7fb;"><b>Add New</b></button>

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
<div class="container-fluid pt-4 px-4">
    <div class="row">
        <div class="col-sm-12 col-lg-12">
            <div class="bg-light rounded" style="overflow-y: scroll;">
                <h6 class="mb-4 text-center mt-2">आवेदक सूची</h6>
                <table class="table table-striped">
                    <thead class=" head">
                        <tr>
                            <th scope="col">क्रमांक</th>
                            <th scope="col">आवेदक का नाम</th>
                            <th scope="col">द्वार</th>
                            <th scope="col">विषय</th>
                            <th scope="col">विधानसभा</th>
                            <th scope="col">सेक्टर</th>
                            <th scope="col">ग्राम</th>
                            <th scope="col">आपेक्षित राशि</th>
                            <th scope="col">आपेक्षित दिनांक</th>
                            <th scope="col">Action</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        $sql = "SELECT * FROM swekshanudan WHERE 1 ORDER BY id DESC";
                        $fetch = mysqli_query($conn, $sql);
                        while ($row = mysqli_fetch_array($fetch)) {
                        ?>
                            <tr>
                                <th scope="row"><?= $i++ ?></th>
                                <!-- <td></td> -->
                                <td><?= $row['name'] ?></td>
                                <td><?= $row['reference'] ?></td>
                                <td><?= $row['subject'] ?></td>
                                <td><?= $row['vidhansabha'] ?></td>
                                <td><?= $row['sector'] ?></td>
                                <td><?= $row['gram'] ?></td>
                                <td><?= $row['expectations_amount'] ?></td>
                                <td><?= date("d-m-Y", strtotime($row['application_date'])) ?></td>
                                <td class="d-flex justify-content-center flex-row action">
                                    <a href="#" onclick="view(<?= $row['id'] ?>)"><i class="fas fa-eye me-2" title="View"></i></a>
                                    <a href="#" onclick="edit(<?= $row['id'] ?>)"><i class="fas fa-pen me-2" title="Edit"></i></a>
                                    <a href="" onclick="confirmDelete(<?php echo $id; ?>, '<?php echo $tblname; ?>')"><i class="fas fa-trash-alt me-2" title="Delete"></i></a>
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
                <h5 class="modal-title" id="myModalLabel">आवेदन विवरण</h5>
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
                <h5 class="modal-title" id="myModalLabel">आवेदन विवरण</h5>
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