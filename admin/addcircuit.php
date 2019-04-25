<?php include "includes/admin_header.php" ?>

<div id="wrapper">

    <!-- Navigation -->

    <?php include "includes/admin_navigation.php" ?>

    <div id="page-wrapper">
        <ul class="nav nav-tabs">
            <li class="nav-item active">
                <a href="#nomcircuit" class="nav-link" role="tab" data-toggle="tab">Nom circuit</a>
            </li>
            <li class="nav-item">
                <a href="#etapes" class="nav-link" role="tab" data-toggle="tab">Etapes</a>
            </li>
            <li class="nav-item">
                <a href="#promotion" class="nav-link" role="tab" data-toggle="tab">Promotion</a>
            </li>
        </ul>

        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="nomcircuit"><?php include 'includes/nomcircuit.php'; ?></div>
            <div role="tabpanel" class="tab-pane" id="etapes"><?php include 'includes/etapes.php'; ?></div>
            <div role="tabpanel" class="tab-pane" id="promotion"><?php include 'includes/promotion.php'; ?></div>
        </div>
    </div>
    <!-- /.container-fluid -->

</div>


<!-- /#page-wrapper -->

<?php include "includes/admin_footer.php" ?>