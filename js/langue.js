var langue;

function traduire(fichierXML){
    var codes=fichierXML.getElementsByTagName("langue")[0];
    var elem=codes.firstChild;
    
    while(elem!=null){
       if (elem.nodeType==3)
           elem=elem.nextSibling;
       if (elem!=null){
           code=elem.nodeName;
           contenu=elem.firstChild.nodeValue;
           document.getElementById(code).innerHTML=contenu;
           elem=elem.nextSibling;
       }
    }
   }

   function obtenirXML(langue){
   localStorage.setItem("langue", langue);

   var fichier="langues/"+langue+".xml";
   var request = $.ajax({
                    type:"GET",
                    url:fichier,
                    dataType:"xml"});
       request.done(function(fichierXML){
           traduire(fichierXML);
       })
       request.fail(function(){
                      
       });
   }
   
   function obtenirLangue(){
    if(localStorage.getItem("langue") != null){
        localStorage.getItem("langue")
    }else{
        localStorage.setItem("langue", 'fr');
    }
    
    obtenirXML(localStorage.getItem("langue"));
   }