<?php
    // Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/Depart.php';

    // Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    $depart = new Depart($db);

    // Depart query
    $result = $depart->listeDeparts();

    // Row count
    $num = $result->rowCount();

    if($num > 0){
        $departArray = array();
        
        while ($row = $result->fetch(PDO::FETCH_ASSOC)){
            extract($row);

            $departItem = array(
                'idDepart' => $idDepart,
                'idCircuit' => $idCircuit,
                'circuitName' => $circuitName,
                'dateDebut' => $dateDebut,
                'nbPlaces' => $nbPlaces,
                'prix' => $prix,
                'rabais' => $rabais,
                'titrePromotion' => $titrePromotion
            );

            array_push($departArray, $departItem);
        }
        echo json_encode($departArray);

    } else {
        echo json_encode(
            array('Message' => 'Aucun départ trouvé!', 'Row count' => $result->rowCount())
        );
    }
?>

