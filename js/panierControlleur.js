
var request;
var quantitePanier = 0;
var contentPanier = [];

var prixTotal = 0;

function ajouterAuPanier(idDepart, prixDepart, dateDepart){
  var elementTrove = false;
  prixTotal += prixDepart;

  //verifier panier pour trouver le Depart
  contentPanier.forEach(function(element){
    if(element.idDepart == idDepart){
      element.quantite++;
      ContentPanier();
      elementTrove = true;
    }
  }); 

  //if depart n'est pas dans le panier ajouter-le
  if(!elementTrove){
    quantitePanier++;    

    var taille = allCircuits.length;
    //console.log(allCircuits)
    var item = {};

    for(let i = 0; i < taille; i++){
      if(allCircuits[i].idDepart == idDepart){
        item.idDepart = allCircuits[i].idDepart;
        item.idCircuit = allCircuits[i].idCircuit;
        item.prix = allCircuits[i].prix;
        item.date = allCircuits[i].date;
        item.quantite = 1;
      }
    }

    contentPanier.push(item);
    console.log(item);
    ContentPanier(); 
  }
 $('#panier').html(" (" + quantitePanier + ") $ " + prixTotal.toFixed(2));
}

function supprimer(idDepart, quantite, prix){
    var updatedPanier = [];
    prixTotal -= quantite * prix;
    
    contentPanier.forEach(function(element){
      if(element.idDepart != idDepart){
        updatedPanier.push(element);
      }else{
        quantitePanier--;
      }
    });
    contentPanier = updatedPanier;
    
    if(contentPanier.length == 0) prixTotal = 0.00; 
    
    $('#panier').html(" (" + quantitePanier + ") $ " + prixTotal.toFixed(2));

    $( '.nav-item.dropdown.test' ).click(function(event) {
      event.stopPropagation();
      event.preventDefault();      
    });
    ContentPanier();
    
    
}

function acheter(){
  var totalFacture = 0;

  var pdf = new jsPDF('p', 'pt', 'letter');
      var y = 40;
      var x = 250;

      pdf.setFontSize(20);
      pdf.setFontType('bold');
      var text = 'FACTURE';
      pdf.text(text, x, y); 
      
      pdf.setLineWidth(3.0);
      pdf.line(200, 45, 400, 45);

      y = 80;
      x = 100;

      pdf.setFontSize(14);
      text = 'idDepart'; 
      pdf.text(text, x, y);      
      x = 280;
      text = 'Quantité';
      pdf.text(text, x, y); 
      x = 400;
      text = 'Prix';
      pdf.text(text, x, y); 
      x = 480;
      text = 'Sous-Total';
      pdf.text(text, x, y); 
 
      pdf.setLineWidth(0.5);
      pdf.line(100, 90, 560, 90);
       

      pdf.setFontSize(12);
      pdf.setFontType('normal');
    
      contentPanier.forEach(function(element){
        //var img = new Image();
        //img.src = element.image;
        
        y += 30; 
        x = 100;

        //pdf.addImage(img, 'png', 50, y - 20, 27, 27)

        var sousTotal = element.quantite * element.prix;
        totalFacture += sousTotal;

        text = "" + element.idDepart; 
        pdf.text(text, x, y);      
        x = 300;
        text = "" + element.quantite;
        pdf.text(text, x, y); 
        x = 400;
        text = "$ " + element.prix;
        pdf.text(text, x, y); 
        x = 500;
        text = "$ " + sousTotal.toFixed(2);
        pdf.text(text, x, y); 
      })

      pdf.setLineWidth(0.5);
      pdf.line(100, y + 15, 560, y + 15);
      pdf.setFontType('bold');

      y += 30
      x = 450
      text = "Total";
      pdf.text(text, x, y); 

      pdf.setFontType('normal');
      x = 500
      text = "$ "  + totalFacture.toFixed(2); 
      pdf.text(text, x, y)
      
      

      pdf.save('facture.pdf')
}

function calculerQuantite(idDepart){
  contentPanier.forEach(function(element){
    if(element.idDepart == idDepart){
      element.quantite++;
    }
  });
  contentPanier = updatedPanier;
    
    ContentPanier();
}

function ContentPanier(){ 
  
  var montrerContentInPanier;

  if(contentPanier.length != 0){
    montrerContentInPanier = `<div class="container">
                                  <div class="row">
                                    <div class="col-md-2">
                                        <span><b>idDepart</b></span>
                                    </div>
                                    <div class="col-md-2">
                                        <span><b>idCircuit</b></span>
                                    </div>
                                    <div class="col-md-2 centerText">
                                        <span><b>Quantité</b></span>
                                    </div>
                                    <div class="col-md-2 centerText">
                                        <span><b>Prix</b></span>
                                    </div>
                                    <div class="col-md-2 centerText">
                                        <span><b>Sous-Total</b></span>
                                    </div>
                                    <div class="col-md-2 centerText">
                                      <span><b>Action</b></span>
                                    </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-12">
                                      <hr style="border: 0.5px solid grey">
                                    </div>
                                  </div>
                                  </div>
                                `;
    contentPanier.forEach(function(item){ 
      sousTotal = item.quantite * item.prix;
      montrerContentInPanier += `<div class="row">
                                    <div class="col-md-2 my-1 centerText">
                                      ` + item.idDepart + `
                                    </div>
                                    <div class="col-md-2 my-1 centerText">
                                      ` + item.idCircuit + `
                                    </div>
                                    <div class="col-md-2 my-1 centerText">
                                      ` + item.quantite + `
                                    </div>
                                    <div class="col-md-2 my-1 centerText">
                                      $ ` + item.prix + `
                                    </div>                                    
                                    <div class="col-md-2 my-1 centerText">
                                      $ ` + sousTotal.toFixed(2) + `
                                    </div>
                                    <div class="col-md-2 my-1 centerText">
                                      <button type="button" class="btn btn-default" onclick='supprimer(`+ item.idDepart + `, ` + item.quantite + `, ` + item.prix + `)'><i class="fas fa-trash-alt"></i></button>
                                    </div>                                  
                                    </div>
                                  <div class="dropdown-divider"></div>`;		
    })

    montrerContentInPanier += `<div class="col-md-11 my-1" id='prixTotal'>
                                <span>Prix Total : </span>$ ` + prixTotal.toFixed(2) + `
                              </div>
                              <div class="col-md-3">
                                <button type="button" class="btn btn-success" onclick='acheter()'>Payer</button>
                              </div>
                              </div>`;
    $('#divPanier').addClass("image-panier");
  }
  else{
    montrerContentInPanier = "<h4 style='font-style: italic; text-align: center; color: grey;'>Le panier est vide...</h4>"
  }
  $('#divPanier').html(montrerContentInPanier);
  
}

