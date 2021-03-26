var ruta = window.location;
var getUrl = window.location;
var baseUrl = getUrl .protocol + "//" + getUrl.host + getUrl.pathname;
function guardarAseguradora()
{
    var name = $("#name").val();
    var route = "insurances";
    var data = {
        "_token": $("meta[name='csrf-token']").attr("content"),
        'name':name
    };
    jQuery.ajax({
        url:route,
        type:"post",
        data: data,
        dataType: 'json',
        success:function(result)
        {
            $("#myModal").modal('hide');
            window.location.reload(true);
        }
    })
}
var idupdate = 0;
function editarAseguradora(id)
{
    idupdate=id;

    var route = baseUrl + '/GetInfo/'+ id;

    jQuery.ajax({
        url:route,
        type:'get',
        dataType:'json',
        success:function(result)
        {
            $("#name1").val(result.data.name);
            $("#myModaledit").modal('show');
        }
    })
}
function cancelarEditar()
{
    $("#name1").val("");
    $("#myModaledit").modal('hide');
}
function actualizarAseguradora()
{
    var name = $("#name1").val();
    var route = "insurances/"+idupdate;
    var data = {
        'id':idupdate,
        "_token": $("meta[name='csrf-token']").attr("content"),
        'name':name
    };
    jQuery.ajax({
        url:route,
        type:'put',
        data:data,
        dataType:'json',
        success:function(result)
        {
            $("#myModaledit").modal('hide');
            window.location.reload(true);
        }
    })
}

function eliminarAseguradora(id)
{
    var route = "insurances/"+id;
    var data = {
            'id':id,
            "_token": $("meta[name='csrf-token']").attr("content"),
    };
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
}
