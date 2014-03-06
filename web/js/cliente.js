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

function inicializarGeocomplete()
{
    var i= 0;
    $(".geocomplete").each(function(e) {        
       i++; 
       
       id = $(this).data('id'); 
       if(i === 1) {
          
        $(this).geocomplete({
             map: "#map_canvas_"+id,        
             markerOptions: {
                 draggable: true
             }
         });
       }

        $(this).on("geocode:dragged", function(event, latLng) {
            $("#latitud_"+id).val(latLng.lat());
            $("#longitud_"+id).val(latLng.lng());
        });
        
        $(this).on("geocode:result", function(event, result) {
            
            latLng = result.geometry.location;
            $("#latitud_"+id).val(latLng.lat());
            $("#longitud_"+id).val(latLng.lng());
            console.log(latLng.lat());
        });  
     

    });  
    
    if(i === 1) { 
        $(".buscar_direccion").click(function() {

            id = $(this).data('id');
            $('#localizacion_'+id).slideDown('fast', function() {
               var map = $("#geocomplete_"+id).geocomplete("map");


                google.maps.event.trigger(map, "resize");
                window.setTimeout(function() {
                    map.setCenter(new google.maps.LatLng($("#latitud_"+id).val(), $("#longitud_"+id).val()));
                }, 20);
            });
            $("#geocomplete_"+id).trigger("geocode");

        });     
    }
}

$(document).ready(function() {
        
    $(".agregar_domicilio").click(function(e) {
        
        e.preventDefault();    
        
        domicilio = $('<tr class="domicilio"></tr>');   
        contenedor = $('<td height="103" align="center" bgcolor="#f1f1f1"></td>');
        calle = $('.domicilio_calle').last().clone();
        dir = $('.domicilio_direccion').last().clone();
        esq = $('.domicilio_esquina').last().clone();
        datoDomicilio = $('<input name="domicilios[]" value="0" type="hidden" />');
        contenedor.append(calle).append(dir).append(esq).append(datoDomicilio);
        domicilio.append(contenedor);
        domicilio.insertAfter( $('.domicilio').last());
        
        cantidad = $('.domicilio').length;
        $('.geocomplete').last().attr('id', 'geocomplete_'+cantidad).attr('value', '');
        $('.latitud').last().attr('id', 'latitud_'+cantidad);
        $('.longitud').last().attr('id', 'longitud_'+cantidad);     
        //$('.localizacion_container').last().attr('id', 'localizacion_'+cantidad).hide();  
        //$('.buscar_direccion').last().data('id', cantidad).hide(); 
        //$('.map_canvas').last().attr('id', 'map_canvas_'+cantidad);
        $('input[name="esquina[]"]').last().attr('value','');
        $('input[name="localidad[]"]').last().attr('value','');
        $('textarea[name="comentario[]"]').last().empty();
        $('input[name="piso[]"]').last().attr('value','');
        $('input[name="dpto[]"]').last().attr('value','');
        
        
        inicializarGeocomplete();

    });     
    
    $(".eliminar_telefono").click(function(e) {
        e.preventDefault();  
        $(this).parents('.telefono').remove();
    });     
    
    $(".iniciar_comanda").click(function(e) {
        e.preventDefault();
        $('#iniciar_comanda').val(1);
        $('.enviar').trigger('click');
    });    
        
    $(".agregar_telefono").click(function(e) {        
        e.preventDefault();
                
        $('<tr class="telefono"></tr>').html('<td height="29" align="left" class="txt_gris12_bold">Tel.</td>'+
                            '<td align="left"><input name="codigo[]" type="text" class="txt_gris12"  value="011" size="4" />'+
                                '<input name="numero[]" type="text" class="txt_gris12" id="textfield4" size="30" />'+
                                '<span class="txt_gris12_bold">*</span></td>'+
                            '<td height="29" align="left" class="txt_gris12_bold">Cel.</td>'+
                            '<td align="left"><input name="celular[]" type="text" class="txt_gris12" id="textfield6" size="40" />'+
                                '<span class="txt_gris12_bold">*</span></td>'+
                            '<td align="left"><table width="133" border="0" align="right" cellpadding="3" cellspacing="0">'+
                                   ' <tr>'+
                                       
                                                '<td width="13"><img src="/images/icono_eliminar_rojo.png" alt="" width="12" height="12" /></td>'+
                                                '<td width="108"><a href="" class="txt_negro12_bold eliminar_telefono"> Eliminar Tel&eacute;fono</a></td>'+
                              
                                    '</tr>'+
                                '</table>'+
                                '<span class="txt_rojo16"></span></td>'         
            
        ).insertAfter($('.telefono').last())  ;
            
    $(".eliminar_telefono").click(function(e) {
        e.preventDefault();  
        $(this).parents('.telefono').remove();
    });      
      

    }); 
    
    inicializarGeocomplete();      

  
    
    //google.maps.event.addDomListener(window, 'load', initialize);   
});
