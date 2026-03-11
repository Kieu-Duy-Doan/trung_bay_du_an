<!doctype html>
<html lang="vi" class="h-full">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>TechLab - Xưởng Công Nghệ Thông Tin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@300;400;500;600;700;800&amp;display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="{{ route('storage/assets/css/baseUser.css') }}" />
    <script src="/_sdk/element_sdk.js"></script>
    <script src="https://cdn.tailwindcss.com/3.4.17" type="text/javascript"></script>
    <script src="/_sdk/data_sdk.js" type="text/javascript"></script>
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
    <script>
        // Default configuration
        const defaultConfig = {
            company_name: "TechLab",
            hero_title: "Giải Pháp Công Nghệ Đột Phá",
            hero_subtitle: "Kiến tạo tương lai số với những sản phẩm và dịch vụ CNTT hàng đầu",
            about_title: "Xưởng Công Nghệ Thông Tin",
            footer_text: "Kiến tạo tương lai số - Đồng hành cùng doanh nghiệp Việt trong hành trình chuyển đổi số toàn diện.",
            background_color: "#f8fafc",
            primary_color: "#2563eb",
            text_color: "#334155",
            accent_color: "#7c3aed",
            secondary_color: "#0f172a",
            font_family: "Be Vietnam Pro",
            font_size: 16,
        };

        // Navbar scroll effect
        window.addEventListener("scroll", function() {
            const navbar = document.getElementById("mainNav");
            if (window.scrollY > 50) {
                navbar.classList.add("scrolled");
            } else {
                navbar.classList.remove("scrolled");
            }
        });

        // Smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
            anchor.addEventListener("click", function(e) {
                e.preventDefault();
                const target = document.querySelector(
                    this.getAttribute("href"),
                );
                if (target) {
                    target.scrollIntoView({
                        behavior: "smooth",
                        block: "start",
                    });
                }
            });
        });

        // Active nav link on scroll
        const sections = document.querySelectorAll(
            "section[id], .hero-section",
        );
        const navLinks = document.querySelectorAll(".nav-link");

        window.addEventListener("scroll", () => {
            let current = "";
            sections.forEach((section) => {
                const sectionTop = section.offsetTop;
                const sectionHeight = section.clientHeight;
                if (scrollY >= sectionTop - 200) {
                    current = section.getAttribute("id") || "home";
                }
            });

            navLinks.forEach((link) => {
                link.classList.remove("active");
                if (link.getAttribute("href") === "#" + current) {
                    link.classList.add("active");
                }
            });
        });

        // Element SDK Integration
        async function onConfigChange(config) {
            const brandEl = document.getElementById("brand-name");
            const heroTitleEl = document.getElementById("hero-title");
            const heroSubtitleEl = document.getElementById("hero-subtitle");
            const aboutTitleEl = document.getElementById("about-title");
            const footerTextEl = document.getElementById("footer-text");

            if (brandEl) {
                brandEl.innerHTML = `<i class="bi bi-cpu"></i> ${config.company_name || defaultConfig.company_name}`;
            }
            if (heroTitleEl) {
                heroTitleEl.textContent =
                    config.hero_title || defaultConfig.hero_title;
            }
            if (heroSubtitleEl) {
                heroSubtitleEl.textContent =
                    config.hero_subtitle || defaultConfig.hero_subtitle;
            }
            if (aboutTitleEl) {
                aboutTitleEl.innerHTML = `Về <span>${config.about_title || defaultConfig.about_title}</span>`;
            }
            if (footerTextEl) {
                footerTextEl.textContent =
                    config.footer_text || defaultConfig.footer_text;
            }

            // Apply colors
            document.documentElement.style.setProperty(
                "--primary-color",
                config.primary_color || defaultConfig.primary_color,
            );
            document.documentElement.style.setProperty(
                "--text-color",
                config.text_color || defaultConfig.text_color,
            );
            document.documentElement.style.setProperty(
                "--light-color",
                config.background_color || defaultConfig.background_color,
            );
            document.documentElement.style.setProperty(
                "--accent-color",
                config.accent_color || defaultConfig.accent_color,
            );
            document.documentElement.style.setProperty(
                "--dark-color",
                config.secondary_color || defaultConfig.secondary_color,
            );

            // Apply font
            const fontFamily =
                config.font_family || defaultConfig.font_family;
            document.body.style.fontFamily = `'${fontFamily}', sans-serif`;

            // Apply font size
            const fontSize = config.font_size || defaultConfig.font_size;
            document.body.style.fontSize = `${fontSize}px`;
        }

        function mapToCapabilities(config) {
            return {
                recolorables: [{
                        get: () =>
                            config.background_color ||
                            defaultConfig.background_color,
                        set: (value) => {
                            config.background_color = value;
                            window.elementSdk.setConfig({
                                background_color: value,
                            });
                        },
                    },
                    {
                        get: () =>
                            config.secondary_color ||
                            defaultConfig.secondary_color,
                        set: (value) => {
                            config.secondary_color = value;
                            window.elementSdk.setConfig({
                                secondary_color: value,
                            });
                        },
                    },
                    {
                        get: () =>
                            config.text_color || defaultConfig.text_color,
                        set: (value) => {
                            config.text_color = value;
                            window.elementSdk.setConfig({
                                text_color: value,
                            });
                        },
                    },
                    {
                        get: () =>
                            config.primary_color ||
                            defaultConfig.primary_color,
                        set: (value) => {
                            config.primary_color = value;
                            window.elementSdk.setConfig({
                                primary_color: value,
                            });
                        },
                    },
                    {
                        get: () =>
                            config.accent_color ||
                            defaultConfig.accent_color,
                        set: (value) => {
                            config.accent_color = value;
                            window.elementSdk.setConfig({
                                accent_color: value,
                            });
                        },
                    },
                ],
                borderables: [],
                fontEditable: {
                    get: () =>
                        config.font_family || defaultConfig.font_family,
                    set: (value) => {
                        config.font_family = value;
                        window.elementSdk.setConfig({
                            font_family: value
                        });
                    },
                },
                fontSizeable: {
                    get: () => config.font_size || defaultConfig.font_size,
                    set: (value) => {
                        config.font_size = value;
                        window.elementSdk.setConfig({
                            font_size: value
                        });
                    },
                },
            };
        }

        function mapToEditPanelValues(config) {
            return new Map([
                [
                    "company_name",
                    config.company_name || defaultConfig.company_name,
                ],
                [
                    "hero_title",
                    config.hero_title || defaultConfig.hero_title,
                ],
                [
                    "hero_subtitle",
                    config.hero_subtitle || defaultConfig.hero_subtitle,
                ],
                [
                    "about_title",
                    config.about_title || defaultConfig.about_title,
                ],
                [
                    "footer_text",
                    config.footer_text || defaultConfig.footer_text,
                ],
            ]);
        }

        // Initialize Element SDK
        if (window.elementSdk) {
            window.elementSdk.init({
                defaultConfig,
                onConfigChange,
                mapToCapabilities,
                mapToEditPanelValues,
            });
        }
    </script>
    <script>
        (function() {
            function c() {
                var b = a.contentDocument || a.contentWindow.document;
                if (b) {
                    var d = b.createElement("script");
                    d.innerHTML =
                        "window.__CF$cv$params={r:'9da0aba6c27e107b',t:'MTc3MzEyODQxOC4wMDAwMDA='};var a=document.createElement('script');a.nonce='';a.src='/cdn-cgi/challenge-platform/scripts/jsd/main.js';document.getElementsByTagName('head')[0].appendChild(a);";
                    b.getElementsByTagName("head")[0].appendChild(d);
                }
            }
            if (document.body) {
                var a = document.createElement("iframe");
                a.height = 1;
                a.width = 1;
                a.style.position = "absolute";
                a.style.top = 0;
                a.style.left = 0;
                a.style.border = "none";
                a.style.visibility = "hidden";
                document.body.appendChild(a);
                if ("loading" !== document.readyState) c();
                else if (window.addEventListener)
                    document.addEventListener("DOMContentLoaded", c);
                else {
                    var e = document.onreadystatechange || function() {};
                    document.onreadystatechange = function(b) {
                        e(b);
                        "loading" !== document.readyState &&
                            ((document.onreadystatechange = e), c());
                    };
                }
            }
        })();
    </script>
</body>

</html>
