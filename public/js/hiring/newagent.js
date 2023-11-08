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
        ]
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

        if(valor.active_stat == 1) btnActiveStat = '<button href="#|" class="btn btn-success" onclick="openActiveStat('+valor.active_stat+','+valor.candId+')" >Nuevo</button>';
        else if(valor.active_stat == 2) btnActiveStat = '<button href="#|" class="btn btn-danger" onclick="openActiveStat('+valor.active_stat+','+valor.candId+')" >Desertor</button>';
        else btnActiveStat = '<button href="#|" class="btn btn-warning" onclick="openActiveStat('+valor.active_stat+','+valor.candId+')" >En crecimiento</button>';

        viewCV = '<a href="'+getUrl.protocol+'//' + getUrl.host + '/files/cv/' + valor.cv + '" id="viewPDF" target="_blank">Ver CV</a>';

        btnFstInt = '<button href="#|" class="btn btn-' + btns[0] + '" onclick="openDate(`'+valor.date_fst_int+'`,'+valor.candId+',0,0)" >'+valor.date_fst_int+'</button>';
        btnPda = '<button href="#|" class="btn btn-' + btns[1] + '" onclick="openYesNo('+valor.pda+','+valor.candId+',1,1)" >'+sino[valor.pda]+'</button>';
        btnScndInt = '<button href="#|" class="btn btn-' + btns[2] + '" onclick="openDate(`'+valor.date_sec_int+'`,'+valor.candId+',2,2)" >'+valor.date_sec_int+'</button>';
        btnCharge = '<button href="#|" class="btn btn-primary" onclick="openCharge(`'+valor.charge+'`,'+valor.candId+',3,`n`)" >'+valor.charge+'</button>';
        btnConfirmed = '<button href="#|" class="btn btn-' + btns[3] + '" onclick="openYesNo('+valor.confirmed+','+valor.candId+',4,3)" >'+sino[valor.confirmed]+'</button>';

        btnDocs = '<button href="#|" class="btn btn-' + btns[4] + '" onclick="openYesNo('+valor.documents+','+valor.candId+',5,4)" >'+sino[valor.documents]+'</button>';
        btnInduction = '<button href="#|" class="btn btn-' + btns[5] + '" onclick="openDate(`'+valor.induction+','+valor.candId+'`,6,5)" >'+valor.induction+'</button>';
        btnDatesSales = '<button href="#|" class="btn btn-' + btns[6] + '" onclick="openYesNo('+valor.sales_dates+','+valor.candId+',7,6)" >'+sino[valor.sales_dates]+'</button>';
        btnSales = '<button href="#|" class="btn btn-' + btns[7] + '" onclick="openYesNo('+valor.sales+','+valor.candId+',8,7)" >'+sino[valor.sales]+'</button>';
        btnSigCia = '<button href="#|" class="btn btn-' + btns[8] + '" onclick="openYesNo('+valor.signed_cia+','+valor.candId+',9,8)" >'+sino[valor.signed_cia]+'</button>';
        btnCia = '<button href="#|" class="btn btn-' + btns[9] + '" onclick="openDate(`'+valor.cia+'`,'+valor.candId+',10,9)" >'+valor.cia+'</button>';
        btnInitialKey = '<button href="#|" class="btn btn-primary" onclick="openText(`'+valor.initial_key+'`,'+valor.candId+',11,+`n`)" >'+valor.initial_key+'</button>';
        btnInitialDate = '<button href="#|" class="btn btn-' + btns[10] + '" onclick="openDate(`'+valor.initial_date+'`,'+valor.candId+',12,10)" >'+valor.initial_date+'</button>';

        btnLicenseDate = '<button href="#|" class="btn btn-' + btns[11] + '" onclick="openDate(`'+valor.license_date+'`,'+valor.candId+',13,11)" >'+valor.license_date+'</button>';
        btnExamDate = '<button href="#|" class="btn btn-' + btns[12] + '" onclick="openDate(`'+valor.exam_date+'`,'+valor.candId+',14,12)" >'+valor.exam_date+'</button>';
        btnExam = '<button href="#|" class="btn btn-' + btns[13] + '" onclick="openDate(`'+valor.exam+'`,'+valor.candId+',15,13)" >'+valor.exam+'</button>';
        btnCnsfDate = '<button href="#|" class="btn btn-' + btns[14] + '" onclick="openDate(`'+valor.cnsf_date+'`,'+valor.candId+',16,14)" >'+valor.cnsf_date+'</button>';
        btnLicense = '<button href="#|" class="btn btn-' + btns[15] + '" onclick="openDate(`'+valor.license+'`,'+valor.candId+',17,15)" >'+valor.license+'</button>';

        btnAgKey = '<button href="#|" class="btn btn-primary" onclick="openText(`'+valor.agent_key+'`,'+valor.candId+',18,`n`)" >'+valor.agent_key+'</button>';
        btnMetSig = '<button href="#|" class="btn btn-' + btns[16] + '" onclick="openDate(`'+valor.btnMetSig+'`,'+valor.candId+',19,16)" >'+valor.btnMetSig+'</button>';
        btnMetGrad = '<button href="#|" class="btn btn-' + btns[17] + '" onclick="openYesNo('+valor.met_graduate+','+valor.candId+',20,17)" >'+sino[valor.met_graduate]+'</button>';

        btnEdit = '<button href="#|" class="btn btn-warning" onclick="openEdit('+valor.candId+')" ><i class="fas fa-eye"></i></button>';

        table.row.add([valor.candName,btnStat,btnActiveStat,
            dates[0],dates[1],valor.origin,valor.ddn,
            valor.cellphone,valor.rfc,valor.mail,valor.sex,valor.age,valor.city,valor.scholarity,viewCV,
            btnFstInt,btnPda,btnScndInt,btnCharge,btnConfirmed,
            btnDocs,btnInduction,btnDatesSales,btnSales,btnSigCia,btnCia,btnInitialKey,btnInitialDate,
            btnLicenseDate,btnExamDate,btnExamDate,btnExam,btnCnsfDate,btnLicense,
            btnAgKey,btnMetSig,btnMetGrad]).node().candId = valor.candId;
    });
    table.draw(false);
}

function cancelar(modal)
{
    $(modal).modal('hide');
}

function openYesNo(valor,id,field,btns)
{
    editId = id;
    editField = field;
    editBtns = btns;

    $("#selectYesNo").val(valor);

    $("#yesnoModal").modal('show');
}

function openDate(valor,id,field,btns)
{
    editId = id;
    editField = field;
    editBtns = btns;

    $("#datepick").val(valor);

    $("#dateModal").modal('show');
}

function openCharge(valor,id,field,btns)
{
    editId = id;
    editField = field;
    editBtns = btns;

    $("#selectCharge").val(valor);

    $("#chargeModal").modal('show');
}

function openText(valor,id,field,btns)
{
    editId = id;
    editField = field;
    editBtns = btns;

    $("#keytext").val(valor);

    $("#textModal").modal('show');
}
