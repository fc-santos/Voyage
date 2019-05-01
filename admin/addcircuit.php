<?php
    include "../controlleur/connexionDB.php";
    session_start();
?>

<?php include "includes/admin_header.php" ?>

<div id="wrapper">
    <!-- Navigation -->
    <?php include "includes/admin_navigation.php" ?>
    <div id="page-wrapper">
        <h2><?php if (isset($_SESSION['actionPage'])) {
    echo $_SESSION['actionPage'];
} else {
    echo 'Créer circuit';
} ?></h2>
        <ul class="nav nav-tabs">
            <li class="nav-item active" id="li-nomcircuit">
                <a href="#nomcircuit" class="nav-link" role="tab" data-toggle="tab">Nom circuit</a>
            </li>
            <li class="nav-item" id="li-etapes">
                <a href="#etapes" class="nav-link" role="tab" data-toggle="tab">Etapes</a>
            </li>
            <li class="nav-item" id="li-promotion">
                <a href="#promotion" class="nav-link" role="tab" data-toggle="tab">Promotion</a>
            </li>
        </ul>

        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="nomcircuit">
                <?php include 'includes/nomcircuit.php'; ?>
            </div>
            <div role="tabpanel" class="tab-pane" id="etapes">
                <?php include 'includes/etapes.php'; ?>
            </div>
            <div role="tabpanel" class="tab-pane" id="promotion">
                <?php include 'includes/promotion.php'; ?>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</div>

<?php if ($correctNomCircuit) : ?>
    <script>

        function myFunction() {
        var elementEtapes = document.getElementById("etapes");
        var elementNomCircuit = document.getElementById("nomcircuit");
        //var elementPromotion = document.getElementById("promotion");
        var elementLiEtapes = document.getElementById("li-etapes");
        var elementLiNomCircuit = document.getElementById("li-nomcircuit");
        //var elementLiPromotion = document.getElementById("li-promotion");
        
        elementEtapes.classList.add("active");
        elementLiEtapes.classList.add("active");
 
        elementNomCircuit.classList.remove("active");
        elementLiNomCircuit.classList.remove("active");
        }

        myFunction();
    </script>
<?php endif ?>
<!-- /#page-wrapper -->
<?php include "includes/admin_footer.php" ?>