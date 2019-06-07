<?php
include_once 'includes/header.php';
include_once 'includes/navbar.php';
?>

<!-- Begin Page Content -->
<div class="container-fluid minimumHeight">
  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="mb-0 text-gray-800">Dashboard</h1>
  </div>
  <!-- Content Row -->
  <div class="row">
    <h3 class="mb-5">Choisissez une action: </h3>
    <div class="col-sm-12">
      <a href="gererCircuit.php" class="btn btn-primary">Liste de Circuits</a>
      <a href="creerCircuit.php" class="btn btn-primary">Créer un Circuit</a>
      <a href="creerNewsletter.php" class="btn btn-primary">Créer un Message</a>
      <a href="creerDepart.php" class="btn btn-primary">Créer un Départ</a>

    </div>
    

    
  </div>

  <!-- Content Row -->


<?php
include_once 'includes/scripts.php';
include_once 'includes/footer.php';
?>