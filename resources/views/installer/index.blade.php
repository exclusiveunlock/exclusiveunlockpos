<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>GSM X Store - Installer</title>

    <link rel="icon" href="{{ asset('assets/images/favicon.jpeg') }}" type="image/x-icon">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Tailwind + Vite -->
    @vite(["resources/css/app.css", "resources/js/app.js"])

    <style>
        /* Background Gradient Animation */
        body {
            background: linear-gradient(-45deg, #1e3a8a, #3b82f6, #06b6d4, #14b8a6);
            background-size: 400% 400%;
            animation: gradientShift 18s ease infinite;
        }
        @keyframes gradientShift {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        /* Fade-Up Animation */
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .fade-up { animation: fadeUp 0.8s ease-out forwards; }

        /* Progress Bar Smooth */
        .progress-bar {
            transition: width 0.8s ease-in-out;
        }

        /* Gradient Text Effect */
        .gradient-text {
            background: linear-gradient(90deg, #6366f1, #06b6d4, #3b82f6);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center text-gray-900 dark:text-gray-100 font-[figtree] p-6">

    <!-- Card -->
    <div class="bg-white/95 dark:bg-gray-900/95 shadow-2xl border border-gray-200 dark:border-gray-800 backdrop-blur-md rounded-2xl w-full max-w-3xl p-8 fade-up">

        <!-- Title -->
        <h1 class="text-4xl font-extrabold text-center mb-8 gradient-text drop-shadow-lg">
            🚀 GSM X STORE - INSTALLER
        </h1>

        <!-- Progress Bar -->
        <div class="w-full bg-gray-200 dark:bg-gray-800 rounded-full h-3 mb-8 shadow-inner">
            <div id="progress" class="progress-bar bg-gradient-to-r from-indigo-500 via-sky-500 to-cyan-400 h-3 rounded-full w-1/3"></div>
        </div>

        <!-- Requirements Section -->
        <div id="requirements-section" class="space-y-4 fade-up">
            <p class="text-gray-600 dark:text-gray-400 text-center">System requirements check</p>
            <h3 class="font-semibold text-lg text-indigo-600 dark:text-cyan-400">✅ System Requirements</h3>

            <ul class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @foreach([
                    'PHP ≥ 8.3'             => $requirements['php'],
                    'ionCube Loader ≥ 14.4' => $requirements['ioncube'],
                    'ZIP Extension'         => $requirements['zip'],
                    'cURL'                  => $requirements['curl'],
                    'SSL (OpenSSL)'         => $requirements['ssl'],
                    'PDO Extension'         => $requirements['pdo'],
                    'XML Extension'         => $requirements['xml'],
                    'SimpleXML Extension'   => $requirements['simplexml'],
                    'Memory Limit ≥ 256MB'  => $requirements['memory_limit'](),
                    'License Status'        => $licenseStatus,
                ] as $label => $status)
                <li class="flex items-center justify-between bg-gradient-to-r from-gray-50 to-gray-100 dark:from-gray-800 dark:to-gray-900 p-3 rounded-lg shadow-md transition transform hover:scale-[1.02]">
                    <span class="font-medium text-gray-700 dark:text-gray-300">{{ $label }}</span>
                    <span class="font-bold text-lg {{ $status ? 'text-emerald-500' : 'text-red-500' }}">
                        {{ $status ? '✅' : '❌' }}
                    </span>
                </li>
                @endforeach
            </ul>

            @if ($allPassed && $licenseStatus)
                <div class="mt-6 text-center">
                    <button id="next-button" class="w-full bg-gradient-to-r from-indigo-500 to-blue-600 hover:from-indigo-600 hover:to-blue-700 text-white font-semibold py-3 rounded-xl transition-all duration-300 shadow-md hover:shadow-xl transform hover:-translate-y-1">
                        Next →
                    </button>
                </div>
            @else
                <div class="mt-6 text-red-500 font-semibold text-center animate-pulse">
                    ⚠️ Please fix the failed requirements and ensure license is active.
                </div>
            @endif
        </div>

        <!-- Form Section -->
        <div id="form-section" class="hidden fade-up">
            <p class="text-gray-600 dark:text-gray-400 mb-6 text-center">System installation</p>

            @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4 shadow-md">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form method="POST" action="{{ route('install.process') }}" class="space-y-6">
                @csrf

                <!-- Database Config -->
                <div>
                    <h4 class="font-semibold text-md mb-2 text-indigo-600 dark:text-cyan-400">Database Configuration</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <input type="text" name="db_host" placeholder="Database Host" value="127.0.0.1" required class="rounded-lg border-gray-300 dark:border-gray-700 px-4 py-2 dark:bg-gray-800 focus:ring-2 focus:ring-indigo-500 text-gray-800 dark:text-gray-100" />
                        <input type="text" name="db_port" placeholder="Database Port" value="3306" required class="rounded-lg border-gray-300 dark:border-gray-700 px-4 py-2 dark:bg-gray-800 focus:ring-2 focus:ring-indigo-500 text-gray-800 dark:text-gray-100" />
                        <input type="text" name="db_name" placeholder="Database Name" required class="rounded-lg border-gray-300 dark:border-gray-700 px-4 py-2 dark:bg-gray-800 focus:ring-2 focus:ring-indigo-500 text-gray-800 dark:text-gray-100" />
                        <input type="text" name="db_user" placeholder="Database User" required class="rounded-lg border-gray-300 dark:border-gray-700 px-4 py-2 dark:bg-gray-800 focus:ring-2 focus:ring-indigo-500 text-gray-800 dark:text-gray-100" />
                        <input type="password" name="db_pass" placeholder="Database Password" class="rounded-lg border-gray-300 dark:border-gray-700 px-4 py-2 dark:bg-gray-800 focus:ring-2 focus:ring-indigo-500 text-gray-800 dark:text-gray-100" />
                        <input type="text" name="api_key" placeholder="License Key" required class="rounded-lg border-gray-300 dark:border-gray-700 px-4 py-2 dark:bg-gray-800 focus:ring-2 focus:ring-indigo-500 text-gray-800 dark:text-gray-100" />
                        <input type="text" name="app_name" placeholder="App Name" required class="rounded-lg border-gray-300 dark:border-gray-700 px-4 py-2 dark:bg-gray-800 focus:ring-2 focus:ring-indigo-500 text-gray-800 dark:text-gray-100 col-span-1 md:col-span-2" />
                    </div>
                </div>

                <!-- Admin Config -->
                <div>
                    <h4 class="font-semibold text-md mt-6 mb-2 text-indigo-600 dark:text-cyan-400">Admin Configuration</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <input type="text" name="admin_name" placeholder="Admin Name" required class="rounded-lg border-gray-300 dark:border-gray-700 px-4 py-2 dark:bg-gray-800 focus:ring-2 focus:ring-indigo-500 text-gray-800 dark:text-gray-100" />
                        <input type="email" name="admin_email" placeholder="Admin Email" required class="rounded-lg border-gray-300 dark:border-gray-700 px-4 py-2 dark:bg-gray-800 focus:ring-2 focus:ring-indigo-500 text-gray-800 dark:text-gray-100" />
                        <input type="password" name="admin_password" placeholder="Admin Password" required class="rounded-lg border-gray-300 dark:border-gray-700 px-4 py-2 dark:bg-gray-800 focus:ring-2 focus:ring-indigo-500 text-gray-800 dark:text-gray-100 col-span-1 md:col-span-2" />
                    </div>
                </div>

                <!-- Install Button -->
                <button type="submit" class="w-full bg-gradient-to-r from-green-500 to-emerald-600 hover:from-green-600 hover:to-emerald-700 text-white font-semibold py-3 rounded-xl transition-all duration-300 shadow-md hover:shadow-xl transform hover:-translate-y-1">
                    Install Now 🚀
                </button>
            </form>
        </div>
    </div>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const nextButton = document.getElementById("next-button");
    const requirementsSection = document.getElementById("requirements-section");
    const formSection = document.getElementById("form-section");
    const progressBar = document.getElementById("progress");
    const form = formSection?.querySelector("form");

    if (nextButton) {
        nextButton.addEventListener("click", function () {
            requirementsSection.classList.add("hidden");
            formSection.classList.remove("hidden");
            progressBar.style.width = "70%";
        });
    }

    if (form) {
        form.addEventListener("submit", async function (e) {
            e.preventDefault();
            const submitButton = form.querySelector('button[type="submit"]');
            submitButton.disabled = true;
            submitButton.innerText = "Installing... ⏳";
            progressBar.style.width = "90%";

            const formData = new FormData(form);

            try {
                const response = await fetch(form.action, {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
                        "Accept": "application/json",
                    },
                    body: formData,
                });

                const result = await response.json();

                if (!response.ok || result.status !== "success") {
                    let errorMessage = result.message || "❌ Installation failed.";
                    const errorDiv = document.createElement("div");
                    errorDiv.className = "bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4 shadow-md";
                    errorDiv.innerHTML = `<p>${errorMessage}</p>`;
                    form.prepend(errorDiv);
                } else {
                    progressBar.style.width = "100%";
                    if (result.redirect) {
                        window.location.href = result.redirect;
                    } else {
                        alert(result.message || "✅ Installation complete!");
                    }
                }
            } catch (error) {
                const errorDiv = document.createElement("div");
                errorDiv.className = "bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4 shadow-md";
                errorDiv.innerHTML = `<p>❌ Something went wrong. Please try again.</p>`;
                form.prepend(errorDiv);
            } finally {
                submitButton.disabled = false;
                submitButton.innerText = "Install Now 🚀";
            }
        });
    }
});
</script>
</body>
</html>