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
        },
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'colvisGroup',
                text: 'Datos de Origen',
                show: [3, 4, 5, 6],
                hide: [7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35]
            },
            {
                extend: 'colvisGroup',
                text: 'Datos del Solicitante',
                show: [7, 8, 9, 10, 11, 12, 13, 14],
                hide: [3, 4, 5, 6, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35]
            },
            {
                extend: 'colvisGroup',
                text: 'Primer Proceso',
                show: [15, 16, 17, 18, 19],
                hide: [3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35]
            },
            {
                extend: 'colvisGroup',
                text: 'Segundo Proceso',
                show: [20, 21, 22, 23, 24, 25, 26, 27],
                hide: [3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 28, 29, 30, 31, 32, 33, 34, 35]
            },
            {
                extend: 'colvisGroup',
                text: 'Cédula',
                show: [28, 29, 30, 31, 32],
                hide: [3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 33, 34, 35]
            },
            {
                extend: 'colvisGroup',
                text: 'Proceso Final',
                show: [33, 34, 35],
                hide: [3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32]
            },
            {
                extend: 'colvisGroup',
                text: 'Mostrar Todas',
                show: ':hidden'
            },
            {
                extend: 'colvisGroup',
                text: 'Ocultar Todas',
                show: [0, 1, 2],
                hide: [3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35]
            }
        ],
        columnDefs: [
            {
                target: [3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35],
                visible: false
            }
        ],
        fixedColumns: {
            start: 1
        },
        paging: false,
        scrollCollapse: true,
        scrollX: true,
        scrollY: 500
    });
} );

var editId = 0;
var editBtns = 0;
var editField = 0;

document.addEventListener("DOMContentLoaded", function () {
    var route = baseUrl + '/GetTable/1';
    console.log(route);
    jQuery.ajax({
        url:route,
        type:'get',
        dataType:'json',
        success:function(result)
        {
            RefreshTable(result.data,0,0);
        },
        error:function(result,error,errorTrown)
        {
            alertify.error(errorTrown);
        }
    })
});

