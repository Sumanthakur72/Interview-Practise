<?php include '../includes/sidebar.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HTML Form Quiz</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');

        body {
            font-family: 'Inter', sans-serif;
        }

        /* Hide the default radio button */
        input[type="radio"] {
            position: absolute;
            opacity: 0;
            width: 0;
            height: 0;
        }

        /* Custom radio button styling */
        .option-label::before {
            content: '';
            display: inline-block;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            border: 2px solid #9ca3af;
            margin-right: 1rem;
            flex-shrink: 0;
            transition: all 0.2s;
        }

        input[type="radio"]:checked+.option-label::before {
            background-color: #3b82f6;
            border-color: #3b82f6;
            transform: scale(1.1);
        }

        /* Highlight the entire selected option */
        input[type="radio"]:checked+.option-label {
            background-color: #e0f2fe;
            border-color: #3b82f6;
        }
    </style>
</head>

<body class="bg-[#f0f4f8] text-gray-800">
    <main id="mainContent" class="main-content flex-1 min-h-screen flex items-center justify-center">
        <!-- Main Quiz Container -->
        <div id="app"
            class="max-w-3xl bg-white p-8 rounded-3xl shadow-2xl w-full text-center flex flex-col items-center">
            <!-- Main title and description -->
            <h1 id="main-title" class="text-3xl font-bold text-gray-800 mb-2">Form Quiz</h1>
            <p class="text-gray-600 mb-8">Test your knowledge with these fundamental and advanced level questions.</p>

            <!-- Quiz Content Card -->
            <div id="quiz-card" class="w-full bg-white p-8 rounded-2xl shadow-lg border border-gray-200">
                <!-- Question section -->
                <div class="mb-8 text-left">
                    <h2 id="question-text" class="text-xl font-bold text-gray-800 mb-2"></h2>
                    <p id="question-description" class="text-gray-600 mb-6"></p>
                    <div id="options-container" class="bg-gray-100 rounded-2xl">
                        <!-- Options will be dynamically inserted here -->
                    </div>
                </div>

                <!-- Next Button -->
                <button id="next-button"
                    class="w-full md:w-auto text-white font-semibold py-3 px-12 rounded-full shadow-lg bg-gradient-to-r from-indigo-600 to-indigo-500 hover:from-indigo-700 hover:to-indigo-600 transition-all duration-300 focus:outline-none focus:ring-4 focus:ring-indigo-500 focus:ring-opacity-50">
                    Next
                </button>
            </div>

            <!-- Results Screen -->
            <div id="results-screen" class="hidden text-center mt-8 w-full">
                <h2 class="text-3xl font-bold text-indigo-600 mb-4">Quiz Complete!</h2>
                <p id="score-text" class="text-xl text-gray-700 mb-6">Your score is: 0 out of 0</p>
                <div class="flex flex-col md:flex-row justify-center space-y-4 md:space-y-0 md:space-x-4">
                    <p class="text-lg font-semibold text-green-600">Correct: <span id="correct-count">0</span></p>
                    <p class="text-lg font-semibold text-red-600">Incorrect: <span id="incorrect-count">0</span></p>
                    <p class="text-lg font-semibold text-gray-600">Unanswered: <span id="unanswered-count">0</span></p>
                </div>
                <div class="flex flex-col md:flex-row justify-center space-y-4 md:space-y-0 md:space-x-4 mt-8">
                    <button id="view-detailed-button"
                        class="w-full md:w-auto text-white font-semibold py-3 px-12 rounded-full shadow-lg bg-gradient-to-r from-indigo-600 to-indigo-500 hover:from-indigo-700 hover:to-indigo-600 transition-all duration-300 focus:outline-none focus:ring-4 focus:ring-indigo-500 focus:ring-opacity-50">
                        View Detailed Answers
                    </button>
                    <button id="restart-button"
                        class="w-full md:w-auto text-white font-semibold py-3 px-12 rounded-full shadow-lg bg-gradient-to-r from-indigo-600 to-indigo-500 hover:from-indigo-700 hover:to-indigo-600 transition-all duration-300 focus:outline-none focus:ring-4 focus:ring-indigo-500 focus:ring-opacity-50">
                        Restart
                    </button>
                </div>
            </div>

            <!-- Detailed Results Screen -->
            <div id="detailed-results-screen"
                class="hidden mt-8 w-full bg-white p-8 rounded-2xl shadow-lg border border-gray-200 text-left">
                <h2 id="detailed-results-title" class="text-3xl font-bold text-indigo-600 mb-6 text-center">Detailed
                    Answers</h2>
                <div id="answers-container" class="space-y-6">
                    <!-- Detailed results will be dynamically inserted here -->
                </div>
                <button id="go-back-button"
                    class="w-full md:w-auto text-white font-semibold py-3 px-12 rounded-full shadow-lg bg-gradient-to-r from-indigo-600 to-indigo-500 hover:from-indigo-700 hover:to-indigo-600 transition-all duration-300 focus:outline-none focus:ring-4 focus:ring-indigo-500 focus:ring-opacity-50 mt-8 mx-auto block">
                    Go Back
                </button>
            </div>
        </div>
    </main>
    <script>
        const quizData = [
            {
                "question": "Which HTML tag is used to create a form?",
                "options": ["<form>", "<input>", "<button>", "<p>"],
                "answer": "<form>",
                "description": "This tag is used to create an HTML form."
            },
            {
                "question": "Which input type creates a text box for passwords?",
                "options": ["text", "password", "hidden", "email"],
                "answer": "password",
                "description": "This input type creates a password text box."
            },
            {
                "question": "What is the purpose of the `method` attribute in the `<form>` tag?",
                "options": ["To define the HTTP method (GET or POST).", "To specify the action URL.", "To validate the form.", "To name the form."],
                "answer": "To define the HTTP method (GET or POST).",
                "description": "This attribute is for defining the HTTP method."
            },
            {
                "question": "Which input type is used for a checkbox?",
                "options": ["radio", "checkbox", "select", "toggle"],
                "answer": "checkbox",
                "description": "This input type creates a checkbox."
            },
            {
                "question": "How do you define a list of options for a dropdown list in a form?",
                "options": ["<list>", "<select>", "<ul>", "<options>"],
                "answer": "<select>",
                "description": "This tag is used for a dropdown list."
            },
            {
                "question": "Which attribute specifies the URL to send the form-data to?",
                "options": ["href", "link", "action", "src"],
                "answer": "action",
                "description": "The `action` attribute specifies where to send the form data."
            },
            {
                "question": "What is the default HTTP method for a form submission?",
                "options": ["POST", "GET", "PUT", "DELETE"],
                "answer": "GET",
                "description": "The default HTTP method for a form is GET."
            },
            {
                "question": "Which HTML5 input type is used for a field that should contain an e-mail address?",
                "options": ["url", "tel", "email", "text"],
                "answer": "email",
                "description": "The `email` input type is used for email addresses and performs basic validation."
            },
            {
                "question": "Which attribute specifies that an input field is required?",
                "options": ["required", "validate", "must", "necessary"],
                "answer": "required",
                "description": "The `required` attribute specifies that the input must be filled out before submitting the form."
            },
            {
                "question": "Which tag is used to group related elements in a form?",
                "options": ["<group>", "<section>", "<fieldset>", "<formset>"],
                "answer": "<fieldset>",
                "description": "The `<fieldset>` tag is used to group related elements in a form."
            },
            {
                "question": "Which input type allows the user to select a file?",
                "options": ["text", "file", "upload", "submit"],
                "answer": "file",
                "description": "The `file` input type allows the user to select one or more files to be submitted with the form."
            },
            {
                "question": "Which element is used to create a multi-line text input control?",
                "options": ["<input type='textarea'>", "<textarea>", "<text>", "<textinput>"],
                "answer": "<textarea>",
                "description": "The `<textarea>` element is used to create a multi-line text input field."
            },
            {
                "question": "What is the purpose of the `for` attribute in a `<label>` tag?",
                "options": ["To link a label to a specific form element.", "To define a group of labels.", "To specify the style for the label.", "To define the text of the label."],
                "answer": "To link a label to a specific form element.",
                "description": "The `for` attribute links a label to an input element using its ID."
            },
            {
                "question": "Which attribute specifies a short hint that describes the expected value of an input field?",
                "options": ["title", "label", "placeholder", "hint"],
                "answer": "placeholder",
                "description": "The `placeholder` attribute provides a hint to the user about what to enter."
            },
            {
                "question": "What is the correct way to specify the maximum number of characters allowed in a text field?",
                "options": ["max-chars", "length", "maxlength", "maxsize"],
                "answer": "maxlength",
                "description": "The `maxlength` attribute specifies the maximum number of characters allowed in a text input field."
            },
            {
                "question": "Which input type is used for a field that should contain a telephone number?",
                "options": ["tel", "phone", "number", "text"],
                "answer": "tel",
                "description": "The `tel` input type is for telephone numbers."
            },
            {
                "question": "Which tag is used to create a list of pre-defined options for an input element?",
                "options": ["<datalist>", "<option>", "<select>", "<inputlist>"],
                "answer": "<datalist>",
                "description": "The `<datalist>` tag provides a list of pre-defined options for a text input field."
            },
            {
                "question": "Which attribute specifies that the user cannot modify the value of an input field?",
                "options": ["readonly", "disabled", "unmodifiable", "fixed"],
                "answer": "readonly",
                "description": "The `readonly` attribute makes an input field read-only, meaning its value cannot be changed."
            },
            {
                "question": "Which input type creates a clickable button for a form submission?",
                "options": ["button", "submit", "click", "formbutton"],
                "answer": "submit",
                "description": "The `submit` input type creates a button that submits the form data."
            },
            {
                "question": "What does the `enctype` attribute specify in a `<form>` tag?",
                "options": ["The form's encoding type.", "The encryption type.", "The content type of the data when submitting.", "The form's engine type."],
                "answer": "The content type of the data when submitting.",
                "description": "The `enctype` attribute specifies how the form data should be encoded."
            },
            {
                "question": "What is the purpose of the `name` attribute in an input element?",
                "options": ["To uniquely identify the input element.", "To give the input element a name.", "To specify the name of the form data.", "To style the input element."],
                "answer": "To specify the name of the form data.",
                "description": "The `name` attribute is used to reference the form data after it has been submitted."
            },
            {
                "question": "Which input type is used for a slider control?",
                "options": ["slider", "range", "track", "scale"],
                "answer": "range",
                "description": "The `range` input type is used to create a slider control."
            },
            {
                "question": "Which tag defines an option in a dropdown list?",
                "options": ["<option>", "<list>", "<select>", "<item>"],
                "answer": "<option>",
                "description": "The `<option>` tag defines a single option within a `<select>` dropdown list."
            },
            {
                "question": "How do you specify a default value for a text input field?",
                "options": ["initial-value", "default", "value", "pre-filled"],
                "answer": "value",
                "description": "The `value` attribute can be used to set a default value for an input field."
            },
            {
                "question": "What does the `autofocus` attribute do?",
                "options": ["It automatically submits the form.", "It automatically focuses the input field when the page loads.", "It validates the form automatically.", "It automatically fills the form."],
                "answer": "It automatically focuses the input field when the page loads.",
                "description": "The `autofocus` attribute specifies that an input field should automatically get focus when the page loads."
            },
            {
                "question": "Which input type is used for a field to select a date?",
                "options": ["time", "date", "calendar", "datetime"],
                "answer": "date",
                "description": "The `date` input type creates a field for entering a date."
            },
            {
                "question": "What is the difference between a radio button and a checkbox?",
                "options": ["Radio buttons allow multiple selections, checkboxes do not.", "Checkboxes allow a single selection, radio buttons do not.", "Radio buttons allow a single selection, checkboxes allow multiple selections.", "They are the same, just a different style."],
                "answer": "Radio buttons allow a single selection, checkboxes allow multiple selections.",
                "description": "Radio buttons are for selecting one option from a set, while checkboxes allow selecting one or more options."
            },
            {
                "question": "What does the `<output>` tag do?",
                "options": ["Defines a label for an input.", "Defines the result of a calculation.", "Defines a text field.", "Defines a form."],
                "answer": "Defines the result of a calculation.",
                "description": "The `<output>` tag is used to display the result of a calculation."
            },
            {
                "question": "Which attribute is used to specify a regular expression for form validation?",
                "options": ["regex", "validate", "pattern", "expression"],
                "answer": "pattern",
                "description": "The `pattern` attribute specifies a regular expression that the input value must match."
            },
            {
                "question": "How do you reset a form to its initial values?",
                "options": ["<input type='reset'>", "<input type='clear'>", "<button type='reset'>", "<button type='clear'>"],
                "answer": "<button type='reset'>",
                "description": "The `<button type='reset'>` will reset all form controls to their initial values."
            }
        ];

        let currentQuestionIndex = 0;
        let score = 0;
        let selectedOption = null;
        let userAnswers = []; // Array to store user's answers

        const quizCard = document.getElementById('quiz-card');
        const resultsScreen = document.getElementById('results-screen');
        const detailedResultsScreen = document.getElementById('detailed-results-screen');
        const questionText = document.getElementById('question-text');
        const questionDescription = document.getElementById('question-description');
        const optionsContainer = document.getElementById('options-container');
        const nextButton = document.getElementById('next-button');
        const restartButton = document.getElementById('restart-button');
        const viewDetailedButton = document.getElementById('view-detailed-button');
        const goBackButton = document.getElementById('go-back-button');
        const scoreText = document.getElementById('score-text');
        const mainTitle = document.getElementById('main-title');
        const answersContainer = document.getElementById('answers-container');
        const correctCount = document.getElementById('correct-count');
        const incorrectCount = document.getElementById('incorrect-count');
        const unansweredCount = document.getElementById('unanswered-count');

        function loadQuestion() {
            nextButton.disabled = false;
            nextButton.classList.remove('disabled:opacity-50', 'disabled:cursor-not-allowed');
            nextButton.textContent = "Next";

            if (currentQuestionIndex < quizData.length) {
                const currentQuestion = quizData[currentQuestionIndex];
                questionText.textContent = `Question ${currentQuestionIndex + 1} of ${quizData.length}`;
                questionDescription.textContent = currentQuestion.question;

                optionsContainer.innerHTML = '';
                currentQuestion.options.forEach((option, index) => {
                    const optionId = `option-${index}`;
                    const input = document.createElement('input');
                    input.type = 'radio';
                    input.name = 'quiz-option';
                    input.id = optionId;
                    input.value = option;

                    const label = document.createElement('label');
                    label.htmlFor = optionId;
                    label.textContent = option;
                    label.className = 'option-label flex items-center p-4 rounded-2xl  text-lg font-medium cursor-pointer transition-all duration-200 hover:bg-gray-200';

                    const div = document.createElement('div');
                    div.className = 'relative';
                    div.appendChild(input);
                    div.appendChild(label);
                    optionsContainer.appendChild(div);

                    input.addEventListener('change', () => selectOption(option));
                });
            } else {
                showResults();
            }
        }

        function selectOption(option) {
            selectedOption = option;
        }

        function nextQuestion() {
            const currentQuestion = quizData[currentQuestionIndex];
            userAnswers[currentQuestionIndex] = selectedOption;

            if (selectedOption !== null && selectedOption === currentQuestion.answer) {
                score++;
            }

            currentQuestionIndex++;
            selectedOption = null;

            if (currentQuestionIndex < quizData.length) {
                loadQuestion();
            } else {
                showResults();
            }
        }

        function showResults() {
            quizCard.classList.add('hidden');
            resultsScreen.classList.remove('hidden');
            scoreText.textContent = `Your score is: ${score} out of ${quizData.length}`;
            mainTitle.textContent = "Quiz Results";

            const correct = userAnswers.filter((ans, i) => ans === quizData[i].answer).length;
            const incorrect = userAnswers.filter((ans, i) => ans !== quizData[i].answer && ans !== null && ans !== undefined).length;
            const unanswered = quizData.length - correct - incorrect;

            correctCount.textContent = correct;
            incorrectCount.textContent = incorrect;
            unansweredCount.textContent = unanswered;
        }

        function showDetailedAnswers() {
            resultsScreen.classList.add('hidden');
            detailedResultsScreen.classList.remove('hidden');
            answersContainer.innerHTML = '';

            quizData.forEach((question, index) => {
                const userAnswer = userAnswers[index];
                const isCorrect = userAnswer === question.answer;

                const questionDiv = document.createElement('div');
                questionDiv.className = 'p-4 rounded-xl border border-gray-300';

                const questionTitle = document.createElement('h3');
                questionTitle.className = 'text-lg font-bold text-gray-800 mb-2';
                questionTitle.textContent = `${index + 1}. ${question.question}`;

                const yourAnswerText = document.createElement('p');
                yourAnswerText.className = 'text-gray-600';
                yourAnswerText.innerHTML = `Your Answer: <span class="${isCorrect ? 'text-green-600' : (userAnswer === null || userAnswer === undefined ? 'text-gray-600' : 'text-red-600')} font-semibold">${userAnswer !== null && userAnswer !== undefined ? userAnswer : 'Not Answered'}</span>`;

                const correctAnswerText = document.createElement('p');
                correctAnswerText.className = 'text-gray-600 mt-1';
                correctAnswerText.innerHTML = `Correct Answer: <span class="text-green-600 font-semibold">${question.answer}</span>`;

                questionDiv.appendChild(questionTitle);
                questionDiv.appendChild(yourAnswerText);
                if (!isCorrect) {
                    questionDiv.appendChild(correctAnswerText);
                }

                answersContainer.appendChild(questionDiv);
            });
        }

        function restartQuiz() {
            currentQuestionIndex = 0;
            score = 0;
            selectedOption = null;
            userAnswers = [];
            resultsScreen.classList.add('hidden');
            detailedResultsScreen.classList.add('hidden');
            quizCard.classList.remove('hidden');
            mainTitle.textContent = "HTML Form Quiz";
            loadQuestion();
        }

        function goBackToResults() {
            detailedResultsScreen.classList.add('hidden');
            resultsScreen.classList.remove('hidden');
        }

        nextButton.addEventListener('click', nextQuestion);
        restartButton.addEventListener('click', restartQuiz);
        viewDetailedButton.addEventListener('click', showDetailedAnswers);
        goBackButton.addEventListener('click', goBackToResults);

        window.onload = loadQuestion;
    </script>
</body>

</html>