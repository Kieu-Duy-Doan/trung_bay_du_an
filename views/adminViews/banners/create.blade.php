@extends('layouts.admin')

@section('content')
    <div class="d-flex justify-content-center">
        <form class="mt-5 w-50" action="{{ route('banner/insert') }}" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label class="form-label">Tên banner</label>
                <input type="text" class="form-control {{ isset($errors['name']) ? 'is-invalid' : '' }}" name="name">
                @if (isset($errors['name']))
                    <div class="invalid-feedback">{{ $errors['name'] }}</div>
                @endif
            </div>
            <div class="mb-3">
                <div class="form-floating">
                    <textarea id="floatingTextarea2" class="form-control {{ isset($errors['description']) ? 'is-invalid' : '' }}"
                        placeholder="Viết mô tả" style="height: 100px" name="description"></textarea>
                    <label for="floatingTextarea2">Mô tả banner</label>
                    @if (isset($errors['description']))
                        <div class="invalid-feedback">{{ $errors['description'] }}</div>
                    @endif
                </div>
            </div>
            <div class="mb-3">
                <label for="formFile" class="form-label">Ảnh banner</label>
                <input class="form-control {{ isset($errors['img']) ? 'is-invalid' : '' }}" type="file" id="formFile"
                    name="img">
                @if (isset($errors['img']))
                    <div class="invalid-feedback">{{ $errors['img'] }}</div>
                @endif
            </div>

            <div class="mb-3">
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="activeBanner" name="active" value="1">
                    <label class="form-check-label" for="activeBanner">Hiện thị banner tại trang chủ</label>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Tạo mới <i class="fa-solid fa-user-plus"></i></button>
        </form>
    </div>
@endsection
