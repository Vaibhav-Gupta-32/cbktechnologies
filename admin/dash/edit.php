<?php include('../dbconnection.php') ?>
<?php include('../session_check.php') ?>
<?php
$tblname = "Aavedak";
$tblkey = "id";
$pagename = "आवेदक";

if (isset($_REQUEST['id']))
    $id = $_REQUEST['id'];

if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $phone_number = $_POST['phone_number'];
    $designation = $_POST['designation'];
    $vidhansabha = $_POST['vidhansabha'];
    $vikaskhand = $_POST['vikaskhand'];
    $sector = $_POST['sector'];
    $gram_panchayt = $_POST['gram_panchayt'];
    $gram = $_POST['gram'];
    $subject = $_POST['subject'];
    $reference = $_POST['reference'];
    $expectations_amount = $_POST['expectations_amount'];
    $application_date = $_POST['application_date'];
    $file_upload = $_POST['file_upload'];
    $comment = $_POST['comment'];
    $sql = "select * from swekshanudan where id='$id'";
    $fetch = mysqli_fetch_array(mysqli_query($conn, $sql));
}

if ($id) {
    // echo 'sdaas'.$id;
    $sql = "select * from swekshanudan where id='$id'";
    $fetch = mysqli_fetch_array(mysqli_query($conn, $sql));
    $name = $fetch['name'];
    $phone_number = $fetch['phone_number'];
    $designation = $fetch['designation'];
    $vidhansabha = $fetch['vidhansabha'];
    $vikaskhand = $fetch['vikaskhand'];
    $sector = $fetch['sector'];
    $gram_panchayt = $fetch['gram_panchayt'];
    $gram = $fetch['gram'];
    $subject = $fetch['subject'];
    $reference = $fetch['reference'];
    $expectations_amount = $fetch['expectations_amount'];
    $application_date = $fetch['application_date'];
    $file_upload = $fetch['file_upload'];
    $comment = $fetch['comment'];
}
?>

<form action="" method="post">
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group shadow">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="name" placeholder=" " value="<?php echo $name; ?>" required>
                    <label for="name">आवेदक का नाम </label>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="form-group shadow">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" name="phone_number" id="mobile" placeholder=" " value="<?php echo $phone_number; ?>" required onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                    <label for="mobile">फ़ोन नंबर </label>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="form-group shadow">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" name="designation" id="designation" placeholder=" " value="<?php echo $designation; ?>" required>
                    <label for="designation">पद </label>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="form-group shadow">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" name="vidhansabha" id="vidhansabha" placeholder=" " value="<?php echo $vidhansabha; ?>" required>
                    <label for="vidhansabha">विधानसभा </label>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="form-group shadow">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" name="vikaskhand" id="vikaskhand" placeholder=" " value="<?php echo $vikaskhand; ?>" required>
                    <label for="vikaskhand">विकासखंड </label>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="form-group shadow">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" name="sector" id="sector" placeholder=" " value="<?php echo $sector; ?>" required>
                    <label for="sector">सेक्टर </label>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="form-group shadow">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" name="gram_panchayt" id="gram_panchayt" placeholder=" " value="<?php echo $gram_panchayt; ?>" required>
                    <label for="gram_panchayt">ग्राम पंचायत </label>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="form-group shadow">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" name="gram" id="gram" placeholder=" " value="<?php echo $gram; ?>" required>
                    <label for="gram">ग्राम </label>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="form-group shadow">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" name="subject" id="subject" placeholder=" " value="<?php echo $subject; ?>" required>
                    <label for="subject">विषय </label>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="form-group shadow">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" name="reference" id="reference" placeholder=" " value="<?php echo $reference; ?>" required>
                    <label for="reference">द्वारा </label>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="form-group shadow">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" name="expectations_amount" id="expectations_amount" placeholder=" " value="<?php echo $expectations_amount; ?>" required>
                    <label for="expectations_amount">आपेक्षित राशि </label>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="form-group shadow">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" name="application_date" id="application_date" placeholder=" " value="<?php echo $application_date; ?>" required>
                    <label for="application_date">आवेदन दिनांक </label>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="form-group shadow">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" name="file_upload" id="file_upload" placeholder=" " value="<?php echo $file_upload; ?>" required>
                    <label for="file_upload">फाइल अपलोड </label>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="form-group shadow">
                <div class="form-floating mb-3">
                    <textarea class="form-control" name="comment" id="comment" placeholder=" "><?php echo $comment; ?></textarea>
                    <label for="comment">टिप्पणी </label>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="form-group shadow">
                <div class="form-floating mb-3">
                    <button class="col-12 text-white btn  text-center shadow" type="submit" style="background-color:#4ac387;" name="submit"><b>Submit</b></button>
                </div>
            </div>
        </div>

    </div>
</form>