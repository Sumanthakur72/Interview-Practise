<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Quiz Sidebar Hover</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

  <style>
    body {
      font-family: 'Inter', sans-serif;
    }

    /* Sidebar */
    .sidebar {
      transition: width 0.6s ease-in-out;
      width: 16rem; /* default open */
      background: linear-gradient(to bottom, #d881e1, #623f95);
    }
    .sidebar.minimized {
      width: 4.5rem;
    }

    /* Main content */
    .main-content {
      transition: margin-left 0.6s ease-in-out;
      margin-left: 6rem; /* default when sidebar open */
    }
    .main-content.expanded {
      margin-left: 0.5rem; /* when sidebar minimized */
    }

    /* Sidebar text animations */
    .sidebar-header h2,
    .nav-text {
      display: inline-block;
      transition: all 0.4s ease-in-out;
      transform: translateX(0);
      opacity: 1;
      white-space: nowrap;
    }
    .sidebar.minimized .sidebar-header h2,
    .sidebar.minimized .nav-text  {
      transform: translateX(-30px);
      opacity: 0;
    }

    /* Dropdown */
    .dropdown-menu {
      display: none;
      position: absolute;
      left: 100%;
      top: 0;
      min-width: 12rem;
      background: #1f2937; /* gray-800 */
      border-radius: 0.5rem;
      padding: 0.5rem 0;
      z-index: 50;
    }
    .nav-item:hover .dropdown-menu {
      display: block;
    }

    /* Toggle button */
    .toggle-btn {
      position: absolute;
      top: 1rem;
      right: -0.4rem;
      background-color: #9e45b9ff;
      color: white;
      padding: 0.5rem;
      border-radius: 9999px;
      box-shadow: 0 4px 6px -1px rgba(90, 38, 138, 0.1),
        0 2px 4px -1px rgba(0, 0, 0, 0.06);
      z-index: 20;
      transition: all 0.6s ease-in-out;
      display: flex;
      align-items: center;
      justify-content: center;
      width: 3rem;
      height: 3rem;
    }
    .toggle-btn svg {
      transition: transform 0.6s ease-in-out;
    }
    .sidebar.minimized .toggle-btn svg {
      transform: rotate(180deg);
    }
  </style>
</head>

<body class="bg-gray-100 min-h-screen flex text-gray-800">

  <!-- Sidebar -->
  <nav id="sidebar"
    class="sidebar text-white p-6 flex flex-col items-start gap-4 shadow-2xl fixed left-0 top-0 h-full z-10">

    <!-- Header -->
    <div class="sidebar-header flex items-center gap-2 mb-8">
      <a href="../index.php"><h2 class="text-2xl font-bold text-white">Quiz</h2></a> 
    </div>

    <!-- Excel Dropdown -->
    <div class="nav-item relative w-full">
      <div class="flex items-center justify-between w-full p-4 rounded-xl hover:bg-white/10 cursor-pointer">
        <span class="flex items-center gap-2 font-semibold">
          <i class="fa-solid fa-book-open text-lg"></i>
          <span class="nav-text">Excel Levels</span>
        </span>
        <i class="fa-solid fa-chevron-right ml-auto"></i>
      </div>
      <div class="dropdown-menu">
        <a href="../Excel/beginner.php" class="flex items-center gap-3 px-4 py-2 hover:bg-gray-700">
          <i class="fa-solid fa-seedling"></i> Beginner
        </a>
        <a href="../Excel/intermediate.php" class="flex items-center gap-3 px-4 py-2 hover:bg-gray-700">
          <i class="fa-solid fa-layer-group"></i> Intermediate
        </a>
        <a href="../Excel/advance.php" class="flex items-center gap-3 px-4 py-2 hover:bg-gray-700">
          <i class="fa-solid fa-chess-queen"></i> Advanced
        </a>
      </div>
    </div>

    <!-- SQL Dropdown -->
    <div class="nav-item relative w-full">
      <div class="flex items-center justify-between w-full p-4 rounded-xl hover:bg-white/10 cursor-pointer">
        <span class="flex items-center gap-2 font-semibold">
          <i class="fa-solid fa-database text-lg"></i>
          <span class="nav-text">SQL Topics</span>
        </span>
        <i class="fa-solid fa-chevron-right ml-auto"></i>
      </div>
      <div class="dropdown-menu">
        <a href="../SQL/sql_basics.php" class="flex items-center gap-3 px-4 py-2 hover:bg-gray-700">
          <i class="fa-solid fa-play"></i> SQL Basics
        </a>
        <a href="../SQL/sql_queries.php" class="flex items-center gap-3 px-4 py-2 hover:bg-gray-700">
          <i class="fa-solid fa-code"></i> Queries
        </a>
        <a href="../SQL/sql_joins.php" class="flex items-center gap-3 px-4 py-2 hover:bg-gray-700">
          <i class="fa-solid fa-link"></i> Joins
        </a>
        <a href="../SQL/sql_advanced.php" class="flex items-center gap-3 px-4 py-2 hover:bg-gray-700">
          <i class="fa-solid fa-chart-pie"></i> Advanced SQL
        </a>
        <a href="../SQL/sql_storedproc.php" class="flex items-center gap-3 px-4 py-2 hover:bg-gray-700">
          <i class="fa-solid fa-gears"></i> Stored Procedures
        </a>
      </div>
    </div>

    <!-- PHP Dropdown -->
    <div class="nav-item relative w-full">
      <div class="flex items-center justify-between w-full p-4 rounded-xl hover:bg-white/10 cursor-pointer">
        <span class="flex items-center gap-2 font-semibold">
          <i class="fa-brands fa-php text-lg"></i>
          <span class="nav-text">PHP Topics</span>
        </span>
        <i class="fa-solid fa-chevron-right ml-auto"></i>
      </div>
      <div class="dropdown-menu">
        <a href="../PHP/php_basics.php" class="flex items-center gap-3 px-4 py-2 hover:bg-gray-700">
          <i class="fa-solid fa-play"></i> PHP Basics
        </a>
        <a href="../PHP/php_oop.php" class="flex items-center gap-3 px-4 py-2 hover:bg-gray-700">
          <i class="fa-solid fa-cubes"></i> OOP
        </a>
        <a href="../PHP/php_forms.php" class="flex items-center gap-3 px-4 py-2 hover:bg-gray-700">
          <i class="fa-solid fa-pen-to-square"></i> Forms
        </a>
        <a href="../PHP/php_sessions.php" class="flex items-center gap-3 px-4 py-2 hover:bg-gray-700">
          <i class="fa-solid fa-user-lock"></i> Sessions
        </a>
        <a href="../PHP/php_mysql.php" class="flex items-center gap-3 px-4 py-2 hover:bg-gray-700">
          <i class="fa-solid fa-database"></i> PHP + MySQL
        </a>
      </div>
    </div>

    <!-- Footer -->
    <div class="mt-auto">
      <p class="text-xs text-white/50 text-center w-full mt-10">
        ©2024 | Made with ❤️ by <a href="#" class="text-white hover:underline">You</a>
      </p>
    </div>

    <!-- Toggle Btn -->
    <button id="toggleBtn" class="toggle-btn">
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
        stroke="currentColor" class="w-8 h-8">
        <path stroke-linecap="round" stroke-linejoin="round"
          d="M3.75 6.75h16.5M3.75 12h16.5M3.75 17.25h16.5" />
      </svg>
    </button>
  </nav>

  <!-- Main Content -->
  <main id="mainContent" class="main-content p-6">
    <!-- <h1 class="text-3xl font-bold">Main Content Area</h1>
    <p class="mt-4">Sidebar minimize/expand karne par yeh content smoothly slide karega.</p> -->
  </main>

  <script>
    const toggleBtn = document.getElementById('toggleBtn');
    const sidebar = document.getElementById('sidebar');
    const mainContent = document.getElementById('mainContent');

    toggleBtn.addEventListener('click', () => {
      sidebar.classList.toggle('minimized');
      mainContent.classList.toggle('expanded');
    });
  </script>

</body>
</html>
