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
            // prima();
            calculo();
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
    // guardardatosClienteInicial();
    var policy = $("#poliza").val();
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

    var pna=$("#pna").val();
    var currency=$("#selectCurrency").val();
    var insurance=$("#selectInsurance").val();
    var branch =$("#selectBranch").val();
    var agent=$("#selectAgent").val();
    var charge=$("#selectCharge").val();
    var paymentForm=$("#selectPaymentform").val();
    var initial_date=$("#initial_date").val();
    var end_date=$("#end_date").val();

    if(other_exp != ""){
        other_exp = parseFloat(other_exp);
    }
    else{
        other_exp = 0;
    }
    if(financ_exp != ""){
        financ_exp = parseFloat(financ_exp);
    }
    else{
        financ_exp = 0;
    }
    if(pna != ""){
        pna = parseFloat(pna);
    }
    else{
        pna = 0;
    }
    if(expended != ""){
        expended = parseFloat(expended);
    }
    else{
        expended = 0;
    }

    var route = "policy";
    var data = {
        "id":idClient,
        "_token": $("meta[name='csrf-token']").attr("content"),
        "policy":policy, 
        "expended":expended,
        "exp_imp":exp_imp,
        "financ_exp":financ_exp,
        "financ_imp":financ_imp,
        "other_exp":other_exp,
        "other_imp":other_imp,
        "iva":iva,
        "pna_t":pna_t,
        "renovable":renovable,
        "pay_frec":pay_frec,
        "pna": pna,
        "currency": currency,
        "insurance": insurance,
        "branch": branch,
        "agent": agent,
        "charge": charge,
        "paymentForm": paymentForm,
        "initial_date":initial_date,
        "end_date":end_date,
        "arrayValues": arrayValues
    }
    // alert("aantes de la peticion");
    jQuery.ajax({
        url: route,
        type: "post",
        data:data,
        dataType: "json",
        success:function(result){
            if(result.status == true)
            {
                // GuardarRecibos();>
                if(clientType == 0)
                {
                    // alert("entre a cliente");
                    actualizarCliente(1);
                }
                else
                {
                    // alert("entre a empresa");
    
                    actualizarEmpresa(2);
                }
            }else{
                alertify.error("No se guardo la poliza, verifique sus datos.");

            }

        }
    });


    // en inicial se guarda fk_agent, fk_insurance, fk_branch, pna, fk_currency, fk_payment_form y fk_charge
    // guardar todos los datos de la póliza
    // lo demás se guarda en la tabla de la póliza
}


function calculo(){
    var ivapor = $("#ivapor").val();
    var other = $("#other_exp").val();
    var finan_exp = $("#financ_exp").val();
    var prima = $("#pna").val();
    var exp = $("#expedition").val();

    if(ivapor != ""){
        ivapor = parseFloat(ivapor);
    }
    else{
        ivapor = 0;
    }
    if(other != ""){
        other = parseFloat(other);
    }
    else{
        other = 0;
    }
    if(finan_exp != ""){
        finan_exp = parseFloat(finan_exp);
    }
    else{
        finan_exp = 0;
    }
    if(prima != ""){
        prima = parseFloat(prima);
    }
    else{
        prima = 0;
    }
    if(exp != ""){
        exp = parseFloat(exp);
    }
    else{
        exp = 0;
    }

    var temp = other + finan_exp+ prima + exp;

    var iva = temp * ivapor;
    $("#iva").val(parseFloat(iva).toFixed(2));

    temp = temp+ iva;
    $("#prima_t").val(parseFloat(temp).toFixed(2));
}
function fechafin(){
    var fecha_i = $("#initial_date").val();
    var fecha = fecha_i.split("-");
    fecha[0] = parseInt(fecha[0]) + 1;
    var fechamas = fecha[0].toString() + "-" + fecha[1] + "-" + fecha[2];
    $("#end_date").val(fechamas);
    
}

var arrayValues = [];

