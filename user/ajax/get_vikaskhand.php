<?php
require('../config/dbconnection.php'); // Adjust path as needed
require('../config/session_check.php'); // Adjust path as needed

// echo $_POST['vidhansabha_id'].'<br>';
// echo $_POST['area_id'].'<br>';
if (isset($_POST['vidhansabha_id']) && isset($_POST['area_id'])) {
    $vidhansabha_id = $_POST['vidhansabha_id'];
     $area_id = $_POST['area_id'];

    // Prepare and execute the query securely using prepared statements
    $query = "SELECT vikaskhand_id, vikaskhand_name FROM vikaskhand_master WHERE vidhansabha_id = ? and area_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ii", $vidhansabha_id, $area_id);
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
