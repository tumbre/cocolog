@section('title', __('403'))

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @hasSection('title')
        <title>@yield('title') | {{ config('app.name') }}</title>
    @else
        <title>{{ config('app.name') }}</title>
    @endif
    <link rel="shortcut icon" href="{{ asset('/favicon.png') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Zen+Kaku+Gothic+New&display=swap" rel="stylesheet">    <link href="https://fonts.googleapis.com/css2?family=Zen+Kaku+Gothic+New:wght@300&family=Zen+Maru+Gothic&display=swap" rel="stylesheet">    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300&family=Zen+Maru+Gothic&display=swap" rel="stylesheet">    <link href="https://fonts.googleapis.com/css2?family=Zen+Maru+Gothic&display=swap" rel="stylesheet">    
    <style>body { font-family: 'Zen Kaku Gothic New', sans-serif; }</style>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="Zen Kaku Gothic New bg-first text-fourth antialiased">
    <div class="min-h-screen">
        <div class="flex min-h-screen bg-third">
            <div class="flex flex-col justify-center flex-1 px-8 py-8 md:px-12 lg:flex-none lg:px-24">
                <div class="w-full mx-auto lg:max-w-6xl">
                    <div class="max-w-xl lg:p-10">
                        <div>
                            <p class="text-4xl text-white">
                                Error 404
                            </p>
                            <p class="max-w-xl mt-4 text-lg tracking-tight text-gray-400">
                                Please check the URL in the address bar and try again.
                            </p>
                        </div>
                        <div class="flex gap-3 mt-10">
                            <a class="items-center justify-center w-full px-6 py-2.5 text-center text-white duration-200 bg-black border-2 border-black rounded-full nline-flex hover:bg-transparent hover:border-black hover:text-black focus:outline-none lg:w-auto focus-visible:outline-black text-sm focus-visible:ring-black"
                                href="/">
                                Go home
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="relative flex-1 hidden w-0 lg:block min-h-screen">
                <div class="absolute z-10 w-full h-full bg-white overflow-hidden">
                    <img src="{{ asset('images/hiroshima.jpg') }}" alt="" class="object-cover w-full h-full">
                </div>
            </div>            
        </div>
    </div>
</body>

