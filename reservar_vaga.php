<?php
header('Content-Type: application/json');
include 'dbcon.php';
$input = json_decode(file_get_contents('php://input'), true);
if (!$input) {
    echo json_encode(['success' => false, 'error' => 'Dados não recebidos']);
    exit;
}
$vaga = (int)$input['vaga'];
$placa = strtoupper(trim($input['placa']));
$sql = "UPDATE parkinglot SET Available=0, ocupado_desde=NOW(), placa='$placa' WHERE Position=$vaga AND Available=1";
if ($conn->query($sql) && $conn->affected_rows > 0) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'error' => 'Falhou']);
}
$conn->close();
?>