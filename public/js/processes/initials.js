var rutaInicial = window.location;
var getUrlInicial = window.location;
var baseUrlInicial = getUrlInicial .protocol + "//" + getUrlInicial.host + getUrlInicial.pathname;

$(document).ready( function () {
    $('#tbProf thead th').each( function () {
        var title = $(this).text();
        $(this).html( '<input type="text" class="form-control" placeholder="Search '+title+'" />' );
    } );
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
        initComplete: function () {
            // Apply the search
            this.api().columns().every( function () {
                var that = this;

                $( 'input', this.header() ).on( 'keyup change clear', function () {
                    if ( that.search() !== this.value ) {
                        that
                            .search( this.value )
                            .draw();
                    }
                } );
            } );
        }
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

function abrirguardarInicial()
{
    $("#myModal").modal('show');
}

function cerrarguardarInicial()
{
    $("#myModal").modal('hide');
}

function guardarInicial(id)
{
    // alert(id);
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
        name = $("#name").val();
        firstname = $("#firstname").val();
        lastname = $("#lastname").val();
        rfc = $("#rfc").val();
        type = 0;
        if(!checkedAsegurado)
        {
            insured = $("#insured").val();
        }
        else
        {
            insured = name + " " + firstname + " " + lastname;
        }
    }
    else
    {
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
    var plan = $("#selectPlan").val();
    var application = $("#selectAppli").val();
    var pna = $("#pna").val().replace(/[^0-9.]/g, '');
    var paymentForm = $("#selectPaymentform").val();
    var currency = $("#selectCurrency").val();
    var charge = $("#selectCharge").val();
    var guide = $("#guide").val();
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
        'plan':plan,
        'application':application,
        'pna':pna,
        'paymentForm':paymentForm,
        'currency':currency,
        'guide':guide,
        'charge':charge
    };
    console.log(data);
    jQuery.ajax({
        url:route,
        type:"post",
        data: data,
        dataType: 'json',
        success:function(result)
        {
            alertify.success(result.message);
            FillTable(result.initials,result.profile,result.permission);
            $("#myModal").modal('hide');
        }
    })
}
var idupdateInitial = 0;
let tipo = 0;

function editarInicial(id)
{
    idupdateInitial=id;

    var fisica = document.getElementById("fisicaedit");
    var moral = document.getElementById("moraledit");

    var route = baseUrlInicial + '/GetInfo/'+ id;

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
                $("#nameEdit").val(result.data.name);
                $("#firstnameEdit").val(result.data.firstname);
                $("#lastnameEdit").val(result.data.lastname);
                $("#rfcEdit").val(result.data.rfc);
            }else{

                moral.style.display="";
                $("#business_nameEdit").val(result.data.name)
                $("#business_rfcEdit").val(result.data.rfc);

            }

            actualizarSelect(result.branches,"#selectBranch1");
            actualizarSelect(result.plans,"#selectPlan1");

            $("#selectBranch1").val(result.data.fk_branch);
            $("#selectPlan1").val(result.data.fk_plan);

            $("#promoter1").val(result.data.promoter_date);
            $("#system1").val(result.data.system_date);
            $("#folio1").val(result.data.folio);
            $("#selectInsurance1").val(result.data.fk_insurance);
            $("#selectBranch1").val(result.data.fk_branch);
            $("#selectAppli1").val(result.data.fk_application);
            $("#pna1").val(parseFloat(result.data.pna).toLocaleString('en-US'));
            $("#selectPaymentform1").val(result.data.fk_payment_form);
            $("#selectCurrency1").val(result.data.fk_currency);
            $("#selectCharge1").val(result.data.fk_charge);
            $("#guide1").val(result.data.guide);
            $("#initial_comm").val(result.data.initial_comm);
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
        $("#nameEdit").val("");
        $("#firstnameEdit").val("");
        $("#lastnameEdit").val("");
        $("#rfcEdit").val("");
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
        // alert('entre');
        var name = $("#nameEdit").val();
        var firstname = $("#firstnameEdit").val();
        var lastname = $("#lastnameEdit").val();
        var rfc = $("#rfcEdit").val();

    }else{
        // alert('entre');
        var name = $("#business_nameEdit").val();
        var rfc = $("#business_rfcEdit").val();
        console.log(name,rfc);
    }
    var promoter = $("#promoter1").val();
    var system = $("#system1").val();
    var folio = $("#folio1").val();
    var insurance = $("#selectInsurance1").val();
    var branch = $("#selectBranch1").val();
    var plan = $("#selectPlan1").val();
    var application = $("#selectAppli1").val();
    var pna = $("#pna1").val().replace(/[^0-9.]/g, '');
    var paymentForm = $("#selectPaymentform1").val();
    var currency = $("#selectCurrency1").val();
    var charge = $("#selectCharge1").val();
    var guide = $("#guide1").val();
    var initial_comm = $("#initial_comm").val();

    var route = "initial/"+idupdateInitial;
    var data = {
        "_token": $("meta[name='csrf-token']").attr("content"),
        'id':idupdateInitial,
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
        'plan':plan,
        'application':application,
        'pna':pna,
        'paymentForm':paymentForm,
        'currency':currency,
        'charge':charge,
        'guide':guide,
        'initial_comm':initial_comm,
    };
    jQuery.ajax({
        url:route,
        type:'put',
        data:data,
        dataType:'json',
        success:function(result)
        {
            alertify.success(result.message);
            FillTable(result.initials,result.profile,result.permission);
            $("#myModaledit").modal('hide');
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
                    FillTable(result.initials,result.profile,result.permission);
                    // window.location.reload(true);
                    alertify.success('Eliminado');
                }
            })
        },
        function(){
            alertify.error('Cancelado');
    });

}
var id_initial = 0;

