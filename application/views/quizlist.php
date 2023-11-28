<title>Quiz:: Select Subject</title>
<link href="<?php echo base_url(); ?>themes/css/bootstrap.min.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>themes/css/dataTables.bootstrap.min.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>themes/css/responsive.bootstrap.min.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>themes/css/fronted.css" rel="stylesheet">
<script src="<?php echo base_url(); ?>themes/js/jquery-1.12.0.min.js"></script>


<div class="row">
    <div class="header container">
       <div class="col-md-12">
        <div class="col-sm-3">
            <h1><span>Quiz</span> System</h1>   
        </div>
        <div class="col-sm-12">
            <nav>
                <ul>
                    <li><a href="<?php echo base_url(); ?>">My Account</a></li>
                    <li><a href="<?php echo base_url(); ?>quiz">Quiz</a></li>
                    <li><a href="<?php echo base_url(); ?>index/logout">Logout</a></li>                
                </ul>
            </nav>
        </div>
       </div>    
    </div>   
</div>
<div class="row">
    <div class="container">
        <div class="col-md-12">
        <div class="col-md-12">            
        <?php if(isset($quiz)) { ?>
             <div class="quizContainer">
                           
                <div class="question"></div>
                    <ul class="choiceList"></ul> 
                    <button class="btn nextButton">Next Question</button>
                    <div class="quizMessage"></div>
                    <br>
            </div>
            <div class="result"></div>
            
        <?php  } ?> 
          </div>
         </div>   
     </div>   
 </div>   
<script>
/**
 * Created with JetBrains WebStorm.
 * User: pwanwu
 * Date: 18/09/2013
 * Time: 17:41
 * To change this template use File | Settings | File Templates.
 */

var questions = <?php echo $quiz; ?>;

var currentQuestion = 0;
var correctAnswers = 0;
var quizOver = false;

$(document).ready(function () {

    // Display the first question
    displayCurrentQuestion();
    $(this).find(".quizMessage").hide();

    // On clicking next, display the next question
    $(this).find(".nextButton").on("click", function () {
        if (!quizOver) {

            value = $("input[type='radio']:checked").val();

            if (value == undefined) {
                $(document).find(".quizMessage").text("Please select an answer");
                $(document).find(".quizMessage").show();
            } else {
                // TODO: Remove any message -> not sure if this is efficient to call this each time....
                $(document).find(".quizMessage").hide();

                if (value == questions[currentQuestion].correctAnswer) {
                    correctAnswers++;
                }

                currentQuestion++; // Since we have already displayed the first question on DOM ready
                if (currentQuestion < questions.length) {
                    displayCurrentQuestion();
                } else {
                    displayScore();
                    //                    $(document).find(".nextButton").toggle();
                    //                    $(document).find(".playAgainButton").toggle();
                    // Change the text in the next button to ask if user wants to play again
                    $(document).find(".nextButton").text("Play Again?");
                    quizOver = true;
                }
            }
        } else { // quiz is over and clicked the next button (which now displays 'Play Again?'
            quizOver = false;
            $(document).find(".nextButton").text("Next Question");
            resetQuiz();
            displayCurrentQuestion();
            hideScore();
        }
    });

});

// This displays the current question AND the choices
function displayCurrentQuestion() {

    console.log("In display current Question");

    var question = questions[currentQuestion].question;
    var questionClass = $(document).find(".quizContainer > .question");
    var choiceList = $(document).find(".quizContainer > .choiceList");
    var numChoices = questions[currentQuestion].choices.length;

    // Set the questionClass text to the current question
    $(questionClass).text(question);

    // Remove all current <li> elements (if any)
    $(choiceList).find("li").remove();

    var choice;
    for (i = 0; i < numChoices; i++) {
        choice = questions[currentQuestion].choices[i];
        $('<li><input type="radio" value=' + i + ' name="dynradio" />' + choice + '</li>').appendTo(choiceList);
    }
}

function resetQuiz() {
    currentQuestion = 0;
    correctAnswers = 0;
    hideScore();
}

function displayScore() {
    $(document).find(".result").text("You scored: " + correctAnswers + " out of: " + questions.length);
    $(document).find(".result").show();
    $(document).find(".quizContainer").hide();
    
}

function hideScore() {
    $(document).find(".result").hide();
}
</script>

