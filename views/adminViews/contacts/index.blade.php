@extends('layouts.admin')

@section('link_css')
    <link rel="stylesheet" href="{{ route('storage/assets/css/contactAdmin.css') }}" />
@endsection

@section('content')
    <!-- Header -->
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 mt-5">
        <div>
            <h4 class="fw-bold mb-1" id="pageTitle">
                Quản lý liên hệ
            </h4>
            <p class="text-muted mb-0 small" id="subtitleText">
                Danh sách tin nhắn từ khách hàng
            </p>
        </div>
    </div>
    <!-- Stats -->
    <div class="row g-3 mb-4">
        <div class="col-6 col-md-4">
            <div class="card stat-card p-3 bg-white">
                <div class="small text-muted">Tổng cộng</div>
                <div class="fs-4 fw-bold" id="statTotal">{{ $totalContacts }}</div>
            </div>
        </div>
        <div class="col-6 col-md-4">
            <div class="card stat-card p-3 bg-white">
                <div class="small text-muted">Chưa đọc</div>
                <div class="fs-4 fw-bold text-primary" id="statUnread">
                    {{ $unreadContactsCount }}
                </div>
            </div>
        </div>
        <div class="col-6 col-md-4">
            <div class="card stat-card p-3 bg-white">
                <div class="small text-muted">Đã đọc</div>
                <div class="fs-4 fw-bold text-secondary" id="statRead">
                    {{ $readContactsCount }}
                </div>
            </div>
        </div>
    </div>
    <!-- Filter -->
    <div class="d-flex gap-2 mb-3 flex-wrap">
        <a href="{{ route("contacts?sort=$sort&order=$order&keyword=$keyword&page=" . $page) }}"
            class="btn btn-outline-secondary btn-sm rounded-pill px-3 filter-btn {{ !$key ? 'active' : '' }}"
            data-filter="all">
            Tất cả
        </a>
        <a href="{{ route("contacts?sort=$sort&order=$order&keyword=$keyword&key=status&value=0&page=" . $page) }}"
            class="btn btn-outline-secondary btn-sm rounded-pill px-3 filter-btn {{ $key && $value == 0 ? 'active' : '' }}"
            data-filter="unread">
            Chưa đọc
        </a>
        <a href="{{ route("contacts?sort=$sort&order=$order&keyword=$keyword&key=status&value=1&page=" . $page) }}"
            class="btn btn-outline-secondary btn-sm rounded-pill px-3 filter-btn {{ $key && $value == 1 ? 'active' : '' }}"
            data-filter="read">
            Đã đọc
        </a>
        <div class="ms-auto">
            <input type="text" class="form-control form-control-sm rounded-pill" placeholder="Tìm kiếm..."
                id="searchInput" style="width: 200px" />
        </div>
    </div>
    <!-- Table -->
    <div class="card border-0 rounded-3 shadow-sm bg-white">
        <div class="table-responsive">
            <table class="table table-hover mb-0 align-middle">
                <thead>
                    <tr class="border-bottom">
                        <th class="ps-3" style="width: 60px">ID</th>
                        <th>Người gửi</th>
                        <th>Email</th>
                        <th>Lời nhắn</th>
                        <th style="width: 170px">Trạng thái</th>
                        <th class="text-end pe-3" style="width: 120px">
                            Thao tác
                        </th>
                    </tr>
                </thead>
                <tbody id="contactTableBody">
                    @foreach ($contacts as $contact)
                        <tr class="{{ $contact['status'] == 0 ? 'contact-row-unread' : '' }} fade-in">
                            <td class="ps-3 small text-muted">{{ $contact['id'] }}</td>
                            <td class="fw-inherit">{{ $contact['name'] }}</td>
                            <td class="small">{{ $contact['email'] }}</td>
                            <td class="msg-preview small">
                                {{ $contact['message'] }}
                            </td>
                            <td>
                                <span
                                    class="badge badge-unread rounded-pill">{{ $contact['status'] == 1 ? 'Đã đọc' : 'Chưa đọc' }}</span>
                            </td>
                            <td class="text-end pe-3">
                                <a href="{{ route('contact/detail/' . $contact['id']) }}"
                                    class="btn-action btn-outline-primary me-1" title="Xem">
                                    <i class="fa-solid fa-eye"></i>
                                </a>
                                <button class="btn-action btn-outline-danger" title="Xóa">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach

                    @if (count($contacts) == 0)
                        <tr>
                            <td colspan="6">
                                <div class="text-center py-5 text-muted" id="emptyState">
                                    <i data-lucide="inbox" style="width: 48px; height: 48px; opacity: 0.3"></i>
                                    <p class="mt-2 mb-0">Chưa có liên hệ nào</p>
                                    <p class="small">Bạn chưa có việc phải làm</p>
                                </div>
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>

    {{-- Khu vực phân trang --}}
    <nav class="mt-3 d-flex justify-content-center">
        <ul class="pagination">
            <li class="page-item {{ $page - 1 <= 0 ? 'disabled' : '' }}">
                <a class="page-link"
                    href="{{ route("contacts?sort=$sort&order=$order&keyword=$keyword&key=$key&value=$value&page=" . $page - 1) }}"
                    aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
            @for ($i = 1; $i <= $totalPage; $i++)
                <li class="page-item {{ $page == $i ? 'active' : '' }}">
                    <a class="page-link"
                        href="{{ route("contacts?sort=$sort&order=$order&keyword=$keyword&key=$key&value=$value&page=$i") }}">{{ $i }}</a>
                </li>
            @endfor
            <li class="page-item {{ $page + 1 > $totalPage ? 'disabled' : '' }}">
                <a class="page-link"
                    href="{{ route("contacts?sort=$sort&order=$order&keyword=$keyword&key=$key&value=$value&page=" . $page + 1) }}"
                    aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        </ul>
    </nav>

    <!-- Delete Confirm -->
    <div class="modal-backdrop-custom" id="deleteBackdrop" onclick="closeDeleteConfirm()"></div>
    <div class="modal-custom" id="deleteBox" style="max-width: 380px">
        <div class="p-4 text-center">
            <div class="mb-3">
                <i data-lucide="alert-triangle" style="width: 48px; height: 48px; color: #dc3545"></i>
            </div>
            <h6 class="fw-bold">Xác nhận xóa?</h6>
            <p class="text-muted small">
                Hành động này không thể hoàn tác.
            </p>
            <div class="d-flex gap-2 justify-content-center">
                <button class="btn btn-light rounded-3" onclick="closeDeleteConfirm()">
                    Hủy
                </button>
                <button class="btn btn-danger rounded-3 px-4" id="confirmDeleteBtn" onclick="confirmDelete()">
                    Xóa
                </button>
            </div>
        </div>
    </div>
@endsection
