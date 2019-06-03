var allMessages = null;

console.log('ok');

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
            console.log(messages);
            createMessages(messages);
        }
      }
    
      pagePHP = "getMessages.php";
      xmlhttp.open("GET",pagePHP,true);
      xmlhttp.send();      
}

function createMessages(messages){
    var content = "";
    var compteur = 0;
    //var row = 1;
    allMessages = messages;
    messages.forEach(element => {
        compteur++;
        var auj = new Date();
        var messageDate = new Date(element.date);
        var diffTemp;
        if(Math.floor((auj - messageDate) / (1000*60*60*24)) < 1){
            diffTemp = Math.floor((auj - messageDate) / (1000*60*60))
        }else if(Math.floor((auj - messageDate) / (1000*60*60*24)) > 31){
            diffTemp = Math.floor((auj - messageDate) / (1000*60*60*24*365))
        }else{
            diffTemp = Math.floor((auj - messageDate) / (1000*60*60*24))
        }


        content += `<a class="dropdown-item d-flex align-items-center" href="#">
        <div class="dropdown-list-image mr-3">
          <img class="rounded-circle" src="./img/administrator.png" width="60" height="60" alt="">
          <div class="status-indicator bg-success"></div>
        </div>
        <div>
          <div class="text-truncate">${element.contenu}</div>
          <div class="small text-gray-500">${element.prenomUtilisateur} ${element.nomUtilisateur} · ${diffTemp}</div>
        </div>
      </a>`
        })

        content += `<a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a>`
    
    showMessages(content);
}

function showMessages(content){
    document.getElementById('messageCentre').innerHTML = content;
}

getMessages();