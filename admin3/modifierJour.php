<?php
ob_start();
include_once "controlleur/connexionDB.php";
if (!session_id()) {
    @session_start();
}

include_once "includes/header.php";
include_once "includes/navbar.php";


if (isset($_GET['idJour'])) {
    $stmt = $conn->query("SELECT * FROM jour WHERE idJour=" . $_GET['idJour']);
    $row = $stmt->fetch();

    $idJour = $row->idJour;
    $idEtape = $row->idEtape;
    $idLieu = $row->idLieu;

    $getActivite = $conn->query('SELECT * FROM activite WHERE idActivite = ' . $row->idActivite);
    $activite = $getActivite->fetch();
    $nomActivite = $activite->nom;

    /*if (!isset($idLieu)) {
        $idLieu = $activite->idLieu;
    }*/

    $getHebergement = $conn->query('SELECT * FROM hebergement WHERE idHebergement = ' . $row->idHebergement);
    $hebergement = $getHebergement->fetch();
    $nomHebergement = $hebergement->nom;

    /*if (!isset($idLieu)) {
        $idLieu = $hebergement->idLieu;
    }*/

    $getDinner = $conn->query('SELECT * FROM manger WHERE idManger = ' . $row->idDinner);
    $dinner = $getDinner->fetch();
    $nomDinner = $dinner->nom;

    /*if (!isset($idLieu)) {
        $idLieu = $dinner->idLieu;
    }*/
    

    $getSouper = $conn->query('SELECT * FROM manger WHERE idManger = ' . $row->idSouper);
    $souper = $getSouper->fetch();
    $nomSouper = $souper->nom;

    /*if (!isset($idLieu)) {
        $idLieu = $souper->idLieu;
    }*/


    $getLieu = $conn->query('SELECT * FROM lieu WHERE idLieu = ' . $idLieu);
    $lieu = $getLieu->fetch();
    $nomLieu = trim(preg_replace('/\s\s+/', ' ', str_replace("\n", " ", $lieu->nom . ' ' . $lieu->ville . ' ' . $lieu->pays)));
}

