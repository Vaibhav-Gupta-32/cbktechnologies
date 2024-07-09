<?php
require '../dbconnection.php';
require '../session_check.php';

if (isset($_POST['vidhansabha_id'])) {
    $vidhansabha_id = $_POST['vidhansabha_id'];

    // Prepare and execute the query securely using prepared statements
    $query = "SELECT vikaskhand_id, vikaskhand_name FROM vikaskhand_master WHERE vidhansabha_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $vidhansabha_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $vikaskhands = [];
    while ($row = $result->fetch_assoc()) {
        $vikaskhands[] = $row;
    }

    // Encode the result as JSON
    echo json_encode($vikaskhands);
}
?>
