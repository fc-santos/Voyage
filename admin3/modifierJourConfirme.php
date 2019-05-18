<?php
/*include_once "controlleur/connexionDB.php";

if (isset($_POST['submit'])) {
    /*obtenir les ids a partir des noms*/
  /*  $idJour = $_POST['idJour'];
    $idLieu = $_POST['idLieu'];
    $lieu = $_POST['lieu'];
    $activite = $_POST['activite'];
    $hebergement = $_POST['hebergement'];
    $dinner = $_POST['dinner'];
    $souper = $_POST['souper'];

    $query = "SELECT * FROM activite WHERE nom = :activite AND idLieu = :idLieu";
    $getActivite = $conn->prepare($query);
    $getActivite->execute(['activite'=>$activite, 'idLieu'=>$idLieu]);

    if ($getActivite->rowCount() == 0) {
        $query1 = "INSERT INTO `activite`(`idLieu`,`nom`, `description`, `siteweb`) VALUES ($idLieu,:activiteAGarder, NULL, NULL)";
        $stmt1 = $conn->prepare($query1);
        $stmt1->execute(['activiteAGarder'=>$activite]);
        $idActivite = $conn->lastInsertId();
    } else {
        $row = $getActivite->fetch();
        $idActivite = $row->idActivite;
    }

    $query = "SELECT * FROM hebergement WHERE nom = :hebergement AND idLieu = :idLieu";
    $getHebergement = $conn->prepare($query);
    $getHebergement->execute(['hebergement'=>$hebergement, 'idLieu'=>$idLieu]);

    if ($getHebergement->rowCount() == 0) {
        $query1 = "INSERT INTO `hebergement`(`idLieu`,`nom`, `siteweb`) VALUES ($idLieu,:hebergementAGarder, NULL)";
        $stmt2 = $conn->prepare($query1);
        $stmt2->execute(['hebergementAGarder'=>$hebergement]);
        $idHebergement = $conn->lastInsertId();
    } else {
        $row = $getHebergement->fetch();
        $idHebergement = $row->idHebergement;
    }

    $query = "SELECT * FROM manger WHERE nom = :manger AND idLieu = :idLieu";
    $getDinner = $conn->prepare($query);
    $getDinner->execute(['manger'=>$dinner, 'idLieu'=>$idLieu]);

    if ($getDinner->rowCount() == 0) {
        $query1 = "INSERT INTO `manger`(`idLieu`,`nom`,`siteweb`) VALUES ($idLieu,:mangerAGarder, NULL)";
        $stmt1 = $conn->prepare($query1);
        $stmt1->execute(['mangerAGarder'=>$dinner]);
        $idDinner = $conn->lastInsertId();
    } else {
        $row = $getDinner->fetch();
        $idDinner = $row->idManger;
    }

    $query = "SELECT * FROM manger WHERE nom = :manger AND idLieu = :idLieu";
    $getSouper = $conn->prepare($query);
    $getSouper->execute(['manger'=>$souper, 'idLieu'=>$idLieu]);

    if ($getSouper->rowCount() == 0) {
        $query1 = "INSERT INTO `manger`(`idLieu`,`nom`,`siteweb`) VALUES ($idLieu,:mangerAGarder, NULL)";
        $stmt1 = $conn->prepare($query1);
        $stmt1->execute(['mangerAGarder'=>$souper]);
        $idSouper = $conn->lastInsertId();
    } else {
        $row = $getSouper->fetch();
        $idSouper = $row->idManger;
    }


    //utiliser les ids

    $query = "UPDATE `jour` SET `idActivite`= $idActivite,`idHebergement`= $idHebergement,`idDinner`= $idDinner,`idSouper`= $idSouper WHERE idJour= $idJour";
    $stmt = $conn->query($query);
    //$stmt->execute(['titreAModifier' => $_POST['nomEtape'], 'descriptionAModifier' => $_POST['descriptionEtape']]);

    if ($lieu != "") {
        //if ($_POST['idLieuChoisi'] == "0" || $_POST['idLieuChoisi'] == "" || $_POST['idLieuChoisi'] == null) {
        //$lieu = $_POST['lieu'];
        /*$query = "SELECT * FROM lieu WHERE ville= :lieu OR pays= :lieu1 OR nom= :lieu2";
        $stmt = $conn->prepare($query);
        $stmt->execute(['lieu'=>$lieu, 'lieu1'=> $lieu, 'lieu2'=>$lieu]);*/


       /* $typeLieu = $_POST['selectTypeLieu'];

        //if ($stmt->rowCount() == 0) {
        if ($typeLieu == "Ville") {
            $query1 = "INSERT INTO `lieu`(`nom`, `ville`, `pays`) VALUES (NULL,:lieu, NULL)";
        } elseif ($typeLieu == "Pays") {
            $query1 = "INSERT INTO `lieu`(`nom`, `ville`, `pays`) VALUES (NULL, NULL,:lieu)";
        } else {
            $query1 = "INSERT INTO `lieu`(`nom`, `ville`, `pays`) VALUES (:lieu, NULL, NULL)";
        }
        $stmt1 = $conn->prepare($query1);
        $stmt1->execute(['lieu'=>$lieu]);
        $idLieu = $conn->lastInsertId();
        //} else {
        $idLieu = $_POST['idLieuChoisi'];
        //$_SESSION['debug'] = $_POST['idLieuChoisi'] ;
        //}
        //} elseif ($_POST['lieu'] == "") {
        $idLieu = 1;
    }

    $query = "SELECT * from jour WHERE idJour=" . $_POST['idJour'];
    $stmt = $conn->query($query);

    while ($row = $stmt->fetch()) {
        $idEtape = $row->idEtape;
    }

    @header("Location: listerJours.php?idEtape=" . $idEtape);
}
*/
