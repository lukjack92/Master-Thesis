$(document).ready(function() {
    var type = "category";
    var posting = $.post("api/api.php", {
        type: type
    });	

    posting.done(function(data) {
        var json = JSON.parse(data);
        console.log(data);
        console.log(json);
        console.log(json.message.length);
        if(!json.error) {
            $("#chooseCategoryQuiz option").remove();
            for(var i=0; i<json.message.length; i++) {
                var select = document.getElementById("chooseCategoryQuiz");
                var option = document.createElement('option');
                option.appendChild(document.createTextNode(json.message[i].name));
                select.appendChild(option);
            }
        } else {
            $("b").empty().append("No active categories!");
            document.getElementById("chooseCategoryQuiz").remove();
            document.getElementById("start").remove();
        }
    });
});

function readQuostionsFromCategory() {
    event.preventDefault();
    var type = "questionsFromCategory";
    var category = $("#chooseCategoryQuiz").val();
    
    var posting = $.post("api/api.php", {
        type: type,
        category: category
	});
	console.log("Start");
	
	$("#database_content").text("Loading...");
	document.getElementById("loader").style.display = "block";
	
	posting.done(function(data) {
        var json = JSON.parse(data);
        console.log(json.message);
		if(document.readyState == 'complete'){
			console.log("Koniec"); 
			$("#database_content").empty().append();	
			document.getElementById("loader").style.display = "none";
		}
	});
}