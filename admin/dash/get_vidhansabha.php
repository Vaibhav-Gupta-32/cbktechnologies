
<?php
require 'db_connection.php'; // Include your database connection

if (isset($_GET['district_id'])) {
    $district_id = $_GET['district_id'];
    $query = "SELECT vidhansabha_id, vidhansabha_name FROM vidhansabha WHERE district_id ='$district_id'";
    $result = mysqli_query($conn, $query);

    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $district_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $vidhansabhas = [];
    while ($row = $result->fetch_assoc()) {
        $vidhansabhas[] = $row;
    }
    echo json_encode($vidhansabhas);
}
?>
