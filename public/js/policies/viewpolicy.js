var rutaPolizaView = window.location;
var getUrlPolizaView = window.location;
var baseUrlPolizaView = getUrlPolizaView .protocol + "//" + getUrlPolizaView.host + "/policies/viewPolicies";
$(document).ready( function () {
    $('#tbPoliza').DataTable({
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
        },
        aLengthMenu: [
            [25, 50, 100, 200, -1],
            [25, 50, 100, 200, "All"]
        ],
        iDisplayLength: -1
    });
} );
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
    $('#tablerecords_edit').DataTable({
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
        aLengthMenu: [
            [25, 50, 100, 200, -1],
            [25, 50, 100, 200, "All"]
        ],
        iDisplayLength: -1
    });
} );

function actualizarSelect(result, select)
{
    var assignPlan = $(select);

    $(select).empty();
    if(result.length == 0 || result == null) assignPlan.append('<option selected  value="0">Seleccione una opción</option>');
    else assignPlan.append('<option selected hidden value="0">Seleccione una opción</option>');
    result.forEach( function(valor, indice, array) {
        assignPlan.append("<option value='" + valor.id + "'>" + valor.name + "</option>");
    });
}

var formatter = new Intl.NumberFormat('en-US', {
    style: 'currency',
    currency: 'USD',
  });

var idPolicy = 0;
var button = "";
var policyNumber = 0;
var serviceFlag = 0;
var updatedReceipt = 0;

function verRecibos(id){
    // alert(id);
    idPolicy=id;
    var route = baseUrlPolizaView + '/ViewReceipts/'+id;
    jQuery.ajax({
        url: route,
        type: 'get',
        dataType: 'json',
        success:function(result){
            // var array = [];
            var table = $("#tablerecords").DataTable();
            table.clear();
            // array = result.data;
            result.data.forEach( function(valor, indice, array){
                console.log(valor.status);
                if (valor.status == null ) {
                    button = '<button href="#|" class="btn btn-danger" @if ($perm_btn['+'modify'+']!=1) disabled @endif onclick="payrecord('+valor.id+')" ><i class="fas fa-piggy-bank"></button>';
                } else {
                    button = '<button href="#|" class="btn btn-success btn-sm" @if ($perm_btn['+'modify'+']!=1) disabled @endif onclick="cancelAuth('+valor.id+')" >'+valor.status+'</button>';
                }
                table.row.add([formatter.format(valor.pna), formatter.format(valor.expedition), formatter.format(valor.financ_exp),
                    formatter.format(valor.other_exp), formatter.format(valor.iva), formatter.format(valor.pna_t),
                    valor.initial_date, valor.end_date, button]).node().id = valor.id;

            });
            table.draw(false);
        }
    })
    $("#myModalReceipts").modal("show");

}

