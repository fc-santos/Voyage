<?php
ob_start();
include_once "controlleur/connexionDB.php";
if (!session_id()) {
    @session_start();
}

include_once "includes/header.php";
include_once "includes/navbar.php";

if (isset($_POST['creer'])) {
    if ($_POST['password'] != $_POST['confirmPassword']) {
        $_SESSION['erreur'] = "Les passwords ne sont pas égals";
    } else {
        $prenom = $_POST['prenom'];
        $nom = $_POST['nom'];
        $courriel = $_POST['courriel'];
        $password = $_POST['password'];
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $conn->prepare('SELECT prenom, nom, courriel FROM utilisateur WHERE courriel = ?');
        $stmt->execute([$courriel]);
        $user = $stmt->fetch();
        if ($user) {
            $_SESSION['erreur'] = "Un compte avec ce courriel existe déjà. Veuillez spécifier un autre.";
        } else {
            $stm = $conn->prepare('INSERT INTO utilisateur (prenom, nom, courriel, password, role) VALUES (?,?,?,?,"Admin")');
            $result = $stm->execute([$prenom, $nom, $courriel, $hash]);
            if ($result) {
                $_SESSION['success'] = "Compte créé avec succès! Vous pouvez vous connecter maintenant.";
            } else {
                $_SESSION['erreur'] = "ERREUR!";
            }
        }
    }
}
?>
<div class="container">
<?php
    if (isset($_SESSION['erreur'])) {
        echo '<div class="alert alert-danger" role="alert">' . $_SESSION['erreur'] . '</div>';
        unset($_SESSION['erreur']);
    }
    if (isset($_SESSION['success'])) {
        echo '<div class="alert alert-success" role="alert">' . $_SESSION['success'] . '</div>';
        unset($_SESSION['success']);
    }
?>
<h4 class="mb-4">Choisissez l'une des options</h4>
    <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="useMembres" checked>
        <label class="form-check-label" for="inlineRadio1">À partir des membres</label>
    </div>
    <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="creerNouveau">
        <label class="form-check-label" for="inlineRadio2">Créer à nouveau</label>
    </div>
</div>

<div class="Container invisible" id="creerAdminANouveau">
    <form class="mt-3" action="creerAdmin.php" method="POST">
        <div id="detailsDepart" class="border mb-3">
            <div class="container pt-3 pb-3">
                <div class="col-sm-12 col-md-6 mb-2">
                    <div class="form-group">
                        <label for="nom">Nom</label>
                        <input type="text" class="form-control" id="nom" autocomplete="off" aria-describedby="textHelp" name="nom" placeholder="Entrez le nom" required value="<?php if (isset($_POST['nom'])) {
    echo $_POST['nom'];
} else {
    echo null;
} ?>">                        
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 mb-2">
                    <div class="form-group">
                        <label for="prenom">Prénom</label>
                        <input type="text" class="form-control" id="prenom" autocomplete="off" aria-describedby="textHelp" name="prenom" placeholder="Entrez le prénom" required value="<?php if (isset($_POST['prenom'])) {
    echo $_POST['prenom'];
} else {
    echo null;
} ?>">                       
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 mb-2">
                    <div class="form-group">
                        <label for="courriel">Courriel</label>
                        <input type="Email" class="form-control" id="courriel" autocomplete="off" aria-describedby="textHelp" name="courriel" placeholder="Entrez une adresse courriel" required value="<?php if (isset($_POST['courriel'])) {
    echo $_POST['courriel'];
} else {
    echo null;
} ?>">                       
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 mb-2">
                    <div class="form-group">
                        <label for="password">Mot de passe</label>
                        <input type="password" class="form-control" id="password" autocomplete="off" aria-describedby="textHelp" name="password" placeholder="Entrez un password" required>                       
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 mb-2">
                    <div class="form-group">
                        <label for="confirmPassword">Répeter mot de passe</label>
                        <input type="password" class="form-control" id="confirmPassword" autocomplete="off" aria-describedby="textHelp" name="confirmPassword" placeholder="Entrez un password" required>          
                    </div>
                </div>                
                <input type="submit" name="creer" class="btn btn-primary" value="Créer un administrateur">
            </div>
        </div>
    </form>
</div>

<div class="Container" id="creerAdminFromMembres">
    <?php
    include_once "includes/membres.php";
    ?>
</div>

<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>

<?php
  include_once "includes/scripts.php";
  include_once "includes/footer.php";
  ob_end_flush();
?>