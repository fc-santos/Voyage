<?php
include_once "controlleur/connexionDB.php";

if (isset($_POST['submit'])) {
    /*obtenir les nom t titres a partir des ids*/




    //utiliser les ids

    $query = "UPDATE `jour` SET `idEtape`=". $idEtape . ",`idSouper`=" . $idSouper . " WHERE idJour=" . $_POST['idJour'];
    $stmt = $conn->query($query);
    //$stmt->execute(['titreAModifier' => $_POST['nomEtape'], 'descriptionAModifier' => $_POST['descriptionEtape']]);

    $query = "SELECT * from jour WHERE idJour=" . $_POST['idJour'];
    $stmt = $conn->query($query);

    while ($row = $stmt->fetch()) {
        $idEtape = $row->idEtape;
    }
    
    @header("Location: listerEtapes.php?idEtape=" . $idEtape);
}
