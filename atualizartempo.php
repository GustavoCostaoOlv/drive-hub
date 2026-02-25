<?php
// atualizartempo.php
header('Content-Type: application/json');
date_default_timezone_set('America/Fortaleza');

// Banco de dados: parkingdb
$servername = "localhost";
$username = "root";
$password = ""; // sua senha
$dbname = "parkingdb";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die(json_encode(['success' => false, 'error' => 'Erro conexão']));
}

$input = json_decode(file_get_contents('php://input'), true);
$vaga = $input['vaga'];
$status = $input['status'];
$placa = $input['placa'] ?? null;

if ($status == 0) { // OCUPOU
    $agora_local = date('Y-m-d H:i:s');
    $sql = "UPDATE parkinglot SET ocupado_desde = ?, placa = ? WHERE Position = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $agora_local, $placa, $vaga);
} else { // LIBEROU
    $sql = "UPDATE parkinglot SET ocupado_desde = NULL, placa = NULL WHERE Position = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $vaga);
}

$stmt->execute();
echo json_encode(['success' => true]);
$conn->close();
?>