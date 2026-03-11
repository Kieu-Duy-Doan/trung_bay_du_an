@extends('layouts.admin')

@section('content')
    <div class="d-flex justify-content-center">
        <form class="mt-5 w-50" action="{{ route('user/insert') }}" method="POST">
            <div class="mb-3">
                <label class="form-label">Địa chỉ email</label>
                <input type="text" class="form-control {{ isset($errors['email']) ? 'is-invalid' : '' }}" name="email">
                @if (isset($errors['email']))
                    <div class="invalid-feedback">{{ $errors['email'] }}</div>
                @endif
            </div>
            <div class="mb-3">
                <label class="form-label">Mật khẩu</label>
                <input type="password" class="form-control {{ isset($errors['password']) ? 'is-invalid' : '' }}"
                    name="password">
                @if (isset($errors['password']))
                    <div class="invalid-feedback">{{ $errors['password'] }}</div>
                @endif
            </div>
            <div class="mb-3">
                <label class="form-label">Nhập lại khẩu</label>
                <input type="password"
                    class="form-control {{ isset($errors['password_confirmation']) ? 'is-invalid' : '' }}"
                    name="password_confirmation">
                @if (isset($errors['password_confirmation']))
                    <div class="invalid-feedback">{{ $errors['password_confirmation'] }}</div>
                @endif
            </div>
            <div class="mb-3">
                <label class="form-label">Tên của bạn</label>
                <input type="text" class="form-control {{ isset($errors['name']) ? 'is-invalid' : '' }}" name="name">
                @if (isset($errors['name']))
                    <div class="invalid-feedback">{{ $errors['name'] }}</div>
                @endif
            </div>
            <button type="submit" class="btn btn-primary">Tạo mới <i class="fa-solid fa-user-plus"></i></button>
        </form>
    </div>
@endsection
