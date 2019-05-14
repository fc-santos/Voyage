<?php
    include_once "controlleur/connexionDB.php";
    if (!session_id()) {
        @session_start();
    }

    include_once "includes/header.php";
    include_once "includes/navbar.php";


    $stmt = $conn->query('SELECT * FROM circuit');

    $table = '
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
                                <th>Titre</th>
                                <th>Description</th>
                                <th style="width: 200px; text-align: center;">Action</th>
                            </tr>
                        </thead>
                        <tbody>';
                        while ($row = $stmt->fetch()) {
                            $table .= '              
                                    <tr>
                                        <td>' . $row->titre . '</td>
                                        <td>' . $row->description . '</td>
                                        <td style="width: 200px;">
                                            <div class="col-md-12 choix">
                        
                                                <a href="" data-toggle="modal" data-target="#exampleModal'. $row->idCircuit .'"><i class="fa fa-trash" aria-hidden="true" style="color: #ff6666;"></i></a>
                                                <a href="modifierCircuit.php?idCircuit=' . $row->idCircuit . '"><i class="fa fa-pencil" aria-hidden="true" style="color: #00b33c;"></i></a>
                                                <a href="listerEtapes.php?idCircuit=' . $row->idCircuit . '" class="btn btn-primary" style="color: white;">Étapes</a>
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
                                                        Êtes-vous certain de vouloir supprimer "' . $row->titre . '"? 
                                                        </div>
                                                        <div class="modal-footer">
                                                            <a type="button" href="gererCircuits.php" class="btn btn-secondary" data-dismiss="modal">Close</a>
                                                            <a type="button" href="deleteCircuit.php?idCircuit=' . $row->idCircuit . '" class="btn btn-primary">Confirmer</a>
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
                ';
?><div class="container">
    
    <form action="creerCircuit.php">
        <button class="btn btn-primary" style="color: white;">Ajouter Circuit</button>
    </form>
    <?php
        echo $table;
    ?>
</div><?php
  include_once 'includes/scripts.php';
  include_once 'includes/footer.php';
?>