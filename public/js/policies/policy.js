var rutaPoliza = window.location;
var getUrlPoliza = window.location;
var baseUrlPoliza = getUrlPoliza .protocol + "//" + getUrlPoliza.host + getUrlPoliza.pathname;

$(document).ready( function () {
    $('#srcClient').DataTable({
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
$(document).ready( function () {
    $('#tablerecords').DataTable({
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

function buscarclientes(){
    $("#modalSrcClient").modal("show");
}
function ocultar(){
    $("#modalSrcClient").modal("hide");

}
// function mostrartabla(){
//     var table = document.getElementById("tablerecords");
//     if(table.style.display=='none'){
//         table.style.display="";
//     }
// }

var idClient = 0;
var clientType = 0;

function obtenerid(id){
    idClient = id;
    var routePoliza = baseUrlPoliza + '/GetInfo/'+ id;
    var info = document.getElementById("mostrarinfo");
    var fisica = document.getElementById("fisica");
    var moral = document.getElementById("moral");
    jQuery.ajax({
        url:routePoliza,
        type:'get',
        dataType:'json',
        success:function(result)
        {
            clientType = result.data.status;
            if(clientType == 0)
            {
                fisica.style.display = ""
                moral.style.display = "none"
                editarCliente(id);
            }
            else
            {
                fisica.style.display = "none"
                moral.style.display = ""
                editarEmpresa(id);
            }
            $("#prima").val(result.data.pna);
            $("#selectInsurance").val(result.data.fk_insurance);
            $("#selectCurrency").val(result.data.fk_currency);
            $("#selectCharge").val(result.data.fk_charge);
            $("#selectPaymentform").val(result.data.fk_payment_form);
            $("#selectAgent").val(result.data.fk_agent);
            $("#selectBranch").val(result.data.fk_branch);
        }
    });

    if(info.style.display=='none'){
        info.style.display="";
    }
    $("#modalSrcClient").modal("hide");
}

function checkPolicy(){
    var policy = $("#poliza").val();
    var routePoliza = baseUrlPoliza + '/CheckPolicy/'+ policy;
    var disponible = document.getElementById("disponible");
    var noDisponible = document.getElementById("noDisponible");
    var divClientes = document.getElementById("divClientes");

    jQuery.ajax({
        url:routePoliza,
        type:'get',
        dataType:'json',
        success:function(result)
        {
            if (result == 0)
            {
                divClientes.style.display = ""
                disponible.style.display = ""
                noDisponible.style.display = "none"
            }
            else
            {
                divClientes.style.display = ""
                disponible.style.display = "none"
                noDisponible.style.display = ""
            }
        }
    })
}

function guardarPoliza()
{
    if(clientType)
    {
        actualizarCliente();
    }
    else
    {
        actualizarEmpresa();
    }
}
