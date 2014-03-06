function initialize() {
    var mapOptions_small = {
        zoom: 16,
        center: new google.maps.LatLng(lat, lon),
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        mapTypeControl: false,
        panControl: false,
        scaleControl: false,
        streetViewControl: false,
        zoomControl: true,
        draggable: true
    };
  
    map = new google.maps.Map(document.getElementById('map_canvas'),
            mapOptions_small);

    var marker = new google.maps.Marker({
        position: new google.maps.LatLng(lat, lon),
        map: map
    });
}

    
function validarPorciones()
{
    if(cantidadPorcion > 0){
        for(i = 1; i <= cantidadPorcion; i++ ){                
           todos = $('input[name="producto_'+i+'[]"]:checked:enabled');
           if(todos.length === 0){
               return false;
           }

        }
        return true;
    }

    return false;

}   

$(document).ready(function() {
    
    $('.pizza_chica').click(function(e) {
        e.preventDefault();
        $(this).parent().css('background-color', '#afafaf');       
        $('.pizza_grande').parent().css('background-color', '#f1f1f1');
        
        $('.para_grande').hide();
        $('#completar_pizzas').empty();
        $('#tipo_pizza').val(2);
        imagenPizzasSeleccionadas(5);
    }); 
    
    $('.pizza_grande').click(function(e) {
        e.preventDefault();
        $(this).parent().css('background-color', '#afafaf');       
        $('.pizza_chica').parent().css('background-color', '#f1f1f1');
        
        $('.para_grande').show();
        $('#completar_pizzas').empty();
        $('#tipo_pizza').val(1);
        imagenPizzasSeleccionadas(5);
    
    });    
    
    $('.porcion_pizza').click(function(e) {
        e.preventDefault();
        porcion = $(this).data('porcion');   
        cantidadPorcion = porcion;
        imagenPizzasSeleccionadas(porcion);
        if($(this).hasClass('entera')){
           $('#pizza_entera').show(); 
        } else {
           $('#pizza_entera').hide();  
        }
        
        $.ajax({
              type: "GET",
              url:  urlCompletarPizzas,
              async: true,
              data: {'porcion': porcion },                
              success: function( data ) {
                   $('#completar_pizzas').empty().append(data);
                },
                error: function(error){
                    //$('#buscarcliente').empty().html('<span style="margin-left:120px;" class="txt_gris12" >Lo sentimos, ha ocurrido un error</span>');
                }
            }); 
    });
    
    $('.unidades').change(function(e) {
        total = calcularTotalUnidades();
        $('#totalUnidades').text(total);
    });    
    
});

function calcularTotalUnidades()
{
   var total = 0;
   $('.unidades').each(function(e) {  
       if( parseInt( $(this).val()) > 0)
           total += parseInt(  $(this).val() );
   });
   
   return total;
}

function imagenPizzasSeleccionadas(porcion)
{
    for(var i = 1; i <= 4; i++){
       $('#imagen_porcion_'+i+'_over').hide();
       $('#imagen_porcion_'+i).show();
    }
    
    $('#imagen_porcion_'+porcion).hide();
    $('#imagen_porcion_'+porcion+'_over').show();
  
}