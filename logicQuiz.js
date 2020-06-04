
$(document).ready(function() {
    var arrayQuestions = Array();
    var questionCounter = 0;

    $('#start').on('click', function() {
        console.log("START");

        var type = "questionsFromCategory";
        var category = $("#chooseCategoryQuiz").val();

        var posting = $.post("api/api.php", {
            type: type,
            category: category
        });
        
        $("#textToLoader").text("Loading...");
        document.getElementById("loader").style.display = "block";
        
        posting.done(function(data) {
            var json = JSON.parse(data);
            arrayQuestions = json;
            console.log(json.message);

            if(json.message == "No data") {
                $("#textToLoader").empty().append('<div class="alert alert-danger col-md-6 mx-auto" role="alert"><b>There are no questions in this category</b></div>');
                document.getElementById("loader").style.display = "none";	
                console.log("KONIEC1");
                return;
            }

            if(document.readyState == 'complete') {
                console.log("KONIEC2");
                $('#quiz').remove();
                $("#textToLoader").empty().append();
                document.getElementById("loader").style.display = "none";
                $('#next').show();
                $('#prev').show();

                var nextQuestion = createquestioData(questionCounter);
                $('#database_content').html(nextQuestion);
            }
        });
    });

    $('#next').on('click',function() {
        console.log(arrayQuestions.message.length);
        //choose();
        questionCounter++;
        var nextQuestion = createquestioData(questionCounter);
        $('#database_content').html(nextQuestion);
        //progressBar(questionCounter);
        //audioNextPrev.play();
        //displayNext();
        console.log(questionCounter);
      });
  
      $('#prev').on('click', function() {
        //choose();
        questionCounter--;
        var nextQuestion = createquestioData(questionCounter);
        $('#database_content').html(nextQuestion);
        //progressBar(questionCounter);
        //audioNextPrev.play();
        //displayNext();
    });

    function createquestioData(index)
    {
      var questionData = $('<ul>');
      var item;
      var input = '';
        item = $('<li>'); 
        input = '<p class="noselect"><b>' + arrayQuestions.message[questionCounter].question + '</b></p></br>';
        item.append(input);
        questionData.append(item);

        item = $('<li>');
        input = '<label><input type="radio" name="answer" value="ansa" >';
        input += '<p class="noselect">' + arrayQuestions.message[questionCounter].ansa + '</p></label>';
        item.append(input);
        questionData.append(item);

        item = $('<li>');
        input = '<label><input type="radio" name="answer" value="ansb" >';
        input += '<p class="noselect">' + arrayQuestions.message[questionCounter].ansb + '</p></label>';
        item.append(input);
        questionData.append(item);

        item = $('<li>');
        input = '<label><input type="radio" name="answer" value="ansc" >';
        input += '<p class="noselect">' + arrayQuestions.message[questionCounter].ansc + '</p></label>';
        item.append(input);
        questionData.append(item);

        item = $('<li>');
        input = '<label><input type="radio" name="answer" value="ansd" >';
        input += '<p class="noselect">' + arrayQuestions.message[questionCounter].ansd + '</p></label>';
        item.append(input);
        questionData.append(item);

      return questionData;
    };
});;