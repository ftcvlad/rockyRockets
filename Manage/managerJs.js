/**
 * Created by Vlad on 06/11/2016.
 */

function searchStaff(){

    $("tbody").html('');

    $.ajax({
        type: 'POST',
        url: "search.php",
        data: {criterion:$("#criteria").val(),position:$("#posSel").val() },
        dataType: "text",
        success: function(resultData) {


            var allData = JSON.parse(resultData);


            if (allData.length===0){

            }
            else{
               for (var i=0;i<allData.length;i++){
                    $("tbody").append("<tr data-id=\'"+allData[i].Id+"\' data-toggle=\"modal\" data-target=\"#myModal\" onclick=\"addId(this)\">  <td>"+allData[i].FirstName+"</td>" +
                                            "<td>"+allData[i].LastName+"</td>"+
                                            "<td>"+allData[i].ContactNumber+"</td>"+
                                            "<td>"+allData[i].Position+"</td>"+
                                            "<td>"+allData[i].Salary+"</td>"+
                                            "<td>"+allData[i].DepartmentType+"</td>"+
                                            "<td>"+allData[i].LocationType+"</td>"+"</tr>");
               }
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
                $(".panel-heading").append("<span >bad request</span>");
            }
        }

    });




}

function addId(target){



    $("#salary").val($(':nth-child(5)', target).text() );
    $("#myModal").find("h4").text($(':nth-child(1)', target).text()+" "+$(':nth-child(2)', target).text()  );




    $('#modalSubmitButton').unbind('click').bind('click', function(){//if attaching  click, function called twice
        $(".panel-heading").find('span').remove();

        $.ajax({
            type: 'POST',
            url: "updateSalary.php",
            data: {newSalary:$("#salary").val(),staffId:$(target).data("id") },
            dataType: "text",
            success: function(resultData) {

                $(':nth-child(5)', target).text(resultData);
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







    });


}


