/**
 * Created by Vlad on 16/11/2016.
 */
$(function(){


    $('#editProfileForm').submit(function() {

        $("#errorPar").text('');
        var username = $("#username").val().trim();
        var password = $("#password").val().trim();

        if (username==="" || password===""){
            $("#errorPar").text("Password and username are mandatory!");
            return false;
        }

    });
});


