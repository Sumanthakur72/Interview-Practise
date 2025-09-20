<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Design</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        .card {
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>
<body class="bg-gray-900 text-white min-h-screen p-8">
    <div class="max-w-9xl mx-auto py-12">
        <h1 class="text-4xl lg:text-5xl font-extrabold mb-8 text-center text-yellow-400">
            Analytics Dashboard
        </h1>

        <!-- Main Dashboard Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

            <!-- Card 1 -->
            <div class="card bg-gray-800 p-6 rounded-2xl shadow-xl flex flex-col w-80 items-center text-center">
                <div class="text-5xl font-bold text-yellow-400 mb-2">150</div>
                <p class="text-gray-400">Total Users</p>
            </div>

            <!-- Card 2 -->
            <div class="card bg-gray-800 p-6 rounded-2xl shadow-xl flex flex-col items-center text-center">
                <div class="text-5xl font-bold text-green-400 mb-2">95%</div>
                <p class="text-gray-400">Completion Rate</p>
            </div>

            <!-- Card 3 -->
            <div class="card bg-gray-800 p-6 rounded-2xl shadow-xl flex flex-col items-center text-center">
                <div class="text-5xl font-bold text-blue-400 mb-2">800+</div>
                <p class="text-gray-400">Views</p>
            </div>

            <!-- Card 4 -->
            <div class="card bg-gray-800 p-6 rounded-2xl shadow-xl flex flex-col items-center text-center">
                <div class="text-5xl font-bold text-purple-400 mb-2">4.8</div>
                <p class="text-gray-400">Average Rating</p>
            </div>

            <!-- Graph/Chart Section -->
            <div class="lg:col-span-2 card bg-gray-800 p-6 rounded-2xl shadow-xl flex flex-col justify-center items-center">
                <h2 class="text-2xl font-semibold mb-4 text-center">User Engagement</h2>
                <!-- Placeholder for a graph/chart -->
                <div class="w-full h-64 bg-gray-700 rounded-lg flex items-center justify-center text-gray-400">
                    <!-- Graph will be here -->
                    Graph Placeholder
                </div>
            </div>

            <!-- Other Information Card -->
            <div class="lg:col-span-2 card bg-gray-800 p-6 rounded-2xl shadow-xl flex flex-col justify-center items-center">
                <h2 class="text-2xl font-semibold mb-4 text-center">Recent Activity</h2>
                <ul class="w-full text-left space-y-2 text-gray-400">
                    <li>- New quiz completed by User A</li>
                    <li>- User B joined the platform</li>
                    <li>- Quiz questions updated</li>
                    <li>- User C achieved a high score</li>
                </ul>
            </div>

        </div>
    </div>
</body>
</html>
