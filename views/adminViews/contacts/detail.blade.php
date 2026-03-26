@extends('layouts.admin')

@section('link_css')
    <link rel="stylesheet" href="{{ route('storage/assets/css/contactDetailAdmin.css') }}" />
@endsection

@section('content')
    <div class="app-wrapper">
        <!-- Main Content -->
        <div class="container py-4 mt-5">
            <div class="main-card">
                <div class="card-top-bar"></div>
                <!-- Avatar & Name -->
                <div class="contact-avatar-section">
                    <div class="avatar-circle">
                        NT
                    </div>
                    <h2 class="contact-name-header">{{ $contact['name'] }}</h2>
                    <div class="contact-id-badge">
                        <i class="fas fa-hashtag"></i>
                        # {{ $contact['id'] }}
                    </div>
                </div>
                <!-- Detail Fields -->
                <div class="detail-section">
                    <div class="detail-row">
                        <div class="detail-icon-box icon-blue">
                            <i class="fas fa-user"></i>
                        </div>
                        <div class="detail-content">
                            <div class="detail-label">
                                Tên người gửi
                            </div>
                            <div class="detail-value">
                                {{ $contact['name'] }}
                            </div>
                        </div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-icon-box icon-purple"><i class="fas fa-envelope"></i>
                        </div>
                        <div class="detail-content">
                            <div class="detail-label">
                                Email
                            </div>
                            <div class="detail-value">
                                <a href="mailto:nguyenthanh@email.com">{{ $contact['email'] }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-icon-box icon-emerald">
                            <i class="fas fa-phone"></i>
                        </div>
                        <div class="detail-content">
                            <div class="detail-label">
                                Số điện thoại
                            </div>
                            <div class="detail-value">
                                <a href="tel:+84901234567">{{ $contact['phoneNumber'] }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-icon-box icon-amber">
                            <i class="fas fa-fingerprint"></i>
                        </div>
                        <div class="detail-content">
                            <div class="detail-label">
                                Mã liên hệ (ID)
                            </div>
                            <div class="detail-value">
                                # {{ $contact['id'] }}
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Message -->
                <div class="message-section">
                    <div class="message-label">
                        <i class="fas fa-comment-dots" style="color: var(--accent-color);"></i>
                        Lời nhắn
                    </div>
                    <div class="message-box">
                        {{ $contact['message'] }}
                    </div>
                </div>
                <!-- Action Buttons -->
                <div class="card-footer-section">
                    <a href="{{ route('contact/prepare/' . $contact['id']) }}" class="btn-action btn-primary-custom">
                        <i class="fas fa-reply"></i>
                        Phản hồi
                    </a>
                    <a href="#" class="btn-action btn-outline-custom">
                        <i class="fas fa-arrow-left"></i> Quay lại
                    </a>
                    <a href="#" class="btn-action btn-danger-outline ms-auto">
                        <i class="fas fa-trash-alt"></i> Xoá
                    </a>
                </div>
                <!-- Timestamp -->
                <div class="timestamp-bar">
                    <i class="fas fa-clock"></i>
                    Nhận lúc: 15/06/2025 — 14:32
                </div>
            </div>
        </div>
    </div>
@endsection
