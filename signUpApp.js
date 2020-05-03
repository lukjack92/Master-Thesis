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
	var password = $("#password").val();

    if((username == "") || (email == "") || (password == "")) {
      console.log("Please, fill in all fields");
      alertSignUp("alert alert_pass","Please, fill in all fields");
      //$("#feedbackFromApi").removeClass();
      //$("#feedbackFromApi").addClass("alert alert_pass");
      //$("#feedbackFromApi").empty().append("Please, fill in all fields");
    } else {
        console.log(type);
        console.log(username);
        console.log(email);
        console.log(password);
        console.log("Start!");

        if(validIsEmail(email)) {
            var posting = $.post("api/api.php", {
                type: type,
                username: username,
                email: email,
                password: password
            });
            
            posting.done(function(data) {
                console.log(data);
                var json = JSON.parse(data);
                if(json.error) {
                    console.log(json.error);
                    // Email is existing
                    alertSignUp("alert alert_pass",json.message)
                    //$("#feedbackFromApi").removeClass();
                    //$("#feedbackFromApi").addClass("alert alert_pass");
                    //$("#feedbackFromApi").empty().append(json.message);
                } else if((json.error == false)) {
                    // Succesfully signup user
                    alertSignUp("alert alert_succ",json.message);
                    //$("#feedbackFromApi").removeClass();
                    //$("#feedbackFromApi").addClass("alert alert_succ");
                    //$("#feedbackFromApi").empty().append(json.message);
    
                    // The clearing all fields in form
                    $("#username").val("");
                    $("#email").val("");
                    $("#password").val("");
    
                } else {
                    // Any errors
                    alertSignUp("alert alert_pass","ERROR 500");
                    //$("#feedbackFromApi").removeClass();
                    //$("#feedbackFromApi").addClass("alert alert_pass");
                    //$("#feedbackFromApi").empty().append("ERROR 500");
                }
            }); 
        } else {
            alertSignUp("alert alert_pass","Email is not correct!");
        }
    } 
}