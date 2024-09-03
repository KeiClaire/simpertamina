<?php
// Connect to the database using PDO
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_simper";



try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Get the ID and status from the POST request
    $id = $_POST['id'];
    $status = $_POST['status'];

    // Update the status in the database
    $sql = "UPDATE data_driver SET status = :status WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['status' => $status, 'id' => $id]);

    // Return a response (you can return JSON if needed)
    echo "Status updated successfully";

} catch (PDOException $e) {
    http_response_code(500);
    echo "Koneksi ke database gagal: " . $e->getMessage();
}
?>
