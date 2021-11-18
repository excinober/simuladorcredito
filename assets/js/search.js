$(buscar_datos());

function buscar_datos(consulta){
    
         $.ajax({
                type: 'POST',
                url: "controllers/controller",
                data: { consulta:consulta },
                dataType: 'html',
         })
               
                .done(function(respuesta) {
                        $("#datos").load(http://localhost/marketplace/);
                  
                })
                .fail(function() {
                   console.log("error");
                })
    
}


$(document).on('keyup', '#busqueda',function(){
    
   var valor = $(this).val();
    if(valor != ""){
        
        buscar_datos(valor);
        
        
    }else {
        
        
        buscar_datos();
        
    }
    
    
    
});