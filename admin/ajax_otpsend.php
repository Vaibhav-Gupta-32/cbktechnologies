<?php include('config/dbconnection.php') ?>
<?php
$phoneNumber = $_REQUEST['mobile_no'];
$count = getvalfield($conn, "adminlogin", "count(*)", "mobile_no=$phoneNumber");
// echo $count;
if (isset($count)  && $count > 0) {
    $length = 6;
    $otp = generateOTP($length);
    // $phoneNumber = $phoneNumber;
    storeOTP($conn, $phoneNumber, $otp);
    $response = sendOTP($phoneNumber, $otp);

    if (isset($response)) {
        echo  "OTP has been sent to your number.";
    }else{
        echo  "something went wrong";
    }
} else {
    echo "Mobile Number Dose't Exesit !!";
}


?>