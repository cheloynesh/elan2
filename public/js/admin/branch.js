var getUrlBranch = window.location;
var baseUrlBranch = getUrlBranch .protocol + "//" + getUrlBranch.host + "/admin/branch/branches";
// var baseUrlBranch = getUrlBranch .protocol + "//" + getUrlBranch.host + getUrlBranch.pathname;

$(document).ready( function () {
    $('#tbProfBranch').DataTable({
        language : {
            "sProcessing":     "Procesando...",
            "sLengthMenu":     "Mostrar _MENU_ registros",
            "sZeroRecords":    "No se encontraron resultados",
            "sEmptyTable":     "Ningún dato disponible en esta tabla",
            "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
            "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix":    "",
            "sSearch":         "Buscar:",
            "sUrl":            "",
            "sInfoThousands":  ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
              "sFirst":    "Primero",
              "sLast":     "Último",
              "sNext":     "Siguiente",
              "sPrevious": "Anterior"
            },
            "oAria": {
              "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
              "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }
        }
    });
} );

function guardarRamo()
{
    var name = $("#name").val();
    var days = $("#select_days").val();
    var route = baseUrlBranch;
    var data = {
        "_token": $("meta[name='csrf-token']").attr("content"),
        'name':name,
        'days':days,
    };
    jQuery.ajax({
        url:route,
        type:"post",
        data: data,
        dataType: 'json',
        success:function(result)
        {
            alertify.success(result.message);
            $("#myModalNewBranch").modal('hide');
            window.location.reload(true);
        }
    })
}
var idupdate = 0;
function editarRamo(id)
{
    idupdate=id;

    var route = baseUrlBranch + '/GetInfo/'+ id;

    console.log(route);
    jQuery.ajax({
        url:route,
        type:'get',
        dataType:'json',
        success:function(result)
        {
            $("#name1").val(result.data.name);
            $("#select_days1").val(result.data.days);
            $("#myModaleditBranch").modal('show');
        }
    })
}
function cancelarEditar()
{
    $("#name1").val("");
    $("#myModaleditBranch").modal('hide');
}
function actualizarRamo(id)
{
    var name = $("#name1").val();
    var days = $("#select_days1").val();
    var route = baseUrlBranch + "/" + idupdate;
    var data = {
        'id':idupdate,
        "_token": $("meta[name='csrf-token']").attr("content"),
        'name':name,
        'days':days,
    };
    jQuery.ajax({
        url:route,
        type:'put',
        data:data,
        dataType:'json',
        success:function(result)
        {
            alertify.success(result.message);
            $("#myModaleditBranch").modal('hide');
            window.location.reload(true);
        }
    })
}

function eliminarRamo(id)
{
    var route = baseUrlBranch + "/" + id;
    var data = {
            'id':id,
            "_token": $("meta[name='csrf-token']").attr("content"),
    };
    alertify.confirm("Eliminar Ramo","¿Desea borrar el ramo?",
        function(){
            jQuery.ajax({
                url:route,
                data: data,
                type:'delete',
                dataType:'json',
                success:function(result)
                {
                    window.location.reload(true);
                }
            })
            alertify.success('Eliminado');
        },
        function(){
            alertify.error('Cancelado');
    });

}
