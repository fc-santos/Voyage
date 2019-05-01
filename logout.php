<?php

session_start();
unset($_SESSION['nomMembre'], $_SESSION['face_access_token']);

$_SESSION['msg'] = "<div class='alert alert-success'>Deslogado com sucesso!</div>";
header("Location: login.php");
