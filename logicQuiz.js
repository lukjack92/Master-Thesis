
$(document).ready(function() {
    var arrayQuestions = Array();
    var questionCounter = 0;
    var category;
    var select = [];
    var email = $('#email').val();

    $('#start').on('click', function() {
        console.log("START");
        
        var type = "questionsFromCategory";
        category = $("#chooseCategoryQuiz").val();

        var posting = $.post("api/api.php", {
            type: type,
            category: category
        });
        
        $("#textToLoader").text("Loading...");
        document.getElementById("loader").style.display = "block";
        
        posting.done(function(data) {
            var json = JSON.parse(data);
            arrayQuestions = json;
            //console.log(json.message);

            if(json.message == "No data") {
                $("#textToLoader").empty().append('<div class="alert alert-danger col-md-6 mx-auto" role="alert"><b>There are no questions in this category</b></div>');
                document.getElementById("loader").style.display = "none";	
                console.log("KONIEC");
                return;
            }

            if(document.readyState == 'complete') {
                console.log("KONIEC");
                $('#quiz').remove();
                $('#database_content_quiz').show();
                $("#textToLoader").empty().append();
                document.getElementById("loader").style.display = "none";
                if (arrayQuestions.message.length == 1) 
                    $('#submit').show();
                else 
                    $('#next').show();
                
                nextActionQuestion();
            }
        });
    });

    function nextActionQuestion() {
        var nextQuestion = createquestioData(questionCounter);
        $('#next').before(nextQuestion);
        if (isNaN(select[questionCounter])) {
            $('input[value='+select[questionCounter]+']').prop('checked', true);
        }
    }

    function saveAnswers() {
            select[questionCounter] = $('input[name="answer"]:checked').val();
            //console.log("Log: " + select[questionCounter]);
    }

    $('#next').on('click',function() {
        //console.log(arrayQuestions.message.length);
        saveAnswers();
        questionCounter++;
        //console.log(questionCounter);
        $('ul').remove();
        displayNextPrex();
      });
  
      $('#prev').on('click', function() {
        $('#submit').hide(); 
        saveAnswers();
        questionCounter--;
        //console.log(questionCounter);
        $('ul').remove();
        displayNextPrex();
    });

    $('#submit').on('click', function() {
        saveAnswers();
        $('ul').remove();
        $('#prev').hide();
        $('#next').hide();
        $('#submit').hide();
        questionCounter++;
        displayNextPrex();
    });

    function displayNextPrex() {
        if(questionCounter < arrayQuestions.message.length) {
            if(questionCounter == 0 && arrayQuestions.message.length == 1) {
                $('#next').show();
                $('#prev').hide();
                nextActionQuestion();
            } else if (questionCounter == parseInt(arrayQuestions.message.length - 1)) {
                $('#prev').show();
                $('#next').hide();
                $('#submit').show(); 
                nextActionQuestion();
            } else if(questionCounter >= 1 && questionCounter <= parseInt(arrayQuestions.message.length - 1)) {
                $('#prev').show();
                $('#next').show();
                nextActionQuestion();
            } else if (questionCounter == 0) {
                $('#next').show();
                $('#prev').hide();
                nextActionQuestion();
            } 

            //var nextQuestion = createquestioData(questionCounter);
            //$('#next').before(nextQuestion);
        
        } else if(questionCounter == arrayQuestions.message.length) {
            //console.log(questionCounter+" "+arrayQuestions.message.length);
            viewResult();
            var result = $('<div id="result" class="col-md-8 mx-auto"></div>');
            var buttonBack = $('<a href="quizApplication.php" class="btn btn-danger btn-block padding col-md-8 mx-auto">Back</a>');
            $('#prev').before(result);
            $('#result').after(buttonBack);
            $('#next').hide();
            $('#prev').hide();
        }
    }

    function createquestioData(index) {
      var questionData = $('<ul>');
      var item;
      var input = '';
        item = $('<li>'); 
        input = '<p class="noselect"><b>'+ (++index) +' of '+ arrayQuestions.message.length+" "+arrayQuestions.message[questionCounter].question + '</b></p></br>';
        item.append(input);
        questionData.append(item);
        item = $('<li>');
        input = '<label><input type="radio" name="answer" value="ansa" >';
        input += '<p class="noselect">'+' '+ arrayQuestions.message[questionCounter].ansa + '</p></label>';
        item.append(input);
        questionData.append(item);

        item = $('<li>');
        input = '<label><input type="radio" name="answer" value="ansb" >';
        input += '<p class="noselect">'+' '+ arrayQuestions.message[questionCounter].ansb + '</p></label>';
        item.append(input);
        questionData.append(item);

        item = $('<li>');
        input = '<label><input type="radio" name="answer" value="ansc" >';
        input += '<p class="noselect">'+' '+ arrayQuestions.message[questionCounter].ansc + '</p></label>';
        item.append(input);
        questionData.append(item);

        item = $('<li>');
        input = '<label><input type="radio" name="answer" value="ansd" >';
        input += '<p class="noselect">'+' '+ arrayQuestions.message[questionCounter].ansd + '</p></label>';
        item.append(input);
        questionData.append(item);

      return questionData;
    };

    
    function viewResult(text) {

        var numCorrect = 0;
        for (var i = 0; i < select.length; i++) {
          if (select[i] == arrayQuestions.message[i].odp) {
            numCorrect++;
            
          }
        }
  
        if(text == null)
          $('#rodzic').html('<div class="alert alert-info"><center >You got <b>' + numCorrect + '</b> correct answers from <b>' + arrayQuestions.message.length + '</b> questions! </center></div>');
        else
            $('#rodzic').html('<div class="alert alert-danger"><center>' + text + '</center>');

        var type = "updateResultQuizForUser";
        var posting = $.post("api/api.php", {
            type: type,
            email: email,
            category: category,
            result: numCorrect +' of '+ arrayQuestions.message.length 
        });

        posting.done(function(data) {
            console.log(data);
        });
    };
});;