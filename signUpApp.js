function alertSignUp(alert, msg) {
    $("#feedbackFromApi").removeClass();
    $("#feedbackFromApi").addClass(alert);
    $("#feedbackFromApi").empty().append(msg);
}

function validIsEmail(email) {
        return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)
}

function signUpToApp() {
    event.preventDefault();

	var type = "signup";
	var username = $("#username").val();
    var email = $("#email").val();
    var phoneNumber = $("#phoneNumber").val();
    phoneNumber = phoneNumber.replace(/\s/g, '');
    var password = $("#password").val();
    var countryCode = $("#countryCode").val();
    var phoneNumberNew = countryCode+phoneNumber;

    if((username == "") || (email == "") || (password == "") || (phoneNumber == "")) {
      console.log("Please, fill in all fields");
      console.log(phoneNumberNew);
      alertSignUp("alert alert_pass","Please, fill in all fields");
    } else {
        console.log(type);
        console.log(username);
        console.log(email);
        console.log(password);
        console.log(phoneNumberNew);
        console.log("Start!");

        if(validIsEmail(email)) {
            if(phoneNumber.match(/^\d+$/)) {
                var posting = $.post("api/api.php", {
                    type: type,
                    username: username,
                    email: email,
                    phoneNumber: phoneNumberNew,
                    password: password
                });
                
                posting.done(function(data) {
                    console.log(data);
                    var json = JSON.parse(data);
                    if(json.error) {
                        console.log(json.error);
                        // Email is existing
                        alertSignUp("alert alert_pass",json.message)
                    } else if((json.error == false)) {
                        // Succesfully signup user
                        alertSignUp("alert alert_succ",json.message);

                        // The clearing all fields in form
                        $("#username").val("");
                        $("#email").val("");
                        $("#password").val("");
                        $("#phoneNumber").val("");
        
                    } else {
                        // Any errors
                        alertSignUp("alert alert_pass","ERROR 500");
                    }
                }); 
            } else {
                alertSignUp("alert alert_pass","PhoneNumber doesn't just contain numbers!");
            }
        } else {
            alertSignUp("alert alert_pass","Email is not correct!");
        }
    } 
}