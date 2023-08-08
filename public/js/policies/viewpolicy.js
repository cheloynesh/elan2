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

$(document).ready( function () {
    $('#tbnotFnd').DataTable({
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
            'excel'
        ]
    });
} );

var active = 1;

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
var policyEdit = 0;

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
                // console.log(valor.status);
                if (valor.status == null ) {
                    if(result.permission['modify'])
                        button = '<button href="#|" class="btn btn-danger" onclick="payrecord('+valor.id+')" ><i class="fas fa-piggy-bank"></button>';
                    else
                        button = '<button href="#|" class="btn btn-danger" @if($perm_btn['+'"modify"'+']!=1) disabled @endif onclick="payrecord('+valor.id+')" ><i class="fas fa-piggy-bank"></button>';
                } else {
                    if(result.permission['modify'])
                        button = '<button href="#|" class="btn btn-success btn-sm" onclick="cancelAuth('+valor.id+')" >'+valor.status+'</button>';
                    else
                        button = '<button href="#|" class="btn btn-success btn-sm" @if($perm_btn['+'"modify"'+']!=1) disabled @endif onclick="cancelAuth('+valor.id+')" >'+valor.status+'</button>';
                }
                table.row.add([formatter.format(valor.pna), formatter.format(valor.expedition), formatter.format(valor.financ_exp),
                    formatter.format(valor.other_exp), formatter.format(valor.iva), formatter.format(valor.pna_t),
                    valor.initial_date, valor.end_date, button]).node().id = valor.id;

            });
            table.draw(false);
        },
        error:function(result,error,errorTrown)
        {
            alertify.error(errorTrown);
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
        'active':active
    }
    jQuery.ajax({
        url:route,
        data: data,
        type:'post',
        dataType:'json',
        success:function(result){
            alertify.success(result.message);
            $("#authModal").modal('hide');
            verRecibos(idPolicy);
            RefreshTable(result.policies,result.profile,result.permission);
            // $("#myModalReceipts").modal('hide');
            // window.location.reload(true);
        },
        error:function(result,error,errorTrown)
        {
            alertify.error(errorTrown);
        }
    })
}
function cancelAuth(id)
{
    var route = baseUrlPolizaView + '/cancelpaypolicy';
    var data = {
        "_token": $("meta[name='csrf-token']").attr("content"),
        "id":id,
        'active':active
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
                    verRecibos(idPolicy);
                    RefreshTable(result.policies,result.profile,result.permission);
                    // $("#myModalReceipts").modal('hide');
                    // window.location.reload(true);
                },
                error:function(result,error,errorTrown)
                {
                    alertify.error(errorTrown);
                }
            })
        },
        function(){});
}
var newclient = 0;
idClient = 0;
clientType = 0;
function editarPoliza(id)
{
    var tablerec = $('#tablerecords_edit').DataTable();
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

            policyEdit = result.data.policy;
            $("#poliza").val(result.data.policy);
            $("#pna_edit").val(parseFloat(result.data.pna).toLocaleString('en-US'));
            $("#expedition_edit").val(parseFloat(result.data.expended_exp).toLocaleString('en-US'));
            $("#exp_impute_edit").val(result.data.exp_impute);

            $("#financ_exp_edit").val(parseFloat(result.data.financ_exp).toLocaleString('en-US'));
            $("#financ_impute_edit").val(result.data.financ_impute);
            $("#other_exp_edit").val(parseFloat(result.data.other_exp).toLocaleString('en-US'));

            $("#other_impute_edit").val(result.data.other_impute);
            $("#iva_edit").val(formatter.format(result.data.iva));
            // $("#ivapor_edit").val(result.data.);

            $("#reference").val(result.data.reference);
            $("#prima_t_edit").val(formatter.format(result.data.total));
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

            if(result.data.type == 1)
                $("#onoffType").bootstrapToggle('on');
            else
                $("#onoffType").bootstrapToggle('off');

            checkPolicyNumber();
            tablerec.clear();
            tablerec.draw(false);
            $("#myModalEdit").modal("show");
        },
        error:function(result,error,errorTrown)
        {
            alertify.error(errorTrown);
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
        guardarPoliza(0);
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
            },
            error:function(result,error,errorTrown)
            {
                alertify.error(errorTrown);
            }
        })
        window.location.reload(true);
    }
    else
    {
        var route = baseUrlPolizaView + '/GetPolicies/'+active;
        jQuery.ajax({
            url:route,
            type:'get',
            dataType:'json',
            success:function(result){
                RefreshTable(result.policies,result.profile,result.permission);
            },
            error:function(result,error,errorTrown)
            {
                alertify.error(errorTrown);
            }
        })
    }

}

