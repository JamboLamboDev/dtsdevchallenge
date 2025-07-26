<?php
header('Content-Type: application/json');

include_once __DIR__ . '/db.php';  

try {
    $stmt = $pdo->query("SELECT * FROM tasks");
    $tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($tasks);
} catch(PDOException $e) {
    echo json_encode(["error" => $e->getMessage()]);
}

?>