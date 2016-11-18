function logoutF(){
    $.post("../logout.php",function(){
        window.location  = "Index.php";
    });
}