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
upateflag = 0;
active = 1;

function opcionesEstatus(id,statusId)
{
    idcandidate=id;
    $("#selectStatus").val(statusId);
    $("#myEstatusModal").modal('show');
}

function cerrarmodal()
{
    $("#myEstatusModal").modal('hide');
    $("#comentary").val("");

}

function actualizarEstatus()
{
    // alert("entre a viewpolicy");
    if (document.getElementById('chkActive').checked) active = 0; else active = 1;
    var status = $("#selectStatus").val();
    if(status != 30)
    {
        var route = baseUrl + "/updateStatus";

        var data = {
            'id':idcandidate,
            "_token": $("meta[name='csrf-token']").attr("content"),
            'status':status,
            'active':active,
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
    else
    {
        editarCandidato(idcandidate,1);
    }
}

function RefreshTable(data,profile,permission)
{
    var table = $('#tbProf').DataTable();
    var btnStat = '';
    var btnEdit = '';
    table.clear();

    data.forEach( function(valor, indice, array) {
        btnStat = '<button class="btn btn-info" style="background-color: #'+valor.color+'; border-color: #'+valor.color+'" onclick="opcionesEstatus('+valor.candId+','+valor.id+')">'+valor.name+'</button>';
        btnView = '<button href="#|" class="btn btn-success" onclick="verCandidato('+valor.candId+')" ><i class="fas fa-eye"></i></button>';
        btnEdit = '<button href="#|" class="btn btn-warning" onclick="editarCandidato('+valor.candId+',0)" ><i class="fa fa-edit"></i></button>';
        // alert(valor.id);
        table.row.add([valor.candName,valor.application_date,btnStat,btnView + " " + btnEdit]).node().candId = valor.candId;
    });
    table.draw(false);
}

function verCandidato(id)
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

function editarCandidato(id,updat)
{
    var route = baseUrl + '/GetInfo/'+ id;

    jQuery.ajax({
        url:route,
        type:'get',
        dataType:'json',
        success:function(result)
        {
            idcandidate = id;
            updateflag = updat;

            $("#name1").val(result.data.name);
            $("#firstname1").val(result.data.firstname);
            $("#lastname1").val(result.data.lastname);

            $("#mail1").val(result.data.mail);
            $("#city1").val(result.data.city);
            $("#age1").val(result.data.age);
            $("#selectScolarity1").val(result.data.scholarity);

            $("#social1").val(result.data.social);
            $("#sales_exp1").val(result.data.sales_exp);
            $("#origin1").val(result.data.origin);

            $("#cellphone1").val(result.data.cellphone);
            $("#rfc1").val(result.data.rfc);
            $("#selectSex1").val(result.data.sex);

            $("#myModalEdit").modal('show');
        },
        error:function(result,error,errorTrown)
        {
            alertify.error(errorTrown);
        }
    })
}

function guardar()
{
    // alert("entre a viewpolicy");
    if (document.getElementById('chkActive').checked) active = 0; else active = 1;

    var name = $("#name1").val();
    var firstname = $("#firstname1").val();
    var lastname = $("#lastname1").val();

    var mail = $("#mail1").val();
    var city = $("#city1").val();
    var age = $("#age1").val();
    var scholarity = $("#selectScolarity1").val();

    var social = $("#social1").val();
    var sales_exp = $("#sales_exp1").val();
    var origin = $("#origin1").val();

    var cellphone = $("#cellphone1").val();
    var rfc = $("#rfc1").val();
    var sex = $("#selectSex1").val();

    var route = baseUrl + "/updateCandidate";

    var data = {
        'id':idcandidate,
        "_token": $("meta[name='csrf-token']").attr("content"),
        'name':name,
        'firstname':firstname,
        'lastname':lastname,
        'mail':mail,
        'city':city,
        'age':age,
        'scholarity':scholarity,
        'social':social,
        'sales_exp':sales_exp,
        'origin':origin,
        'cellphone':cellphone,
        'rfc':rfc,
        'sex':sex,
        'active':active,
    };
    jQuery.ajax({
        url:route,
        type:'post',
        data:data,
        dataType:'json',
        success:function(result)
        {
            alertify.success(result.message);

            if(updateflag == 1)
            {
                route = baseUrl + "/updateStatus";

                data = {
                    'id':idcandidate,
                    "_token": $("meta[name='csrf-token']").attr("content"),
                    'status':30,
                    'active':active,
                };
                jQuery.ajax({
                    url:route,
                    type:'post',
                    data:data,
                    dataType:'json',
                    success:function(result)
                    {
                        alertify.success(result.message);
                        RefreshTable(result.candidates,result.profile,result.permission);
                        $("#myEstatusModal").modal('hide');
                        $("#myModalEdit").modal('hide');
                        updateflag = 0;
                    },
                    error:function(result,error,errorTrown)
                    {
                        alertify.error(errorTrown);
                    }
                })
            }
            else
            {
                RefreshTable(result.candidates,result.profile,result.permission);
                $("#myModalEdit").modal('hide');
            }
        },
        error:function(result,error,errorTrown)
        {
            alertify.error(errorTrown);
        }
    })
}

function cerrar(modal)
{
    $(modal).modal('hide');
}

function chkActive()
{
    if (document.getElementById('chkActive').checked) active = 0; else active = 1;

    var route = baseUrl + '/GetAll/'+ active;

    jQuery.ajax({
        url:route,
        type:'get',
        dataType:'json',
        success:function(result)
        {
            RefreshTable(result.candidates,result.profile,result.permission);
        },
        error:function(result,error,errorTrown)
        {
            alertify.error(errorTrown);
        }
    })
}
