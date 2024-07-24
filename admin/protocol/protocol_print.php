<?php include('../config/dbconnection.php') ?>
<?php include('../config/session_check.php') ?>
<?php
$tblname = "swekshanudan";
$tblkey = "id";
$pagename = "प्रोटोकॉल प्रिंट विवरण";
$currentDate = date('Y-m-d');
// For Showing data On View If Admin View  
if (isset($_REQUEST['id']))
    $id = $_REQUEST['id'];
// View Id Recived
?>
<!-- Start  Form -->
<form action="" method="POST" enctype="multipart/form-data">
    <div class="container-fluid px-4 ">
        <h4 class="text-center fw-bolder text-primary mb-3"><?= $pagename; ?></h4>
        <hr class="text-success p-2 rounded">
        <div class="row">
            <!--For ID-->
            <input type="hidden"  name="protocol_id" id="protocol_id" value="<?=$id ?>">
            <!-- ID -->
            <div class="col-lg-12 col-md-12 col-sm-12 align-content-center">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control border-dark" name="cpp_name" id="cpp_name" placeholder="पत्र भेजने वाले का नाम " required>
                        <label for="cpp_name">प्रोतोकाल्स जारी करने वाले का नाम  <span class="text-danger">*</span></label>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control border-dark" name="cpp_designation" id="cpp_designation" placeholder="स्थान जहाँ से स्वेच्छानुदान प्राप्त करना हैं !.. " required>
                        <label for="cpp_designation"> पद <span class="text-danger">*</span></label>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 text-center mb-3">
                <div class="form-group">
                    <button class="col-12 text-white btn  text-center shadow" id="summit" type="submit" style="background-color:#4ac387;" name="summit"><b>Summit</b></button>
                </div>
            </div>
  <!--  -->
        </div>
    </div>
</form>
<!--Modal Body close -->