function closereceipts(){
    $("#myModalReceipts").modal("hide");

}
var idMovimiento = 0;
function payrecord(id)
{
    idMovimiento = id;
    var today = new Date();
    var dd = String(today.getDate()).padStart(2, '0');
    var mm = String(today.getMonth() + 1).padStart(2, '0');
    var yyyy = today.getFullYear();

    $("#auth").val(yyyy+"-"+mm+"-"+dd);
    $("#authModal").modal('show');
}
function cerrarAuth()
{
    $("#authModal").modal('hide');
}
function guardarAuth()
{
    var route = baseUrlPolizaView + '/paypolicy';
    var auth = $("#auth").val();
    var data = {
        "_token": $("meta[name='csrf-token']").attr("content"),
        "id":idMovimiento,
        'auth':auth,
    }
    jQuery.ajax({
        url:route,
        data: data,
        type:'post',
        dataType:'json',
        success:function(result){
            alertify.success(result.message);
            $("#authModal").modal('hide');
            $("#myModalReceipts").modal('hide');
            window.location.reload(true);
        }
    })
}
function cancelAuth(id)
{
    var route = baseUrlPolizaView + '/cancelpaypolicy';
    var data = {
        "_token": $("meta[name='csrf-token']").attr("content"),
        "id":id,
    }
    alertify.confirm("Cancelar pago","¿Desea cancelar el pago?",
        function(){
            jQuery.ajax({
                url:route,
                data: data,
                type:'post',
                dataType:'json',
                success:function(result){
                    alertify.success(result.message);
                    $("#myModalReceipts").modal('hide');
                    window.location.reload(true);
                }
            })
        },
        function(){});
}
idClient = 0;
clientType = 0;
function editarPoliza(id)
{
    var route = baseUrlPolizaView + '/GetInfo/' +id;
    idPolicy=id;
    jQuery.ajax({
        url:route,
        type:'get',
        dataType:'json',
        success:function(result){
            updatedReceipt = 0;
            // console.log(result.data.initial_date);
            // console.log(result.data.initial_date);
            clientType = result.data.status;
            idClient = result.data.fk_client;
            if(clientType == 0)
            {
                idupdate=id;
                fisica.style.display = ""
                moral.style.display = "none"
                editarCliente(result.data.fk_client);
            }
            else
            {
                idupdateE=id;
                fisica.style.display = "none"
                moral.style.display = ""
                editarEmpresa(result.data.fk_client);
            }

            $("#pna_edit").val(result.data.pna);
            $("#expedition_edit").val(result.data.expended_exp);
            $("#exp_impute_edit").val(result.data.exp_impute);

            $("#financ_exp_edit").val(result.data.financ_exp);
            $("#financ_impute_edit").val(result.data.financ_impute);
            $("#other_exp_edit").val(result.data.other_exp);

            $("#other_impute_edit").val(result.data.other_impute);
            $("#iva_edit").val(result.data.iva);
            // $("#ivapor_edit").val(result.data.);

            $("#prima_t_edit").val(result.data.total);
            $("#selectCurrency_edit").val(result.data.fk_currency);
            $("#renovable_edit").val(result.data.renovable);


            $("#selectInsurance_edit").val(result.data.fk_insurance);

            actualizarSelect(result.branches,"#selectBranch_edit");
            actualizarSelect(result.plans,"#selectPlan_edit");

            $("#selectBranch_edit").val(result.data.fk_branch);
            $("#selectPlan_edit").val(result.data.fk_plan);

            $("#selectAgent_edit").val(result.data.fk_agent);

            $("#pay_frec_edit").val(result.data.fk_payment_form);
            $("#selectCharge_edit").val(result.data.fk_charge);

            $("#initial_date_edit").val(result.data.initial_date);
            $("#end_date_edit").val(result.data.end_date);
            $("#client_edit").val(result.data.name);

            $("#myModalEdit").modal("show");
        }
    })
}

function cancelareditar(){
    $("#myModalEdit").modal("hide");

}
var arrayValues = [];

function aceptarPoliza()
{
    if(idPolicy == 0)
    {
        guardarPoliza();
    }
    else
    {
        actualizarpoliza();
    }

    if(serviceFlag == 1)
    {
        var commentary = $("#commentary").val();
        var route = baseUrlService+"/updateStatus";
        var data = {
            'id':id_service,
            "_token": $("meta[name='csrf-token']").attr("content"),
            'status':8,
            'commentary':commentary
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
            }
        })
    }
    window.location.reload(true);

}

