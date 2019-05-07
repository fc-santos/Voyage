<?php
include_once "controlleur/connexionDB.php";

if (isset($_POST['submit'])) {
    $query = "UPDATE `circuit` SET `titre`= :titreAModifier,`description`= :descriptionAModifier WHERE idCircuit=" . $_POST['idCircuit'];
    $stmt = $conn->prepare($query);
    $stmt->execute(['titreAModifier' => $_POST['nomCircuit'], 'descriptionAModifier' => $_POST['descriptionCircuit']]);
    
    @header("Location: gererCircuit.php");
}
