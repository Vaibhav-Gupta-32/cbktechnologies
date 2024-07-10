<?php
require '../dbconnection.php'; // Adjust the path as per your file structure
require '../session_check.php'; // Adjust the path as per your file structure

if (isset($_POST['vikaskhand_id'])) {
    $vikaskhand_id = $_POST['vikaskhand_id'];

    // Prepare and execute the query securely using prepared statements
    $query = "SELECT sector_id, sector_name FROM sector_master WHERE vikaskhand_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $vikaskhand_id);
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
