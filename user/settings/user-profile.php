<?php include('../config/dbconnection.php') ?>
<?php include('../config/session_check.php') ?>
<?php $pagename="User Profile Informations"; ?>
<?php include('../includes/header.php') ?>
<?php include('../includes/sidebar.php') ?>
<?php include('../includes/navbar.php') ?>
<!--  -->

<form action="" method="POST" enctype="multipart/form-data">
    <div class="container-fluid px-4 ">
        <h4 class="text-center fw-bolder text-primary mb-3"><?= $pagename; ?></h4>
        <hr class="text-danger p-2 rounded">
        <div class="row">
            <!--For ID-->
            <input type="hidden"  name="id" id="id" value="<?=$id ?>">
            <!-- ID -->
            <div class="col-lg-4 col-md-12 col-sm-12 align-content-center">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="name" id="name" value="<?= $name ?>">
                        <label for="name">आवेदक का नाम </label>
                    </div>

                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" maxlength="10" name="phone_number" id="phone_number" value="<?= $phone_number ?>">
                        <label for="phone_number">आवेदक का फ़ोन नंबर </label>
                    </div>
                </div>
            </div>


            <div class="col-lg-4 text-center">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <input type="text" name="district_id" id="districtSelect" class=" form-control " value="<?= $district_name ?>">
                        <label for="districtSelect">जिले का नाम</label>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <input type="text" name="vidhansabha_id" id="vidhansabhaSelect" class="form-control" value="<?= $vidhansabha_name ?>">
                        <label for="vidhansabha">विधानसभा का नाम </label>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <input type="text" name="vikaskhand_id" id="vikaskhandSelect" class=" form-control " value="<?= $vikaskhand_name ?>">
                        <label for="vikaskhand">विकासखंड का नाम </label>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <input type="text" name="sector_id" id="sectorSelect" class=" form-control " value="<?= $sector_name ?>">
                        <label for="sector">सेक्टर का नाम </label>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <input type="text" name="gram_panchayat_id" id="gramPanchayatSelect" class=" form-control" value="<?= $gram_panchayat_name ?>">
                        <label for="gram_panchayt">ग्राम पंचायत का नाम </label>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="gramSelect" name="gram_id" value="<?= $gram_name ?>">
                        <label for="gram">ग्राम का नाम </label>
                    </div>
                </div>
            </div>

           
            <div class="col-lg-4">
                <div class="form-group shadow">
                    <div class="form-floating mb-3 input-group">
                        <input type="file" class="form-control bg-white" id="profile_img" name="profile_img" value="<?= $profile_img ?>">
                        <label for="profile_img"> अपलोड प्रोफाइल इमेज </label>
                        <span class="input-group-text bg-">
                            <a href="uploads/<?= $profile_img ?>" target="_blank" class=" p-0"><i class="fas fa-eye fa-lg"></i></a>
                        </span>
                    </div>
                </div>
            </div>
            <!--  -->
    
            <div class="col-lg-6">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <input type="date" class="form-control" id="profile_update_date" name="profile_update_date" value="<?= $profile_update_date ?>" readonly>
                        <label for="profile_update_date">अपडेट दिनांक</label>
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
<?php include('../includes/footer.php'); ?>