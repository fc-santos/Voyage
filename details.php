<?php
session_start();
$title = "Voyage GoAbroad | Détails";
include 'includes/header.php'; ?>

<div class="container">
    <div class="bg-circuit">
        <div class="circuit-caption">
            <h1 style="font-size: 3.2em;">Nom Circuit</h1>
        </div>
        <img src="assets/images/village.jpg" class="img-fluid" alt="Image du Circuit">
    </div>
    <div class="mt-4">
        <div class="row">
            <div class="col-md-9">
                <h3 class="circuit-description">Description du Circuit</h3>
                <hr>
                <p class="text-justify">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Lorem ipsum dolor sit amet consectetur adipisicing elit. Nam repudiandae, inventore illo ratione officiis itaque cum debitis recusandae doloribus aut, sunt, pariatur accusamus nobis mollitia sed. Quod architecto dignissimos illum? Lorem ipsum dolor sit amet consectetur adipisicing elit. Cumque dolore nisi dicta corporis dolorum, vel nostrum suscipit. Laborum tempora beatae quibusdam incidunt consectetur. Excepturi est adipisci quia. Sequi, aliquam asperiores?</p>
                <hr>
                <div class="mt-4">
                    <h3 class="circuit-details mb-4">Détails du Circuit</h3>
                    <div id="accordion" role="tablist">
                        <div class="jour mb-3">
                            <div class="" role="tab" id="headingOne">
                                <h5 class="mb-0">
                                    <a role="button" class="collapsed text-uppercase" data-parent="#accordion" data-toggle="collapse" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                        Jour 1: Lieu <i class="fas fa-angle-down float-right"></i>
                                    </a>
                                </h5>
                            </div>
                            <div id="collapseOne" class="collapse" role="tabpanel" aria-labelledby="headingOne">
                                <div class="card-body">
                                    Description
                                </div>
                            </div>
                        </div>
                        <div class="jour mb-3">
                            <div class="" role="tab" id="headingTwo">
                                <h5 class="mb-0">
                                    <a role="button" class="collapsed text-uppercase" data-parent="#accordion" data-toggle="collapse" href="#collapseTwo" aria-expanded="false" aria-controls="collapseOne">
                                        Jour 2: Lieu<i class="fas fa-angle-down float-right"></i>
                                    </a>
                                </h5>
                            </div>
                            <div id="collapseTwo" class="collapse" role="tabpanel" aria-labelledby="headingTwo">
                                <div class="card-body">
                                    Description
                                </div>
                            </div>
                        </div>
                        <div class="jour mb-3">
                            <div class="" role="tab" id="headingThree">
                                <h5 class="mb-0">
                                    <a role="button" class="collapsed text-uppercase" data-parent="#accordion" data-toggle="collapse" href="#collapseThree" aria-expanded="false" aria-controls="collapseOne">
                                        Jour 3: Lieu<i class="fas fa-angle-down float-right"></i>
                                    </a>
                                </h5>
                            </div>
                            <div id="collapseThree" class="collapse" role="tabpanel" aria-labelledby="headingThree">
                                <div class="card-body">
                                    Description
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card mb-5 mb-lg-0 right-side">
                    <div class="card-body">
                        <h5 class="card-title text-muted text-uppercase text-center">Réserver Maintenant</h5>
                        <h6 class="card-price text-center">$4 999</h6>
                        <hr>
                        <ul class="fa-ul">
                            <li><span class="fa-li"><i class="fas fa-check"></i></span>Single User</li>
                            <li><span class="fa-li"><i class="fas fa-check"></i></span>5GB Storage</li>
                            <li><span class="fa-li"><i class="fas fa-check"></i></span>Unlimited Public Projects</li>
                            <li><span class="fa-li"><i class="fas fa-check"></i></span>Community Access</li>
                            <li class="text-muted"><span class="fa-li"><i class="fas fa-times"></i></span>Unlimited Private Projects</li>
                            <li class="text-muted"><span class="fa-li"><i class="fas fa-times"></i></span>Dedicated Phone Support</li>
                            <li class="text-muted"><span class="fa-li"><i class="fas fa-times"></i></span>Free Subdomain</li>
                            <li class="text-muted"><span class="fa-li"><i class="fas fa-times"></i></span>Monthly Status Reports</li>
                        </ul>
                        <a href="#" class="btn btn-block btn-primary text-uppercase">Button</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>