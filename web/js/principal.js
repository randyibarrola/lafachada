function actualizarEstadosComanda(){
    $('#loading_actualizar_estados').show();
    
    $.ajax({
      type: "GET",
      url:  urlActualizarEstados,
      async: true,
      dataType: 'json',      
      data: {'estado': 'actualizar' },         
      success: function( data ) {
            $('#loading_actualizar_estados').hide();
            $('#comandas_en_proceso').empty().text(data.comandasEnProceso);
            $('#comandas_demoradas').empty().text(data.comandasDemoradas);
        },
        error: function(error){

        }
    }); 
}

function redirigir()
{
    location.href = path;
}

function tiempo() {
       $.ajax({
      type: "GET",
      url:  urlTiempo,
      async: true,
      dataType: 'json',          
      success: function( data ) {
            redirigir();
        },
        error: function(error){

        }
    }); 
}

$(document).ready(function() {
    
    if(!rolAdmin){
        $('#seccionesadmin').css('width',880);
        $('#contenidogeneraladmin').css('width',880);
    }
    
    console.log(rolAdmin);
    
    //para menu superior
    $('.menu_superior').each(function() {
        var href = location.href;
        if(href.indexOf($(this).attr('data-path')) != -1) {
            $(this).parent().removeClass('btnsecciones');
            $(this).parent().addClass('btnseccionesact');
        }
        else{
            $(this).parent().removeClass('menu_superior');
        }
           
    });
    
    $('#clearTitulo').click(function() {
        $('#buscarcliente').hide();  
        $(this).css('display', 'none');
        $('#buscador').val('');
    });    
    
    //para buscador superior
    $('#buscador').keyup(function(e) { 
        var texto = $(this).val();        
        if(texto.length >= 2){
            $('#buscarcliente').html(
                    '<table width="100%" border="0" cellpadding="5" cellspacing="0" class="btn_rojo12_bold">'+
                        '<tr>'+
                            '<td align="center"><img src="/images/loading_2.gif" /></td>'+
                        '</tr>'+
                    '</table>'  
            ).show();            
            $.ajax({
              type: "POST",
              url:  $('#buscarcliente').data('url'),
              async: true,
              data: {'texto': texto},                
              success: function( data ) {
                    $('#buscarcliente').empty().html(data);
                    $('#clearTitulo').css('display','inline');
                },
                error: function(error){
                    $('#buscarcliente').empty().html('<span style="margin-left:120px;" class="txt_gris12" >Lo sentimos, ha ocurrido un error</span>');
                }
            });            
        }
           
    });    

    $('.enviar').click(function(e) {
        e.preventDefault();
        destino = $(this).data('destino');
        estado = $(this).data('estado');
        accion = $(this).data('accion');
        if($('.formulario').validationEngine('validate') === true){
            if(destino === '_blank'){
                $('.formulario').attr('target', '_blank');
            }     
            if(accion === "editar"){
                $('#imprimir').val('no');
            }
            if($('.formulario').submit())
                if(destino === '_blank' && estado === 'crear') {                  
                    tiempo();                   
                }
        }
        
    });
    
    $('.sucursal').change(function() {
        $('#sucursal_loading').show();
        var id = $(this).val() > 0 ? $(this).val() : 0; 
        var url = $(this).data('url');  
        var urlDetalle = $(this).data('urldetalle'); 

        $.ajax({
              type: "GET",
              url:  url,              
              data: {'sucursal_id': id },  
              dataType: 'html',
              success: function( data ) {
                    $('.sucursales_rol').empty().html(data); 
                    $.ajax({
                        type: "POST",
                        url:  urlDetalle,                        
                        data: {'sucursal_id': id },  
                        dataType: 'html',
                        success: function( data ) {
                              $('.estado_comandas').empty().html(data);
                             $('#sucursal_loading').hide();
                          },
                          error: function(error){
                                 $('#sucursal_loading').hide();
                          }
                      });

                },
                error: function(error){
                     $('#sucursal_loading').hide();
                }
            });   
            
         
    });     
    
    $('.en_proceso').click(function(e) {
        e.preventDefault();    
        $('#comandademorada').hide();        

        if($('#comandaproceso').css('display') !== 'none'){
            $('#comandaproceso').hide();
        } else {
            $('#comandaproceso').show();
        }           
       
    });     
    
    $('.demorada').click(function(e) {
        e.preventDefault();    
        $('#comandaproceso').hide();        

        if($('#comandademorada').css('display') !== 'none'){
            $('#comandademorada').hide();
        } else {
            $('#comandademorada').show();
        }           
       
    });  
    
    $('.cancelar_comanda').click(function() {
        var id = $(this).data('comanda'); 
        var url = $(this).data('url');  
        $.ajax({
              type: "GET",
              url:  url,
              async: true,
              /*data: {'categoria_id': categoria_id },    */            
              success: function( data ) {
                      $('#comanda_'+id).hide();
                      actualizarEstadosComanda(); 
                },
                error: function(error){
                    
                }
            });         
    }); 
 
        
    
    $(".mapa_cliente").click(function(e) {
        e.preventDefault();
        html = '<iframe class="iframe" width="425" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com.ar/maps?f=q&amp;source=s_q&amp;hl=es&amp;geocode=&amp;z=16&amp;output=embed&amp;ll='+$(this).data('lat')+','+$(this).data('lon')+'"></iframe><br /><small>';
        $(html).insertAfter($("#tabla_mapa"));
        //window.open(url);
        $('#mapa').show();
    });  
    
    $(".cerrar_mapa").click(function(e) {
        e.preventDefault();        
        $('#mapa').hide();
        $('.iframe').remove();
    });     
    
    $('.enviar_comanda').click(function() {
        var id = $(this).data('comanda'); 
        var url = $(this).data('url');  
        var comodin = $(this).data('comodin'); 
        if($('#repartidor_'+comodin+'_'+id).val() > 0){
            $.ajax({
                  type: "GET",
                  url:  url,
                  async: true,
                  dataType: 'json',
                  data: {'repartidor_id': $('#repartidor_'+comodin+'_'+id).val() },                
                  success: function( data ) {
                        $('#comanda_'+id).hide();
                        $('#estado_'+id).text(data.estado);

                        actualizarEstadosComanda();                    
                    },
                    error: function(error){

                    }
                });  
        }
        else{
            alert('Debe seleccionar un repartidor');
            $(this).attr('checked', false);
        }
    });  
    
    
 if(iniciarDataTable)  { 
  var asInitVals = new Array();  
   var oTable = $('#dataTable').dataTable( {        
        "bFilter": false,
        "bLengthChange": true,
        "sDom": '<"top">rt<"bottom"flp>i<"clear">',
        "sPaginationType": "full_numbers",
        "oLanguage": {
            "sLengthMenu": "Mostrando _MENU_ registros por página",
            "sZeroRecords": "<span class='txt_gris12'>Sin resultados - lo sentimos</span>",
            "sInfo": "Mostrando _START_ a _END_ de _TOTAL_ registros",
            "sInfoEmpty": "Mostrando 0 a 0 de 0 registros",
            "sInfoFiltered": "(filtrado de _MAX_ total registros)"
        },
        "oPaginate":{
           "sNext": "Siguiente",  
           "sPrevious": "Anterior"
        }
        
    });
    
    $("tfoot input").keyup( function () {
        /* Filter on the column (the index) of this element */
        oTable.fnFilter( this.value, $("tfoot input").index(this) );
    } );
    
    /*
	 * Support functions to provide a little bit of 'user friendlyness' to the textboxes in 
	 * the footer
	 */
	$("tfoot input").each( function (i) {
		asInitVals[i] = this.value;
	} );
	
	$("tfoot input").focus( function () {
		if ( this.className == "search_init" )
		{
			this.className = "";
			this.value = "";
		}
	} );
	
	$("tfoot input").blur( function (i) {
		if ( this.value == "" )
		{
			this.className = "search_init";
			this.value = asInitVals[$("tfoot input").index(this)];
		}
	} );
     
var asInitVals = new Array();  
   var oTable = $('#dataTableOculto').dataTable( {  
        "aaSorting": [[ 0, "desc" ]],
        "aoColumnDefs": [
                        { "bSearchable": false, "bVisible": false, "aTargets": [ 0 ] }                       
                    ] ,
        "bFilter": false,
        "bLengthChange": true,
        "sDom": '<"top">rt<"bottom"flp>i<"clear">',
        "sPaginationType": "full_numbers",
        "oLanguage": {
            "sLengthMenu": "Mostrando _MENU_ registros por página",
            "sZeroRecords": "<span class='txt_gris12'>Sin resultados - lo sentimos</span>",
            "sInfo": "Mostrando _START_ a _END_ de _TOTAL_ registros",
            "sInfoEmpty": "Mostrando 0 a 0 de 0 registros",
            "sInfoFiltered": "(filtrado de _MAX_ total registros)"
        },
        "oPaginate":{
           "sNext": "Siguiente",  
           "sPrevious": "Anterior"
        }
        
    });     
     
 } 

});


