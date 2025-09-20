<?php include '../includes/sidebar.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sessions Quiz</title>
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
        input[type="radio"]:checked + .option-label::before {
            background-color: #3b82f6;
            border-color: #3b82f6;
            transform: scale(1.1);
        }
        /* Highlight the entire selected option */
        input[type="radio"]:checked + .option-label {
            background-color: #e0f2fe;
            border-color: #3b82f6;
        }
    </style>
</head>
<body class="bg-[#f0f4f8] text-gray-800 flex items-center justify-center min-h-screen p-4">
<main id="mainContent" class="main-content flex-1 min-h-screen flex items-center justify-center">
    <!-- Main Quiz Container -->
    <div id="app" class="max-w-3xl bg-white p-8 rounded-3xl shadow-2xl w-full text-center flex flex-col items-center">
        <!-- Main title and description -->
        <h1 id="main-title" class="text-3xl font-bold text-gray-800 mb-2">Sessions Quiz</h1>
        <p class="text-gray-600 mb-8">Test your knowledge on sessions and their use in web development.</p>
        
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
            <button id="next-button" class="w-full md:w-auto text-white font-semibold py-3 px-12 rounded-full shadow-lg bg-gradient-to-r from-indigo-600 to-indigo-500 hover:from-indigo-700 hover:to-indigo-600 transition-all duration-300 focus:outline-none focus:ring-4 focus:ring-indigo-500 focus:ring-opacity-50">
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
                <button id="view-detailed-button" class="w-full md:w-auto text-white font-semibold py-3 px-12 rounded-full shadow-lg bg-gradient-to-r from-indigo-600 to-indigo-500 hover:from-indigo-700 hover:to-indigo-600 transition-all duration-300 focus:outline-none focus:ring-4 focus:ring-indigo-500 focus:ring-opacity-50">
                    View Detailed Answers
                </button>
                 <button id="restart-button" class="w-full md:w-auto text-white font-semibold py-3 px-12 rounded-full shadow-lg bg-gradient-to-r from-indigo-600 to-indigo-500 hover:from-indigo-700 hover:to-indigo-600 transition-all duration-300 focus:outline-none focus:ring-4 focus:ring-indigo-500 focus:ring-opacity-50">
                    Restart
                </button>
            </div>
        </div>

        <!-- Detailed Results Screen -->
        <div id="detailed-results-screen" class="hidden mt-8 w-full bg-white p-8 rounded-2xl shadow-lg border border-gray-200 text-left">
            <h2 id="detailed-results-title" class="text-3xl font-bold text-indigo-600 mb-6 text-center">Detailed Answers</h2>
            <div id="answers-container" class="space-y-6">
                <!-- Detailed results will be dynamically inserted here -->
            </div>
            <button id="go-back-button" class="w-full md:w-auto text-white font-semibold py-3 px-12 rounded-full shadow-lg bg-gradient-to-r from-indigo-600 to-indigo-500 hover:from-indigo-700 hover:to-indigo-600 transition-all duration-300 focus:outline-none focus:ring-4 focus:ring-indigo-500 focus:ring-opacity-50 mt-8 mx-auto block">
                Go Back
            </button>
        </div>
    </div>
