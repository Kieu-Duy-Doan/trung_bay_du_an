<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"
        integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ route('storage/assets/css/base.css') }}">
    @yield('link_css')
    <style>
        .nav-item.active>.nav-link {
            color: red;
        }

        .wrapper {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .main {
            flex: 1;
        }
    </style>
</head>

<body>

    <div class="wrapper">
        @include('partials.header')

        <div class="container-fluid main">
            <div class="row">
                <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar">
                    <div class="position-sticky pt-3">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link {{ str_contains($_SERVER['REQUEST_URI'], 'users') ? 'active' : '' }}"
                                    href="{{ route('users') }}">
                                    <i class="fa-regular fa-user"></i>
                                    Quản lý người dùng
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ str_contains($_SERVER['REQUEST_URI'], 'categories') ? 'active' : '' }}"
                                    href="{{ route('categories') }}">
                                    <i class="fa-solid fa-list"></i>
                                    Quản lý danh mục
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ str_contains($_SERVER['REQUEST_URI'], 'projects') ? 'active' : '' }}"
                                    href="{{ route('projects') }}">
                                    <i class="fa-solid fa-address-book"></i>
                                    Quản lý dự án
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ str_contains($_SERVER['REQUEST_URI'], 'teams') ? 'active' : '' }}"
                                    href="{{ route('teams') }}">
                                    <i class="fa-solid fa-users"></i>
                                    Quản lý teams
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ str_contains($_SERVER['REQUEST_URI'], 'members') ? 'active' : '' }}"
                                    href="{{ route('members') }}">
                                    <i class="fa-solid fa-person-walking-dashed-line-arrow-right"></i>
                                    Quản lý thành viên
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ str_contains($_SERVER['REQUEST_URI'], 'banners') ? 'active' : '' }}"
                                    href="{{ route('banners') }}">
                                    <i class="fa-solid fa-flag"></i>
                                    Quản lý banner
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ str_contains($_SERVER['REQUEST_URI'], 'contacts') ? 'active' : '' }}"
                                    href="{{ route('contacts') }}">
                                    <i class="fa-solid fa-address-book"></i>
                                    Quản lý liên hệ
                                </a>
                            </li>
                        </ul>
                    </div>
                </nav>

                <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                    @yield('content')
                </main>
            </div>
        </div>

        @include('partials.footer')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/lucide@0.263.0/dist/umd/lucide.min.js"></script>
    <script src="https://cdn.tailwindcss.com/3.4.17" type="text/javascript"></script>
</body>

</html>
