function alertLoginToApp(alert, msg) {
    $("#feedbackFromApi").removeClass();
    $("#feedbackFromApi").addClass(alert);
    $("#feedbackFromApi").empty().append(msg);
}

function validIsEmail(email) {
    return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)
}

function forgotPwdToApp() {
    event.preventDefault();

	var type = "forgotPwdProfile";
    var email = $("#email").val();
    
    if((email === "")) {
      alertLoginToApp("alert alert_pass","Please fill in the email field");
    } else {
        if(validIsEmail(email)) {
            var posting = $.post("api/api.php", {
                type: type,
                email: email,
            });
            
            posting.done(function(data) {
                console.log(data);
                var json = JSON.parse(data);
                if(json.error) {
                    // Email is not exist in the DB
                    alertLoginToApp("alert alert_pass",json.message)
                } else if((json.error == false)) {
                    var email = json.user.email;
                    var number = json.user.phoneNumber;

                    console.log(email+" "+number);

                    var posting = $.post("sms/sms.php", {
                        phoneNumber: number,
                    });
                    posting.done(function(data) {
                        var json = JSON.parse(data);

                        if(json.message === "success") {
                            window.location.href = "checkCodeSMS.php";
                        } else {
                            alertLoginToApp("alert alert_pass","SMS probably was not sent");
                        }
 
                    }); 

                    // Email is exist 
                    //alertLoginToApp("alert alert_succ",json.message);
                    //window.location.href = "checkCodeSMS.php";
                } else {
                    // Any errors
                    alertLoginToApp("alert alert_pass","ERROR");
                }
            }); 
        } else {
            alertLoginToApp("alert alert_pass","Email is not correct!");
        }
    } 
}