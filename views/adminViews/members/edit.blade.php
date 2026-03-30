@extends('layouts.admin')

@section('content')
    <div class="d-flex justify-content-center">
        <form class="mt-5 w-50" action="{{ route('member/update') }}" method="POST" enctype="multipart/form-data">
            <input type="text" name="id" value="{{ $member['id'] }}" hidden>
            <div class="mb-3">
                <label class="form-label">Tên thành viên</label>
                <input type="text" class="form-control {{ isset($errors['name']) ? 'is-invalid' : '' }}" name="name"
                    value="{{ $member['name'] }}">
                @if (isset($errors['name']))
                    <div class="invalid-feedback">{{ $errors['name'] }}</div>
                @endif
            </div>
            <div class="mb-3">
                <label for="formFile" class="form-label">Ảnh thành viên</label>
                <input class="form-control" type="file" id="formFile" name="img">
            </div>
            <button type="submit" class="btn btn-primary">Cập nhật <i class="fa-solid fa-arrow-rotate-right"></i></button>
        </form>
    </div>
@endsection
