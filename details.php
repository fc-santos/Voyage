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
        <h3 class="circuit-description">Description du Circuit</h3>
        <hr>
        <p class="text-justify">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Harum odio voluptas velit cumque similique. Debitis asperiores possimus temporibus, impedit, eveniet reiciendis quos, sunt autem cumque repellat delectus fugiat magni placeat. Lorem ipsum dolor sit amet consectetur adipisicing elit. Ab sint, in maiores officia nemo, expedita aperiam, repellendus iusto quos natus necessitatibus cum veniam veritatis harum aliquid dolores accusamus tenetur voluptas. Lorem ipsum, dolor sit amet consectetur adipisicing elit. Numquam esse dolore fugit illum, tempora unde ipsum, itaque provident deserunt ab vero, eveniet ea nulla cupiditate ad optio beatae corporis ullam! Lorem, ipsum dolor sit amet consectetur adipisicing elit. Aliquam cumque autem laboriosam debitis quia molestiae, iusto quo deleniti ratione quod ea doloremque, ipsum quam vel quis assumenda cum, excepturi cupiditate.</p>
        <hr>
        <div class="mt-4">
            <h3 class="circuit-details mb-4">Détails du Circuit</h3>
            <div class="jour">
                <p>Jour 1: Lieu </p>
                <p class="text-justify">Lorem ipsum dolor sit amet consectetur adipisicing elit. Assumenda, quae impedit veritatis cumque voluptates suscipit. Accusamus minima, iure ad et blanditiis ut culpa ullam nihil ea tenetur corrupti earum! Doloribus.</p>
            </div>
            <div class="jour">
                <p>Jour 2: Lieu </p>
                <p class="text-justify">Lorem ipsum dolor sit amet consectetur adipisicing elit. Assumenda, quae impedit veritatis cumque voluptates suscipit. Accusamus minima, iure ad et blanditiis ut culpa ullam nihil ea tenetur corrupti earum! Doloribus.</p>
            </div>
            <div class="jour">
                <p>Jour 3: Lieu </p>
                <p class="text-justify">Lorem ipsum dolor sit amet consectetur adipisicing elit. Assumenda, quae impedit veritatis cumque voluptates suscipit. Accusamus minima, iure ad et blanditiis ut culpa ullam nihil ea tenetur corrupti earum! Doloribus.</p>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>