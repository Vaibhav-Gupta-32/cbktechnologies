<?php

// get value from any condition //
function getvalfield($con,$table,$field,$where)
{
	if($where == "")
	$where =1;
	
	 $sql = "select $field from $table where $where";
	
//echo $sql."<br>";
	 $getvalue =  mysqli_query($con,$sql);
     $getval   =  mysqli_fetch_row($getvalue); 

	return $getval[0];
}

//get random otp 
function generateOTP($length) {
    $digits = '0123456789';
    $otp = '';
    for ($i = 0; $i < $length; $i++) {
        $otp .= $digits[rand(0, strlen($digits) - 1)];
    }
    return $otp;
}

//for send otp
function sendOTP($phoneNumber, $otp) {
    $apiKey = "xUNYy9lqpgK2V1vz";
    $senderId = "SBJSWL";
    $message = urlencode("Dear User, Your login OTP is $otp  .This OTP will expire in 5 minutes. SBJSWL www.shyambiharijaiswal.in");
    $url = "http://216.48.183.136/vb/apikey.php?apikey=$apiKey&senderid=$senderId&number=$phoneNumber&message=$message";

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);

    // return $response;
    print_r($response);
}

//for store
function storeOTP($conn, $phoneNumber, $otp, $status)
{
    $date = new DateTime('now', new DateTimeZone('Asia/Kolkata')); // Set the timezone to Indian time
    $dateTime = $date->format('Y-m-d H:i:s');

    $newDate = clone $date; // Create a copy of the current date
    $newDate->modify('+5 minutes'); // Add 5 minutes to the current date
    $newDateTime = $newDate->format('Y-m-d H:i:s');

    $stmt = $conn->prepare("INSERT INTO otps (phone_number, otp, valid_time, otpSend_status) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $phoneNumber, $otp, $newDateTime, $status);
    $stmt->execute();
    $stmt->close();
}
?>