<?php include('config/dbconnection.php') ?>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $phoneNumber = $_POST['mobile_no'];

    if (!empty($phoneNumber) && isset($_POST['mobile_no'])) {
        $length = 6;
        $otp = generateOTP($length);
        $otpResponse = sendOTP($phoneNumber, $otp);

        if ($otpResponse) {
            // Assuming the response is JSON and decoding it
            $otpResponseDecoded = json_decode($otpResponse);


            // Log the decoded response for inspection
            file_put_contents('debug.log', "Decoded OTP Response: " . print_r($otpResponseDecoded, true) . "\n", FILE_APPEND);

            if (is_object($otpResponseDecoded)) {
                if (isset($otpResponseDecoded->status) && strtolower($otpResponseDecoded->status) === 'success') {
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
    } else {
        echo 'Please enter a valid phone number.';
    }
} else {
    echo 'Invalid request method.';
}
?>