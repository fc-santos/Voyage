<?php
include_once "controlleur/connexionDB.php";
if (!session_id()) {
    @session_start();
}

include_once "includes/header.php";
include_once "includes/navbar.php";

if (isset($_GET['idMessage'])) {
    $query = "UPDATE `message` SET `messageLu`= 1 WHERE idMessage=" . $_GET['idMessage'];
    $stmt = $conn->query($query);

    $query1 = "SELECT * FROM message WHERE idMessage = " . $_GET['idMessage'];
    $stmt1 = $conn->query($query1);
    $result = $stmt1->fetch();

    $query2 = "SELECT * FROM utilisateur WHERE idUtilisateur=" . $result->idUtilisateur;
    $stmt2 = $conn->query($query2);
    $result2 = $stmt2->fetch();
}
    
?>

<div class="row">
    <div class="col-sm-5" id="dixMessages">

    </div>

    <div class="col-sm-6 mt-4 ml-3" id="montreMessage">
    <?php
        if (isset($result)) {
            echo  '
            <div>
                <span>Auteur: </span>' . $result2->prenom . " " . $result2->nom . '
            </div>
            <div class="small mb-2">
                <span>Date: </span>' . $result->date . '
            </div>
            <div class="mb-3">
                <span>Suject: </span>' . $result->titre . '
            </div>
            <div>Contenu:</div>
            <hr>
            <div style="background: white; border-radius: 10px;">            
                <div><p>' . $result->contenu . '</p></div>
            </div>
            ';
        } else {
            echo '<h2>Il n\'y a pas de message a monstrer</h2>';
        }
    ?>
    </div>
</div>





<?php
  include_once "includes/scripts.php";
  include_once "includes/footer.php";
?>
<script>
    getMessages(10);
    console.log();
</script>