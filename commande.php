<?php
if (!session_id()) {
    @session_start();
}
$title = "Voyage GoAbroad | Commandes";
$nav = "commandes";
include 'includes/header.php';
$idUtilisateur = isset($_SESSION['idUtilisateur']) ? $_SESSION['idUtilisateur'] : 2;
?>


<header class="header_circuit">
    <div class="header_shadow">
        <div class="">
            <div class="hero_two header_title text-white shadow p-3 mb-5 rounded bg-gradient-dark">
                <p>Vos commandes</p>
                <p>(En construction)</p>
            </div>
        </div>
    </div>
</header>



<?php include 'includes/footer.php'; ?>