
$(function(){


    $('#registerForm').submit(function() {

        var errorElem =  $("#error");
        errorElem.text('');
        var username = $("#username").val().trim();
        var password = $("#password").val().trim();
        var firstName = $("#FirstName").val().trim();
        var lastName = $("#LastName").val().trim();
        var addressLine1 = $("#AddressLine1").val().trim();
        var street = $("#Street").val().trim();
        var city = $("#City").val().trim();
        var postCode = $("#PostCode").val().trim();



        if (username==="" || password==="" || firstName==="" || lastName==="" || addressLine1==="" || street===""
                                            || city==="" || postCode===""){
            errorElem.text("All fields are mandatory!");
            return false;
        }

    });
});


