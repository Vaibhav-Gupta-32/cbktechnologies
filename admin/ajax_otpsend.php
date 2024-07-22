<?php include('config/dbconnection.php') ?>
<?php
header('Content-Type: application/json');

$phoneNumber = $_REQUEST['mobile_no'];
$response = [
    'status' => 'error',
    'message' => 'Unknown error'
];

if (!empty($phoneNumber) && isset($_REQUEST['mobile_no'])) {
    $count = getvalfield($conn, "adminlogin", "count(*)", "mobile_no='$phoneNumber'");
    
    if (isset($count) && $count > 0) {
        $length = 6;
        $otp = generateOTP($length);
        $otpResponse = sendOTP($phoneNumber, $otp);
        
        if ($otpResponse) {
            if (is_object($otpResponse)) {
                echo $phoneNumber;die;
                if (isset($otpResponse->status) && $otpResponse->status == 'success') {
                    storeOTP($conn, $phoneNumber, $otp, 1);
                    $response['status'] = 'success';
                    $response['message'] = "OTP has been sent to your number.";
                } else {
                    $response['message'] = "Failed to send OTP. Reason: " . $otpResponse->description;
                }
            } else {
                $response['message'] = "Unexpected response format.";
            }
        } else {
            $response['message'] = "Something went wrong.";
        }
    } else {
        $response['message'] = "Mobile Number Doesn't Exist !!";
    }
} else {
    $response['message'] = "Invalid mobile number.";
}

echo json_encode($response);

?>