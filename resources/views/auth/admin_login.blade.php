<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-r from-blue-400 to-blue-600 min-h-screen flex items-center justify-center">

    <div class="bg-white shadow-2xl rounded-2xl w-full max-w-md p-8">
        <h2 class="text-3xl font-bold text-center text-blue-700 mb-6">Admin Login</h2>

        <form method="POST" action="{{ route('admin.login.submit') }}" class="space-y-6">
            @csrf

            <!-- Email -->
            <div class="relative">
                <input
                    type="email"
                    name="email"
                    placeholder="Admin Email"
                    required
                    class="peer placeholder-transparent h-12 w-full border-b-2 border-blue-300 text-gray-900 focus:outline-none focus:border-blue-500"
                >
                <label class="absolute left-0 -top-3.5 text-blue-500 text-sm transition-all peer-placeholder-shown:top-3 peer-placeholder-shown:text-gray-400 peer-placeholder-shown:text-base">
                    Email
                </label>
            </div>

            <!-- Password -->
            <div class="relative">
                <input
                    type="password"
                    name="password"
                    placeholder="Password"
                    required
                    class="peer placeholder-transparent h-12 w-full border-b-2 border-blue-300 text-gray-900 focus:outline-none focus:border-blue-500"
                >
                <label class="absolute left-0 -top-3.5 text-blue-500 text-sm transition-all peer-placeholder-shown:top-3 peer-placeholder-shown:text-gray-400 peer-placeholder-shown:text-base">
                    Password
                </label>
            </div>

            <!-- Error Message -->
            @if ($errors->any())
                <div class="text-red-500 text-sm text-center">
                    {{ $errors->first() }}
                </div>
            @endif

            <!-- Submit Button -->
            <button
                type="submit"
                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded-lg shadow-md transition-all duration-300"
            >
                Login
            </button>
        </form>

        <!-- Optional Footer -->
        <p class="text-center text-gray-500 mt-6 text-sm">© {{ date('Y') }} Randour-x</p>
    </div>

</body>
</html>
