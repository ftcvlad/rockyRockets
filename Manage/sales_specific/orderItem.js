/**
 * Created by Vlad on 12/11/2016.
 */
$(function(){


    $( "#advanced" ).click(function() {

        var extraOptsElem = $( "#moreOptions" );
        if (!extraOptsElem.is(":visible") ){
            extraOptsElem.slideDown( "fast", function() {

            });
        }
        else{
            extraOptsElem.slideUp( "fast", function() {

            });
        }

    });


});

function searchItemsToOrder(){

    $(".panel-heading").find('span').remove();

    var description = $("#description").val();
    var category = $("#category").val();
    var fromPrice = $("#fromPrice").val();
    var toPrice = $("#toPrice").val();
    var brand = $("#brand").val();



    if (toPrice<fromPrice){
        $(".panel-heading").append("<span > "+"Price interval incorrect"+"</span>");
        return;
    }
    else if (toPrice<0 || fromPrice<0){
        $(".panel-heading").append("<span > "+"Price cannot be negative"+"</span>");
        return;
    }
    else if ((toPrice==="" && fromPrice!=="") || (toPrice!=="" && fromPrice==="")){
        $(".panel-heading").append("<span > "+"Set both price values or none"+"</span>");
        return;
    }


    $.ajax({
        type: 'POST',
        url: "searchItemToOrder.php",
        data: {description: description, category:category, fromPrice:fromPrice, toPrice:toPrice, brand:brand},
        dataType: "text",
        success: function(resultItems) {



        },
        error:function(jqXHR, status, errorText){

            if (jqXHR.status===500){

                $(".panel-heading").append("<span > database error</span>");
            }
            else if (jqXHR.status === 401){

                $(".panel-heading").append("<span > "+jqXHR.responseText+"</span>");
            }
            else if (jqXHR.status === 404){

                $(".panel-heading").append("<span > "+jqXHR.responseText+"</span>");
            }

        }

    });






}