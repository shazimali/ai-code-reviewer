<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AI Code Reviewer</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Outfit', sans-serif; }
    </style>
</head>
<body class="bg-slate-900 text-slate-100 min-h-screen flex flex-col">

    <header class="py-6 px-8 border-b border-slate-700 bg-slate-800/50 backdrop-blur-md sticky top-0 z-10">
        <div class="max-w-4xl mx-auto flex items-center justify-between">
            <h1 class="text-2xl font-bold bg-gradient-to-r from-blue-400 to-emerald-400 bg-clip-text text-transparent">AI Code Reviewer</h1>
            <nav>
                <a href="#" class="text-slate-400 hover:text-white transition">About</a>
            </nav>
        </div>
    </header>

    <main class="flex-grow flex items-center justify-center p-6">
        <div class="w-full max-w-2xl">
            <div class="text-center mb-10">
                <h2 class="text-4xl font-bold mb-4">Elevate Your Code Quality</h2>
                <p class="text-slate-400">Instant, AI-powered feedback for your code snippets and files.</p>
            </div>

            <div class="bg-slate-800 rounded-2xl shadow-xl p-8 border border-slate-700">
                <form action="{{ route('review') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    
                    <div>
                        <label for="code" class="block text-sm font-medium text-slate-300 mb-2">Paste Code Snippet</label>
                        <textarea name="code" id="code" rows="8" class="w-full bg-slate-900 border border-slate-600 rounded-lg p-4 text-slate-200 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition placeholder-slate-600 font-mono" placeholder="// Paste your code here..."></textarea>
                    </div>

                    <div class="relative flex items-center justify-center py-4">
                        <div class="flex-grow border-t border-slate-700"></div>
                        <span class="flex-shrink-0 mx-4 text-slate-500 text-sm">OR</span>
                        <div class="flex-grow border-t border-slate-700"></div>
                    </div>

                    <div>
                         <label for="file" class="block text-sm font-medium text-slate-300 mb-2">Upload File</label>
                        <input type="file" name="file" id="file" class="block w-full text-sm text-slate-400
                            file:mr-4 file:py-2 file:px-4
                            file:rounded-full file:border-0
                            file:text-sm file:font-semibold
                            file:bg-blue-600 file:text-white
                            hover:file:bg-blue-700
                            cursor-pointer
                        "/>
                    </div>

                    <button type="submit" class="w-full bg-gradient-to-r from-blue-600 to-emerald-600 text-white font-bold py-3 rounded-lg hover:shadow-lg transform hover:-translate-y-0.5 transition duration-200">
                        Analyze Code
                    </button>
                </form>
            </div>
        </div>
    </main>

    <footer class="py-6 text-center text-slate-500 text-sm">
        &copy; {{ date('Y') }} AI Code Reviewer. All rights reserved.
    </footer>

</body>
</html>
