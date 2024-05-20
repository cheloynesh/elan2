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
        },
        order: [[6, 'desc']],
        columnDefs: [
            {
                targets: [0],
                className: 'dt-body-left'
            },
            {
                targets: [2,4,6],
                className: 'dt-body-right',
            }],

        footerCallback: function (row, data, start, end, display) {
            var api = this.api();

            // Remove the formatting to get integer data for summation
            var intVal = function (i) {
                return typeof i === 'string' ? i.replace(/[\$,]/g, '') * 1 : typeof i === 'number' ? i : 0;
            };

            // Total over all pages
            total1 = api
                .column(1)
                .data()
                .reduce(function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0);
            total2 = api
                .column(2)
                .data()
                .reduce(function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0);
            total3 = api
                .column(3)
                .data()
                .reduce(function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0);
            total4 = api
                .column(4)
                .data()
                .reduce(function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0);
            total5 = api
                .column(5)
                .data()
                .reduce(function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0);
            total6 = api
                .column(6)
                .data()
                .reduce(function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0);

            document.getElementById('conting').innerHTML= total1;
            document.getElementById('suming').innerHTML= formatter.format(total2);
            document.getElementById('contenit').innerHTML= total3;
            document.getElementById('sumemit').innerHTML= formatter.format(total4);
            document.getElementById('contpay').innerHTML= total5;
            document.getElementById('sumpay').innerHTML= formatter.format(total6);

            // Update footer
            // $(api.column(1).footer()).html(total1);
            // $(api.column(2).footer()).html(formatter.format(total2));
            // $(api.column(3).footer()).html(total3);
            // $(api.column(4).footer()).html(formatter.format(total4));
            // $(api.column(5).footer()).html(total5);
            // $(api.column(6).footer()).html(formatter.format(total6));
        },
    });
} );

var formatter = new Intl.NumberFormat('en-US', {
    style: 'currency',
    currency: 'USD',
  });
var branchesChart;
var insuranceChart;
var statusChart;
var payChart;

document.addEventListener("DOMContentLoaded", function () {

    var route = baseUrl + '/GetInfo/'+ 1;

    jQuery.ajax({
        url:route,
        type:'get',
        dataType:'json',
        success:function(result)
        {
            fillCharts(result.insurances, result.branches, result.status, result.pay);
        }
    })
});

function fillCharts(insurances,branches,status,pay)
{
    insname = [];
    inscont = [];
    insurances.forEach( function(valor, indice, array){
        insname.push(valor.insname);
        inscont.push(valor.inscuant);
    });
    insuranceChart = new Chart("insuranceChart", {
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
                }
            }
        }
    });
    insname = [];
    inscont = [];
    branches.forEach( function(valor, indice, array){
        insname.push(valor.insname);
        inscont.push(valor.inscuant);
    });
    branchesChart = new Chart("branchesChart", {
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
                }
            }
        }
    });
    insname = [];
    inscont = [];
    status.forEach( function(valor, indice, array){
        insname.push(valor.insname);
        inscont.push(valor.inscuant);
    });
    statusChart = new Chart("statusChart", {
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
                }
            }
        }
    });
    insname = [];
    inscont = [];
    pay.forEach( function(valor, indice, array){
        insname.push(valor.insname);
        inscont.push(valor.inscuant);
    });
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
                }
            }
        }
    });
}

function updateCharts(insurances,branches,status,pay)
{
    insuranceChart.destroy();
    branchesChart.destroy();
    statusChart.destroy();
    payChart.destroy();
    fillCharts(insurances,branches,status,pay);
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
            result.data.forEach( function(valor, indice, array) {
                table.row.add([valor.AgentName,valor.CountAll,valor.SumAll,valor.CountEmit,valor.SumEmit,valor.CountPoliz,valor.SumPoliz]);
            });
            table.draw(false);
            updateCharts(result.insurances, result.branches, result.status, result.pay);
        }
    })
}
function exclInitials(id)
{
    alertify.confirm("Descargar Excel","¿Desea descargar el excel con las solicitudes ingresadas?",
        function(){
            var month = $("#month").val();
            var quarter = $("#selectQuarter").val();
            var branch = $("#selectBranch").val();
            var insurance = $("#selectInsurance").val();
            if(month == '%') month = 12; else month = month;
            if(quarter == '%') quarter = "a"; else quarter = quarter;
            if(branch == '%') branch = "a"; else branch = branch;
            if(insurance == '%') insurance = "a"; else insurance = insurance;

            var route = baseUrl + '/ExportInitialsDuePay/' + month + '/' + quarter + '/' + branch + '/' + insurance;
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
        },
        function(){
    });
}

function exclEmitNoPay(id)
{
    alertify.confirm("Descargar Excel","¿Desea descargar el excel con las pólizas no pagadas?",
        function(){
            var month = $("#month").val();
            var quarter = $("#selectQuarter").val();
            var branch = $("#selectBranch").val();
            var insurance = $("#selectInsurance").val();
            if(month == '%') month = 12; else month = month;
            if(quarter == '%') quarter = "a"; else quarter = quarter;
            if(branch == '%') branch = "a"; else branch = branch;
            if(insurance == '%') insurance = "a"; else insurance = insurance;

            var route = baseUrl + '/ExportEmitNoPay/' + month + '/' + quarter + '/' + branch + '/' + insurance;
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
        },
        function(){
    });
}

function exclEmitPay(id)
{
    alertify.confirm("Descargar Excel","¿Desea descargar el excel con las pólizas pagadas?",
        function(){
            var month = $("#month").val();
            var quarter = $("#selectQuarter").val();
            var branch = $("#selectBranch").val();
            var insurance = $("#selectInsurance").val();
            if(month == '%') month = "a"; else month = month;
            if(quarter == '%') quarter = "a"; else quarter = quarter;
            if(branch == '%') branch = "a"; else branch = branch;
            if(insurance == '%') insurance = "a"; else insurance = insurance;

            var route = baseUrl + '/ExportEmitPay/' + month + '/' + quarter + '/' + branch + '/' + insurance;
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
        },
        function(){
    });
}

