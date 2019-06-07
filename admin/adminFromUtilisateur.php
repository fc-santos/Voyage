<?php
include_once "controlleur/connexionDB.php";
if (!session_id()) {
    @session_start();
}

if (isset($_GET['idUtilisateur'])) {
    $stmt = $conn->query('UPDATE `utilisateur` SET `role`= "Admin" WHERE idUtilisateur=' . $_GET['idUtilisateur']);

    $_SESSION['success'] = "L'utilisateur avec id " . $_GET['idUtilisateur'] . " est devenu Admin";
    
    header("Location: creerAdmin.php");
}
