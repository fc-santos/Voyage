<?php
$lieu = $_GET['lieu'];

$reponse = '';

$conn = new mysqli('localhost', 'root', '', 'dbvoyage');

$sql = "INSERT INTO `jour`(`idEtape`, `idHebergement`, `idSouper`, `idDiner`, `idActivite`, `lieu`) VALUES (1, 2, 3, 4, 5, '$lieu')";

$result = $conn->query($sql);

$conn->close();
