var ruta = window.location;
var getUrl = window.location;
var baseUrl = getUrl .protocol + "//" + getUrl.host + getUrl.pathname;

$(document).ready( function () {
    $('#tbProf thead th').each( function () {
        var title = $(this).text();
        $(this).html( '<input type="text" class="form-control" placeholder="'+title+'" />' );
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

function guardarSiniestro()
{
    var agent = $("#selectAgent").val();
    var folio = $("#folio").val();
    var contractor = $("#contractor").val();
    var insurance = $("#selectInsurance").val();
    var branch = $("#selectBranch").val();
    var entry_date = $("#entry_date").val();
    var policy = $("#policy").val();
    var insured = $("#insured").val();
    var sinister = $("#sinister").val();
    var amount = $("#amount").val();
    var guide = $("#guide").val();
    var payment_form = $("#selectPayment").val();
    var type = $("#selectType").val();
    var route = "refunds";
    var data = {
        "_token": $("meta[name='csrf-token']").attr("content"),
        'agent':agent,
        'folio':folio,
        'contractor':contractor,
        'fk_insurance':insurance,
        'fk_branch':branch,
        'entry_date':entry_date,
        'policy':policy,
        'insured':insured,
        'sinister':sinister,
        'amount':amount,
        'guide':guide,
        'payment_form':payment_form,
        'type':type,
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
            FillTable(result.refunds,result.profile,result.permission);
            // window.location.reload(true);
        }
    })
}
var idupdate = 0;
function editarSiniestro(id)
{
    idupdate=id;

    var refund = document.getElementById("refundDiv1");
    var pay = document.getElementById("payDiv1");
    var route = baseUrl + '/GetInfo/'+ id;

    jQuery.ajax({
        url:route,
        type:'get',
        dataType:'json',
        success:function(result)
        {
            $("#selectAgent1").val(result.data.fk_agent);
            $("#folio1").val(result.data.folio);
            $("#contractor1").val(result.data.contractor);
            actualizarSelect(result.branches,"#selectBranch1");
            $("#selectInsurance1").val(result.data.fk_insurance);
            $("#selectBranch1").val(result.data.fk_branch);
            $("#entry_date1").val(result.data.entry_date);
            $("#policy1").val(result.data.policy);
            $("#insured1").val(result.data.insured);
            $("#sinister1").val(result.data.sinister);
            $("#amount1").val(result.data.amount);
            $("#guide1").val(result.data.guide);
            $("#selectPayment1").val(result.data.payment_form);
            $("#selectType1").val(result.data.type);

            if(result.data.type == 0 || result.data.type == 2)
            {
                refund.style.display = "none";
                pay.style.display = "none";
            }
            else
            {
                refund.style.display = "";
                pay.style.display = "";
            }
            $("#myModaledit").modal('show');
        }
    })
}
function cancelarEditar()
{
    $("#myModaledit").modal('hide');
}
function actualizarSiniestro()
{
    var agent = $("#selectAgent1").val();
    var folio = $("#folio1").val();
    var contractor = $("#contractor1").val();
    var insurance = $("#selectInsurance1").val();
    var branch = $("#selectBranch1").val();
    var entry_date = $("#entry_date1").val();
    var policy = $("#policy1").val();
    var insured = $("#insured1").val();
    var sinister = $("#sinister1").val();
    var amount = $("#amount1").val();
    var guide = $("#guide1").val();
    var payment_form = $("#selectPayment1").val();
    var type = $("#selectType1").val();
    var route = "refunds/"+idupdate;
    var data = {
        'id':idupdate,
        "_token": $("meta[name='csrf-token']").attr("content"),
        'agent':agent,
        'folio':folio,
        'contractor':contractor,
        'fk_insurance':insurance,
        'fk_branch':branch,
        'entry_date':entry_date,
        'policy':policy,
        'insured':insured,
        'sinister':sinister,
        'amount':amount,
        'guide':guide,
        'payment_form':payment_form,
        'type':type
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
            FillTable(result.refunds,result.profile,result.permission);
            // window.location.reload(true);
        }
    })
}

