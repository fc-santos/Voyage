<?php

    class Depart
    {

        // DB Properties
        private $conn;
        
        // Départ Properties
        public $idDepart;
        public $idCircuit;
        public $circuitName;
        public $dateDebut;
        public $nbPlaces;
        public $prix;
        public $titrePromotion;
        public $rabais;
        public $estActif;
        
        public function __construct($db)
        {
            $this->conn = $db;
        }

        // GET Departs
        public function listeDeparts()
        {
            
            // Create query
            $query = 'SELECT 
                    c.titre,
                    d.idDepart,
                    d.idCircuit,
                    d.dateDebut,
                    d.nbPlaces,
                    d.prix,
                    d.titrePromotion,
                    d.rabais,
                    d.estActif 
                FROM depart d
                LEFT JOIN
                    circuit c ON d.idCircuit = c.idCircuit';

            // Prepare Statement
            $stmt = $this->conn->prepare($query);

            // Execute statement
            $stmt->execute();

            return $stmt;
        }
    }
