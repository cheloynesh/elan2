var ruta = window.location;
var getUrl = window.location;
var baseUrl = getUrl .protocol + "//" + getUrl.host + getUrl.pathname;

$(document).ready( function () {
    $('#tbUsers').DataTable({
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
    $('#tbcodes').DataTable({

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

function guardarUsuario()
{
    var email = $("#email").val();
    var password = $("#password").val();

    var name = $("#name").val();
    var firstname = $("#firstname").val();
    var lastname = $("#lastname").val();

    var cellphone = $("#cellphone").val();
    var b_day = $("#b_day").val();
    var fk_profile = $("#selectProfile").val();
    var subProfile = $("#selectSubProfile").val();
    var route = "user";
    var data = {
        "_token": $("meta[name='csrf-token']").attr("content"),
        'email':email,
        'password':password,
        'name':name,
        'firstname':firstname,
        'lastname':lastname,
        'cellphone':cellphone,
        'fk_profile':fk_profile,
        'subProfile':subProfile,
        'b_day':b_day,
        'codes':codigos
    };

    jQuery.ajax({
        url:route,
        type:'post',
        data:data,
        dataType:'json',
        success:function(result)
        {
            alertify.success(result.message);
            $("#myModal").modal('hide');
            codigos=[];
            window.location.reload(true);
        }
    })
}
var idupdate = 0;
function editarUsuario(id)
{
    idupdate=id;

    var route = baseUrl + '/GetInfo/'+id;
    // alert(route);
    jQuery.ajax({
        url:route,
        type:'get',
        dataType:'json',
        success:function(result)
        {
            console.log(result);
            $("#email1").val(result.data.email);
            $("#password1").val(result.data.password);
            $("#name1").val(result.data.name);
            $("#firstname1").val(result.data.firstname);
            $("#lastname1").val(result.data.lastname);
            $("#cellphone1").val(result.data.cellphone);
            $("#b_day1").val(result.data.b_day);
            $("#selectProfile1").val(result.data.fk_profile);
            $("#selectSubProfileedit").val(result.data.subprofile);
            // codigos

            codigoseditar=[];

            result.codes.forEach( function(valor, indice, array) {
                codigoseditar.push({
                    'code':valor.code,
                    'insurance':valor.fk_insurance,
                    'insuranceName':valor.name
                });
            });
            refreshTable('#tbcodes1',codigoseditar,'delete_code_edit');
            showimpEdit();
            $("#myModaledit").modal('show');
        }
    })
}

function cancelarUsuario()
{
    // $("#tbody-codigo1").empty();
    codigoseditar=[];
    $("#myModaledit").modal('hide');

}
function actualizarUsuario()
{
    var email = $("#email1").val();
    var password = $("#password1").val();

    var name = $("#name1").val();
    var firstname = $("#firstname1").val();
    var lastname = $("#lastname1").val();

    var cellphone = $("#cellphone1").val();
    var b_day = $("#b_day1").val();
    var fk_profile = $("#selectProfile1").val();
    var subProfile = $("#selectSubProfileedit").val();
    var route = "user/"+idupdate;
    var data = {
        'id':idupdate,
        "_token": $("meta[name='csrf-token']").attr("content"),
        'email':email,
        'password':password,
        'name':name,
        'firstname':firstname,
        'lastname':lastname,
        'cellphone':cellphone,
        'fk_profile':fk_profile,
        'subprofile':subProfile,
        'b_day':b_day,
        'codigoseditar':codigoseditar
    };
    console.log(codigoseditar);
    jQuery.ajax({
        url:route,
        type:'put',
        data:data,
        dataType:'json',
        success:function(result)
        {
            // $("#tbody-codigo1").empty();
            alertify.success(result.message);
            $("#myModaledit").modal('hide');
            codigoseditar=[];
            window.location.reload(true);
        }
    })
}
function eliminarUsuario(id)
{
    var route = "user/"+id;
    var data = {
        'id':id,
        "_token": $("meta[name='csrf-token']").attr("content"),
    };
    alertify.confirm("Eliminar Usuario","¿Desea borrar el Usuario?",
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
// codigos agentes
function showimp()
{
   var get_value = document.getElementById("selectProfile");
   var valor = get_value.value;
//    alert(valor);
    if(valor == "12")
    {
        document.getElementById("claveAgente").style.display = "block";

    }
    else
    {
        document.getElementById("claveAgente").style.display = "none";
    }
}
var array = [];
var codigos=[];
var codigos=[];
var codigoseditar=[];

function refreshTable(tableName, cods, func)
{
    var table = $(tableName).DataTable();
        table.clear();
        cods.forEach( function(valor, indice, array) {
            btnTrash = '<button type="button" class="btn btn-danger" onclick="'+func+'('+valor.code+','+valor.insurance+')"><i class="fa fa-trash mr-2"></i></button>';
            table.row.add([valor.code,valor.insuranceName,btnTrash]);
        });

        table.draw(false);
}

function agregarcodigo()
{
    var codigo = $("#code").val();
    var aseguradora = $("#insurance").val();
    var aseguradoraName = $("#insurance option:selected").text();
    if(codigo == null || codigo=="" || aseguradora==null || aseguradora=="")
    {
        alert("Los campos no deben de quedar vacios.");
        return false;
    }
    else
    {
        $("#code").val("");
        $("#insurance").val("");
        codigos.push({
            'id':array.length+1,
            'code':codigo,
            'insurance':aseguradora,
            'insuranceName':aseguradoraName
        });
        refreshTable('#tbcodes',codigos,'delete_code');
    }
}
function agregarcodigo1(codigo)
{
    var codigo = $("#code1").val();
    var aseguradora = $("#insurance1").val();
    var aseguradoraName = $("#insurance1 option:selected").text();
    if(codigo == null || codigo=="" || aseguradora==null || aseguradora=="")
    {
        alert("Los campos no deben de quedar vacios.");
        return false;
    }
    else
    {
        $("#code").val("");
        $("#insurance").val("");
        codigoseditar.push({
            'id':array.length+1,
            'code':codigo,
            'insurance':aseguradora,
            'insuranceName':aseguradoraName
        });
        refreshTable('#tbcodes1',codigoseditar,'delete_code_edit');
    }
}
function delete_code(code, insurance)
{
    var index = 0;
    for(var i = 0; i<codigos.length; ++i)
    {
        if(codigos[i].code == code && codigos[i].insurance == insurance)
        {
            index=i;
        }
    }
    codigos.splice(index,1);
    refreshTable('#tbcodes',codigos,'delete_code');
}
function delete_code_edit(code, insurance)
{
    var index = 0;
    for(var i = 0; i<codigoseditar.length; ++i)
    {
        if(codigoseditar[i].code == code && codigoseditar[i].insurance == insurance)
        {
            index=i;
        }
    }
    codigoseditar.splice(index,1);
    refreshTable('#tbcodes1',codigoseditar,'delete_code_edit');
}
// editar codigos agentes
function showimpEdit()
{
    var get_value = document.getElementById("selectProfile1");
    var valor = get_value.value;
 //    alert(valor);
     if(valor == "12")
     {
         document.getElementById("claveAgente1").style.display = "block";

     }
     else
     {
         document.getElementById("claveAgente1").style.display = "none";
     }
}

