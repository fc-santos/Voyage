<?php
include "controlleur/connexionDB.php";
if (!session_id()) {
    @session_start();
}

include "includes/header.php";
include "includes/navbar.php";

//unset($_SESSION['correctNomCircuit']);
//unset($_SESSION['correctEtape']);

?>

<!-- Begin Page Content -->
<div class="container-fluid">
  <!-- Page Heading -->
  <div id="wrapper">
    <div id="page-wrapper" class="col-12">
      <ul class="nav nav-tabs">
          <li class="nav-item">
            <a href="#nomcircuit" id="li-nomcircuit" class="nav-link active" role="tab" data-toggle="tab">Nom circuit</a>
          </li>
          <li class="nav-item">
            <a href="#etapes" id="li-etapes" class="nav-link" role="tab" data-toggle="tab">Etapes</a>
          </li>
          <li class="nav-item">
            <a href="#jours" id="li-jours" class="nav-link" role="tab" data-toggle="tab">Jours</a>
          </li>
          <li class="nav-item">
            <a href="#promotion" id="li-promotion" class="nav-link" role="tab" data-toggle="tab">Promotion</a>
          </li>
      </ul>

      <div class="tab-content mt-3">
        <div role="tabpanel" class="tab-pane active" id="nomcircuit">
          <?php include 'includes/nomcircuit.php';?>
        </div>
        <div role="tabpanel" class="tab-pane" id="etapes">
          <?php include 'includes/etapes.php';?>
        </div>
        <div role="tabpanel" class="tab-pane" id="jours">
          <?php include 'includes/jours.php';?>
        </div>
        <div role="tabpanel" class="tab-pane" id="promotion">
          <?php //include 'includes/promotion.php';?>
        </div>
      </div>
    </div>
  </div>

  <script>
    
      var elementEtapes = document.getElementById("etapes");
      var elementNomCircuit = document.getElementById("nomcircuit");
      var elementJours = document.getElementById("jours");
      var elementPromotion = document.getElementById("promotion");
      var elementLiEtapes = document.getElementById("li-etapes");
      var elementLiNomCircuit = document.getElementById("li-nomcircuit");
      var elementLiJours = document.getElementById("li-jours");
      var elementLiPromotion = document.getElementById("li-promotion");
  </script>

<?php if (isset($_SESSION['correctNomCircuit'])) : ?>
  <script>
    function activerEtapesTab() {      
      elementEtapes.classList.add("active");
      elementLiEtapes.classList.add("active");

      elementNomCircuit.classList.remove("active");
      elementJours.classList.remove("active");
      elementPromotion.classList.remove("active");
      elementLiNomCircuit.classList.remove("active");
      elementLiJours.classList.remove("active");
      elementLiPromotion.classList.remove("active");
    }

    activerEtapesTab();
  </script>
  <?php unset($_SESSION['correctNomCircuit']); ?>
<?php endif ?>

<?php if (isset($_SESSION['correctEtape'])) : ?>
  <script>
      function myFunction2() {       
        
        elementJours.classList.add("active");
        elementLiJours.classList.add("active");

        elementEtapes.classList.remove("active");
        elementNomCircuit.classList.remove("active");
        elementPromotion.classList.remove("active");
        elementLiEtapes.classList.remove("active");       
        elementLiNomCircuit.classList.remove("active");      
        elementLiPromotion.classList.remove("active");
      }

      myFunction2();
  </script>

<?php unset($_SESSION['correctEtape']); ?>


<?php endif ?>

<?php
include('includes/scripts.php');
include('includes/footer.php');
?>