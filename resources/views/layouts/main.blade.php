<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark" style="color-scheme: dark;">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="/css/layout.css?v=1736280396801"/>
    <title>Laravel</title>
</head>
<body class="bg-[#FCFCFC] dark:bg-black">
<script>
    !function () {
        try {
            var d = document.documentElement, c = d.classList;
            c.remove("light", "dark");
            var e = localStorage.getItem("theme");
            if (e) {
                c.add(e || "");
            } else {
                c.add("dark");
            }
            if (e === "light" || e === "dark" || !e) d.style.colorScheme = e || "dark";
        } catch (t) {
        }
    }();
</script>

@include('blocks.header')

@yield('content')

@include('blocks.footer')

</body>
</html>
