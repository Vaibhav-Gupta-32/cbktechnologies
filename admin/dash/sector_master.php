<?php include('../dbconnection.php') ?>
<?php include('../session_check.php') ?>
<?php
//php code 

?>
<?php include('includes/header.php') ?>
<?php include('includes/sidebar.php') ?>
<?php include('includes/navbar.php') ?>

<div class="container-fluid pt-4 px-4">
    <!-- Form Sector -->
    <form method="post">
        <div class="row text-center align-items-center">
            <h5 class="text-center fw-bolder text-primary mb-3">नया सेक्टर का नाम जोड़ें</h5>

            <div class="col-lg-4 text-center mb-3">
                <select name="district_id" class="form-select form-control border-success" required>
                    <option selected>जिले का नाम चुनें</option>
                    <?php
                    // while ($district_row = mysqli_fetch_assoc($district_result)) {
                    //     echo "<option value='" . $district_row['district_id'] . "'>" . $district_row['district_name'] . "</option>";
                    // }
                    ?>
                </select>
            </div>

            <div class="col-lg-4 text-center mb-3">
                <select name="vidhansabha_id" class="form-select form-control border-success" required>
                    <option selected>विधानसभा का नाम चुनें</option>
                    <?php
                    // while ($vidhansabha_row = mysqli_fetch_assoc($vidhansabha_result)) {
                    //     echo "<option value='" . $vidhansabha_row['vidhansabha_id'] . "'>" . $vidhansabha_row['vidhansabha_name'] . "</option>";
                    // }
                    ?>
                </select>
            </div>

            <div class="col-lg-4 text-center mb-3">
                <select name="vikaskhand_id" class="form-select form-control border-success" required>
                    <option selected>विकासखंड का नाम चुनें</option>
                    <?php
                    // while ($vikaskhand_row = mysqli_fetch_assoc($vikaskhand_result)) {
                    //     echo "<option value='" . $vikaskhand_row['vikaskhand_id'] . "'>" . $vikaskhand_row['vikaskhand_name'] . "</option>";
                    // }
                    ?>
                </select>
            </div>

            <div class="col-lg-6 text-center mb-3">
                <input type="text" name="sector_name" class="form-control border-success" placeholder="सेक्टर का नाम" required>
            </div>

            <div class="col-lg-3 text-center mb-3">
                <button name="submit_sector" class="form-control text-center text-white btn text-center shadow" type="submit" style="background-color:#4ac387;"><b>Save</b></button>
            </div>

            <div class="col-lg-3 text-center mb-3">
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
                            <th scope="col">क्रमांक</th>
                            <th scope="col">सेक्टर का नाम</th>
                            <th scope="col">विकासखंड</th>
                            <th scope="col">विधानसभा</th>
                            <th scope="col">जिला</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
          
                                        
                                     </tbody>
                                 </table>
                             </div>
                         </div>
                     </div>
                 </div>
                 </div>

                 </div>