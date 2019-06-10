<?php
session_start();

$title = "S'enregistrer";
$nav = "register";
include 'includes/header.php';
include 'google.php';

$loginUrl = $gClient->createAuthUrl();

if (isset($_SESSION['prenom'])) {
    header("Location: index.php");
    exit();
}

$erreur = null;
$success = null;

if (isset($_POST['btnCreer'])) {
    $prenom = $_POST['prenom'];
    $nom = $_POST['nom'];
    $courriel = $_POST['courriel'];
    $password = $_POST['mdp'];
    $hash = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $conn->prepare('SELECT prenom, nom, courriel FROM utilisateur WHERE courriel = ?');
    $stmt->execute([$courriel]);
    $user = $stmt->fetch();
    if ($user) {
        $erreur = "Un compte avec ce courriel existe déjà. Veuillez spécifier un autre.";
    } else {
        $stm = $conn->prepare('INSERT INTO utilisateur (prenom, nom, courriel, password) VALUES (?,?,?,?)');
        $result = $stm->execute([$prenom, $nom, $courriel, $hash]);
        if ($result) {
            $success = "Compte créé avec succès! Vous pouvez vous connecter maintenant.";
        } else {
            $erreur = "ERREUR!";
        }
    }
}

?>

<div style="height:100vh; width:100%">
    <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel" data-pause="false">
        <div class="carousel-inner" style="height: 100%">
            <div class="carousel-item active" data-interval="5000" style="height: 100%">
                <img src="assets/images/island.jpg" class="w-100" alt="La plage" style="height: 100%">
            </div>
            <div class="carousel-item" data-interval="5000" style="height: 100%">
                <img src="assets/images/mountain.jpg" class="w-100" alt="..." style="height: 100%;">
            </div>
            <div class="carousel-item" data-interval="5000" style="height: 100%">
                <img src="assets/images/village.jpg" class="w-100" alt="..." style="height: 100%">
            </div>
        </div>
    </div>
    <div class="box">
        <div class="row">
            <?php if (isset($erreur)) : ?>
                <?php echo "<div class='col-md-12'><div id='msg1' class='alert alert-danger mb-4' role='alert'>$erreur</div></div>"; ?>
            <?php endif; ?>
            <?php if (isset($success)) : ?>
                <?php echo "<div class='col-md-12'><div id='msg2' class='alert alert-success mb-4' role='alert'>$success</div></div>"; ?>
            <?php endif; ?>
            <div class="col-md-6">
                <h2>Créez un compte</h2>
                <form id="formEnregistrer" action="" method="post">
                    <div class="inputBox">
                        <input type="text" name="prenom" id="prenom" required>
                        <label for="prenom">Prénom </label>
                    </div>
                    <div class="inputBox">
                        <input type="text" name="nom" id="nom" required>
                        <label for="nom">Nom </label>
                    </div>
                    <div class="inputBox">
                        <input type="email" name="courriel" id="courriel" required>
                        <label for="courriel">Courriel</label>
                    </div>
                    <div class="inputBox">
                        <input type="password" name="mdp" id="mdp" required>
                        <label for="mdp">Mot de passe </label>
                    </div>
                    <div class="inputBox">
                        <input type="password" name="cmdp" id="cmdp" required>
                        <label for="cmdp">Confirmation mot de passe </label>
                    </div>
                    <input class="btn-block" type="submit" name="btnCreer" value="Créer">
                </form>
            </div>
            <div class="col-md-6 d-flex flex-column align-items-center justify-content-center">
                <h2>Connectez-vous avec les médias sociaux</h2>
                <a href="<?php echo $loginUrl; ?>">
                    <button class="btn btn-google btn-block"><i class="fab fa-google mr-2"></i> Continuez avec Google</button>
                </a>
                <p class="ml-3">Avez-vous déjà un compte? <a href="login.php">Connectez-vous</a></p>
            </div>
        </div>

    </div>

    <script>
        var msg1 = document.getElementById('msg1');
        var msg2 = document.getElementById('msg2');
        if (msg1 != null) {
            setTimeout(function() {
                msg1.style.display = 'none'
            }, 5000);
        }
        if (msg2 != null) {
            setTimeout(function() {
                msg2.style.display = 'none'
            }, 5000);
        }
    </script>

    <?php require 'includes/footer.php' ?>