var allCircuits = null;

function getCircuits(isAuthentifie) {
    if (window.XMLHttpRequest) {
        // code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    } else { // code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            var r = this.responseText;
            circuits = JSON.parse(r);
            console.log(circuits);
            createCircuits(circuits, isAuthentifie);
        }
    }

    pagePHP = "getCircuits.php";
    xmlhttp.open("GET", pagePHP, true);
    xmlhttp.send();
}

function createCircuits(circuits, isAuthentifie) {
    var content = "";
    var compteur = 0;
    var row = 1;
    allCircuits = circuits;
    circuits.forEach(element => {
        compteur++;
        content += `<div class="col-lg-4 mb-4-sm">
                        <div class="card">
                            <div class="prix">$` + element.prix + `</div>
                            <img src="assets/images/castle.jpg" class="card-img-top img-fluid img-cover" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">Card title</h5>
                                <p class="card-text">This card has supporting text below as a natural lead-in to additional content.</p>
                                <hr>
                                <a href="details.php" class="btn btn-success btn-block">Voir l'offre</a>`
        if (isAuthentifie === 'authentifie') {
            content += `<div class="text-center">
                                        <a href="#" class="btn btn-primary mt-2" id="` + element.idDepart + `" onclick='ajouterAuPanier(` + element.idDepart + `, 1 , 0); event.preventDefault();'>Ajouter au panier</a>
                                    </div>`
        }



        content += `</div>
                        </div>
                    </div>`

        if (compteur > 2) {
            showCircuits(content, row);
            content = "";
            compteur = 0;
            row++;
        }
        if (row >= 3) {
            return;
        }
    });


}

function showCircuits(content, row) {
    document.getElementById('cards-circuits' + row).innerHTML = content;
}