function actualizarpoliza()
{
    // console.log(updatedReceipt);
    var policy = $("#poliza").val();
    var pna = $("#pna_edit").val().replace(/[^0-9.]/g, '');
    var expended_exp = $("#expedition_edit").val().replace(/[^0-9.]/g, '');
    var exp_impute = $("#exp_impute_edit").val();
    var financ_exp = $("#financ_exp_edit").val().replace(/[^0-9.]/g, '');
    var financ_impute = $("#financ_impute_edit").val();
    var other_exp = $("#other_exp_edit").val().replace(/[^0-9.]/g, '');
    var other_impute = $("#other_impute_edit").val();
    var iva = $("#iva_edit").val().replace(/[^0-9.]/g, '');
    var reference=$("#reference").val();
    var prima_t = $("#prima_t_edit").val().replace(/[^0-9.]/g, '');
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
    var reg = $("#onoffType").prop('checked');
    var type = 0;
    if(reg)
        type = 1;
    else
        type = 2;

// console.log(idPolicy);
    var data = {
        "id":idPolicy,
        "_token": $("meta[name='csrf-token']").attr("content"),
        // "policy":policy,
        "policy":policy,
        "expended":expended_exp,
        "exp_imp":exp_impute,
        "financ_exp":financ_exp,
        "financ_imp":financ_impute,
        "other_exp":other_exp,
        "other_imp":other_impute,
        "iva":iva,
        "pna_t":prima_t,
        "renovable":renovable,
        "reference":reference,
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
        "updateReceipts":updatedReceipt,
        "type":type

    }
    var route = getUrlPolizaView .protocol + "//" + getUrlPolizaView.host + "/policies/policy/" + idPolicy;
    // console.log(route);

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
                actualizarCliente(0);
            }
            else
            {
                // alert("entre a empresa");

                actualizarEmpresa(0);
            }
            alertify.success(result.message);
            $("#myModalEdit").modal("hide");
            // window.location.reload(true);

        },
        error:function(result,error,errorTrown)
        {
            alertify.error(errorTrown);
        }
    })
}

function guardarPoliza(initial)
{
    // guardardatosClienteInicial();
    // alert("entre a guardar");
    var policy = $("#poliza").val();
    var pna = $("#pna_edit").val().replace(/[^0-9.]/g, '');
    var expended_exp = $("#expedition_edit").val().replace(/[^0-9.]/g, '');
    var exp_impute = $("#exp_impute_edit").val();
    var financ_exp = $("#financ_exp_edit").val().replace(/[^0-9.]/g, '');
    var financ_impute = $("#financ_impute_edit").val();
    var other_exp = $("#other_exp_edit").val().replace(/[^0-9.]/g, '');
    var other_impute = $("#other_impute_edit").val();
    var iva = $("#iva_edit").val().replace(/[^0-9.]/g, '');

    var reference=$("#reference").val();
    var prima_t = $("#prima_t_edit").val().replace(/[^0-9.]/g, '');
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
    var reg = $("#onoffType").prop('checked');
    var type = 0;
    if(reg)
        type = 1;
    else
        type = 2;

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
        "policy":policy,
        "expended":expended_exp,
        "exp_imp":exp_impute,
        "financ_exp":financ_exp,
        "financ_imp":financ_impute,
        "other_exp":other_exp,
        "other_imp":other_impute,
        "iva":iva,
        "pna_t":prima_t,
        "renovable":renovable,
        "reference":reference,
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
        "arrayValues": arrayValues,
        "type":type,
        "fk_initial":initial
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
                if(newclient == 1)
                {
                    // GuardarRecibos();>
                    if(clientType == 0)
                    {
                        // alert("entre a cliente");
                        actualizarCliente(0);
                    }
                    else
                    {
                        // alert("entre a empresa");
                        actualizarEmpresa(0);
                    }
                }

                if(initial != 0)
                {
                    var commentary = $("#commentary").val();
                    var route = baseUrlInicial+"/updateStatus";
                    var data = {
                        'id':id_initial,
                        "_token": $("meta[name='csrf-token']").attr("content"),
                        'status':4,
                        'commentary':commentary
                    };
                    jQuery.ajax({
                        url:route,
                        type:'post',
                        data:data,
                        dataType:'json',
                        success:function(result)
                        {
                            alertify.success("Póliza emitida");
                            FillTable(result.initials,result.profile,result.permission);
                            $("#myEstatusModal").modal('hide');
                        },
                        error:function(result,error,errorTrown)
                        {
                            alertify.error(errorTrown);
                        }
                    })
                }

                alertify.success("Poliza Creada");
                $("#myModalEdit").modal("hide");
                // window.location.reload(true);
            }
            else{
                alertify.error("No se guardo la poliza, verifique sus datos.");

            }

        },
        error:function(result,error,errorTrown)
        {
            alertify.error(errorTrown);
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
    var other = $("#other_exp_edit").val().replace(/[^0-9.]/g, '');
    var finan_exp = $("#financ_exp_edit").val().replace(/[^0-9.]/g, '');
    var prima = $("#pna_edit").val().replace(/[^0-9.]/g, '');
    var exp = $("#expedition_edit").val().replace(/[^0-9.]/g, '');

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
    $("#iva_edit").val(formatter.format(parseFloat(iva).toFixed(2)));

    temp = temp+ iva;
    $("#prima_t_edit").val(formatter.format(parseFloat(temp).toFixed(2)));
}


