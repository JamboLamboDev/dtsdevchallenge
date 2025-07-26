<?php

header('Content-Type: application/json');

include_once __DIR__ . '/db.php';  

$data = json_decode(file_get_contents("php://input"));


if (!isset($data->id) || !is_numeric($data->id)) {
    http_response_code(400);
    echo json_encode(["error" => "Task ID is required"]);
    exit;
}

try {
    $stmt = $pdo->prepare("DELETE FROM tasks WHERE id = ?");
    $stmt->execute([$data->id]);
    
    if ($stmt->rowCount() === 0) {
        http_response_code(404);
        echo json_encode(["error" => "Task not found"]);
        exit;
    }
    
    echo json_encode(["message" => "Task deleted successfully"]);
    
} catch(PDOException $e) {
    http_response_code(500);
    echo json_encode(["error" => "Failed to delete task: " . $e->getMessage()]);
}
?>