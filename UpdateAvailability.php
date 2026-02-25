<?php
// UpdateAvailability.php - Versão super simples
require_once 'dbcon.php';

if (isset($_GET["Position"]) && isset($_GET["Available"])) {
    
    $Pos = (int)$_GET["Position"];
    $Available = (int)$_GET["Available"];
    
    if ($Pos >= 1 && $Pos <= 5 && ($Available == 0 || $Available == 1)) {
        
        $sql = "UPDATE parkinglot SET Available = $Available WHERE Position = $Pos";
        
        if ($conn->query($sql)) {
            echo "OK";
        } else {
            echo "ERRO";
        }
    }
}

$conn->close();
?>