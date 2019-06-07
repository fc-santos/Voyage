<?php
require "./controlleur/connexionDB.php";

$query = "SELECT * FROM `newletter` WHERE dateDebut <= NOW() AND dateFin >= NOW()";
$stmt = $conn->query($query); ?>

<!doctype html>
<html lang="fr">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="css/filipe.css">

    <!-- Goggle Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700" rel="stylesheet">

    <!-- Fontawesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

    <title>
        <?php echo $title; ?>
    </title>
</head>

<body style="min-height: 700px;" onload="getCircuits(<?php if (isset($_SESSION['prenom'])) {
    echo "'authentifie'";
} else {
    echo "'nonAuthentifie'";
}  ?>)">
    <?php while ($row = $stmt->fetch()) : ?>
        <div class="row fermerNewsletters" style="min-height: 40px; border-botton: 1px solid black; background-color: red; color: white; display: none;" id="newsletter">
            <div class="col-sm-1" style="cursor: pointer;" onclick="fermer()">X</div>
            <div class="col-sm-11"><?= $row->contenu ?></div>
        </div>
    <?php endwhile ?>
    <nav class="navbar navbar-expand-lg navbar-light bg-blue">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php"><img src="assets/images/logo.png" style="width:100px;" alt=""></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item mr-4">
                        <a class="nav-link" onclick="ouvrirMessage()" href="#">Message aux clients</a>
                    </li>
                    <li class="nav-item mr-4 <?php if ($nav === 'circuits') : ?>active <?php endif; ?>">
                        <a class="nav-link" href="circuits.php">Circuits</a>
                    </li>
                    <li class="nav-item mr-4">
                        <a class="nav-link" data-toggle="modal" href="" data-target="#contact">
                            Contact
                        </a>
                    </li>
                    <!--
                    <li class="nav-item mr-4 <?php if ($nav === 'contact') : ?>active <?php endif; ?>">
                        <a class="nav-link" href="contact.php">Contact</a>
                    </li>-->
                    <li class="nav-item <?php if ($nav === 'about') : ?>active <?php endif; ?>">
                        <a class="nav-link" href="about.php">À propos</a>
                    </li>
                </ul>
                <?php if (!isset($_SESSION['prenom'])) : ?>
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item <?php if ($nav === 'login') : ?>active <?php endif; ?>">
                            <a class="nav-link" href="login.php">Connexion</a>
                        </li>
                        <li class="nav-item <?php if ($nav === 'register') : ?>active <?php endif; ?>">
                            <a class="nav-link" href="register.php">S'enregistrer</a>
                        </li>

                    </ul>
                <?php else : ?>
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item dropdown test">
                            <div class="nav-link dropdown-toggle" id="navbarDropdownMenuLink0" onclick="getPanier()" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-shopping-cart"></i>
                                <span id="panier"> (0) $ 0.00
                                </span>
                            </div>
                            <div id="cart" class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink0">
                                <div id="divPanier" class="test">
                                    <!--Insert Panier ici-->
                                </div>
                            </div>
                        </li>
                        <li class="nav-item dropdown mr-4">
                            <a class="nav-link" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Bonjour <?= $_SESSION['prenom']; ?> <i class="fas fa-caret-down"></i>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="#"><i class="fas fa-user-circle"></i> Mon profil</a>
                                <a class="dropdown-item" href="commande.php"><i class="fas fa-file-invoice-dollar"></i> Mes commandes</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="logout.php"><i class="fas fa-sign-out-alt"></i> Déconnecter</a>
                            </div>
                        </li>
                    </ul>
                <?php endif; ?>
            </div>
        </div>
    </nav>


    <!-- Modal -->
    <div class="modal fade" id="contact" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Contactez-nous</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="titreMessage">Sujet</label>
                            <input type="text" class="form-control" id="titreMessage">
                        </div>
                        <div class="form-group">
                            <label for="contenuMessage">Message</label>
                            <textarea class="form-control" id="contenuMessage" rows="3"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                    <button type="button" class="btn btn-primary">Envoyer</button>
                </div>
            </div>
        </div>
    </div>
