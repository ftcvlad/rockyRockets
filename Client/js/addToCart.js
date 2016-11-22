function addToBasket(){


    var values = {Brand:$("#modalBrand").text(), Description:$("#modalDescription").text(), Id: $("#addToBasketModal").data("id"),
        Price: $("#modalPrice").text(), Quantity: $("#modalQuantity").val() };

   // alert(JSON.stringify(values));

    $.ajax({
        type: "POST",
        url: "./addtoCart.php",
        data: values ,
        dataType: "text",
        success: function(result) {

            $("#messageDiv").html("Basket updated!");
            $("#addToBasketModal").modal('hide');
            window.scrollTo(0, 0);

        },
        error:function(jqXHR, status, errorText){


            alert("unexpected error occured!");


        }

    });

}


function addModal(target, type){


    var selectedThumb = $(target).parent();


    //update modal values
    $("#modalBrand").text(selectedThumb.data("brand"));
    $("#modalDescription").text(selectedThumb.data("desc"));
    $("#modalPrice").text(selectedThumb.data("price"));
    $("#modalImg").attr("src", "../ItemPictures/"+selectedThumb.data("img"));
    $("#addToBasketModal").data("id",selectedThumb.data("id"));


    if (type===1 || type===2){//men, women

        $("#modalSize").text(selectedThumb.data("size"));
        $("#modalColor").text(selectedThumb.data("color"));
    }
    else if (type===0){//racket
        $("#modalSport").text(selectedThumb.data("sport"));
        $("#modalWeight").text(selectedThumb.data("weight"));
        $("#modalBalance").text(selectedThumb.data("balance"));
    }
    else if (type===3){
        //nothing
    }

    $("#addToBasketModal").modal("show");



}


