<?php
require('../config/dbconnection.php'); // Adjust path as needed
require('../config/session_check.php'); // Adjust path as needed

if (isset($_POST['vidhansabha_id'])) {
    $vidhansabha_id = $_POST['vidhansabha_id'];

    // Prepare and execute the query securely using prepared statements
    $query = "SELECT * FROM area_master WHERE 1";
    $stmt = $conn->prepare($query);
    // $stmt->bind_param("i", $vidhansabha_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $areas = [];
    while ($row = $result->fetch_assoc()) {
        $areas[] = $row;
    }

    // Encode the result as JSON
    echo json_encode($areas);
}
?>
