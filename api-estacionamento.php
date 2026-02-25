<?php
// api-estacionamentos.php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

$lat = $_GET['lat'] ?? -23.5505;
$lng = $_GET['lng'] ?? -46.6333;
$raio = $_GET['raio'] ?? 1000; // raio em metros

$sul = $lat - 0.01;
$norte = $lat + 0.01;
$oeste = $lng - 0.01;
$leste = $lng + 0.01;

$query = "[out:json];
    (
        node[\"amenity\"=\"parking\"]($sul,$oeste,$norte,$leste);
        way[\"amenity\"=\"parking\"]($sul,$oeste,$norte,$leste);
    );
    out body;";

$url = "https://overpass-api.de/api/interpreter?data=" . urlencode($query);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_TIMEOUT, 30);
$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

if ($httpCode == 200) {
    echo $response;
} else {
    echo json_encode(['error' => 'Erro ao buscar dados', 'elements' => []]);
}
?>