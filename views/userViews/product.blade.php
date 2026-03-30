@extends('layouts.user')

@section('link_css')
    <link rel="stylesheet" href="{{ route('storage/assets/css/users/project.css') }}" />
@endsection

@section('content')
    <main>
        <section class="hero-section">
            <div class="container">
                <div class="hero-content">
                    <div class="hero-badge">
                        <i class="fa-solid fa-sparkles"></i>
                        Bộ sưu tập nổi bật
                    </div>
                    <h1 class="hero-title">
                        Khám phá sản phẩm của xưởng chúng tôi
                    </h1>
                    <p class="hero-text">
                        Tìm kiếm và lọc sản phẩm dễ dàng với giao diện thiết kế hiện đại
                    </p>
                </div>
            </div>
        </section>
        <section class="main-content">
            <div class="container">
                <div class="row g-4">
                    <!-- Sidebar Danh mục (3 cột) -->
                    <aside class="col-lg-3">
                        <div class="sidebar-category">
                            <div class="sidebar-header">
                                <h3>
                                    <i class="fa-solid fa-list me-2"></i>Danh mục
                                </h3>
                            </div>
                            <div class="sidebar-body">
                                <a class="category-item text-decoration-none {{ empty($key) ? 'active' : '' }} text-decoration-none"
                                    href="{{ route('products?sort=id&order=ASC&key=&value=&keyword=&page=1') }}">
                                    <i class="fa-solid fa-th"></i>Tất cả sản phẩm
                                </a>
                                @foreach ($categories as $category)
                                    <a class="category-item text-decoration-none {{ $category['id'] == $value ? 'active' : '' }}"
                                        href="{{ route("products?sort=$sort&order=$order&key=category_id&value={$category['id']}&keyword=$keyword&page=1") }}">
                                        <i class="fa-solid fa-mobile"></i>
                                        {{ $category['name'] }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </aside>
                    <!-- Phần sản phẩm (9 cột) -->
                    <section class="col-lg-9">
                        <!-- Filter và Tìm kiếm -->
                        <div class="filter-card p-4">
                            <div class="row g-3">
                                <div class="col-12 col-md-6">
                                    <label for="searchProduct" class="filter-label">Tìm kiếm</label>
                                    <div class="search-box">
                                        <i class="fa-solid fa-magnifying-glass"></i>
                                        <form
                                            action="{{ route("products?sort=$sort&order=$order&key=category_id&value={$category['id']}&page=1") }}"
                                            method="get">

                                            <input type="text" class="form-control" id="searchProduct" name="keyword"
                                                placeholder="Nhập tên sản phẩm..." />
                                            <button type="submit" hidden>Tìm kiếm</button>
                                        </form>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <label for="sortSelect" class="filter-label">Sắp xếp</label>
                                    <select class="form-select" id="sortSelect">
                                        <option @selected($sort == 'id' && $order == 'ASC')
                                            value="{{ route("products?sort=id&order=ASC&key=$key&value=$value&page=$page") }}">
                                            Cũ nhất
                                        </option>
                                        <option @selected($sort == 'id' && $order == 'DESC')
                                            value="{{ route("products?sort=id&order=DESC&key=$key&value=$value&page=$page") }}">
                                            Mới nhất
                                        </option>
                                        <option @selected($sort == 'name' && $order == 'ASC')
                                            value="{{ route("products?sort=name&order=ASC&key=$key&value=$value&page=$page") }}">
                                            Tên tăng dần
                                        </option>
                                        <option @selected($sort == 'name' && $order == 'DESC')
                                            value="{{ route("products?sort=name&order=DESC&key=$key&value=$value&page=$page") }}">
                                            Tên giảm dần
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <!-- Danh sách sản phẩm -->
                        <div class="row g-4">
                            @foreach ($projects as $project)
                                <div class="col-12 col-sm-6 col-lg-4 col-xl-3">
                                    <article class="product-card">
                                        <div class="product-image-wrap">
                                            <img src="{{ route($project['img']) }}" alt="{{ $category['name'] }}"
                                                class="product-image" />
                                        </div>
                                        <div class="product-body">
                                            <span class="product-category">{{ $project['category_name'] }}</span>
                                            <h3 class="product-title">
                                                {{ $project['name'] }}
                                            </h3>
                                            <a href='{{ route('product/' . $project['id']) }}' class="btn btn-detail">
                                                <i class="fa-solid fa-eye me-2"></i>Xem chi tiết
                                            </a>
                                        </div>
                                    </article>
                                </div>
                            @endforeach
                        </div>
                        <!-- Phân trang -->
                        <div class="d-flex justify-content-center align-items-center gap-2 my-5 flex-wrap">
                            <a class="btn btn-outline-primary btn-sm rounded-pill px-3 {{ $page == 1 ? 'disabled' : '' }}"
                                style="border-radius: 999px !important"
                                href="{{ route("products?sort=$sort&order=$order&key=$key&value=$value&keyword=$keyword&page=" . max($page - 1, 1)) }}">
                                <i class="fa-solid fa-chevron-left me-1"> </i>Trước
                            </a>
                            <div class="d-flex gap-2">
                                @for ($i = 1; $i < $totalPages + 1; $i++)
                                    <a class="btn btn-sm {{ $page == $i ? 'btn-primary' : 'btn-outline-primary' }} rounded-pill"
                                        style="
                                                border-radius: 999px !important;
                                                min-width: 40px;
                                            "
                                        href="{{ route("products?sort=$sort&order=$order&key=$key&value=$value&keyword=$keyword&page=$i") }}">
                                        {{ $i }}
                                    </a>
                                @endfor
                            </div>
                            <a class="btn btn-outline-primary btn-sm rounded-pill px-3 {{ $page == $totalPages ? 'disabled' : '' }}"
                                style="border-radius: 999px !important"
                                href="{{ route("products?sort=$sort&order=$order&key=$key&value=$value&keyword=$keyword&page=" . min($page + 1, $totalPages)) }}">
                                >
                                Sau
                                <i class="fa-solid fa-chevron-right ms-1"></i>
                            </a>
                        </div>
                        <div class="text-center">
                            <p class="footer-note mb-0">
                                Hiển thị {{ $offset + 1 }}-{{ $offset + $limit }} trên {{ $totalProjects }} sản phẩm
                            </p>
                        </div>
                    </section>
                </div>
            </div>
        </section>
    </main>

    <script src="{{ route('storage/assets/js/users/product.js') }}"></script>
@endsection
