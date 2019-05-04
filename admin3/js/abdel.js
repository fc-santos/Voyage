 
$(document).ready(() => {

  var groupeJours = function(quantite){
    var detailsJour = `<div class="container pt-3 pb-3">`;

      for(let i = 1; i <= quantite; i++){
          detailsJour += `<h5>Jour ` + i + `:</h5>
          <div class="row mb-2">
              <div class="col-sm-12 col-md-4 mb-2">
                  <div class="form-group">
                      <label for="lieu">Lieu</label>
                      <input type="text" class="form-control lieu" id="lieu${i}" autocomplete="off" aria-describedby="textHelp" name="lieu" placeholder="Entrez un lieu">
                      <div class="pl-2" id="livesearchLieu${i}" style="min-width: 140px;position: absolute; z-index: 20; background-color: white;"></div>
                  </div>
              </div>
          </div> 
          <div class="row mb-2">
              <div class="col-sm-12 col-md-4 mb-2">
                  <div class="form-group">
                      <label for="hebergement">Hébergement</label>
                      <input type="text" class="form-control  lieuHebergement" id="hebergement${i}" autocomplete="off" aria-describedby="textHelp" name="hebergement" placeholder="Entrez un hébergement">
                      <div class="pl-2" id="livesearchhebergement${i}" style="min-width: 140px;position: absolute; z-index: 20; background-color: white;"></div>
                  </div>
              </div>
              <div class="col-sm-12 col-md-4 mb-2">
                  <div class="form-group">
                      <label for="souper">Souper</label>
                      <input type="text" class="form-control lieuSouper" id="souper${i}" aria-describedby="textHelp" placeholder="Entrez un lieu pour souper">
                  </div>
              </div>
              <div class="col-sm-12 col-md-4 mb-2">
                  <div class="form-group">
                      <label for="diner">Dîner</label>
                      <input type="text" class="form-control lieuDiner" id="diner${i}" aria-describedby="textHelp" placeholder="Entrez un lieu pour dîner">             
                  </div>
              </div>                
          </div>
          <div class="row">
              <div class="col-sm-12 col-md-4 mb-2">
                  <div class="form-group">
                      <label for="typeHebergement">Type Hébergement</label>
                      <input type="text" class="form-control typeHebergement" id="typeHebergement${i}" aria-describedby="textHelp" name="typeHebergement" placeholder="Entrez le type d'hébergement">
                  </div>
              </div>
              <div class="col-sm-12 col-md-8 mb-2">
                  <div class="form-group">
                      <label for="activites">Activités</label>
                      <input type="text" class="form-control jourActivites" id="activites${i}" aria-describedby="textHelp" name="activites" placeholder="Entrez des activités">
                  </div>
              </div>
          </div>`;
          if(i != quantite) {
              detailsJour += `<hr>`;
          } 
      }
      detailsJour += `</div>`;
      return detailsJour;
  }

  $('#detailsJours').html(groupeJours(1));

  $("#joursEtape").on("input", function(){
    if($('#joursEtape').val() < 1) {
        $('#joursEtape').val() = 1;
    }
    let jours = $('#joursEtape').val(); 
    $('#detailsJours').html(groupeJours(jours));
  });

  lieu = null;

  $('#lieu1').on('input', (e) => {
    let searchText = $('#lieu1').val();
    showResult(searchText,'livesearchLieu');
    e.preventDefault();
  });

  $('#hebergement1').on('input', (e) => {
    lieu = $('#lieu1').val();
    let searchText = $('#hebergement1').val();
    showResultParLieu(searchText,'livesearchhebergement', lieu);        
    e.preventDefault();
  });

  $('#rechercheManger').on('input', (e) => {
    let searchText = $('#rechercheManger').val();
    showResult(searchText,'livesearchManger');
    e.preventDefault();
  });

  function showResult(str,str1) {
    id = "#" + str1 + "1";
    if (str.lenght==0) { 
      $(id).html("")
      return;
    }
    if (window.XMLHttpRequest) {
      // code for IE7+, Firefox, Chrome, Opera, Safari
      xmlhttp=new XMLHttpRequest();
    } else {  // code for IE6, IE5
      xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange=function() {
      if (this.readyState==4 && this.status==200) {
        $(id).html(this.responseText);
      }
    }

    pagePHP = "includes/" + str1 + 1 + ".php?q=" + str;
    xmlhttp.open("GET",pagePHP,true);
    xmlhttp.send();
  }

  function showResultParLieu(str,str1,str2) {
    id = "#" + str1 + "1";
    if (str.lenght==0) { 
      $(id).html("")
      return;
    }
    if (window.XMLHttpRequest) {
      // code for IE7+, Firefox, Chrome, Opera, Safari
      xmlhttp=new XMLHttpRequest();
    } else {  // code for IE6, IE5
      xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange=function() {
      if (this.readyState==4 && this.status==200) {
        $(id).html(this.responseText);
      }
    }

    pagePHP = "includes/" + str1 + 1 + ".php?q=" + str + "&r=" + str2;
    xmlhttp.open("GET",pagePHP,true);
    xmlhttp.send();
  }
});

function prendreLaValeur(element,string,cible){
  id = '#' + string;

  $(id).html(null);
  $(cible).val(element.innerHTML);
}

function ajouterJours(){
  var joursEtape = document.getElementsByClassName("lieu");

  for(i = 0; i < joursEtape.length; i++){  
  
  if (window.XMLHttpRequest) {
      xmlhttp=new XMLHttpRequest();
    } else {
      xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }   
  
    pagePHP = "includes/getLastRecordEtape.php?lieu=" + joursEtape[i].value;
    xmlhttp.open("GET",pagePHP,true);
    xmlhttp.send();
  }
}
