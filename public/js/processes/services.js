var ruta = window.location;
var getUrl = window.location;
var baseUrlService = getUrl .protocol + "//" + getUrl.host + getUrl.pathname;

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

// $(document).ready(function() {
//     // Setup - add a text input to each footer cell
//     $('#example tfoot th').each( function () {
//         var title = $(this).text();
//         $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
//     } );

//     // DataTable
//     var table = $('#example').DataTable({
//         initComplete: function () {
//             // Apply the search
//             this.api().columns().every( function () {
//                 var that = this;

//                 $( 'input', this.footer() ).on( 'keyup change clear', function () {
//                     if ( that.search() !== this.value ) {
//                         that
//                             .search( this.value )
//                             .draw();
//                     }
//                 } );
//             } );
//         }
//     });

// } );



function guardarServicio()
{
    var agent = $("#selectAgent").val();
    var entry_date = $("#entry_date").val();
    var policy = $("#policy").val();
    var response_date = $("#response_date").val();
    var download = $("#selectDownload").val();
    var type = $("#type").val();
    var folio = $("#folio").val();
    var name = $("#name").val();
    var record = $("#selectRecord").val();
    var insurance = $("#selectInsurance").val();
    var branch = $("#selectBranch").val();
    var route = "service";
    var data = {
        "_token": $("meta[name='csrf-token']").attr("content"),
        'agent':agent,
        'entry_date':entry_date,
        'policy':policy,
        'response_date':response_date,
        'download':download,
        'type':type,
        'folio':folio,
        'name':name,
        'record':record,
        'insurance':insurance,
        'branch':branch
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
function editarServicio(id)
{
    idupdate=id;

    var route = baseUrlService + '/GetInfo/'+ id;

    jQuery.ajax({
        url:route,
        type:'get',
        dataType:'json',
        success:function(result)
        {
           $("#selectAgent1").val(result.data.fk_agent);
           $("#entry_date1").val(result.data.entry_date);
           $("#policy1").val(result.data.policy);
           $("#response_date1").val(result.data.response_date);
           $("#selectDownload1").val(result.data.download);
           $("#type1").val(result.data.type);
           $("#folio1").val(result.data.folio);
           $("#name2").val(result.data.name);
           $("#selectRecord1").val(result.data.record);
           $("#selectInsurance1").val(result.data.fk_insurance);
           $("#selectBranch1").val(result.data.fk_branch);
           $("#myModaledit").modal('show');
        }
    })
}
function cancelarEditar()
{
    $("#myModaledit").modal('hide');
}
function actualizarServicio()
{
    var agent = $("#selectAgent1").val();
    var entry_date = $("#entry_date1").val();
    var policy = $("#policy1").val();
    var response_date = $("#response_date1").val();
    var download = $("#selectDownload1").val();
    var type = $("#type1").val();
    var folio = $("#folio1").val();
    var name = $("#name2").val();
    var record = $("#selectRecord1").val();
    var insurance = $("#selectInsurance1").val();
    var branch = $("#selectBranch1").val();
    var route = "service/"+idupdate;
    var data = {
        'id':idupdate,
        "_token": $("meta[name='csrf-token']").attr("content"),
        'agent':agent,
        'entry_date':entry_date,
        'policy':policy,
        'response_date':response_date,
        'download':download,
        'type':type,
        'folio':folio,
        'name':name,
        'record':record,
        'insurance':insurance,
        'branch':branch
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

function eliminarServicio(id)
{
    var route = "service/"+id;
    var data = {
            'id':id,
            "_token": $("meta[name='csrf-token']").attr("content"),
    };
    alertify.confirm("Eliminar Servicio","¿Desea borrar el Servicio?",
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
var id_service = 0;

function opcionesEstatus(serviceId,statusId)
{
    id_service=serviceId;
    var route = baseUrlService+'/GetinfoStatus/'+id_service;
    jQuery.ajax({
        url:route,
        type:'get',
        dataType:'json',
        success:function(result){
            $("#selectStatus").val(statusId);
            $("#commentary").val(result.data.commentary);
            $("#myEstatusModal").modal('show');
        }
    })
}

function actualizarEstatus()
{
    // alert("entre a services");
    var status = $("#selectStatus").val();
    var commentary = $("#commentary").val();

    if(status == 8)
    {
        var route = baseUrlService + "/GetPolicyInfo/" + id_service;
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
                serviceFlag = 1;
                if(result.data == null)
                {
                    idPolicy = 0;
                    policyNumber = result.service.policy;
                }
                else
                {
                    idPolicy = result.data.id;

                    // alert(result.data.fk_client);
                    clientType = result.client.status;
                    idClient = result.data.fk_client;
                    if(clientType == 0)
                    {
                        idupdate=result.data.fk_client;
                        fisica.style.display = ""
                        moral.style.display = "none"
                        editarCliente(result.data.fk_client);
                    }
                    else
                    {
                        idupdateE=result.data.fk_client;
                        fisica.style.display = "none"
                        moral.style.display = ""
                        editarEmpresa(result.data.fk_client);
                    }
                    $("#client_edit").val(result.client.name);

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

                    $("#myModalEdit").modal("show");
                    mostrartabla();
                }
                $("#myModalEdit").modal("show");
            }
        })
    }
    else
    {
        var route = baseUrlService+"/updateStatus";
        var data = {
            'id':id_service,
            "_token": $("meta[name='csrf-token']").attr("content"),
            'status':status,
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
                window.location.reload(true);
            }
        })
    }
}
function cerrarmodal()
{
    $("#myEstatusModal").modal('hide');
    $("#comentary").val("");

}

function llenarRamosService(){
    var insurance = $("#selectInsurance").val();

    var route = baseUrlService + '/getBranches/'+ insurance;

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

