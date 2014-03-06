$(document).ready(function() {
        
    $('.categoria_menu').click(function(e) {
        e.preventDefault();
        
        $('.categoria_menu').each(function(index) {
            $(this).css('background-image',"url(/images/btn_fondo.png)");
        });
        
        $(this).css('background-image','url(/images/btn_fondo_activado.png)');
        
        url = $(this).attr('href');
        categoria_id = $(this).data('categoria');
        $.ajax({
              type: "GET",
              url:  url,
              async: true,
              data: {'categoria_id': categoria_id },                
              success: function( data ) {
                   $('#contenidocentro').empty().append(data);
                },
                error: function(error){
                    
                }
            }); 
        
    });  
});

