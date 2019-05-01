<?php
session_start();
$title = "Voyage GoAbroad | Page d'accueil";
$nav = "index";
require 'includes/header.php' ?>

<!-- Mettre les styles dans le fichier css -->
<div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel" data-pause="false">
  <div class="carousel-inner" style="height: 100%">
    <div class="carousel-item active" data-interval="5000" style="height: 100%">
      <img src="assets/images/island.jpg" class="w-100" alt="La plage" style="height: 100%">
      <div class="my-carousel-caption d-none d-md-block">
        <h1>First slide label</h1>
        <h3>Nulla vitae elit libero, a pharetra augue mollis interdum.</h3>
      </div>
    </div>
    <div class="carousel-item" data-interval="5000" style="height: 100%">
      <img src="assets/images/mountain.jpg" class="w-100" alt="..." style="height: 100%;">
      <div class="my-carousel-caption d-none d-md-block">
        <h1>First slide label</h1>
        <h3>Nulla vitae elit libero, a pharetra augue mollis interdum.</h3>
      </div>
    </div>
    <div class="carousel-item" data-interval="5000" style="height: 100%">
      <img src="assets/images/village.jpg" class="w-100" alt="..." style="height: 100%">
      <div class="my-carousel-caption d-none d-md-block">
        <h1>First slide label</h1>
        <h3>Nulla vitae elit libero, a pharetra augue mollis interdum.</h3>
      </div>
    </div>
  </div>
  <div class="search-content">
    <div class="search">

    </div>
  </div>

</div>

<div class="container mt-4">
  <div class="row">
    <div class="col-md-12 mb-3">
      <h1 class="display-4">Circuits les plus populaires</h1>
    </div>
  </div>
  <div class="row">
    <div class="col-md-4">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Special title treatment</h5>
          <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
          <a href="#" class="btn btn-primary">Go somewhere</a>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Special title treatment</h5>
          <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
          <a href="#" class="btn btn-primary">Go somewhere</a>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Special title treatment</h5>
          <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
          <a href="#" class="btn btn-primary">Go somewhere</a>
        </div>
      </div>
    </div>
  </div>

  <?php include 'includes/footer.php' ?>