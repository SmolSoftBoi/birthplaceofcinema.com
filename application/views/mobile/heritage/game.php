<form>

	<!-- Play button -->
	<a href="#" id="play" class="ui-btn">Play Game</a>

	<!-- Question 1 -->
	<div class="question" data-question="1">
		<p>Who was one of the earliest visitors of photographic studio?</p>
		<label><input type="radio" name="question[1]" value="David Beckham">David Beckham</label>
		<label><input type="radio" name="question[1]" value="Charles Dickens">Charles Dickens</label>
		<label><input type="radio" name="question[1]" value="Nelson Mandela">Nelson Mandela</label>
	</div>
	<!-- / Question 1 -->

	<!-- Question 2 -->
	<div class="question" data-question="2">
		<p>What was the cinema most famous for at the beginning?</p>
		<label><input type="radio" name="question[2]" value="Shakespear Plays">Shakespeare Plays</label>
		<label><input type="radio" name="question[2]" value="Opera">Opera</label>
		<label><input type="radio" name="question[2]" value="Magic Lantern Show">Magic Lantern Show</label>
	</div>
	<!-- / Question 2 -->

	<!-- Question 3 -->
	<div class="question" data-question="3">
		<p>What was the cinema renamed as?</p>
		<label><input type="radio" name="question[3]" value="Regent Street Polytechnic">Regent Street Polytechnic</label>
		<label><input type="radio" name="question[3]" value="Regents Street Cinema">Regents Street Cinema</label>
		<label><input type="radio" name="question[3]" value="Palace Theatre">Palace Theatre</label>
	</div>
	<!-- / Question 3 -->

	<!-- Question 4 -->
	<div class="question" data-question="4">
		<p>When were moving images first aired at the cinema?</p>
		<label><input type="radio" name="question[4]" value="30 March 1880">30 March 1880</label>
		<label><input type="radio" name="question[4]" value="21 March 1896">21 March 1896</label>
		<label><input type="radio" name="question[4]" value="10 March 1896">10 March 1896</label>
	</div>
	<!-- / Question 4 -->

	<!-- Question 5 -->
	<div class="question" data-question="5">
		<p>What colour were the interior walls painted in 1926?</p>
		<label><input type="radio" name="question[5]" value="Yellow">Yellow</label>
		<label><input type="radio" name="question[5]" value="White">White</label>
		<label><input type="radio" name="question[5]" value="Blue">Blue</label>
	</div>
	<!-- / Question 5 -->

	<!-- Question 6 -->
	<div class="question" data-question="6">
		<p>Is the Compton Organ in fully working order currently?</p>
		<label><input type="radio" name="question[6]" value="Yes">Yes</label>
		<label><input type="radio" name="question[6]" value="No">No</label>
		<label><input type="radio" name="question[6]" value="Under Maintenance">Under Maintenance</label>
	</div>
	<!-- / Question 6 -->

	<!-- Question 7 -->
	<div class="question" data-question="7">
		<p>Which year did the cinema close?</p>
		<label><input type="radio" name="question[7]" value="1980">1980</label>
		<label><input type="radio" name="question[7]" value="1970">1970</label>
		<label><input type="radio" name="question[7]" value="1975">1975</label>
	</div>
	<!-- / Question 7 -->

	<!-- Question 8 -->
	<div class="question" data-question="8">
		<p>When was the green light given for the cinema restoration?</p>
		<label><input type="radio" name="question[8]" value="21 March">21 March</label>
		<label><input type="radio" name="question[8]" value="30 March">30 March</label>
		<label><input type="radio" name="question[8]" value="20 March">20 March</label>
	</div>
	<!-- / Question 8 -->

	<!-- Question 9 -->
	<div class="question" data-question="9">
		<p>When was the name 'University of Westminster' established?</p>
		<label><input type="radio" name="question[9]" value="1990">1990</label>
		<label><input type="radio" name="question[9]" value="1992">1992</label>
		<label><input type="radio" name="question[9]" value="1987">1987</label>
	</div>
	<!-- / Question 9 -->

	<!-- Question 10 -->
	<div class="question" data-question="10">
		<p>How much did the Quintin Hogg trust domate towards the campaign run by the University?</p>
		<label><input type="radio" name="question[10]" value="50,000">&pound;50,000</label>
		<label><input type="radio" name="question[10]" value="2 million">&pound;2 million</label>
		<label><input type="radio" name="question[10]" value="1 million">&pound;1 million</label>
	</div>
	<!-- / Question 10 -->

	<!-- Continue button -->
	<a href="#" id="continue" class="ui-btn">Continue</a>

	<!-- Score -->
	<div id="score">
		<h2>Score:<br><span class="score">0</span></h2></h2>
	</div>
	<!-- / Score -->

