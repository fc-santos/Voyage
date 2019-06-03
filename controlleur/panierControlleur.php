<?php
session_start();
require "connexionDB.php";

$reponse = array();
$reponse['panier'] = array();
$reponse['depart'] = array();
$reponse['circuit'] = array();
$reponse['soustotal'] = 0;


$idUtilisateur = isset($_SESSION['idUtilisateur']) ? $_SESSION['idUtilisateur'] : 2;

//Controleur
$action = isset($_POST['action']) ? $_POST['action'] : null;

$reponse['user'] = $idUtilisateur;

switch ($action) {
    case 'enregistrer' :
        enregistrer();
        break;

    case "listerPanier" :
         lister();
        break;

    case "listerParCategorie" :
        listerParCategorie();
        break;

    case "supprimer" :
        supprimer();
}

function enregistrer(){
	global $conn, $reponse, $idUtilisateur;	
    
    $idDepart=$_POST['idDepart'];
	$nbAdultes=$_POST['nbAdultes'];
    $nbEnfants=$_POST['nbEnfants'];
    $requete="INSERT INTO panier VALUES(0,?,?,?,?)";
	try {
        $stmt = $conn->prepare($requete);
        $stmt->execute(array($idDepart, $nbAdultes, $nbEnfants, $idUtilisateur));
    } catch(Exception $e) {
        $reponse['erreur']="Probleme pour ajouter départ au panier!";
    }finally {
        lister();
        unset($conn);
		unset($stmt);
		// echo json_encode($reponse);
    }
}

function lister() {

    global $reponse, $conn, $idUtilisateur;

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
        echo 'Fail to connect!';
        //echo $e->getMessage();
        $reponse['query'] = 'Falhou';
    }finally{
        unset($conn);
        unset($stmt);
        echo json_encode($reponse);
    }

}
function supprimer(){
    
    global $reponse, $conn, $idUtilisateur;

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
        unset($conn);
        unset($stmt);
        echo json_encode($reponse);
    }
}

?>