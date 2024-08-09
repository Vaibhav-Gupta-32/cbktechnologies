<!-- aavedak search start -->
<div class="container-fluid pt-4 px-4">
    <h4 class="text-center fw-bolder text-primary mb-3"><?= $pagename; ?></h4>
    <form action="" method="post">
        <div class="row">

           <!-- for location view -->
           <?php include('location_add.php') ?>

            <div class="col-lg-4">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <input type="text" name="phone_number" class="form-control" id="phone_number" placeholder="आवेदक का फ़ोन नंबर" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                        <label for="mobile">आवेदक का फ़ोन नंबर </label>
                    </div>

                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <input type="date" name="from_date" class="form-control" id="from_date" placeholder="कब से ">
                        <label for="from_date">कब से</label>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <?php
                        // Set default current date
                        $currentDate = date('Y-m-d'); // Format: YYYY-MM-DD
                        ?>
                        <input type="date" name="to_date" value="<?= $currentDate ?>" class="form-control" id="to_date" placeholder="कब तक ">
                        <label for="to_date">कब तक</label>
                    </div>
                </div>
            </div>

            <!-- btn -->
            <!-- 1 -->
            <!-- <div class="col-lg-4 text-center mb-3">
                <a name="Add_New" onclick="location.href='new_aavedan.php';" class="form-control text-center text-white btn text-center shadow bg-primary" style="background-color:#4ac387;"><b>Add New</b></a>
            </div> -->
            <!-- 2 -->
            <div class="col-lg-4 text-center mb-3">
                <div name="PrintList" onclick="" class="form-control text-center text-white btn text-center shadow" style="background-color:#4ac387;"><b>Print List</b></div>
            </div>
            <!-- 3 -->
            <div class="col-lg-4 text-center mb-3">
                <button name="search" class="form-control text-center text-white btn text-center shadow bg-info" type="submit"><b>Search</b></button>
            </div>
        </div>
    </form>
</div>
<!-- aavedak search End -->