<?php

require_once 'controlleur/connexionDB.php';

require_once 'google.php';

if (isset($_SESSION['access_token'])) {
    $gClient->setAccessToken($_SESSION['access_token']);
} elseif (isset($_GET['code'])) {
    $token = $gClient->fetchAccessTokenWithAuthCode($_GET['code']);
    $_SESSION['access_token'] = $token;
} else {
    header('Location: login.php');
    exit();
}

$oAuth = new Google_Service_Oauth2($gClient);
$userData = $oAuth->userinfo_v2_me->get();

$email = $userData['email'];
$prenom = $userData['familyName'];
$nom = $userData['givenName'];
$password = "1234";

header("location: index.php");
//$_SESSION['picture'] = $userData['picture'];

/*$stmt = $conn->prepare('SELECT prenom, nom, courriel, role FROM utilisateur WHERE courriel = ?');
$stmt->execute([$email]);
$user = $stmt->fetch();*/

$query = "SELECT prenom, nom, courriel, role FROM utilisateur WHERE courriel = :email";
$stmt1 = $conn->prepare($query);
$stmt1->execute(['courriel' => $email]);

if ($stmt1->rowCount() == 0) {
    $query1 = "INSERT INTO `utilisateur`(`prenom`, `nom`, `courriel`, `password`, `sexe`, `adresse`, `ville`, `codePostal`, `pays`, `role`) VALUES (:prenom, :nom, :courriel, '$password', null, null, null, null, null, 'Membre')";
    $stmt2 = $conn->prepare($query1);
    $stmt2->execute(['prenom' => $prenom, 'nom' => $nom, 'courriel' => $email]);
    $_SESSION['prenom'] = $prenom;
    $_SESSION['nom'] = $nom;
    $_SESSION['courriel'] = $courriel;
    $_SESSION['role'] = 'Membre';
} else {
    $_SESSION['prenom'] = $user->prenom;
    $_SESSION['nom'] = $user->nom;
    $_SESSION['courriel'] = $user->courriel;
    $_SESSION['role'] = $user->role;
}

/*
if ($user) {
    $_SESSION['prenom'] = $user->prenom;
    $_SESSION['nom'] = $user->nom;
    $_SESSION['courriel'] = $user->courriel;
    $_SESSION['role'] = $user->role;
} else {
    $stmt = $conn->prepare('INSERT INTO utilisateur (prenom, nom, courriel) VALUES (?, ?, ?)');
    $stmt->execute([$prenom, $nom, $email]);
    $count = $stmt->rowCount();
    $_SESSION['prenom'] = $prenom;
    $_SESSION['nom'] = $nom;
    $_SESSION['courriel'] = $courriel;
    $_SESSION['role'] = 'Membre';
}*/

header('Location: index.php');
exit();

//header('Location: index.php');
//exit();


/*echo "<pre>";
var_dump($userData);
echo "</pre>";*/
