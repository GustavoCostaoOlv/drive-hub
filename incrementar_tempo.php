<?php
// incrementar_tempo.php - Força atualização dos tempos
header('Content-Type: application/json');
include 'dbcon.php';

// Pega todas as vagas ocupadas
$sql = "SELECT Position, ocupado_desde FROM parkinglot 
        WHERE Available = 0 AND ocupado_desde IS NOT NULL";
$result = $conn->query($sql);

$atualizadas = 0;
while($row = $result->fetch_assoc()) {
    // Não precisa fazer nada - o cálculo é feito na leitura
    $atualizadas++;
}

echo json_encode([
    'success' => true,
    'message' => "$atualizadas vagas ocupadas"
]);

$conn->close();
?>