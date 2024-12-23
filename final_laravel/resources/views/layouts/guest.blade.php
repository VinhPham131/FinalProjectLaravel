<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>LBJ</title>

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="/css/app.css">
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            @import url("https://fonts.googleapis.com/css2?family=EB+Garamond:wght@400;700&display=swap");
    

            #fontgucci {
                font-family: "EB Garamond", serif;
            }
    
            .col {
                width: 92.5%;
                margin-left: auto;
                margin-right: auto;
            }
        </style>

    </head>
    <body class="antialiased bg-gradient-to-r from-white-500 to-white-100 dark:from-gray-800 dark:to-gray-900 text-gray-900 dark:text-gray-100">
        <div class="min-h-screen flex flex-col items-center justify-center">
            <x-logo-icon />
            <div class="w-full sm:max-w-md bg-white dark:bg-gray-800 shadow-lg rounded-lg overflow-hidden mt-6">
                <div class="px-6 py-4">
                    {{ $slot }}
                </div>
            </div>

            <!-- Footer Section -->
            <footer class="mt-6 text-center text-sm text-gray-600 dark:text-gray-400">
                <p>&copy; {{ now()->year }}. Rizzler's. All rights reserved.</p>
                <p>
                    <a href="#" class="text-blue-500 hover:underline">Privacy Policy</a> | 
                    <a href="#" class="text-blue-500 hover:underline">Terms of Service</a>
                </p>
            </footer>
        </div>
    </body>
</html>