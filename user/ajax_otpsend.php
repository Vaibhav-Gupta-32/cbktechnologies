<?php include('config/dbconnection.php') ?>
<?php
$phoneNumber = $_REQUEST['mobile_no'];

if (!empty($phoneNumber) && isset($_REQUEST['mobile_no'])) {
        $length = 6;
        $otp = generateOTP($length);
        $response = sendOTP($phoneNumber, $otp);
        
        if ($response) {
            if (is_object($response)) {
                // Assuming response is an object and has a 'status' property
                // print_r($response);die;
                if (isset($response->status) && $response->status == 'success') {
                    storeOTP($conn, $phoneNumber, $otp, 1);
                    echo "OTP has been sent to your number.";
                } else {
                    echo "Failed to send OTP.";
                }
            } else {
                echo "Unexpected response format.";
            }
        } else {
            echo "Something went wrong.";
        }
}
?>