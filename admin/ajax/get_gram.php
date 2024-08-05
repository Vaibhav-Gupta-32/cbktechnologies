<?php
require('../config/dbconnection.php'); // Adjust path as needed
require('../config/session_check.php'); // Adjust path as needed
if (isset($_POST['gram_panchayat_id']) && isset($_POST['area_id'])) {
    $gram_panchayat_id = $_POST['gram_panchayat_id'];
    $area_id = $_POST['area_id'];
    $query = "SELECT gram_id, gram_name FROM gram_master WHERE gram_panchayat_id = '$gram_panchayat_id' and area_id = '$area_id'";
    $result = mysqli_query($conn, $query); //run query
    $grams = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $grams[] = $row;
    }
    echo json_encode($grams);
}
?>
