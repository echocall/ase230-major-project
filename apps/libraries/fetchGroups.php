<?php
header('Content-Type: application/json');

// Replace with your actual database connection details
try {
    $conn = new PDO("mysql:host=localhost;dbname=squadup", 'username', 'password');
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $conn->prepare("SELECT * FROM Groups");
    $stmt->execute();

    $groups = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($groups);
}
catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
