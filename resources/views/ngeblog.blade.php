<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Ngeblog Administration</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:300,400,500,600,700" rel="stylesheet" />
    

    <link rel="stylesheet" href="{{ route('resolve-css') }}">
    <script>
        window.Ngeblog = @json($ngeblogFrontendConfig);
    </script>
    <script type="module" src="{{ route('resolve-js') }}"></script>
</head>
<body class="font-sans antialiased scroll-smooth">
    <div id="ngeblog-app"></div>
</body>
</html>
