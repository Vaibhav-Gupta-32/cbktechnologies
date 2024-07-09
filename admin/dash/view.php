<?php include('../dbconnection.php') ?>
<?php include('../session_check.php') ?>
<?php
$tblname = "Aavedak";
$tblkey = "id";
$pagename = "आवेदक";

if (isset($_REQUEST['id']))
    $id = $_REQUEST['id'];

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

    // echo $id." || ".$name." || ".$phone_number." || ".$designation." || ".$vidhansabha." || ".$vikaskhand." || ".$sector." || ".$gram_panchayt." || ".$gram." || ".$subject;
}
?>

<form>
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group shadow">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="name" placeholder=" " value="<?php echo $name; ?>" required readonly>
                    <label for="name">आवेदक का नाम </label>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="form-group shadow">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="mobile" placeholder=" " value="<?php echo $phone_number; ?>" required readonly>
                    <label for="mobile">फ़ोन नंबर </label>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="form-group shadow">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="designation" placeholder=" " value="<?php echo $designation; ?>" required readonly>
                    <label for="designation">पद </label>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="form-group shadow">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="vidhansabha" placeholder=" " value="<?php echo $vidhansabha; ?>" required readonly>
                    <label for="vidhansabha">विधानसभा </label>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="form-group shadow">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="vikaskhand" placeholder=" " value="<?php echo $vikaskhand; ?>" required readonly>
                    <label for="vikaskhand">विकासखंड </label>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="form-group shadow">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="sector" placeholder=" " value="<?php echo $sector; ?>" required readonly>
                    <label for="sector">सेक्टर </label>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="form-group shadow">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="gram_panchayt" placeholder=" " value="<?php echo $gram_panchayt; ?>" required readonly>
                    <label for="gram_panchayt">ग्राम पंचायत </label>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="form-group shadow">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="gram" placeholder=" " value="<?php echo $gram; ?>" required readonly>
                    <label for="gram">ग्राम </label>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="form-group shadow">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="subject" placeholder=" " value="<?php echo $subject; ?>" required readonly>
                    <label for="subject">विषय </label>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="form-group shadow">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="reference" placeholder=" " value="<?php echo $reference; ?>" required readonly>
                    <label for="reference">द्वारा </label>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="form-group shadow">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="expectations_amount" placeholder=" " value="<?php echo $expectations_amount; ?>" required readonly>
                    <label for="expectations_amount">आपेक्षित राशि </label>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="form-group shadow">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="application_date" placeholder=" " value="<?php echo $application_date; ?>" required readonly>
                    <label for="application_date">आवेदन दिनांक </label>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="form-group shadow">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="file_upload" placeholder=" " value="<?php echo $file_upload; ?>" required readonly>
                    <label for="file_upload">फाइल अपलोड </label>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="form-group shadow">
                <div class="form-floating mb-3">
                    <textarea class="form-control" id="comment" placeholder=" " readonly><?php echo $comment; ?></textarea>
                    <label for="comment">टिप्पणी </label>
                </div>
            </div>
        </div>
    </div>
</form>