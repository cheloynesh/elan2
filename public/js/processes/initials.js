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

function guardarInicial()
{
    var onoff = document.getElementById("onoff");
    var checked = onoff.checked;
    var onoffAsegurado = document.getElementById("onoffAsegurado");
    var checkedAsegurado = onoffAsegurado.checked;

    var agent = $("#selectAgent").val();
    var name = null;
    var firstname = null;
    var lastname = null;
    var rfc = null;
    var type = null;
    var insured = null;
    if(checked)
    {
        // alert("entre a persona fisica");
        // alert(checkedAsegurado);
        name = $("#name").val();
        firstname = $("#firstname").val();
        lastname = $("#lastname").val();
        rfc = $("#rfc").val();
        type = 0;
        if(!checkedAsegurado)
        {
            // alert("entre a no igual al contratante");
            insured = $("#insured").val();
        }
        else
        {
            // alert("entre a igual al contratante");
            insured = name + " " + firstname + " " + lastname;
        }
    }
    else
    {
        // alert("entre a persona moral");
        name = $("#business_name").val();
        rfc = $("#business_rfc").val();
        type = 1;
        if(!checkedAsegurado)
        {
            insured = $("#insured").val();
        }
        else
        {
            insured = name;
        }
    }

    var promoter = $("#promoter").val();
    var system = $("#system").val();
    var folio = $("#folio").val();
    var insurance = $("#selectInsurance").val();
    var branch = $("#selectBranch").val();
    var application = $("#selectAppli").val();
    var pna = $("#pna").val();
    var paymentForm = $("#selectPaymentform").val();
    var currency = $("#selectCurrency").val();
    var charge = $("#selectCharge").val();
    var route = "initial";
    var data = {
        "_token": $("meta[name='csrf-token']").attr("content"),
        'agent':agent,
        'name':name,
        'firstname':firstname,
        'lastname':lastname,
        'rfc':rfc,
        'type':type,
        'insured':insured,
        'promoter':promoter,
        'system':system,
        'folio':folio,
        'insurance':insurance,
        'branch':branch,
        'application':application,
        'pna':pna,
        'paymentForm':paymentForm,
        'currency':currency,
        'charge':charge,
    };
    jQuery.ajax({
        url:route,
        type:"post",
        data: data,
        dataType: 'json',
        success:function(result)
        {
            alertify.success(result.message);
            $("#myModal").modal('hide');
            window.location.reload(true);
        }
    })
}
var idupdate = 0;
let tipo = 0;

function editarInicial(id)
{
    idupdate=id;

    var fisica = document.getElementById("fisicaedit");
    var moral = document.getElementById("moraledit");

    var route = baseUrl + '/GetInfo/'+ id;

    jQuery.ajax({
        url:route,
        type:'get',
        dataType:'json',
        success:function(result)
        {
            tipo=result.data.type;
            $("#selectAgent1").val(result.data.fk_agent);
            // type = 0 es física y type=1 moral
            if(result.data.type==0)
            {
                fisica.style.display="";
                $("#name1").val(result.data.name);
                $("#firstname1").val(result.data.firstname);
                $("#lastname1").val(result.data.lastname);
                $("#rfc1").val(result.data.rfc);
            }else{

                moral.style.display="";
                $("#business_name1").val(result.data.name)
                $("#business_rfc1").val(result.data.rfc);

            }
           $("#promoter1").val(result.data.promoter_date);
           $("#system1").val(result.data.system_date);
           $("#folio1").val(result.data.folio);
           $("#selectInsurance1").val(result.data.fk_insurance);
           $("#selectBranch1").val(result.data.fk_branch);
           $("#selectAppli1").val(result.data.fk_application);
           $("#pna1").val(result.data.pna);
           $("#selectPaymentform1").val(result.data.fk_payment_form);
           $("#selectCurrency1").val(result.data.fk_currency);
           $("#selectCharge1").val(result.data.fk_charge);
           $("#myModaledit").modal('show');
        }
    })
}
function cancelarEditar()
{
    // alert(tipo);
    var fisica = document.getElementById("fisicaedit");
    var moral = document.getElementById("moraledit");
    if(tipo == 0)
    {
        $("#name1").val("");
        $("#firstname1").val("");
        $("#lastname1").val("");
        $("#rfc1").val("");
        fisica.style.display="none";
    }else{
        $("#business_name1").val("")
        $("#business_rfc1").val("");
        moral.style.display="none";

    }
        $("#myModaledit").modal('hide');

}
function actualizarInicial()
{
    var agent = $("#selectAgent1").val();
    if(tipo==0)
    {
        alert('entre');
        var name = $("#name1").val();
        var firstname = $("#firstname1").val();
        var lastname = $("#lastname1").val();
        var rfc = $("#rfc1").val();

    }else{
        alert('entre');
        var name = $("#business_name1").val();
        var rfc = $("#business_rfc1").val();
        console.log(name,rfc);
    }
    var promoter = $("#promoter1").val();
    var system = $("#system1").val();
    var folio = $("#folio1").val();
    var insurance = $("#selectInsurance1").val();
    var branch = $("#selectBranch1").val();
    var application = $("#selectAppli1").val();
    var pna = $("#pna1").val();
    var paymentForm = $("#selectPaymentform1").val();
    var currency = $("#selectCurrency1").val();
    var charge = $("#selectCharge1").val();

    var route = "initial/"+idupdate;
    var data = {
        "_token": $("meta[name='csrf-token']").attr("content"),
        'id':idupdate,
        'agent':agent,
        'name':name,
        'firstname':firstname,
        'lastname':lastname,
        'rfc':rfc,
        'promoter':promoter,
        'system':system,
        'folio':folio,
        'insurance':insurance,
        'branch':branch,
        'application':application,
        'pna':pna,
        'paymentForm':paymentForm,
        'currency':currency,
        'charge':charge
    };
    jQuery.ajax({
        url:route,
        type:'put',
        data:data,
        dataType:'json',
        success:function(result)
        {
            alertify.success(result.message);
            $("#myModaledit").modal('hide');
            window.location.reload(true);
        }
    })
}

function eliminarInicial(id)
{
    var route = "initial/"+id;
    var data = {
            'id':id,
            "_token": $("meta[name='csrf-token']").attr("content"),
    };
    alertify.confirm("Eliminar Inicial","¿Desea borrar el Inicial?",
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
var id_initial = 0;

function opcionesEstatus(initialId,statusId,)
{
    id_initial=initialId;
    $("#selectStatus").val(statusId);
    $("#myEstatusModal").modal('show');
}

function actualizarEstatus()
{
    var status = $("#selectStatus").val();
    var route = baseUrl+"/updateStatus";
    console.log(route);
    var data = {
        'id':id_initial,
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
            window.location.reload(true);
        }
    })
}
function cerrarmodal()
{
    $("#myEstatusModal").modal('hide');
    $("#comentary").val("");

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
function mostrarDivAsegurado()
{
    // alert("hola");
    var onoff = document.getElementById("onoffAsegurado");
    var checked = onoff.checked;
    var asegurado = document.getElementById("asegurado");
    // alert(checked);
    if(!checked)
    {
        asegurado.style.display = ""
    }
    else
    {

        asegurado.style.display = "none"
    }
}
