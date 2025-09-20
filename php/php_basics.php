<?php include '../includes/sidebar.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Quiz</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-100">
 <main id="mainContent" class="main-content flex-1 min-h-screen flex items-center justify-center">
<div class="bg-white rounded-3xl shadow-xl p-8 md:p-10 max-w-2xl w-full">
    <!-- Quiz Header -->
    <div id="quiz-header" class="text-center mb-8">
        <h1 class="text-3xl md:text-4xl font-extrabold text-gray-800 tracking-tight">PHP Basics Quiz</h1>
        <p class="text-gray-600 mt-2 text-lg">Test your knowledge with these beginner and advanced level questions.</p>
    </div>

    <!-- Quiz Screen -->
    <div id="quiz-screen">
        <p id="question-text" class="text-xl md:text-2xl font-bold text-gray-800 mb-6"></p>
        <form id="options-form">
            <!-- Radio buttons will be inserted here by JavaScript -->
        </form>
        <div class="flex justify-center items-center mt-8">
            <button id="next-btn" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-8 rounded-full shadow-lg transition-all duration-300 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">Next</button>
        </div>
    </div>

    <!-- Result Screen -->
    <div id="result-screen" class="hidden text-center">
        <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-2">Quiz Results</h2>
        <p class="text-gray-600 text-lg mb-8">You answered <span id="answered-count" class="font-bold">0</span> questions out of 30.</p>
        <div class="flex flex-row justify-center space-x-8 mb-10">
            <div class="flex flex-col items-center">
                <span id="correct-count" class="text-green-500 text-4xl md:text-5xl font-extrabold">0</span>
                <span class="text-gray-600 text-sm md:text-base font-medium">Correct</span>
            </div>
            <div class="flex flex-col items-center">
                <span id="incorrect-count" class="text-red-500 text-4xl md:text-5xl font-extrabold">0</span>
                <span class="text-gray-600 text-sm md:text-base font-medium">Incorrect</span>
            </div>
            <div class="flex flex-col items-center">
                <span id="skipped-count" class="text-gray-500 text-4xl md:text-5xl font-extrabold">0</span>
                <span class="text-gray-600 text-sm md:text-base font-medium">Unanswered</span>
            </div>
        </div>
        <div class="flex flex-col md:flex-row justify-center space-y-4 md:space-y-0 md:space-x-4">
            <button id="review-btn" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-8 rounded-full shadow-lg transition-all duration-300 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">View Detailed Answers</button>
            <button id="restart-btn" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-3 px-8 rounded-full shadow-lg transition-all duration-300 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-opacity-50">Try Again</button>
        </div>
    </div>
    
    <!-- Review Screen -->
    <div id="review-screen" class="hidden">
        <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">Review Answers</h2>
        <div id="review-list" class="space-y-4">
            <!-- Review items will be inserted here -->
        </div>
        <div class="text-center mt-6">
             <button id="back-btn" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-3 px-8 rounded-full shadow-lg transition-all duration-300 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-opacity-50">Back to Results</button>
        </div>
    </div>
