@extends('layouts.admin')

@section('content')
    <div class="d-flex justify-content-center">
        <form class="mt-5 w-50" action="{{ route('team/insert') }}" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label class="form-label">Tên đội nhóm</label>
                <input type="text" class="form-control {{ isset($errors['name']) ? 'is-invalid' : '' }}" name="name">
                @if (isset($errors['name']))
                    <div class="invalid-feedback">{{ $errors['name'] }}</div>
                @endif
            </div>
            <div class="mb-3">
                <div class="form-floating">
                    <textarea id="floatingTextarea2" class="form-control {{ isset($errors['description']) ? 'is-invalid' : '' }}"
                        placeholder="Viết mô tả" style="height: 100px" name="description"></textarea>
                    <label for="floatingTextarea2">Mô tả đội nhóm</label>
                </div>
                @if (isset($errors['description']))
                    <div class="text-danger">{{ $errors['description'] }}</div>
                @endif
            </div>
            <div class="mb-3">
                <label for="formFile" class="form-label">Ảnh đội nhóm</label>
                <input class="form-control" type="file" id="formFile" name="img">
            </div>
            <button type="submit" class="btn btn-primary">Tạo mới <i class="fa-solid fa-user-plus"></i></button>
        </form>
    </div>
@endsection