function RefreshTable(data,profile,permission)
{
    var sino = ["No","Si"]
    var exm = ["Incompleto","Aprobado"]

    var table = $('#tbProf').DataTable();
    var btnStat = '';
    var btnActiveStat = '';
    var viewCV = '';

    var btnFstInt = '';
    var btnPda = '';
    var btnScndInt = '';
    var btnCharge = '';
    var btnConfirmed = '';

    var btnDocs = '';
    var btnInduction = '';
    var btnDatesSales = '';
    var btnSales = '';
    var btnSigCia = '';
    var btnCia= '';
    var btnInitialKey = '';
    var btnInitialDate = '';

    var btnLicenseDate = '';
    var btnExamDate = '';
    var btnExam = '';
    var btnCnsfDate = '';
    var btnLicense = '';

    var btnAgKey = '';
    var btnMetSig = '';
    var btnMetGrad = '';

    var btnEdit = '';
    var btns;
    var dates;

    table.clear();

    data.forEach( function(valor, indice, array) {
        btns = valor.btn_colors.split('-');
        dates = valor.application_date.split('-');
        btnStat = '<button class="btn btn-info" style="background-color: #'+valor.color+'; border-color: #'+valor.color+'" onclick="opcionesEstatus('+valor.candId+','+valor.id+')">'+valor.name+'</button>';

        if(valor.active_stat == 1) btnActiveStat = '<button href="#|" class="btn btn-success" onclick="openActiveStat('+valor.candId+','+valor.active_stat+')" >Nuevo</button>';
        else if(valor.active_stat == 2) btnActiveStat = '<button href="#|" class="btn btn-danger" onclick="openActiveStat('+valor.candId+','+valor.active_stat+')" >Desertor</button>';
        else btnActiveStat = '<button href="#|" class="btn btn-warning" onclick="openActiveStat('+valor.candId+','+valor.active_stat+')" >En crecimiento</button>';

        viewCV = '<a href="'+getUrl.protocol+'//' + getUrl.host + '/files/cv/' + valor.cv + '" id="viewPDF" target="_blank">Ver CV</a>';

        btnFstInt = '<button href="#|" class="btn btn-' + btns[0] + '" onclick="openDate(`'+valor.date_fst_int+'`,'+valor.candId+',0,`date_fst_int`)" >'+valor.date_fst_int+'</button>';
        btnPda = '<button href="#|" class="btn btn-' + btns[1] + '" onclick="openYesNo('+valor.pda+','+valor.candId+',1,`pda`)" >'+sino[valor.pda]+'</button>';
        btnScndInt = '<button href="#|" class="btn btn-' + btns[2] + '" onclick="openDate(`'+valor.date_sec_int+'`,'+valor.candId+',2,`date_sec_int`)" >'+valor.date_sec_int+'</button>';
        btnCharge = '<button href="#|" class="btn btn-primary" onclick="openCharge(`'+valor.charge+'`,'+valor.candId+',`n`,`charge`)" >'+valor.charge+'</button>';
        btnConfirmed = '<button href="#|" class="btn btn-' + btns[3] + '" onclick="openYesNo('+valor.confirmed+','+valor.candId+',3,`confirmed`)" >'+sino[valor.confirmed]+'</button>';

        btnDocs = '<button href="#|" class="btn btn-' + btns[4] + '" onclick="openDocs('+valor.documents+','+valor.candId+',4,`documents`)" >'+sino[valor.documents]+'</button>';
        btnInduction = '<button href="#|" class="btn btn-' + btns[5] + '" onclick="openDate(`'+valor.induction+'`,'+valor.candId+',5,`induction`)" >'+valor.induction+'</button>';
        btnDatesSales = '<button href="#|" class="btn btn-' + btns[6] + '" onclick="openYesNo(`'+valor.sales_dates+'`,'+valor.candId+',6,`sales_dates`)" >'+sino[valor.sales_dates]+'</button>';

        sales = valor.sales.split('-');
        sale = parseInt(sales[0]) + parseInt(sales[1]) + parseInt(sales[2]) + parseInt(sales[3]);
        btnSales = '<button href="#|" class="btn btn-' + btns[7] + '" onclick="openSales(`'+valor.sales+'`,'+valor.candId+',7,`sales`)" >'+sale+'</button>';

        btnSigCia = '<button href="#|" class="btn btn-' + btns[8] + '" onclick="openYesNo('+valor.signed_cia+','+valor.candId+',8,`signed_cia`)" >'+sino[valor.signed_cia]+'</button>';
        btnCia = '<button href="#|" class="btn btn-' + btns[9] + '" onclick="openDate(`'+valor.cia+'`,'+valor.candId+',9,`cia`)" >'+valor.cia+'</button>';
        btnInitialKey = '<button href="#|" class="btn btn-primary" onclick="openText(`'+valor.initial_key+'`,'+valor.candId+',`n`,`initial_key`)" >'+valor.initial_key+'</button>';
        btnInitialDate = '<button href="#|" class="btn btn-' + btns[10] + '" onclick="openDate(`'+valor.initial_date+'`,'+valor.candId+',10,`initial_date`)" >'+valor.initial_date+'</button>';

        btnLicenseDate = '<button href="#|" class="btn btn-' + btns[11] + '" onclick="openDate(`'+valor.license_date+'`,'+valor.candId+',11,`license_date`)" >'+valor.license_date+'</button>';
        btnExamDate = '<button href="#|" class="btn btn-' + btns[12] + '" onclick="openDate(`'+valor.exam_date+'`,'+valor.candId+',12,`exam_date`)" >'+valor.exam_date+'</button>';
        btnExam = '<button href="#|" class="btn btn-' + btns[13] + '" onclick="openExam(`'+valor.exam+'`,'+valor.candId+',13,`exam`)" >'+exm[valor.exam]+'</button>';
        btnCnsfDate = '<button href="#|" class="btn btn-' + btns[14] + '" onclick="openYesNo(`'+valor.cnsf_date+'`,'+valor.candId+',14,`cnsf_date`)" >'+sino[valor.cnsf_date]+'</button>';
        btnLicense = '<button href="#|" class="btn btn-' + btns[15] + '" onclick="openDate(`'+valor.license+'`,'+valor.candId+',15,`license`)" >'+valor.license+'</button>';

        btnAgKey = '<button href="#|" class="btn btn-primary" onclick="openText(`'+valor.agent_key+'`,'+valor.candId+',`n`,`agent_key`)" >'+valor.agent_key+'</button>';
        btnMetSig = '<button href="#|" class="btn btn-' + btns[16] + '" onclick="openDate(`'+valor.metlife_sign+'`,'+valor.candId+',16,`metlife_sign`)" >'+valor.metlife_sign+'</button>';
        btnMetGrad = '<button href="#|" class="btn btn-' + btns[17] + '" onclick="openYesNo('+valor.met_graduate+','+valor.candId+',17,`met_graduate`)" >'+sino[valor.met_graduate]+'</button>';

        btnEdit = '<button href="#|" class="btn btn-warning" onclick="openEdit('+valor.candId+')" ><i class="fas fa-eye"></i></button>';

        table.row.add([valor.candName,btnStat,btnActiveStat,
            dates[0],dates[1],valor.origin,valor.ddn,
            valor.cellphone,valor.rfc,valor.mail,valor.sex,valor.age,valor.city,valor.scholarity,viewCV,
            btnFstInt,btnPda,btnScndInt,btnCharge,btnConfirmed,
            btnDocs,btnInduction,btnDatesSales,btnSales,btnSigCia,btnCia,btnInitialKey,btnInitialDate,
            btnLicenseDate,btnExamDate,btnExam,btnCnsfDate,btnLicense,
            btnAgKey,btnMetSig,btnMetGrad]);
    });
    table.draw(false);
}

