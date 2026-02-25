<?php
$servername = "localhost";
$username = "root";
$password = "Gus2090@";
$dbname = "parkingdb";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}

$conn->set_charset("utf8");
?>