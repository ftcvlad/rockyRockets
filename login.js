function checkLoginDetails(){


    $.ajax({
        type: 'POST',
        url: "login.php",
        data: {username:$("#inputUsername").val(),password:$("#inputPassword").val(), type:$('input[name=userTypeRadio]:checked').val() },
        dataType: "text",
        success: function(resultData) {
            window.location = resultData;
        },
        error:function(jqXHR, status, errorText){
           if (jqXHR.status===500){
               $("#error").text("database error");
           }
           else if (jqXHR.status === 401){
               $("#error").text(jqXHR.responseText);
           }
           else if (jqXHR.status === 404){
               $("#error").text("bad request");
           }
        }

    });

}