function cancelar(modal)
{
    $(modal).modal('hide');
}

function openYesNo(valor,id,btns,field)
{
    editId = id;
    editField = field;
    editBtns = btns;

    $("#selectYesNo").val(valor);

    $("#yesnoModal").modal('show');
}

function openExam(valor,id,btns,field)
{
    editId = id;
    editField = field;
    editBtns = btns;

    $("#selectExam").val(valor);

    $("#examModal").modal('show');
}

function openDocs(valor,id,btns,field)
{
    editId = id;
    editField = field;
    editBtns = btns;

    $("#selectYesNoDocs").val(valor);

    var route = baseUrl + '/GetDocs/'+id;
    jQuery.ajax({
        url:route,
        type:'get',
        dataType:'json',
        success:function(result)
        {
            document.getElementById("doc_curp").checked = result.docs.doc_curp;
            document.getElementById("doc_fiscadd").checked = result.docs.doc_fiscadd;
            document.getElementById("doc_add").checked = result.docs.doc_add;
            document.getElementById("doc_bank").checked = result.docs.doc_bank;
            document.getElementById("doc_birth").checked = result.docs.doc_birth;
            document.getElementById("doc_sat").checked = result.docs.doc_sat;
            document.getElementById("doc_school").checked = result.docs.doc_school;
            document.getElementById("doc_ine").checked = result.docs.doc_ine;
            // $("#doc_curp").val(result.docs.doc_curp);
            // $("#doc_fiscadd").val(result.docs.doc_fiscadd);
            // $("#doc_add").val(result.docs.doc_add);
            // $("#doc_bank").val(result.docs.doc_bank);
            // $("#doc_birth").val(result.docs.doc_birth);
            // $("#doc_sat").val(result.docs.doc_sat);
            // $("#doc_school").val(result.docs.doc_school);
            // $("#doc_ine").val(result.docs.doc_ine);
            $("#docsModal").modal('show');
        },
        error:function(result,error,errorTrown)
        {
            alertify.error(errorTrown);
        }
    })

}

function openDate(valor,id,btns,field)
{
    editId = id;
    editField = field;
    editBtns = btns;

    $("#datepick").val(valor);

    $("#dateModal").modal('show');
}

function openCharge(valor,id,btns,field)
{
    editId = id;
    editField = field;
    editBtns = btns;

    $("#selectCharge").val(valor);

    $("#chargeModal").modal('show');
}

function openText(valor,id,btns,field)
{
    editId = id;
    editField = field;
    editBtns = btns;

    $("#keytext").val(valor);

    $("#textModal").modal('show');
}

function openSales(valor,id,btns,field)
{
    editId = id;
    editField = field;
    editBtns = btns;

    sales = valor.split('-');

    $("#gmm").val(sales[0]);
    $("#vida").val(sales[1]);
    $("#autos").val(sales[2]);
    $("#viaje").val(sales[3]);

    $("#salesModal").modal('show');
}

