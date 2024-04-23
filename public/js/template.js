var ruta = window.location;
var getUrl = window.location;
var baseUrl = getUrl .protocol + "//" + getUrl.host + getUrl.pathname;

document.addEventListener("DOMContentLoaded", function () {
    var route = baseUrl + 'GetInfo/'+ 1;

    jQuery.ajax({
        url:route,
        type:'get',
        dataType:'json',
        success:function(result)
        {
            fillCharts(result);
        }
    })
});

function fillCharts(result)
{
    gmm = [0,0,0,0,0,0,0,0,0,0,0,0];
    autos = [0,0,0,0,0,0,0,0,0,0,0,0];
    danos = [0,0,0,0,0,0,0,0,0,0,0,0];
    vida = [0,0,0,0,0,0,0,0,0,0,0,0];
    viaje = [0,0,0,0,0,0,0,0,0,0,0,0];
    funerario = [0,0,0,0,0,0,0,0,0,0,0,0];
    gmmc = [0,0,0,0,0,0,0,0,0,0,0,0];

    result.data.forEach( function(valor, indice, array){
        switch(valor.branch)
        {
            case 1: gmm[valor.month-1] = valor.pna; break;
            case 5: autos[valor.month-1] = valor.pna; break;
            case 6: danos[valor.month-1] = valor.pna; break;
            case 7: vida[valor.month-1] = valor.pna; break;
            case 8: viaje[valor.month-1] = valor.pna; break;
            case 10: funerario[valor.month-1] = valor.pna; break;
            case 11: gmmc[valor.month-1] = valor.pna; break;
        }
    });

    insuranceChart = new Chart("insuranceChart", {
        type: 'line',
        responsive: true,
        data: {
        labels: ["Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"],
        datasets: [
            {
                label: 'GMM',
                data: gmm,
                backgroundColor: 'rgb(54, 162, 235)',
                stack: 'combined',
                // order: 0,
                type: 'bar'
            },
            {
                label: 'AUTOS',
                data: autos,
                backgroundColor: 'rgb(255, 205, 86)',
                stack: 'combined',
                // order: 1,
                type: 'bar'
            },
            {
                label: 'DAÑOS',
                data: danos,
                backgroundColor: 'rgb(255, 159, 64)',
                stack: 'combined',
                // order: 1,
                type: 'bar'
            },
            {
                label: 'VIDA',
                data: vida,
                backgroundColor: 'rgb(255, 99, 132)',
                stack: 'combined',
                // order: 1,
                type: 'bar'
            },
            {
                label: 'VIAJE',
                data: viaje,
                backgroundColor: 'rgb(75, 192, 192)',
                stack: 'combined',
                // order: 1,
                type: 'bar'
            },
            {
                label: 'FUNERARIO',
                data: funerario,
                backgroundColor: 'rgb(153, 102, 255)',
                stack: 'combined',
                // order: 1,
                type: 'bar'
            },
            {
                label: 'GMM COLECTIVO',
                data: gmmc,
                backgroundColor: 'rgb(182, 203, 255)',
                stack: 'combined',
                // order: 1,
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
