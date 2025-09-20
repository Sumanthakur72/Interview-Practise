<?php include '../includes/sidebar.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OOP Quiz</title>
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
                <h1 class="text-3xl md:text-4xl font-extrabold text-gray-800 tracking-tight">OOP Concepts Quiz</h1>
                <p class="text-gray-600 mt-2 text-lg">Test your Object-Oriented Programming knowledge with these 30
                    questions.</p>
            </div>
            <!-- Quiz Screen -->
            <div id="quiz-screen">
                <p id="question-text" class="text-xl md:text-2xl font-bold text-gray-800 mb-4"></p>
                <form id="options-form">
                    <!-- Radio buttons will be inserted here by JavaScript -->
                </form>
                <div class="flex justify-center items-center mt-8">
                    <button id="next-btn"
                        class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-8 rounded-full shadow-lg transition-all duration-300 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">Next</button>
                </div>
            </div>

            <!-- Result Screen -->
            <div id="result-screen" class="hidden text-center">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-2">Quiz Results</h2>
                <p class="text-gray-600 text-lg mb-8">You answered <span id="answered-count" class="font-bold">0</span>
                    out of 30 questions.</p>
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
                        <span class="text-gray-600 text-sm md:text-base font-medium">Skipped</span>
                    </div>
                </div>
                <div class="flex flex-col md:flex-row justify-center space-y-4 md:space-y-0 md:space-x-4">
                    <button id="review-btn"
                        class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-8 rounded-full shadow-lg transition-all duration-300 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">Review
                        Answers</button>
                    <button id="restart-btn"
                        class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-3 px-8 rounded-full shadow-lg transition-all duration-300 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-opacity-50">Try
                        Again</button>
                </div>
            </div>

            <!-- Review Screen -->
            <div id="review-screen" class="hidden">
                <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">Review Answers</h2>
                <div id="review-list" class="space-y-4">
                    <!-- Review items will be inserted here -->
                </div>
                <div class="text-center mt-6">
                    <button id="back-btn"
                        class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-3 px-8 rounded-full shadow-lg transition-all duration-300 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-opacity-50">Back
                        to Results</button>
                </div>
            </div>
        </div>
    </main>
    <script>
        const quizData = [
            { "question": "What does OOP stand for?", "answerOptions": [{ "text": "Object-Oriented Programming", "isCorrect": true }, { "text": "Open Operator Programming", "isCorrect": false }, { "text": "Objective Overriding Programming", "isCorrect": false }, { "text": "Organized Object Programming", "isCorrect": false }] },
            { "question": "What are the core concepts of OOP?", "answerOptions": [{ "text": "Class, Object, Inheritance, Polymorphism", "isCorrect": false }, { "text": "Class, Object, Inheritance, Encapsulation, Polymorphism, Abstraction", "isCorrect": true }, { "text": "Class, Object, Method, Property", "isCorrect": false }, { "text": "Property, Method, Interface, Class", "isCorrect": false }] },
            { "question": "What is a class in programming?", "answerOptions": [{ "text": "An instance of an object", "isCorrect": false }, { "text": "A data type with properties and methods", "isCorrect": false }, { "text": "A blueprint or template for creating objects", "isCorrect": true }, { "text": "A function that returns an object", "isCorrect": false }] },
            { "question": "What is an object in programming?", "answerOptions": [{ "text": "A blueprint of a class", "isCorrect": false }, { "text": "A run-time instance of a class", "isCorrect": true }, { "text": "A collection of data and functions", "isCorrect": false }, { "text": "A variable inside a function", "isCorrect": false }] },
            { "question": "What is the purpose of Inheritance?", "answerOptions": [{ "text": "To hide data from external access", "isCorrect": false }, { "text": "To create multiple functions with the same name", "isCorrect": false }, { "text": "To reuse code and create a class hierarchy", "isCorrect": true }, { "text": "To break down code into smaller, manageable pieces", "isCorrect": false }] },
            { "question": "What does Polymorphism mean?", "answerOptions": [{ "text": "Multiple functions with the same name", "isCorrect": false }, { "text": "One name, many forms", "isCorrect": true }, { "text": "Hiding data from external access", "isCorrect": false }, { "text": "Creating a relationship between classes", "isCorrect": false }] },
            { "question": "What does Encapsulation mean?", "answerOptions": [{ "text": "Bundling data and methods into a single unit and hiding data from external access", "isCorrect": true }, { "text": "Inheriting properties from one class to another", "isCorrect": false }, { "text": "Converting one object to another", "isCorrect": false }, { "text": "Creating multiple functions with the same name", "isCorrect": false }] },
            { "question": "What is Abstraction?", "answerOptions": [{ "text": "Bundling data and functions into a single unit", "isCorrect": false }, { "text": "Showing only essential information and hiding unnecessary details", "isCorrect": true }, { "text": "Creating multiple functions with the same name", "isCorrect": false }, { "text": "Inheriting properties from one class to another", "isCorrect": false }] },
            { "question": "What is a Constructor?", "answerOptions": [{ "text": "A method that destroys an object", "isCorrect": false }, { "text": "A method that initializes an object when it is created", "isCorrect": true }, { "text": "A method that only returns data", "isCorrect": false }, { "text": "A static method belonging to a class", "isCorrect": false }] },
            { "question": "What is a Destructor?", "answerOptions": [{ "text": "A method that destroys an object", "isCorrect": true }, { "text": "A method that initializes an object", "isCorrect": false }, { "text": "A method that creates objects", "isCorrect": false }, { "text": "A method that frees up memory for a class", "isCorrect": false }] },
            { "question": "What are data (variables) in a class called?", "answerOptions": [{ "text": "Methods", "isCorrect": false }, { "text": "Properties or Attributes", "isCorrect": true }, { "text": "Functions", "isCorrect": false }, { "text": "Data points", "isCorrect": false }] },
            { "question": "What are functions in a class called?", "answerOptions": [{ "text": "Properties", "isCorrect": false }, { "text": "Methods or Behaviors", "isCorrect": true }, { "text": "Functions", "isCorrect": false }, { "text": "Commands", "isCorrect": false }] },
            { "question": "What is a static method?", "answerOptions": [{ "text": "It operates on an instance of an object", "isCorrect": false }, { "text": "It belongs to the class and can be called without creating an instance", "isCorrect": true }, { "text": "It is a private method", "isCorrect": false }, { "text": "It is a constructor", "isCorrect": false }] },
            { "question": "In PHP, which operator is used to access methods and properties of an object?", "answerOptions": [{ "text": "->", "isCorrect": true }, { "text": "::", "isCorrect": false }, { "text": ".", "isCorrect": false }, { "text": ":", "isCorrect": false }] },
            { "question": "In PHP, which operator is used to access static methods and properties of a class?", "answerOptions": [{ "text": "->", "isCorrect": false }, { "text": "::", "isCorrect": true }, { "text": ".", "isCorrect": false }, { "text": ":", "isCorrect": false }] },
            { "question": "What does the `private` access specifier mean?", "answerOptions": [{ "text": "The property or method can only be accessed within the same class", "isCorrect": true }, { "text": "The property or method can be accessed within the same class and child classes", "isCorrect": false }, { "text": "The property or method can be accessed anywhere", "isCorrect": false }, { "text": "It is related to the database", "isCorrect": false }] },
            { "question": "What does the `protected` access specifier mean?", "answerOptions": [{ "text": "The property or method can only be accessed within the same class", "isCorrect": false }, { "text": "The property or method can be accessed within the same class and child classes", "isCorrect": true }, { "text": "The property or method can be accessed anywhere", "isCorrect": false }, { "text": "It is for external use only", "isCorrect": false }] },
            { "question": "What does the `public` access specifier mean?", "answerOptions": [{ "text": "The property or method can only be accessed within the same class", "isCorrect": false }, { "text": "The property or method can be accessed within the same class and child classes", "isCorrect": false }, { "text": "The property or method can be accessed anywhere", "isCorrect": true }, { "text": "It is for internal use only", "isCorrect": false }] },
            { "question": "What is Method Overriding?", "answerOptions": [{ "text": "Creating multiple methods with the same name", "isCorrect": false }, { "text": "Redefining a parent class's method in a child class", "isCorrect": true }, { "text": "Removing a method from a parent class", "isCorrect": false }, { "text": "Making a method private", "isCorrect": false }] },
            { "question": "What is an abstract class?", "answerOptions": [{ "text": "A class that cannot be inherited", "isCorrect": false }, { "text": "A class that has at least one abstract method and cannot be instantiated", "isCorrect": true }, { "text": "A class with no methods", "isCorrect": false }, { "text": "A class that only stores data", "isCorrect": false }] },
            { "question": "What is an Interface?", "answerOptions": [{ "text": "A class that cannot be inherited", "isCorrect": false }, { "text": "A blueprint for methods with no body", "isCorrect": true }, { "text": "A class with no properties", "isCorrect": false }, { "text": "An object that returns data", "isCorrect": false }] },
            { "question": "Which keyword is used to call the parent class's constructor?", "answerOptions": [{ "text": "this::", "isCorrect": false }, { "text": "parent::", "isCorrect": true }, { "text": "super::", "isCorrect": false }, { "text": "self::", "isCorrect": false }] },
            { "question": "What is a `trait`?", "answerOptions": [{ "text": "A mechanism for code reuse in single inheritance languages", "isCorrect": true }, { "text": "A type of variable", "isCorrect": false }, { "text": "A built-in function", "isCorrect": false }, { "text": "A class with no properties", "isCorrect": false }] },
            { "question": "If you want a class to not be inheritable, which keyword would you use?", "answerOptions": [{ "text": "abstract", "isCorrect": false }, { "text": "static", "isCorrect": false }, { "text": "final", "isCorrect": true }, { "text": "protected", "isCorrect": false }] },
            { "question": "What is Method Overloading?", "answerOptions": [{ "text": "Multiple methods with the same name but different parameters in one class", "isCorrect": true }, { "text": "Redefining a parent class's method in a child class", "isCorrect": false }, { "text": "Calling the same method multiple times", "isCorrect": false }, { "text": "Making a method private", "isCorrect": false }] },
            { "question": "What is the main benefit of Object-Oriented Programming?", "answerOptions": [{ "text": "It makes code run slower", "isCorrect": false }, { "text": "It makes code more organized, secure, and reusable", "isCorrect": true }, { "text": "It's only useful for large projects", "isCorrect": false }, { "text": "It allows direct access to the database", "isCorrect": false }] },
            { "question": "What is the use of the `this` keyword?", "answerOptions": [{ "text": "To refer to the parent class", "isCorrect": false }, { "text": "To refer to the child class", "isCorrect": false }, { "text": "To refer to the current object instance", "isCorrect": true }, { "text": "To refer to any variable", "isCorrect": false }] },
            { "question": "What is the relationship between a parent and child class called?", "answerOptions": [{ "text": "Inheritance", "isCorrect": true }, { "text": "Composition", "isCorrect": false }, { "text": "Association", "isCorrect": false }, { "text": "Abstraction", "isCorrect": false }] },
            { "question": "Which keyword is used to link a class to an interface?", "answerOptions": [{ "text": "extends", "isCorrect": false }, { "text": "implements", "isCorrect": true }, { "text": "uses", "isCorrect": false }, { "text": "connects", "isCorrect": false }] },
            { "question": "What is the main difference between an abstract class and an interface?", "answerOptions": [{ "text": "An abstract class can have non-abstract methods, while an interface's methods are all abstract.", "isCorrect": true }, { "text": "An abstract class cannot be inherited, while an interface can.", "isCorrect": false }, { "text": "An abstract class cannot have properties, while an interface can.", "isCorrect": false }, { "text": "They are the same, just with different names.", "isCorrect": false }] }
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
                label.className = 'flex items-center p-4 bg-gray-50 rounded-xl cursor-pointer transition-all duration-200 hover:bg-gray-100 shadow-sm';

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
                <p class="text-gray-600">Correct Answer: <span class="text-green-600 font-semibold">${correctOptions.map(opt => opt.text).join(' or ')}</span></p>
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