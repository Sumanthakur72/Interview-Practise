<?php include '../includes/sidebar.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SQL Beginner Practice Quiz</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');

        body {
            font-family: 'Inter', sans-serif;
            background-color: #f3f4f6;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 1.5rem;
        }

        .container {
            background-color: #fff;
            border-radius: 2rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            padding: 2rem;
            max-width: 40rem;
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            transition: all 0.3s ease;
        }

        .header {
            text-align: center;
            margin-bottom: 1rem;
        }

        .title {
            font-size: 2rem;
            font-weight: 700;
            color: #1f2937;
        }

        .subtitle {
            font-size: 1rem;
            color: #6b7280;
            margin-top: 0.75rem;
        }

        .quiz-card {
            width: 100%;
            background-color: #f9fafb;
            border-radius: 1.5rem;
            padding: 2.5rem;
            box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.02);
            margin-top: 1rem;
        }

        .question-number {
            font-size: 1.5rem;
            font-weight: 400;
            color: #374151;
            margin-bottom: 0.40rem;
        }

        .question-text {
            font-size: 1rem;
            font-weight: 200;
            color: #1f2937;
            margin-bottom: 1rem;
        }

        .options-list {
            display: flex;
            flex-direction: column;
            /* gap: 1rem; */
        }

        .option-label {
            display: flex;
            align-items: center;
            padding: 1rem;
            /* border: 1px solid #e5e7eb; */
            border-radius: 0.75rem;
            cursor: pointer;
            transition: all 0.2s ease-in-out;
            /* background-color: #fff; */
        }

        .option-label:hover {
            background-color: #f3f4f6;
            border-color: #d1d5db;
        }

        .option-input {
            margin-right: 1rem;
            width: 1.5rem;
            height: 1.5rem;
            accent-color: #3b82f6;
            cursor: pointer;
        }

        .option-text {
            font-weight: 500;
            color: #374151;
            font-size: 1.1rem;
        }

        .btn {
            background: linear-gradient(145deg, #4f46e5, #4338ca);
            color: #fff;
            padding: 0.75rem 2.5rem;
            border-radius: 9999px;
            font-weight: 600;
            border: none;
            cursor: pointer;
            box-shadow: 0 4px 15px rgba(63, 63, 191, 0.2);
            transition: all 0.2s ease-in-out;
            margin-top: 1.5rem;
        }

        .btn:hover {
            background: linear-gradient(145deg, #4338ca, #3e33b5);
            box-shadow: 0 6px 20px rgba(63, 63, 191, 0.3);
            transform: translateY(-2px);
        }

        .btn:active {
            transform: translateY(0);
            box-shadow: 0 2px 10px rgba(63, 63, 191, 0.2);
        }

        .result-container {
            text-align: center;
        }

        .result-title {
            font-size: 2.5rem;
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 1.5rem;
        }

        .result-counts {
            display: flex;
            justify-content: center;
            gap: 2rem;
            margin-bottom: 2.5rem;
            text-align: center;
        }

        .result-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            font-size: 1rem;
            font-weight: 500;
            color: #6b7280;
        }

        .result-number {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .correct-number {
            color: #22c55e;
        }

        .incorrect-number {
            color: #ef4444;
        }

        .skipped-number {
            color: #9ca3af;
        }

        .review-button {
            background: linear-gradient(145deg, #3b82f6, #2563eb);
            box-shadow: 0 4px 15px rgba(59, 130, 246, 0.2);
        }

        .review-button:hover {
            background: linear-gradient(145deg, #2563eb, #1d4ed8);
            box-shadow: 0 6px 20px rgba(59, 130, 246, 0.3);
        }

        .restart-button {
            background: #e5e7eb;
            color: #6b7280;
            box-shadow: 0 4px 15px rgba(156, 163, 175, 0.2);
        }

        .restart-button:hover {
            background: #d1d5db;
            color: #4b5563;
            box-shadow: 0 6px 20px rgba(156, 163, 175, 0.3);
        }

        .review-card {
            width: 100%;
            background-color: #f9fafb;
            border-radius: 1.5rem;
            padding: 2.5rem;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            margin-bottom: 1.5rem;
        }

        .correct-answer {
            color: #10b981;
            font-weight: 700;
        }

        .user-answer {
            font-style: italic;
        }

        .wrong-answer {
            color: #ef4444;
            font-weight: 700;
        }

        .skipped-answer {
            color: #9ca3af;
            font-weight: 700;
        }
    </style>
</head>

<body>
   <main id="mainContent" class="main-content flex-1 min-h-screen flex items-center justify-center">
    <div id="app-container" class="mx-auto w-full max-w-3xl bg-white shadow-lg rounded-3xl p-8">
            <!-- Quiz Section -->
            <div id="quiz-section" class="flex flex-col items-center w-full">
                <div class="header">
                    <h1 class="title">SQL Beginner Practice Quiz</h1>
                    <p class="subtitle">Test your knowledge with these beginner and advanced level questions.</p>
                </div>
                <div class="quiz-card">
                    <p class="question-number" id="question-number"></p>
                    <p class="question-text" id="question-text"></p>
                    <form id="options-form" class="options-list">
                        <!-- Options will be dynamically added here -->
                    </form>
                </div>
                <button class="btn" id="next-btn">Next</button>
            </div>
            <!-- Result Section -->
            <div id="result-section" class="hidden flex-col items-center w-full result-container">
                <div class="header">
                    <h1 class="result-title">Quiz Results</h1>
                    <p class="subtitle" id="total-questions-answered"></p>
                </div>
                <div class="quiz-card">
                    <div class="result-counts">
                        <div class="result-item">
                            <span class="result-number correct-number" id="correct-count"></span>
                            <span>Correct</span>
                        </div>
                        <div class="result-item">
                            <span class="result-number incorrect-number" id="incorrect-count"></span>
                            <span>Incorrect</span>
                        </div>
                        <div class="result-item">
                            <span class="result-number skipped-number" id="skipped-count"></span>
                            <span>Unanswered</span>
                        </div>
                    </div>
                </div>
                <div class="flex flex-col md:flex-row gap-4">
                    <button class="btn review-button" id="review-btn">View Detailed Answers</button>
                    <button class="btn restart-button" id="restart-btn">Try Again</button>
                </div>
            </div>

            <!-- Review Section -->
            <div id="review-section" class="hidden flex-col items-center w-full">
                <div class="header">
                    <h1 class="result-title">Review Answers</h1>
                </div>
                <div id="review-list" class="w-full">
                    <!-- Review cards will be dynamically added here -->
                </div>
                <button class="btn back-button" id="back-to-results-btn">Back to Results</button>
            </div>

        </div>
    </main>
    <script>
        const quizData = [
            {
                question: "What does SQL stand for?",
                options: ["Structured Query Language", "Simple Query Logic", "Sequential Query Language", "System Querying Logic"],
                answer: 0
            },
            {
                question: "Which SQL statement is used to extract data from a database?",
                options: ["SELECT", "GET", "OPEN", "EXTRACT"],
                answer: 0
            },
            {
                question: "Which SQL statement is used to update data in a database?",
                options: ["MODIFY", "SAVE", "CHANGE", "UPDATE"],
                answer: 3
            },
            {
                question: "Which SQL statement is used to delete data from a database?",
                options: ["REMOVE", "ERASE", "DELETE", "CUT"],
                answer: 2
            },
            {
                question: "Which SQL statement is used to insert new data into a database?",
                options: ["ADD", "CREATE", "INSERT INTO", "NEW"],
                answer: 2
            },
            {
                question: "Which clause is used to filter records in a SELECT statement?",
                options: ["FILTER BY", "WHERE", "HAVING", "SEARCH"],
                answer: 1
            },
            {
                question: "Which operator is used to test for a range of values?",
                options: ["IN", "BETWEEN", "RANGE", "LIKE"],
                answer: 1
            },
            {
                question: "Which keyword is used to sort the result-set in ascending order?",
                options: ["DESC", "ORDER", "ASC", "SORT"],
                answer: 2
            },
            {
                question: "Which keyword is used to sort the result-set in descending order?",
                options: ["DESC", "ORDER BY DESC", "SORT DESC", "ASC"],
                answer: 0
            },
            {
                question: "What is the purpose of the GROUP BY clause?",
                options: ["To filter records after an aggregate function has been applied", "To group rows that have the same values into summary rows", "To sort the data", "To join multiple tables"],
                answer: 1
            },
            {
                question: "Which aggregate function finds the highest value?",
                options: ["TOTAL", "ADD", "SUM", "MAX"],
                answer: 3
            },
            {
                question: "Which aggregate function finds the average value?",
                options: ["AVERAGE", "SUM", "TOTAL", "AVG"],
                answer: 3
            },
            {
                question: "Which clause is used with aggregate functions to filter groups?",
                options: ["WHERE", "GROUP BY", "HAVING", "FILTER"],
                answer: 2
            },
            {
                question: "What is a PRIMARY KEY?",
                options: ["A key that can contain duplicate values", "A unique identifier for a record in a table", "A key used to link to another table", "A key that can be null"],
                answer: 1
            },
            {
                question: "Which command is used to create a new table?",
                options: ["CREATE TABLE", "NEW TABLE", "MAKE TABLE", "BUILD TABLE"],
                answer: 0
            },
            {
                question: "Which command is used to delete a table from a database?",
                options: ["REMOVE TABLE", "ERASE TABLE", "DROP TABLE", "DELETE TABLE"],
                answer: 2
            },
            {
                question: "Which command is used to modify the structure of a table?",
                options: ["MODIFY TABLE", "ALTER TABLE", "CHANGE TABLE", "UPDATE TABLE"],
                answer: 1
            },
            {
                question: "What is a FOREIGN KEY?",
                options: ["A key that links two tables together", "A key that must be unique", "A key that cannot be null", "A key used for sorting"],
                answer: 0
            },
            {
                question: "What does COUNT(*) do?",
                options: ["Counts the number of non-null values", "Counts the number of distinct values", "Counts all records in a table", "Counts the number of unique columns"],
                answer: 2
            },
            {
                question: "Which join returns only the matching rows from both tables?",
                options: ["RIGHT JOIN", "LEFT JOIN", "INNER JOIN", "FULL OUTER JOIN"],
                answer: 2
            },
            {
                question: "Which join returns all rows from the left table, and the matched rows from the right table?",
                options: ["RIGHT JOIN", "LEFT JOIN", "INNER JOIN", "FULL OUTER JOIN"],
                answer: 1
            },
            {
                question: "What does LIKE 'A%' mean?",
                options: ["Find any value that ends with 'A'", "Find any value that starts with 'A'", "Find any value that contains 'A'", "Find any value that is exactly 'A'"],
                answer: 1
            },
            {
                question: "Which clause is used to retrieve a specific number of records from the top of the result set?",
                options: ["TOP", "LIMIT (or TOP in SQL Server)", "FIRST", "COUNT"],
                answer: 1
            },
            {
                question: "Which operator is used to combine the result-set of two or more SELECT statements?",
                options: ["JOIN", "MERGE", "COMBINE", "UNION"],
                answer: 3
            },
            {
                question: "What is a VIEW in SQL?",
                options: ["A physical copy of a table", "A virtual table based on the result-set of an SQL statement", "A temporary table", "A database user's screen"],
                answer: 1
            },
            {
                question: "What is the purpose of the DISTINCT keyword?",
                options: ["To count the number of rows", "To sort the result-set", "To return only unique values", "To filter the results"],
                answer: 2
            },
            {
                question: "Which command is used to add a new column to a table?",
                options: ["ALTER TABLE ... ADD COLUMN", "UPDATE TABLE ... ADD COLUMN", "MODIFY TABLE ... ADD COLUMN", "NEW COLUMN"],
                answer: 0
            },
            {
                question: "What is a NULL value in SQL?",
                options: ["A value of zero", "An empty string", "A value that is not available, unknown, or not applicable", "C and B are correct"],
                answer: 2
            },
            {
                question: "Which command is used to delete all rows from a table but not the table itself?",
                options: ["DELETE FROM table_name", "TRUNCATE TABLE table_name", "DROP TABLE table_name", "ERASE TABLE table_name"],
                answer: 1
            },
            {
                question: "What is an SQL injection?",
                options: ["A type of database backup", "A way to speed up queries", "A code injection technique used to attack data-driven applications", "A method for adding new data to a database"],
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
                document.getElementById('question-number').innerText = `Question ${currentQuestionIndex + 1}`;
                document.getElementById('question-text').innerText = currentQuestion.question;

                const optionsForm = document.getElementById('options-form');
                optionsForm.innerHTML = '';
                currentQuestion.options.forEach((option, index) => {
                    const optionId = `q${currentQuestionIndex}-option${index}`;
                    const isChecked = userAnswers[currentQuestionIndex] === index;
                    optionsForm.innerHTML += `
                        <label for="${optionId}" class="option-label">
                            <input type="radio" id="${optionId}" name="question${currentQuestionIndex}" value="${index}" class="option-input" ${isChecked ? 'checked' : ''}>
                            <span class="option-text">${option}</span>
                        </label>
                    `;
                });

                if (currentQuestionIndex === quizData.length - 1) {
                    nextBtn.innerText = "Show Result";
                } else {
                    nextBtn.innerText = "Next";
                }

                // Add an event listener to update userAnswers on option change
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

            document.getElementById('total-questions-answered').innerHTML = `You answered **${correctCount + incorrectCount}** questions out of **${quizData.length}**.`;
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
                    statusClass = 'skipped-answer';
                } else if (userAnswerIndex === correctAnswerIndex) {
                    statusText = 'Your answer is correct.';
                    statusClass = 'correct-answer';
                } else {
                    statusText = `Your answer is incorrect. The correct answer is: `;
                    statusClass = 'wrong-answer';
                }

                reviewList.innerHTML += `
                    <div class="review-card">
                        <p class="question-number">Question ${index + 1}</p>
                        <p class="question-text">${question.question}</p>
                        <p class="mb-2">
                            <span class="${statusClass}">${statusText}</span>
                            ${userAnswerIndex !== correctAnswerIndex ? `<span class="correct-answer">${question.options[correctAnswerIndex]}</span>` : ''}
                        </p>
                        ${userAnswerIndex !== null ? `<p class="user-answer">Your choice: ${question.options[userAnswerIndex]}</p>` : ''}
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
