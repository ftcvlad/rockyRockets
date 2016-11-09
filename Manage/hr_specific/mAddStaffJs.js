/**
 * Created by Vlad on 08/11/2016.
 */

$(function(){


    var maxPart0Length = 0;
    var maxPart1Length = 0;

    var selectElement =  $("#dapartmentSelect");
    //http://stackoverflow.com/questions/17162219/html-multiple-column-drop-down-with-adjusted-columns
    selectElement.find("option").each(function(i){

        if (i>0){
            var next0Length = $(this).text().split(',')[0].length;
            maxPart0Length = (maxPart0Length>=next0Length)?maxPart0Length:next0Length;

            var next1Length = $(this).text().split(',')[1].length;
            maxPart1Length = (maxPart1Length>=next1Length)?maxPart1Length:next1Length;
        }
    });

    selectElement.find("option").each(function(i){

        if (i>0){
            var parts = $(this).text().split(',');
            var part0Length = parts[0].length;
            for(var j=0; j<(maxPart0Length-part0Length); j++){
                parts[0] = parts[0]+'\u00a0';
            }

            var part1Length = parts[1].length;
            for( j=0; j<(maxPart1Length-part1Length); j++){
                parts[1] = parts[1]+'\u00a0';
            }
            $(this).text(parts[0]+" | "+parts[1]+" | "+parts[2]);
        }

    });

    //ensure seller and Hr department cannot be selected simultaneously (also check on server)
    selectElement.change(function(){

        if (selectElement.find("option:selected" ).text().split("|")[1].indexOf("Hr") >= 0){
            $("input[name=position][value=" + "manager" + "]").prop("checked",true);
        }
    });

    $("input[name=position]").change(function(){

        var sellerSelected =  $("input[name=position][value=" + "seller" + "]").prop("checked");

        var hrSelected;
        if (selectElement.find("option:selected" ).val()==="-1"){//--- select --
            hrSelected=false;
        }
        else{
            hrSelected = selectElement.find("option:selected" ).text().split("|")[1].indexOf("Hr") >= 0;
        }

        if (sellerSelected && hrSelected){
            selectElement.val('-1');
        }
    });


});


function addStaff(){

    $(".panel-body .row ").find("label").removeClass("errorLabel");
    $(".panel-heading").find('span').remove();

    //VALIDATE INPUT (check on server as well)
    var noErrors = true;
    $(".validatableInput").each(function(){
       if ($(this).val()==="" || $(this).val().trim()==="" ){
           $(this).parent().parent().find("label").addClass("errorLabel");
           noErrors=false;
       }
    });

    var position = $('input[name=position]:checked').val();
    var depId = $("#dapartmentSelect").val();
    if (position===undefined){
        $("#posLabel").addClass("errorLabel");
        noErrors=false;
    }

    if (depId===null){
        $("#depLabel").addClass("errorLabel");
        noErrors=false;
    }

    if (!noErrors){
        return;
    }

    var username = $("#addUsernameInput").val().trim();
    var password = $("#addPasswordInput").val().trim();
    var name = $("#addNameInput").val().trim();
    var surname = $("#addSurnameInput").val().trim();
    var salary = $("#addSalaryInput").val().trim();


    $.ajax({
        type: 'POST',
        url: "saveStaff.php",
        data: {username:username, password:password,name:name,surname:surname,salary:salary,position:position,depId:depId},
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