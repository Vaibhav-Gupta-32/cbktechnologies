<?php
require('../config/dbconnection.php'); // Adjust path as needed
require('../config/session_check.php'); // Adjust path as needed

if (isset($_POST['sector_id'])) {
    $sector_id = $_POST['sector_id'];

    // Prepare and execute the query seecurely using prepared statements
    $query = "SELECT gram_panchayat_id, gram_panchayat_name FROM gram_panchayat_master WHERE sector_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $sector_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $gram_panchayats = [];
    while ($row = $result->fetch_assoc()) {
        $gram_panchayats[] = $row;
    }

    // Encode the result as JSON
    echo json_encode( $gram_panchayats);
}
?>
