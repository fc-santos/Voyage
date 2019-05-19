<?php
$title = "Voyage GoAbroad | Connexion";
$nav = "login";
include 'includes/header.php';
require_once 'google.php';

$loginUrl = $gClient->createAuthUrl();
$erreur = null;
$courriel = '';

if (isset($_POST['btnLogin'])) {
    //Logique pour voir si l'utilisateur existe dans la BD
    $courriel = $_POST['courriel'];
    $password = $_POST['password'];
    $q = "SELECT idUtilisateur, prenom, role FROM utilisateur WHERE courriel = ? AND password = ?";
    $stmt = $conn->prepare($q);
    $stmt->execute([$courriel, $password]);
    $user = $stmt->fetch();
    if ($user) {
        $_SESSION['idUtilisateur'] = $user->idUtilisateur;
        $_SESSION['prenom'] = $user->prenom;
        $_SESSION['role'] = $user->role;
        if ($_SESSION['role'] == 'Membre') {
            header('Location: index.php');
            exit();
        } else {
            //Location page admin
            //exit();
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
        echo "<div class='alert alert-danger mb-4' role='alert'>$erreur</div>";
    }
    ?>
    <form action="" method="post">
        <div class="inputBox">
            <input type="email" name="courriel" id="courriel" value="<?= $courriel ?>" required>
            <label for="courriel">Courriel</label>
        </div>
        <div class="inputBox">
            <input type="password" name="password" id="password" required>
            <label for="password">Mot de passe</label>
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


<?php include 'includes/footer.php' ?>