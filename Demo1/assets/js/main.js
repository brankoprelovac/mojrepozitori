function init(){
    proveraUnosa();
    
}

$(init);

function proveraUnosa(){
    $('#test h1').each(function(){
        var tr = $(this);
        var brojPoena = tr.attr(test1);
        
        if (brojPoena === 'Spisak unosa na racun') {
            $(tr).css('font-color', 'red');
        } else {
            $(tr).css('color', 'green');
        }
    });
}

function balans(){
    var income = $('#data-total_income');
    var revenue = $('#data-total_revenue');
    
    
    return income - revenue;
}