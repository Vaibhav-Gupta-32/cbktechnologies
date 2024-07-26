<?php include('config/dbconnection.php') ?>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $phoneNumber = $_POST['mobile_no'];

    if (!empty($phoneNumber)) {
        $length = 6;
        $otp = generateOTP($length);
        $response = sendOTP($phoneNumber, $otp);

        if ($response) {
            if (is_object($response)) {
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
    } else {
        echo 'Please enter a valid phone number.';
    }
} else {
    echo 'Invalid request method.';
}
?>