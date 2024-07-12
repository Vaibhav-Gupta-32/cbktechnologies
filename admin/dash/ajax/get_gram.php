<?php
require('../../dbconnection.php'); // Adjust path as needed
require('../../session_check.php'); // Adjust path as needed
if (isset($_POST['gram_panchayat_id'])) {
    $gram_panchayat_id = $_POST['gram_panchayat_id'];
    $query = "SELECT gram_id, gram_name FROM gram_master WHERE gram_panchayat_id = '$gram_panchayat_id'";
    $result = mysqli_query($conn, $query); //run query
    $grams = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $grams[] = $row;
    }
    echo json_encode($grams);
}
?>
