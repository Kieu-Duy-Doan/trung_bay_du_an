<!doctype html>
<html lang="vi" class="h-full">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>TechLab - Xưởng Công Nghệ Thông Tin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="{{ route('storage/assets/css/base.css') }}" />
    @yield('link_css')
</head>

<body>
    <div class="main-wrapper">
        <!-- Navbar -->
        @include('partials.headerUser')
        <!-- Hero Carousel -->
        @yield('content')
        <!-- Footer -->
        @include('partials.footerUser')
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
