 
$(document).ready(() => {
  $('input[type=radio][name=inlineRadioOptions]').click(function() {
    if (this.value == 'creerNouveau') {
      $('#creerAdminFromMembres').addClass('invisible');
      $('#creerAdminANouveau').removeClass('invisible invisible2');

    }
    else if (this.value == 'useMembres') {
      $('#creerAdminANouveau').addClass('invisible');
      $('#creerAdminANouveau').removeClass('visible2');
      $('#creerAdminFromMembres').removeClass('invisible invisible2');
    }
  });

  lieu = null;

  $('#lieu1').on('input', (e) => {
    $('#idLieuChoisi').removeAttr("value");
    $('#activites1').val("");
    $('#hebergement1').val("");
    $('#dinner1').val("");
    $('#souper1').val("");
    let searchText = $('#lieu1').val();
    showResult(searchText,'livesearchLieu');
    e.preventDefault();
  });

  $('#lieu1').on('change', (e) => {
    $('#activite1').val("");
    $('#hebergement1').val("");
    $('#dinner1').val("");
    $('#souper1').val("");
  });

  $('#circuit1').on('input', (e) => {
    $('#idCircuitChoisi').removeAttr("value");

    let searchText = $('#circuit1').val();
    showResult(searchText,'livesearchCircuit');
    e.preventDefault();
  });

  $('#hebergement1').on('input', (e) => {
    lieu = $('#lieu1').val();
    let searchText = $('#hebergement1').val();
    showResultParLieu(searchText,'livesearchhebergement', lieu);        
    e.preventDefault();
  });

  $('#dinner1').on('input', (e) => {
    lieu = $('#lieu1').val();
    let searchText = $('#dinner1').val();
    showResultParLieu(searchText,'livesearchdinner', lieu);        
    e.preventDefault();
  });

  $('#souper1').on('input', (e) => {
    lieu = $('#lieu1').val();
    let searchText = $('#souper1').val();
    showResultParLieu(searchText,'livesearchsouper', lieu);        
    e.preventDefault();
  });

  $('#activites1').on('input', (e) => {
    lieu = $('#lieu1').val();
    let searchText = $('#activites1').val();
    showResultParLieu(searchText,'livesearchactivites', lieu);        
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

function prendreLaValeur(element,string,cible,idLieu=0){
  id = '#' + string;

  $(id).html(null);
  $(cible).val(element.innerHTML);
  console.log(element.innerHTML + ", " + string + ", " + cible + "," + idLieu);

  if(cible === "#lieu1"){
    $('#idLieuChoisi').val(idLieu);
  }
  if(cible === "#circuit1"){
    $('#idCircuitChoisi').val(idLieu);
  }
}



