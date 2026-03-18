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
            </div><!-- Contact Form -->
            <div class="form-card">
                <form id="contactForm" novalidate><!-- Name and Email Row -->
                    <div class="field-row">
                        <div class="form-group"><label class="form-label" for="name">Tên của bạn</label> <input
                                type="text" class="form-control" id="name" name="name"
                                placeholder="Nhập tên của bạn" required>
                            <div class="invalid-feedback">
                                Vui lòng nhập tên của bạn
                            </div>
                        </div>
                        <div class="form-group"><label class="form-label" for="email">Email</label> <input type="email"
                                class="form-control" id="email" name="email" placeholder="your@email.com" required>
                            <div class="invalid-feedback">
                                Vui lòng nhập email hợp lệ
                            </div>
                        </div>
                    </div><!-- Phone -->
                    <div class="form-group"><label class="form-label" for="phone">Số điện thoại</label> <input
                            type="tel" class="form-control" id="phone" name="phone"
                            placeholder="(+84) 123 456 789">
                    </div><!-- Message -->
                    <div class="form-group"><label class="form-label" for="message">Nội dung liên hệ</label>
                        <textarea class="form-control" id="message" name="message" placeholder="Nhập nội dung liên hệ của bạn..." required></textarea>
                        <div class="invalid-feedback">
                            Vui lòng nhập nội dung liên hệ
                        </div>
                    </div><!-- Submit Button --> <button type="submit" class="btn-submit" id="submitBtn"
                        style="background-color: #0d6efd; color: white;"> <span id="submitBtnText">Gửi liên hệ</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
