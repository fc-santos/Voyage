   
$("#joursEtape").on("input", function(){
    let jours = $('#joursEtape').val();
    detailsJour = '';
    for(let i = 1; i <= jours; i++){
        detailsJour += '<div style="height:50px; border: 1px solid red;">fggfgfgfg</div>';
    }
    $('#detailsJours').html(detailsJour);
});