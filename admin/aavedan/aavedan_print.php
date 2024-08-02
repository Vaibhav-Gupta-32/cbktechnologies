<?php include('../config/dbconnection.php') ?>
<?php include('../config/session_check.php') ?>
<?php
$tblname = "sthantran";
$tblkey = "id";
$pagename = "स्थान्तरण प्रिंट";
$currentDate = date('Y-m-d');
$maananeey_info=getvalfield($conn,'maananeey_master','maananeey_info','1');
if (isset($_REQUEST['id']))
    $protocol_id = $_REQUEST['id'];
$sql = "SELECT p.*, d.district_name FROM $tblname p INNER JOIN district_master d ON p.district_id = d.district_id WHERE status=2 and $tblkey='$protocol_id'";

// $fetch=mysqli_query($conn,"select * from protocol_details where 1");
$fetch = mysqli_query($conn, $sql);
?>
<!-- Staring page -->
<?php include('../includes/header.php') ?>
<style>
    p{
        margin-bottom:0%;
    }
</style>
<!-- Table Start -->
<div class="container-fluid px-4">
    <div class="row">
        <div class="col-sm-12 col-lg-12">
            <h3 class="mb-4 text-center mt-2 pt-3 "><?= $pagename; ?> स्वीकृति</h3>
            <p class="text-center">माननीय <?=$maananeey_info;?>, छत्तीसगढ़ शासन का दौरा कार्यक्रम</p>
            <div class=" rounded" style="overflow-y: scroll;">

                <table class="table table-striped border shadow">
                    <thead class=" head">
                        <tr class="text-center">
                            <!-- <th>सि. नं.</th> -->
                            <!-- <th scope="col">क्रमांक नं.</th>
                            <th scope="col">प्रोटोकॉल तारीख</th> -->
                            <th scope="col">दिनांक</th>
                            <th scope="col">दिन</th>
                            <th scope="col">आगमन</th>
                            <th scope="col">प्रस्थान</th>
                            <th scope="col">विवरण</th>
                            <th scope="col">माध्यम</th>
                            <!-- <th scope="col">जिला</th>
                            <th scope="col">प्रोटोकॉल बनाई तिथि</th> -->


                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        while ($row = mysqli_fetch_array($fetch)) {
                            $district= $row['district_name'] ;
                            $cpp_name= $row['cpp_name'] ;
                        ?>
                            <tr class=" text-center">
                                <!-- <th scope="row"><?= $i++ ?></th> -->
                                <!-- <td><?= $row['kramank_no'] ?></td> -->
                                <!-- <td><?= date('d-m-Y', strtotime($row['protocol_date'])) ?></td> -->
                                <td><?= date('d-m-Y', strtotime($row['travel_date'])) ?></td>
                                <td><?= $row['days'] ?></td>
                                <td><?= $row['entry_time'] ?></td>
                                <td><?= $row['exit_time'] ?></td>
                                <td><?= $row['details'] ?></td>
                                <td><?= $row['madhyam'] ?></td>
                                <!-- <td><?= $row['district_name'] ?></td> -->
                                <!-- <td><?= date('d-m-Y', strtotime($row['create_date'])) ?></td> -->
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <p class="text-center">रात्रि विश्राम <?= $district;?> निवास स्थान में।</p>
                <p class="text-left">टीप :</p>
                <p class="text-left">1- माननीय मंत्री जी की सुरक्षा श्रेणी "Z" है।
                    </p>
                <p class="text-left">2- माननीय मंत्री जी का ब्लडगुप "AB Positive" रिपीट " AB Positive" है।
                </p>
                <div class="d-flex flex-column justify-content-end">
                    <p class="text-end">(मतम)</p>
                    <p class="text-end"><?=$cpp_name?></p>
                </div>
                <p class="text-left">प्रतिलिपि :</p>
                <div>
                    <p>1- माननीय राज्यपाल महोदय के परिसहाय, राजभवन छत्तीसगढ़, रायपुर</p>
                    <p>2- निज सचिव, माननीय मुख्यमंत्री जी, छत्तीसगढ़ रायपुर</p>
                    <p>3- विशेष सहायक / निज सचिव, मानमंत्रीगण, छत्तीसगढ़ रायपुर</p>
                    <p>4- माननीय सांसद महोदय / माननीय विधायक महोदय,</p>
                    <p>5- अवर सचिव, मुख्य सचिव, मुख्य सचिव कार्यालय, मंत्रालय, अटल नगर रायपुर</p>
                    <p>6- प्रमुख सचिव/सचिव/ कौशल विकास, तकनीकी शिक्षा एवं रोजगार एवं प्रौद्योगिकी, उच्च शिक्षा, खेल एवं युवा कल्याण विभाग, छत्तीसगढ़, मंत्रालय, अटल नगर रायपुर</p>
                    <p>7- पुलिस महानिदेशक, छत्तीसगढ़ रायपुर</p>
                    <p>8- आयुक्त/ संचालक, जनसम्पर्क, रायपुर छत्तीसगढ़</p>
                    <p>9- कलेक्टर, जिला- जशपुर/ कोरिया / मनेंद्रगढ़ - चिरमिरी - भरतपुर /</p>
                    <p>10- प्रोटोकाल अधिकारी, जिला- जशपुर/ कोरिया/मनेंद्रगढ़-चिरमिरी - भरतपुर/ को सूचनार्थ एवं आवश्यक कार्यवाही हेतु ।</p>
                    <p>11- पुलिस अधीक्षक, जिला- जशपुर / कोरिया / मनेंद्रगढ़ - चिरमिरी - भरतपुर/ कृपया मान मंत्रीजी के प्रवास के दौरान सभी रूट एवं कार्यक्रम स्थल पर आवश्यक सुरक्षा व्यवस्था सुनिश्चित करने का कष्ट करेंगे।</p>
                    <p>12- पुलिस नियंत्रण कक्ष, जिला- जशपुर/ कोरिया / मनेंद्रगढ़ - चिरमिरी - भरतपुर ।</p>
                    <div class="d-flex flex-column justify-content-end">
                        <p class="text-end">(मतम)</p>
                        <p class="text-end"><?=$cpp_name?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Jquery CDN -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://ajax.aspnetCDN.com/ajax/jQuery/jQuery-1.9.0.min.js"></script>
<!-- JavaScript Libraries -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="../lib/chart/chart.min.js"></script>
<script src="../lib/easing/easing.min.js"></script>
<script src="../lib/waypoints/waypoints.min.js"></script>
<script src="../lib/owlcarousel/owl.carousel.min.js"></script>
<script src="../lib/tempusdominus/js/moment.min.js"></script>
<script src="../lib/tempusdominus/js/moment-timezone.min.js"></script>
<script src="../lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Template Javascript -->
<script src="../js/main.js"></script>
<script src="../js/custom.js"></script>
</body>

</html>