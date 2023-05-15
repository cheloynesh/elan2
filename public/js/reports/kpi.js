var ruta = window.location;
var getUrl = window.location;
var baseUrl = getUrl .protocol + "//" + getUrl.host + getUrl.pathname;
var colors = [
    'rgb(54, 162, 235)',
    'rgb(255, 205, 86)',
    'rgb(255, 159, 64)',
    'rgb(255, 99, 132)',
    'rgb(75, 192, 192)',
    'rgb(153, 102, 255)',
    'rgb(182, 203, 255)',
    'rgb(201, 203, 207)',
    'rgba(122,195,106,255)',
    'rgba(241,90,96,255)',
    'rgba(255,112,67,255)'];

$(document).ready( function () {
    // $('#tbProf thead th').each( function () {
    //     var title = $(this).text();
    //     $(this).html( '<input type="text" class="form-control" placeholder="Search '+title+'" />' );
    // } );
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
    });
} );

var formatter = new Intl.NumberFormat('en-US', {
    style: 'currency',
    currency: 'USD',
  });
var initialChart;
var servicesChart;
var sinisterChart;
// var payChart;

document.addEventListener("DOMContentLoaded", function () {

    var route = baseUrl + '/GetInfo/'+ 1;

    jQuery.ajax({
        url:route,
        type:'get',
        dataType:'json',
        success:function(result)
        {
            fillCharts(result.services, result.initials, result.sinister, result.pay);
        }
    })
});

function fillCharts(services,initials,sinister,pay)
{
    insname = ['Ingresados','Atendidos'];
    inscont = [services[0].CountIngr,services[0].CountEmit];
    servicesChart = new Chart("servicesChart", {
        type: "doughnut",
        data: {
            labels: insname,
            datasets: [{
                label: 'Total',
                data: inscont,
                backgroundColor: colors,
                hoverOffset: 4
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: true,
                    position: 'right'
                },
                title: {
                    display: true,
                    text: 'Servicios'
                }
            }
        }
    });
    insname = ['Ingresados','Emitidas'];
    inscont = [initials[0].CountIngr,initials[0].CountEmit];
    initialChart = new Chart("initialChart", {
        type: "doughnut",
        data: {
            labels: insname,
            datasets: [{
                label: 'Total',
                data: inscont,
                backgroundColor: colors,
                hoverOffset: 4
            }]
        },
        options: {
            plugins: {
                legend: {
                    display: true,
                    position: 'right'
                },
                title: {
                    display: true,
                    text: 'Iniciales'
                }
            }
        }
    });
    insname = ['Ingresados','Atendidos'];
    inscont = [sinister[0].CountIngr,sinister[0].CountEmit];
    sinisterChart = new Chart("sinisterChart", {
        type: "doughnut",
        data: {
            labels: insname,
            datasets: [{
                label: 'Total',
                data: inscont,
                backgroundColor: colors,
                hoverOffset: 4
            }]
        },
        options: {
            plugins: {
                legend: {
                    display: true,
                    position: 'right'
                },
                title: {
                    position: 'top',
                    display: true,
                    text: 'Siniestros'
                }
            }
        }
    });
    insname = ['Emitidos','Inicial Pagada'];
    inscont = [pay[0].CountIngr,pay[0].CountEmit];
    payChart = new Chart("payChart", {
        type: "doughnut",
        data: {
            labels: insname,
            datasets: [{
                label: 'Total',
                data: inscont,
                backgroundColor: colors,
                hoverOffset: 4
            }]
        },
        options: {
            plugins: {
                legend: {
                    display: true,
                    position: 'right'
                },
                title: {
                    position: 'top',
                    display: true,
                    text: 'Cobro Venta Inicial'
                }
            }
        }
    });
}

function updateCharts(services,initials,sinister,pay)
{
    servicesChart.destroy();
    initialChart.destroy();
    sinisterChart.destroy();
    payChart.destroy();
    fillCharts(services,initials,sinister,pay);
}

function QuarterChange()
{
    $("#month").val("%");
    GetFilters();
}
function MonthChange()
{
    $("#selectQuarter").val("%");
    GetFilters();
}
function GetFilters()
{
    var route = baseUrl + '/GetInfoFilters/'+ 1;
    var data = {
        "_token": $("meta[name='csrf-token']").attr("content"),
        'month':$("#month").val(),
        'quarter':$("#selectQuarter").val(),
        'branch':$("#selectBranch").val(),
        'insurance':$("#selectInsurance").val()
    };
    var table = $('#tbProf').DataTable();

    jQuery.ajax({
        url:route,
        type:'get',
        data: data,
        dataType:'json',
        success:function(result)
        {
            table.clear();

            table.row.add(["Cobro Venta Inicial",result.pay[0].CountIngr,result.pay[0].CountEmit,result.pay[0].Porc]).node().id = 1;
            table.row.add(["Iniciales",result.initials[0].CountIngr,result.initials[0].CountEmit,result.initials[0].Porc]).node().id = 1;
            table.row.add(["Servicios",result.services[0].CountIngr,result.services[0].CountEmit,result.services[0].Porc]).node().id = 1;
            table.row.add(["Siniestros",result.sinister[0].CountIngr,result.sinister[0].CountEmit,result.sinister[0].Porc]).node().id = 1;

            table.draw(false);
            updateCharts(result.services, result.initials, result.sinister, result.pay);
        }
    })
}
