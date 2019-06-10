<?php
include_once "controlleur/connexionDB.php";
if (isset($_GET['idUtilisateur'])) {
    $stmt = $conn->query("UPDATE utilisateur SET role = 'Membre' WHERE idUtilisateur=" . $_GET['idUtilisateur']);
    //$stmt = $conn->query($query);

    /*while ($row = $stmt->fetch()) {
        $idCircuit = $row->idCircuit;
    }

    ;*/
    
    header("Location: gererAdmin.php");
}
