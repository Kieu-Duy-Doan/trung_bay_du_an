@extends('layouts.user')

@section('link_css')
    <link rel="stylesheet" href="{{ route('storage/assets/css/contact.css') }}" />
@endsection

@section('content')
    <div class="app-wrapper mt-5">
        <div class="contact-container"><!-- Form Header -->
            <div class="form-header">
                <h1 id="formTitle">Liên hệ với chúng tôi</h1>
                <p id="formDescription">Chúng tôi rất muốn nghe từ bạn. Hãy để lại thông tin và chúng tôi sẽ liên hệ lại
                    trong thời gian sớm nhất.</p>
            </div>
            @if (isset($_SESSION['success']))
                <div class="alert alert-success" role="alert">
                    {{ $_SESSION['success'] }}
                </div>
            @endif
            <!-- Contact Form -->
            <div class="form-card">
                <form id="contactForm" action="{{ route('contact/insert') }}" method="POST">
                    <div class="field-row">
                        <div class="form-group">
                            <label class="form-label" for="name">Tên của bạn</label>
                            <input type="text" class="form-control {{ isset($errors['name']) ? 'is-invalid' : '' }}"
                                id="name" name="name" placeholder="Nhập tên của bạn">
                            @if (isset($errors['name']))
                                <div class="invalid-feedback">
                                    {{ $errors['name'] }}
                                </div>
                                @php
                                    unset($errors['name']);
                                @endphp
                            @endif
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="email">Email</label>
                            <input type="email" class="form-control {{ isset($errors['email']) ? 'is-invalid' : '' }}"
                                id="email" name="email" placeholder="your@email.com">
                            @if (isset($errors['email']))
                                <div class="invalid-feedback">
                                    {{ $errors['email'] }}
                                </div>
                                @php
                                    unset($errors['email']);
                                @endphp
                            @endif
                        </div>
                    </div>
                    <!-- Phone -->
                    <div class="form-group">
                        <label class="form-label" for="phone">Số điện thoại</label>
                        <input type="tel" class="form-control {{ isset($errors['name']) ? 'is-invalid' : '' }}"
                            id="phone" name="phoneNumber" placeholder="(+84) 123 456 789">
                        @if (isset($errors['phoneNumber']))
                            <div class="invalid-feedback">
                                {{ $errors['phoneNumber'] }}
                            </div>
                            @php
                                unset($errors['phoneNumber']);
                            @endphp
                        @endif
                    </div>
                    <!-- Message -->
                    <div class="form-group"><label class="form-label" for="message">Nội dung liên hệ</label>
                        <textarea class="form-control {{ isset($errors['message']) ? 'is-invalid' : '' }}" id="message" name="message"
                            placeholder="Nhập nội dung liên hệ của bạn..."></textarea>
                        @if (isset($errors['message']))
                            <div class="invalid-feedback">
                                {{ $errors['message'] }}
                            </div>
                            @php
                                unset($errors['message']);
                            @endphp
                        @endif
                    </div>
                    <!-- Submit Button -->
                    <button type="submit" class="btn-submit" id="submitBtn"
                        style="background-color: #0d6efd; color: white;"> <span id="submitBtnText">Gửi liên hệ</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
