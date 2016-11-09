/**
 * Created by Vlad on 09/11/2016.
 */
$(function(){

    var categorySelect = $("#category");

    categorySelect.change(function(){

        var selectedOption = categorySelect.find("option:selected" ).val();
        if (selectedOption==="racket"){


            $("#racketFields").show();
            $("#apparelFields").hide();
        }
        else if (selectedOption==="apparel"){
            $("#racketFields").hide();
            $("#apparelFields").show();
        }
        else if (selectedOption==="general"){
            $("#racketFields").hide();
            $("#apparelFields").hide();
        }
    });



});

function saveItem(){

    alert("wrassgfgh");

    $(".panel-body .row ").find("label").removeClass("errorLabel");
    $(".panel-heading").find('span').remove();

    //VALIDATE INPUT

    var noErrors = true;
    var price = $("#price").val();
    if ( price==="") {
        $('.row label[for="price"]').addClass("errorLabel");
        noErrors = false;
    }
    var description = $("#description").val().trim();
    if (description===""){
        $('.row label[for="description"]').addClass("errorLabel");
        noErrors = false;
    }

    var supplierId = $("#supplier").val();
    if (supplierId==="-1"){
        $('.row label[for="supplier"]').addClass("errorLabel");
        noErrors= false;
    }


    if (!noErrors){
        return;
    }

    //and more input :(
    var brand = $("#brand").val().trim();
    var itemCode = $("#itemCode").val().trim();


    var category = $("#category").val();
    var data = {price:price,description:description,supplierId:supplierId,brand:brand,itemCode:itemCode,category:category};
    if (category==="racket"){
        var sport =  $("#sport").val();
        var balance =  $("#balance").val().trim();
        var weight = $("#weight").val().trim();

        data.sport = sport;
        data.balance = balance;
        data.weight = weight;
    }
    else if(category==="apparel"){
        var size =  $("#size").val().trim();
        var color =  $("#color").val().trim();
        var forMen = $('input[name=gender]:checked').val();

        data.size = size;
        data.color = color;
        data.forMen = forMen;
    }




    $.ajax({
        type: 'POST',
        url: "saveItem.php",
        data: data,
        dataType: "text",
        success: function(resultData) {

            $(".panel-heading").append("<span style='color:red;' > "+resultData+"</span>");

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