if (isset($_POST['ModifierJour'])) {
    $idEtape = $_POST['idEtape'];
    $idJour = $_POST['idJour'];
    if (isset($_POST['lieu']) && $_POST['lieu'] != "") {
        if ($_POST['idLieuChoisi'] == "0" || $_POST['idLieuChoisi'] == "" || $_POST['idLieuChoisi'] == null) {
            $lieuAGarder = $_POST['lieu'];
            
            $typeLieu = $_POST['selectTypeLieu'];
            $idEtape = $_POST['idEtape'];
            $idJour = $_POST['idJour'];

            if ($typeLieu == "Ville") {
                $query1 = "INSERT INTO `lieu`(`nom`, `ville`, `pays`) VALUES (NULL,:lieuAGarder, NULL)";
            } elseif ($typeLieu == "Pays") {
                $query1 = "INSERT INTO `lieu`(`nom`, `ville`, `pays`) VALUES (NULL, NULL,:lieuAGarder)";
            } else {
                $query1 = "INSERT INTO `lieu`(`nom`, `ville`, `pays`) VALUES (:lieuAGarder, NULL, NULL)";
            }
            $stmt1 = $conn->prepare($query1);
            $stmt1->execute(['lieuAGarder'=>$lieuAGarder]);
            $idLieu = $conn->lastInsertId();
        } else {
            $idLieu = $_POST['idLieuChoisi'];
            $_SESSION['debug'] = $_POST['idLieuChoisi'] ;
        }
    } elseif ($_POST['lieu'] == "") {
        $idLieu = 1;
    }

    if (isset($_POST['hebergement'])) {
        if ($_POST['hebergement'] == "") {
            $idHebergement = 1;
        } else {
            $hebergement = $_POST['hebergement'];
            $query = "SELECT `idHebergement` FROM `hebergement` WHERE nom = :hebergement AND idLieu = :idLieu";
            $stmt1 = $conn->prepare($query);
            $stmt1->execute(['hebergement' => $hebergement, 'idLieu' => $idLieu]);

            if ($stmt1->rowCount() == 0) {
                $query4 = "INSERT INTO `hebergement`(`idLieu`, `nom`) VALUES (:idLieu, :hebergement)";
                $stmt2 = $conn->prepare($query4);
                $stmt2->execute(['hebergement' => $hebergement, 'idLieu' => $idLieu]);
                $idHebergement = $conn->lastInsertId();
            } else {
                $row = $stmt1->fetch();
                $idHebergement = $row->idHebergement;
            }
        }
    }
    if (isset($_POST['souper'])) {
        if ($_POST['souper'] == "") {
            $idSouper = 1;
        } else {
            $souper = $_POST['souper'];
            $query = "SELECT `idManger` FROM `manger` WHERE nom = :souper AND idLieu = :idLieu";
            $stmt1 = $conn->prepare($query);
            $stmt1->execute(['souper' => $souper, 'idLieu' => $idLieu]);

            if ($stmt1->rowCount() == 0) {
                $query4 = "INSERT INTO `manger`(`idLieu`, `nom`) VALUES (:idLieu, :souper)";
                $stmt2 = $conn->prepare($query4);
                $stmt2->execute(['souper' => $souper, 'idLieu' => $idLieu]);
                $idSouper = $conn->lastInsertId();
            } else {
                $row = $stmt1->fetch();
                $idSouper = $row->idManger;
            }
        }
    }
    if (isset($_POST['dinner'])) {
        if ($_POST['dinner'] == "") {
            $idDinner = 1;
        } else {
            $dinner = $_POST['dinner'];
            $query = "SELECT `idManger` FROM `manger` WHERE nom = :dinner AND idLieu = :idLieu";
            $stmt1 = $conn->prepare($query);
            $stmt1->execute(['dinner' => $dinner, 'idLieu' => $idLieu]);

            if ($stmt1->rowCount() == 0) {
                $query4 = "INSERT INTO `manger`(`idLieu`, `nom`) VALUES (:idLieu, :dinner)";
                $stmt2 = $conn->prepare($query4);
                $stmt2->execute(['dinner' => $dinner, 'idLieu' => $idLieu]);
                $idDinner = $conn->lastInsertId();
            } else {
                $row = $stmt1->fetch();
                $idDinner = $row->idManger;
            }
        }
    }

    if (isset($_POST['activites'])) {
        if ($_POST['activites'] == "") {
            $idActivites = 1;
        } else {
            $activites = $_POST['activites'];
            $query = "SELECT `idActivite` FROM `activite` WHERE nom = :activites AND idLieu = :idLieu";
            $stmt1 = $conn->prepare($query);
            $stmt1->execute(['activites' => $activites, 'idLieu' => $idLieu]);

            if ($stmt1->rowCount() == 0) {
                $query4 = "INSERT INTO `activite`(`idLieu`, `nom`) VALUES (:idLieu, :activites)";
                $stmt2 = $conn->prepare($query4);
                $stmt2->execute(['activites' => $activites, 'idLieu' => $idLieu]);
                $idActivites = $conn->lastInsertId();
            } else {
                $row = $stmt1->fetch();
                $idActivites = $row->idActivite;
            }
        }
    }

    //try {
    //$idEtape = $_SESSION['idEtape'];

    $sql4 = "UPDATE `jour` SET `idLieu` = $idLieu, `idEtape`= $idEtape,`idActivite`= $idActivites,`idHebergement`= $idHebergement,`idDinner`= $idDinner,`idSouper`= $idSouper WHERE idJour = $idJour";
    //$_SESSION['debug'] = $sql4;
    $stmt4 = $conn->prepare($sql4);
    $stmt4->execute();
    $_SESSION['success'] = 'Un jour a été modifié';
    //$_SESSION['correctEtape'] = true;
    //} catch (Exception $r) {
    // }
    //unset($_POST['ajouterPlusJours']);
    header("location: listerJours.php?idEtape=$idEtape");
}

/*if (isset($_POST['terminerJour'])) {
    unset($_SESSION['correctEtape']);
    $_SESSION['success'] = 'Un jour a été ajouté à l\'étape "' . $idEtape . '"';
    header("location: listerJours.php?idEtape=" . $_SESSION['idEtape']);
}*/
?>

<div class="container-fluid">
<h2>Modifier un jour</h2>

