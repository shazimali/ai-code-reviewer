<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Review Results - AI Code Reviewer</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Outfit', sans-serif; }
        .markdown-body h1 { font-size: 1.5rem; font-weight: 700; margin-bottom: 1rem; color: #60a5fa; }
        .markdown-body h2 { font-size: 1.25rem; font-weight: 600; margin-top: 1.5rem; margin-bottom: 0.75rem; color: #ddd; }
        .markdown-body h3 { font-size: 1.125rem; font-weight: 600; margin-top: 1.25rem; margin-bottom: 0.5rem; color: #ddd; }
        .markdown-body ul { list-style-type: disc; padding-left: 1.5rem; margin-bottom: 1rem; }
        .markdown-body ol { list-style-type: decimal; padding-left: 1.5rem; margin-bottom: 1rem; }
        .markdown-body p { margin-bottom: 1rem; line-height: 1.6; }
        .markdown-body code { background-color: #1e293b; padding: 0.2rem 0.4rem; rounded: 0.25rem; font-family: monospace; }
        .markdown-body pre { background-color: #1e293b; padding: 1rem; border-radius: 0.5rem; overflow-x: auto; margin-bottom: 1rem; }
        .markdown-body pre code { background-color: transparent; padding: 0; }
        .markdown-body blockquote { border-left: 4px solid #3b82f6; padding-left: 1rem; font-style: italic; color: #94a3b8; }
    </style>
</head>
<body class="bg-slate-900 text-slate-100 min-h-screen flex flex-col">

    <header class="py-6 px-8 border-b border-slate-700 bg-slate-800/50 backdrop-blur-md sticky top-0 z-10">
        <div class="max-w-6xl mx-auto flex items-center justify-between">
            <h1 class="text-2xl font-bold bg-gradient-to-r from-blue-400 to-emerald-400 bg-clip-text text-transparent">AI Code Reviewer</h1>
            <nav>
                <a href="{{ route('home') }}" class="text-white hover:text-blue-400 transition font-medium">← Back to Home</a>
            </nav>
        </div>
    </header>

    <main class="flex-grow p-6">
        <div class="max-w-6xl mx-auto grid grid-cols-1 lg:grid-cols-2 gap-8">
            
            <!-- Original Code Column -->
            <div class="bg-slate-800 rounded-2xl shadow-xl overflow-hidden border border-slate-700 flex flex-col h-[calc(100vh-12rem)]">
                <div class="bg-slate-700/50 px-6 py-4 border-b border-slate-600 flex justify-between items-center">
                    <h3 class="font-semibold text-slate-200">Original Code</h3>
                    <span class="text-xs text-slate-400 font-mono">Input</span>
                </div>
                <div class="flex-grow overflow-auto p-0">
                    <pre class="h-full p-6 text-sm font-mono text-slate-300 leading-relaxed">{{ $originalCode }}</pre>
                </div>
            </div>

            <!-- Review Results Column -->
            <div class="bg-slate-800 rounded-2xl shadow-xl overflow-hidden border border-slate-700 flex flex-col h-[calc(100vh-12rem)]">
                <div class="bg-slate-700/50 px-6 py-4 border-b border-slate-600 flex justify-between items-center">
                    <h3 class="font-semibold text-emerald-400">AI Review Feedback</h3>
                    <span class="text-xs text-slate-400 font-mono">Analysis</span>
                </div>
                <div class="flex-grow overflow-auto p-6 bg-slate-800/80">
                    <div id="review-content" class="markdown-body text-slate-300">
                        <!-- Content injected via JS -->
                    </div>
                </div>
            </div>

        </div>
    </main>

    <script>
        // Render Markdown
        const rawMarkdown = {!! json_encode($review) !!};
        document.getElementById('review-content').innerHTML = marked.parse(rawMarkdown);
    </script>

</body>
</html>
