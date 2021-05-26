var ruta = window.location;
var getUrl = window.location;
var baseUrl = getUrl .protocol + "//" + getUrl.host + getUrl.pathname;

function guardarInicial()
{
    var agent = $("#selectAgent").val();
    var client = $("#client").val();
    var rfc = $("#rfc").val();
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
        'client':client,
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
function editarInicial(id)
{
    idupdate=id;

    var route = baseUrl + '/GetInfo/'+ id;

    jQuery.ajax({
        url:route,
        type:'get',
        dataType:'json',
        success:function(result)
        {
           $("#selectAgent1").val(result.data.fk_agent);
           $("#client1").val(result.data.client);
           $("#rfc1").val(result.data.rfc);
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
    $("#myModaledit").modal('hide');
}
function actualizarInicial()
{
    var agent = $("#selectAgent1").val();
    var client = $("#client1").val();
    var rfc = $("#rfc1").val();
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
        'client':client,
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
