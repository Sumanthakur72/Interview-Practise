<?php include '../includes/sidebar.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Advanced SQL Quiz</title>
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
            class="bg-white rounded-[2rem] shadow-xl p-8 max-w-3xl w-full flex flex-col items-center transition-all duration-300 ease-in-out">

            <!-- Quiz Section -->
            <div id="quiz-section" class="flex flex-col items-center w-full">
                <div class="text-center mb-8">
                    <h1 class="text-4xl font-bold text-gray-900">Advanced SQL Quiz</h1>
                    <p class="text-lg text-gray-600 mt-3">Test your knowledge with these 30 advanced SQL questions.</p>
                </div>
                <div class="w-full bg-gray-50 rounded-2xl p-6 shadow-md">
                    <p class="text-xl font-medium text-gray-900 mb-3" id="question-text"></p>
                    <form id="options-form" class="flex flex-col">
                        <!-- Options will be dynamically added here -->
                    </form>
                </div>
                <button
                    class="bg-gradient-to-br from-indigo-600 to-indigo-800 text-white py-3 px-10 rounded-full font-semibold border-none cursor-pointer shadow-lg transition-all duration-200 ease-in-out mt-5 hover:from-indigo-700 hover:to-indigo-900 active:translate-y-0 active:shadow-md"
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
                question: "1. Which window function assigns a unique, consecutive integer to each row in a partition, with no gaps in the ranking?",
                options: ["ROW_NUMBER()", "RANK()", "DENSE_RANK()", "NTILE()"],
                answer: 0
            },
            {
                question: "2. What is a Common Table Expression (CTE) primarily used for?",
                options: ["To create a temporary, named result set that can be referenced within a SELECT, INSERT, UPDATE, or DELETE statement.", "To store a permanent table in the database.", "To define a view that cannot be modified.", "To improve query performance by creating an index."],
                answer: 0
            },
            {
                question: "3. The `ROLLUP` operator is an extension to `GROUP BY`. What does it do?",
                options: ["It performs a simple group by and sorts the results.", "It generates subtotals for a set of grouping columns, along with a grand total.", "It creates a temporary table with the aggregated results.", "It is a synonym for GROUP BY."],
                answer: 1
            },
            {
                question: "4. A correlated subquery is a subquery that references a column from the outer query. When does it execute?",
                options: ["Only once, before the outer query runs.", "Once for each row processed by the outer query.", "Only if the outer query returns a single row.", "Never, it is a syntax error."],
                answer: 1
            },
            {
                question: "5. What is the main purpose of the `CASE` statement in SQL?",
                options: ["To define a new column in a table.", "To perform conditional logic and return a value based on a condition.", "To create a stored procedure.", "To handle errors in a query."],
                answer: 1
            },
            {
                question: "6. Which function is used to return a value from a preceding row in the same result set?",
                options: ["LAG()", "LEAD()", "ROW_NUMBER()", "FIRST_VALUE()"],
                answer: 0
            },
            {
                question: "7. In the context of a `CASE` statement, what does the `WHEN` clause specify?",
                options: ["The condition to be evaluated.", "The value to be returned if the condition is true.", "The default value if no conditions are met.", "The starting point of the statement."],
                answer: 0
            },
            {
                question: "8. A recursive CTE is typically used to query what kind of data?",
                options: ["Time-series data.", "Hierarchical data, such as organizational charts or parts lists.", "Spatial data.", "Text data."],
                answer: 1
            },
            {
                question: "9. Which set operation returns all rows that are in both the first and second result sets?",
                options: ["UNION", "UNION ALL", "INTERSECT", "EXCEPT"],
                answer: 2
            },
            {
                question: "10. Which of the following is an ACID property of a database transaction?",
                options: ["Accessibility", "Consistency", "Concurrency", "Causality"],
                answer: 1
            },
            {
                question: "11. What is the primary benefit of creating an index on a table column?",
                options: ["It prevents duplicate values from being inserted.", "It encrypts the data for security.", "It speeds up data retrieval operations on that column.", "It reduces the storage size of the table."],
                answer: 2
            },
            {
                question: "12. The `OVER()` clause is used with what type of SQL functions?",
                options: ["Aggregate functions", "String functions", "Mathematical functions", "Window functions"],
                answer: 3
            },
            {
                question: "13. What is the key difference between `RANK()` and `DENSE_RANK()` window functions?",
                options: ["`RANK()` assigns a unique number to each row, while `DENSE_RANK()` does not.", "`DENSE_RANK()` leaves gaps in the rank for ties, while `RANK()` does not.", "`RANK()` leaves gaps in the rank for ties, while `DENSE_RANK()` does not.", "`DENSE_RANK()` is used only for numeric data."],
                answer: 2
            },
            {
                question: "14. A `VIEW` in SQL is a:",
                options: ["A physical copy of a table.", "A temporary table that exists only for the duration of a session.", "A virtual table based on the result-set of a SQL query.", "A stored program with input parameters."],
                answer: 2
            },
            {
                question: "15. What is the purpose of the `PIVOT` operator?",
                options: ["To convert the unique values from one column into multiple columns.", "To combine rows from two or more tables.", "To perform a group by on multiple columns.", "To reverse a table's columns and rows."],
                answer: 0
            },
            {
                question: "16. Which of the following is a drawback of using a stored procedure?",
                options: ["It cannot accept input parameters.", "It can lead to slower query performance.", "It is only available on one database system.", "It can make code harder to debug and manage for complex logic."],
                answer: 3
            },
            {
                question: "17. What is the function of the `EXPLAIN` statement?",
                options: ["To execute a query and return the result set.", "To provide a detailed plan of how a database engine will execute a query.", "To create a new view from a query.", "To log all executed queries."],
                answer: 1
            },
            {
                question: "18. What is a transaction in a database?",
                options: ["A single SQL command.", "A collection of SQL statements that are treated as a single unit of work.", "A long-running process that runs in the background.", "A trigger that fires on a specific event."],
                answer: 1
            },
            {
                question: "19. Which window function is used to return a value from a subsequent row?",
                options: ["LAG()", "LEAD()", "ROW_NUMBER()", "NTH_VALUE()"],
                answer: 1
            },
            {
                question: "20. The `CUBE` operator, an extension of `GROUP BY`, generates subtotals for:",
                options: ["Only the first specified column.", "Only the last specified column.", "All possible combinations of the specified grouping columns.", "A single grand total."],
                answer: 2
            },
            {
                question: "21. A `CHECK` constraint is used to:",
                options: ["Ensure that all values in a column are unique.", "Limit the data type of a column.", "Enforce a condition that all values in a column must satisfy.", "Define a primary key."],
                answer: 2
            },
            {
                question: "22. What is the main difference between `UNION` and `UNION ALL`?",
                options: ["`UNION` is faster because it does not remove duplicate rows.", "`UNION ALL` removes duplicate rows, while `UNION` does not.", "`UNION` removes duplicate rows, while `UNION ALL` includes them.", "There is no functional difference."],
                answer: 2
            },
            {
                question: "23. Which function is used to rank rows within a partition, with ties receiving the same rank and the next rank being the next consecutive number?",
                options: ["RANK()", "DENSE_RANK()", "ROW_NUMBER()", "NTILE()"],
                answer: 1
            },
            {
                question: "24. What is a `Trigger` in a database?",
                options: ["A manual command to start a process.", "A special type of stored procedure that is executed automatically when a specified event occurs on a table.", "A predefined query that runs every minute.", "A scheduled task for data backup."],
                answer: 1
            },
            {
                question: "25. Which of the following is a key reason to use a Correlated Subquery?",
                options: ["To perform a complex join on multiple tables.", "To return a single value from a list of values.", "To process data on a row-by-row basis.", "To replace a simple `WHERE` clause."],
                answer: 2
            },
            {
                question: "26. What does `NTILE(n)` do?",
                options: ["Divides the result set into 'n' groups and assigns an integer rank to each group.", "Counts the number of rows in the result set.", "Returns the nth row of a partition.", "Assigns a rank to each row based on its value."],
                answer: 0
            },
            {
                question: "27. When is a `Recursive CTE` most useful?",
                options: ["When a query needs to be repeated multiple times.", "When you need to perform calculations on nested data.", "When a query needs to process hierarchical data of an unknown depth.", "When you need to create a temporary table for a join."],
                answer: 2
            },
            {
                question: "28. The `FOR XML PATH` clause in SQL Server is often used to:",
                options: ["Export data to an XML file.", "Import XML data into a table.", "Aggregate string data from multiple rows into a single string.", "Create an XML schema from a table."],
                answer: 2
            },
            {
                question: "29. What does the term 'idempotent' mean in the context of SQL statements?",
                options: ["The statement returns the same result on every execution.", "The statement can be undone with a single command.", "The statement can be executed multiple times without changing the result beyond the initial execution.", "The statement is guaranteed to be secure."],
                answer: 2
            },
            {
                question: "30. What is a temporary table primarily used for?",
                options: ["To store data permanently in the database.", "To store a temporary result set for a short period of time, typically within a session or a stored procedure.", "To create a backup of a table.", "To replace a view."],
                answer: 1
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
                        <label for="${optionId}" class="flex items-center p-3 rounded-xl cursor-pointer transition-colors duration-200 ease-in-out hover:bg-gray-100">
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