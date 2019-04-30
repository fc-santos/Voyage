<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="css/filipe.css">

    <!-- Goggle Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700" rel="stylesheet">

    <title>
        <?php echo $title; ?>
    </title>
</head>

<body>

    <nav class="fixed-top navbar navbar-expand-lg navbar-light bg-blue pt-0 pb-0 pr-5 pl-5">
        <a class="navbar-brand" href="index.php"><img src="assets/images/logo.png" style="width:100px;" alt=""></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <!--
        <li class="nav-item active">
          <a class="nav-link" href="#">Accueil <span class="sr-only">(current)</span></a>
        </li>-->
                <li class="nav-item mr-4">
                    <a class="nav-link" href="#">Message aux clients</a>
                </li>
                <li class="nav-item dropdown mr-4">
                    <a class="nav-link" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Circuits
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                </li>
                <li class="nav-item mr-4 <?php if ($nav === 'contact') : ?>active <?php endif; ?>">
                    <a class="nav-link" href="contact.php">Contact</a>
                </li>
                <li class="nav-item <?php if ($nav === 'about') : ?>active <?php endif; ?>">
                    <a class="nav-link" href="about.php">À propos</a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item <?php if ($nav === 'login') : ?>active <?php endif; ?>">
                    <a class="nav-link" href="login.php">Connexion</a>
                </li>
                <li class="nav-item <?php if ($nav === 'register') : ?>active <?php endif; ?>">
                    <a class="nav-link" href="register.php">S'enregistrer</a>
                </li>
            </ul>
        </div>
    </nav>