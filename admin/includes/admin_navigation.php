       <nav class="navbar navbar-inverse navbar-fixed-top bg-orange pr-2 pl-2" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a href="index.php"><img class="icon-brand" src="../assets/images/logo.png"  alt=""></a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
                <li>
                    <a href="../includes/logout.php"><i id="envelope" class="fa fa-fw fa-envelope"></i></a>
                </li>
                <li>
                    <a href="../includes/logout.php"><i id="notification" class="fa fa-fw fa-bell"></i></a>
                </li>
              <!--   <li><a href="">Users Online: <?php //echo users_online(); ?></a></li> -->

                <!--<li><a href="">Users Online: <span class="usersonline"></span></a></li>

               <li><a href="../index.php">Acceuil</a></li>-->
               
               
               
    
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i>
                    
<?php

//if(isset($_SESSION['username'])) {

    
    echo 'abdel.hidalgo@gmail.com'; //$_SESSION['username'];


//}




?>
                                    
                    
                    
                    <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                           
                           
                           
                            <a href="#"><i class="fa fa-fw fa-user"></i>Profil</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="../includes/logout.php"><i class="fa fa-fw fa-power-off"></i> Déconnexion</a>
                        </li>
                    </ul>
                </li>
            </ul>
            
            
            
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li>
                        <a href="index.php"><i class="fa fa-fw fa-dashboard"></i> Accueil</a>
                    </li>
                
                     <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#posts_dropdown"><i class="fa fa-fw fa-plane"></i>Circuits <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="posts_dropdown" class="collapse">
                            <li>
                                <a href="./addcircuit.php"> Créer un circuit</a>
                            </li>
                            <li>
                                <a href="posts.php?source=add_post">Modifier un circuit</a>
                            </li>
                            <li>
                                <a href="posts.php?source=add_post">Supprimer un circuit</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#posts_dropdown1"><i class="fa fa-fw fa-users"></i> Utilisateurs <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="posts_dropdown1" class="collapse">
                            <li>
                                <a href="./posts.php"> Créer admin</a>
                            </li>
                            <li>
                                <a href="posts.php?source=add_post">Désactiver compte client</a>
                            </li>
                        </ul>
                    </li>
                   
                    <li class="">
                        <a href="comments.php"><i class="fa fa-fw fa-money"></i> Promotion</a>
                    </li>
                    
                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#demo"><i class="fa fa-fw fa-arrows-v"></i> Users <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="demo" class="collapse">
                            <li>
                                <a href="users.php">View All Users</a>
                            </li>
                            <li>
                                <a href="users.php?source=add_user">Add User</a>
                            </li>
                        </ul>
                    </li>
                    
                    <li>
                        <a href="profile.php"><i class="fa fa-fw fa-dashboard"></i> Profile</a>
                    </li>
                    
                    
                    
                </ul>
            </div>
            
            
            
            <!-- /.navbar-collapse -->
        </nav>
        