<?php include '../includes/sidebar.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP and MySQL Quiz</title>
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

<body class="bg-[#f0f4f8]">
    <main id="mainContent" class="main-content flex-1 min-h-screen flex items-center justify-center">
        <!-- Main Quiz Container -->
        <div id="app"
            class="max-w-3xl bg-white p-8 rounded-3xl shadow-2xl w-full text-center flex flex-col items-center">
            <!-- Main title and description -->
            <h1 id="main-title" class="text-3xl font-bold text-gray-800 mb-2">PHP and MySQL Quiz</h1>
            <p class="text-gray-600 mb-8">Test your knowledge on PHP and MySQL.</p>

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
                "question": "Which function is used to connect to MySQL from PHP?",
                "options": ["mysql_connect()", "mysqli_connect()", "pdo_connect()", "db_connect()"],
                "answer": "mysqli_connect()",
                "description": "The mysqli_connect() function is used to connect to MySQL and is the modern, more secure alternative to mysql_connect()."
            },
            {
                "question": "Which SQL command is used to create a new database in MySQL?",
                "options": ["CREATE NEW DATABASE", "CREATE DATABASE", "NEW DATABASE", "MAKE DATABASE"],
                "answer": "CREATE DATABASE",
                "description": "The CREATE DATABASE command is used to create a new database in MySQL."
            },
            {
                "question": "Which function is used to fetch results after executing a MySQL query in PHP?",
                "options": ["mysqli_fetch_array()", "mysqli_get_result()", "mysqli_fetch_row()", "mysqli_fetch()"],
                "answer": "mysqli_fetch_array()",
                "description": "The mysqli_fetch_array() function fetches a row from a result set as an associative array, a numeric array, or both."
            },
            {
                "question": "Which SQL command is used to delete data from a table in MySQL?",
                "options": ["DELETE FROM", "REMOVE FROM", "DROP TABLE", "TRUNCATE TABLE"],
                "answer": "DELETE FROM",
                "description": "The DELETE FROM command is used to delete one or more rows of data from a MySQL table."
            },
            {
                "question": "Which function is used to close a database connection in PHP?",
                "options": ["mysqli_close()", "disconnect()", "close_connection()", "mysqli_disconnect()"],
                "answer": "mysqli_close()",
                "description": "The mysqli_close() function closes the connection to the MySQL server."
            },
            {
                "question": "Which SQL command is used to add a new row to a table in MySQL?",
                "options": ["INSERT INTO", "ADD TO", "CREATE RECORD", "SAVE INTO"],
                "answer": "INSERT INTO",
                "description": "The INSERT INTO command is used to add a new row to a MySQL table."
            },
            {
                "question": "Which method is used to execute a query using MySQLi in PHP?",
                "options": ["execute()", "query()", "run()", "fetch()"],
                "answer": "query()",
                "description": "The query() method is used to execute an SQL query on a MySQLi object."
            },
            {
                "question": "Which SQL command is used to modify existing data in a table in MySQL?",
                "options": ["MODIFY", "CHANGE", "UPDATE", "ALTER"],
                "answer": "UPDATE",
                "description": "The UPDATE command is used to modify existing data in a MySQL table."
            },
            {
                "question": "What is the best technique to use in PHP to protect against SQL injection?",
                "options": ["Magic Quotes", "Input Sanitization", "Prepared Statements", "Escaping User Input"],
                "answer": "Prepared Statements",
                "description": "Prepared Statements prevent SQL injection by separating the data from the SQL query."
            },
            {
                "question": "Which SQL command is used to retrieve data from a table in MySQL?",
                "options": ["GET", "FETCH FROM", "SELECT", "PULL"],
                "answer": "SELECT",
                "description": "The SELECT command is used to retrieve data from a MySQL table."
            },
            {
                "question": "Which method is used to create a `prepared statement` using mysqli in PHP?",
                "options": ["prepare()", "statement()", "bind_param()", "create_statement()"],
                "answer": "prepare()",
                "description": "The prepare() method is used to create a prepared statement for an SQL query on a MySQLi object."
            },
            {
                "question": "Which SQL command is used to add a new column to a table in MySQL?",
                "options": ["ADD COLUMN", "ALTER TABLE ... ADD", "INSERT COLUMN INTO", "CREATE COLUMN"],
                "answer": "ALTER TABLE ... ADD",
                "description": "The ALTER TABLE ... ADD command is used to add a new column to a table."
            },
            {
                "question": "What does the `mysqli_fetch_assoc()` function do in PHP?",
                "options": ["It fetches a row as a numeric array.", "It fetches a row as an associative array, where the keys are column names.", "It fetches a row as an object.", "It fetches all rows at once."],
                "answer": "It fetches a row as an associative array, where the keys are column names.",
                "description": "The mysqli_fetch_assoc() function is used to fetch a row as an associative array, where the keys are the column names."
            },
            {
                "question": "Which SQL command is used to remove a column from a table in MySQL?",
                "options": ["DELETE COLUMN", "ALTER TABLE ... DROP", "REMOVE COLUMN FROM", "TRUNCATE COLUMN"],
                "answer": "ALTER TABLE ... DROP",
                "description": "The ALTER TABLE ... DROP command is used to remove a column from a table."
            },
            {
                "question": "What does the `mysqli_query()` function do in PHP?",
                "options": ["It only executes a SELECT query.", "It only executes an UPDATE query.", "It executes an SQL query on the database.", "It closes the database connection."],
                "answer": "It executes an SQL query on the database.",
                "description": "The mysqli_query() function executes an SQL query on the database."
            },
            {
                "question": "Which SQL command is used to delete all data from a table in MySQL, but not the table structure?",
                "options": ["DROP TABLE", "DELETE TABLE", "TRUNCATE TABLE", "REMOVE ALL FROM"],
                "answer": "TRUNCATE TABLE",
                "description": "The TRUNCATE TABLE command quickly deletes all rows in a table, but keeps the table structure."
            },
            {
                "question": "What does the `mysqli_real_escape_string()` function do in PHP?",
                "options": ["It sanitizes a string to protect against SQL injection.", "It removes HTML tags from a string.", "It encrypts a string.", "It converts a string to HTML entities."],
                "answer": "It sanitizes a string to protect against SQL injection.",
                "description": "This function escapes special characters in a string to help prevent SQL injection."
            },
            {
                "question": "Which SQL command is used to create a table in MySQL?",
                "options": ["MAKE TABLE", "CREATE TABLE", "BUILD TABLE", "ADD TABLE"],
                "answer": "CREATE TABLE",
                "description": "The CREATE TABLE command is used to create a new table in MySQL."
            },
            {
                "question": "What does the `mysqli_num_rows()` function do in PHP?",
                "options": ["It returns the number of affected rows.", "It returns the number of rows returned by a `SELECT` query.", "It returns the number of all rows in a table.", "It returns the number of all tables."],
                "answer": "It returns the number of rows returned by a `SELECT` query.",
                "description": "The mysqli_num_rows() function returns the number of rows from a result set."
            },
            {
                "question": "Which clause is used to sort data in `DESCENDING` order in MySQL?",
                "options": ["ORDER BY DESC", "SORT BY DESC", "SORT DESC", "ORDER DESC"],
                "answer": "ORDER BY DESC",
                "description": "The ORDER BY ... DESC command is used to sort data in descending order."
            },
            {
                "question": "What does the `mysqli_insert_id()` function do in PHP?",
                "options": ["It returns the ID generated by the last INSERT query.", "It removes the ID of the most recently inserted row.", "It creates a new ID.", "It returns the ID of any table."],
                "answer": "It returns the ID generated by the last INSERT query.",
                "description": "The mysqli_insert_id() function returns the AUTO_INCREMENT ID generated by the last INSERT query."
            },
            {
                "question": "Which clause is used to retrieve specific data from a table in MySQL?",
                "options": ["WHERE", "WHEN", "IF", "SELECT"],
                "answer": "WHERE",
                "description": "The WHERE clause is used to specify conditions in a database query."
            },
            {
                "question": "What does the `mysqli_error()` function do in PHP?",
                "options": ["It returns information about a successful query.", "It returns the error information from the most recent MySQL operation.", "It returns a general PHP error message.", "It only tells about syntax errors."],
                "answer": "It returns the error information from the most recent MySQL operation.",
                "description": "The mysqli_error() function returns the error information from the MySQL server for the most recent operation."
            },
            {
                "question": "What is the use of the `AUTO_INCREMENT` attribute in a table in MySQL?",
                "options": ["It automatically modifies the data in the column.", "It ensures a specific value is required in the column.", "It automatically generates a unique number when a new row is added.", "It encrypts the data in the column."],
                "answer": "It automatically generates a unique number when a new row is added.",
                "description": "The AUTO_INCREMENT attribute automatically generates a unique, incrementing number when a new row is added."
            },
            {
                "question": "What does the `mysqli_affected_rows()` function do in PHP?",
                "options": ["It returns the number of rows affected by a `SELECT` query.", "It returns the number of rows affected by an `INSERT`, `UPDATE`, or `DELETE` query.", "It returns the number of all rows in the database.", "It returns the number of all rows in a table."],
                "answer": "It returns the number of rows affected by an `INSERT`, `UPDATE`, or `DELETE` query.",
                "description": "The mysqli_affected_rows() function returns the number of rows affected by an INSERT, UPDATE, or DELETE query."
            },
            {
                "question": "What is the use of the `VARCHAR` data type in MySQL?",
                "options": ["It stores only numbers.", "It stores fixed-length strings.", "It stores variable-length strings.", "It stores binary data."],
                "answer": "It stores variable-length strings.",
                "description": "The VARCHAR data type stores variable-length strings."
            },
            {
                "question": "Why is `mysqli_prepare()` used in PHP?",
                "options": ["To execute only one query at a time.", "To prevent SQL injection and improve performance.", "To run only SELECT statements.", "To close the database connection."],
                "answer": "To prevent SQL injection and improve performance.",
                "description": "Prepared statements are used to prevent SQL injection attacks by separating data from the query logic."
            },
            {
                "question": "What is the use of `PRIMARY KEY` in MySQL?",
                "options": ["It deletes all rows in a table.", "It uniquely identifies a column.", "It allows a column to have Null values.", "It modifies a column."],
                "answer": "It uniquely identifies a column.",
                "description": "The PRIMARY KEY constraint uniquely identifies a column and does not accept Null values."
            },
            {
                "question": "What does the `mysqli_fetch_all()` function do in PHP?",
                "options": ["It fetches all rows at once.", "It fetches one row at a time.", "It fetches only one column.", "It deletes all data from the database."],
                "answer": "It fetches all rows at once.",
                "description": "The mysqli_fetch_all() function fetches all rows from a result set at once as either an associative or a numeric array."
            },
            {
                "question": "What happens if you don't use the `WHERE` clause in an `UPDATE` command in MySQL?",
                "options": ["It adds a new row.", "There is no change.", "It modifies the data in all rows.", "It modifies data in only one row."],
                "answer": "It modifies the data in all rows.",
                "description": "If the WHERE clause is not used in an UPDATE command, it will modify the data in all rows of the table."
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
                    label.className = 'option-label flex items-center p-4 rounded-xl  text-lg font-medium cursor-pointer transition-all duration-200 hover:bg-gray-200';

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

                const rationaleText = document.createElement('p');
                rationaleText.className = 'text-gray-600 mt-2 text-sm italic';
                rationaleText.innerHTML = `Explanation: <span class="text-gray-500">${question.description}</span>`;

                questionDiv.appendChild(questionTitle);
                questionDiv.appendChild(yourAnswerText);
                if (!isCorrect) {
                    questionDiv.appendChild(correctAnswerText);
                }
                questionDiv.appendChild(rationaleText);

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
            mainTitle.textContent = "PHP and MySQL Quiz";
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