<?php include '../includes/sidebar.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SQL Joins Quiz</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-100 flex justify-center items-center min-h-screen p-6">
     <main id="mainContent" class="main-content flex-1 min-h-screen flex items-center justify-center">
    <div id="app-container" class="bg-white rounded-[2rem] shadow-xl p-8 max-w-3xl w-full flex flex-col items-center transition-all duration-300 ease-in-out">
        <!-- Quiz Section -->
        <div id="quiz-section" class="flex flex-col items-center w-full">
            <div class="text-center mb-8">
                <h1 class="text-4xl font-bold text-gray-900">SQL Joins Quiz</h1>
                <p class="text-lg text-gray-600 mt-3">Test your knowledge with these 30 questions on SQL Joins.</p>
            </div>
            <div class="w-full bg-gray-50 rounded-2xl p-5 shadow-md">
                <p class="text-xl font-medium text-gray-900 mb-1" id="question-text"></p>
                <form id="options-form" class="flex flex-col">
                    <!-- Options will be dynamically added here -->
                </form>
            </div>
            <button class="bg-gradient-to-br from-indigo-600 to-indigo-800 text-white py-3 px-10 rounded-full font-semibold border-none cursor-pointer shadow-lg transition-all duration-200 ease-in-out mt-6 hover:from-indigo-700 hover:to-indigo-900 active:translate-y-0 active:shadow-md" id="next-btn">Next</button>
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
                <button class="bg-gradient-to-br from-blue-500 to-blue-700 hover:from-blue-600 hover:to-blue-800 text-white py-3 px-10 rounded-full font-semibold border-none cursor-pointer shadow-lg transition-all duration-200 ease-in-out hover:-translate-y-0.5 active:translate-y-0 active:shadow-md" id="review-btn">View Detailed Answers</button>
                <button class="bg-gray-200 text-gray-600 py-3 px-10 rounded-full font-semibold border-none cursor-pointer shadow-md transition-all duration-200 ease-in-out hover:bg-gray-300 hover:text-gray-700 hover:-translate-y-0.5 active:translate-y-0 active:shadow" id="restart-btn">Try Again</button>
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
            <button class="bg-gradient-to-br from-indigo-600 to-indigo-800 text-white py-3 px-10 rounded-full font-semibold border-none cursor-pointer shadow-lg transition-all duration-200 ease-in-out mt-10 hover:from-indigo-700 hover:to-indigo-900 active:translate-y-0 active:shadow-md" id="back-to-results-btn">Back to Results</button>
        </div>
    </div>
