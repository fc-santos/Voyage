<?php
if (!session_id()) {
    @session_start();
}
header('Content-Type: text/json');
require 'controlleur/connexionDB.php';
$sql = "SELECT * FROM depart WHERE estActif = 0 ORDER BY dateDebut DESC";



$result = $conn->query($sql);
$response = [];
while ($row = $result->fetch()) {
    $sql2 = "SELECT * FROM circuit WHERE idCircuit = " . $row->idCircuit;
    $result2 = $conn->query($sql2);
    $row2 = $result2->fetch();

    $response[] = [
        'idDepart' => $row->idDepart,
        'idCircuit' => $row->idCircuit,
        'titre' => $row2->titre,
        'description' => $row2->description,
        'dateDebut' => $row->dateDebut,
        'nbPlaces' => $row->nbPlaces,
        'prix' => $row->prix,
        'titrePromotion' => $row->titrePromotion,
        'rabais' => $row->rabais
    ];
}

echo json_encode($response);
