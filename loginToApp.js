function alertLoginToApp(alert, msg) {
    $("#feedbackFromApi").removeClass();
    $("#feedbackFromApi").addClass(alert);
    $("#feedbackFromApi").empty().append(msg);
}

function validIsEmail(email) {
        return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)
}

function loginToApp() {
    event.preventDefault();

	var type = "login";
	var email = $("#email").val();
	var password = $("#password").val();

    if((email == "") || (password == "")) {
      console.log("Please, fill in all fields");
      alertLoginToApp("alert alert_pass","Please, fill in all fields");
    } else {

        if(validIsEmail(email)) {
            var posting = $.post("api/api.php", {
                type: type,
                email: email,
                password: password
            });
            
            posting.done(function(data) {
                console.log(data);
                var json = JSON.parse(data);
                if(json.error) {
                    console.log(json.error);
                    // Email is existing
                    alertLoginToApp("alert alert_pass",json.message)
                    
                } else if((json.error == false)) {
                    // Succesfully login user
                    //alertLoginToApp("alert alert_succ",json.message);
                    // The clearing all fields in form
                    location.reload();
                } else {
                    // Any errors
                    alertLoginToApp("alert alert_pass","ERROR 500");
                }
            }); 
        } else {
            alertLoginToApp("alert alert_pass","Email is not correct!");
        }
    } 
}

function backPage() {
    window.location.href = "loginProfileApp.php"
 }