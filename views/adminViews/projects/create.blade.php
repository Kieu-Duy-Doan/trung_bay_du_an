@extends('layouts.admin')

@section('content')
    <div class="d-flex justify-content-center">
        <form class="mt-5 w-50" action="{{ route('project/insert') }}" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label class="form-label">Tên dự án</label>
                <input type="text" class="form-control {{ isset($errors['name']) ? 'is-invalid' : '' }}" name="name">
                @if (isset($errors['name']))
                    <div class="invalid-feedback">{{ $errors['name'] }}</div>
                @endif
            </div>
            <div class="mb-3">
                <label class="form-label">Danh mục dự án</label>
                <select class="form-select {{ isset($errors['category_id']) ? 'is-invalid' : '' }}" name="category_id">
                    <option value="" selected>--Chọn danh mục--</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category['id'] }}">{{ $category['name'] }}</option>
                    @endforeach
                </select>
                @if (isset($errors['category_id']))
                    <div class="invalid-feedback">{{ $errors['category_id'] }}</div>
                @endif
            </div>
            <div class="mb-3">
                <div class="form-floating">
                    <textarea id="floatingTextarea2" class="form-control {{ isset($errors['description']) ? 'is-invalid' : '' }}"
                        placeholder="Viết mô tả" style="height: 100px" name="description"></textarea>
                    <label for="floatingTextarea2">Mô tả dự án</label>
                </div>
                @if (isset($errors['description']))
                    <div class="invalid-feedback">{{ $errors['description'] }}</div>
                @endif
            </div>
            <div class="mb-3">
                <label for="formFile" class="form-label">Ảnh dự án</label>
                <input class="form-control" type="file" id="formFile" name="img">
            </div>
            <button type="submit" class="btn btn-primary">Tạo mới <i class="fa-solid fa-user-plus"></i></button>
        </form>
    </div>
@endsection
