$('#valor, #imp1, #imp2').keyup(function () {
    var tipo = $('#tipo').val() * 1; 
    var valor = $('#valor').val() * 1;
    var imp1 = $('#imp1').val() * 1; 
    var imp2 = $('#imp2').val() * 1;  
    if(tipo == 3){
        
        $('#iva').val(valor *.13)
       
        var x = ((valor *.13) + valor + imp1 + imp2 )
        $('#total').val((valor *.13) + valor + imp1 + imp2 )
    }
    console.log(tipo, x);

});