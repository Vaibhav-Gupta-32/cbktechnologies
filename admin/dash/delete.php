<?php
include('../dbconnection.php');

header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['id']) && isset($data['table'])) {
    $id = mysqli_real_escape_string($conn, $data['id']);
    $table = mysqli_real_escape_string($conn, $data['table']);

    $sql = "DELETE FROM $table WHERE id = $id";
    // echo $sql;die;
    if (mysqli_query($conn, $sql)) {
        echo json_encode(['success' => true, 'message' => 'Record deleted successfully.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error deleting record: ' . mysqli_error($conn)]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid input.']);
}
?>
