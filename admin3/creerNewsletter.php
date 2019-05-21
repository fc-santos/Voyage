<?php
ob_start();
include_once "controlleur/connexionDB.php";
if (!session_id()) {
    @session_start();
}

include_once "includes/header.php";
include_once "includes/navbar.php";

?>

<!-- Begin Page Content -->
<div class="container-fluid">
  <!-- Page Heading -->
  <div id="wrapper">
    <div id="page-wrapper" class="col-12">
      <div class="mt-3">
        <div class="" id="newsletter">
          <?php include 'includes/newsletter.php';?>
        </div>
      </div>
    </div>
  </div>

  
<?php
  include_once "includes/scripts.php";
  include_once "includes/footer.php";
  ob_end_flush();
?>