function mostrartabla(){
    var pay_frec = parseInt($("#pay_frec").val());
    // var table = $("#tbodyRecords");
    var tablerec = $('#tablerecords').DataTable();
    var expedition = $("#expedition").val();
    var exp_impute = parseInt($("#exp_impute").val());
    var financ_exp = $("#financ_exp").val();
    var financ_impute = parseInt($("#financ_impute").val());
    var other_exp = $("#other_exp").val();
    var other_impute = parseInt($("#other_impute").val());
    var ivapor = $("#ivapor").val();
    var pna = parseFloat($("#pna").val())/pay_frec;
    var fecha_i = $("#initial_date").val();
    var fecha = fecha_i.split("-");

    fechaDiv = new Date();
    fechaDiv.setFullYear(fecha[0],parseInt(fecha[1]) - 1,fecha[2]);

    if(ivapor != ""){
        ivapor = parseFloat(ivapor);
    }
    else{
        ivapor = 0;
    }
    if(other_exp != ""){
        other_exp = parseFloat(other_exp);
    }
    else{
        other_exp = 0;
    }
    if(financ_exp != ""){
        financ_exp = parseFloat(financ_exp);
    }
    else{
        financ_exp = 0;
    }
    if(pna != ""){
        pna = parseFloat(pna);
    }
    else{
        pna = 0;
    }
    if(expedition != ""){
        expedition = parseFloat(expedition);
    }
    else{
        expedition = 0;
    }

    var values_total = 0; 
    var values_exp = 0; 
    var values_financ = 0;
    var values_other = 0; 
    var iva = 0;
    var fechaBD;
    var fechaInicio;
    var arrayfill;
    arrayValues = [];
    // tablerec.empty();
    tablerec.clear();  

    for(var x = 0 ; x<pay_frec ; x++)
    {
        values_total = 0;
        if(exp_impute == 1 && x == 0){
            values_exp = expedition;
            values_total +=  expedition;
        }
        else if(exp_impute == 2){
            values_exp = expedition/pay_frec;
            values_total +=  expedition/pay_frec;
        }
        else{
            values_exp = 0;
        }

        if(financ_impute == 1 && x == 0){
            values_financ = financ_exp;
            values_total +=  financ_exp;
        }
        else if(financ_impute == 2){
            values_financ = financ_exp/pay_frec;
            values_total +=  financ_exp/pay_frec;
        }
        else{
            values_financ = 0;
        }

        if(other_impute == 1 && x == 0){
            values_other = other_exp;
            values_total +=  other_exp;
        }
        else if(other_impute == 2){
            values_other = other_exp/pay_frec;
            values_total +=  other_exp/pay_frec;
        }
        else{
            values_other = 0;
        }

        if(x != 0){
            fechaDiv.setMonth(fechaDiv.getMonth() + 12/pay_frec);
        }
        fechaBD = fechaDiv.getFullYear().toString() + "-" + (padLeadingZeros((fechaDiv.getMonth() + 1),2)).toString() + "-" + (padLeadingZeros(fechaDiv.getDate(),2)).toString();
        fechaInicio = (padLeadingZeros(fechaDiv.getDate(),2)).toString() + "-" + (padLeadingZeros((fechaDiv.getMonth() + 1),2)).toString() + "-" + fechaDiv.getFullYear().toString();

        values_total += pna;
        iva = values_total * ivapor;
        values_total += iva;

        // var str_row = '<tr id = "'+parseFloat(x)+'"><td>"'+pna.toFixed(2)+'"</td><td>"'+values_exp.toFixed(2)+'"</td><td>"'+values_financ.toFixed(2)+'"</td><td>"'+values_other.toFixed(2)+'"</td><td>"'+iva.toFixed(2)+'"</td><td>"'+values_total.toFixed(2)+'"</td><td>"'+fechaInicio+'"</td><td>"'+fechaInicio+'"</td></tr>';
        // table.append(str_row);
        tablerec.row.add([formatter.format(pna.toFixed(2)), formatter.format(values_exp.toFixed(2)), formatter.format(values_financ.toFixed(2)), formatter.format(values_other.toFixed(2)),
            formatter.format(iva.toFixed(2)), formatter.format(values_total.toFixed(2)),fechaBD,fechaBD]).draw(false);
            arrayfill = {pna , values_exp, values_financ, values_other, iva, values_total, fechaBD}; 
        arrayValues.push(arrayfill);
        
    }
    $("#btn_save").prop("disabled",false);
  
}
function padLeadingZeros(num, size){
    var s = num + "";
    while (s.length < size) s = "0" + s;
    return s;
}

var formatter = new Intl.NumberFormat('en-US', {
    style: 'currency',
    currency: 'USD',
  });