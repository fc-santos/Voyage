<?php
  $host =  'localhost';
  $user = 'root';
  $password = '';
  $dbname = 'dbvoyage';
  // Set DSN
  $dsn = 'mysql:host='. $host .';dbname='. $dbname;
  // Create a PDO instance
  $conn = new PDO($dsn, $user, $password);
  $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
  $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
