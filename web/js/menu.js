var categ_id = 0;
var subcategoria_id = 0;

function ActualizarLista(){
    $.ajax({
    type: "POST",
    url:  url_lista,
    async: true,    
    dataType: "html",
    success: function( data ) { 
            $('#detalleLista').empty().html(data);
      },
      error: function(error){

      }
  });  
}

$(document).ready(function() {
    
    $(".agregar_categoria").click(function(e) {
        e.preventDefault();  
        categ_id = 0;
        $('#nueva_categoria').slideDown('fast');
    }); 
    
    $(".editar_categoria").click(function(e) {
        e.preventDefault();  
        if($('#categoria').val() > 0) {
          $('#nueva_categoria').slideDown('fast');  
          $('#nueva_categoria_nombre').val($('#categoria option:selected').text());
          categ_id = $('#categoria').val();
        }
        
    });     
    
    $(".agregar_subcategoria").click(function(e) {
        e.preventDefault();  
        subcategoria_id = 0;
        
            if( $('.complemento').length === 0  )
                $('<td class="complemento"></td>').insertBefore($('#nueva_subcategoria'));

            $('#nueva_subcategoria').slideDown('fast');
        
    }); 
    
    $(".editar_subcategoria").click(function(e) {
        e.preventDefault();  
        if($('#subcategoria').val() > 0) {
            if( $('.complemento').length === 0  )
                $('<td class="complemento"></td>').insertBefore($('#nueva_subcategoria'));
            
            $('#nueva_subcategoria_nombre').val($('#subcategoria option:selected').text());
            $('#nueva_subcategoria').slideDown('fast');
            subcategoria_id = $('#subcategoria').val();
        }
    });     
    
    $(".categoria").change(function(e) {
        e.preventDefault();  
        $('.ajaxLoading').show();
        valor = $(this).val();
        $.ajax({
            type: "POST",
            url:  url_subcategorias,
            async: true,
            data: {'categoriaId': valor},  
            dataType: "json",
            success: function( data ) { 
               $('.ajaxLoading').hide();
               $('.subcategoria').empty(); 
               if(data.length !== 0){
                for(i = 0; i < data.length; i++){  
                    $('.subcategoria').append('<option value="'+ data[i]['id'] +'">'+data[i]['nombre']+'</option>');
                }
               } else {
                    //$('.subcategoria').append('<option value="0">Sin subcategorías</option>');
               }
              },
              error: function(error){

              }
          });        
    });  
    
    $(".nueva_categoria").click(function(e) {
        e.preventDefault();  
        nombre = $('#nueva_categoria_nombre').val();
        if(nombre.length > 0){
            $('.ajaxLoading').show();
            url = $(this).data('url');
            $.ajax({
                type: "POST",
                url:  url,
                async: true,
                data: {'nombre': nombre, 'id': categ_id},  
                dataType: "json",
                success: function( data ) { 
                   $('.ajaxLoading').hide();                   
                   if(data.resultado === 'OK'){
                       if(categ_id == 0) {
                            $('.categoria').append('<option value="'+ data.id +'">'+data.nombre+'</option>');

                       } else {
                           $("#categoria option[value='"+categ_id+"']").text(data.nombre);
                       }
                        $('#nueva_categoria_nombre').val('');
                        $('#nueva_categoria').slideUp('fast');  
                        ActualizarLista();
                   
                   } else {
                        alert('Ha ocurrido un error, inténtelo nuevamente');
                   }
                  },
                  error: function(error){

                  }
              });  
        } else {
            alert('Debe especificar un nombre de categoría');
        }
    });    
    
    $(".nueva_subcategoria").click(function(e) {
        e.preventDefault();  
        nombre = $('#nueva_subcategoria_nombre').val();
        categoria_id = $('#categoria').val();
        if(nombre.length > 0 && categoria_id > 0){
            $('.ajaxLoading').show();
            
            url = $(this).data('url');
            $.ajax({
                type: "POST",
                url:  url,
                async: true,
                data: {'nombre': nombre, 'categoria_id': categoria_id, 'id': subcategoria_id},  
                dataType: "json",
                success: function( data ) { 
                   $('.ajaxLoading').hide();                   
                   if(data.resultado === 'OK'){    
                       if(subcategoria_id == 0) {
                            $('#subcategoria').append('<option value="'+ data.id +'">'+data.nombre+'</option>');
                       } else {
                           $("#subcategoria option[value='"+subcategoria_id+"']").text(data.nombre);
                       }
                        $('#nueva_subcategoria_nombre').val('');                        
                        $('#nueva_subcategoria').slideUp('fast');
                        ActualizarLista();
                        
                   } else {
                        alert('Ha ocurrido un error, inténtelo nuevamente');
                   }
                  },
                  error: function(error){

                  }
              });  
        } else {
            alert('Debe especificar la categoría o un nombre de subcategoría ');
        }
    });     
    
    $(".eliminar_categoria").click(function(e) {
         e.preventDefault();
         $('#nueva_categoria').slideUp('fast');
    });
    
    $(".eliminar_subcategoria").click(function(e) {
         e.preventDefault();         
         $('#nueva_subcategoria').slideUp('fast');         
    });    
    
    
});
