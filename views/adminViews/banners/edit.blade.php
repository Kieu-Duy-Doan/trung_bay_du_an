@extends('layouts.admin')

@section('content')
    <div class="d-flex justify-content-center">
        <form class="mt-5 w-50" action="{{ route('banner/update') }}" method="POST" enctype="multipart/form-data">
            <input type="text" name="id" value="{{ $banner['id'] }}" hidden>
            <div class="mb-3">
                <label class="form-label">Tên banner</label>
                <input type="text" class="form-control {{ isset($errors['name']) ? 'is-invalid' : '' }}" name="name"
                    value="{{ $banner['name'] }}">
                @if (isset($errors['name']))
                    <div class="invalid-feedback">{{ $errors['name'] }}</div>
                @endif
            </div>
            <div class="mb-3">
                <label class="form-label">Link liên kết banner</label>
                <input type="text" class="form-control {{ isset($errors['link']) ? 'is-invalid' : '' }}" name="link"
                    value="{{ $banner['link'] }}">
                @if (isset($errors['link']))
                    <div class="invalid-feedback">{{ $errors['link'] }}</div>
                @endif
            </div>
            <div class="mb-3">
                <div class="form-floating">
                    <textarea id="floatingTextarea2" class="form-control {{ isset($errors['description']) ? 'is-invalid' : '' }}"
                        placeholder="Viết mô tả" style="height: 100px" name="description">{{ $banner['description'] }}</textarea>
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
                    <input class="form-check-input" {{ $banner['active'] == 1 ? 'checked' : '' }} type="checkbox"
                        id="activeBanner" name="active" value="1">
                    <label class="form-check-label" for="activeBanner">Hiện thị banner tại trang chủ</label>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Cập nhật <i class="fa-solid fa-arrow-rotate-right"></i></button>
        </form>
    </div>
@endsection
