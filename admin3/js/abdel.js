 
$(document).ready(() => {
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

    
    /*let searchText = $('#lieu2').val();
    showResult(searchText,'livesearchLieu');
    e.preventDefault();*/  
  });

  
  /*<a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="dropdown-list-image mr-3">
                    <img class="rounded-circle" src="https://source.unsplash.com/fn_BT9fwg_E/60x60" alt="">
                    <div class="status-indicator bg-success"></div>
                  </div>
                  <div class="font-weight-bold">
                    <div class="text-truncate">Hi there! I am wondering if you can help me with a problem I've been having.</div>
                    <div class="small text-gray-500">Emily Fowler · 58m</div>
                  </div>
                </a>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="dropdown-list-image mr-3">
                    <img class="rounded-circle" src="https://source.unsplash.com/AU4VPcFN4LE/60x60" alt="">
                    <div class="status-indicator"></div>
                  </div>
                  <div>
                    <div class="text-truncate">I have the photos that you ordered last month, how would you like them sent to you?</div>
                    <div class="small text-gray-500">Jae Chun · 1d</div>
                  </div>
                </a>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="dropdown-list-image mr-3">
                    <img class="rounded-circle" src="https://source.unsplash.com/CS2uCrpNzJY/60x60" alt="">
                    <div class="status-indicator bg-warning"></div>
                  </div>
                  <div>
                    <div class="text-truncate">Last month's report looks great, I am very happy with the progress so far, keep up the good work!</div>
                    <div class="small text-gray-500">Morgan Alvarez · 2d</div>
                  </div>
                </a>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="dropdown-list-image mr-3">
                    <img class="rounded-circle" src="https://source.unsplash.com/Mv9hjnEUHR4/60x60" alt="">
                    <div class="status-indicator bg-success"></div>
                  </div>
                  <div>
                    <div class="text-truncate">Am I a good boy? The reason I ask is because someone told me that people say this to all dogs, even if they aren't good...</div>
                    <div class="small text-gray-500">Chicken the Dog · 2w</div>
                  </div>
                </a>
                <a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a>*/

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

  /*$('#rechercheManger').on('input', (e) => {
    let searchText = $('#rechercheManger').val();
    showResult(searchText,'livesearchManger');
    e.preventDefault();
  });*/

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

/*function createMessages(){
  var text = `<a class="dropdown-item d-flex align-items-center" href="#">
                <div class="dropdown-list-image mr-3">
                  <img class="rounded-circle" src="https://source.unsplash.com/fn_BT9fwg_E/60x60" alt="">
                  <div class="status-indicator bg-success"></div>
                </div>
                <div class="font-weight-bold">
                  <div class="text-truncate">Hi there! I am wondering if you can help me with a problem I've been having.</div>
                  <div class="small text-gray-500">Emily Fowler · 58m</div>
                </div>
              </a>
              <a class="dropdown-item d-flex align-items-center" href="#">
                <div class="dropdown-list-image mr-3">
                  <img class="rounded-circle" src="./img/administrator.png" width="60" height="60" alt="">
                  <div class="status-indicator"></div>
                </div>
                <div>
                  <div class="text-truncate">I have the photos that you ordered last month, how would you like them sent to you?</div>
                  <div class="small text-gray-500">Jae Chun · 1d</div>
                </div>
              </a>
              <a class="dropdown-item d-flex align-items-center" href="#">
                <div class="dropdown-list-image mr-3">
                  <img class="rounded-circle" src="./img/user.png" width="60" height="60" alt="">
                  <div class="status-indicator bg-warning"></div>
                </div>
                <div>
                  <div class="text-truncate">Last month's report looks great, I am very happy with the progress so far, keep up the good work!</div>
                  <div class="small text-gray-500">Morgan Alvarez · 2d</div>
                </div>
              </a>
              <a class="dropdown-item d-flex align-items-center" href="#">
                <div class="dropdown-list-image mr-3">
                  <img class="rounded-circle" src="https://source.unsplash.com/Mv9hjnEUHR4/60x60" alt="">
                  <div class="status-indicator bg-success"></div>
                </div>
                <div>
                  <div class="text-truncate">Am I a good boy? The reason I ask is because someone told me that people say this to all dogs, even if they aren't good...</div>
                  <div class="small text-gray-500">Chicken the Dog · 2w</div>
                </div>
              </a>
              <a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a>`;

  $('#messageCentre').html(text);
}

createMessages();  */


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

