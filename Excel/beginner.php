<?php include '../includes/sidebar.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Excel Practice Quiz</title>
    <!-- Load Inter font from Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <!-- Load Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        .red-highlight {
            background-color: #fee2e2;
            border-color: #fca5a5;
        }

        .correct-answer {
            background-color: #d1fae5;
            border-color: #6ee7b7;
        }

        .selected-option {
            background-color: #e0f2fe;
            border-color: #60a5fa;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }
    </style>
</head>

<body class="bg-slate-50">
    <main id="mainContent" class="main-content flex-1 min-h-screen">
        <div class="flex items-center justify-center min-h-screen">

            <div id="quiz-container"
                class="bg-white md:p-12 rounded-3xl shadow-2xl w-full max-w-3xl border border-gray-200 mr-[200px]">

                <h1 class="text-3xl md:text-4xl font-bold text-center text-gray-900 mb-4">
                    Excel Beginner Practice Quiz
                </h1>
                <p class="text-center text-gray-500 mb-8">
                    Test your knowledge with these beginner and advanced level questions.
                </p>

                <form id="quizForm" method="POST">
                    <div id="quizQuestions" class="space-y-5"></div>
                    <div class="mt-8 flex justify-center space-x-4"></div>
                </form>
            </div>
        </div>
    </main>

    <!-- JavaScript code -->
    <script>
        // Questions and answers data stored in a JavaScript array
        const questions = [
            { id: 1, question: "What is the shortcut key for 'Save As' in Excel?", options: ["F12", "Ctrl + S", "Alt + F4", "Shift + S"], answer: "F12" },
            { id: 2, question: "What is the correct format of the sum function in Excel?", options: ["SUM(A1:A5)", "=SUM(A1:A5)", "ADD(A1:A5)", "=ADD(A1:A5)"], answer: "=SUM(A1:A5)" },
            { id: 3, question: "In which menu can you find Conditional Formatting?", options: ["Insert", "View", "Home", "Data"], answer: "Home" },
            { id: 4, question: "What is the shortcut to start a new line within a cell?", options: ["Ctrl + Enter", "Alt + Enter", "Shift + Enter", "Enter"], answer: "Alt + Enter" },
            { id: 5, question: "What do you use to arrange data in alphabetical order?", options: ["Format", "Sort", "Filter", "Table"], answer: "Sort" },
            { id: 6, question: "What is the use of VLOOKUP?", options: ["To search data horizontally", "To search data vertically", "To delete data", "To format data"], answer: "To search data vertically" },
            { id: 7, question: "Which option is used to freeze (lock) a row?", options: ["Freeze Panes", "Freeze Rows", "Freeze Cells", "Lock Panes"], answer: "Freeze Panes" },
            { id: 8, question: "Which menu is used to create a PivotTable?", options: ["Home", "Data", "Review", "Insert"], answer: "Insert" },
            { id: 9, question: "What is the shortcut to enter the current date in a cell?", options: ["Ctrl + ;", "Ctrl + :", "Shift + ;", "Alt + ;"], answer: "Ctrl + ;" },
            { id: 10, question: "If you want to display a formula in a cell, what do you type before it?", options: ["#", "=", "@", "$"], answer: "=" },
            { id: 11, question: "What is used to find duplicate values in a column?", options: ["Remove Duplicates", "Conditional Formatting", "Filter", "Data Validation"], answer: "Conditional Formatting" },
            { id: 12, question: "Which menu is used to create a pie chart in Excel?", options: ["Home", "Insert", "Data", "View"], answer: "Insert" },
            { id: 13, question: "Which feature is used to divide data into different categories?", options: ["Sorting", "Filtering", "AutoSum", "Formatting"], answer: "Filtering" },
            { id: 14, question: "What is the use of the COUNTIF function?", options: ["Counts cells", "Counts numbers", "Counts cells based on a condition", "Counts text"], answer: "Counts cells based on a condition" },
            { id: 15, question: "How many worksheets are there in an Excel workbook by default?", options: ["1", "3", "5", "10"], answer: "1" },
            { id: 16, question: "What feature is used to wrap text in a cell?", options: ["Text Wrap", "Wrap Text", "Wrap Cell", "Adjust Text"], answer: "Wrap Text" },
            { id: 17, question: "Which sign is used to create an absolute cell reference?", options: ["#", "@", "$", "&"], answer: "$" },
            { id: 18, question: "What is the use of the MAX function?", options: ["Finds the smallest value", "Finds the largest value", "Finds the average value", "Sums the values"], answer: "Finds the largest value" },
            { id: 19, question: "What is the shortcut to copy a cell in Excel?", options: ["Ctrl + X", "Ctrl + V", "Ctrl + C", "Ctrl + P"], answer: "Ctrl + C" },
            { id: 20, question: "After the lookup value, what comes next in the VLOOKUP function?", options: ["Table array", "Column index number", "Range lookup", "Cell reference"], answer: "Table array" },
            { id: 21, question: "To which software package do PowerPoint, Word, and Excel belong?", options: ["Google Suite", "Adobe Creative Cloud", "Microsoft Office", "iWork"], answer: "Microsoft Office" },
            { id: 22, question: "In a spreadsheet, how are rows identified?", options: ["Letters (A, B, C)", "Numbers (1, 2, 3)", "Both A and B", "Symbols (@, #, $)"], answer: "Numbers (1, 2, 3)" },
            { id: 23, question: "What is the shortcut to paste a cell in Excel?", options: ["Ctrl + C", "Ctrl + V", "Ctrl + P", "Ctrl + X"], answer: "Ctrl + V" },
            { id: 24, question: "Which key is used to edit a formula in a cell?", options: ["F1", "F2", "F3", "F4"], answer: "F2" },
            { id: 25, question: "What is the default name of a worksheet?", options: ["Sheet1", "Book1", "Worksheet1", "Page1"], answer: "Sheet1" },
            { id: 26, question: "What is the shortcut to bold text in Excel?", options: ["Ctrl + B", "Ctrl + I", "Ctrl + U", "Ctrl + A"], answer: "Ctrl + B" },
            { id: 27, question: "How are columns identified?", options: ["Numbers", "Letters", "Both", "Symbols"], answer: "Letters" },
            { id: 28, question: "What is the use of the COUNT function in Excel?", options: ["To count numbers", "To count cells", "To count text", "To count blank cells"], answer: "To count numbers" },
            { id: 29, question: "To avoid typing a formula repeatedly, what do we use?", options: ["Cell Format", "AutoFill", "Filter", "Sort"], answer: "AutoFill" },
            { id: 30, question: "What is the use of the IF function?", options: ["To add data", "To compare values", "To find the average", "To format text"], answer: "To compare values" }
        ];

        let currentQuestionIndex = 0;
        let submittedAnswers = {};

        // Function to render a single question
        function renderQuizQuestion(index) {
            const quizQuestionsContainer = document.getElementById('quizQuestions');
            const buttonsContainer = document.querySelector('.mt-8.flex.justify-center.space-x-4');

            quizQuestionsContainer.innerHTML = '';
            buttonsContainer.innerHTML = '';

            const q = questions[index];
            if (!q) return;

            const questionDiv = document.createElement('div');
            questionDiv.className = 'bg-gray-50 p-6 rounded-2xl shadow-inner border border-gray-200 transition-all duration-300';

            const questionText = document.createElement('p');
            questionText.className = 'text-lg font-semibold text-gray-800 mb-4';
            questionText.innerText = `${index + 1}. ${q.question}`;
            questionDiv.appendChild(questionText);

            const optionsDiv = document.createElement('div');
            optionsDiv.className = 'space-y-3';
            q.options.forEach(option => {
                const label = document.createElement('label');
                label.className = 'flex items-center p-3 rounded-xl cursor-pointer transition-all duration-200 hover:bg-gray-200';

                const radioInput = document.createElement('input');
                radioInput.type = 'radio';
                radioInput.name = `q${q.id}`;
                radioInput.value = option;
                radioInput.className = 'h-5 w-5 text-blue-600 border-gray-300 focus:ring-2 focus:ring-blue-500';

                const spanText = document.createElement('span');
                spanText.className = 'ml-3 text-gray-700 text-base';
                spanText.innerText = option;

                if (submittedAnswers[`q${q.id}`] === option) {
                    label.classList.add('selected-option');
                    radioInput.checked = true;
                }

                radioInput.addEventListener('change', () => {
                    const allLabelsForQuestion = questionDiv.querySelectorAll('label');
                    allLabelsForQuestion.forEach(lbl => lbl.classList.remove('selected-option'));
                    label.classList.add('selected-option');
                });

                label.appendChild(radioInput);
                label.appendChild(spanText);
                optionsDiv.appendChild(label);
            });

            questionDiv.appendChild(optionsDiv);
            quizQuestionsContainer.appendChild(questionDiv);

            // Render 'Next' or 'Submit' button
            const nextButton = document.createElement('button');
            nextButton.type = 'button';
            nextButton.className = 'bg-blue-600 text-white font-semibold py-3 px-6 rounded-full shadow-lg hover:bg-blue-700 transition-all duration-300';

            if (index < questions.length - 1) {
                nextButton.innerText = 'Next';
                nextButton.onclick = handleNext;
            } else {
                nextButton.innerText = 'Submit Answers';
                nextButton.onclick = handleSubmit;
            }
            buttonsContainer.appendChild(nextButton);
        }

        function handleNext() {
            const currentQuestionId = questions[currentQuestionIndex].id;
            const selectedOption = document.querySelector(`input[name="q${currentQuestionId}"]:checked`);

            if (selectedOption) {
                submittedAnswers[`q${currentQuestionId}`] = selectedOption.value;
            } else {
                submittedAnswers[`q${currentQuestionId}`] = null;
            }

            if (currentQuestionIndex < questions.length - 1) {
                currentQuestionIndex++;
                renderQuizQuestion(currentQuestionIndex);
            }
        }

        function handleSubmit() {
            // Save the answer for the last question
            const currentQuestionId = questions[currentQuestionIndex].id;
            const selectedOption = document.querySelector(`input[name="q${currentQuestionId}"]:checked`);

            if (selectedOption) {
                submittedAnswers[`q${currentQuestionId}`] = selectedOption.value;
            } else {
                submittedAnswers[`q${currentQuestionId}`] = null;
            }

            renderResults(submittedAnswers);
        }

        // Function to display summary results
        function renderResults(answers) {
            let correctCount = 0;
            let answeredCount = 0;

            questions.forEach(q => {
                const submittedAnswer = answers[`q${q.id}`];
                if (submittedAnswer !== null) {
                    answeredCount++;
                    if (submittedAnswer === q.answer) {
                        correctCount++;
                    }
                }
            });

            const incorrectCount = answeredCount - correctCount;

            const resultsHTML = `
                <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4 text-center">
                    Quiz Results
                </h1>
                <p class="text-lg text-gray-500 mb-4 text-center">
                    You answered **${answeredCount}** questions out of **30**.
                </p>
                <div class="flex justify-center items-center space-x-6 mb-8">
                    <div class="text-center">
                        <p class="text-4xl font-bold text-green-600">${correctCount}</p>
                        <p class="text-sm text-gray-500">Correct</p>
                    </div>
                    <div class="text-center">
                        <p class="text-4xl font-bold text-red-600">${incorrectCount}</p>
                        <p class="text-sm text-gray-500">Incorrect</p>
                    </div>
                    <div class="text-center">
                        <p class="text-4xl font-bold text-gray-600">${30 - answeredCount}</p>
                        <p class="text-sm text-gray-500">Unanswered</p>
                    </div>
                </div>
                <div class="mt-8 text-center flex flex-col md:flex-row justify-center space-y-4 md:space-y-0 md:space-x-4">
                    <button onclick="renderDetailedResults(${JSON.stringify(answers).replace(/"/g, '&quot;')})" class="bg-blue-600 text-white font-semibold py-3 px-6 rounded-full shadow-lg hover:bg-blue-700 transition-all duration-300">
                        View Detailed Answers
                    </button>
                    <button onclick="window.location.reload()" class="bg-gray-400 text-white font-semibold py-3 px-6 rounded-full shadow-lg hover:bg-gray-500 transition-all duration-300">
                        Try Again
                    </button>
                </div>
            `;

            document.getElementById('quiz-container').innerHTML = resultsHTML;
        }

        // Function to display detailed results
        window.renderDetailedResults = function (answers) { // Global function for onclick
            const resultsHTML = `
                <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4 text-center">
                    Detailed Answers
                </h1>
                <p class="text-center text-gray-500 mb-8">
                    Review your answers below.
                </p>

                <div class="space-y-6 text-left">
                ${questions.map(q => {
                const submittedAnswer = answers[`q${q.id}`];
                let highlightClass = '';
                let statusText = 'Unanswered';
                let statusColor = 'text-gray-500';

                if (submittedAnswer !== null) {
                    if (submittedAnswer === q.answer) {
                        highlightClass = 'correct-answer';
                        statusText = 'Correct Answer';
                        statusColor = 'text-green-600';
                    } else {
                        highlightClass = 'red-highlight';
                        statusText = 'Incorrect Answer';
                        statusColor = 'text-red-600';
                    }
                }

                return `
                        <div class="bg-white p-6 rounded-2xl shadow-md border border-gray-200 transition-all duration-300 ${highlightClass}">
                            <p class="text-lg font-semibold text-gray-800 mb-2">
                                ${q.id}. ${q.question}
                            </p>
                            <p class="${statusColor} text-sm mb-2 font-bold">${statusText}</p>
                            <div class="space-y-2 mt-4">
                                ${q.options.map(option => {
                    let optionClass = '';
                    if (option === q.answer) {
                        optionClass = 'font-semibold text-green-700';
                    } else if (option === submittedAnswer) {
                        optionClass = 'font-semibold text-red-700';
                    }
                    return `
                                        <div class="p-3 rounded-md border border-transparent ${optionClass}">
                                            ${option}
                                        </div>
                                    `;
                }).join('')}
                            </div>
                        </div>
                    `;
            }).join('')}
                </div>
                <div class="mt-8 text-center">
                    <button onclick="window.location.reload()" class="bg-blue-600 text-white font-semibold py-3 px-6 rounded-full shadow-lg hover:bg-blue-700 transition-all duration-300">
                        Try Again
                    </button>
                </div>
            `;

            document.getElementById('quiz-container').innerHTML = resultsHTML;
        }

        // Wait for the DOM content to load
        document.addEventListener('DOMContentLoaded', () => {
            renderQuizQuestion(currentQuestionIndex);
        });
    </script>
</body>

</html>