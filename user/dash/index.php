<?php include('../config/dbconnection.php') ?>
<?php include('../config/session_check.php') ?>
<?php $pagename="डैशबोर्ड"; ?>
<?php include('../includes/header.php') ?>
<?php include('../includes/sidebar.php') ?>
<?php include('../includes/navbar.php') ?>

<?php
$mobile=$_SESSION['username'] ;
$prapth_aavedan=getvalfield($conn,'swekshanudan','count(*)','status=0');
$prastavit_aavedan=getvalfield($conn,'swekshanudan','count(*)','status=1');
$sveekrt_aavedan=getvalfield($conn,'swekshanudan','count(*)','status=2');
$sveekrt_presit_aavedan=getvalfield($conn,'swekshanudan','count(*)','status=3');
$asveekrt_aavedan=getvalfield($conn,'swekshanudan','count(*)','status=4');
$swekshanudan_status=getvalfield($conn,'swekshanudan','status',"phone_number='$mobile'");
?>
<style>
    a{
        text-decoration: none;
        color: grey;
    }
</style>


<div class="container-fluid pt-4 px-4">
  <div class="row">
    <div class="col-md-12">
      <h2 class="text-center mb-4">आवेदन डैशबोर्ड</h2>
    </div>
  </div>
  <div class="row">
    <h6>स्वेच्छानुदान का स्टेटस</h6>
    <div class="col-md-12">
      <div class="progress">
        <!-- <?php //if($swekshanudan_status==0){?>
          <div class="progress-bar progress-bar-striped progress-bar-animated bg-primary" role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">नया आवेदन</div> -->
          <?php if($swekshanudan_status==0){?>
            <div class="progress-bar progress-bar-striped progress-bar-animated bg-secondary" role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">प्राप्त आवेदन</div>
            <?php }else if($swekshanudan_status==1){?>
              <div class="progress-bar progress-bar-striped progress-bar-animated bg-secondary" role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">प्राप्त आवेदन</div>
              <div class="progress-bar progress-bar-striped progress-bar-animated bg-warning" role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">प्रस्तावित आवेदन</div>
              <?php }else if($swekshanudan_status==2){?>
                <div class="progress-bar progress-bar-striped progress-bar-animated bg-secondary" role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">प्राप्त आवेदन</div>
                <div class="progress-bar progress-bar-striped progress-bar-animated bg-warning" role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">प्रस्तावित आवेदन</div>
                <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">स्वीकृत आवेदन</div>
                <?php }else if($swekshanudan_status==3){?>
                  <div class="progress-bar progress-bar-striped progress-bar-animated bg-secondary" role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">प्राप्त आवेदन</div>
                  <div class="progress-bar progress-bar-striped progress-bar-animated bg-warning" role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">प्रस्तावित आवेदन</div>
                  <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">स्वीकृत आवेदन</div>
                  <div class="progress-bar progress-bar-striped progress-bar-animated bg-info" role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">स्वीकृत आवेदन (प्रेषित)</div>
                  <?php }else if($swekshanudan_status==4  ){?>
                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-secondary" role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">प्राप्त आवेदन</div>
                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-warning" role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">प्रस्तावित आवेदन</div>
                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">स्वीकृत आवेदन</div>
                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-info" role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">स्वीकृत आवेदन (प्रेषित)</div>
                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-danger" role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">अस्वीकृत आवेदन</div>
                    <?php } ?>
      </div>
    </div>
  </div>
</div>
<!-- =====================Progress Bar End======================== -->





    <!-- Status Code Start -->
    <!-- <div class="container-fluid pt-4 px-4">
        <div class="bg-light text-center rounded p-4">
            <h3 class="mb-0 text-center fw-bold text-primary">Status Code</h3>
            <hr class=" p-1 m-1 text-primary">
               <div class=" text-center fw-bold text-danger mt-2">
               0 = प्राप्त आवेदन
                    1 = प्रस्तावित आवेदन
                    2 = स्वीकृत आवेदन 
                    3 = प्रेषित स्वीकृत आवेदन
                    4 = अस्वीकृत आवेदन 
               </div>
        </div>
     </div> -->
    <!-- Status Code End -->
      
<!-- For Update Profile Modal -->
 <!-- The View Modal -->
<div class="modal fade" id="myModal-view" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">User Profile Update</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!-- Modal Body -->
            <div class="modal-body">
                <!-- This will be replaced with the content from view.php -->
            </div>
        </div>
    </div>
</div>
<!--  -->

<?php
$mobile_no = $_SESSION['mobile_no'] ?? null; // Fetch from session, or set to null if not set

if (!empty($mobile_no)) {
    $user_count = getvalfield($conn, "userlogin", "count(*)", "username = '$mobile_no' and status = 0");
} else {
    $user_count = 0; // Handle the case where $mobile_no is not set
}
?>

<script>
  $(document).ready(function() {
    if (<?= $user_count ?> == 0) {
      function handleUserProfile(u_id) {
        $.ajax({
          type: 'POST',
          url: 'user_profile_updtate.php', // Ensure this path is correct
          data: { id: u_id },
          success: function(data) {
            $('#myModal-view').find('.modal-body').html(data);
            $('#myModal-view').modal('show');

            var checkStatus = setInterval(function() {
              $.post('check_profile_status.php', { username: u_id }, function(response) {
                if (response.status == 1) {
                  $('#myModal-view').modal('hide');
                  clearInterval(checkStatus);
                }
              }, 'json');
            }, 5000);
          },
          error: function(xhr) {
            alert('Error: ' + xhr.statusText);
          }
        });
      }

      // Call the function on page load
      handleUserProfile(<?= json_encode($mobile_no) ?>);
    }
  });
</script>





    <!--  -->

<?php include('../includes/footer.php'); ?>