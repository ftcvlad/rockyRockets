function logoutF(){
    $.post("../logout.php",function(){
        window.location  = "../loginPage.php";
    });
}