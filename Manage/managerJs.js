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
                    $("tbody").append("<tr>  <td>"+allData[i].FirstName+"</td>" +
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

                $(".panel-heading").append("<span style='color:red;'> database error</span>");
            }
            else if (jqXHR.status === 401){

                $(".panel-heading").append("<span style='color:red;'> "+jqXHR.responseText+"</span>");
            }
            else if (jqXHR.status === 404){
                $(".panel-heading").append("<span style='color:red;'>bad request</span>");
            }
        }

    });



}