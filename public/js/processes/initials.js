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
    var pna = $("#pna").val();
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
                $("#name1").val(result.data.name);
                $("#firstname1").val(result.data.firstname);
                $("#lastname1").val(result.data.lastname);
                $("#rfc1").val(result.data.rfc);
            }else{

                moral.style.display="";
                $("#business_name1").val(result.data.name)
                $("#business_rfc1").val(result.data.rfc);

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
            $("#pna1").val(result.data.pna);
            $("#selectPaymentform1").val(result.data.fk_payment_form);
            $("#selectCurrency1").val(result.data.fk_currency);
            $("#selectCharge1").val(result.data.fk_charge);
            $("#guide1").val(result.data.guide);
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
        // alert('entre');
        var name = $("#name1").val();
        var firstname = $("#firstname1").val();
        var lastname = $("#lastname1").val();
        var rfc = $("#rfc1").val();

    }else{
        // alert('entre');
        var name = $("#business_name1").val();
        var rfc = $("#business_rfc1").val();
        console.log(name,rfc);
    }
    var promoter = $("#promoter1").val();
    var system = $("#system1").val();
    var folio = $("#folio1").val();
    var insurance = $("#selectInsurance1").val();
    var branch = $("#selectBranch1").val();
    var plan = $("#selectPlan1").val();
    var application = $("#selectAppli1").val();
    var pna = $("#pna1").val();
    var paymentForm = $("#selectPaymentform1").val();
    var currency = $("#selectCurrency1").val();
    var charge = $("#selectCharge1").val();
    var guide = $("#guide1").val();

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
        'plan':plan,
        'application':application,
        'pna':pna,
        'paymentForm':paymentForm,
        'currency':currency,
        'charge':charge,
        'guide':guide,
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
function actualizarEstatus()
{
    var status = $("#selectStatus").val();
    var sub_status = $("#selectSubEstatus").val();
    var commentary = $("#commentary").val();
    var route = baseUrlInicial+"/updateStatus";
    console.log(route);
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
