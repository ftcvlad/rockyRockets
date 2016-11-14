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



    $("#image").change(processImage);

});


var validExtensions = [".jpg", ".jpeg",  ".gif", ".png"];
function processImage() {
    $("#canvasDiv").html("");
    $(".panel-heading").find('span').remove();

    var file = document.getElementById('image').files[0];


    if (file !==undefined) {

        var fileName = file.name;
        var ext = fileName.substr(fileName.lastIndexOf(".")).toLowerCase();
        if (validExtensions.indexOf(ext)===-1){
            var inputFileJQ = $("#image");
            inputFileJQ.replaceWith( inputFileJQ = inputFileJQ.clone( true ) );
            $(".panel-heading").append("<span > "+"Supported extensions are: .jpg, .jpeg, .gif, .png"+"</span>");
            return;
        }

        var reader = new FileReader();
        reader.onload = function (event) {
            var img = new Image();
            img.onload = function () {

                // var canvas = document.getElementById('previewImage');
                var canvas = document.createElement("canvas");
                canvas.setAttribute("id","previewImage");
                var squareSide = 300;
                canvas.width = squareSide;
                canvas.height = squareSide;
                var ctx = canvas.getContext('2d');

                ctx.beginPath();
                ctx.rect(0, 0, squareSide, squareSide);
                ctx.fillStyle = "lightgrey";
                ctx.fill();

                var wtoh = img.width / img.height;
                var newWidth = canvas.width;
                var newHeight = newWidth / wtoh;
                if (newHeight > canvas.height) {
                    newHeight = canvas.height;
                    newWidth = newHeight * wtoh;
                }

                ctx.drawImage(img, (canvas.width - newWidth) / 2, (canvas.height - newHeight) / 2, newWidth, newHeight);
                $("#canvasDiv").append(canvas);
            };
            img.src = reader.result;
        };
        reader.readAsDataURL(file);
    }
}


function dataURItoBlob(dataURI) {
    var byteString = atob(dataURI.split(',')[1]);
    var ab = new ArrayBuffer(byteString.length);
    var ia = new Uint8Array(ab);
    for (var i = 0; i < byteString.length; i++) {
        ia[i] = byteString.charCodeAt(i);
    }
    return new Blob([ab], { type: dataURI.split(',')[0].split(':')[1].split(';')[0] });
}















function saveItem(){



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


    var form_data = new FormData();
    $.each(data,function(key,input){
        form_data.append(key,input);
    });


    var selectedFiles = document.getElementById("image").files;
    if ( selectedFiles.length===1){
        form_data.append('file', dataURItoBlob(document.getElementById('previewImage').toDataURL()),selectedFiles[0].name);
    }




    $.ajax({
        type: 'POST',
        url: "./saveItem.php",
        data: form_data,
        dataType: "text",
        contentType: false,
        processData: false,
        success: function(resultData) {

            $(".panel-heading").append("<span style='color:red;' > "+resultData+"</span>");

        },
        error:function(jqXHR, status, errorText){

            if (jqXHR.status===500){

                $(".panel-heading").append("<span > "+jqXHR.responseText+"</span>");
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


function logoutF(){
    $.post("../logout.php",function(){
        window.location  = "../../loginPage.php";
    });
}