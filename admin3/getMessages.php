<?php
if (!session_id()) {
    @session_start();
}
header('Content-Type: text/json');
require 'controlleur/connexionDB.php';
$sql = "SELECT * FROM message ORDER BY date DESC";

$result = $conn->query($sql);
$response = [];
while ($row = $result->fetch()) {
    $idUtilisateur = $row->idUtilisateur;

    $sql1 = "SELECT nom, prenom FROM utilisateur WHERE idUtilisateur = $idUtilisateur";
    $result1 = $conn->query($sql1);
    $row1 = $result1->fetch();

    $response[] = [
        'idMessage' => $row->idMessage,
        'idUtilisateur' => $row->idUtilisateur,
        'nomUtilisateur' => $row1->nom,
        'prenomUtilisateur' => $row1->prenom,
        'titre' => $row->titre,
        'contenu' => $row->contenu,
        'date' => $row->date,
        'messageLu' => $row->messageLu
    ];
}

echo json_encode($response);