function guardarVentas()
{
    var route = baseUrl + '/SaveSales';
    var data = {
        "_token": $("meta[name='csrf-token']").attr("content"),
        'sales':$("#gmm").val() + '-' + $("#vida").val() + '-' + $("#autos").val() + '-' + $("#viaje").val(),
        'field':editField,
        'btns':editBtns,
        'id':editId,
        'total':parseInt($("#gmm").val()) + parseInt($("#vida").val()) + parseInt($("#autos").val()) + parseInt($("#viaje").val())
    };
    jQuery.ajax({
        url:route,
        type:"post",
        data: data,
        dataType: 'json',
        success:function(result)
        {
            alertify.success(result.message);
            $("#salesModal").modal('hide');
            RefreshTable(result.data,0,0);
        },
        error:function(result,error,errorTrown)
        {
            alertify.error(errorTrown);
        }
    })
}

function guardar(saveRoute,saveInput,modal)
{
    var route = baseUrl + '/' + saveRoute;
    var data = {
        "_token": $("meta[name='csrf-token']").attr("content"),
        'input':$(saveInput).val(),
        'field':editField,
        'btns':editBtns,
        'id':editId,
    };
    jQuery.ajax({
        url:route,
        type:"post",
        data: data,
        dataType: 'json',
        success:function(result)
        {
            alertify.success(result.message);
            $(modal).modal('hide');
            RefreshTable(result.data,0,0);
        },
        error:function(result,error,errorTrown)
        {
            alertify.error(errorTrown);
        }
    })
}

function guardarDocs()
{
    var route = baseUrl + '/SaveDocs';
    var doc_curp = document.getElementById("doc_curp").checked;
    var doc_fiscadd = document.getElementById("doc_fiscadd").checked;
    var doc_add = document.getElementById("doc_add").checked;
    var doc_bank = document.getElementById("doc_bank").checked;
    var doc_birth = document.getElementById("doc_birth").checked;
    var doc_sat = document.getElementById("doc_sat").checked;
    var doc_school = document.getElementById("doc_school").checked;
    var doc_ine = document.getElementById("doc_ine").checked;
    // var doc_curp = $("#doc_curp").val();
    // var doc_fiscadd = $("#doc_fiscadd").val();
    // var doc_add = $("#doc_add").val();
    // var doc_bank = $("#doc_bank").val();
    // var doc_birth = $("#doc_birth").val();
    // var doc_sat = $("#doc_sat").val();
    // var doc_school = $("#doc_school").val();
    // var doc_ine = $("#doc_ine").val();
    // alert(doc_curp);
    var data = {
        "_token": $("meta[name='csrf-token']").attr("content"),
        'input':$("#selectYesNoDocs").val(),
        'field':editField,
        'btns':editBtns,
        'doc_curp':doc_curp,
        'doc_fiscadd':doc_fiscadd,
        'doc_add':doc_add,
        'doc_bank':doc_bank,
        'doc_birth':doc_birth,
        'doc_sat':doc_sat,
        'doc_school':doc_school,
        'doc_ine':doc_ine,
        'id':editId,
    };
    jQuery.ajax({
        url:route,
        type:"post",
        data: data,
        dataType: 'json',
        success:function(result)
        {
            alertify.success(result.message);
            $("#docsModal").modal('hide');
            RefreshTable(result.data,0,0);
        },
        error:function(result,error,errorTrown)
        {
            alertify.error(errorTrown);
        }
    })
}

function quitarFecha()
{
    $("#datepick").val(null)
}

function opcionesEstatus(id,statusId)
{
    idcandidate=id;
    $("#selectStatus").val(statusId);
    $("#secEstatusModal").modal('show');
}

function openActiveStat(id,statusId)
{
    idcandidate=id;
    $("#selectStatusAct").val(statusId);
    $("#actEstatusModal").modal('show');
}

function actualizarEstatusAct()
{
    var status = $("#selectStatusAct").val();
    var route = baseUrl + "/updateStatusAct";

        var data = {
            'id':idcandidate,
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
                RefreshTable(result.candidates,result.profile,result.permission);
                $("#actEstatusModal").modal('hide');
                // window.location.reload(true);
            },
            error:function(result,error,errorTrown)
            {
                alertify.error(errorTrown);
            }
        })
}

function actualizarEstatus()
{
    // alert("entre a viewpolicy");
    // if (document.getElementById('chkActive').checked) active = 0; else active = 1;
    var status = $("#selectStatus").val();
    var route = baseUrl + "/updateStatus";

    var data = {
        'id':idcandidate,
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
            RefreshTable(result.candidates,result.profile,result.permission);
            $("#secEstatusModal").modal('hide');
            // window.location.reload(true);
        },
        error:function(result,error,errorTrown)
        {
            alertify.error(errorTrown);
        }
    })
}
