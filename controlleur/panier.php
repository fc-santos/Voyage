<?php
require "connexionDB.php";

// if (!session_id()) {
//     @session_start();
// }

$reponse = array();

// $reponse['resultado'] = "Foi criado";

$idUtilisateur = isset($_SESSION['idUtilisateur']) ? $_SESSION['idUtilisateur'] : 2;

//Contr�leur
$action = isset($_POST['action']) ? $_POST['action'] : null;

// $reponse['user'] = $idUtilisateur;
// $reponse['action'] = $action;

switch ($action) {

    case "listerPanier" :
        // $reponse['resultado']= 'Entrou no switch';
         lister();
        break;
    case "listerParCategorie" :
        // $tabRes['resultado']= 'Entrou no switch';
        listerParCategorie();
        break;
}

function lister() {

    global $reponse;

    global $conn;

    global $idUtilisateur;

    try {
        $stmt = $conn->query('SELECT * FROM panier WHERE idUtilisateur = ' . $idUtilisateur);

        $reponse['panier']= array();

        while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
            $getDepart = $conn->query('SELECT * FROM depart WHERE idDepart = ' . $row->idDepart);
            $reponse['depart'] = $getDepart->fetch();
        
            $getCircuit = $conn->query('SELECT * FROM circuit WHERE idCircuit = ' . $reponse['depart']->idCircuit);
            $reponse['circuit'] = $getCircuit->fetch();
        
            $reponse['soustotal'] = ($row->nbAdultes + $row->nbEnfants) * $reponse['depart']->prix;
        
            $reponse['panier'][] = $row;
        }

    } catch(Exception $e){
        echo 'deu rim';
        //echo $e->getMessage();
        $reponse['query'] = 'falhou';
    }finally{
        // unset($unModele);
    }

}

echo json_encode($reponse);

?>