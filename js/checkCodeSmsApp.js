function alertLoginToApp(alert, msg) {
    $("#feedbackFromApi").removeClass();
    $("#feedbackFromApi").addClass(alert);
    $("#feedbackFromApi").empty().append(msg);
}

function checkCodeSmsApp() {
    event.preventDefault();
    var code = $("#codeSms").val();

    console.log(code);
    if((code === "")) {
        alertLoginToApp("alert alert_pass","Please fill in the code field");
    } else {
        $("#feedbackFromApi").removeClass();
        $("#feedbackFromApi").empty().append("");
        
        var posting = $.post("scriptsPhp/checkCodeSmsApp.php", {
            code: code
        });
        posting.done(function(data) {
            var json = JSON.parse(data);
            console.log(json);
            alertLoginToApp("alert alert_succ",json.message);
        }); 
    }
}