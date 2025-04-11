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
        },
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'colvisGroup',
                text: 'Datos de Origen',
                show: [3, 4, 5, 6],
                hide: [7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35]
            },
            {
                extend: 'colvisGroup',
                text: 'Datos del Solicitante',
                show: [7, 8, 9, 10, 11, 12, 13, 14],
                hide: [3, 4, 5, 6, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35]
            },
            {
                extend: 'colvisGroup',
                text: 'Primer Proceso',
                show: [15, 16, 17, 18, 19],
                hide: [3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35]
            },
            {
                extend: 'colvisGroup',
                text: 'Segundo Proceso',
                show: [20, 21, 22, 23, 24, 25, 26, 27],
                hide: [3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 28, 29, 30, 31, 32, 33, 34, 35]
            },
            {
                extend: 'colvisGroup',
                text: 'Cédula',
                show: [28, 29, 30, 31, 32],
                hide: [3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 33, 34, 35]
            },
            {
                extend: 'colvisGroup',
                text: 'Proceso Final',
                show: [33, 34, 35],
                hide: [3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32]
            },
            {
                extend: 'colvisGroup',
                text: 'Mostrar Todas',
                show: ':hidden'
            },
            {
                extend: 'colvisGroup',
                text: 'Ocultar Todas',
                show: [0, 1, 2],
                hide: [3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35]
            }
        ],
        columnDefs: [
            {
                target: [3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35],
                visible: false
            }
        ]
    });
} );

function showimp()
{
   var get_value = document.getElementById("selectProfile");
   var valor = get_value.value;
//    alert(valor);
    if(valor == "12")
    {
        document.getElementById("etiqueta").hidden = false;
        document.getElementById("etiqueta").style.display = "block";
        document.getElementById("code").hidden = false;
        document.getElementById("code").style.display = "block";
        document.getElementById("agregarcol").hidden = false;
        document.getElementById("agregarcol").style.display = "block";
        document.getElementById("tbcodes").hidden = false;
        document.getElementById("tbcodes").style.display = "block";
        document.getElementById("tbody-codigo").hidden = false;
        document.getElementById("tbody-codigo").style.display = "block";

    }
    else
    {
        document.getElementById("etiqueta").hidden = true;
        document.getElementById("code").hidden = true;
        document.getElementById("agregarcol").hidden = true;
        document.getElementById("tbcodes").hidden = true;
        document.getElementById("tbody-codigo").hidden = true;

    }
}
var array = [];
var codigos=[];
function agregarcodigo()
{
    var codigo = $("#code").val();
    var table = $("#tbody-codigo");
    var str_row = '<tr id = "'+parseFloat(array.length+1)+'"><td><input type=text name="codigo[]" value="'+codigo+'"/></td><td><button type="button" class="btn btn-danger" onclick="delete_code(this)"><i class="fa fa-trash mr-2"></i></button></td></tr>';
    table.append(str_row);
    $("#code").val("");
    codigos.push({
        'id':array.length+1,
        'code':codigo
    });
}
function delete_code(row)
{
    var index = 0;
    var id = $(row).parent().parent().attr('id');
    $(row).parent().parent().remove();
    for(var i = 0; i<codigos.length; ++i)
    {
        if(codigos[i].id == id)
        {
            index=0;
        }
    }
    codigos.splice(index,1);
}

function mostrarDiv()
{
    var onoff = document.getElementById("onoff");
    var checked = onoff.checked;
    var fisica = document.getElementById("fisica");
    var moral = document.getElementById("moral");
    if(checked)
    {
        fisica.style.display = ""
        moral.style.display = "none"
    }
    else
    {

        fisica.style.display = "none"
        moral.style.display = ""
    }
}
function mostrarAsegurado()
{
    var onoff = document.getElementById("onoffAseg");
    var checked = onoff.checked;
    var asegurado = document.getElementById("asegurado");
    if(checked)
    {
        asegurado.style.display = ""
    }
    else
    {

        asegurado.style.display = "none"
    }
}
function mostrarDivAsegurado()
{
    var onoff = document.getElementById("onoffAsegurado");
    var checked = onoff.checked;
    var asegurado = document.getElementById("asegurado");
    if(!checked)
    {
        asegurado.style.display = ""
    }
    else
    {

        asegurado.style.display = "none"
    }
}

function importexc()
{
    var formData = new FormData();
    var files = $('input[type=file]');
    for (var i = 0; i < files.length; i++) {
        if (files[i].value == "" || files[i].value == null)
        {
            // console.log(files.length);
            // return false;
        }
        else
        {
            formData.append(files[i].name, files[i].files[0]);
        }
    }
    // console.log("entre");
    var formSerializeArray = $("#Form").serializeArray();
    for (var i = 0; i < formSerializeArray.length; i++) {
        formData.append(formSerializeArray[i].name, formSerializeArray[i].value)
    }

    formData.append('_token', $("meta[name='csrf-token']").attr("content"));

    var route = baseUrl + '/import/1';

    jQuery.ajax({
        url:route,
        type:'post',
        data:formData,
        contentType: false,
        processData: false,
        cache: false,
        success:function(result)
        {
            alertify.success(result.message);
        },
        error:function(result,error,errorTrown)
        {
            alertify.error(errorTrown);
            $("#waitModal").modal('hide');
        }
    })
}

function importexcServ()
{
    var formData = new FormData();
    var files = $('input[type=file]');
    for (var i = 0; i < files.length; i++) {
        if (files[i].value == "" || files[i].value == null)
        {
            // console.log(files.length);
            // return false;
        }
        else
        {
            formData.append(files[i].name, files[i].files[0]);
        }
    }
    // console.log("entre");
    var formSerializeArray = $("#Form").serializeArray();
    for (var i = 0; i < formSerializeArray.length; i++) {
        formData.append(formSerializeArray[i].name, formSerializeArray[i].value)
    }

    formData.append('_token', $("meta[name='csrf-token']").attr("content"));

    var route = baseUrl + '/importServ/1';

    jQuery.ajax({
        url:route,
        type:'post',
        data:formData,
        contentType: false,
        processData: false,
        cache: false,
        success:function(result)
        {
            alertify.success(result.message);
        },
        error:function(result,error,errorTrown)
        {
            alertify.error(errorTrown);
            $("#waitModal").modal('hide');
        }
    })
}

function importexcHub()
{
    var formData = new FormData();
    var files = $('input[type=file]');
    for (var i = 0; i < files.length; i++) {
        if (files[i].value == "" || files[i].value == null)
        {
            // console.log(files.length);
            // return false;
        }
        else
        {
            formData.append(files[i].name, files[i].files[0]);
        }
    }
    // console.log("entre");
    var formSerializeArray = $("#Form").serializeArray();
    for (var i = 0; i < formSerializeArray.length; i++) {
        formData.append(formSerializeArray[i].name, formSerializeArray[i].value)
    }

    formData.append('_token', $("meta[name='csrf-token']").attr("content"));

    var route = baseUrl + '/importHub/1';

    jQuery.ajax({
        url:route,
        type:'post',
        data:formData,
        contentType: false,
        processData: false,
        cache: false,
        success:function(result)
        {
            alertify.success(result.message);
        },
        error:function(result,error,errorTrown)
        {
            alertify.error(errorTrown);
            $("#waitModal").modal('hide');
        }
    })
}
