var ruta = window.location;
var getUrl = window.location;
var baseUrl = getUrl .protocol + "//" + getUrl.host + getUrl.pathname;

$(document).ready( function () {
    $('#tbProf').DataTable({
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

idcandidate = 0;

function opcionesEstatus(id,statusId)
{
    idcandidate=id;
    $("#selectStatus").val(statusId);
    $("#myEstatusModal").modal('show');
}

function actualizarEstatus()
{
    // alert("entre a viewpolicy");
    var status = $("#selectStatus").val();
    var route = baseUrl + "/updateStatus";

    var data = {
        'id':idcandidate,
        "_token": $("meta[name='csrf-token']").attr("content"),
        'status':status
    };
    jQuery.ajax({
        url:route,
        type:'post',
        data:data,
        dataType:'json',
        success:function(result)
        {
            alertify.success(result.message);
            $("#myEstatusModal").modal('hide');
            // window.location.reload(true);
            RefreshTable(result.candidates,result.profile,result.permission);
        },
        error:function(result,error,errorTrown)
        {
            alertify.error(errorTrown);
        }
    })
}

function RefreshTable(data,profile,permission)
{
    var table = $('#tbProf').DataTable();
    var btnStat = '';
    var btnEdit = '';
    table.clear();

    data.forEach( function(valor, indice, array) {
        btnStat = '<button class="btn btn-info" style="background-color: #'+valor.color+'; border-color: #'+valor.color+'" onclick="opcionesEstatus('+valor.candId+','+valor.id+')">'+valor.name+'</button>';
        btnEdit = '<button href="#|" class="btn btn-success" onclick="editarCandidato('+valor.candId+')" ><i class="fas fa-eye"></i></button>';
        // alert(valor.id);
        table.row.add([valor.candName,valor.application_date,btnStat,btnEdit]).node().candId = valor.candId;
    });
    table.draw(false);
}

function editarCandidato(id)
{
    var route = baseUrl + '/GetInfo/'+ id;

    jQuery.ajax({
        url:route,
        type:'get',
        dataType:'json',
        success:function(result)
        {
            $("#name").val(result.data.name);
            $("#firstname").val(result.data.firstname);
            $("#lastname").val(result.data.lastname);

            $("#mail").val(result.data.mail);
            $("#city").val(result.data.city);
            $("#age").val(result.data.age);
            $("#scholariy").val(result.data.scholarity);

            $("#social").val(result.data.social);
            $("#sales_exp").val(result.data.sales_exp);
            $("#origin").val(result.data.origin);
            document.getElementById("viewPDF").href = getUrl.protocol + "//" + getUrl.host + "/files/cv/" + result.data.cv;

            $("#myModal").modal('show');
        },
        error:function(result,error,errorTrown)
        {
            alertify.error(errorTrown);
        }
    })
}
