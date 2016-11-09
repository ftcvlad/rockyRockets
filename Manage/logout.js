/**
 * Created by Vlad on 06/11/2016.
 */
function logoutF(){

    $.post("logout.php",function(){
        window.location  = "/loginPage.php";
    });


}