function eliminarSiniestro(id)
{
    var route = "refunds/"+id;
    var data = {
            'id':id,
            "_token": $("meta[name='csrf-token']").attr("content"),
    };
    alertify.confirm("Eliminar Siniestro","¿Desea borrar el Siniestro?",
        function(){
            jQuery.ajax({
                url:route,
                data: data,
                type:'delete',
                dataType:'json',
                success:function(result)
                {
                    FillTable(result.refunds,result.profile,result.permission);
                    // window.location.reload(true);
                }
            })
            alertify.success('Eliminado');
        },
        function(){
            alertify.error('Cancelado');
    });

}
var id_service = 0;

function opcionesEstatus(serviceId,statusId)
{
    id_service=serviceId;
    var route = baseUrl+'/GetinfoStatus/'+id_service;
    jQuery.ajax({
        url:route,
        type:'get',
        dataType:'json',
        success:function(result){
            $("#selectStatus").val(statusId);
            $("#stat_date").val(result.data.attend_date);
            $("#commentary").val(result.data.commentary);
            $("#myEstatusModal").modal('show');
        }
    })

}

function actualizarEstatus()
{
    var status = $("#selectStatus").val();
    var attend_date = $("#stat_date").val();
    var commentary = $("#commentary").val();
    var route = baseUrl+"/updateStatus";
    console.log(route);
    var data = {
        'id':id_service,
        "_token": $("meta[name='csrf-token']").attr("content"),
        'status':status,
        "attend_date":attend_date,
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
            FillTable(result.refunds,result.profile,result.permission);
            // window.location.reload(true);
        }
    })
}
function cerrarmodal()
{
    $("#myEstatusModal").modal('hide');
    $("#comentary").val("");

}
function abrirFiltro()
{
    $("#myModalExport").modal('show');
}

function cerrar(modal)
{
    $(modal).modal('hide');
}

function llenarRamos(){
    var insurance = $("#selectInsurance").val();

    var route = baseUrl + '/getBranches/'+ insurance;

    jQuery.ajax({
        url:route,
        type:'get',
        dataType:'json',
        success:function(result)
        {
            actualizarSelect(result.branches,"#selectBranch");
        },
        error:function(result,error,errorTrown)
        {
            alertify.error(errorTrown);
        }
    })
}

function llenarRamos1(){
    var insurance = $("#selectInsurance1").val();

    var route = baseUrl + '/getBranches/'+ insurance;

    jQuery.ajax({
        url:route,
        type:'get',
        dataType:'json',
        success:function(result)
        {
            actualizarSelect(result.branches,"#selectBranch1");
        },
        error:function(result,error,errorTrown)
        {
            alertify.error(errorTrown);
        }
    })
}

function excel_nuc(){
    var route = baseUrl + '/ExportRefunds/' + $("#selectStatusExc").val() + '/' + $("#selectBranchExc").val();
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

function changeType(div)
{
    var refund = document.getElementById("refundDiv"+div);
    var pay = document.getElementById("payDiv"+div);
    var selectType = $("#selectType"+div).val();

    if(selectType == 0 || selectType == 2)
    {
        refund.style.display = "none";
        pay.style.display = "none";
    }
    else
    {
        refund.style.display = "";
        pay.style.display = "";
    }
}
function abrirNuevo()
{
    var refund = document.getElementById("refundDiv");
    var pay = document.getElementById("payDiv");
    $("#selectType").val(0);
    refund.style.display = "none";
    pay.style.display = "none";
    $("#myModal").modal('show');
}
function FillTable(data,profile,permission)
{
    var table = $('#tbProf').DataTable();
    var btnStat = '';
    var btnEdit = '';
    var btnTrash = '';
    table.clear();

    data.forEach( function(valor, indice, array) {

        btnStat = '<button class="btn btn-info" style="background-color: #'+valor.color+'; border-color: #'+valor.color+'" onclick="opcionesEstatus('+valor.id+','+valor.statId+')">'+valor.statName+'</button>';
        btnEdit = '<button href="#|" class="btn btn-warning" onclick="editarSiniestro('+valor.id+')" ><i class="fa fa-edit"></i></button>';
        btnTrash = '<button href="#|" class="btn btn-danger" onclick="eliminarSiniestro('+valor.id+')"><i class="fa fa-trash"></i></button>';
        if(permission["erase"] == 1)
            table.row.add([valor.agent,valor.contractor,valor.folio,valor.insurance,btnStat,btnEdit+" "+btnTrash]).node().id = valor.id;
        else
            table.row.add([valor.agent,valor.contractor,valor.folio,valor.insurance,btnStat,btnEdit]).node().id = valor.id;
    });
    table.draw(false);
}
