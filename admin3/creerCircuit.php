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
        <div role="tabpanel" class="tab-pane" id="promotion">
          <?php //include 'includes/promotion.php';?>
        </div>
      </div>
    </div>
  </div>

<?php if (isset($_SESSION['correctNomCircuit']) || isset($_SESSION['correctEtape'])) : ?>
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
  <?php unset($_SESSION['correctNomCircuit']);
        unset($_SESSION['correctEtape']);?>
<?php endif ?>

<?php
include('includes/scripts.php');
include('includes/footer.php');
?>