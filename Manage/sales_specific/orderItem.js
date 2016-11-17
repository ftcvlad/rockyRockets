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

    $("#category").change(function(){
        var val = $(this).val();
        if (val==="general"){
            $("#sportInputDiv").hide();
            $("#apparelInputDiv").hide();

        }
        else if (val==="racket"){
            $("#sportInputDiv").show();
            $("#apparelInputDiv").hide();
        }
        else if (val==="apparel"){
            $("#sportInputDiv").hide();
            $("#apparelInputDiv").show();
        }
    });


});

function searchItemsToOrder(){
    $("#resultHolder").html('');
    $(".panel-heading").find('span').remove();

    var data ={description:$("#description").val(), category:$("#category").val(), brand:$("#brand").val()};

    if (data.category==="apparel"){
        data.color = $("#color").val();
    }
    else if (data.category==="racket"){
        data.sport = $("#sport").val();
    }


    $.ajax({
        type: 'POST',
        url: "./searchItemToOrder.php",
        data: data,
        dataType: "text",
        success: function(resultItems) {

           // console.log(resultItems);
            resultItems = JSON.parse(resultItems);

            for (var i=0;i<resultItems.length;i++){



                var imageSrc = resultItems[i].ImagePath==null?"noImage.png":resultItems[i].ImagePath;
                var brand = resultItems[i].Brand==null?"":resultItems[i].Brand;
                var price = resultItems[i].Price;
                var description = resultItems[i].Description;
                var quantity = resultItems[i].Quantity==null?0:resultItems[i].Quantity;

                var extraLi = "";
                if (resultItems[i].Sport!==undefined){//racket

                    var sport = resultItems[i].Sport==null?"":resultItems[i].Sport;
                    var weight = resultItems[i].Weight==null?"":resultItems[i].Weight;
                    var balance = resultItems[i].Balance==null?"":resultItems[i].Balance;
                    extraLi ='<li>'+
                            '<p class="inlineParagraph extraInfo">Sport:</p>'+sport+
                            '<p class="inlineParagraph extraInfo">Weight:</p>'+weight+
                            '<p class="inlineParagraph extraInfo">Balance:</p>'+balance+
                            '</li>';

                }
                else  if (resultItems[i].Color!==undefined){//apparel
                    var color = resultItems[i].Color==null?"":resultItems[i].Color;
                    var size = resultItems[i].Size==null?"":resultItems[i].Size;
                    var gender="";

                    if (resultItems[i].ForMen!=null){
                        gender = resultItems[i].ForMen==1?"M":"F";
                    }


                    extraLi ='<li>'+
                        '<p class="inlineParagraph extraInfo">Color:</p>'+color+
                        '<p class="inlineParagraph extraInfo">Size:</p>'+size+
                        '<p class="inlineParagraph extraInfo">Gender:</p>'+gender+
                        '</li>';

                }




                $("#resultHolder").append('' +
                        '<div class="rowDiv" data-id="'+resultItems[i].itemId+'">'+
                            '<div class="dataDiv col-xs-10" >'+
                                '<img src="../../ItemPictures/'+imageSrc+'">'+
                                '<ul>'+
                                    '<li><p class="inlineParagraph">Brand:</p>'+brand+'</li>'+
                                    '<li><p >Description:</p>'+description+'</li>'+
                                    '<li><p class="inlineParagraph">Price:</p>'+price+'</li>'+
                                    extraLi+
                                '</ul>'+
                            '</div>'+
                            '<div class="actionDiv col-xs-2" ">'+
                                '<div> Order</div>'+
                                '<div class="input-group">'+
                                    '<input  class="form-control noSpinnerInput" type="number">'+
                                    '<span class="input-group-btn">'+
                                        '<button class="btn btn-primary " type="button" onclick="orderItem(this);">+</button>'+
                                    '</span>'+
                                '</div>'+
                                '<div id="currentQuantity">Quantity at your location: <span style="font-weight:bold" class="quantitySpan">'+quantity+'</span>'+
                            '</div>'+
                        '</div>');

            }

            $(".panel-heading").append("<span > Done</span>");

        },
        error:function(jqXHR, status, errorText){

            if (jqXHR.status===500){

                $(".panel-heading").append("<span> database error</span>");
            }
            else if (jqXHR.status === 401){

                $(".panel-heading").append("<span> "+jqXHR.responseText+"</span>");
            }
            else if (jqXHR.status === 404){

                $(".panel-heading").append("<span> "+jqXHR.responseText+"</span>");
            }

        }

    });



}


function orderItem(elem){

    $(".panel-heading").find("span").remove();

   var itemToOrderId = $(elem).closest(".rowDiv").data("id");
   var targetInput = $(elem).parent().prev();

   var orderSize = targetInput.val();

   if (orderSize<0){
       alert("Order size should be >0!");
       return;
   }
    $.ajax({
        type: 'POST',
        url: "./addOrder.php",
        data: {number:orderSize, id:itemToOrderId},
        dataType: "text",
        success: function(addedQuantity) {


            targetInput.val('');
            var currentAmountElem = $(elem).closest(".rowDiv").find(".quantitySpan");
            currentAmountElem.text(parseInt(currentAmountElem.text())+parseInt(addedQuantity));

            $(".panel-heading").append("<span> "+"Done"+"</span>");

        },
        error:function(jqXHR, status, errorText){

            if (jqXHR.status===500){

                $(".panel-heading").append("<span> database error</span>");
            }
            else if (jqXHR.status === 401){

                $(".panel-heading").append("<span> "+jqXHR.responseText+"</span>");
            }
            else if (jqXHR.status === 404){

                $(".panel-heading").append("<span> "+jqXHR.responseText+"</span>");
            }

        }

    });




}








function logoutF(){
    $.post("../../logout.php",function(){
        window.location  = "../../loginPage.php";
    });
}