<form class="mt-3" action="modifierJour.php" method="POST">
<div id="detailsJours" class="border mb-3">
    <div class="container pt-3 pb-3">
        <h5>Jour</h5>
        <div class="row mb-2">
            <div class="col-sm-12 col-md-4 mb-2">
                <div class="form-group">
                    <label for="lieu">Lieu</label>
                    <input type="text" class="form-control lieu" id="lieu1" autocomplete="off" aria-describedby="textHelp" name="lieu" placeholder="Entrez un lieu" value="<?php if (isset($nomLieu)) {
    echo $nomLieu;
}
                    ?>">
                    <input type="hidden" id="idLieuChoisi" name="idLieuChoisi">
                    <div class="pl-2" id="livesearchLieu1" style="min-width: 140px;position: absolute; z-index: 20; background-color: white;"></div>
                </div>
            </div>
            <div class="form-group">
            <label for="selectTypeLieu">Select le type de lieu</label>
            <select class="form-control" name="selectTypeLieu" id="selectTypeLieu">
            <option selected>Lieu</option>
            <option>Ville</option>
            <option>Pays</option>
            
            </select>
            </div>
        </div> 
        <div class="row mb-2">
        <div class="col-sm-12 col-md-4 mb-2">
            <div class="form-group">
                <label for="hebergement">Hébergement</label>
                <input type="text" class="form-control  lieuHebergement" id="hebergement1" autocomplete="off" aria-describedby="textHelp" name="hebergement" placeholder="Entrez un hébergement" value="<?php if (isset($_POST['hebergement'])) {
                        echo htmlentities($_POST['hebergement']);
                    } elseif (isset($nomHebergement)) {
                        echo $nomHebergement;
                    }
?>">
                <div class="pl-2" id="livesearchhebergement1" style="min-width: 140px;position: absolute; z-index: 20; background-color: white;"></div>
            </div>
            </div>
            <div class="col-sm-12 col-md-4 mb-2">
                <div class="form-group">
                    <label for="dinner">Dîner</label>
                    <input type="text" class="form-control lieudinner" id="dinner1" autocomplete="off" aria-describedby="textHelp" name="dinner" placeholder="Entrez un lieu pour dîner"  value="<?php if (isset($_POST['dinner'])) {
    echo htmlentities($_POST['dinner']);
} elseif (isset($nomDinner)) {
    echo $nomDinner;
}
?>">
                    <div class="pl-2" id="livesearchdinner1" style="min-width: 140px;position: absolute; z-index: 20; background-color: white;"></div>           
                </div>
            </div>
            <div class="col-sm-12 col-md-4 mb-2">
                <div class="form-group">
                    <label for="souper">Souper</label>
                    <input type="text" class="form-control lieuSouper" id="souper1" autocomplete="off" aria-describedby="textHelp" name="souper" placeholder="Entrez un lieu pour souper" value="<?php if (isset($_POST['souper'])) {
    echo htmlentities($_POST['souper']);
} elseif (isset($nomSouper)) {
    echo $nomSouper;
}
?>">
                    <div class="pl-2" id="livesearchsouper1" style="min-width: 140px;position: absolute; z-index: 20; background-color: white;"></div>    
                    
                </div>
            </div>                                
        </div>
        <div class="row">
            <!--<div class="col-sm-12 col-md-4 mb-2">
                <div class="form-group">
                    <label for="typeHebergement">Type Hébergement</label>
                    <input type="text" class="form-control typeHebergement" id="typeHebergement1" aria-describedby="textHelp" name="typeHebergement" placeholder="Entrez le type d'hébergement">
                    <div class="pl-2" id="livesearchdinner1" style="min-width: 140px;position: absolute; z-index: 20; background-color: white;"></div>
                </div>
            </div>-->
            <div class="col-sm-12 col-md-12 mb-2">
                <div class="form-group">
                    <label for="activites">Activités</label>
                    <input type="text" class="form-control jourActivites" id="activites1" autocomplete="off" aria-describedby="textHelp" name="activites" placeholder="Entrez des activités" value="<?php if (isset($_POST['activite'])) {
    echo htmlentities($_POST['activite']);
} elseif (isset($nomActivite)) {
    echo $nomActivite;
}
?>">
                    <div class="pl-2" id="livesearchactivites1" style="min-width: 140px;position: absolute; z-index: 20; background-color: white;"></div>
                </div>
            </div>
        </div>
        
        <button type="submit" name="ModifierJour" class="btn btn-primary">Modifier</button>
        <input type="hidden" name="idEtape" value="<?= $idEtape ?>">
        <input type="hidden" name="idJour" value="<?= $idJour ?>">
    </div>
</div>
</form>
</div>
   

<?php
  include_once 'includes/scripts.php';
  include_once 'includes/footer.php';
  ob_end_flush();
?>