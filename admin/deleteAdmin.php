<?php
include_once "controlleur/connexionDB.php";
if (isset($_GET['idUtilisateur'])) {
    $stmt = $conn->query("DELETE FROM utilisateur WHERE idUtilisateur=" . $_GET['idUtilisateur']);
    //$stmt = $conn->query($query);

    /*while ($row = $stmt->fetch()) {
        $idCircuit = $row->idCircuit;
    }

    ;*/
    
    header("Location: gererAdmin.php");
}
