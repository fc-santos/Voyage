var allMessages = null;

function getMessages(){
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
            createMessages(messages);
        }
      }
    
      pagePHP = "getMessages.php";
      xmlhttp.open("GET",pagePHP,true);
      xmlhttp.send();      
}

function createMessages(messages){
    console.log(messages);
    var content = "";
    var compteur = 0;
    var compteurMessagesNonLus = 0;
    //var row = 1;
    allMessages = messages;
    nombreMessages = messages.length;
    for(let i = 0; i < nombreMessages; i++) {
        compteur++;        

        if(messages[i].messageLu === 0){
           compteurMessagesNonLus++;
        }

        if(compteur <= 4){
            var auj = new Date();
            var messageDate = new Date(messages[i].date);
            var diffTemp;
            if(((auj - messageDate) / (1000*60)) < 60){
                diffTemp = Math.floor((auj - messageDate) / (1000*60)) + "m"
            }else if(Math.floor((auj - messageDate) / (1000*60*60)) < 24){
                diffTemp = Math.floor((auj - messageDate) / (1000*60*60)) + "h"
            }else if(Math.floor((auj - messageDate) / (1000*60*60*24)) < 31){
                diffTemp = Math.floor((auj - messageDate) / (1000*60*60*24)) + "j"
            }else {
                diffTemp = "+30j"
            }

            var image;
            if(messages[i].role === "Admin"){
                image = `<img class="rounded-circle" src="./img/administrator.png" width="60" height="60" alt=""></img>`;
            }else{
                image = `<img class="rounded-circle" src="./img/user.png" width="60" height="60" alt=""></img>`;
            }

            content += `<a class="dropdown-item d-flex align-items-center" href="#">
                        <div class="dropdown-list-image mr-3">
                        ${image}
                        <div class="status-indicator bg-success"></div>
                        </div>
                        <div>
                        <div class="text-truncate">${messages[i].contenu}</div>
                        <div class="small text-gray-500">${messages[i].prenomUtilisateur} ${messages[i].nomUtilisateur} · ${diffTemp}</div>
                        </div>
                    </a>`;
        }
        if(compteur == 4){
            content += `<a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a>`;
        }
    }       
    
    showMessages(content, compteurMessagesNonLus);
}

function showMessages(content, compteurMessagesNonLus){
    if(compteurMessagesNonLus > 4){
        compteurMessagesNonLus = 4 + "+";
    }
    document.getElementById('messageCentre').innerHTML = content;
    document.getElementById('compteurMessagesNonLus').innerHTML = compteurMessagesNonLus;
}

getMessages();