function opcionesEstatus(initialId,statusId,)
{
    id_initial=initialId;
    var route = baseUrlInicial+'/GetinfoStatus/'+id_initial;
    jQuery.ajax({
        url:route,
        type:'get',
        dataType:'json',
        success:function(result){
            console.log(result);
            $("#selectStatus").val(statusId);
            $("#commentary").val(result.data.commentary);
            $("#myEstatusModal").modal('show');
        }
    })
}
var initialinfo;
function actualizarEstatus()
{
    var status = $("#selectStatus").val();
    var sub_status = $("#selectSubEstatus").val();
    var commentary = $("#commentary").val();
    if(status == 4)
    {
        var route = baseUrlInicial + "/GetPolicyInfo/" + id_initial;
        var data = {
            "_token": $("meta[name='csrf-token']").attr("content")
        };
        jQuery.ajax({
            url:route,
            type:'get',
            data:data,
            dataType:'json',
            success:function(result)
            {
                updatedReceipt = 0;
                policyVerif = 0;
                serviceFlag = 1;
                idPolicy = 0;
                initialinfo = result;

                $("#pna_edit").val(parseFloat(result.initial.pna).toLocaleString('en-US'));
                calculo();
                $("#selectCurrency_edit").val(result.initial.fk_currency);
                $("#selectInsurance_edit").val(result.initial.fk_insurance);

                actualizarSelect(result.branches,"#selectBranch_edit");
                actualizarSelect(result.plans,"#selectPlan_edit");

                $("#selectBranch_edit").val(result.initial.fk_branch);
                $("#selectPlan_edit").val(result.initial.fk_plan);

                $("#selectAgent_edit").val(result.initial.fk_agent);

                $("#pay_frec_edit").val(result.initial.fk_payment_form);
                $("#selectCharge_edit").val(result.initial.fk_charge);

                $("#myModalEdit").modal("show");
            }
        })
    }
    else
    {
        var route = baseUrlInicial+"/updateStatus";

        var data = {
            'id':id_initial,
            "_token": $("meta[name='csrf-token']").attr("content"),
            'status':status,
            "sub_status":sub_status,
            "commentary":commentary
        };
        jQuery.ajax({
            url:route,
            type:'post',
            data:data,
            dataType:'json',
            success:function(result)
            {
                alertify.success(result.message);
                FillTable(result.initials,result.profile,result.permission);
                $("#myEstatusModal").modal('hide');
            }
        })
    }
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
    var fisica = document.getElementById("fisicaInitial");
    var moral = document.getElementById("moralInitial");
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
function Subestatus()
{
    var id_status= $("#selectStatus").val();
    if(id_status==3)
    {
        document.getElementById("sub_status").hidden=false;
        document.getElementById("sub_status").style.display = "block";

        // alert(id_status);
    }else{
        document.getElementById("sub_status").hidden=true;
        document.getElementById("commentary").disabled=false;

        // alert("todo bien");
    }
}

function mostrartext(){
    var id_subestatus= document.getElementById("selectSubEstatus");
    var valor = id_subestatus.value;
    // alert(valor);

    if(valor == "1")
    {
        $("#commentary").val(valor);
        document.getElementById("commentary").disabled=false;
    }else{
        $("#commentary").val(valor);
        document.getElementById("commentary").disabled=true;

    }
}
function llenarRamos(){
    var insurance = $("#selectInsurance").val();

    var route = baseUrlInicial + '/getBranches/'+ insurance;

    jQuery.ajax({
        url:route,
        type:'get',
        dataType:'json',
        success:function(result)
        {
            actualizarSelect(result.branches,"#selectBranch");
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
    var insurance = $("#selectInsurance").val();
    var branch = $("#selectBranch").val();

    var route = baseUrlInicial + '/getPlans/'+ insurance + '/' + branch;

    jQuery.ajax({
        url:route,
        type:'get',
        dataType:'json',
        success:function(result)
        {
            actualizarSelect(result.branches,"#selectPlan");
        },
        error:function(result,error,errorTrown)
        {
            alertify.error(errorTrown);
        }
    })
}

function llenarRamos1(){
    var insurance = $("#selectInsurance1").val();

    var route = baseUrlInicial + '/getBranches/'+ insurance;

    jQuery.ajax({
        url:route,
        type:'get',
        dataType:'json',
        success:function(result)
        {
            actualizarSelect(result.branches,"#selectBranch1");
            llenarPlanes1();
        },
        error:function(result,error,errorTrown)
        {
            alertify.error(errorTrown);
        }
    })
}

function llenarPlanes1()
{
    var insurance = $("#selectInsurance1").val();
    var branch = $("#selectBranch1").val();

    var route = baseUrlInicial + '/getPlans/'+ insurance + '/' + branch;

    jQuery.ajax({
        url:route,
        type:'get',
        dataType:'json',
        success:function(result)
        {
            actualizarSelect(result.branches,"#selectPlan1");
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
    var route = baseUrlInicial + '/ExportInitials/' + $("#selectStatusExc").val() + '/' + $("#selectBranchExc").val();
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
var policyVerif = 0;

function checkPolicy(){
    var policy = $("#poliza").val();
    var routePoliza = getUrlPolizaView .protocol + "//" + getUrlPolizaView.host + "/policies/policy/CheckPolicy/" + policy;
    var disponible = document.getElementById("disponible");
    var noDisponible = document.getElementById("noDisponible");

    jQuery.ajax({
        url:routePoliza,
        type:'get',
        dataType:'json',
        success:function(result)
        {
            if (result == 0)
            {
                policyVerif = 1;
                checkConditions();
                disponible.style.display = "";
                noDisponible.style.display = "none";
            }
            else
            {
                disponible.style.display = "none";
                noDisponible.style.display = "";
            }
        }
    })
}
var updatedReceipt = 0;
function mostrartablaInitial(){
    updatedReceipt = 1;
    checkConditions();
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
function checkConditions()
{
    if(updatedReceipt == 1 && policyVerif == 1)
        $("#btnSavePolicy").prop("disabled",false);
    else
        $("#btnSavePolicy").prop("disabled",true);
}

function guardarPolizaInicial()
{
    // alert("entre a g");
    policyNumber = $("#poliza").val();
    if(idClient == 0)
    {
        // alert("entre a nuevo cliente");
        newclient = 0;
        if(clientType == 0)
        {
            actualizarCliente(1);
        }
        else
        {
            actualizarEmpresa(1);
        }
    }
    else
    {
        // alert("entre a cliente registrado");
        newclient = 1;
        guardarPoliza(id_initial);
    }
    // window.location.reload(true);
}
function noRegistrado()
{
    idClient = 0;
    var fisica = document.getElementById("fisica");
    var moral = document.getElementById("moral");

    clientType = initialinfo.initial.type;
    if(initialinfo.initial.type==0)
    {
        fisica.style.display="";
        $("#name1").val(initialinfo.initial.name);
        $("#firstname1").val(initialinfo.initial.firstname);
        $("#lastname1").val(initialinfo.initial.lastname);
        $("#rfc1").val(initialinfo.initial.rfc);

        $("#birth_date1").val("");
        $("#curp1").val("");
        $("#gender1").val(0);
        $("#marital_status1").val(0);
        $("#street1").val("");
        $("#e_num1").val("");
        $("#i_num1").val("");
        $("#pc1").val("");
        $("#suburb1").val("");
        $("#country1").val("");
        $("#state1").val("");
        $("#city1").val("");
        $("#cellphone1").val("");
        $("#email1").val("");
    }
    else{

        moral.style.display="";
        $("#business_name1").val(initialinfo.initial.name)
        $("#business_rfc1").val(initialinfo.initial.rfc);

        $("#date1").val("");
        $("#estreet1").val("");
        $("#ee_num1").val("");
        $("#ei_num1").val("");
        $("#epc1").val("");
        $("#esuburb1").val("");
        $("#ecountry1").val("");
        $("#estate1").val("");
        $("#ecity1").val("");
        $("#ecellphone1").val("");
        $("#eemail1").val("");
        $("#name_contact1").val("");
        $("#phone_contact1").val("");
    }
    $("#client_edit").val("");
    $("#modalSrcClient").modal("hide");
}

function FillTable(data,profile,permission)
{
    var table = $('#tbProf').DataTable();
    var btnStat = '';
    var btnEdit = '';
    var btnTrash = '';
    table.clear();

    data.forEach( function(valor, indice, array) {
        btnStat = '<button class="btn btn-info" style="background-color: #'+valor.color+'; border-color: #'+valor.color+'" onclick="opcionesEstatus('+valor.id+','+valor.statId+')">'+valor.name+'</button>';
        btnEdit = '<button href="#|" class="btn btn-warning" onclick="editarInicial('+valor.id+')" ><i class="fa fa-edit"></i></button>';
        btnTrash = '<button href="#|" class="btn btn-danger" onclick="eliminarInicial('+valor.id+')"><i class="fa fa-trash"></i></button>';
        if(permission["erase"] == 1)
            table.row.add([valor.agent,valor.cname,valor.rfc,valor.folio,valor.insurance,valor.branch,btnStat,btnEdit+" "+btnTrash]).node().id = valor.id;
        else
            table.row.add([valor.agent,valor.cname,valor.rfc,valor.folio,valor.insurance,valor.branch,btnStat,btnEdit]).node().id = valor.oid;
    });
    table.draw(false);
}
