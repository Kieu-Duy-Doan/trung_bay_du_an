<nav class="navbar navbar-expand-lg navbar-custom fixed-top" id="mainNav">
    <div class="container">
        <a class="navbar-brand" href="#" id="brand-name">
            <i class="bi bi-cpu"></i> XUONGCNTT
        </a>
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <nav style="visibility: unset" class="collapse navbar-collapse" id="navbarNav" aria-label="Main navigation">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link {{ $active == 'home' ? 'active' : '' }}" href="{{ route('home') }}">Trang chủ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ $active == 'products' ? 'active' : '' }}" href="{{ route('home') }}">Sản
                        phẩm</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ $active == 'teams' ? 'active' : '' }}" href="{{ route('home') }}">Đội ngũ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ $active == 'introduction' ? 'active' : '' }}" href="{{ route('home') }}">Giới
                        thiệu</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ $active == 'contact' ? 'active' : '' }}" href="{{ route('contact') }}">Liên
                        hệ</a>
                </li>
            </ul>
        </nav>
    </div>
</nav>
