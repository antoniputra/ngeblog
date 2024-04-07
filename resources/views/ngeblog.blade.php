<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ngeblog Administration</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:300,400,500,600" rel="stylesheet" />

    <link rel="stylesheet" href="{{ asset('/ngeblog/resolve-css') }}">
    <script>
        window.NgeblogBasePath = @json($ngeblogBasePath);
    </script>
    <script type="module" src="{{ asset('/ngeblog/resolve-js') }}"></script>
</head>
<body class="font-sans antialiased">
    <div id="ngeblog-app"></div>
</body>
</html>
