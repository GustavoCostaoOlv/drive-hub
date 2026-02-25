<?php
header('Content-Type: application/json');
include 'dbcon.php';

$input = json_decode(file_get_contents('php://input'), true);
$vaga = (int)$input['vaga'];

$sql = "UPDATE parkinglot SET 
        Available = 1, 
        ocupado_desde = NULL,
        placa = NULL 
        WHERE Position = $vaga";

if ($conn->query($sql) && $conn->affected_rows > 0) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false]);
}

$conn->close();
?>