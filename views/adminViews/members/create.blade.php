@extends('layouts.admin')

@section('content')
    <div class="d-flex justify-content-center">
        <form class="mt-5 w-50" action="{{ route('member/insert') }}" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label class="form-label">Tên thành viên</label>
                <input type="text" class="form-control {{ isset($errors['name']) ? 'is-invalid' : '' }}" name="name">
                @if (isset($errors['name']))
                    <div class="invalid-feedback">{{ $errors['name'] }}</div>
                @endif
            </div>
            <div class="mb-3">
                <label class="form-label">Team dự án</label>
                <select class="form-select {{ isset($errors['team_id']) ? 'is-invalid' : '' }}" name="team_id">
                    <option value="" selected>--Chọn team--</option>
                    @foreach ($teams as $team)
                        <option value="{{ $team['id'] }}">{{ $team['name'] }}</option>
                    @endforeach
                </select>
                @if (isset($errors['team_id']))
                    <div class="invalid-feedback">{{ $errors['team_id'] }}</div>
                @endif
            </div>
            <div class="mb-3">
                <label for="formFile" class="form-label">Ảnh thành viên</label>
                <input class="form-control" type="file" id="formFile" name="img">
            </div>
            <button type="submit" class="btn btn-primary">Tạo mới <i class="fa-solid fa-user-plus"></i></button>
        </form>
    </div>
@endsection