function actualizarpoliza()
{
    console.log(updatedReceipt);
    var pna = $("#pna_edit").val();
    var expended_exp = $("#expedition_edit").val();
    var exp_impute = $("#exp_impute_edit").val();
    var financ_exp = $("#financ_exp_edit").val();
    var financ_impute = $("#financ_impute_edit").val();
    var other_exp = $("#other_exp_edit").val();
    var other_impute = $("#other_impute_edit").val();
    var iva = $("#iva_edit").val();
    var prima_t = $("#prima_t_edit").val();
    var fk_currency = $("#selectCurrency_edit").val();
    var renovable = $("#renovable_edit").val();
    var fk_insurance = $("#selectInsurance_edit").val();
    var fk_branch = $("#selectBranch_edit").val();
    var fk_plan = $("#selectPlan_edit").val();
    var fk_agent = $("#selectAgent_edit").val();
    var fk_charge = $("#selectCharge_edit").val();
    var fk_payment_form = $("#pay_frec_edit").val();
    var initial_date = $("#initial_date_edit").val();
    var end_date = $("#end_date_edit").val();

// console.log(idPolicy);
    var data = {
        "id":idPolicy,
        "_token": $("meta[name='csrf-token']").attr("content"),
        // "policy":policy,
        "expended":expended_exp,
        "exp_imp":exp_impute,
        "financ_exp":financ_exp,
        "financ_imp":financ_impute,
        "other_exp":other_exp,
        "other_imp":other_impute,
        "iva":iva,
        "pna_t":prima_t,
        "renovable":renovable,
        "pna": pna,
        "currency": fk_currency,
        "insurance": fk_insurance,
        "branch": fk_branch,
        "plan": fk_plan,
        "agent": fk_agent,
        "charge": fk_charge,
        "paymentForm": fk_payment_form,
        "initial_date":initial_date,
        "end_date":end_date,
        "arrayValues":arrayValues,
        "fk_client":idClient,
        "updateReceipts":updatedReceipt

    }
    var route = getUrlPolizaView .protocol + "//" + getUrlPolizaView.host + "/policies/policy/" + idPolicy;
    console.log(route);

    jQuery.ajax({
        url:route,
        type:"put",
        data:data,
        dataType:'json',
        success:function(result)
        {
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
            alertify.success(result.message);
            $("#myModalEdit").modal("hide");
            // window.location.reload(true);

        }
    })
}

function guardarPoliza()
{
    // guardardatosClienteInicial();
    // alert("entre a guardar");
    var policy = $("#poliza").val();
    var pna = $("#pna_edit").val();
    var expended_exp = $("#expedition_edit").val();
    var exp_impute = $("#exp_impute_edit").val();
    var financ_exp = $("#financ_exp_edit").val();
    var financ_impute = $("#financ_impute_edit").val();
    var other_exp = $("#other_exp_edit").val();
    var other_impute = $("#other_impute_edit").val();
    var iva = $("#iva_edit").val();
    var prima_t = $("#prima_t_edit").val();
    var fk_currency = $("#selectCurrency_edit").val();
    var renovable = $("#renovable_edit").val();
    var fk_insurance = $("#selectInsurance_edit").val();
    var fk_branch = $("#selectBranch_edit").val();
    var fk_plan = $("#selectPlan_edit").val();
    var fk_agent = $("#selectAgent_edit").val();
    var fk_charge = $("#selectCharge_edit").val();
    var fk_payment_form = $("#pay_frec_edit").val();
    var initial_date = $("#initial_date_edit").val();
    var end_date = $("#end_date_edit").val();

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
    if(expended_exp != ""){
        expended_exp = parseFloat(expended_exp);
    }
    else{
        expended_exp = 0;
    }

    var route = getUrlPolizaView .protocol + "//" + getUrlPolizaView.host + "/policies/policy";
    // alert(route);
    var data = {
        "id":idClient,
        "_token": $("meta[name='csrf-token']").attr("content"),
        "policy":policyNumber,
        "expended":expended_exp,
        "exp_imp":exp_impute,
        "financ_exp":financ_exp,
        "financ_imp":financ_impute,
        "other_exp":other_exp,
        "other_imp":other_impute,
        "iva":iva,
        "pna_t":prima_t,
        "renovable":renovable,
        "pna": pna,
        "currency": fk_currency,
        "insurance": fk_insurance,
        "branch": fk_branch,
        "plan": fk_plan,
        "agent": fk_agent,
        "charge": fk_charge,
        "paymentForm": fk_payment_form,
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
                alertify.success("Poliza Creada");
                $("#myModalEdit").modal("hide");
                // window.location.reload(true);
            }else{
                alertify.error("No se guardo la poliza, verifique sus datos.");

            }

        }
    });
}

