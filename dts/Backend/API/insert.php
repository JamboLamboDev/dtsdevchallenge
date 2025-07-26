<?php

header('Content-Type: application/json');

include_once __DIR__ . '/db.php';  

$data = json_decode(file_get_contents("php://input"));

$allowedStatuses = ['pending', 'in progress', 'complete'];
$status = $data->status ?? 'pending';
$normalizedStatus = strtolower($status);

// Validate status
if (!in_array($normalizedStatus, $allowedStatuses)) {
    http_response_code(400);
    echo json_encode(["message" => "Invalid status value. Allowed: pending, in progress, complete."]);
    exit;
}

// Validate required fields
if (!isset($data->title) || !isset($data->deadline)) {
    http_response_code(400);
    echo json_encode(["message" => "Title and deadline are required."]);
    exit;
}

// Insert task
try {
    $stmt = $pdo->prepare("INSERT INTO tasks (title, description, status, deadline) VALUES (?, ?, ?, ?)");
    $stmt->execute([
    $data->title,
    $data->description ?? '',
    $normalizedStatus,
    $data->deadline
    ]);
} catch(PDOException $e) { 
    http_response_code(500);
    echo json_encode(["error" => "Failed to insert task: " . $e->getMessage()]);
    exit;
}

echo json_encode(["message" => "Task created successfully!"]);
