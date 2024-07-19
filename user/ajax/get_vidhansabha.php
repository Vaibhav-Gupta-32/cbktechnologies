<?php
require('../config/dbconnection.php'); // Adjust path as needed
require('../config/session_check.php'); // Adjust path as needed

if (isset($_POST['district_id'])) {
    $district_id = $_POST['district_id'];

    // Prepare and execute the query securely using prepared statements
    $query = "SELECT vidhansabha_id, vidhansabha_name FROM vidhansabha_master WHERE district_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $district_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $vidhansabha = [];
    while ($row = $result->fetch_assoc()) {
        $vidhansabha[] = $row;
    }

    // Encode the result as JSON
    echo json_encode($vidhansabha);
}
?>
