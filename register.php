<?php
$title = "S'enregistrer";
$nav = "register";
include 'includes/header.php';
include 'face.php';
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
            <div class="col-md-6">
                <h2>Créez un compte</h2>
                <form action="">
                    <div class="inputBox">
                        <input type="text" name="nom" id="nom" required>
                        <label for="nom">Nom d'utilisateur</label>
                    </div>
                    <div class="inputBox">
                        <input type="email" name="courriel" id="courriel" required>
                        <label for="courriel">Courriel</label>
                    </div>
                    <div class="inputBox">
                        <input type="password" name="mdp" id="mdp" required>
                        <label for="mdp">Mot de passe</label>
                    </div>
                    <div class="inputBox">
                        <input type="password" name="cmdp" id="cmdp" required>
                        <label for="cmdp">Confirmation mot de passe</label>
                    </div>
                    <input class="btn-block" type="submit" name="btnCreer" value="Créer">
                </form>
            </div>
            <div class="col-md-6 d-flex flex-column align-items-center justify-content-center">
                <h2>Connectez-vous avec les médias sociaux</h2>
                <a href="<?php echo $loginUrl; ?>">
                    <button class="btn btn-facebook btn-block"><i class="fab fa-facebook-f"></i> Continuez avec Facebook</button>
                </a>
                <p class="ml-3">Avez-vous déjà un compte? <a href="login.php">Connectez-vous</a></p>
            </div>
        </div>

    </div>

    <?php require 'includes/footer.php' ?>