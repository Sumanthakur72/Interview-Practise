<?php include '../includes/sidebar.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SQL Query Practice Quiz</title>
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
            class="bg-white rounded-[2rem] shadow-xl p-8 max-w-3xl w-full flex flex-col items-center transition-all duration-300 ease-in-out mt-10">
            <!-- Quiz Section -->
            <div id="quiz-section" class="flex flex-col items-center w-full">
                <div class="text-center mb-8">
                    <h1 class="text-4xl font-bold text-gray-900">SQL Query Practice Quiz</h1>
                    <p class="text-lg text-gray-600 mt-3">Test your knowledge with these beginner and advanced level
                        questions.</p>
                </div>
                <div class="w-full bg-gray-50 rounded-2xl p-8 shadow-md">
                    <p class="text-xl font-medium text-gray-900 mb-3" id="question-text"></p>
                    <form id="options-form" class="flex flex-col">
                        <!-- Options will be dynamically added here -->
                    </form>
                </div>
                <button
                    class="bg-gradient-to-br from-indigo-600 to-indigo-800 text-white py-3 px-8 rounded-full font-semibold border-none cursor-pointer shadow-lg transition-all duration-200 ease-in-out mt-6 hover:from-indigo-700 hover:to-indigo-900 active:translate-y-0 active:shadow-md"
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
                <div class="text-center mb-10">
                    <h1 class="text-4xl font-bold text-gray-900 mb-6">Review Answers</h1>
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
                question: "1. Which of the following SQL statements is used to create a new database?",
                options: ["CREATE DATABASE", "CREATE DB", "NEW DATABASE", "NEW DB"],
                answer: 0
            },
            {
                question: "2. What is the correct syntax for the SELECT statement to retrieve all columns from a table named 'Employees'?",
                options: ["SELECT * FROM Employees", "SELECT all FROM Employees", "GET * FROM Employees", "SELECT Employees"],
                answer: 0
            },
            {
                question: "3. Which clause is used to filter records based on a condition?",
                options: ["FILTER", "WHERE", "HAVING", "GROUP BY"],
                answer: 1
            },
            {
                question: "4. How do you select only unique values from a column?",
                options: ["SELECT UNIQUE", "SELECT ONLY", "SELECT DISTINCT", "SELECT DIFFERENT"],
                answer: 2
            },
            {
                question: "5. Which of these is not an aggregate function?",
                options: ["COUNT()", "MAX()", "SUM()", "UPDATE()"],
                answer: 3
            },
            {
                question: "6. What does the `ORDER BY` clause do?",
                options: ["Filters the result set", "Groups the result set", "Sorts the result set", "Joins tables"],
                answer: 2
            },
            {
                question: "7. Which keyword is used to sort results in descending order?",
                options: ["DESC", "ASC", "TOP", "ORDER"],
                answer: 0
            },
            {
                question: "8. Which operator is used to search for a pattern in a column?",
                options: ["IN", "BETWEEN", "LIKE", "EQUALS"],
                answer: 2
            },
            {
                question: "9. Which SQL command is used to add a new column to a table?",
                options: ["ADD COLUMN", "ALTER TABLE ADD COLUMN", "MODIFY COLUMN", "CREATE COLUMN"],
                answer: 1
            },
            {
                question: "10. What is the purpose of a `PRIMARY KEY`?",
                options: ["To uniquely identify each record in a table", "To link to a table in another database", "To sort records", "To store only integer values"],
                answer: 0
            },
            {
                question: "11. Which SQL command is used to delete a table?",
                options: ["DELETE TABLE", "REMOVE TABLE", "DROP TABLE", "TRUNCATE TABLE"],
                answer: 2
            },
            {
                question: "12. Which join returns all rows from both tables, with NULLs for non-matches?",
                options: ["INNER JOIN", "LEFT JOIN", "RIGHT JOIN", "FULL OUTER JOIN"],
                answer: 3
            },
            {
                question: "13. What is the correct syntax to find the average salary from an 'employees' table?",
                options: ["SELECT AVERAGE(salary) FROM employees", "SELECT AVG(salary) FROM employees", "SELECT SUM(salary) / COUNT(*) FROM employees", "SELECT average_salary FROM employees"],
                answer: 1
            },
            {
                question: "14. How do you count the number of rows in a table named 'Orders'?",
                options: ["SELECT COUNT(*) FROM Orders", "SELECT COUNT(Orders)", "SELECT SUM(*) FROM Orders", "SELECT COUNT(rows) FROM Orders"],
                answer: 0
            },
            {
                question: "15. Which SQL clause is used to filter groups of rows created by `GROUP BY`?",
                options: ["WHERE", "FILTER", "HAVING", "GROUP BY"],
                answer: 2
            },
            {
                question: "16. What is a subquery?",
                options: ["A query inside another query", "A query used for aggregation", "A query that updates data", "A query that creates a view"],
                answer: 0
            },
            {
                question: "17. Which operator is used to check for the absence of a value?",
                options: ["IS NOT NULL", "IS NULL", "NOT NULL", "IS NO"],
                answer: 1
            },
            {
                question: "18. What is a `FOREIGN KEY`?",
                options: ["A key that uniquely identifies a record", "A key that links a record to another table", "A key that can't be null", "A key used for primary indexing"],
                answer: 1
            },
            {
                question: "19. Which statement is used to delete all data from a table, but not the table structure?",
                options: ["DELETE * FROM table", "DROP TABLE", "TRUNCATE TABLE", "REMOVE FROM"],
                answer: 2
            },
            {
                question: "20. What is a `VIEW`?",
                options: ["A physical copy of a table", "A virtual table based on a query", "A temporary table", "A collection of stored procedures"],
                answer: 1
            },
            {
                question: "21. How do you select the top 10 records from a table in SQL Server?",
                options: ["SELECT TOP 10 * FROM table", "SELECT FIRST 10 FROM table", "SELECT * FROM table LIMIT 10", "SELECT 10 ROWS FROM table"],
                answer: 0
            },
            {
                question: "22. Which operator is used to combine the result sets of two or more SELECT statements?",
                options: ["UNION", "MERGE", "COMBINE", "JOIN"],
                answer: 0
            },
            {
                question: "23. What is the purpose of `JOIN`?",
                options: ["To delete records from a table", "To combine rows from two or more tables", "To update records in a table", "To sort records"],
                answer: 1
            },
            {
                question: "24. What is the correct way to specify a condition on a column using multiple values?",
                options: ["WHERE column = 'val1' OR 'val2'", "WHERE column IN ('val1', 'val2')", "WHERE column LIKE 'val1' AND 'val2'", "WHERE column BETWEEN 'val1' AND 'val2'"],
                answer: 1
            },
            {
                question: "25. Which SQL command is used to modify existing data in a table?",
                options: ["INSERT", "UPDATE", "CHANGE", "ALTER"],
                answer: 1
            },
            {
                question: "26. What does `COUNT(DISTINCT column_name)` do?",
                options: ["Counts all rows in the table", "Counts the number of unique values in the column", "Counts the number of non-null values", "Counts the number of duplicated values"],
                answer: 1
            },
            {
                question: "27. Which of the following clauses is executed first in a `SELECT` statement?",
                options: ["SELECT", "FROM", "WHERE", "ORDER BY"],
                answer: 1
            },
            {
                question: "28. What is an alias in SQL?",
                options: ["A temporary name for a table or column", "A different name for a database", "A different name for a user", "A function"],
                answer: 0
            },
            {
                question: "29. Which operator is used to combine two or more conditions?",
                options: ["JOIN", "AND", "OR", "BOTH"],
                answer: 1
            },
            {
                question: "30. What does the `INNER JOIN` keyword return?",
                options: ["All rows from the first table", "All rows from both tables", "Matching rows from both tables", "All rows from the second table"],
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
                        <label for="${optionId}" class="flex items-center p-4 rounded-xl cursor-pointer transition-colors duration-200 ease-in-out hover:bg-gray-100">
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