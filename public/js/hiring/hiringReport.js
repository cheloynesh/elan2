var ruta = window.location;
var getUrl = window.location;
var baseUrl = getUrl .protocol + "//" + getUrl.host + getUrl.pathname;
arrayData = [];

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
        footerCallback: function (row, data, start, end, display) {
            var api = this.api();

            // Remove the formatting to get integer data for summation
            var intVal = function (i) {
                return typeof i === 'string' ? i.replace(/[\$,]/g, '') * 1 : typeof i === 'number' ? i : 0;
            };

            // Total over all parrayData
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
            total7 = api
                .column(7)
                .data()
                .reduce(function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0);
            total8 = api
                .column(8)
                .data()
                .reduce(function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0);
            total9 = api
                .column(9)
                .data()
                .reduce(function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0);

            // document.getElementById('conting').innerHTML= total1;
            // document.getElementById('suming').innerHTML= formatter.format(total2);
            // document.getElementById('contenit').innerHTML= total3;
            // document.getElementById('sumemit').innerHTML= formatter.format(total4);
            // document.getElementById('contpay').innerHTML= total5;
            // document.getElementById('sumpay').innerHTML= formatter.format(total6);

            // Update footer
            $(api.column(0).footer()).html("Total");
            $(api.column(1).footer()).html(total1);
            $(api.column(2).footer()).html(total2);
            $(api.column(3).footer()).html(total3);
            $(api.column(4).footer()).html(total4);
            $(api.column(5).footer()).html(total5);
            $(api.column(6).footer()).html(total6);
            $(api.column(7).footer()).html(total7);
            $(api.column(8).footer()).html(total8);
            $(api.column(9).footer()).html(total9);
            arrayData = [total1,total2,total3,total4,total5,total6,total7,total8,total9];
            fillCharts(arrayData);
        }
    });
} );

// document.addEventListener("DOMContentLoaded", function () {
//     fillCharts();
// });



function fillCharts(arrayData)
{
    arrayLabel = ["1er Entrevista","2da Entrevista","Inducción","Inscrito a CIA","CIA","Examen","Cédula","Alta Metlife", "Gradurado Met"];

    //1) combine the arrays:
    var list = [];
    for (var j = 0; j < arrayLabel.length; j++)
        list.push({'label': arrayLabel[j], 'data': arrayData[j]});

    //2) sort:
    list.sort(function(a, b) {
        return ((a.data > b.data) ? -1 : ((a.data == b.data) ? 0 : 1));
        //Sort could be modified to, for example, sort on the data
        // if the label is the same. See Bonus section below
    });

    //3) separate them back out:
    for (var k = 0; k < list.length; k++) {
        arrayLabel[k] = list[k].label;
        arrayData[k] = list[k].data;
    }

    console.log(arrayLabel,arrayData);

    insuranceChart = new Chart("insuranceChart", {
        type: 'bar',
        data:
        {
            labels: arrayLabel,
            datasets: [
                {
                  label: 'Candidatos',
                    data: arrayData,
                    backgroundColor: 'rgb(54, 162, 235)',
                }]
        },
        options: {
            indexAxis: 'y',
            // Elements options apply to all of the options unless overridden in a dataset
            // In this case, we are setting the border of each horizontal bar to be 2px wide
            elements: {
            bar: {
                borderWidth: 2,
            }
            },
            responsive: true,
            plugins: {
            legend: {
                position: 'right',
            },
            title: {
                display: true,
            }
            }
        },
      });
}
