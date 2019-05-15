<?php
require "connexionDB.php";

// if (!session_id()) {
//     @session_start();
// }

$reponse = array();
$reponse['panier'] = array();
$reponse['depart'] = array();
$reponse['circuit'] = array();
$reponse['soustotal'] = 0;

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
    case "supprimer" :
        supprimer();
}

function lister() {

    global $reponse;

    global $conn;

    global $idUtilisateur;

    try {
        $stmt = $conn->query('SELECT * FROM panier WHERE idUtilisateur = ' . $idUtilisateur);

        while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
            $getDepart = $conn->query('SELECT * FROM depart WHERE idDepart = ' . $row->idDepart);
            $reponse['depart'][] = $getDepart->fetch(PDO::FETCH_OBJ);
        
            $getCircuit = $conn->query('SELECT * FROM circuit WHERE idCircuit = ' . $reponse['depart'][count($reponse['depart']) - 1]->idCircuit);
            $reponse['circuit'][] = $getCircuit->fetch(PDO::FETCH_OBJ);
        
            $reponse['total'] += ($row->nbAdultes + $row->nbEnfants) * $reponse['depart'][count($reponse['depart']) - 1]->prix;
        
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
function supprimer(){
    global $reponse;
    
    global $conn;

    global $idUtilisateur;

    $idPanier=$_POST['idPanier'];

    try{
        $conn->exec("DELETE FROM panier WHERE idPanier=" . $idPanier);

        $stmt = $conn->query('SELECT * FROM panier WHERE idUtilisateur = ' . $idUtilisateur);

        while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
            $getDepart = $conn->query('SELECT * FROM depart WHERE idDepart = ' . $row->idDepart);
            $reponse['depart'][] = $getDepart->fetch(PDO::FETCH_OBJ);
        
            $getCircuit = $conn->query('SELECT * FROM circuit WHERE idCircuit = ' . $reponse['depart'][count($reponse['depart']) - 1]->idCircuit);
            $reponse['circuit'][] = $getCircuit->fetch(PDO::FETCH_OBJ);
        
            $reponse['total'] += ($row->nbAdultes + $row->nbEnfants) * $reponse['depart'][count($reponse['depart']) - 1]->prix;
        
            $reponse['panier'][] = $row;
        }

    }catch(Exception $e){
    }finally{
        unset($unModele);
    }
}

echo json_encode($reponse);

?>