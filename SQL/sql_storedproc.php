<?php include '../includes/sidebar.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stored Procedures Quiz</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="bg-gray-100">
    <main id="mainContent" class="main-content flex-1 min-h-screen flex items-center justify-center">
        <div id="app-container"
            class="bg-white rounded-[2rem] shadow-xl p-6 max-w-3xl w-full flex flex-col items-center transition-all duration-300 ease-in-out">

            <!-- Quiz Section -->
            <div id="quiz-section" class="flex flex-col items-center w-full">
                <div class="text-center mb-10">
                    <h1 class="text-4xl font-bold text-gray-900">Stored Procedures Quiz</h1>
                    <p class="text-lg text-gray-600 mt-3">Test your knowledge with these 30 questions on stored
                        procedures.</p>
                </div>
                <div class="w-full bg-gray-50 rounded-2xl p-10 shadow-md">
                    <p class="text-xl font-medium text-gray-900 mb-3" id="question-text"></p>
                    <form id="options-form" class="flex flex-col gap-4">
                        <!-- Options will be dynamically added here -->
                    </form>
                </div>
                <button
                    class="bg-gradient-to-br from-indigo-600 to-indigo-800 text-white py-3 px-10 rounded-full font-semibold border-none cursor-pointer shadow-lg transition-all duration-200 ease-in-out mt-10 hover:from-indigo-700 hover:to-indigo-900 active:translate-y-0 active:shadow-md"
                    id="next-btn">Next</button>
            </div>
            <!-- Result Section -->
            <div id="result-section" class="hidden flex-col items-center w-full text-center">
                <div class="text-center mb-10">
                    <h1 class="text-4xl font-bold text-gray-900 mb-6">Quiz Results</h1>
                    <p class="text-lg text-gray-600 mt-3" id="total-questions-answered"></p>
                </div>
                <div class="w-full bg-gray-50 rounded-2xl p-10 shadow-md">
                    <div class="flex justify-center gap-8 mb-10 text-center">
                        <div class="flex flex-col items-center text-base font-medium text-gray-600">
                            <span class="text-4xl font-bold mb-2 text-green-500" id="correct-count"></span>
                            <span>Correct</span>
                        </div>
                        <div class="flex flex-col items-center text-base font-medium text-gray-600">
                            <span class="text-4xl font-bold mb-2 text-red-500" id="incorrect-count"></span>
                            <span>Incorrect</span>
                        </div>
                        <div class="flex flex-col items-center text-base font-medium text-gray-600">
                            <span class="text-4xl font-bold mb-2 text-gray-400" id="skipped-count"></span>
                            <span>Unanswered</span>
                        </div>
                    </div>
                </div>
                <div class="flex flex-col md:flex-row gap-4 mt-10">
                    <button
                        class="bg-gradient-to-br from-blue-500 to-blue-700 hover:from-blue-600 hover:to-blue-800 text-white py-3 px-10 rounded-full font-semibold border-none cursor-pointer shadow-lg transition-all duration-200 ease-in-out hover:-translate-y-0.5 active:translate-y-0 active:shadow-md"
                        id="review-btn">View Detailed Answers</button>
                    <button
                        class="bg-gray-200 text-gray-600 py-3 px-10 rounded-full font-semibold border-none cursor-pointer shadow-md transition-all duration-200 ease-in-out hover:bg-gray-300 hover:text-gray-700 hover:-translate-y-0.5 active:translate-y-0 active:shadow"
                        id="restart-btn">Try Again</button>
                </div>
            </div>
            <!-- Review Section -->
            <div id="review-section" class="hidden flex-col items-center w-full">
                <div class="text-center mb-5">
                    <h1 class="text-4xl font-bold text-gray-900">Review Answers</h1>
                </div>
                <div id="review-list" class="w-full">
                    <!-- Review cards will be dynamically added here -->
                </div>
                <button
                    class="bg-gradient-to-br from-indigo-600 to-indigo-800 text-white py-3 px-10 rounded-full font-semibold border-none cursor-pointer shadow-lg transition-all duration-200 ease-in-out mt-10 hover:from-indigo-700 hover:to-indigo-900 active:translate-y-0 active:shadow-md"
                    id="back-to-results-btn">Back to Results</button>
            </div>
        </div>
    </main>
    <script>
        const quizData = [
            {
                question: "1. What is a stored procedure?",
                options: ["A function that returns a value from a table.", "A pre-compiled set of one or more SQL statements stored in the database.", "A temporary table that holds query results.", "A virtual table based on a query."],
                answer: 1
            },
            {
                question: "2. Which of the following is a key advantage of using stored procedures?",
                options: ["They are easier to debug than inline SQL.", "They make the database more portable.", "They can improve performance and security.", "They do not require any permissions to be executed."],
                answer: 2
            },
            {
                question: "3. What is the standard SQL command to execute a stored procedure?",
                options: ["RUN", "EXECUTE", "CALL", "PERFORM"],
                answer: 2
            },
            {
                question: "4. How can a stored procedure enhance database security?",
                options: ["By encrypting all data within the database.", "By allowing users to be granted permissions on the procedure, rather than the underlying tables.", "By preventing any user from modifying data.", "By making all database objects read-only."],
                answer: 1
            },
            {
                question: "5. A stored procedure can accept which type of parameters?",
                options: ["IN (input)", "OUT (output)", "INOUT (input/output)", "All of the above"],
                answer: 3
            },
            {
                question: "6. Which of the following is a common disadvantage of stored procedures?",
                options: ["They are always slower to execute than inline SQL.", "They can make application logic more difficult to debug.", "They require a separate server to run.", "They cannot perform DML operations."],
                answer: 1
            },
            {
                question: "7. What is the purpose of the `BEGIN...END` block in a stored procedure?",
                options: ["To define a transaction block.", "To mark the start and end of the procedure's body.", "To declare a variable.", "To define a loop."],
                answer: 1
            },
            {
                question: "8. How do stored procedures contribute to improved performance?",
                options: ["They eliminate the need for indexes.", "They force the database to re-read data from disk every time.", "They are pre-compiled, so the execution plan is ready to use.", "They always run on a separate server instance."],
                answer: 2
            },
            {
                question: "9. Which SQL statement is used to declare a variable inside a stored procedure in most database systems (e.g., SQL Server)?",
                options: ["CREATE VARIABLE", "SET VARIABLE", "DEFINE", "DECLARE"],
                answer: 3
            },
            {
                question: "10. What is the main difference between a stored procedure and a user-defined function?",
                options: ["A function can be used in a `SELECT` statement, but a stored procedure cannot.", "A stored procedure can return a single value, but a function cannot.", "A function can perform DML operations, but a stored procedure cannot.", "There is no difference."],
                answer: 0
            },
            {
                question: "11. How can you handle errors within a stored procedure in SQL Server?",
                options: ["Using the `TRY...CATCH` block.", "By calling an `ON ERROR` function.", "Errors are automatically logged to a file.", "Stored procedures cannot handle errors."],
                answer: 0
            },
            {
                question: "12. What is dynamic SQL in the context of stored procedures?",
                options: ["SQL that is written in a programming language other than SQL.", "SQL that changes its behavior based on a condition.", "SQL that is constructed as a string and then executed.", "SQL that is optimized for speed."],
                answer: 2
            },
            {
                question: "13. What is the command to modify an existing stored procedure?",
                options: ["UPDATE PROCEDURE", "MODIFY PROCEDURE", "ALTER PROCEDURE", "EDIT PROCEDURE"],
                answer: 2
            },
            {
                question: "14. A stored procedure can manage transactions using which commands?",
                options: ["`BEGIN TRANSACTION`, `COMMIT`, and `ROLLBACK`.", "`START TRANSACTION` and `END TRANSACTION`.", "`SAVE` and `LOAD`.", "None of the above."],
                answer: 0
            },
            {
                question: "15. How do you pass a variable's value back to the calling application?",
                options: ["Using an `IN` parameter.", "Using an `OUT` or `OUTPUT` parameter.", "By returning it with a `SELECT` statement.", "Stored procedures cannot return values."],
                answer: 1
            },
            {
                question: "16. What is a common way to prevent SQL injection when using stored procedures?",
                options: ["By using `EXECUTE` instead of `sp_executesql`.", "By concatenating user input directly into the SQL string.", "By passing user input as parameters to the procedure.", "SQL injection is not a risk with stored procedures."],
                answer: 2
            },
            {
                question: "17. What is a system stored procedure?",
                options: ["A procedure created by a system administrator.", "A procedure that manages the operating system.", "A built-in procedure provided by the database management system.", "A procedure that can only be executed by the system."],
                answer: 2
            },
            {
                question: "18. What does a `RETURN` statement in a stored procedure do?",
                options: ["It returns a record set.", "It returns a status or error code.", "It returns a single value that can be used in a `SELECT` statement.", "It stops the execution of the procedure and commits the transaction."],
                answer: 1
            },
            {
                question: "19. How does `WITH SCHEMABINDING` affect a stored procedure?",
                options: ["It prevents the underlying tables from being dropped or altered.", "It binds the procedure to a specific user account.", "It improves performance by creating an index.", "It allows the procedure to run without any permissions."],
                answer: 0
            },
            {
                question: "20. What happens to the execution plan of a stored procedure?",
                options: ["It is recompiled every time the procedure is called.", "It is cached in memory and reused for subsequent calls.", "It is stored in a temporary file and deleted after execution.", "It is never created."],
                answer: 1
            },
            {
                question: "21. A stored procedure that calls itself is known as a(n):",
                options: ["Recursive procedure", "Nested procedure", "Iterative procedure", "Looping procedure"],
                answer: 0
            },
            {
                question: "22. What command is used to remove a stored procedure from the database?",
                options: ["DELETE PROCEDURE", "REMOVE PROCEDURE", "DROP PROCEDURE", "PURGE PROCEDURE"],
                answer: 2
            },
            {
                question: "23. When might a stored procedure be automatically recompiled by the database engine?",
                options: ["When the server is restarted.", "When the statistics on a referenced table are updated.", "When a user logs out.", "Stored procedures are never recompiled."],
                answer: 1
            },
            {
                question: "24. Can a stored procedure contain conditional logic?",
                options: ["No, it can only execute a sequential list of commands.", "Yes, using `IF...ELSE` statements.", "Only if it is written in C#.", "Only if it is a system stored procedure."],
                answer: 1
            },
            {
                question: "25. What is a common reason for using a `WHILE` loop in a stored procedure?",
                options: ["To improve security.", "To iterate through a record set for processing.", "To reduce the amount of code written.", "To ensure data is consistent."],
                answer: 1
            },
            {
                question: "26. Can a stored procedure call another stored procedure?",
                options: ["No, this is not supported.", "Yes, this is known as nesting.", "Only if they are in the same database.", "Only if the first procedure returns a value."],
                answer: 1
            },
            {
                question: "27. In SQL Server, which function can be used within a `CATCH` block to get the error message?",
                options: ["`GET_ERROR()`", "`ERROR_MESSAGE()`", "`@@ERROR`", "`GET_MESSAGE()`"],
                answer: 1
            },
            {
                question: "28. What is a `Table-Valued Parameter` in a stored procedure?",
                options: ["A parameter that accepts a single table name.", "A parameter that accepts an entire table as input.", "A parameter that can be a single row or a table.", "A parameter that is used to define a table."],
                answer: 1
            },
            {
                question: "29. What is a key benefit of using stored procedures in a multi-user environment?",
                options: ["They prevent multiple users from accessing the same data.", "They reduce network traffic by executing a single command instead of many.", "They automatically backup the database.", "They prevent any data from being updated."],
                answer: 1
            },
            {
                question: "30. Which of the following is an example of a system stored procedure in SQL Server?",
                options: ["`sp_select_data`", "`usp_get_user`", "`sp_helptext`", "`sp_run_query`"],
                answer: 2
            }
        ];

        let currentQuestionIndex = 0;
        let userAnswers = new Array(quizData.length).fill(null);

        const appContainer = document.getElementById('app-container');
        const quizSection = document.getElementById('quiz-section');
        const resultSection = document.getElementById('result-section');
        const reviewSection = document.getElementById('review-section');
        const nextBtn = document.getElementById('next-btn');
        const reviewBtn = document.getElementById('review-btn');
        const restartBtn = document.getElementById('restart-btn');
        const backToResultsBtn = document.getElementById('back-to-results-btn');

        function renderQuiz() {
            if (currentQuestionIndex < quizData.length) {
                quizSection.classList.remove('hidden');
                resultSection.classList.add('hidden');
                reviewSection.classList.add('hidden');

                const currentQuestion = quizData[currentQuestionIndex];
                document.getElementById('question-text').innerText = currentQuestion.question;

                const optionsForm = document.getElementById('options-form');
                optionsForm.innerHTML = '';
                currentQuestion.options.forEach((option, index) => {
                    const optionId = `q${currentQuestionIndex}-option${index}`;
                    const isChecked = userAnswers[currentQuestionIndex] === index;
                    optionsForm.innerHTML += `
                        <label for="${optionId}" class="flex items-center p-2 rounded-xl cursor-pointer transition-colors duration-200 ease-in-out hover:bg-gray-100">
                            <input type="radio" id="${optionId}" name="question${currentQuestionIndex}" value="${index}" class="mr-5 w-5 h-5 accent-blue-500 cursor-pointer" ${isChecked ? 'checked' : ''}>
                            <span class="font-medium text-gray-700 text-base">${option}</span>
                        </label>
                    `;
                });

                if (currentQuestionIndex === quizData.length - 1) {
                    nextBtn.innerText = "Show Result";
                } else {
                    nextBtn.innerText = "Next";
                }

                optionsForm.addEventListener('change', (e) => {
                    if (e.target.type === 'radio') {
                        userAnswers[currentQuestionIndex] = parseInt(e.target.value);
                    }
                });
            } else {
                showResults();
            }
        }

        function showResults() {
            quizSection.classList.add('hidden');
            reviewSection.classList.add('hidden');
            resultSection.classList.remove('hidden');

            let correctCount = 0;
            let incorrectCount = 0;
            let skippedCount = 0;

            userAnswers.forEach((answer, index) => {
                if (answer === null) {
                    skippedCount++;
                } else if (answer === quizData[index].answer) {
                    correctCount++;
                } else {
                    incorrectCount++;
                }
            });


            document.getElementById('total-questions-answered').innerHTML = `You answered <strong>${correctCount + incorrectCount}</strong> questions out of <strong>${quizData.length}</strong>.`;
            document.getElementById('correct-count').innerText = correctCount;
            document.getElementById('incorrect-count').innerText = incorrectCount;
            document.getElementById('skipped-count').innerText = skippedCount;
        }

        function showReview() {
            quizSection.classList.add('hidden');
            resultSection.classList.add('hidden');
            reviewSection.classList.remove('hidden');

            const reviewList = document.getElementById('review-list');
            reviewList.innerHTML = '';

            quizData.forEach((question, index) => {
                const userAnswerIndex = userAnswers[index];
                const correctAnswerIndex = question.answer;

                let statusText = '';
                let statusClass = '';

                if (userAnswerIndex === null) {
                    statusText = 'You skipped this question.';
                    statusClass = 'text-gray-400 font-bold';
                } else if (userAnswerIndex === correctAnswerIndex) {
                    statusText = 'Your answer is correct.';
                    statusClass = 'text-green-600 font-bold';
                } else {
                    statusText = `Your answer is incorrect. The correct answer is: `;
                    statusClass = 'text-red-600 font-bold';
                }

                reviewList.innerHTML += `
                    <div class="w-full bg-gray-50 rounded-2xl p-10 shadow-sm mb-6">
                        <p class="text-xl font-medium text-gray-900 mb-2">${question.question}</p>
                        <p class="mb-2">
                            <span class="${statusClass}">${statusText}</span>
                            ${userAnswerIndex !== correctAnswerIndex ? `<span class="text-green-600 font-bold">${question.options[correctAnswerIndex]}</span>` : ''}
                        </p>
                        ${userAnswerIndex !== null ? `<p class="italic font-medium text-gray-700">Your choice: ${question.options[userAnswerIndex]}</p>` : ''}
                    </div>
                `;
            });
        }

        nextBtn.addEventListener('click', () => {
            currentQuestionIndex++;
            renderQuiz();
        });

        reviewBtn.addEventListener('click', () => {
            showReview();
        });

        restartBtn.addEventListener('click', () => {
            currentQuestionIndex = 0;
            userAnswers = new Array(quizData.length).fill(null);
            renderQuiz();
        });

        backToResultsBtn.addEventListener('click', () => {
            showResults();
        });

        // Initial render
        renderQuiz();
    </script>
</body>

</html>