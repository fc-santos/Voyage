<?php
$title = "Voyage GoAbroad | Connexion";
$nav = "login";
include 'includes/header.php' ?>

<!-- Mettre les styles dans le fichier css -->
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
    <div class="box">
        <h2>Connectez-vous à votre compte</h2>
        <form action="">
            <div class="inputBox">
                <input type="text" name="username" id="username" required>
                <label for="username">Nom d'utilisateur</label>
            </div>
            <div class="inputBox">
                <input type="password" name="password" id="password" required>
                <label for="password">Mot de passe</label>
            </div>
            <input type="submit" name="" value="Se connecter">
        </form>
        <p>Vous n'avez pas de compte?<a href="register.php"> S'enregistrer</a></p>
    </div>

    <?php include 'includes/footer.php' ?>