function fechafin(){
    var fecha_i = $("#initial_date_edit").val();
    var fecha = fecha_i.split("-");
    fecha[0] = parseInt(fecha[0]) + 1;
    var fechamas = fecha[0].toString() + "-" + fecha[1] + "-" + fecha[2];
    $("#end_date_edit").val(fechamas);

}
function calculo(){
    var ivapor = $("#ivapor_edit").val();
    var other = $("#other_exp_edit").val();
    var finan_exp = $("#financ_exp_edit").val();
    var prima = $("#pna_edit").val();
    var exp = $("#expedition_edit").val();

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
    $("#iva_edit").val(parseFloat(iva).toFixed(2));

    temp = temp+ iva;
    $("#prima_t_edit").val(parseFloat(temp).toFixed(2));
}


function mostrartabla(){
    updatedReceipt = 1;
    var pay_frec = parseInt($("#pay_frec_edit").val());
    // var table = $("#tbodyRecords");
    var tablerec = $('#tablerecords_edit').DataTable();
    var expedition = $("#expedition_edit").val();
    var exp_impute = parseInt($("#exp_impute_edit").val());
    var financ_exp = $("#financ_exp_edit").val();
    var financ_impute = parseInt($("#financ_impute_edit").val());
    var other_exp = $("#other_exp_edit").val();
    var other_impute = parseInt($("#other_impute_edit").val());
    var ivapor = $("#ivapor_edit").val();
    var pna = parseFloat($("#pna_edit").val())/pay_frec;
    var fecha_i = $("#initial_date_edit").val();
    var fecha = fecha_i.split("-");
    var branch =$("#selectBranch_edit").val();
    var days = 0;

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
    var route = getUrlPolizaView .protocol + "//" + getUrlPolizaView.host + '/admin/branch/branches/GetInfo/'+ branch;

    jQuery.ajax({
        url:route,
        type:'get',
        dataType:'json',
        success:function(result)
        {
            console.log(route);
            days = result.data.days;
            console.log(days);
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
                fechaAux = new Date(fechaDiv);
                fechaAux.setDate(fechaAux.getDate() + days);
                fechaFin = fechaAux.getFullYear().toString() + "-" + (padLeadingZeros((fechaAux.getMonth() + 1),2)).toString() + "-" + (padLeadingZeros(fechaAux.getDate(),2)).toString();

                values_total += pna;
                iva = values_total * ivapor;
                values_total += iva;

                // var str_row = '<tr id = "'+parseFloat(x)+'"><td>"'+pna.toFixed(2)+'"</td><td>"'+values_exp.toFixed(2)+'"</td><td>"'+values_financ.toFixed(2)+'"</td><td>"'+values_other.toFixed(2)+'"</td><td>"'+iva.toFixed(2)+'"</td><td>"'+values_total.toFixed(2)+'"</td><td>"'+fechaInicio+'"</td><td>"'+fechaInicio+'"</td></tr>';
                // table.append(str_row);
                tablerec.row.add([formatter.format(pna.toFixed(2)), formatter.format(values_exp.toFixed(2)), formatter.format(values_financ.toFixed(2)), formatter.format(values_other.toFixed(2)),
                    formatter.format(iva.toFixed(2)), formatter.format(values_total.toFixed(2)),fechaBD,fechaFin]).draw(false);
                arrayfill = {pna , values_exp, values_financ, values_other, iva, values_total, fechaBD, fechaFin};
                arrayValues.push(arrayfill);

            }
        }
    })
}
function padLeadingZeros(num, size){
    var s = num + "";
    while (s.length < size) s = "0" + s;
    return s;
}

