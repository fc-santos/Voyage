<?php
if (!session_id()) {
    @session_start();
}

include_once "controlleur/connexionDB.php";
if (isset($_POST['submit'])) {
    if (isset($_POST['titreMessage']) && $_POST['titreMessage'] != "") {
        $titre = $_POST['titreMessage'];
    } else {
        $titre = 'Sans titre';
    }

    if (isset($_POST['contenuMessage']) && $_POST['contenuMessage'] != "") {
        $contenu = $_POST['contenuMessage'];
    } else {
        $contenu = 'Sans contenu';
    }

    if (isset($_SESSION['idUtilisateur'])) {
        $idUtilisateur = $_SESSION['idUtilisateur'];
    } else {
        $idUtilisateur = 1;
    }

    date_default_timezone_set('America/New_York');
    $date = date("Y-m-d H:i:s");


    try {
        $sql = "INSERT INTO `message`(`idUtilisateur`, `titre`, `contenu`, `date`) VALUES ($idUtilisateur,:titre, :contenu, '$date')";
        
        $stmt = $conn->prepare($sql);
        $stmt->execute(['titre' => $titre, 'contenu' => $contenu]);
    } catch (Exception $r) {
    }
}
header("Location: index.php");
