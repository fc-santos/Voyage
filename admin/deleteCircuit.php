<?php
include_once "controlleur/connexionDB.php";
if (isset($_GET['idCircuit'])) {
    $stmt = $conn->query('DELETE FROM circuit WHERE idCircuit=' . $_GET['idCircuit']);
    header("Location: gererCircuit.php");
}
