<?php include('../config/dbconnection.php') ?>
<?php include('../config/session_check.php') ?>
<?php
$tblname = "aamantran";
$tblkey = "id";
$pagename = "विवरण ";
// For Showing data On View If Admin View  
if (isset($_REQUEST['id']))
    $id = $_REQUEST['id'];
// View Id Recived
// For Showing Data on View
if (isset($_REQUEST['id'])) {
    $id = $_REQUEST['id'];

    // Fetch Data for the Given ID
    if ($id) {
        $sql = "SELECT * FROM $tblname WHERE $tblkey = '$id' AND status = 0";
        $result = mysqli_query($conn, $sql);
        if ($result && mysqli_num_rows($result) > 0) {
            $fetch = mysqli_fetch_assoc($result);
            $id = $fetch['id'];
            $name = $fetch['name'];
            $karykram = $fetch['karykram'];
            $sthan = $fetch['sthan'];
            $from_date = $fetch['from_date'];
            $to_date = $fetch['to_date'];
            $karykram_time = $fetch['karykram_time'];
            $aamantran_date = $fetch['aamantran_date'];
            $comment = $fetch['comment'];
            $file_upload = $fetch['file_upload'];
            $preshak = $fetch['preshak'];
        }
    }
}
// Close For Buinding Db To form Data 


// Close For Approve By Admin

// If Delete By Admin
?>

<!-- Start New Swekshanudan Form -->

<style>
    input[type="file"]::file-selector-button {
        color: #00698f;
        /* change the text color to blue */
        background-color: transparent;
        /* change the background color to light gray */
        border: none;
    }
</style>

<form action="" method="POST" enctype="multipart/form-data">
    <div class="container-fluid px-4 ">
        <h4 class="text-center fw-bolder text-primary mb-3"><?= $pagename; ?></h4>
        <hr class="text-danger p-2 rounded">
        <div class="row">
            <!--For ID-->
            <input type="hidden"  name="id" id="id" value="<?=$id ?>" readonly>
            <!-- ID -->
            <!-- <div class="col-lg-6">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="name" id="name" value="<?= $name ?>" placeholder="नाम" readonly>
                        <label for="name">नाम </label>
                    </div>
                </div>
            </div> -->
            <div class="col-lg-6">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control"  name="karykram" value="<?= $karykram ?>" id="karykram" placeholder="कार्यक्रम का नाम " readonly>
                        <label for="karykram">कार्यक्रम का नाम </label>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="sthan" value="<?= $sthan ?>" placeholder="स्थान का नाम" readonly name="sthan">
                        <label for="sthan">स्थान का नाम</label>
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
                        <input type="date" name="from_date" value="<?= $from_date ?>" class="form-control" id="from_date" placeholder="कब से " readonly>
                        <label for="from_date">दिनांक (कब से)</label>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                    
                        <input type="date" name="to_date" class="form-control" value="<?= $to_date ?>" id="to_date" placeholder="कब तक " readonly>
                        <label for="to_date">दिनांक (कब तक)</label>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 ">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <input type="time" class="form-control" id="karykram_time" value="<?= $karykram_time ?>" placeholder="कार्यक्रम समय" readonly name="karykram_time">
                        <label for="karykram_time">कार्यक्रम समय </label>
                    </div>
                </div>
            </div>  
            <div class="col-lg-6">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" value="<?= $preshak ?>" name="preshak" id="preshak" placeholder="प्रेषक का नाम"  readonly>
                        <label for="preshak">प्रेषक का नाम </label>
                    </div>

                </div>
            </div>   
            <div class="col-lg-6">
                <div class="form-group shadow">
                    <div class="form-floating mb-3 input-group">
                        <input type="text" class="form-control" id="file_upload" name="file_upload" value="<?= $file_upload ?>" readonly>
                        <label for="file_upload"> अपलोडेड फाइल </label>
                        <span class="input-group-text bg-">
                            <a href="uploads/<?= $file_upload ?>" target="_blank" class=" p-0"><i class="fas fa-eye fa-lg"></i></a>
                        </span>
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
                        <input type="date" class="form-control" id="aamantran_date" value="<?= $currentDate ?>" placeholder="आवेदन दिनांक" readonly name="aamantran_date">
                        <label for="aamantran_date">आवेदन दिनांक  </label>
                    </div>
                </div>
            </div>  
       
            <div class="col-lg-12">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <textarea class="form-control" id="comment" placeholder="टिप्पणी" required style="height:62px;" name="comment" readonly><?= $comment ?></textarea>
                        <label for="comment">टिप्पणी  </label>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <textarea class="form-control" id="view_comment" style="height: 110px;" name="view_comment" required></textarea>
                        <label for="view_comment">टिप्पणी :- </label>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 text-center mb-3">
                <div class="form-group">
                    <button class="col-12 text-white btn  text-center shadow" id="approve" type="submit" style="background-color:#4ac387;" name="approve"><b>Approve</b></button>
                </div>
            </div>
            <div class="col-lg-6 text-center mb-3">
                <div class="form-group">
                    <button class="col-12 text-white btn  text-center shadow btn-danger" id="UnApprove" type="submit" name="UnApprove"><b>UnApprove</b></button>
                </div>
            </div>

            <!--  -->
        </div>
    </div>
</form>
<!-- New Swekshanudan close -->