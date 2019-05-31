<?php
if (!session_id()) {
    @session_start();
}
header('Content-Type: text/json');
require 'controlleur/connexionDB.php';
$sql = "SELECT * FROM depart";

$result = $conn->query($sql);
$response = [];
while ($row = $result->fetch()) {
    $response[] = [
        'idDepart' => $row->idDepart,
        'idCircuit' => $row->idCircuit,
        'dateDebut' => $row->dateDebut,
        'nbPlaces' => $row->nbPlaces,
        'prix' => $row->prix,
        'titrePromotion' => $row->titrePromotion,
        'rabais' => $row->rabais
    ];
}

echo json_encode($response);
