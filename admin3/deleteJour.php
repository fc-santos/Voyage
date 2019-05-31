<?php
include_once "controlleur/connexionDB.php";
if (isset($_GET['idJour'])) {
    $query = "SELECT * from jour WHERE idJour=" . $_GET['idJour'];
    $stmt = $conn->query($query);

    while ($row = $stmt->fetch()) {
        $idEtape = $row->idEtape;
    }

    $stmt = $conn->query('DELETE FROM jour WHERE idJour=' . $_GET['idJour']);
    
    header("Location: listerJours.php?idEtape=" . $idEtape);
}
