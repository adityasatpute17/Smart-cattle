<?php
      require './config/connection.php';
    
header('Content-Type: application/json');

// Check connection
if ($conn->connect_error) {
    die(json_encode(['success' => false, 'message' => 'Connection failed: ' . $conn->connect_error]));
}

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    
    // Prepare and bind
    $stmt = $conn->prepare("UPDATE cattle SET ReproductionStatus='open' WHERE id = ?");

    $stmt->bind_param("i", $id);
    
    // Execute the statement
    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error deleting record: ' . $conn->error]);
    }

    $stmt->close();
} else {
    echo json_encode(['success' => false, 'message' => 'No ID provided']);
}

$conn->close();
?>



        