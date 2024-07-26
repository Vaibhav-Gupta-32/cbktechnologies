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

<!-- ============================================= -->
<div class="container-fluid pt-4 px-4">
  <div class="row">
    <div class="col-md-12">
      <h2 class="text-center mb-4">आवेदन डैशबोर्ड</h2>
    </div>
  </div>
  <div class="row">
    <div class="col-md-4">
      <div class="card border-primary mb-3">
        <div class="card-body text-primary">
          <h5 class="card-title">नया आवेदन</h5>
          <p class="card-text">Submit a new application</p>
          <a href="../swekshanudan/swekshanudan.php" class="btn btn-primary">Submit</a>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card border-secondary mb-3">
        <div class="card-body text-secondary">
          <h5 class="card-title">प्राप्त आवेदन</h5>
          <p class="card-text">View received applications</p>
          <a href="../swekshanudan/aavedak.php" class="btn btn-secondary">View</a>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card border-warning mb-3">
        <div class="card-body text-warning">
          <h5 class="card-title">प्रस्तावित आवेदन</h5>
          <p class="card-text">View proposed applications</p>
          <a href="../swekshanudan/prastavit_aavedan.php" class="btn btn-warning">View</a>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card border-success mb-3">
        <div class="card-body text-success">
          <h5 class="card-title">स्वीकृत आवेदन</h5>
          <p class="card-text">View approved applications</p>
          <a href="../swekshanudan/sveekrt_aavedan.php" class="btn btn-success">View</a>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card border-info mb-3">
        <div class="card-body text-info">
          <h5 class="card-title">स्वीकृत आवेदन (प्रेषित)</h5>
          <p class="card-text">View approved and sent applications</p>
          <a href="../swekshanudan/presit_aavedan.php" class="btn btn-info">View</a>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card border-danger mb-3">
        <div class="card-body text-danger">
          <h5 class="card-title">अस्वीकृत आवेदन</h5>
          <p class="card-text">View rejected applications</p>
          <a href="../swekshanudan/asveekrt_aavedan.php" class="btn btn-danger">View</a>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- ===================Progress Bar Start========================== -->

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

<!-- ===================Timeline Start========================== -->
<div class="container-fluid pt-4 px-4">
  <div class="row">
    <div class="col-md-12">
      <h2 class="text-center mb-4">आवेदन डैशबोर्ड</h2>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <ul class="timeline">
        <li>
          <div class="timeline-badge primary"><i class="fas fa-check"></i></div>
          <div class="timeline-panel">
            <div class="timeline-heading">
              <h4 class="timeline-title">नया आवेदन</h4>
            </div>
            <div class="timeline-body">
              <p>Submit a new application</p>
              <a href="../swekshanudan/swekshanudan.php" class="btn btn-primary">Submit</a>
            </div>
          </div>
        </li>
        <li>
          <div class="timeline-badge secondary"><i class="fas fa-check"></i></div>
          <div class="timeline-panel">
            <div class="timeline-heading">
              <h4 class="timeline-title">प्राप्त आवेदन</h4>
            </div>
            <div class="timeline-body">
              <p>View received applications</p>
              <a href="../swekshanudan/aavedak.php" class="btn btn-secondary">View</a>
            </div>
          </div>
        </li>
        <!-- Add more list items for each status -->
      </ul>
    </div>
  </div>
</div>
<!-- ===================Timeline End========================== -->

<!-- ===================Timeline End========================== -->
<div class="container-fluid pt-4 px-4">
  <div class="row">
    <div class="col-md-12">
      <h2 class="text-center mb-4">आवेदन डैशबोर्ड</h2>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="accordion" id="accordionExample">
        <div class="accordion-item">
          <h2 class="accordion-header" id="headingOne">
            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
              नया आवेदन
            </button>
          </h2>
          <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
            <div class="accordion-body">
             
<!-- ===================Timeline End========================== -->




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
      



<?php include('../includes/footer.php'); ?>