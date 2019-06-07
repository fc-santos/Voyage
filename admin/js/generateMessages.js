
function getMessages(nombreMessages){
    if (window.XMLHttpRequest) {
        // code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp=new XMLHttpRequest();
      } else {  // code for IE6, IE5
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
      }
      xmlhttp.onreadystatechange=function() {
        if (this.readyState==4 && this.status==200) {
            var r = this.responseText;
            messages = JSON.parse(r);
            createMessages(messages, nombreMessages);
        }
      }
    
      pagePHP = "getMessages.php";
      xmlhttp.open("GET",pagePHP,true);
      xmlhttp.send();      
}

function createMessages(messages, nombreMessagesMontres){
    //console.log(messages);
    var content = "";
    var compteur = 0;
    var compteurMessagesNonLus = 0;
    nombreMessages = messages.length;
    for(let i = 0; i < nombreMessages; i++) {
        compteur++;        

        if(messages[i].messageLu === 0){
           compteurMessagesNonLus++;
        }

        if(compteur <= nombreMessagesMontres){
            var aujourdhui = new Date();
            var messageDate = new Date(messages[i].date);
            var diffTemp;
            if(((aujourdhui - messageDate) / (1000*60)) < 60){
                diffTemp = Math.floor((aujourdhui - messageDate) / (1000*60)) + " m"
            }else if(Math.floor((aujourdhui - messageDate) / (1000*60*60)) < 24){
                diffTemp = Math.floor((aujourdhui - messageDate) / (1000*60*60)) + " h"
            }else if(Math.floor((aujourdhui - messageDate) / (1000*60*60*24)) < 31){
                diffTemp = Math.floor((aujourdhui - messageDate) / (1000*60*60*24)) + " j"
            }else {
                diffTemp = "+30 j"
            }

            var image;
            if(messages[i].role === "Admin"){
                image = `<img class="rounded-circle" src="./img/administrator.png" width="60" height="60" alt=""></img>`;
            }else{
                image = `<img class="rounded-circle" src="./img/user.png" width="60" height="60" alt=""></img>`;
            }

            if(messages[i].messageLu === 0){
                content += `<div class="makeBold">`
            }
            content += `<a class="dropdown-item d-flex align-items-center" href="./messages.php?idMessage=${messages[i].idMessage}">
                        <div class="dropdown-list-image mr-3">
                        ${image}
                        <div class="status-indicator bg-success"></div>
                        </div>
                        <div>
                        <div class="text-truncate">${messages[i].contenu}</div>
                        <div class="small text-gray-500">${messages[i].prenomUtilisateur} ${messages[i].nomUtilisateur} · ${diffTemp}</div>
                        </div>
                    </a>`;
                    if(messages[i].messageLu === 0){
                        content += `</div>`
                    }
        }
        if(nombreMessagesMontres <= 4 && compteur == 4){
            content += `<a class="dropdown-item text-center small text-gray-500" href="./messages.php">Read More Messages</a>`;
        }
    }       
    
    if(nombreMessagesMontres === 4 ){
        show4Messages(content, compteurMessagesNonLus);
    }
    else{
        show10Messages(content, compteurMessagesNonLus);
    }

}

function show4Messages(content, compteurMessagesNonLus){
    if(compteurMessagesNonLus > 4){
        compteurMessagesNonLus = 4 + "+";
    }
    document.getElementById('messageCentre').innerHTML = content;
    document.getElementById('compteurMessagesNonLus').innerHTML = compteurMessagesNonLus;
}

function show10Messages(content){
    document.getElementById('dixMessages').innerHTML = content;
}

