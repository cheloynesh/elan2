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

var idClient = 0;
var initialId = 0;
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
            initialId = result.data.inicial;
            // alert(initialId);
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
            $("#pna").val(result.data.pna);
            prima();
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
                divClientes.style.display = "none"
                disponible.style.display = "none"
                noDisponible.style.display = ""
            }
        }
    })
}

function guardarPoliza()
{
    guardardatosClienteInicial();
    var expended = $("#expedition").val();
    var exp_imp = $("#exp_impute").val();
    var financ_exp = $("#financ_exp").val();
    var financ_imp = $("#financ_impute").val();
    var other_exp = $("#other_exp").val();
    var other_imp = $("#other_impute").val();
    var iva = $("#iva").val();
    var pna_t = $("#prima_t").val();
    var renovable = $("#renovable").val();
    var pay_frec = $("#pay_frec").val();
    var route = "policy";
    var data = {
        "id":idClient,
        "_token": $("meta[name='csrf-token']").attr("content"),
        "expended":expended,
        "exp_imp":exp_imp,
        "financ_exp":financ_exp,
        "financ_imp":financ_imp,
        "other_exp":other_exp,
        "other_imp":other_imp,
        "iva":iva,
        "pna_t":pna_t,
        "renovable":renovable,
        "pay_frec":pay_frec
    }
    jQuery.ajax({
        url: route,
        type: "post",
        data:data,
        dataType: "json",
        success:function(result){

        }
    });
    // if(clientType == 0)
    // {
    //     actualizarCliente();
    // }
    // else
    // {
    //     actualizarEmpresa();
    // }

    // en inicial se guarda fk_agent, fk_insurance, fk_branch, pna, fk_currency, fk_payment_form y fk_charge
    // guardar todos los datos de la póliza
    // lo demás se guarda en la tabla de la póliza
}

function guardardatosClienteInicial(){
    console.log(initialId, clientType);
    if(initialId == 0)
    {
        alert("Entre");
        var pna=$("#pna").val();
        var currency=$("#selectCurrency").val();
        var insurance=$("#selectInsurance").val();
        var branch =$("#selectBranch").val();
        var agent=$("#selectAgent").val();
        var charge=$("#selectCharge").val();
        var paymentForm=$("#selectPaymentform").val();
        var route =  baseUrlPoliza+"/savepolicy";
        var data ={
            "id":idClient,
            "_token": $("meta[name='csrf-token']").attr("content"),
            "pna": pna,
            "currency": currency,
            "insurance": insurance,
            "branch": branch,
            "agent": agent,
            "charge": charge,
            "paymentForm": paymentForm,
        }
        console.log(data, route);
        jQuery.ajax({
            url:route,
            type:"post",
            data: data,
            dataType: 'json',
            success:function(result)
            {

            }
        })
    }
    else
    {
        alert("entre con inicial");

    }
}
function prima(){
    var prima = parseFloat($("#pna").val());


    $("#prima_t").val(parseFloat(prima).toFixed(2));

}
function exp(){
    var prima = parseFloat($("#pna").val());
    var exp = parseFloat($("#expedition").val());

    var temp = prima + exp;
    $("#prima_t").val(parseFloat(temp).toFixed(2));
    
}

function financ(){
    var finan_exp = parseFloat($("#financ_exp").val());
    var prima = parseFloat($("#pna").val());
    var exp = parseFloat($("#expedition").val());

    var temp = finan_exp+ prima+ exp;
    $("#prima_t").val(parseFloat(temp).toFixed(2));


}

function other(){
    var other = parseFloat($("#other_exp").val());
    var finan_exp = parseFloat($("#financ_exp").val());
    var prima = parseFloat($("#pna").val());
    var exp = parseFloat($("#expedition").val());

    var temp = other + finan_exp+ prima + exp;
    $("#prima_t").val(parseFloat(temp).toFixed(2));

}

function porcentaje(){
    var ivapor = $("#ivapor").val();
    var other = parseFloat($("#other_exp").val());
    var finan_exp = parseFloat($("#financ_exp").val());
    var prima = parseFloat($("#pna").val());
    var exp = parseFloat($("#expedition").val());

    var temp = other + finan_exp+ prima + exp;

    var iva = temp * ivapor;
    $("#iva").val(parseFloat(iva).toFixed(2));

    temp = temp+ iva;

    $("#prima_t").val(parseFloat(temp).toFixed(2));
}

function mostartabla(){
    
}

