@extends('layouts.user')

@section('content')
    <section class="hero-section" id="home">
        <div id="heroCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="5000">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active"
                    aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active slide-1">
                    <div class="floating-shapes">
                        <div class="shape shape-1"></div>
                        <div class="shape shape-2"></div>
                        <div class="shape shape-3"></div>
                        <div class="shape shape-4"></div>
                    </div>
                    <div class="carousel-caption">
                        <h1 class="hero-title" id="hero-title">
                            Giải Pháp Công Nghệ Đột Phá
                        </h1>
                        <p class="hero-subtitle" id="hero-subtitle">
                            Kiến tạo tương lai số với những sản phẩm và
                            dịch vụ CNTT hàng đầu
                        </p>
                        <a href="#products" class="btn btn-hero btn-hero-primary me-3">
                            <i class="bi bi-rocket-takeoff me-2"></i>Khám phá ngay
                        </a>
                        <a href="#contact" class="btn btn-hero btn-hero-outline">
                            <i class="bi bi-chat-dots me-2"></i>Liên hệ
                            tư vấn
                        </a>
                    </div>
                </div>
                <div class="carousel-item slide-2">
                    <div class="floating-shapes">
                        <div class="shape shape-1"></div>
                        <div class="shape shape-2"></div>
                        <div class="shape shape-3"></div>
                        <div class="shape shape-4"></div>
                    </div>
                    <div class="carousel-caption">
                        <h1 class="hero-title">
                            Đội Ngũ Chuyên Gia Hàng Đầu
                        </h1>
                        <p class="hero-subtitle">
                            Hơn 50 kỹ sư công nghệ với kinh nghiệm đa
                            dạng và sáng tạo
                        </p>
                        <a href="#team" class="btn btn-hero btn-hero-primary me-3">
                            <i class="bi bi-people me-2"></i>Gặp gỡ Team
                        </a>
                        <a href="#about" class="btn btn-hero btn-hero-outline">
                            <i class="bi bi-info-circle me-2"></i>Tìm
                            hiểu thêm
                        </a>
                    </div>
                </div>
                <div class="carousel-item slide-3">
                    <div class="floating-shapes">
                        <div class="shape shape-1"></div>
                        <div class="shape shape-2"></div>
                        <div class="shape shape-3"></div>
                        <div class="shape shape-4"></div>
                    </div>
                    <div class="carousel-caption">
                        <h1 class="hero-title">Đối Tác Tin Cậy</h1>
                        <p class="hero-subtitle">
                            Đồng hành cùng hơn 500+ doanh nghiệp trong
                            chuyển đổi số
                        </p>
                        <a href="#products" class="btn btn-hero btn-hero-primary me-3">
                            <i class="bi bi-graph-up-arrow me-2"></i>Xem
                            dự án
                        </a>
                        <a href="#contact" class="btn btn-hero btn-hero-outline">
                            <i class="bi bi-telephone me-2"></i>Hotline
                            24/7
                        </a>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon"></span>
            </button>
        </div>
    </section>
    <!-- Products Section -->
    <section class="py-5" id="products" style="padding: 100px 0">
        <div class="container">
            <header class="text-center mb-5">
                <h2 class="section-title">
                    Sản Phẩm <span>Nổi Bật</span>
                </h2>
                <p class="section-subtitle">
                    Khám phá các giải pháp công nghệ tiên tiến được phát
                    triển bởi đội ngũ chuyên gia của chúng tôi
                </p>
            </header>
            <div class="row g-4">
                <div class="col-lg-3 col-md-6">
                    <article class="product-card">
                        <div class="product-image"
                            style="
                                        background: linear-gradient(
                                            135deg,
                                            #667eea20,
                                            #764ba220
                                        );
                                    ">
                            <span class="product-badge">Hot</span>
                            <i class="bi bi-laptop" style="color: #667eea"></i>
                        </div>
                        <div class="product-body">
                            <h3 class="product-title">Hệ Thống ERP</h3>
                            <p class="product-description">
                                Quản lý doanh nghiệp toàn diện, tích hợp
                                AI
                            </p>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="product-price">50M+</span>
                                <button class="btn btn-product">
                                    Chi tiết
                                    <i class="bi bi-arrow-right"></i>
                                </button>
                            </div>
                        </div>
                    </article>
                </div>
                <div class="col-lg-3 col-md-6">
                    <article class="product-card">
                        <div class="product-image"
                            style="
                                        background: linear-gradient(
                                            135deg,
                                            #2563eb20,
                                            #7c3aed20
                                        );
                                    ">
                            <i class="bi bi-phone" style="color: #2563eb"></i>
                        </div>
                        <div class="product-body">
                            <h3 class="product-title">App Mobile</h3>
                            <p class="product-description">
                                Ứng dụng di động đa nền tảng iOS &amp;
                                Android
                            </p>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="product-price">30M+</span>
                                <button class="btn btn-product">
                                    Chi tiết
                                    <i class="bi bi-arrow-right"></i>
                                </button>
                            </div>
                        </div>
                    </article>
                </div>
                <div class="col-lg-3 col-md-6">
                    <article class="product-card">
                        <div class="product-image"
                            style="
                                        background: linear-gradient(
                                            135deg,
                                            #05966920,
                                            #0891b220
                                        );
                                    ">
                            <span class="product-badge">New</span>
                            <i class="bi bi-cloud" style="color: #059669"></i>
                        </div>
                        <div class="product-body">
                            <h3 class="product-title">
                                Cloud Services
                            </h3>
                            <p class="product-description">
                                Hạ tầng đám mây an toàn, mở rộng linh
                                hoạt
                            </p>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="product-price">20M+</span>
                                <button class="btn btn-product">
                                    Chi tiết
                                    <i class="bi bi-arrow-right"></i>
                                </button>
                            </div>
                        </div>
                    </article>
                </div>
                <div class="col-lg-3 col-md-6">
                    <article class="product-card">
                        <div class="product-image"
                            style="
                                        background: linear-gradient(
                                            135deg,
                                            #ec489920,
                                            #f4374420
                                        );
                                    ">
                            <i class="bi bi-shield-check" style="color: #ec4899"></i>
                        </div>
                        <div class="product-body">
                            <h3 class="product-title">
                                Cyber Security
                            </h3>
                            <p class="product-description">
                                Bảo mật toàn diện cho hệ thống của bạn
                            </p>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="product-price">40M+</span>
                                <button class="btn btn-product">
                                    Chi tiết
                                    <i class="bi bi-arrow-right"></i>
                                </button>
                            </div>
                        </div>
                    </article>
                </div>
            </div>
        </div>
    </section>
    <!-- Team Section -->
    <section class="team-section py-5" id="team" style="padding: 100px 0">
        <div class="container">
            <header class="text-center mb-5">
                <h2 class="section-title">
                    Đội Ngũ <span>Chuyên Gia</span>
                </h2>
                <p class="section-subtitle">
                    Những con người tài năng và nhiệt huyết đứng sau
                    thành công của TechLab
                </p>
            </header>
            <div class="row g-4">
                <div class="col-lg-3 col-md-6">
                    <article class="team-card">
                        <div class="team-avatar"
                            style="
                                        background: linear-gradient(
                                            135deg,
                                            #667eea,
                                            #764ba2
                                        );
                                    ">
                            <i class="bi bi-person"></i>
                        </div>
                        <h3 class="team-name">Nguyễn Văn An</h3>
                        <p class="team-role">CEO &amp; Founder</p>
                        <p class="team-bio">
                            15+ năm kinh nghiệm trong lĩnh vực CNTT và
                            quản lý doanh nghiệp
                        </p>
                        <div class="team-social">
                            <a href="#" aria-label="LinkedIn của Nguyễn Văn An"><i class="bi bi-linkedin"></i></a>
                            <a href="#" aria-label="Twitter của Nguyễn Văn An"><i class="bi bi-twitter"></i></a>
                            <a href="#" aria-label="GitHub của Nguyễn Văn An"><i class="bi bi-github"></i></a>
                        </div>
                    </article>
                </div>
                <div class="col-lg-3 col-md-6">
                    <article class="team-card">
                        <div class="team-avatar"
                            style="
                                        background: linear-gradient(
                                            135deg,
                                            #2563eb,
                                            #7c3aed
                                        );
                                    ">
                            <i class="bi bi-person"></i>
                        </div>
                        <h3 class="team-name">Trần Thị Bình</h3>
                        <p class="team-role">CTO</p>
                        <p class="team-bio">
                            Chuyên gia về AI/ML với các công bố quốc tế
                            uy tín
                        </p>
                        <div class="team-social">
                            <a href="#" aria-label="LinkedIn của Trần Thị Bình"><i class="bi bi-linkedin"></i></a>
                            <a href="#" aria-label="Twitter của Trần Thị Bình"><i class="bi bi-twitter"></i></a>
                            <a href="#" aria-label="GitHub của Trần Thị Bình"><i class="bi bi-github"></i></a>
                        </div>
                    </article>
                </div>
                <div class="col-lg-3 col-md-6">
                    <article class="team-card">
                        <div class="team-avatar"
                            style="
                                        background: linear-gradient(
                                            135deg,
                                            #059669,
                                            #0891b2
                                        );
                                    ">
                            <i class="bi bi-person"></i>
                        </div>
                        <h3 class="team-name">Lê Minh Cường</h3>
                        <p class="team-role">Lead Developer</p>
                        <p class="team-bio">
                            Full-stack developer với đam mê công nghệ
                            mới
                        </p>
                        <div class="team-social">
                            <a href="#" aria-label="LinkedIn của Lê Minh Cường"><i class="bi bi-linkedin"></i></a>
                            <a href="#" aria-label="Twitter của Lê Minh Cường"><i class="bi bi-twitter"></i></a>
                            <a href="#" aria-label="GitHub của Lê Minh Cường"><i class="bi bi-github"></i></a>
                        </div>
                    </article>
                </div>
                <div class="col-lg-3 col-md-6">
                    <article class="team-card">
                        <div class="team-avatar"
                            style="
                                        background: linear-gradient(
                                            135deg,
                                            #ec4899,
                                            #f43744
                                        );
                                    ">
                            <i class="bi bi-person"></i>
                        </div>
                        <h3 class="team-name">Phạm Thùy Dung</h3>
                        <p class="team-role">UI/UX Designer</p>
                        <p class="team-bio">
                            Thiết kế trải nghiệm người dùng xuất sắc và
                            sáng tạo
                        </p>
                        <div class="team-social">
                            <a href="#" aria-label="LinkedIn của Phạm Thùy Dung"><i class="bi bi-linkedin"></i></a>
                            <a href="#" aria-label="Dribbble của Phạm Thùy Dung"><i class="bi bi-dribbble"></i></a>
                            <a href="#" aria-label="Behance của Phạm Thùy Dung"><i class="bi bi-behance"></i></a>
                        </div>
                    </article>
                </div>
            </div>
        </div>
    </section>
    <!-- About Section -->
    <section class="about-section py-5" id="about" style="padding: 100px 0">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-6">
                    <h2 class="about-title" id="about-title">
                        Về <span>Xưởng Công Nghệ Thông Tin</span>
                    </h2>
                    <p class="about-text">
                        TechLab được thành lập với sứ mệnh mang đến
                        những giải pháp công nghệ tiên tiến nhất, giúp
                        doanh nghiệp Việt Nam chuyển đổi số thành công.
                        Với đội ngũ hơn 50 kỹ sư tài năng và đam mê,
                        chúng tôi tự hào là đối tác tin cậy của hơn 500
                        doanh nghiệp trong và ngoài nước.
                    </p>
                    <p class="about-text">
                        Chúng tôi không chỉ cung cấp sản phẩm, mà còn
                        đồng hành cùng khách hàng trong suốt hành trình
                        số hóa, từ tư vấn chiến lược đến triển khai và
                        hỗ trợ kỹ thuật 24/7.
                    </p>
                    <div class="about-stats">
                        <div class="stat-item">
                            <div class="stat-number">10+</div>
                            <div class="stat-label">
                                Năm kinh nghiệm
                            </div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-number">500+</div>
                            <div class="stat-label">Khách hàng</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-number">50+</div>
                            <div class="stat-label">Kỹ sư</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-number">99%</div>
                            <div class="stat-label">Hài lòng</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="about-features">
                        <div class="feature-item">
                            <div class="feature-icon">
                                <i class="bi bi-lightbulb"></i>
                            </div>
                            <div class="feature-text">
                                <h5>Sáng Tạo &amp; Đổi Mới</h5>
                                <p>
                                    Luôn tiên phong áp dụng công nghệ
                                    mới nhất vào sản phẩm
                                </p>
                            </div>
                        </div>
                        <div class="feature-item">
                            <div class="feature-icon">
                                <i class="bi bi-award"></i>
                            </div>
                            <div class="feature-text">
                                <h5>Chất Lượng Hàng Đầu</h5>
                                <p>
                                    Cam kết ISO 27001 và các tiêu chuẩn
                                    quốc tế
                                </p>
                            </div>
                        </div>
                        <div class="feature-item">
                            <div class="feature-icon">
                                <i class="bi bi-headset"></i>
                            </div>
                            <div class="feature-text">
                                <h5>Hỗ Trợ 24/7</h5>
                                <p>
                                    Đội ngũ support sẵn sàng hỗ trợ mọi
                                    lúc mọi nơi
                                </p>
                            </div>
                        </div>
                        <div class="feature-item">
                            <div class="feature-icon">
                                <i class="bi bi-graph-up"></i>
                            </div>
                            <div class="feature-text">
                                <h5>Tăng Trưởng Bền Vững</h5>
                                <p>
                                    Đối tác chiến lược cho sự phát triển
                                    dài hạn
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
