   
$("#joursEtape").on("input", function(){
    if($('#joursEtape').val() < 1) {
        $('#joursEtape').val() = 1;
    }

    let jours = $('#joursEtape').val();
    detailsJour = `<div class="container pt-3 pb-3">`;

    for(let i = 1; i <= jours; i++){
        detailsJour += `<div class="row mb-2">
                            <div class="col-sm-12 col-md-4 mb-2">
                            One of three columnsOne of three columnsOne of three columnsOne of three columns
                            </div>
                            <div class="col-sm-12 col-md-4 mb-2">
                            One of three columnsOne of three columnsOne of three columnsOne of three columns
                            </div>
                            <div class="col-sm-12 col-md-4 mb-2">
                            One of three columnsOne of three columnsOne of three columnsOne of three columns
                            </div>
                        </div>`;
        if(i != jours) {
            detailsJour += `<hr>`;
        } 
    }

    detailsJour += `    
    </div>`;
    $('#detailsJours').html(detailsJour);
});