function eliminarPoliza(id)
{
    var route = getUrlPolizaView .protocol + "//" + getUrlPolizaView.host + "/policies/policy/" + id;
    var data ={
        "id":id,
        "_token": $("meta[name='csrf-token']").attr("content"),

    };
    alertify.confirm("Eliminar Poliza","¿Desea borrar la Poliza?",
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

var id_policy = 0;

function opcionesEstatus(policyId,statusId)
{
    id_policy=policyId;
    $("#selectStatus").val(statusId);
    $("#myEstatusModal").modal('show');
}
function actualizarEstatus()
{
    // alert("entre a viewpolicy");
    var status = $("#selectStatus").val();
    var route = baseUrlPolizaView + "/updateStatus";
    console.log(route);
    var data = {
        'id':id_policy,
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

function llenarRamos(){
    var insurance = $("#selectInsurance_edit").val();

    var route = baseUrlPolizaView + '/getBranches/'+ insurance;

    jQuery.ajax({
        url:route,
        type:'get',
        dataType:'json',
        success:function(result)
        {
            actualizarSelect(result.branches,"#selectBranch_edit");
            llenarPlanes();
        },
        error:function(result,error,errorTrown)
        {
            alertify.error(errorTrown);
        }
    })
}

function llenarPlanes()
{
    var insurance = $("#selectInsurance_edit").val();
    var branch = $("#selectBranch_edit").val();

    var route = baseUrlPolizaView + '/getPlans/'+ insurance + '/' + branch;

    jQuery.ajax({
        url:route,
        type:'get',
        dataType:'json',
        success:function(result)
        {
            actualizarSelect(result.branches,"#selectPlan_edit");
        },
        error:function(result,error,errorTrown)
        {
            alertify.error(errorTrown);
        }
    })
}
function buscarclientes(){
    $("#modalSrcClient").modal("show");
}

function ocultar(){
    $("#modalSrcClient").modal("hide");
}

function obtenerid(id){
    idClient = id;
    var routePoliza = baseUrlPolizaView + '/GetInfoClient/'+ id;
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
                // alert(id);
                idupdate=id;
                fisica.style.display = ""
                moral.style.display = "none"
                editarCliente(id);
            }
            else
            {
                idupdateE=id;
                fisica.style.display = "none"
                moral.style.display = ""
                editarEmpresa(id);
            }
            $("#client_edit").val(result.data.name);
        }
    });

    $("#modalSrcClient").modal("hide");
}

function actualizarStatusPoliza()
{
    var route = baseUrlPolizaView + '/updatePolicies';
    var data = {
        "_token": $("meta[name='csrf-token']").attr("content")
    };
    jQuery.ajax({
        url:route,
        type:'post',
        data:data,
        dataType:'json',
        success:function(result)
        {
            alertify.success(result.message);
        }
    })
}
function abrirFiltro()
{
    $("#myModalExport").modal('show');
}

function cerrarFiltro()
{
    $("#myModalExport").modal('hide');
}

function excel_nuc(){
    var route = baseUrlPolizaView + '/ExportPolicy/' + $("#selectStatusExc").val() + '/' + $("#selectBranchExc").val();
    $.ajaxSetup({
        headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
    });

    var form = $('<form></form>');

    form.attr("method", "get");
    form.attr("action", route);
    form.attr('_token',$("meta[name='csrf-token']").attr("content"));
    $.each(function(key, value) {
        var field = $('<input></input>');
        field.attr("type", "hidden");
        field.attr("name", key);
        field.attr("value", value);
        form.append(field);
    });
    var field = $('<input></input>');
    field.attr("type", "hidden");
    field.attr("name", "_token");
    field.attr("value", $("meta[name='csrf-token']").attr("content"));
    form.append(field);
    $(document.body).append(form);
    form.submit();
}
