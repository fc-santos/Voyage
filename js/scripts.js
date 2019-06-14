function fermer(){
    $(".fermerNewsletters").css("display","none");
}

function ouvrirMessage(){
    $(".fermerNewsletters").css("display","block");
}

$(window).unload(function(){
    localStorage.clear();
  });