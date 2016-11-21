

$(function(){


});


function deleteAll(){

    $.ajax({
        type: "POST",
        url: "./deleteFromBasket.php" ,
        data: { deleteType:"all"}  ,
        dataType: "text",
        success: function() {

            $("#allContent").html('');
            $("#allContent").append(" <h2>No items in cart </h2>");

        },
        error:function(jqXHR, status, errorText){

            alert("unexpected error occured!");

        }

    });
}



function deleteItem(target){

    $.ajax({
        type: "POST",
        url: "./deleteFromBasket.php" ,
        data: {id:$(target).parent().parent().data("id"), deleteType:"single"}  ,
        dataType: "text",
        success: function(result) {

            $(target).parent().parent().remove();

            var allContent = $("#allContent");

            if (allContent.find("tbody tr").length===0){
                allContent.html('');
                allContent.append(" <h2>No items in cart </h2>");
            }
        },
        error:function(jqXHR, status, errorText){

            alert("unexpected error occured!");


        }

    });


}

function purchase(){
    $.ajax({
        type: "POST",
        url: "./purchase.php" ,
        data: {} ,
        dataType: "text",
        success: function(result) {


            $("#messageDiv").html(result);



        },
        error:function(jqXHR, status, errorText){

            $("#messageDiv").html(jqXHR.responseText);


        }

    });
}