
//HELLOOOOO, USE ME TO DELETE ITEM FROM CART
$(function(){







});


function deleteItem(id){

    $.ajax({
        type: "POST",
        url: "./deleteBasket" ,
        data: {id:id, someotherdataYOuneed:"zzzz"}  ,
        dataType: "text",
        success: function(result) {



        },
        error:function(jqXHR, status, errorText){

            // if (jqXHR.status===500){
            //
            //     $(".panel-heading").append("<span > database error</span>");
            // }
            // else if (jqXHR.status === 401){
            //
            //     $(".panel-heading").append("<span > "+jqXHR.responseText+"</span>");
            // }
            // else if (jqXHR.status === 404){
            //
            //     $(".panel-heading").append("<span > "+jqXHR.responseText+"</span>");
            // }

        }

    });
}
