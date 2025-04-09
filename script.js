$(document).ready(function () {
  const state = {
    questions: [],
    currentQuestionIndex: 0,
    score: 0,
    answerSelected: false
  };

  function fetchQuestions() {
    $.getJSON('questions.php', function (data) {
      state.questions = data;
      $('#start-screen').show();
    });
  }

  function showQuestion() {
    const current = state.questions[state.currentQuestionIndex];
    $('#question').text(current.question);
    $('#answers').empty();
    $('#feedback').hide().text('');
    $('#next-btn').hide();
    $('#question-container').show();

    current.answers.forEach(ans => {
      const btn = $('<button>')
        .addClass('w-full text-left p-2 pl-4 rounded bg-gray-700 hover:bg-gray-900')
        .text(ans.text)
        .data('correct', ans.correct == 1)
        .on('click', handleAnswer);
      $('#answers').append(btn);
    });

    $('#progress-text').text(`Question ${state.currentQuestionIndex + 1} of ${state.questions.length}`);
    $('#score-display').text(`Score: ${state.score}`);
  }

  function handleAnswer() {
    if (state.answerSelected) return;
    state.answerSelected = true;

    const correct = $(this).data('correct');
    if (correct) {
      $(this).addClass('bg-green-600 text-white hover:bg-green-800');
      state.score++;
      $('#feedback').text("Correct!").removeClass().addClass('mt-4 text-green-400').show();
    } else {
      $(this).addClass('bg-red-600 text-white hover:bg-red-800');
      $('#feedback').text("Incorrect.").removeClass().addClass('mt-4 text-red-400').show();
    }

    $('#answers button').prop('disabled', true);
    if (state.currentQuestionIndex < state.questions.length - 1) {
      $('#next-btn').show();
    } else {
      setTimeout(endQuiz, 1000);
    }
  }

  function nextQuestion() {
    state.currentQuestionIndex++;
    state.answerSelected = false;
    showQuestion();
  }

  function endQuiz() {
    $('#question-container').hide();
    $('#final-score').text(`Score: ${state.score}/${state.questions.length}`);
    $('#final-message').text(state.score === state.questions.length ? "Perfect!" : "Good job!");
    $('#end-screen').show();
  }

  $('#start-btn').click(() => {
    $('#start-screen').hide();
    showQuestion();
  });

  $('#next-btn').click(nextQuestion);

  $('#restart-btn').click(() => {
    state.currentQuestionIndex = 0;
    state.score = 0;
    state.answerSelected = false;
    $('#end-screen').hide();
    showQuestion();
  });

  fetchQuestions();
});
