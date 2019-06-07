<?php
    include_once "controlleur/connexionDB.php";
    if (!session_id()) {
        @session_start();
    }

    $stmt = $conn->query('SELECT * FROM utilisateur WHERE role != "Admin"');

    $table = '
                <div class="table-wrapper">			
                    <div class="table-title">
                        <div class="row">
                            <div class="col-sm-8">
                                <h2>Membres</b></h2>
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
                                <th>Id</th>
                                <th>Prénom</th>
                                <th>Nom</th>
                                <th>Courriel</th>
                                <th style="width: 200px; text-align: center;">Action</th>
                            </tr>
                        </thead>
                        <tbody>';
                        while ($row = $stmt->fetch()) {
                            $table .= '              
                                    <tr>
                                        <td>' . $row->idUtilisateur . '</td>
                                        <td>' . $row->prenom . '</td>
                                        <td>' . $row->nom . '</td>
                                        <td>' . $row->courriel . '</td>
                                        <td style="width: 200px;">
                                            <div class="col-md-12 choix">                        
                                                <a href="" data-toggle="modal" data-target="#exampleModal'. $row->idUtilisateur .'">Créer Admin</a>                                
                                                <!-- Modal -->
                                                <div style="color: black;" class="modal fade" id="exampleModal'. $row->idUtilisateur .'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Confirmer</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body" style="text-align: left !important;"> 
                                                        Êtes-vous certain de vouloir promouvoir "' . $row->prenom . " " . $row->nom . '" à admin? 
                                                        </div>
                                                        <div class="modal-footer">
                                                            <a type="button" href="gererUtilisateurs.php" class="btn btn-secondary" data-dismiss="modal">Close</a>
                                                            <a type="button" href="adminFromUtilisateur.php?idUtilisateur=' . $row->idUtilisateur . '" class="btn btn-primary">Confirmer</a>
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
?><div class="container minimumHeight">
    <?php if (isset($_SESSION['success'])):?>
        <div class="alert-success pt-2 pb-2 mb-2"><?= $_SESSION['success'] ?></div> 
        <?php unset($_SESSION['success']); ?>   
    <?php endif ?>
    <?php
        echo $table;
    ?>
</div>