</form>

<script>
	/**
	 * 1
	 * 
	 * Hide the questions, continue button and score.
	 */
	$('.question').each(function() {
		$(this).hide();
	});
	$('#continue').hide();
	$('#score').hide();

	/**
	 * 2
	 * 
	 * Question numbers and answers, and total and remaining questions.
	 */
	var questionsAnswers = [
		{
			questionID: 1,
			answer: "Charles Dickens"
		},
		{
			questionID: 2,
			answer: "Magic Lantern Show"
		},
		{
			questionID: 3,
			answer: "Regents Street Polytechnic"
		},
		{
			questionID: 4,
			answer: "21 March 1896"
		},
		{
			questionID: 5,
			answer: "White"
		},
		{
			questionID: 6,
			answer: "Yes"
		},
		{
			questionID: 7,
			answer: "1980"
		},
		{
			questionID: 8,
			answer: "21 March"
		},
		{
			questionID: 9,
			answer: "1992"
		},
		{
			questionID: 10,
			answer: "1 million"
		}
	];
	var totalQuestions = questionsAnswers.length;
	var remainingQuestions = questionsAnswers;

	/**
	 * 3
	 * 
	 * Score
	 */
	var score = 0;

	/**
	 * 4
	 * 
	 * Random Number
	 */
	function random(minimum, maximum) {
		return Math.floor((Math.random() * maximum) + minimum);
	}

	/**
	 * 5
	 * 
	 * Calculate Score
	 * 
	 * Resets the score, gets the form, loops the questions, and checks if the answers are correct.
	 */
	function calculateScore() {
		var query;

		score = 0;

		var answers = $('form').serializeArray();

		for (var i = 0; i < totalQuestions; i++) {
			var question = questionsAnswers[i];
			var answer = $.grep(answers, function(a) {
				return a.name === 'question[' + question.questionID + ']';
			})[0];

			if (question.answer === answer.value) {
				score++;
				query = $.ajax({
					url: '/api/game/set',
					data: {
						question_id: question.questionID
					}
				});
			}
		}
	}

	/**
	 * 6
	 * 
	 * Next Question
	 * 
	 * Hides the questions and continue button, and checks if there are any remaining questions.
	 * If there are any remaining questions; show the next question, and remove the question from the remaining questions,
	 * otherwise calculate and show the score.
	 */
	function advanceQuestion() {
		$('.question').each(function() {
			$(this).hide();
		});
		$('#continue').hide();

		if (remainingQuestions.length > 0) {
			var question = remainingQuestions[random(0, remainingQuestions.length)].questionID;

			$('.question[data-question="' + question + '"]').show();
			// Show the question if an answer is selected
			$('.question[data-question="' + question + '"] input').each(function() {
				$(this).change(function() {
					$('#continue').show();
				});
			});

			remainingQuestions = $.grep(remainingQuestions, function(a) {
				return a.questionID !== question;
			});
		} else {
			calculateScore();
			$('#score span').text(score);
			$('#score').show();
		}
	}

	/**
	 * 7
	 * 
	 * Hide play button, show continue button and go to next question if play button is clicked.
	 */
	$('#play').click(function() {
		$(this).hide();
		$('#continue').show();
		advanceQuestion();
	});

	/**
	 * 8
	 * 
	 * Go to next question if continue button is clicked.
	 */
	$('#continue').click(function() {
		advanceQuestion();
	});
</script>