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

    var data ={description:$("#description").val(), category:$("#category").val(), brand:$("#brand").val()};

    if (data.category==="apparel"){
        data.color = $("#color").val();
    }
    else if (data.category==="racket"){
        data.sport = $("#sport").val();
    }



    $.ajax({
        type: 'POST',
        url: "searchItemToOrder.php",
        data: data,
        dataType: "text",
        success: function(resultItems) {

            resultItems = JSON.parse(resultItems);

            for (var i=0;i<resultItems.length;i++){



                var imageSrc = resultItems[i].ImagePath==null?"noImage.png":resultItems[i].ImagePath;
                var brand = resultItems[i].Brand==null?"":resultItems[i].Brand;
                var price = resultItems[i].Price;
                var description = resultItems[i].Description;
                var quantity = resultItems[i].Quantity==null?0:resultItems[i].Quantity;

                $("#resultHolder").append('' +
                        '<div class="rowDiv">'+
                            '<div class="dataDiv col-xs-10" >'+
                                '<img src="/ItemPictures/'+imageSrc+'">'+
                                '<ul>'+
                                    '<li><p class="inlineParagraph">Brand:</p>'+brand+'</li>'+
                                    '<li><p >Description:</p>'+description+'</li>'+
                                    '<li><p class="inlineParagraph">Price:</p>'+price+'</li>'+
                                '</ul>'+
                            '</div>'+
                            '<div class="actionDiv col-xs-2" ">'+
                                '<div> Order</div>'+
                                '<div class="input-group">'+
                                    '<input type="text" class="form-control" max="2">'+
                                    '<span class="input-group-btn">'+
                                        '<button class="btn btn-primary " type="button">+</button>'+
                                    '</span>'+
                                '</div>'+
                                '<div id="currentQuantity">Quantity at your location: <span style="font-weight:bold">'+quantity+'</span>'+
                            '</div>'+
                        '</div>');


























            }

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