$(document).ready(function() {
    var type = "category";
    var posting = $.post("api/api.php", {
        type: type
    });	

    posting.done(function(data) {
        var json = JSON.parse(data);

        $("#chooseCategoryQuiz option").remove();
        for(var i=0; i<json.message.length; i++) {
            var select = document.getElementById("chooseCategoryQuiz");
            var option = document.createElement('option');
            option.appendChild(document.createTextNode(json.message[i].name));
            select.appendChild(option);
        }
    });
});

function readQuostionsFromCategory() {
    var type = "questionsFromCategory";
    var category = $("#chooseCategoryQuiz").val();

    var posting = $.post("api/api.php", {
        type: type,
        category: category
    });	

    posting.done(function(data) {
        var json = JSON.parse(data);
        console.log(json.message);
    });
}