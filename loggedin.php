<?php

session_start();

function isAuthenticated() {
    return isset($_SESSION['user_id']) && isset($_SESSION['user_email']);
}

if (!isAuthenticated()) {
    header("Location: login.php");
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="tailwind.config.js"></script>
    <link rel="stylesheet" href="css/custom.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>
<body>
<section class="bg-white dark:bg-gray-900 min-h-screen flex flex-col justify-center items-center text-center">
    <div class="py-8 px-4 max-w-screen-sm">
        <p class="mb-4 text-3xl tracking-tight font-bold text-gray-900 md:text-4xl dark:text-white">
            Welcome, <?php echo isset($_SESSION['user_name']) ? $_SESSION['user_name'] : 'John Doe'; ?>
        </p>
        <p class="mb-4 text-lg font-light text-gray-500 dark:text-gray-400">
            You have been logged in successfully!
        </p>
        <a href="#" id="logout" class="mt-10 inline-flex items-center justify-center px-4 py-2.5 text-base font-medium text-white bg-primary-700 rounded-lg hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 dark:focus:ring-primary-900">
            Logout
        </a>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script src="js/script.js"></script>
</body>
</html>