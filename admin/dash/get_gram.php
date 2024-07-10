<?php
require '../dbconnection.php'; // Adjust the path as per your file structure
require '../session_check.php'; // Adjust the path as per your file structure

if (isset($_POST['gram_panchayat_id'])) {
    $gram_panchayat_id = $_POST['gram_panchayat_id'];

    // Prepare and execute the query securely using prepared statements
    $query = "SELECT gram_id, gram_name FROM gram_master WHERE gram_panchayat_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $gram_panchayat_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $sectors = [];
    while ($row = $result->fetch_assoc()) {
        $grams[] = $row;
    }

    // Encode the result as JSON
    echo json_encode($grams);
}
?>
