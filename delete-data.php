<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_simper";

try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (isset($_POST['ids']) && is_array($_POST['ids'])) {
        $ids = $_POST['ids'];
        $placeholders = implode(',', array_fill(0, count($ids), '?'));

        $sql = "DELETE FROM data_driver WHERE id IN ($placeholders)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute($ids);

        echo 'success';
    } else {
        echo 'error';
    }
} catch (PDOException $e) {
    echo 'error';
}
?>
