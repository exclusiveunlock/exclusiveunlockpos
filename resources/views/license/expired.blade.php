<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>License Expired - GSM X Tool</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Animations */
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-6px); }
        }

        .fade-in-up {
            animation: fadeInUp 0.8s ease forwards;
        }

        .float {
            animation: float 3s ease-in-out infinite;
        }

        .btn-animate {
            transition: all 0.25s ease;
        }

        .btn-animate:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.15);
        }
    </style>
</head>
<body class="bg-gradient-to-br from-white via-gray-50 to-gray-100 min-h-screen flex flex-col items-center justify-center font-sans">

    <div class="text-center bg-white shadow-2xl rounded-2xl p-10 max-w-md fade-in-up">
        <div class="mb-6">
            <svg class="w-16 h-16 text-red-500 mx-auto float" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v4m0 4h.01M12 3c4.97 0 9 4.03 9 9s-4.03 9-9 9-9-4.03-9-9 4.03-9 9-9z" />
            </svg>
        </div>

        <h1 class="text-3xl font-bold text-red-600 mb-2 animate-pulse">License Expired!</h1>
        <p class="text-gray-700 mb-4">Your License ID has expired. Please renew to continue using the service.</p>

        <div class="mt-4 mb-6 text-sm text-gray-600">
            <p class="mb-1">💡 Your site is running? <span class="text-blue-600 font-medium">Please contact Support.</span></p>
            <p>🛠 New install need? <span class="text-green-600 font-medium">Please click Install Now.</span></p>
        </div>

        <div class="flex justify-center gap-4">
            <a href="/install" class="btn-animate bg-green-500 hover:bg-green-600 text-white px-6 py-2 rounded-lg font-medium shadow-md">
                Install Now
            </a>
            <a href="/" class="btn-animate bg-gray-500 hover:bg-gray-600 text-white px-6 py-2 rounded-lg font-medium shadow-md">
                Back to Home
            </a>
        </div>
    </div>

    <footer class="mt-8 text-center text-gray-600 text-sm fade-in-up">
        <p class="mb-1">Product by <span class="font-semibold text-gray-800">GSM X Store</span></p>
        <p>Powered by <span class="font-semibold text-blue-600">GSM X Tool</span></p>
    </footer>

</body>
</html>
