<?php include '../includes/sidebar.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Intermediate-Advanced Excel Quiz</title>
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

<body class="bg-slate-50 ">
    <main id="mainContent" class="main-content flex-1 min-h-screen">
    <div class="min-h-screen flex items-center justify-center">
        <div id="quiz-container"
            class="bg-white p-8 md:p-12 rounded-3xl shadow-2xl w-full max-w-3xl border border-gray-200 mr-[200px]">
            
            <h1 class="text-3xl md:text-4xl font-bold text-center text-gray-900 mb-4">
                Intermediate-Advanced Excel Quiz
            </h1>
            <p class="text-center text-gray-500 mb-8">
                Test your expertise with these intermediate-advanced level questions.
            </p>

            <form id="quizForm" method="POST">
                <div id="quizQuestions" class="space-y-6"></div>
                <div class="mt-8 flex justify-center space-x-4"></div>
            </form>
        </div>
    </div>
</main>


    <!-- JavaScript code -->
    <script>
        // Intermediate-Advanced questions and answers data stored in a JavaScript array
        const questions = [
            { id: 1, question: "Which function is an advanced, flexible replacement for VLOOKUP?", options: ["HLOOKUP", "INDEX/MATCH", "XLOOKUP", "LOOKUP"], answer: "XLOOKUP" },
            { id: 2, question: "What is a 'Slicer' in a PivotTable used for?", options: ["Changing chart colors", "Sorting data in a specific order", "Creating new columns", "Filtering data interactively"], answer: "Filtering data interactively" },
            { id: 3, question: "Which tool would you use to find the optimal input value for a formula to reach a specific goal?", options: ["Solver", "Data Validation", "Goal Seek", "Scenario Manager"], answer: "Goal Seek" },
            { id: 4, question: "The #NAME? error typically means what?", options: ["A formula has a misspelled function name", "A cell reference is invalid", "There is a division by zero", "The data type is incorrect"], answer: "A formula has a misspelled function name" },
            { id: 5, question: "Which function is used to return a unique list of values from a range or array?", options: ["UNIQUE", "SORT", "FILTER", "TEXTJOIN"], answer: "UNIQUE" },
            { id: 6, question: "In a PivotTable, what does the 'Values' field usually contain?", options: ["Rows", "Columns", "Data to be aggregated (sum, count, etc.)", "Filters"], answer: "Data to be aggregated (sum, count, etc.)" },
            { id: 7, question: "What is the purpose of the 'dollar sign ($)' in a cell reference, like in `$A$1`?", options: ["To make the reference relative", "To make the reference absolute", "To indicate currency", "To create a named range"], answer: "To make the reference absolute" },
            { id: 8, question: "What does the `SUMIFS` function do?", options: ["Sums a range if one condition is met", "Sums multiple ranges", "Sums a range if multiple conditions are met", "Counts cells with conditions"], answer: "Sums a range if multiple conditions are met" },
            { id: 9, question: "What is a 'Macro' in Excel?", options: ["A type of chart", "A set of recorded steps or code to automate tasks", "An advanced formula", "A tool for data validation"], answer: "A set of recorded steps or code to automate tasks" },
            { id: 10, question: "What is 'Structured Referencing'?", options: ["Using cell coordinates like A1", "Using the names of tables and columns", "Using relative references only", "Using absolute references only"], answer: "Using the names of tables and columns" },
            { id: 11, question: "The `FILTER` function returns what kind of data?", options: ["A single value", "A filtered range of data", "A list of errors", "The first value that meets a condition"], answer: "A filtered range of data" },
            { id: 12, question: "Which tool is used to perform a 'what-if' analysis by changing multiple inputs to see how they affect a single result?", options: ["Goal Seek", "Scenario Manager", "Data Tables", "Solver"], answer: "Data Tables" },
            { id: 13, question: "The `IFERROR` function is used to handle what kind of output?", options: ["Blank cells", "Text values", "Calculations", "Formula errors"], answer: "Formula errors" },
            { id: 14, question: "What is the main advantage of using an Excel Table over a normal data range?", options: ["It prevents errors", "It automatically expands when new data is added", "It is easier to format", "It can only be used for formulas"], answer: "It automatically expands when new data is added" },
            { id: 15, question: "The `CONCATENATE` function is now largely replaced by which operator?", options: ["&", "#", "@", "%"], answer: "&" },
            { id: 16, question: "Which function is used to join multiple text strings with a delimiter?", options: ["CONCATENATE", "TEXTJOIN", "JOIN", "COMBINE"], answer: "TEXTJOIN" },
            { id: 17, question: "What is the purpose of the `GETPIVOTDATA` function?", options: ["To automatically extract data from a PivotTable", "To create a new PivotTable", "To filter data in a PivotTable", "To refresh a PivotTable"], answer: "To automatically extract data from a PivotTable" },
            { id: 18, question: "Which chart type is best suited for showing the distribution of numerical data?", options: ["Pie Chart", "Line Chart", "Histogram", "Scatter Plot"], answer: "Histogram" },
            { id: 19, question: "What is the purpose of a 'Named Range'?", options: ["To make a range visible on the sheet", "To give a cell or range a descriptive name for use in formulas", "To create a new worksheet", "To lock a cell to prevent editing"], answer: "To give a cell or range a descriptive name for use in formulas" },
            { id: 20, question: "Which of the following is an older, less flexible alternative to `XLOOKUP`?", options: ["INDEX", "MATCH", "VLOOKUP", "HLOOKUP"], answer: "VLOOKUP" },
            { id: 21, question: "Which tool allows you to quickly separate a column of data (e.g., full names) into multiple columns (first name, last name)?", options: ["Remove Duplicates", "Flash Fill", "Text to Columns", "Data Validation"], answer: "Text to Columns" },
            { id: 22, question: "Which function performs a logical test and returns one value if the result is true, and another if it is false?", options: ["AND", "OR", "IF", "NOT"], answer: "IF" },
            { id: 23, question: "What is the key difference between a Slicer and a Filter in a PivotTable?", options: ["Slicers can only be used with numbers", "Slicers are a visual, interactive way to filter that can be applied to multiple PivotTables", "Filters are faster than Slicers", "Filters cannot be applied to dates"], answer: "Slicers are a visual, interactive way to filter that can be applied to multiple PivotTables" },
            { id: 24, question: "Which tool in Excel allows you to manage different sets of input values and their resulting outputs?", options: ["Goal Seek", "Scenario Manager", "Data Tables", "Solver"], answer: "Scenario Manager" },
            { id: 25, question: "What is the `SORTBY` function used for?", options: ["Sorting data based on a single column", "Sorting data based on one or more related ranges", "Sorting data in ascending order only", "Sorting data in a PivotTable"], answer: "Sorting data based on one or more related ranges" },
            { id: 26, question: "What does the `#REF!` error indicate?", options: ["A cell reference is invalid", "A formula has a misspelled name", "The data cannot be found", "There is a division by zero"], answer: "A cell reference is invalid" },
            { id: 27, question: "Which function is used to conditionally format cells based on multiple criteria?", options: ["IF", "AND", "OR", "COUNTIF"], answer: "AND" },
            { id: 28, question: "What is a 'Data Model' in Excel?", options: ["A simple list of data", "A collection of tables with established relationships for analysis", "A pre-defined format for a worksheet", "A simple chart"], answer: "A collection of tables with established relationships for analysis" },
            { id: 29, question: "Which of these is the most efficient way to summarize and analyze large amounts of data?", options: ["Sorting", "Filtering", "PivotTable", "Charts"], answer: "PivotTable" },
            { id: 30, question: "What is the purpose of the `TEXTJOIN` function?", options: ["To combine numbers", "To merge cells", "To join multiple text strings with a delimiter", "To split text into separate cells"], answer: "To join multiple text strings with a delimiter" }
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