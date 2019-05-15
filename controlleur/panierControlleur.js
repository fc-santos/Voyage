$(document).ready(function() {
    getPanier();
});

$(document).on('click', 'div .dropdown-menu', function (e) {
    e.stopPropagation();
  });

// $('#navbarDropdownMenuLink0').click(function () {
//     getPanier();
// });

$(".confirm-delete").click(function () {
    return confirm("Êtes-vous sur de vouloir supprimer ce film?");
});


//  ******  REQUETES PANIER  *****

// function enregistrer(){
// 	var formFilm = new FormData(document.getElementById('formEnreg'));
// 	formFilm.append('action','enregistrer');
// 	$.ajax({
// 		type : 'POST',
// 		url : 'controller/filmsControleur.php',
// 		data : formFilm,
// 		dataType : 'json', //text pour le voir en format de string
// 		//async : false,
// 		//cache : false,
// 		contentType : false,
// 		processData : false,
// 		success : function (reponse){//alert(reponse);
// 					filmsVue(reponse);
// 		},
// 		fail : function (err){
		   
// 		}
// 	});
// }

function getPanier(){
    console.log('entrei no getPanier()');
	var formPanier = new FormData();
	formPanier.append('action','listerPanier');//alert(formFilm.get("action"));
	$.ajax({
		type : "post",
		url : "controlleur/panierControlleur.php",
		data : formPanier,
		contentType : false,
		processData : false,
		cache : false,
		dataType : "json", //text pour le voir en format de string
        success : function (reponse){//alert(reponse);
                    console.log(reponse);
					viewPanier(reponse);
					
		},
		fail : function (err){
			console.log('Deu Ruim!!');
		}
	});
}

function viewPanier(infoPanier) {
	var taille;
	var rep=`<div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <span><b>Circuit</b></span>
                    </div>
                    <div class="col-md-2 centerText">
                        <span><b>Depart</b></span>
                    </div>
                    <div class="col-md-2 centerText">
                        <span><b>Adults</b></span>
                    </div>
                    <div class="col-md-2 centerText">
                        <span><b>Enfants</b></span>
                    </div>
                    <div class="col-md-2 centerText">
                        <span><b>Prix Unitaire</b></span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <hr style="border: 0.5px solid grey">
                    </div>
                </div>`;
	taille = infoPanier.panier.length;
	if(taille > 0){
		for(var i=0; i<taille; i++){
			rep += `<div class="row">
                        <div class="col-md-3">
                            ` + infoPanier.circuit[i].titre + `
                        </div>
                        <div class="col-md-2 my-1 centerText">
                        ` + infoPanier.depart[i].dateDebut + `
                        </div>
                        <div class="col-md-2 my-1 centerText">
                        ` + infoPanier.panier[i].nbAdultes + `
                        </div>
                        <div class="col-md-2 my-1 centerText">
                        ` + infoPanier.panier[i].nbEnfants + `
                        </div>
                        <div class="col-md-2 my-1 centerText">
                        $ ` + infoPanier.depart[i].prix.toFixed(2) + `
                        </div>
                        <div class="col-md-1">
                            <button type="button" class="btn btn-default" onclick='supprimer(` + infoPanier.panier[i].idPanier + `); getPanier();'><i class="fas fa-trash-alt"></i></button>
                        </div>                                  
                    </div>
                    <div class="dropdown-divider"></div>`;
        }
        rep += 		`<div class="col-md-11 my-1" id='prixTotal'>
                        <span> Prix Total : </span>$ ` + infoPanier.total.toFixed(2) + `
                    </div>
                    <div class="col-md-3">
                        <button type="button" class="btn btn-success" onclick='acheter()'>Payer</button>
                    </div>
                </div>`;

        $('#panier').html(" (" + taille + ") $ " + infoPanier.total.toFixed(2));
	} else {
		rep = "<h4 style='font-style: italic; text-align: center; color: grey;'>Le panier est vide...</h4>";
	}
	
    $('#divPanier').html(rep);
    

}

// function listerParCategorie(idCategorie){
// 	var formFilm = new FormData();
// 	formFilm.append('action','listerParCategorie');//alert(formFilm.get("action"));
// 	formFilm.append('id', idCategorie);
// 	$.ajax({
// 		type : "post",
// 		url : "controller/filmsControleur.php",
// 		data : formFilm,
// 		contentType : false,
// 		processData : false,
// 		cache : false,
// 		dataType : "json", //text pour le voir en format de string
// 		success : function (reponse){//alert(reponse);
// 					filmsVue(reponse);
// 					console.log(reponse);
// 		},
// 		fail : function (err){
// 			console.log('Deu Ruim!!');
// 		}
// 	});
// }

function supprimer(idPanier){
    var formPanier = new FormData();
	formPanier.append('action','supprimer');
	formPanier.append('idPanier', idPanier);
	$.ajax({
		type : 'POST',
		url : 'controlleur/panierControlleur.php',
		data : formPanier,//leForm.serialize(),
		contentType : false, //Enlever ces deux directives si vous utilisez serialize()
		processData : false,
		dataType : 'json', //text pour le voir en format de string
		success : function (reponse){//alert(reponse);
            console.log(reponse);
			viewPanier(reponse);
		},
		fail : function (err){
			
		}
	});
}

// function obtenirFiche(){
// 	$('#divFiche').hide();
// 	var leForm=document.getElementById('formFiche');
// 	var formFilm = new FormData(leForm);
// 	formFilm.append('action','fiche');
// 	$.ajax({
// 		type : 'POST',
// 		url : 'controller/filmsControleur.php',
// 		data : formFilm,
// 		contentType : false, 
// 		processData : false,
// 		dataType : 'json', 
// 		success : function (reponse){//alert(reponse);
// 					filmsVue(reponse);
// 		},
// 		fail : function (err){
// 		}
// 	});
// }

// function modifier(){
// 	var leForm=document.getElementById('formFicheF');
// 	var formFilm = new FormData(leForm);
// 	formFilm.append('action','modifier');
// 	$.ajax({
// 		type : 'POST',
// 		url : 'controller/filmsControleur.php',
// 		data : formFilm,
// 		contentType : false, 
// 		processData : false,
// 		dataType : 'json', 
// 		success : function (reponse){//alert(reponse);
// 					$('#divFormFiche').hide();
// 					filmsVue(reponse);
// 		},
// 		fail : function (err){
// 		}
// 	});
// }