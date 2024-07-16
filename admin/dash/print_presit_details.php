<?php include('../dbconnection.php') ?>
<?php include('../session_check.php') ?>
<?php
$tblname = "swekshanudan";




if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM $tblname WHERE id='$id'";
    $result = mysqli_query($conn, $sql);
    if ($result && mysqli_num_rows($result) > 0) {
        $fetch = mysqli_fetch_assoc($result);
        $name = $fetch['name'];
        $phone_number = $fetch['phone_number'];
        $designation = $fetch['designation'];
        $district_id = $fetch['district_id'];
        $vidhansabha_name = $fetch['vidhansabha_name'];
        $vikaskhand_name = $fetch['vikaskhand_name'];
        $sector_name = $fetch['sector_name'];
        $gram_panchayat_name = $fetch['gram_panchayat_name'];
        $gram_name = $fetch['gram_name'];
        $subject = $fetch['subject'];
        $reference = $fetch['reference'];
        $expectations_amount = $fetch['expectations_amount'];
        $application_date = $fetch['application_date'];
        $comment = $fetch['comment'];
        $file_upload = $fetch['file_upload'];
        $ptr_sender = $fetch['ptr_sender'];
        $presit_date = $fetch['presit_date'];
        $anudan_prapt_add = $fetch['anudan_prapt_add'];
    } else {
        echo "<script>alert('Record not found');</script>";
        echo "<script>window.open('view.php?view=$tblname','_self')</script>";
    }
} else {
    echo "<script>alert('ID not provided');</script>";
    echo "<script>window.open('view.php?view=$tblname','_self')</script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Print Details</title>
    <style>
        .print-button {
            margin: 20px;
            padding: 10px 20px;
            background-color: #4ac387;
            color: white;
            border: none;
            cursor: pointer;
        }
    </style>
    <script>
        function printPage() {
            window.print();
        }
    </script>
</head>
<body>
    <div class="container">
        <h2>आवेदक विवरण</h2>
        <p>नाम: <?= $name ?></p>
        <p>फोन नंबर: <?= $phone_number ?></p>
        <p>पद का नाम: <?= $designation ?></p>
        <p>जिला: <?= $district_id ?></p>
        <p>विधानसभा: <?= $vidhansabha_name ?></p>
        <p>विकासखंड: <?= $vikaskhand_name ?></p>
        <p>सेक्टर: <?= $sector_name ?></p>
        <p>ग्राम पंचायत: <?= $gram_panchayat_name ?></p>
        <p>ग्राम: <?= $gram_name ?></p>
        <p>विषय: <?= $subject ?></p>
        <p>द्वारा: <?= $reference ?></p>
        <p>आपेक्षित राशि: <?= $expectations_amount ?></p>
        <p>आवेदन दिनांक: <?= $application_date ?></p>
        <p>टिप्पणी: <?= $comment ?></p>
        <p>फाइल अपलोड: <?= $file_upload ?></p>
        <p>प्रेषक: <?= $ptr_sender ?></p>
        <p>प्रेषित दिनांक: <?= $presit_date ?></p>
        <p>अनुदान प्राप्त पता: <?= $anudan_prapt_add ?></p>
        <button class="print-button" onclick="printPage()">Print</button>
    </div>
</body>
</html>
