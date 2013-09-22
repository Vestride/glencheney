function displayQuestion(what) {
    var value = what.nextSibling.nextSibling.value;
    var question = what.nextSibling.nextSibling.nextSibling.nextSibling.value;
    var answer = what.nextSibling.nextSibling.nextSibling.nextSibling.nextSibling.nextSibling.value;
    var i = what.nextSibling.nextSibling.nextSibling.nextSibling.nextSibling.nextSibling.nextSibling.nextSibling.value;
    var j = what.nextSibling.nextSibling.nextSibling.nextSibling.nextSibling.nextSibling.nextSibling.nextSibling.nextSibling.nextSibling.value;

    //Hide the answer
    $("#popup p.box_answer").hide();
    //Show the show answer button
    $('button.answerButton').show();
    //Hide the submit buttons
    $('input[name=correct], input[name=incorrect]').hide();
    //Populate fields
    $('#popup p.box_question').html(question);
    $('#popup p.box_answer').html(answer);
    $('#popup input[name=points]').val(value);
    $('#popup input[name=i]').val(i);
    $('#popup input[name=j]').val(j);
    $('#popup').fadeIn();
}

function showAnswer() {
    $("#popup p.box_answer").fadeIn();
    $('button.answerButton').hide();
    $('input[name=correct], input[name=incorrect]').show();
}

function closeQuestion() {
    $('#popup').fadeOut();
}

function showFinalQuestion() {
    var question = $('input.finalQuestion').val();
    var answer = $('input.finalAnswer').val();
    var max = parseInt($('#currentPoints').text());
    if(max > 0) {
        var bet = prompt("How much would you like to bet? You can bet up to " + max);
        var isNumeric = IsNumeric(bet);
        while(bet > max || isNumeric == false) {
            bet = prompt("Stop cheating, you can bet up to " + max);
            isNumeric = IsNumeric(bet);
        }
    }
    else {
        bet = 0;
    }
    //Hide the answer
    $("#popup p.box_answer").hide();
    //Show the show answer button
    $('button.answerButton').show();
    //Hide the submit buttons
    $('input[name=correct], input[name=incorrect]').hide();
    //Populate fields
    $('#popup p.box_question').html(question);
    $('#popup p.box_answer').html(answer);
    $('#popup form').append('<input type="hidden" name="finalBet" value="'+bet+'">');
    $('#popup').fadeIn();
}

//From http://stackoverflow.com/questions/18082/validate-numbers-in-javascript-isnumeric
function IsNumeric(input) {
   return (input - 0) == input && input.length > 0;
}