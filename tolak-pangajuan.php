<?php
// Connect to the database using PDO
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_simper";

try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Get the ID from the query string
    $id = $_GET['id'];

    // Update the status to 'Ditolak'
    $sql = "UPDATE data_driver SET status = 'Ditolak' WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $id]);

    // Redirect back to the data driver page
    header("Location: data-driver.php");
    exit;

} catch (PDOException $e) {
    die("Koneksi ke database gagal: " . $e->getMessage());
}
?>
