<?php
// UpdateAvailability.php
include 'dbcon.php';

$Pos = $_GET["Position"];
$Available = $_GET["Available"];

if ($Pos >= 1 && $Pos <= 5 && ($Available == 0 || $Available == 1)) {
    
    $sql = "UPDATE parkinglot SET Available = ? WHERE Position = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $Available, $Pos);
    
    if ($stmt->execute()) {
        echo "✅ Vaga $Pos atualizada para " . ($Available ? "LIVRE" : "OCUPADA");
    } else {
        echo "❌ Erro ao atualizar";
    }
    
    $stmt->close();
} else {
    echo "❌ Dados inválidos";
}

$conn->close();
?>