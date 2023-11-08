var getUrl = window.location;
var baseUrl = getUrl .protocol + "//" + getUrl.host + getUrl.pathname;

function validateForms()
{
    let personalform = document.getElementById('validationPersonal');
    let expform = document.getElementById('validationExp');
    let contactform = document.getElementById('validationContact');
    let endform = document.getElementById('validationEnd');

    if (personalform.checkValidity() == false || expform.checkValidity() == false || contactform.checkValidity() == false || endform.checkValidity() == false)
    {
        alert("Por favor llena los campos obligatorios antes de continuar.");
    }
    else
    {
        alertify.confirm("Enviar Postulación","Está seguro que desea enviar el formulario?",
        function(){
            var formData = new FormData();
            var files = $('input[type=file]');
            for (var i = 0; i < files.length; i++) {
                if (files[i].value == "" || files[i].value == null)
                {
                    // console.log(files.length);
                    // return false;
                }
                else
                {
                    formData.append(files[i].name, files[i].files[0]);
                }
            }

            var formSerializeArray = $("#Form").serializeArray();
            for (var i = 0; i < formSerializeArray.length; i++) {
                formData.append(formSerializeArray[i].name, formSerializeArray[i].value)
            }

            var scholarity = document.getElementsByName('scholarity');
            var social = document.getElementsByName('social');
            var sales_exp = document.getElementsByName('sales_exp');

            formData.append('_token', $("meta[name='csrf-token']").attr("content"));
            formData.append('name', $("#name").val());
            formData.append('firstname', $("#firstname").val());
            formData.append('lastname', $("#lastname").val());
            formData.append('age', $("#age").val());
            formData.append('city', $("#city").val());
            for (i = 0; i < scholarity.length; i++) {if (scholarity[i].checked) formData.append('scholarity', scholarity[i].value);}
            for (i = 0; i < social.length; i++) {if (social[i].checked) formData.append('social', social[i].value);}
            for (i = 0; i < sales_exp.length; i++) {if (sales_exp[i].checked) formData.append('sales_exp', sales_exp[i].value);}
            formData.append('mail', $("#mail").val());

            var route = baseUrl+"/uploadRequest";

            jQuery.ajax({
                url:route,
                type:'post',
                data:formData,
                contentType: false,
                processData: false,
                cache: false,
                success:function(result)
                {
                    alertify.success('Enviado');
                    document.getElementById("divThanks").style.display = "";
                    document.getElementById("generaldiv").style.display = "none";
                },
                error:function(result,error,errorTrown)
                {
                    alertify.error(errorTrown);
                }
            })
        },
        function(){
            alertify.error('Cancelado');
        });
    }
    personalform.classList.add('was-validated');
    expform.classList.add('was-validated');
    contactform.classList.add('was-validated');
    endform.classList.add('was-validated');
}

// function ContinueWelcome()
// {
//     document.getElementById("divWelcome").style.display = "none";
//     document.getElementById("divPersonal").style.display = "";
// }

// function BackPersonal()
// {
//     document.getElementById("divWelcome").style.display = "";
//     document.getElementById("divPersonal").style.display = "none";
// }

// function ContinuePersonal()
// {
//     let form = document.getElementById('validationPersonal');

//     if (form.checkValidity() == false)
//     {
//         alert("Por favor llena los campos obligatorios antes de continuar.");
//     }
//     else
//     {
//         document.getElementById("divPersonal").style.display = "none";
//         document.getElementById("divExp").style.display = "";
//     }
//     form.classList.add('was-validated');
// }

// function BackExp()
// {
//     document.getElementById("divPersonal").style.display = "";
//     document.getElementById("divExp").style.display = "none";
// }

// function ContinueExp()
// {
//     let form = document.getElementById('validationExp');

//     if (form.checkValidity() == false)
//     {
//         alert("Por favor llena los campos obligatorios antes de continuar.");
//     }
//     else
//     {
//         document.getElementById("divExp").style.display = "none";
//         document.getElementById("divContact").style.display = "";
//     }
//     form.classList.add('was-validated');
// }

// function BackContact()
// {
//     document.getElementById("divExp").style.display = "";
//     document.getElementById("divContact").style.display = "none";
// }

// function ContinueContact()
// {
//     let form = document.getElementById('validationContact');

//     if (form.checkValidity() == false)
//     {
//         alert("Por favor llena los campos obligatorios antes de continuar.");
//     }
//     else
//     {
//         document.getElementById("divContact").style.display = "none";
//         document.getElementById("divEnd").style.display = "";
//     }
//     form.classList.add('was-validated');
// }

// function BackEnd()
// {
//     document.getElementById("divContact").style.display = "";
//     document.getElementById("divEnd").style.display = "none";
// }

// function ContinueEnd()
// {
//     let form = document.getElementById('validationEnd');

//     if (form.checkValidity() == false)
//     {
//         alert("Por favor acepta los términos y condiciones antes de terminar.");
//     }
//     else
//     {
//         alertify.confirm("Enviar Postulación","Está seguro que desea enviar el formulario?",
//         function(){
//             alertify.success('Enviado');
//             document.getElementById("divEnd").style.display = "none";
//             document.getElementById("divThanks").style.display = "";
//         },
//         function(){
//             alertify.error('Cancelado');
//         });
//     }
//     form.classList.add('was-validated');
// }

// function validateForms()
// {
    // var formData = new FormData();
    // var files = $('input[type=file]');
    // for (var i = 0; i < files.length; i++) {
    //     if (files[i].value == "" || files[i].value == null)
    //     {
    //         // console.log(files.length);
    //         // return false;
    //     }
    //     else
    //     {
    //         formData.append(files[i].name, files[i].files[0]);
    //     }
    // }

    // var formSerializeArray = $("#Form").serializeArray();
    // for (var i = 0; i < formSerializeArray.length; i++) {
    //     formData.append(formSerializeArray[i].name, formSerializeArray[i].value)
    // }

    // formData.append('_token', $("meta[name='csrf-token']").attr("content"));

    // var route = baseUrl+"/uploadRequest";
    // alert(route);
    // jQuery.ajax({
    //     url:route,
    //     type:'post',
    //     data:formData,
    //     contentType: false,
    //     processData: false,
    //     cache: false,
    //     success:function(result)
    //     {
    //         alertify.error("subido");
    //     },
    //     error:function(result,error,errorTrown)
    //     {
    //         alertify.error(errorTrown);
    //     }
    // })
    // document.getElementById("viewPDF").href = getUrl.protocol + "//" + getUrl.host + "/files/cv/CV.pdf";
// }
