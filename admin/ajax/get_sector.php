<?php
require('../config/dbconnection.php'); // Adjust path as needed
require('../config/session_check.php'); // Adjust path as needed

// echo $_POST['vikaskhand_id'].'<br>';
// echo $_POST['area_id'].'<br>';
if (isset($_POST['vikaskhand_id']) && isset($_POST['area_id'])) {
    $vikaskhand_id = $_POST['vikaskhand_id'];
    $area_id = $_POST['area_id'];

    // Prepare and execute the query securely using prepared statements
    $query = "SELECT sector_id, sector_name FROM sector_master WHERE vikaskhand_id = ? and area_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ii", $vikaskhand_id, $area_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $sectors = [];
    while ($row = $result->fetch_assoc()) {
        $sectors[] = $row;
    }

    // Encode the result as JSON
    echo json_encode($sectors);
}
?>
