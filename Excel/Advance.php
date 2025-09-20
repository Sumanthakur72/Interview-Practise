<?php include '../includes/sidebar.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Advanced Excel Quiz Pro</title>
    <!-- Load Inter font from Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <!-- Load Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { font-family: 'Inter', sans-serif; }
        .red-highlight { background-color: #fee2e2; border-color: #fca5a5; }
        .correct-answer { background-color: #d1fae5; border-color: #6ee7b7; }
        .selected-option {
            background-color: #e0f2fe;
            border-color: #60a5fa;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }
    </style>
</head>
<body class="bg-slate-50 ">
    <main id="mainContent" class="main-content flex-1 min-h-screen">
        <div class="min-h-screen flex flex-col items-center justify-center">
            <div id="quiz-container" class="bg-white p-8 md:p-12 rounded-3xl shadow-2xl w-full max-w-3xl border border-gray-200 mr-[200px]">
                <h1 class="text-3xl md:text-4xl font-bold text-center text-gray-900 mb-4">
                    Advanced Excel Quiz Pro
                </h1>
                <p class="text-center text-gray-500 mb-8">
                    Test your expertise with these professional-level questions.
                </p>
        
                <!-- Quiz form where questions will be loaded -->
                <form id="quizForm" method="POST">
                    <div id="quizQuestions" class="space-y-6">
                        <!-- JavaScript will dynamically load the question here -->
                    </div>
                    
                    <div class="mt-8 flex justify-center space-x-4">
                        <!-- Buttons will be dynamically loaded here -->
                    </div>
                </form>
            </div>
        </div>
    </main>

    <!-- JavaScript code -->
    <script>
        // Advanced questions and answers data stored in a JavaScript array
        const questions = [
            { id: 1, question: "What does the `SUMPRODUCT` function do?", options: ["Sums a range based on a single condition", "Multiplies corresponding components in the given arrays and returns the sum of those products", "Calculates a product for each row and then sums them", "Adds up products in a specific column"], answer: "Multiplies corresponding components in the given arrays and returns the sum of those products" },
            { id: 2, question: "Which function is best for a multi-criteria lookup where you need to return a value from a different column?", options: ["VLOOKUP", "HLOOKUP", "INDEX and MATCH", "XLOOKUP"], answer: "INDEX and MATCH" },
            { id: 3, question: "The `#VALUE!` error indicates what?", options: ["A formula has a misspelled function name", "A cell reference is invalid", "A wrong data type is used in a formula", "The data cannot be found"], answer: "A wrong data type is used in a formula" },
            { id: 4, question: "What is the primary benefit of using 'named ranges' in complex formulas?", options: ["They improve performance", "They make formulas easier to read and understand", "They make a workbook smaller", "They can be used for data validation only"], answer: "They make formulas easier to read and understand" },
            { id: 5, question: "What is the primary purpose of `Data Validation`?", options: ["To make sure formulas are correct", "To restrict the type of data a user can enter into a cell", "To validate a formula’s output", "To format data based on its value"], answer: "To restrict the type of data a user can enter into a cell" },
            { id: 6, question: "What is the purpose of the `INDIRECT` function?", options: ["To reference a cell using its name", "To create a dynamic reference to a cell or range from a text string", "To perform an indirect calculation", "To change the format of a cell"], answer: "To create a dynamic reference to a cell or range from a text string" },
            { id: 7, question: "Which chart is most effective for visualizing the contribution of each item to the total (e.g., sales by product category)?", options: ["Line Chart", "Bar Chart", "Pie Chart", "Histogram"], answer: "Pie Chart" },
            { id: 8, question: "What is 'Structured Referencing'?", options: ["Using cell coordinates like A1", "Using the names of tables and columns", "Using relative references only", "Using absolute references only"], answer: "Using the names of tables and columns" },
            { id: 9, question: "Which function is used to convert data from a row to a column or vice versa?", options: ["TRANSPOSE", "CONVERT", "SWITCH", "FLIP"], answer: "TRANSPOSE" },
            { id: 10, question: "Which of these is used to extract a specific number of characters from the middle of a text string?", options: ["LEFT", "RIGHT", "MID", "EXTRACT"], answer: "MID" },
            { id: 11, question: "What is the purpose of `Power Pivot`?", options: ["To automatically extract data from a PivotTable", "To build advanced data models with relationships and DAX", "To refresh a PivotTable", "To create a new PivotTable"], answer: "To build advanced data models with relationships and DAX" },
            { id: 12, question: "Which tool would you use to perform a sensitivity analysis by changing multiple inputs to see how they affect a single result?", options: ["Goal Seek", "Scenario Manager", "Data Tables", "Solver"], answer: "Data Tables" },
            { id: 13, question: "The `#SPILL!` error indicates that a formula's output requires more than one cell, but the cells are blocked. This is a characteristic of what type of function?", options: ["Legacy functions", "Dynamic array functions", "Text functions", "Database functions"], answer: "Dynamic array functions" },
            { id: 14, question: "What is the use of the `EOMONTH` function?", options: ["To find the end of a month based on a number of months before or after a start date", "To format a date to show only the month", "To find the last day of the year", "To calculate the total number of months in a period"], answer: "To find the end of a month based on a number of months before or after a start date" },
            { id: 15, question: "What does the `COUNTIFS` function do?", options: ["Counts cells based on a single condition", "Counts cells if multiple conditions are met", "Sums a range if multiple conditions are met", "Counts only numbers"], answer: "Counts cells if multiple conditions are met" },
            { id: 16, question: "Which tool allows you to quickly separate a column of data (e.g., full names) into multiple columns (first name, last name)?", options: ["Remove Duplicates", "Flash Fill", "Text to Columns", "Data Validation"], answer: "Text to Columns" },
            { id: 17, question: "What is a 'Data Model' in Excel?", options: ["A simple list of data", "A collection of tables with established relationships for analysis", "A pre-defined format for a worksheet", "A simple chart"], answer: "A collection of tables with established relationships for analysis" },
            { id: 18, question: "Which chart is best for showing trends over time?", options: ["Pie Chart", "Line Chart", "Histogram", "Scatter Plot"], answer: "Line Chart" },
            { id: 19, question: "What is the purpose of the `IFNA` function?", options: ["To handle `#N/A` errors only", "To handle all errors", "To check if a cell is a number", "To check for a value in a range"], answer: "To handle `#N/A` errors only" },
            { id: 20, question: "What does the `OFFSET` function do?", options: ["Returns the sum of a range", "Creates a dynamic range reference that can be adjusted", "Finds the offset of a cell from a fixed point", "Converts a cell to a number"], answer: "Creates a dynamic range reference that can be adjusted" },
            { id: 21, question: "What is the primary purpose of a 'Scenario Manager'?", options: ["To track changes in a workbook", "To test different sets of input values and their outcomes without changing the worksheet data", "To manage multiple users in a shared workbook", "To create a new report"], answer: "To test different sets of input values and their outcomes without changing the worksheet data" },
            { id: 22, question: "Which function is used to join multiple text strings with a delimiter, ignoring empty cells?", options: ["CONCATENATE", "TEXTJOIN", "JOIN", "COMBINE"], answer: "TEXTJOIN" },
            { id: 23, question: "What is the main advantage of using an Excel Table over a normal data range?", options: ["It prevents errors", "It automatically expands when new data is added, and formulas auto-adjust", "It is easier to format", "It can only be used for formulas"], answer: "It automatically expands when new data is added, and formulas auto-adjust" },
            { id: 24, question: "What is a 'Power Query'?", options: ["An Excel function", "A data connection and transformation tool", "A type of PivotTable", "A simple macro"], answer: "A data connection and transformation tool" },
            { id: 25, question: "The `CHOOSE` function is used for what purpose?", options: ["To pick a random value from a list", "To select one value from a list based on an index number", "To choose between different data types", "To choose a cell range"], answer: "To select one value from a list based on an index number" },
            { id: 26, question: "What is the purpose of `Solver`?", options: ["To find the optimal input value for a formula to reach a specific goal by changing multiple cells", "To solve simple mathematical problems", "To manage data in a worksheet", "To perform a simple lookup"], answer: "To find the optimal input value for a formula to reach a specific goal by changing multiple cells" },
            { id: 27, question: "The `IFERROR` function is used to handle what kind of output?", options: ["Blank cells", "Text values", "Calculations", "Formula errors"], answer: "Formula errors" },
            { id: 28, question: "What does the `SORTBY` function do?", options: ["Sorting data based on a single column", "Sorting data based on one or more related ranges", "Sorting data in ascending order only", "Sorting data in a PivotTable"], answer: "Sorting data based on one or more related ranges" },
            { id: 29, question: "What is the purpose of the `TEXTJOIN` function?", options: ["To combine numbers", "To merge cells", "To join multiple text strings with a delimiter", "To split text into separate cells"], answer: "To join multiple text strings with a delimiter" },
            { id: 30, question: "What does the `#REF!` error indicate?", options: ["A cell reference is invalid", "A formula has a misspelled name", "The data cannot be found", "There is a division by zero"], answer: "A cell reference is invalid" }
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
        window.renderDetailedResults = function(answers) { // Global function for onclick
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
