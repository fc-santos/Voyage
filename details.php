<?php
session_start();
$title = "Voyage GoAbroad | Détails";
include 'includes/header.php';
require './controlleur/connexionDB.php';

if (isset($_GET['depart'])) {
    $idDepart = (int)$_GET['depart'];

    $stmt = $conn->prepare('SELECT c.titre, c.description, d.idDepart, d.prix, d.dateDebut, l.ville, a.nom FROM depart as d INNER JOIN circuit as c ON d.idCircuit=c.idCircuit INNER JOIN etape as e ON c.idCircuit=e.idCircuit INNER JOIN jour as j ON e.idEtape=j.idEtape INNER JOIN activite as a ON j.idActivite=a.idActivite 
    INNER JOIN lieu as l ON a.idLieu=l.idLieu WHERE d.idDepart=?');

    $stmt->execute([$idDepart]);
    $circuitActivite = $stmt->fetchAll();


    $stmt2 = $conn->prepare('SELECT j.idJour, h.nom FROM depart as d INNER JOIN circuit as c ON d.idCircuit=c.idCircuit INNER JOIN etape as e ON c.idCircuit=e.idCircuit INNER JOIN jour as j ON e.idEtape=j.idEtape INNER JOIN hebergement as h ON j.idHebergement=h.idHebergement 
    INNER JOIN lieu as l ON h.idLieu=l.idLieu WHERE d.idDepart=?');
    $stmt2->execute([$idDepart]);
    $circuitHebergement = $stmt2->fetchAll();

    $stmt3 = $conn->prepare('SELECT m.nom, m.siteweb FROM depart as d INNER JOIN circuit as c ON d.idCircuit=c.idCircuit INNER JOIN etape as e ON c.idCircuit=e.idCircuit INNER JOIN jour as j ON e.idEtape=j.idEtape INNER JOIN manger as m ON j.idDinner=m.idManger 
    INNER JOIN lieu as l ON m.idLieu=l.idLieu WHERE d.idDepart=?');
    $stmt3->execute([$idDepart]);
    $circuitDinner = $stmt3->fetchAll();

    /*echo '<pre>';
    var_dump($circuitDinner);
    echo '</pre>';*/

    $stmt3 = $conn->prepare('SELECT m.nom, m.siteweb FROM depart as d INNER JOIN circuit as c ON d.idCircuit=c.idCircuit INNER JOIN etape as e ON c.idCircuit=e.idCircuit INNER JOIN jour as j ON e.idEtape=j.idEtape INNER JOIN manger as m ON j.idSouper=m.idManger 
    INNER JOIN lieu as l ON m.idLieu=l.idLieu WHERE d.idDepart=?');
    $stmt3->execute([$idDepart]);
    $circuitSouper = $stmt3->fetchAll();




}

$compteur = 0;
$i = 0;

?>

<div class="container-fluid mb-4">
    <div class="bg-circuit">
        <div class="circuit-caption">
            <h1><?= $circuitActivite[0]->titre ?></h1>
        </div>
        <img src="assets/images/village.jpg" class="img-fluid" alt="Image du Circuit">
    </div>
    <div class="mt-4">
        <div class="row">
            <div class="col-lg-8">
                <h3 class="circuit-description">Description du Circuit</h3>
                <hr>
                <p class="text-justify"><?= $circuitActivite[0]->description ?></p>
                <hr>
                <div class="mt-4">
                    <h3 class="circuit-details mb-4">Détails du Circuit</h3>
                    <div id="accordion" role="tablist">
                        <?php foreach ($circuitActivite as $result) : ?>
                            <?php $compteur = $compteur + 1; ?>
                            <div class="jour mb-3">
                                <div class="" role="tab" id="heading<?= $compteur ?>">
                                    <h5 class="mb-0">
                                        <a role="button" class="collapsed text-uppercase" data-parent="#accordion" data-toggle="collapse" href="#collapse<?= $compteur ?>" aria-expanded="false" aria-controls="collapse<?= $compteur ?>">
                                            Jour <?= $compteur ?>: <?= $result->ville ? $result->ville : '<strong>Aucun lieu</strong>' ?><i class="fas fa-angle-down float-right"></i>
                                        </a>
                                    </h5>
                                </div>
                                <div id="collapse<?= $compteur ?>" class="collapse" role="tabpanel" aria-labelledby="heading<?= $compteur ?>">
                                    <div class="card-body">
                                      
                                        <p class="text-muted">Activité : <?= $result->nom ? $result->nom : 'Aucune activité pour cette journée prévue' ?></p>
                                        <p class="text-muted">Hébergement : <?= $circuitHebergement[$i]->nom ? $circuitHebergement[$i]->nom : 'Aucun hébergement prévu pour cette journée' ?></p>
                                        <p class="text-muted">Dinner : <?= $circuitDinner[$i]->nom ? $circuitDinner[$i]->nom : 'Aucun place prévue pour le dînner' ?> | <?= $circuitDinner[$i]->siteweb ?  '<a href="'.$circuitDinner[$i]->siteweb . '" target="_blank">Lien vers le site</a>' : '<strong>aucun lien</strong>'?></p>
                                        <p class="text-muted">Souper : <?= $circuitSouper[$i]->nom ? $circuitSouper[$i]->nom : 'Aucun place prévue pour le souper' ?> | <?= $circuitSouper[$i]->siteweb ?  '<a href="'.$circuitSouper[$i]->siteweb . '" target="_blank">Lien vers le site</a>' : '<strong>aucun lien</strong>'?></p>

                                    </div>
                                </div>
                            </div>
                            <?php $i = $i + 1; ?>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card mb-5 mb-lg-0 right-side">
                    <div class="card-body">
                        <h5 class="card-title text-muted text-uppercase text-center">Réserver Maintenant</h5>
                        <h6 class="prix-reservation h1 text-center">$ <?= $circuitActivite[0]->prix ?></h6>
                        <hr>
                        <ul class="fa-ul">
                            <li><span class="fa-li"><i class="fas fa-money-bill"></i></span>Depôt de $500 par pers.</li>
                            <li><span class="fa-li"><i class="far fa-calendar-alt"></i></span><?php echo $circuitActivite[0]->dateDebut . ' / Nombre de jours: ' . $compteur ?></li>
                        </ul>
                        <form action="">
                            <div class="form-group">
                                <label for="nbAdultes">Nombre d'adultes</label>
                                <input type="number" min="1" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="nbEnfants">Nombre d'enfants</label>
                                <input type="number" min="1" class="form-control">
                            </div>
                            <button type="submit" class="btn btn-warning text-uppercase btn-block-lg"><i class="fab fa-paypal fa-lg"></i> Payer dépôt</button>
                        </form>
                        <hr>
                        <a href="#" class="btn btn-success btn-block-lg text-white text-uppercase" id="<?= $circuitActivite[0]->idDepart ?>" onclick='ajouterAuPanier(<?= $circuit[0]->idDepart ?>, 1 , 0); event.preventDefault();'>Ajouter au panier</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>