</div>
</main>
<script>
    const quizData = [
        { "question": "What does PHP stand for?", "answerOptions": [ { "text": "Personal Home Page", "isCorrect": false }, { "text": "Hypertext Preprocessor", "isCorrect": true }, { "text": "Programmer's Helper", "isCorrect": false }, { "text": "PHP Hypertext Processor", "isCorrect": false } ] },
       {"question": "Which symbol is used to start a variable in PHP?",
        "answerOptions": [ { "text": "$", "isCorrect": true }, { "text": "#", "isCorrect": false }, { "text": "&", "isCorrect": false }, { "text": "%", "isCorrect": false } ]},
        { "question": "How do you print a string in PHP?", "answerOptions": [ { "text": "print()", "isCorrect": false }, { "text": "echo", "isCorrect": false }, { "text": "Both print() and echo", "isCorrect": true }, { "text": "display()", "isCorrect": false } ] },
        { "question": "Which symbol is used for a variable in PHP?", "answerOptions": [ { "text": "#", "isCorrect": false }, { "text": "$", "isCorrect": true }, { "text": "@", "isCorrect": false }, { "text": "%", "isCorrect": false } ] },
        { "question": "What is the correct way to add a single-line comment in PHP?", "answerOptions": [ { "text": "// This is a comment", "isCorrect": true }, { "text": "/* This is a comment */", "isCorrect": false }, { "text": "<!-- This is a comment -->", "isCorrect": false }, { "text": "# This is a comment", "isCorrect": false } ] },
        { "question": "How do you declare an array in PHP?", "answerOptions": [ { "text": "$cars = array('Volvo', 'BMW', 'Toyota');", "isCorrect": true }, { "text": "$cars = {'Volvo', 'BMW', 'Toyota'};", "isCorrect": false }, { "text": "$cars = ('Volvo', 'BMW', 'Toyota');", "isCorrect": false }, { "text": "$cars = ['Volvo', 'BMW', 'Toyota'];", "isCorrect": false } ] },
        { "question": "What is the `$_GET` superglobal variable used for?", "answerOptions": [ { "text": "To collect form data submitted with the HTTP GET method.", "isCorrect": true }, { "text": "To collect form data submitted with the HTTP POST method.", "isCorrect": false }, { "text": "To store session data.", "isCorrect": false }, { "text": "To get a file from a URL.", "isCorrect": false } ] },
        { "question": "What is the `$_POST` superglobal variable used for?", "answerOptions": [ { "text": "To collect form data submitted with the HTTP GET method.", "isCorrect": false }, { "text": "To collect form data submitted with the HTTP POST method.", "isCorrect": true }, { "text": "To store server information.", "isCorrect": false }, { "text": "To post data to a database.", "isCorrect": false } ] },
        { "question": "How do you include an external file named 'header.php' into a PHP script?", "answerOptions": [ { "text": "include 'header.php';", "isCorrect": true }, { "text": "require 'header.php';", "isCorrect": false }, { "text": "Both include and require can be used.", "isCorrect": true }, { "text": "import 'header.php';", "isCorrect": false } ] },
        { "question": "Which function is used to open a file in PHP?", "answerOptions": [ { "text": "file_open()", "isCorrect": false }, { "text": "open_file()", "isCorrect": false }, { "text": "fopen()", "isCorrect": true }, { "text": "readfile()", "isCorrect": false } ] },
        { "question": "What is the difference between `==` and `===`?", "answerOptions": [ { "text": "`==` checks for value equality, while `===` checks for both value and type equality.", "isCorrect": true }, { "text": "`==` checks for value equality, while `===` checks for type equality only.", "isCorrect": false }, { "text": "`==` is for numbers, `===` is for strings.", "isCorrect": false }, { "text": "There is no difference.", "isCorrect": false } ] },
        { "question": "How do you create a function in PHP?", "answerOptions": [ { "text": "function myFunction() { ... }", "isCorrect": true }, { "text": "def myFunction():", "isCorrect": false }, { "text": "void myFunction() { ... }", "isCorrect": false }, { "text": "new function() { ... }", "isCorrect": false } ] },
        { "question": "What is the `$_SESSION` superglobal variable used for?", "answerOptions": [ { "text": "To store temporary user data on the server, across multiple pages.", "isCorrect": true }, { "text": "To store temporary user data on the client's browser.", "isCorrect": false }, { "text": "To store server configuration data.", "isCorrect": false }, { "text": "To handle URL parameters.", "isCorrect": false } ] },
        { "question": "How do you start a session in PHP?", "answerOptions": [ { "text": "session_start();", "isCorrect": true }, { "text": "start_session();", "isCorrect": false }, { "text": "session_create();", "isCorrect": false }, { "text": "start_session_var();", "isCorrect": false } ] },
        { "question": "What is `echo` used for?", "answerOptions": [ { "text": "To get user input.", "isCorrect": false }, { "text": "To print output to the browser.", "isCorrect": true }, { "text": "To define a variable.", "isCorrect": false }, { "text": "To include a file.", "isCorrect": false } ] },
        { "question": "How do you define a constant in PHP?", "answerOptions": [ { "text": "const MY_CONSTANT = 'value';", "isCorrect": true }, { "text": "define MY_CONSTANT = 'value';", "isCorrect": false }, { "text": "$MY_CONSTANT = 'value';", "isCorrect": false }, { "text": "final MY_CONSTANT = 'value';", "isCorrect": false } ] },
        { "question": "Which PHP function is used to connect to a MySQL database?", "answerOptions": [ { "text": "mysqli_connect()", "isCorrect": true }, { "text": "mysql_connect()", "isCorrect": false }, { "text": "connect_db()", "isCorrect": false }, { "text": "db_connect()", "isCorrect": false } ] },
        { "question": "What does the `include` statement return on failure?", "answerOptions": [ { "text": "It returns a fatal error.", "isCorrect": false }, { "text": "It returns a warning but continues execution.", "isCorrect": true }, { "text": "It returns a notice.", "isCorrect": false }, { "text": "It returns `false`.", "isCorrect": false } ] },
        { "question": "Which function is used to redirect a user to a different page?", "answerOptions": [ { "text": "header('Location: newpage.php');", "isCorrect": true }, { "text": "redirect('newpage.php');", "isCorrect": false }, { "text": "goto 'newpage.php';", "isCorrect": false }, { "text": "move_to('newpage.php');", "isCorrect": false } ] },
        { "question": "How do you get the length of a string in PHP?", "answerOptions": [ { "text": "strlen($str)", "isCorrect": true }, { "text": "len($str)", "isCorrect": false }, { "text": "string_length($str)", "isCorrect": false }, { "text": "count($str)", "isCorrect": false } ] },
        { "question": "What is an `object` in PHP?", "answerOptions": [ { "text": "An instance of a class.", "isCorrect": true }, { "text": "A superglobal variable.", "isCorrect": false }, { "text": "A special data type for numbers.", "isCorrect": false }, { "text": "A function that returns a value.", "isCorrect": false } ] },
        { "question": "How do you loop through an associative array in PHP?", "answerOptions": [ { "text": "foreach ($array as $key => $value)", "isCorrect": true }, { "text": "for ($i = 0; $i < count($array); $i++)", "isCorrect": false }, { "text": "while ($array as $value)", "isCorrect": false }, { "text": "loop ($array)", "isCorrect": false } ] },
        { "question": "What is the purpose of `is_array()`?", "answerOptions": [ { "text": "To check if a variable is an integer.", "isCorrect": false }, { "text": "To check if a variable is an array.", "isCorrect": true }, { "text": "To convert a variable to an array.", "isCorrect": false }, { "text": "To check if a variable is set.", "isCorrect": false } ] },
        { "question": "How do you unset a variable in PHP?", "answerOptions": [ { "text": "unset($var);", "isCorrect": true }, { "text": "delete($var);", "isCorrect": false }, { "text": "remove_var($var);", "isCorrect": false }, { "text": "clear($var);", "isCorrect": false } ] },
        { "question": "What is a trait in PHP?", "answerOptions": [ { "text": "A mechanism for code reuse in single inheritance languages.", "isCorrect": true }, { "text": "A type of variable.", "isCorrect": false }, { "text": "A built-in function.", "isCorrect": false }, { "text": "A class with no properties.", "isCorrect": false } ] },
        { "question": "What is the main difference between `require` and `include`?", "answerOptions": [ { "text": "`require` will generate a fatal error on failure, while `include` will only generate a warning.", "isCorrect": true }, { "text": "`require` will only generate a warning, while `include` will generate a fatal error.", "isCorrect": false }, { "text": "There is no difference.", "isCorrect": false }, { "text": "`require` is for functions, `include` is for variables.", "isCorrect": false } ] },
        { "question": "How do you create a class in PHP?", "answerOptions": [ { "text": "class MyClass { ... }", "isCorrect": true }, { "text": "new MyClass { ... }", "isCorrect": false }, { "text": "object MyClass { ... }", "isCorrect": false }, { "text": "function MyClass() { ... }", "isCorrect": false } ] },
        { "question": "What is the `->` operator used for?", "answerOptions": [ { "text": "To access properties and methods of an object.", "isCorrect": true }, { "text": "To define a function.", "isCorrect": false }, { "text": "To compare two variables.", "isCorrect": false }, { "text": "To assign a value to a variable.", "isCorrect": false } ] },
        { "question": "How do you handle exceptions in PHP?", "answerOptions": [ { "text": "try { ... } catch (Exception $e) { ... }", "isCorrect": true }, { "text": "throw { ... } handle { ... }", "isCorrect": false }, { "text": "if (error) { ... }", "isCorrect": false }, { "text": "catch (error) { ... }", "isCorrect": false } ] },
        { "question": "What is a namespace in PHP?", "answerOptions": [ { "text": "A way of grouping related classes and interfaces to avoid naming conflicts.", "isCorrect": true }, { "text": "A type of variable that stores a list of names.", "isCorrect": false }, { "text": "A file that contains all the classes.", "isCorrect": false }, { "text": "A built-in function to check for a file's existence.", "isCorrect": false } ] }
    ];

    const quizScreen = document.getElementById('quiz-screen');
    const resultScreen = document.getElementById('result-screen');
    const reviewScreen = document.getElementById('review-screen');
    const quizHeader = document.getElementById('quiz-header');

    const nextBtn = document.getElementById('next-btn');
    const restartBtn = document.getElementById('restart-btn');
    const reviewBtn = document.getElementById('review-btn');
    const backBtn = document.getElementById('back-btn');

    const questionText = document.getElementById('question-text');
    const optionsForm = document.getElementById('options-form');
    const answeredCountSpan = document.getElementById('answered-count');
    const correctCountSpan = document.getElementById('correct-count');
    const incorrectCountSpan = document.getElementById('incorrect-count');
    const skippedCountSpan = document.getElementById('skipped-count');
    const reviewList = document.getElementById('review-list');
    
    let currentQuestionIndex = 0;
    let userAnswers = new Array(quizData.length).fill(null);

    const showScreen = (screenId) => {
        const screens = [quizScreen, resultScreen, reviewScreen];
        screens.forEach(screen => {
            if (screen.id === screenId) {
                screen.classList.remove('hidden');
            } else {
                screen.classList.add('hidden');
            }
        });
        if (screenId === 'quiz-screen') {
            quizHeader.classList.remove('hidden');
        } else {
            quizHeader.classList.add('hidden');
        }
    };

    const renderQuestion = () => {
        const question = quizData[currentQuestionIndex];
        questionText.textContent = question.question;
        optionsForm.innerHTML = '';
        
        question.answerOptions.forEach((option, index) => {
            const label = document.createElement('label');
            label.className = 'flex items-center p-3 bg-gray-50 rounded-xl cursor-pointer transition-all duration-200 hover:bg-gray-100 shadow-sm';
            
            const input = document.createElement('input');
            input.type = 'radio';
            input.name = 'option';
            input.value = index;
            input.className = 'appearance-none w-5 h-5 border-2 border-gray-300 rounded-full mr-4 relative cursor-pointer checked:bg-blue-600 checked:border-blue-600 checked:after:content-[""] checked:after:absolute checked:after:top-1/2 checked:after:left-1/2 checked:after:transform checked:after:-translate-x-1/2 checked:after:-translate-y-1/2 checked:after:w-2 checked:after:h-2 checked:after:bg-white checked:after:rounded-full transition-colors duration-200';
            
            const span = document.createElement('span');
            span.className = 'text-base md:text-lg text-gray-800 font-medium';
            span.textContent = option.text;
            
            label.appendChild(input);
            label.appendChild(span);
            optionsForm.appendChild(label);

            if (userAnswers[currentQuestionIndex] === index) {
                input.checked = true;
            }
        });
        
        nextBtn.textContent = currentQuestionIndex === quizData.length - 1 ? 'Show Results' : 'Next';
    };

    const calculateResults = () => {
        let correct = 0;
        let incorrect = 0;
        let skipped = 0;
        let answered = 0;
        userAnswers.forEach((answerIndex, qIndex) => {
            if (answerIndex !== null) {
                answered++;
                const correctOptions = quizData[qIndex].answerOptions.filter(opt => opt.isCorrect);
                if (correctOptions.length === 1) {
                    if (quizData[qIndex].answerOptions[answerIndex].isCorrect) {
                        correct++;
                    } else {
                        incorrect++;
                    }
                } else if (correctOptions.length > 1) {
                    const selectedOptionIsCorrect = quizData[qIndex].answerOptions[answerIndex].isCorrect;
                    if (selectedOptionIsCorrect) {
                        correct++;
                    } else {
                        incorrect++;
                    }
                }
            } else {
                skipped++;
            }
        });
        return { correct, incorrect, skipped, answered };
    };

    const renderReview = () => {
        reviewList.innerHTML = '';
        quizData.forEach((question, index) => {
            const userChoice = userAnswers[index];
            const correctOptions = question.answerOptions.filter(opt => opt.isCorrect);

            const reviewItem = document.createElement('div');
            reviewItem.className = `p-4 rounded-xl border-2 transition-colors duration-200 ${userChoice === null ? 'border-gray-300 bg-gray-50' : (question.answerOptions[userChoice].isCorrect ? 'border-green-400 bg-green-50' : 'border-red-400 bg-red-50')}`;
            
            let userAnswerText = userChoice !== null ? question.answerOptions[userChoice].text : 'No answer selected.';
            let isCorrect = userChoice !== null && question.answerOptions[userChoice].isCorrect;

            reviewItem.innerHTML = `
                <p class="font-bold text-gray-800">${index + 1}. ${question.question}</p>
                <p class="mt-2 text-gray-600">Your Answer: <span class="${isCorrect ? 'text-green-600' : 'text-red-600'} font-semibold">${userAnswerText}</span></p>
                <p class="text-gray-600">Correct Answer(s): <span class="text-green-600 font-semibold">${correctOptions.map(opt => opt.text).join(' or ')}</span></p>
            `;
            reviewList.appendChild(reviewItem);
        });
    };

    // Event Listeners
    nextBtn.addEventListener('click', () => {
        const selectedOption = document.querySelector('input[name="option"]:checked');
        if (selectedOption) {
            userAnswers[currentQuestionIndex] = parseInt(selectedOption.value);
        } else {
            userAnswers[currentQuestionIndex] = null;
        }

        currentQuestionIndex++;
        if (currentQuestionIndex < quizData.length) {
            renderQuestion();
        } else {
            const { correct, incorrect, skipped, answered } = calculateResults();
            answeredCountSpan.textContent = answered;
            correctCountSpan.textContent = correct;
            incorrectCountSpan.textContent = incorrect;
            skippedCountSpan.textContent = skipped;
            showScreen('result-screen');
        }
    });

    restartBtn.addEventListener('click', () => {
        currentQuestionIndex = 0;
        userAnswers = new Array(quizData.length).fill(null);
        showScreen('quiz-screen');
        renderQuestion();
    });

    reviewBtn.addEventListener('click', () => {
        renderReview();
        showScreen('review-screen');
    });

    backBtn.addEventListener('click', () => {
        showScreen('result-screen');
    });

    // Initial render
    renderQuestion();
</script>

</body>
</html>
