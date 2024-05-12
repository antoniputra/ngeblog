<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title ?? 'Blogs' }}</title>

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600,700,900&display=swap" rel="stylesheet" />

    {{-- Use Tailwind CDN --}}
    <script src="https://cdn.tailwindcss.com?plugins=typography"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Figtree'],
                    },
                },
            },
        }
    </script>

    <style>
        .main-title {
            background: -webkit-linear-gradient(45deg, #0ea5e9 40%, #4ade80);
            background-clip: text;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            -webkit-box-decoration-break: clone;
            -webkit-mask-image: -webkit-linear-gradient(45deg, #0ea5e9 40%, #4ade80);
        }
    </style>
</head>
<body>
    <div class="flex flex-col min-h-screen">
        <header class="bg-gray-100 py-1">
            <div class="mx-auto max-w-6xl tracking-wider">
                <a href="{{ route('blogs.index') }}" class="inline-flex py-2 px-4 font-semibold tracking-wider text-lg border rounded bg-sky-500 hover:bg-sky-700 duration-300 text-white">
                    {{ config('app.name') }}
                </a>
            </div>
        </header>

        <main class="flex-grow pb-20">
            @yield('content')
        </main>

        <footer class="py-4 bg-gray-100">
            <div class="mx-auto max-w-6xl text-right">
                <p>&copy; 2024 {{ config('app.name') }}.</p>
            </div>
        </footer>
    </div>

    <script>
        (function () {
            document.addEventListener("DOMContentLoaded", (event) => {
                const formatDate = (
                    theDate,
                    config = {
                        timeZone: null,
                        withTime: true,
                        withDayName: true,
                        locale: "en-US",
                    },
                ) => {
                    const options = {
                        year: "numeric",
                        month: "long",
                        day: "2-digit",
                    };
        
                    if (config.timeZone) {
                        options.timeZone = config.timeZone;
                    }
        
                    if (config.withTime) {
                        options.hour = "numeric";
                        options.minute = "numeric";
                        options.hour12 = false;
                    }
        
                    // * in case we need to display Day Name (Monday)
                    if (config.withDayName) {
                        options.weekday = "long";
                    }
        
                    if (theDate instanceof Date) {
                        return theDate.toLocaleString(config.locale, options);
                    }
        
                    if (typeof theDate === "string") {
                        return new Date(theDate).toLocaleString(config.locale, options);
                    }
                };
        
                document.querySelectorAll('span[data-date]').forEach((el) => {
                    el.innerText = formatDate(new Date(el.getAttribute('data-date')))
                })
            })
        })();
    </script>
</body>
</html>
