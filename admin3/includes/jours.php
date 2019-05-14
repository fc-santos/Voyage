<?php
    if (isset($_POST['autreEtape'])) {
        if (isset($_SESSION['lieu'])) {
            $lieu = $_SESSION['lieu'];
        } else {
            $lieu = "Sans lieu";
        }

        if (isset($_POST['lieu']) && $_POST['lieu'] != "") {
            $lieuAGarder = $_POST['lieu'];
            $query = "SELECT * FROM lieu WHERE ville= :lieuAGarder OR pays= :lieuAGarder1 OR nom= :lieuAGarder2";
            $stmt = $conn->prepare($query);
            $stmt->execute(['lieuAGarder'=>$lieuAGarder, 'lieuAGarder1'=> $lieuAGarder, 'lieuAGarder2'=>$lieuAGarder]);

            $typeLieu = $_POST['selectTypeLieu'];

            if ($stmt->rowCount() == 0) {
                if ($typeLieu == "Ville") {
                    $query1 = "INSERT INTO `lieu`(`nom`, `ville`, `pays`) VALUES (NULL, :lieuAGarder, NULL)";
                } elseif ($typeLieu == "Pays") {
                    $query1 = "INSERT INTO `lieu`(`nom`, `ville`, `pays`) VALUES (NULL, NULL, :lieuAGarder)";
                } else {
                    $query1 = "INSERT INTO `lieu`(`nom`, `ville`, `pays`) VALUES (:lieuAGarder, NULL, NULL)";
                }
                $stmt1 = $conn->prepare($query1);
                $stmt1->execute(['lieuAGarder'=> $lieuAGarder]);
                $idLieu = $conn->lastInsertId();
            }
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
                $idDinner = 0;
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

        try {
            $idEtape = $_SESSION['idEtape'];

            $sql4 = "INSERT INTO `jour`(`idEtape`, `idActivite`, `idHebergement`, `idDinner`, `idSouper`) VALUES ($idEtape, $idActivites, $idHebergement, $idDinner, $idSouper)";
            $stmt4 = $conn->prepare($sql4);
            $stmt4->execute();
            $_SESSION['correctNomCircuit'] = true;
        } catch (Exception $r) {
        }
        unset($_POST['autreJour']);
    }

    if (isset($_POST['ajouterPlusJours']) || isset($_POST['terminerJour'])) {
        if (isset($_SESSION['lieu'])) {
            $lieu = $_SESSION['lieu'];
        }

        if (isset($_POST['lieu']) && $_POST['lieu'] != "") {
            $lieuAGarder = $_POST['lieu'];
            $query = "SELECT * FROM lieu WHERE ville= :lieuAGarder OR pays= :lieuAGarder1 OR nom= :lieuAGarder2";
            $stmt = $conn->prepare($query);
            $stmt->execute(['lieuAGarder'=>$lieuAGarder, 'lieuAGarder1'=> $lieuAGarder, 'lieuAGarder2'=>$lieuAGarder]);


            $typeLieu = $_POST['selectTypeLieu'];

            if ($stmt->rowCount() == 0) {
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
                $row = $stmt->fetch();
                $idLieu = $row->idLieu;
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
        /*if (isset($_POST['typeHebergement'])) {
            $typeHebergement = $_POST['typeHebergement'];
        }*/
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

        try {
            $idEtape = $_SESSION['idEtape'];

            $sql4 = "INSERT INTO `jour`(`idEtape`, `idActivite`, `idHebergement`, `idDinner`, `idSouper`) VALUES ($idEtape, $idActivites, $idHebergement, $idDinner, $idSouper)";
            $stmt4 = $conn->prepare($sql4);
            $stmt4->execute();
            $_SESSION['correctEtape'] = true;
        } catch (Exception $r) {
        }
        unset($_POST['ajouterPlusJours']);
    }

    if (isset($_POST['terminerJour'])) {
        unset($_SESSION['correctEtape']);
        $_SESSION['success'] = 'Un jour a été ajouté à l\'étape "' . $idEtape . '"';
        header("location: listerJours.php?idEtape=" . $_SESSION['idEtape']);
    }
?>

<h2>Ajouter des jours</h2>

<form class="mt-3" action="creerCircuit.php" method="POST">
    <div id="detailsJours" class="border mb-3">
        <div class="container pt-3 pb-3">
            <h5>Jour</h5>
            <div class="row mb-2">
                <div class="col-sm-12 col-md-4 mb-2">
                    <div class="form-group">
                        <label for="lieu">Lieu</label>
                        <input type="text" class="form-control lieu" id="lieu1" autocomplete="off" aria-describedby="textHelp" name="lieu" placeholder="Entrez un lieu">
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
                    <input type="text" class="form-control  lieuHebergement" id="hebergement1" autocomplete="off" aria-describedby="textHelp" name="hebergement" placeholder="Entrez un hébergement">
                    <div class="pl-2" id="livesearchhebergement1" style="min-width: 140px;position: absolute; z-index: 20; background-color: white;"></div>
                </div>
                </div>
                <div class="col-sm-12 col-md-4 mb-2">
                    <div class="form-group">
                        <label for="dinner">Dîner</label>
                        <input type="text" class="form-control lieudinner" id="dinner1" autocomplete="off" aria-describedby="textHelp" name="dinner" placeholder="Entrez un lieu pour dîner">
                        <div class="pl-2" id="livesearchdinner1" style="min-width: 140px;position: absolute; z-index: 20; background-color: white;"></div>           
                    </div>
                </div>
                <div class="col-sm-12 col-md-4 mb-2">
                    <div class="form-group">
                        <label for="souper">Souper</label>
                        <input type="text" class="form-control lieuSouper" id="souper1" autocomplete="off" aria-describedby="textHelp" name="souper" placeholder="Entrez un lieu pour souper">
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
                        <input type="text" class="form-control jourActivites" id="activites1" autocomplete="off" aria-describedby="textHelp" name="activites" placeholder="Entrez des activités">
                        <div class="pl-2" id="livesearchactivites1" style="min-width: 140px;position: absolute; z-index: 20; background-color: white;"></div>
                    </div>
                </div>
            </div>
            <button type="submit" name="autreEtape" class="btn btn-primary">Ajouter une autre étape</button>
            <button type="submit" name="ajouterPlusJours" class="btn btn-primary">Ajouter Jours</button>
            <button type="submit" name="terminerJour" class="btn btn-primary">Terminer</button>
        </div>
    </div>
</form>