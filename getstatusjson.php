<?php
// getstatusjson.php - APENAS JSON, SEM NADA MAIS
header('Content-Type: application/json');
header('Cache-Control: no-cache, must-revalidate');

// CONEXÃO COM BANCO - COLOQUE SUA SENHA AQUI!
$servername = "localhost";
$username = "root";
$password = "Gus2090@"; // <---- SUA SENHA DO MySQL
$dbname = "parkingdb";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    echo json_encode(["erro" => "Falha na conexão: " . $conn->connect_error]);
    exit;
}

$sql = "SELECT Position, Available FROM parkinglot ORDER BY Position";
$result = $conn->query($sql);

$vagas = [];
while($row = $result->fetch_assoc()) {
    $vagas[] = $row;
}

echo json_encode($vagas);

$conn->close();
?>