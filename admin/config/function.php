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
function generateOTP($length = 6) {
    $digits = '0123456789';
    $otp = '';
    for ($i = 0; $i < $length; $i++) {
        $otp .= $digits[rand(0, strlen($digits) - 1)];
    }
    return $otp;
}
?>