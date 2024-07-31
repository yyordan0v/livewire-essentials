<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Livewire Data Tables' }}</title>

    <script src="//cdn.tailwindcss.com"></script>
    {{-- <script defer src="https://unpkg.com/@alpinejs/ui@3.13.3-beta.4/dist/cdn.min.js"></script> --}}
    <script defer src="http://alpine.test/packages/ui/dist/cdn.js"></script>
    <link href="https://unpkg.com/@tailwindcss/forms@0.2.1/dist/forms.min.css" rel="stylesheet">
    @livewireStyles
</head>
<body>
<main class="w-full px-64 flex justify-center py-12">
    {{ $slot }}
</main>

@livewireScripts
</body>
</html>
