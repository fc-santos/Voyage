<?php
include_once "controlleur/connexionDB.php";
if (isset($_GET['idEtape'])) {
    $query = "SELECT * from etape WHERE idEtape=" . $_GET['idEtape'];
    $stmt = $conn->query($query);

    while ($row = $stmt->fetch()) {
        $idCircuit = $row->idCircuit;
    }

    $stmt = $conn->query('DELETE FROM etape WHERE idEtape=' . $_GET['idEtape']);
    
    header("Location: listerCircuit.php?idCircuit=" . $idCircuit);
}
