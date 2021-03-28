var ruta = window.location;
var getUrl = window.location;
var baseUrl = getUrl .protocol + "//" + getUrl.host + getUrl.pathname;
function guardarperfil()
{
    var name = $("#name").val();
    var route = "profiles";
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
function editarperfil(id)
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
function cancelareditar()
{
    $("#name1").val("");
    $("#myModaledit").modal('hide');
}
function actualizarperfil()
{
    var name = $("#name1").val();
    var route = "profiles/"+idupdate;
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

function eliminarperfil(id)
{
    var route = "profiles/"+id;
    var data = {
            'id':id,
            "_token": $("meta[name='csrf-token']").attr("content"),
    };
    alertify.confirm("Eliminar Perfil","¿Desea borrar el perfil?",
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