</main>
    <script>
        const quizData = [
            {
                question: "1. Which of the following is the default type of JOIN in SQL?",
                options: ["INNER JOIN", "LEFT JOIN", "RIGHT JOIN", "FULL OUTER JOIN"],
                answer: 0
            },
            {
                question: "2. A LEFT JOIN returns all rows from the left table, and the matching rows from the right table. What is returned for non-matching rows from the right table?",
                options: ["Empty strings", "NULL values", "Zeroes", "An error"],
                answer: 1
            },
            {
                question: "3. Which type of join is equivalent to LEFT JOIN and RIGHT JOIN combined, and returns all records when there is a match in either table?",
                options: ["FULL JOIN", "CROSS JOIN", "SELF JOIN", "OUTER JOIN"],
                answer: 0
            },
            {
                question: "4. How would you join two tables, Employees and Departments, on their common column DepartmentID?",
                options: ["SELECT * FROM Employees JOIN Departments ON Employees.DepartmentID = Departments.DepartmentID", "SELECT * FROM Employees JOIN Departments WHERE Employees.DepartmentID = Departments.DepartmentID", "SELECT * FROM Employees JOIN Departments USING (DepartmentID)", "A and C"],
                answer: 3
            },
            {
                question: "5. A CROSS JOIN is also known as a:",
                options: ["Equi-join", "Natural join", "Cartesian product", "Outer join"],
                answer: 2
            },
            {
                question: "6. In a SELF JOIN, a table is joined with itself. What is a crucial part of this query's syntax?",
                options: ["Using aliases for the table", "Using the SELF keyword", "Specifying a PRIMARY KEY", "Using a FOREIGN KEY"],
                answer: 0
            },
            {
                question: "7. Which join is used to return only the rows that have a match in both tables?",
                options: ["INNER JOIN", "LEFT JOIN", "RIGHT JOIN", "FULL OUTER JOIN"],
                answer: 0
            },
            {
                question: "8. What is the purpose of the ON clause in a JOIN statement?",
                options: ["To specify which columns to select", "To filter rows after the join", "To specify the join condition", "To order the results"],
                answer: 2
            },
            {
                question: "9. Which join is used to return all rows from the Departments table and only the matching rows from the Employees table?",
                options: ["INNER JOIN", "LEFT JOIN ON Departments", "RIGHT JOIN ON Employees", "RIGHT JOIN"],
                answer: 3
            },
            {
                question: "10. What is a NATURAL JOIN?",
                options: ["A join that combines all columns", "A join based on columns with the same name and data type", "A join that returns all rows", "A join that is not an INNER JOIN"],
                answer: 1
            },
            {
                question: "11. What is the main difference between WHERE and ON in a JOIN statement?",
                options: ["WHERE is for filtering after the join, ON is for specifying the join condition", "ON is for filtering, WHERE is for specifying the join condition", "They are interchangeable", "ON is for single-table queries, WHERE is for joins"],
                answer: 0
            },
            {
                question: "12. Which type of join can be written using a WHERE clause instead of the JOIN and ON syntax?",
                options: ["INNER JOIN", "LEFT JOIN", "RIGHT JOIN", "FULL OUTER JOIN"],
                answer: 0
            },
            {
                question: "13. What is the result of a LEFT JOIN when the join column in the right table has no matching value?",
                options: ["The row from the left table is excluded", "NULLs are returned for the right table's columns", "The row is duplicated", "An error is returned"],
                answer: 1
            },
            {
                question: "14. How does a FULL OUTER JOIN handle non-matching rows from both tables?",
                options: ["It excludes them", "It returns NULLs for the columns from the non-matching side", "It only includes matches", "It returns a single row with NULLs"],
                answer: 1
            },
            {
                question: "15. What kind of join is the following query: SELECT * FROM T1, T2;",
                options: ["INNER JOIN", "LEFT JOIN", "RIGHT JOIN", "CROSS JOIN"],
                answer: 3
            },
            {
                question: "16. When a RIGHT JOIN is performed, which table's rows are guaranteed to be in the result set?",
                options: ["The left table", "The right table", "Both tables", "Neither table"],
                answer: 1
            },
            {
                question: "17. How would you find all employees who do not belong to a department, using a LEFT JOIN?",
                options: ["JOIN with WHERE DepartmentID IS NOT NULL", "JOIN with WHERE DepartmentID IS NULL", "LEFT JOIN with WHERE DepartmentID IS NOT NULL", "LEFT JOIN with WHERE DepartmentID IS NULL"],
                answer: 3
            },
            {
                question: "18. What is the main purpose of a SELF JOIN?",
                options: ["To join a table with itself for hierarchical data", "To join multiple tables with a single query", "To join tables on columns with different names", "To improve query performance"],
                answer: 0
            },
            {
                question: "19. Which of the following is a common use case for a FULL OUTER JOIN?",
                options: ["Finding common records between two tables", "Listing all records from a single table", "Comparing two tables and finding both matches and non-matches", "Joining a table to itself"],
                answer: 2
            },
            {
                question: "20. What is a key characteristic of INNER JOIN?",
                options: ["It returns all rows from the first table", "It requires an ON clause to be specified", "It excludes rows that do not have a match in the other table", "It is the only join type that can be used with WHERE"],
                answer: 2
            },
            {
                question: "21. Which join type would you use to get a list of all products and their associated suppliers, even if some products don't have a supplier yet?",
                options: ["INNER JOIN", "LEFT JOIN", "RIGHT JOIN", "FULL OUTER JOIN"],
                answer: 1
            },
            {
                question: "22. If you have a Customers table and an Orders table, and you want to see all customers and their orders, including customers who have not placed any orders, which join would you use?",
                options: ["INNER JOIN", "LEFT JOIN", "RIGHT JOIN", "FULL OUTER JOIN"],
                answer: 1
            },
            {
                question: "23. A RIGHT JOIN is conceptually the same as:",
                options: ["An INNER JOIN", "A LEFT JOIN with the table order reversed", "A FULL OUTER JOIN", "A CROSS JOIN"],
                answer: 1
            },
            {
                question: "24. What will this query do: SELECT * FROM T1, T2 WHERE T1.ID = T2.ID;?",
                options: ["It's an invalid query", "It performs a CROSS JOIN", "It performs an INNER JOIN", "It performs a LEFT JOIN"],
                answer: 2
            },
            {
                question: "25. Which join produces a result set that is the Cartesian product of the two tables?",
                options: ["INNER JOIN", "LEFT JOIN", "RIGHT JOIN", "CROSS JOIN"],
                answer: 3
            },
            {
                question: "26. When might you use a FULL OUTER JOIN?",
                options: ["To find all matching records between two tables", "To combine data from two tables and keep all records, whether they have a match or not", "To return only records from the left table", "To return all records from the right table"],
                answer: 1
            },
            {
                question: "27. What is a key difference between LEFT JOIN and INNER JOIN?",
                options: ["LEFT JOIN is faster", "INNER JOIN is more flexible", "LEFT JOIN returns all rows from the left table, while INNER JOIN only returns matching rows", "There is no difference"],
                answer: 2
            },
            {
                question: "28. What is the USING clause in a JOIN statement?",
                options: ["A replacement for the ON clause for columns with different names", "A way to filter results", "A shorthand for the ON clause when the join columns have the same name", "A way to specify aliases"],
                answer: 2
            },
            {
                question: "29. Which join type should you use to find records that exist in one table but not the other?",
                options: ["INNER JOIN", "LEFT JOIN with WHERE clause", "RIGHT JOIN", "FULL OUTER JOIN"],
                answer: 1
            },
            {
                question: "30. What is the fundamental difference between INNER JOIN and all other join types?",
                options: ["INNER JOIN requires a condition, others do not", "INNER JOIN is faster", "INNER JOIN returns only matching rows, while others return non-matching rows as well", "INNER JOIN is not a standard SQL join"],
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
                        <label for="${optionId}" class="flex items-center p-4  rounded-xl cursor-pointer transition-colors duration-200 ease-in-out hover:bg-gray-100">
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
