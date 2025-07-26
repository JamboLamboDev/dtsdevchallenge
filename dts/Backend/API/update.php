<?php

header('Content-Type: application/json');

include_once __DIR__ . '/db.php';  

$data = json_decode(file_get_contents("php://input"), true);

if (empty($data['id']) || empty($data['status'])) {
    echo json_encode(["error" => "Task ID and status required"]);
    exit;
}

try {
    $stmt = $pdo->prepare("UPDATE tasks SET status = ? WHERE id = ?");
    $stmt->execute([$data['status'], $data['id']]);
    
    echo json_encode(["message" => "Task updated"]);
} catch(PDOException $e) {
    echo json_encode(["error" => $e->getMessage()]);
}