</main>
    <script>
        const quizData = [
            {
                "question": "What is the primary purpose of a web session?",
                "options": ["To store data on the client side.", "To track a user's activity across multiple web pages.", "To enhance a website's design.", "To compress data sent to the server."],
                "answer": "To track a user's activity across multiple web pages.",
                "description": "Sessions are used to manage a user's state and activity during their interaction with a web application."
            },
            {
                "question": "Where is session data typically stored?",
                "options": ["Client's browser", "Server's memory or database", "HTML document", "URL query string"],
                "answer": "Server's memory or database",
                "description": "Session data is primarily stored on the server to keep it secure and away from client-side manipulation."
            },
            {
                "question": "What is the unique identifier for a session called?",
                "options": ["Session Key", "Session ID", "Session Token", "User ID"],
                "answer": "Session ID",
                "description": "A Session ID is a unique key used to identify a specific user's session on the server."
            },
            {
                "question": "How is the session ID typically sent from the server to the client?",
                "options": ["Through a URL parameter", "In a cookie", "In a hidden form field", "In the HTTP body"],
                "answer": "In a cookie",
                "description": "The most common and secure way to manage a session ID is by storing it in a cookie on the client's browser."
            },
            {
                "question": "What happens when a session expires?",
                "options": ["The user's account is deleted.", "The session data on the server is destroyed.", "The browser is closed.", "The user is automatically logged back in."],
                "answer": "The session data on the server is destroyed.",
                "description": "When a session expires, the server removes the corresponding session data, requiring the user to start a new session."
            },
            {
                "question": "What is a 'stateless' protocol?",
                "options": ["A protocol that remembers past interactions.", "A protocol that forgets all previous requests.", "A protocol with no security features.", "A protocol that is very fast."],
                "answer": "A protocol that forgets all previous requests.",
                "description": "HTTP is a stateless protocol, meaning each request is independent and the server does not remember past interactions. Sessions are used to add state to HTTP."
            },
            {
                "question": "Which of these is NOT a common use case for sessions?",
                "options": ["Shopping cart data", "User authentication status", "Website color preferences", "Permanent user profile information"],
                "answer": "Permanent user profile information",
                "description": "Permanent profile information is typically stored in a database, not a temporary session."
            },
            {
                "question": "What is a major security risk associated with sessions?",
                "options": ["Session fixation", "SQL injection", "Phishing", "Cross-site scripting (XSS)"],
                "answer": "Session fixation",
                "description": "Session fixation is an attack that allows an attacker to set the victim's session ID, which can then be used to impersonate them."
            },
            {
                "question": "Which HTTP header is commonly used to manage sessions with cookies?",
                "options": ["Content-Type", "Authorization", "Set-Cookie", "Accept"],
                "answer": "Set-Cookie",
                "description": "The `Set-Cookie` header is used by the server to send a cookie (including the session ID) to the client."
            },
            {
                "question": "What is the difference between a session and a cookie?",
                "options": ["Cookies are client-side, sessions are server-side.", "Cookies can store more data.", "Sessions are permanent.", "Cookies are always more secure."],
                "answer": "Cookies are client-side, sessions are server-side.",
                "description": "Cookies store data on the user's computer, while sessions store data on the server and are identified by a cookie."
            },
            {
                "question": "What happens to session data when the browser is closed (for a default session)?",
                "options": ["It is stored permanently.", "It is immediately deleted.", "It is transferred to the server's cache.", "It is automatically backed up."],
                "answer": "It is immediately deleted.",
                "description": "By default, sessions are temporary and their data is destroyed once the user closes their browser."
            },
            {
                "question": "What is 'session hijacking'?",
                "options": ["Stealing a user's session ID to impersonate them.", "A user logging in with the wrong password.", "A website's server crashing.", "An attacker changing a user's password."],
                "answer": "Stealing a user's session ID to impersonate them.",
                "description": "Session hijacking is the act of an attacker gaining unauthorized control of a user's session."
            },
            {
                "question": "How can you securely regenerate a session ID?",
                "options": ["Never change it.", "Only change it on a page refresh.", "Change it after a user logs in.", "Change it every minute."],
                "answer": "Change it after a user logs in.",
                "description": "Regenerating the session ID after a successful login helps prevent session fixation attacks."
            },
            {
                "question": "What is the purpose of a session timeout?",
                "options": ["To save server memory.", "To automatically log out inactive users.", "To prevent sessions from expiring.", "To increase the session ID length."],
                "answer": "To automatically log out inactive users.",
                "description": "A session timeout is a security measure to end a session after a period of inactivity, protecting the user's account."
            },
            {
                "question": "Which of these is a characteristic of a secure session cookie?",
                "options": ["It has a very short expiry time.", "It is sent over an unencrypted connection.", "It has a long, predictable ID.", "It is not associated with a specific user."],
                "answer": "It has a very short expiry time.",
                "description": "Short-lived session cookies are more secure as they reduce the window of opportunity for attackers."
            },
            {
                "question": "What is the purpose of the `HttpOnly` cookie attribute?",
                "options": ["To make the cookie permanent.", "To prevent client-side scripts from accessing the cookie.", "To send the cookie over HTTPS only.", "To compress the cookie's data."],
                "answer": "To prevent client-side scripts from accessing the cookie.",
                "description": "The `HttpOnly` attribute prevents JavaScript from reading the cookie, which is a key defense against XSS attacks."
            },
            {
                "question": "What is 'session persistence'?",
                "options": ["Storing session data on a local file.", "Ensuring session data survives a server restart.", "Making sessions last indefinitely.", "Preventing users from logging out."],
                "answer": "Ensuring session data survives a server restart.",
                "description": "Session persistence is the concept of storing session data outside of the server's memory, for example in a database, so it is not lost on restart or failure."
            },
            {
                "question": "What is the main advantage of using a database for session storage?",
                "options": ["It is faster.", "It's easier to implement.", "It allows for scalable, multi-server applications.", "It is more secure from all attacks."],
                "answer": "It allows for scalable, multi-server applications.",
                "description": "Storing sessions in a shared database allows multiple web servers to access the same session data, which is crucial for load balancing."
            },
            {
                "question": "Which of these is a client-side storage mechanism?",
                "options": ["Session Storage", "Server Session", "Application Cache", "Redis Session"],
                "answer": "Session Storage",
                "description": "Session Storage is a browser-side API that stores data for the duration of a page session."
            },
            {
                "question": "What is the difference between `localStorage` and `sessionStorage`?",
                "options": ["`localStorage` is faster.", "`localStorage` data persists across browser sessions, while `sessionStorage` data is cleared.", "`sessionStorage` can store more data.", "They are functionally identical."],
                "answer": "`localStorage` data persists across browser sessions, while `sessionStorage` data is cleared.",
                "description": "`localStorage` keeps data until explicitly cleared, while `sessionStorage` data is cleared when the page session ends (e.g., when the browser tab is closed)."
            },
            {
                "question": "In a typical server-side session, what is the server's role?",
                "options": ["To store all user data locally.", "To issue the session ID and manage the corresponding data.", "To display the session data to the user.", "To encrypt all data before sending it."],
                "answer": "To issue the session ID and manage the corresponding data.",
                "description": "The server's role is to create a unique session, store the data, and provide the session ID to the client."
            },
            {
                "question": "What is a 'token-based' authentication session?",
                "options": ["A session using a username and password.", "A session that stores all user data on the server.", "A session where each request is authenticated with a token instead of a session ID.", "A session with no expiry date."],
                "answer": "A session where each request is authenticated with a token instead of a session ID.",
                "description": "Token-based authentication sends a secure token (like JWT) with each request, which contains enough information for the server to authenticate without needing to store session state."
            },
            {
                "question": "What is a common drawback of server-side sessions?",
                "options": ["They are less secure.", "They are difficult to implement.", "They can put a heavy load on the server's memory.", "They don't work with modern browsers."],
                "answer": "They can put a heavy load on the server's memory.",
                "description": "Storing a large amount of session data for many users in server memory can be resource-intensive."
            },
            {
                "question": "When a user logs out, what is the best practice for ending their session?",
                "options": ["Just redirect them to the login page.", "Delete the session data from the server and expire the cookie.", "Close the browser tab.", "Change the session ID."],
                "answer": "Delete the session data from the server and expire the cookie.",
                "description": "A proper logout process involves both invalidating the session on the server and expiring the session cookie on the client."
            },
            {
                "question": "What does a session 'state' refer to?",
                "options": ["The user's current location.", "The data and information stored for a particular user's session.", "The server's memory usage.", "The security level of the session."],
                "answer": "The data and information stored for a particular user's session.",
                "description": "The session 'state' includes all the variables and data that are maintained for a single user's interaction."
            },
            {
                "question": "What is a 'session timeout' due to inactivity?",
                "options": ["A session that never expires.", "A session that is cleared after a set period without user interaction.", "A session that is cleared on every new request.", "A session that is cleared only when the user logs out."],
                "answer": "A session that is cleared after a set period without user interaction.",
                "description": "Inactivity timeouts are a common security measure to prevent unauthorized access to an open session."
            },
            {
                "question": "Which of these is the most common way to identify a session?",
                "options": ["By IP address.", "By username and password on every request.", "By a unique session ID sent via cookie.", "By the browser's user agent string."],
                "answer": "By a unique session ID sent via cookie.",
                "description": "This is the standard approach for managing web sessions."
            },
            {
                "question": "What is the primary role of a session manager in a web framework?",
                "options": ["To manage database connections.", "To handle user interface elements.", "To create, manage, and destroy sessions.", "To process form submissions."],
                "answer": "To create, manage, and destroy sessions.",
                "description": "The session manager is the component responsible for the full lifecycle of sessions."
            },
            {
                "question": "What is the security risk of storing sensitive data directly in a cookie?",
                "options": ["It is prone to server overload.", "It can be easily accessed and modified by the client.", "It is always encrypted.", "It is not a valid way to store data."],
                "answer": "It can be easily accessed and modified by the client.",
                "description": "Cookies are client-side and can be viewed and tampered with, making them unsuitable for sensitive data."
            },
            {
                "question": "In a web application, how do you typically access session data from the server-side code?",
                "options": ["By using a global `document` object.", "By using a special `session` object or variable.", "By querying a database with a username.", "By reading the data directly from the cookie."],
                "answer": "By using a special `session` object or variable.",
                "description": "Most web frameworks provide a convenient session object (e.g., `req.session` in Express.js) that handles the underlying session management for you."
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
                    label.className = 'option-label flex items-center p-4 rounded-xl text-lg font-medium cursor-pointer transition-all duration-200 hover:bg-gray-200';
                    
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
                
                questionDiv.appendChild(questionTitle);
                questionDiv.appendChild(yourAnswerText);
                if (!isCorrect) {
                    questionDiv.appendChild(correctAnswerText);
                }
                
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
            mainTitle.textContent = "Sessions Quiz";
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
