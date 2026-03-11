@extends('layouts.admin')

@section('content')
    <div class="d-flex justify-content-between align-items-center mt-5">
        <div class="d-flex gap-3">
            <div class="dropdown">
                <a href="" class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    --Sắp xếp--
                </a>
                <ul class="dropdown-menu">
                    <li>
                        <a class="dropdown-item {{ $sort == 'id' && $order == 'ASC' ? 'active' : '' }}"
                            href="{{ route("users?keyword=$keyword&sort=id&order=ASC&page=$page") }}">
                            ID Tăng dần
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item {{ $sort == 'id' && $order == 'DESC' ? 'active' : '' }}"
                            href="{{ route("users?keyword=$keyword&sort=id&order=DESC&page=$page") }}">
                            ID giảm dần
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item {{ $sort == 'name' && $order == 'ASC' ? 'active' : '' }}"
                            href="{{ route("users?keyword=$keyword&sort=name&order=ASC&page=$page") }}">Tên tăng dần</a>
                    </li>
                    <li>
                        <a class="dropdown-item {{ $sort == 'name' && $order == 'DESC' ? 'active' : '' }}"
                            href="{{ route("users?keyword=$keyword&sort=name&order=DESC&page=$page") }}">Tên giảm dần</a>
                    </li>
                </ul>
            </div>
            <a href="{{ route('user/create') }}" class="btn btn-primary">
                Thêm mới
                <i class="fa-solid fa-user-plus"></i>
            </a>
        </div>
        <form class="d-flex" action="{{ route("users?order=$order&page=$page") }}" method="GET">
            <input class="form-control me-2" placeholder="Tìm kiếm..." name="keyword">
            <button class="btn btn-primary flex-shrink-0" type="submit">Tìm kiếm</button>
        </form>
    </div>
    @if (isset($_SESSION['success']))
        <div class="alert alert-success mt-3" role="alert">
            {{ $_SESSION['success'] }}
        </div>
        @php
            unset($_SESSION['success']);
        @endphp
    @endif
    <form id="formDelete" action="{{ route('users/delete') }}" method="post">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">
                        <input type="checkbox" id="checkAll">
                    </th>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Password</th>
                    <th scope="col">Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>
                            <input class="checkbox" type="checkbox" name="ids[]" value="{{ $user['id'] }}">
                        </td>
                        <td>{{ $user['id'] }}</td>
                        <td>{{ $user['name'] }}</td>
                        <td>{{ $user['email'] }}</td>
                        <td>{{ $user['password'] }}</td>
                        <td>
                            <a href="{{ route('user/edit/' . $user['id']) }}" class="btn btn-primary me-3">Sửa</a>
                            <a onclick="return confirm('Bạn có chắc chắn muốn xóa!')"
                                href="{{ route('user/delete/' . $user['id']) }}" class="btn btn-danger me-3">Xóa</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <button id="btnDeleteAll" class="btn btn-danger">
            Xóa tất cả
        </button>
    </form>

    <nav class="d-flex justify-content-center align-items-center mt-5">
        <ul class="pagination">
            <li class="page-item">
                <a class="page-link"
                    href="{{ route("users?keyword=$keyword&sort=$sort&order=$order&page=" . max(1, $page - 1)) }}"
                    aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
            @for ($i = 1; $i <= $totalPage; $i++)
                <li class="page-item {{ $page == $i ? 'active' : '' }}"><a class="page-link"
                        href="{{ route("users?keyword=$keyword&sort=$sort&order=$order&page=$i") }}">{{ $i }}</a>
                </li>
            @endfor
            <li class="page-item">
                <a class="page-link"
                    href="{{ route("users?keyword=$keyword&sort=$sort&order=$order&page=" . min($totalPage, $page + 1)) }}"
                    aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        </ul>
    </nav>

    <script src="{{ route('storage/assets/js/admins/user.js') }}"></script>
@endsection
