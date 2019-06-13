<?php
session_start();
$title = "Voyage GoAbroad | Connexion";
$nav = "login";
include 'includes/header.php';
require_once 'google.php';

$loginUrl = $gClient->createAuthUrl();
$erreur = null;

if (isset($_SESSION['prenom'])) {
    header("Location: index.php");
    exit();
}

if (isset($_POST['btnLogin'])) {
    //Logique pour voir si l'utilisateur existe dans la BD
    $courriel = $_POST['courrielConnexion'];
    $password = $_POST['mdpConnexion'];
    $q = "SELECT * FROM utilisateur WHERE courriel = ?";
    //$q = "SELECT idUtilisateur, prenom, role FROM utilisateur WHERE courriel = ?";
    $stmt = $conn->prepare($q);
    $stmt->execute([$courriel]);
    $user = $stmt->fetch();
    var_dump($user);
    //$hash = $conn->quote($user->password);
    $hash = $user->password;
    // $_SESSION['debug'] = 'hash: '. $hash. '</br>$password: '.$password;

    if ($user) {
        if (password_verify($password, $hash)) {
            $_SESSION = [];
            $_SESSION['idUtilisateur'] = $user->idUtilisateur;
            $_SESSION['nom'] = $user->nom;
            $_SESSION['prenom'] = $user->prenom;
            $_SESSION['courriel'] = $user->courriel;
            $_SESSION['sexe'] = $user->sexe;
            $_SESSION['adresse'] = $user->adresse;
            $_SESSION['ville'] = $user->ville;
            $_SESSION['codepostal'] = $user->codePostal;
            $_SESSION['pays'] = $user->pays;
            $_SESSION['role'] = $user->role;
            //echo $_SESSION['role'];
            if ($_SESSION['role'] == 'Membre') {
                header('Location: index.php');
                exit();
            } else {
                header('Location: admin/index.php');
                exit();
            }
        } else {
            $erreur = 'Mot de passe invalide!';
        }
    } else {
        $erreur = "Courriel et/ou mot de passe invalide!";
    }
}

?>

<!-- Mettre les styles dans le fichier css -->
<div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel" data-pause="false">
    <div class="carousel-inner" style="height: 100%;">
        <div class="carousel-item active" data-interval="5000" style="height: 100%;">
            <img src="assets/images/island.jpg" class="w-100" alt="La plage" style="height: 100%;">
        </div>
        <div class="carousel-item" data-interval="5000" style="height: 100%;">
            <img src="assets/images/mountain.jpg" class="w-100" alt="..." style="height: 100%;">
        </div>
        <div class="carousel-item" data-interval="5000" style="height: 100%;">
            <img src="assets/images/village.jpg" class="w-100" alt="..." style="height: 100%;">
        </div>
    </div>
</div>
<div class="box">
    <h2>Connectez-vous à votre compte</h2>
    <?php
    if ($erreur) {
        echo "<div id='msg3' class='alert alert-danger mb-4' role='alert'>$erreur</div>";
    }
    ?>
    <form id="formConnecter" action="" method="post">
        <div class="inputBox">
            <input type="email" name="courrielConnexion" id="courrielConnexion" required>
            <label for="courrielConnexion">Courriel</label>
        </div>
        <div class="inputBox">
            <input type="password" name="mdpConnexion" id="mdpConnexion" required>
            <label for="mdpConnexion">Mot de passe</label>
        </div>
        <input type="submit" name="btnLogin" value="Se connecter">
    </form>
    <hr class="style-one">
    <div style="color:#fff" class="or">OU</div>
    <a href="<?php echo $loginUrl; ?>">
        <button class="btn btn-lg btn-google btn-block text-uppercase"><i class="fab fa-google mr-2"></i> Connecter avec Google</button>
    </a>
    <p>Vous n'avez pas de compte?<a href="register.php"> S'enregistrer</a></p>
</div>

<script>
    var msg3 = document.getElementById('msg3');
    if (msg3 != null) {
        setTimeout(function() {
            msg3.style.display = 'none'
        }, 5000);
    }
</script>


<?php include 'includes/footer.php' ?>