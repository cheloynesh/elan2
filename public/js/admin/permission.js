var hash = window.location.hash;
// alert(hash);
if(hash==""){
    $('.nav-tabs a[href="#profile"]').tab('show');
}else{
    $('.nav-tabs a[href="#users"]').tab('show');
}
// $.fn.editable.defaults.mode = 'inline';
// $.fn.editable.defaults.ajaxOptions = {type:'PUT'};

//******************************************************************************************* PERFILES TAB---------------------------------------------------------------------------------------------------


$('#nameProfileClik').change(function () {
    // alert("entre");
    var id = $("#nameProfileClik").val();
    // alert(id);
    if(id == ""){
        $('input:checkbox').prop('disabled', true);//bloquear
        $('input:checkbox').prop("checked", false);//quitar marca
    }else{
        $('input:checkbox').prop('disabled', false);//desbloquear
        $('input:checkbox').prop("checked", false);//quitar marcas

        var route = "{{url('admin/permission/')}}/"+id+"/edit";
        $.get(route, function(data){
            if(data.length>0){
                $.each( data, function( index, data ){
                    if(data.view == 0){//quitar marcas y bloquear add,update,delete
                        $("#add_"+data.section_id).prop("checked", false);
                        if (data.add == 1) {
                            $("#add_" + data.section_id).prop("checked", true);
                        }else{$("#add_" + data.section_id).prop("checked", false);}
                        if (data.update == 1) {
                            $("#update_" + data.section_id).prop("checked", true);
                        }else{ $("#update_" + data.section_id).prop("checked", false);}

                        if (data.delete == 1) {
                            $("#delete_" + data.section_id).prop("checked", true);
                        }else{ $("#delete_" + data.section_id).prop("checked", false);}
                    } else {
                        $("#view_" + data.section_id).prop("checked", true);//poner su marca
                        if (data.add == 1) {
                            $("#add_" + data.section_id).prop("checked", true);
                        }else{$("#add_" + data.section_id).prop("checked", false);}
                        if (data.update == 1) {
                            $("#update_" + data.section_id).prop("checked", true);
                        }else{ $("#update_" + data.section_id).prop("checked", false);}

                        if (data.delete == 1) {
                            $("#delete_" + data.section_id).prop("checked", true);
                        }else{ $("#delete_" + data.section_id).prop("checked", false);}

                    }//fin else de vista es 1
                });//fin each recorrido
            }else{
                $('input:checkbox').prop("checked", false);//quitar marca
            }
        });// fin get data
    }//fin else- area logica
    $.ajax({

    })
});
//ULTIMO VALOR DE LAS RUTAS
// VER = 0
// AGREGAR = 1
// EDITAR = 2
// ELIMINAR = 3

$(".view_id").click(function () {
    var id = $("#nameProfileClik").val();
    var row = $(this).parents('tr');
    var section = $(row).attr('data-hijo');
    var form = $('#form-update_store');
    var row_ = $(this).parents('tr');
    var id_reference = $(row_).attr('data-reference');
    console.log(id_reference);
    if(id_reference==undefined){
            id_reference=0;
    }
    var route = form.attr('action').replace(':USER_ID',id+"/"+section+"/"+0+"/"+id_reference);
    // aler(route);
    if(id == ""){}else{
        $.get(route, function(result){
        }).fail(function() {
            alert("Advertencia No se pudo procesar el permiso de  Ver.");
        });
    }
});


$(".add_id").click(function () {
    var id = $("#nameProfileClik").val();
    var row = $(this).parents('tr');
    // console.log(row);
    var section = $(row).attr('data-hijo');
    console.log(section);
    var form = $('#form-update_store');
    var row_ = $(this).parents('tr');
    var id_reference = $(row_).attr('data-reference');
    console.log(id_reference);
    if(id_reference== undefined){
            id_reference=0;
    }
    var route = form.attr('action').replace(':USER_ID',id+"/"+section+"/"+1+"/"+id_reference);
    if(id == ""){}else{
        $.get(route, function(data){
            if(data.length>0){
                $("#view_" + data[0]).prop("checked", true);//poner su marca
            }
        }).fail(function() {
            alert("Advertencia No se pudo procesar el permiso de Agregar.");
        });
    }
});

$(".update_id").click(function () {
    var id = $("#nameProfileClik").val();
    var row = $(this).parents('tr');
    var section = row.data('hijo');
    var form = $('#form-update_store');
    var row_ = $(this).parents('tr');
    var id_reference = row_.data('reference');
    if(id_reference==undefined){
            id_reference=0;
    }
    var route = form.attr('action').replace(':USER_ID',id+"/"+section+"/"+2+"/"+id_reference);
    if(id == ""){}else{
        $.get(route, function(data){
            if(data.length>0){
                $("#view_" + data[0]).prop("checked", true);//poner su marca
            }
        }).fail(function() {
            alert("Advertencia No se pudo procesar el permiso de Editar.");
        });
    }

});


$(".delete_id").click(function () {
    var id = $("#nameProfileClik").val();
    var row = $(this).parents('tr');
    var section = row.data('hijo');
    var form = $('#form-update_store');
    var row_ = $(this).parents('tr');
    var id_reference = row_.data('reference');
    if(id_reference==undefined){
            id_reference=0;
    }
    var route = form.attr('action').replace(':USER_ID',id+"/"+section+"/"+3+"/"+id_reference);
    if(id == ""){ console.log("perfil vacio");}else{
        $.get(route, function(data){
            if(data.length>0){
                $("#view_" + data[0]).prop("checked", true);//poner su marca
            }
        }).fail(function() {
            alert("Advertencia No se pudo procesar el permiso de Editar.");
        });
    }

});
