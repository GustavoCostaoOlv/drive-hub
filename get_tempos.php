<?php
// get_tempos.php - Versão corrigida (SEM UTC)
header('Content-Type: application/json');
error_reporting(0);

// Forçar fuso horário de Fortaleza/Brasília
date_default_timezone_set('America/Fortaleza');

include 'dbcon.php';

$sql = "SELECT Position, Available, ocupado_desde, placa 
        FROM parkinglot ORDER BY Position";
$result = $conn->query($sql);

$vagas = [];
while($row = $result->fetch_assoc()) {
    $tempo_formatado = '';
    $tempo_segundos = 0;
    
    if ($row['ocupado_desde'] && $row['Available'] == 0) {
        // REMOVA O ' UTC' daqui - agora a data já está no fuso local
        $ocupado_desde = strtotime($row['ocupado_desde']);
        $agora = time();
        
        // Calcula diferença em segundos
        $diferenca = $agora - $ocupado_desde;
        
        // Garante que não seja negativo
        if ($diferenca < 0) {
            $diferenca = 0;
        }
        
        $tempo_segundos = $diferenca;
        
        // Converte para minutos
        $minutos = floor($diferenca / 60);
        $horas = floor($minutos / 60);
        $min_resto = $minutos % 60;
        
        // Formata o tempo
        if ($horas > 0) {
            $tempo_formatado = $horas . 'h ' . $min_resto . 'min';
        } elseif ($minutos > 0) {
            $tempo_formatado = $minutos . 'min';
        } else {
            $tempo_formatado = '0min';
        }
    }
    
    $vagas[] = [
        'position' => $row['Position'],
        'available' => (int)$row['Available'],
        'tempo' => $tempo_formatado,
        'tempo_segundos' => $tempo_segundos,
        'placa' => $row['placa']
    ];
}

ob_clean();
echo json_encode($vagas);
$conn->close();
?>