<?php
$sql = null;
//get the q parameter from URL
$q = $_GET["q"];
$r = $_GET["r"];

$reponse = '';

//lookup all links from the xml file if length of q>0
if (strlen($q)>0) {
    $conn = new mysqli('localhost', 'root', '', 'dbvoyage');

    if ($conn->connect_error) {
        die("Error: There is something error" . $conn->connect_error);
    } else {
        /*echo "Database connect successfuly";*/
    }

    if ($r != '') {
        $sql = "SELECT idLieu FROM lieu WHERE ville='". $r . "' OR pays='" . $r . "' OR nom='" . $r . "'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
    
        $idLieu = $row['idLieu'];
    
        if ($idLieu != null) {
            $sql2 = "SELECT * FROM hebergement WHERE nom LIKE '%".$q."%' AND idLieu = " . $idLieu;

    
            $result = $conn->query($sql2);
            $liste = '';
        }
    } else {
        $sql2 = "SELECT * FROM hebergement WHERE nom LIKE '%".$q."%'";
        $result = $conn->query($sql2);
        $liste = '';
    }
    

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_object()) {
            if ($row->nom != null) {
                $liste = $liste . '<p onclick="prendreLaValeur(this,\'livesearchhebergement1\',\'#hebergement1\')">' . $row->nom . '</p>';
            }
        }
    } else {
        $liste = '';
    }
    $reponse = $liste;
    $conn->close();
}

echo $reponse;
