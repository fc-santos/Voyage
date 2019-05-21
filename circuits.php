<?php
if (!session_id()) {
    @session_start();
}

$title = "Voyage GoAbroad | Circuits";
$nav = "circuits";
include 'includes/header.php';

?>
<header class="header_circuit">
    <div class="header_shadow">
        <div class="">
            <div class="hero_two header_title text-white shadow p-3 mb-5 rounded bg-gradient-dark">
                <p>Découvrez Nos</p>
                <p>Circuits</p>
            </div>
        </div>
    </div>
</header>

<div class="container mt-4">
    <div class="row">
        <div class="col-lg-3">
            <div class="box-search">
                <h2 class="form-title">Trouver des forfaits</h2>
                <hr>
                <div class="searchengine">
                    <form id="search_form" action="">
                        <div class="form-group">
                            <label for="lieu">Destination</label>
                            <select class="form-control" id="lieu">
                                <option>Ocean Atlantique</option>
                                <option>Caraibes</option>
                                <option>Bahamas</option>
                                <option>Rome</option>
                            </select>
                        </div>
                        <hr>
                        <div class="form-group">
                            <label for="moisDepart">Départ</label>
                            <select class="form-control" id="moisDepart">
                                <option>Juin 2019</option>
                                <option>Août 2019</option>
                                <option>Octobre 2019</option>
                            </select>
                        </div>
                        <hr>
                        <div class="form-group">
                            <label for="nbJours">Durée</label>
                            <select class="form-control" id="nbJours">
                                <option>7 jours</option>
                                <option>15 jours</option>
                                <option>21 jours</option>
                            </select>
                        </div>
                        <hr>
                        <button type="submit" class="btn btn-nav btn-block" onclick="searchCircuits();"><i class="fas fa-search"></i> Rechercher</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-9">
            <div class="row" id="cards-circuits1">
                <!--3 Circuits here-->

            </div>
            <div class="row" id="cards-circuits2">
                <!--3 Circuits here-->
            </div>
        </div>
    </div>
</div>


<?php include 'includes/footer.php'; ?>