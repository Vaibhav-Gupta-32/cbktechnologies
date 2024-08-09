<?php include('config/dbconnection.php') ?>
<?php
header('Content-Type: application/json');

$phoneNumber = $_REQUEST['mobile_no'];
$response = [
    'status' => 'error',
    'message' => 'Unknown error',
    'view' => 'readonly'
];

if (!empty($phoneNumber) && isset($_REQUEST['mobile_no'])) {
    $count = getvalfield($conn, "adminlogin", "count(*)", "mobile_no='$phoneNumber'");
    
    if (isset($count) && $count > 0) {
        $length = 6;
        $otp = generateOTP($length);
        $otpResponse = sendOTP($phoneNumber, $otp);

        // Debugging output
        file_put_contents('debug.log', "Raw OTP Response: " . print_r($otpResponse, true) . "\n", FILE_APPEND);

        if ($otpResponse) {
            // Assuming the response is JSON and decoding it
            $otpResponseDecoded = json_decode($otpResponse);

            // Log the decoded response for inspection
            file_put_contents('debug.log', "Decoded OTP Response: " . print_r($otpResponseDecoded, true) . "\n", FILE_APPEND);

            if (is_object($otpResponseDecoded)) {
                if (isset($otpResponseDecoded->status) && strtolower($otpResponseDecoded->status) === 'success') {
                    storeOTP($conn, $phoneNumber, $otp, 1);
                    $response['status'] = 'success';
                    $response['message'] = "OTP has been sent to your number.";
                    $response['view'] = "readonly";
                } else {
                    $response['message'] = "Failed to send OTP. Reason: " . (isset($otpResponseDecoded->description) ? $otpResponseDecoded->description : "Unknown error");
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