function mostrartabla(){
    updatedReceipt = 1;
    var pay_frec = parseInt($("#pay_frec_edit").val());
    // var table = $("#tbodyRecords");
    var tablerec = $('#tablerecords_edit').DataTable();
    var expedition = $("#expedition_edit").val().replace(/[^0-9.]/g, '');
    var exp_impute = parseInt($("#exp_impute_edit").val());
    var financ_exp = $("#financ_exp_edit").val().replace(/[^0-9.]/g, '');
    var financ_impute = parseInt($("#financ_impute_edit").val());
    var other_exp = $("#other_exp_edit").val().replace(/[^0-9.]/g, '');
    var other_impute = parseInt($("#other_impute_edit").val());
    var ivapor = $("#ivapor_edit").val().replace(/[^0-9.]/g, '');
    var pna = parseFloat($("#pna_edit").val().replace(/[^0-9.]/g, ''))/pay_frec;
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
            var day = fechaDiv.getDate();
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
                    fechaDiv.addMonths(12/pay_frec,day);
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
        },
        error:function(result,error,errorTrown)
        {
            alertify.error(errorTrown);
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
            },
            error:function(result,error,errorTrown)
            {
                alertify.error(errorTrown);
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
        'status':status,
        'active':active
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
            RefreshTable(result.policies,result.profile,result.permission);
        },
        error:function(result,error,errorTrown)
        {
            alertify.error(errorTrown);
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
        },
        error:function(result,error,errorTrown)
        {
            alertify.error(errorTrown);
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
        },
        error:function(result,error,errorTrown)
        {
            alertify.error(errorTrown);
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

function checkPolicyNumber(){
    var policy = $("#poliza").val();
    var routePoliza = getUrlPolizaView .protocol + "//" + getUrlPolizaView.host + "/policies/policy/CheckPolicy/" + policy;
    var disponible = document.getElementById("disponible");
    var noDisponible = document.getElementById("noDisponible");

    if(policy != policyEdit)
    {
        jQuery.ajax({
            url:routePoliza,
            type:'get',
            dataType:'json',
            success:function(result)
            {
                if (result == 0)
                {
                    // policyVerif = 1;
                    // checkConditions();
                    $("#btnModalView").prop("disabled",false);
                    disponible.style.display = "";
                    noDisponible.style.display = "none";
                }
                else
                {
                    $("#btnModalView").prop("disabled",true);
                    disponible.style.display = "none";
                    noDisponible.style.display = "";
                }
            },
            error:function(result,error,errorTrown)
            {
                alertify.error(errorTrown);
            }
        })
    }
    else
    {
        $("#btnModalView").prop("disabled",false);
        disponible.style.display = "none";
        noDisponible.style.display = "none";
    }
}

function RefreshTable(data,profile,permission)
{
    var table = $('#tbPoliza').DataTable();
    var btnStat = '';
    var btnRecpt = '';
    var btnEdit = '';
    var btnTrash = '';
    var type = '';
    table.clear();

    data.forEach( function(valor, indice, array) {
        btnStat = '<button class="btn btn-info" style="background-color: #'+valor.color+'; border-color: #'+valor.color+'" onclick="opcionesEstatus('+valor.id+','+valor.statId+')">'+valor.statName+'</button>';
        btnRecpt = '<a href="#|" class="btn btn-primary" onclick="verRecibos('+valor.id+')">Ver Recibos</a>'
        btnEdit = '<button href="#|" class="btn btn-warning" onclick="editarPoliza('+valor.id+')" ><i class="fa fa-edit"></i></button>';
        btnTrash = '<button href="#|" class="btn btn-danger" onclick="eliminarPoliza('+valor.id+')"><i class="fa fa-trash"></i></button>';
        if(valor.type == 1) type = "Inicial"; else type = "Renovación";
        // alert(valor.id);
        if(permission["erase"] == 1)
            table.row.add([valor.agname,valor.rfc,valor.policy,valor.branch,valor.cname,type,valor.pnaa,valor.initial_date,valor.end_date,btnStat,btnRecpt+ " " + btnEdit+" "+btnTrash]).node().id = valor.id;
        else
            table.row.add([valor.agname,valor.rfc,valor.policy,valor.branch,valor.cname,type,valor.pnaa,valor.initial_date,valor.end_date,btnStat,btnRecpt + " " + btnEdit]).node().id = valor.id;
    });
    table.draw(false);
}

function chkActive()
{
    if (document.getElementById('chkActive').checked) active = 0; else active = 1;

    var route = baseUrlPolizaView + '/GetPolicies/'+active;
    // alert(route);
    jQuery.ajax({
        url:route,
        type:'get',
        dataType:'json',
        success:function(result)
        {
            RefreshTable(result.policies,result.profile,result.permission);
        }
    })
}

function act()
{
    var route = baseUrlPolizaView + '/GetP/1';
    // alert(route);
    jQuery.ajax({
        url:route,
        type:'get',
        dataType:'json',
        success:function(result)
        {
            result.policies.forEach( function(valor, indice, array) {
                fechaDiv = new Date(valor.initial_date+" 00:00:00");
                console.log("--------------------"+valor.initial_date);
                const pay_frec = valor.fk_payment_form;
                var day = fechaDiv.getDate();
                var dates = [];
                for(var x = 0 ; x<pay_frec ; x++)
                {
                    if(x != 0){
                        fechaDiv.addMonths(12/pay_frec,day);
                    }
                    fechaBD = fechaDiv.getFullYear().toString() + "-" + (padLeadingZeros((fechaDiv.getMonth() + 1),2)).toString() + "-" + (padLeadingZeros(fechaDiv.getDate(),2)).toString();
                    dates.push(fechaBD);
                    // console.log(fechaDiv);
                }

                var route = baseUrlPolizaView + '/updateDate';
                var data = {
                    "_token": $("meta[name='csrf-token']").attr("content"),
                    "id":valor.id,
                    'dates':dates
                }
                jQuery.ajax({
                    url:route,
                    data: data,
                    type:'post',
                    dataType:'json',
                    success:function(result){
                    },
                    error:function(result,error,errorTrown)
                    {
                        alertify.error(errorTrown);
                    }
                })
            });
        },
        error:function(result,error,errorTrown)
        {
            alertify.error(errorTrown);
        }
    })
}

function importexc()
{
    if (document.getElementById('chkActive').checked) active = 0; else active = 1;
    var table = $('#tbnotFnd').DataTable();
    var resultrow = document.getElementById("resultrow");
    var waitrow = document.getElementById("waitrow");
    document.getElementById("closeBtn").hidden = true;
    waitrow.style.display = "";
    resultrow.style.display = "none";
    $("#waitModal").modal('show');
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

    var route = baseUrlPolizaView + '/import/'+active;

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
            notFnd = result.notFnd.filter((item,index)=>{return result.notFnd.indexOf(item) === index;})
            $("#importados").val(result.importados);
            $("#notFnd").val(notFnd.length);
            table.clear();
            notFnd.forEach( function(valor, indice, array) {
                table.row.add([valor]).node().id = valor;
            });
            table.draw(false);
            document.getElementById("closeBtn").hidden = false;
            waitrow.style.display = "none";
            resultrow.style.display = "";
            RefreshTable(result.policies,result.profile,result.permission);
            // alert("Movimientos importados: " + result.importados + "\nDatos repetidos: " + result.repetidos + "\nNucs no encontrados: " + notFnd.length + "\n" + notFnd.join("\n"));
            // $("#waitModal").modal('hide');

        },
        error:function(result,error,errorTrown)
        {
            alertify.error(errorTrown);
            $("#waitModal").modal('hide');
        }
    })
}

function cerrarWait()
{
    $("#waitModal").modal('hide');
}

Date.isLeapYear = function (year) {
    return (((year % 4 === 0) && (year % 100 !== 0)) || (year % 400 === 0));
};

Date.getDaysInMonth = function (year, month) {
    return [31, (Date.isLeapYear(year) ? 29 : 28), 31, 30, 31, 30, 31, 31, 30, 31, 30, 31][month];
};

Date.prototype.isLeapYear = function () {
    return Date.isLeapYear(this.getFullYear());
};

Date.prototype.getDaysInMonth = function () {
    return Date.getDaysInMonth(this.getFullYear(), this.getMonth());
};

Date.prototype.addMonths = function (value,day) {
    this.setDate(1);
    this.setMonth(this.getMonth() + value);
    this.setDate(Math.min(day, this.getDaysInMonth()));
    return this;
};
