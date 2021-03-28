function showimp()
{
   var get_value = document.getElementById("selectProfile");
   var valor = get_value.value;
//    alert(valor);
    if(valor == "12")
    {
        document.getElementById("etiqueta").hidden = false;
        document.getElementById("etiqueta").style.display = "block";
        document.getElementById("code").hidden = false;
        document.getElementById("code").style.display = "block";
        document.getElementById("agregarcol").hidden = false;
        document.getElementById("agregarcol").style.display = "block";
        document.getElementById("tbcodes").hidden = false;
        document.getElementById("tbcodes").style.display = "block";
        document.getElementById("tbody-codigo").hidden = false;
        document.getElementById("tbody-codigo").style.display = "block";

    }
    else
    {
        document.getElementById("etiqueta").hidden = true;
        document.getElementById("code").hidden = true;
        document.getElementById("agregarcol").hidden = true;
        document.getElementById("tbcodes").hidden = true;
        document.getElementById("tbody-codigo").hidden = true;

    }
}
var array = [];
var codigos=[];
function agregarcodigo()
{
    var codigo = $("#code").val();
    var table = $("#tbody-codigo");
    var str_row = '<tr id = "'+parseFloat(array.length+1)+'"><td><input type=text name="codigo[]" value="'+codigo+'"/></td><td><button type="button" class="btn btn-danger" onclick="delete_code(this)"><i class="fa fa-trash mr-2"></i></button></td></tr>';
    table.append(str_row);
    $("#code").val("");
    codigos.push({
        'id':array.length+1,
        'code':codigo
    });
}
function delete_code(row)
{
    var index = 0;
    var id = $(row).parent().parent().attr('id');
    $(row).parent().parent().remove();
    for(var i = 0; i<codigos.length; ++i)
    {
        if(codigos[i].id == id)
        {
            index=0;
        }
    }
    codigos.splice(index,1);
}
