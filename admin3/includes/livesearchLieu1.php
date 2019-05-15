<?php
if (!session_id()) {
    @session_start();
}
//get the q parameter from URL
$q = $_GET["q"];
$reponse = '';

//lookup all links from the xml file if length of q>0
if (strlen($q)>0) {
    $conn = new mysqli('localhost', 'root', '', 'dbvoyage');

    if ($conn->connect_error) {
        die("Erreur: Il y a une erreur" . $conn->connect_error);
    } else {
        /*echo "Database connect successfuly";*/
    }

    $sql = "SELECT * FROM lieu WHERE nom LIKE '%".$q."%' OR ville LIKE '%".$q."%' OR pays LIKE '%".$q."%'";

    $result = $conn->query($sql);
    $liste = '';
    //$total = $result->num_rows;

    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_object()) {
            /*if ($row->nom != null) {
                $liste = $liste . '<p onclick="prendreLaValeur(this,\'livesearchLieu1\',\'#lieu1\')">' . $row->nom . '</p>';
            } elseif ($row->ville != null) {
                $liste = $liste . '<p onclick="prendreLaValeur(this,\'livesearchLieu1\',\'#lieu1\')">' . $row->ville . '</p>';
            } elseif ($row->pays != null) {
                $liste = $liste . '<p onclick="prendreLaValeur(this,\'livesearchLieu1\',\'#lieu1\')">' . $row->pays . '</p>';
            }*/
            $liste = $liste . '<p onclick="prendreLaValeur(this,\'livesearchLieu1\',\'#lieu1\')">' . $row->nom . " " . $row->ville . " " . $row->pays . '</p>';
        }
    } else {
        $liste = '';
    }
    $reponse = $liste;
    $conn->close();
}
$_SESSION['typeLieuFromDatabase'] = true;
//output the response
echo $reponse;
