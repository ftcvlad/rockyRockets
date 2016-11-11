/**
 * Created by Vlad on 06/11/2016.
 */

var targetRow ;
$(function(){

    $('#modalSubmitButton').bind('click', function(){
        $(".panel-heading").find('span').remove();

        $.ajax({
            type: 'POST',
            url: "/Manage/hr_specific/updateSalary.php",
            data: {newSalary:$("#salary").val(),staffId:$(targetRow).data("id") },
            dataType: "text",
            success: function(resultData) {

                $(':nth-child(5)', targetRow).text(resultData);
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



});



function searchStaff(){

    $("tbody").html('');
    $(".panel-heading").find('span').remove();

    $.ajax({
        type: 'POST',
        url: "/Manage/search.php",
        data: {criterion:$("#criteria").val(),position:$("#posSel").val() },
        dataType: "text",
        success: function(resultData) {


            var response = JSON.parse(resultData);


            var allRowsArray = response.rowsArray;
            var managerDep = response.managerDep;



            if (allRowsArray.length===0){
                $(".panel-heading").append("<span >No staff found!</span>");
            }

            else{
                var editStaffString="";
                if (managerDep==="Hr"){
                    editStaffString = "<button data-toggle=\"modal\" data-target=\"#myModal\" class=\"cornerButton edit\" onclick=\"addId(this.parentElement.parentElement)\" ><img src=\"images/edit3.png\"></button>"+
                                      "<button class=\"cornerButton delete\" onclick=\"\" ><img src=\"images/delete.png\"></button>";
                }

               for (var i=0;i<allRowsArray.length;i++){
                    $("tbody").append("<tr data-id=\'"+allRowsArray[i].Id+"\'>"+
                                            "<td>"+editStaffString+allRowsArray[i].FirstName+"</td>" +
                                            "<td>"+allRowsArray[i].LastName+"</td>"+
                                            "<td>"+allRowsArray[i].ContactNumber+"</td>"+
                                            "<td>"+allRowsArray[i].Position+"</td>"+
                                            "<td>"+allRowsArray[i].Salary+"</td>"+
                                            "<td>"+allRowsArray[i].DepartmentType+"</td>"+
                                            "<td>"+allRowsArray[i].LocationType+"</td>"+"</tr>");
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
                $(".panel-heading").append("<span > "+jqXHR.responseText+"</span>");
            }
        }

    });




}


//add data to modal and remember clicked row
function addId(target){


    $("#salary").val($(':nth-child(5)', target).text() );
    $("#myModal").find("h4").text($(':nth-child(1)', target).text()+" "+$(':nth-child(2)', target).text()  );

    targetRow = target;

}





