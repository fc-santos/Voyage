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
$prenom = $userData['givenName'];
$nom = $userData['familyName'];
//$_SESSION['picture'] = $userData['picture'];

$query = "SELECT idUtilisateur, prenom, role FROM utilisateur WHERE courriel = ?";
$stmt = $conn->prepare($query);
$stmt->execute([$email]);
$user = $stmt->fetch();
if ($user) {
    $_SESSION['idUtilisateur'] = $user->idUtilisateur;
    $_SESSION['prenom'] = $user->prenom;
    //$_SESSION['nom'] = $user->nom;
    //$_SESSION['courriel'] = $user->courriel;
    $_SESSION['role'] = $user->role;
} else {
    $stmt1 = $conn->prepare('INSERT INTO utilisateur (prenom, nom, courriel) VALUES (?, ?, ?)');
    $stmt1->execute([$prenom, $nom, $email]);
    $stmt2 = $conn->prepare('SELECT idUtilisateur FROM utilisateur WHERE courriel = ?');
    $stmt2->execute([$email]);
    $lastUser = $stmt2->fetch();
    $_SESSION['idUtilisateur'] = $lastUser->idUtilisateur;
    $_SESSION['prenom'] = $prenom;
    $_SESSION['role'] = 'Membre';
}

header('Location: index.php');
exit();
