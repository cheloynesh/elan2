var ruta = window.location;
var getUrl = window.location;
var baseUrl = getUrl .protocol + "//" + getUrl.host + getUrl.pathname;

// document.addEventListener("DOMContentLoaded", function () {
//     var route = baseUrl + 'GetInfo/'+ 1;

//     jQuery.ajax({
//         url:route,
//         type:'get',
//         dataType:'json',
//         success:function(result)
//         {
//             fillCharts(result);
//         }
//     })
// });

function fillCharts(result)
{
    ppant = [];
    ppact = [];

    result.ppant.forEach( function(valor, indice, array){
        ppant.push(valor.pna);
    });

    result.ppact.forEach( function(valor, indice, array){
        ppact.push(valor.pna);
    });

    insuranceChart = new Chart("insuranceChart", {
        type: 'line',
        responsive: true,
        data: {
        labels: ["Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"],
        datasets: [
          {
            label: 'PP 2023',
            data: ppant,
            backgroundColor: 'rgb(0,151,167)',
            stack: 'stacked',
            type: 'bar'
          },
          {
            label: 'PP 2024',
            data: ppact,
            backgroundColor: 'rgb(33,150,243)',
            stack: 'stacked',
            type: 'bar'
          }
        ]},
        options: {
          plugins: {
            title: {
              display: true,
              text: 'Venta Inicial'
            }
          }
        },
      });
}
function excl(type)
{
    var route = baseUrl + 'ExportExcl/' + type;
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
