<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }}</title>
    <link rel="shortcut icon" type="image/jpg" href="https://i.imgur.com/UyXqJLi.png" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(120deg, #2563eb 0%, #1d4ed8 100%);
            min-height: 100vh;
        }
        .auth-card {
            background: rgba(255, 255, 255, 0.98);
            border-radius: 1rem;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        }
        .input-field {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1px solid #e5e7eb;
            border-radius: 0.5rem;
            transition: all 200ms;
        }
        .input-field:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.2);
        }
        .btn-primary {
            width: 100%;
            padding: 0.75rem 1rem;
            background-color: #2563eb;
            color: white;
            border-radius: 0.5rem;
            font-weight: 500;
            transition: all 200ms;
        }
        .btn-primary:hover {
            background-color: #1d4ed8;
        }
    </style>
</head>
<body class="antialiased">
    <main class="flex items-center justify-center min-h-screen p-4">
        @yield('content')
    </main>
</body>
</html>
