<?php
    include "controlleur/connexionDB.php";
    if (!session_id()) {
        @session_start();
    }

    include "includes/header.php";
    include "includes/navbar.php";


    $stmt = $conn->query('SELECT * FROM circuit');
    
    $table = '<div class="container">
                <div class="table-wrapper">			
                    <div class="table-title">
                        <div class="row">
                            <div class="col-sm-8">
                                <h2>Details des circuits</b></h2>
                            </div>
                            <div class="col-sm-4">
                                <div class="search-box">
                                    <div class="input-group">								
                                        <input type="text" id="search" class="form-control" placeholder="Recherche...">
                                        <span class="input-group-addon"><i class="fa fa-search" aria-hidden="true"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID Circuit</th>
                                <th>Titre</th>
                                <th>Description</th>
                            </tr>
                        </thead>
                        <tbody>';
                        while ($row = $stmt->fetch()) {
                            $table .= '              
                                    <tr>
                                        <td>' . $row->idCircuit . '</td>
                                        <td>' . $row->titre . '</td>
                                        <td>' . $row->description . '</td>
                                        <td>
                                        <div class="col-md-12">
                        
                                        <button class="btn btn-danger" style="color: white;" data-toggle="modal" data-target="#exampleModal'. $row->idCircuit .'"> Supprimer</button>
                                        <a href="../admin/updateFilm.php?id=' . $row->idCircuit . '" class="btn btn-primary" style="color: white;"> Modifier</a>
                                        <!-- Modal -->
                                        <div style="color: black;" class="modal fade" id="exampleModal'. $row->idCircuit .'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Suppression</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                 Êtes-vous certain de vouloir supprimer ' . $row->titre . '? 
                                                </div>
                                                <div class="modal-footer">
                                                    <a type="button" href="../admin/films.php" class="btn btn-secondary" data-dismiss="modal">Close</a>
                                                    <a type="button" href="../admin/deleteFilm.php?id=' . $row->idCircuit . '" class="btn btn-primary">Confirmer</a>
                                                </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                        </td>
                                    </tr>';
                        }
                $table .= '</tbody>
                        </table>
                    </div>
                </div>';

    echo $table;
?>
<?php
  include('includes/scripts.php');
  include('includes/footer.php');
?>
