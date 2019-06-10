<?php
include_once "controlleur/connexionDB.php";

if (isset($_POST['submit'])) {
    $query = "UPDATE `utilisateur` SET `nom`= :nomAModifier,`prenom`= :prenomAModifier, `courriel`= :courrielAModifier WHERE idUtilisateur=" . $_POST['idUtilisateur'];
    $stmt = $conn->prepare($query);
    $stmt->execute(['nomAModifier' => $_POST['nomAdmin'], 'prenomAModifier' => $_POST['prenomAdmin'], 'courrielAModifier' => $_POST['courrielAdmin']]);

    /* $query = "SELECT * from etape WHERE idEtape=" . $_POST['idEtape'];
     $stmt = $conn->query($query);

     while ($row = $stmt->fetch()) {
         $idCircuit = $row->idCircuit;
     }*/
    
    @header("Location: gererAdmin.php");
}
