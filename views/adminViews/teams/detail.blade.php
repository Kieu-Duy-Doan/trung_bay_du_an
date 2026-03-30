@extends('layouts.admin')

@section('link_css')
    <link rel="stylesheet" href="{{ route('storage/assets/css/teamDetail.css') }}" />
@endsection

@section('content')
    <div class="app-wrapper">
        <div class="container py-4">
            <!-- Group Info Section -->
            <div class="group-banner p-4 mb-4">
                <div class="d-flex align-items-start gap-4 flex-wrap">
                    <div class="group-avatar" id="groupAvatar">
                        <img src="{{ route($team['img']) }}" alt="" width="100px" height="100px">
                    </div>
                    <div class="flex-grow-1">
                        <h2 class="fw-bold mb-1" id="groupNameDisplay" style="color: #212529; font-size: 24px">
                            {{ $team['name'] }}
                        </h2>
                        <p class="mb-0" id="groupDescDisplay"
                            style="
                                    color: #6c757d;
                                    font-size: 14px;
                                    line-height: 1.6;
                                ">
                            {{ $team['description'] }}
                        </p>
                    </div>
                </div>
            </div>
            <!-- Info Grid -->
            <div class="row g-3 mb-4">
                <div class="col-sm-4">
                    <div class="info-card p-3">
                        <div class="label-dim mb-1">ID Nhóm</div>
                        <div class="fw-semibold" style="color: #212529; font-size: 15px">
                            {{ $team['id'] }}
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="info-card p-3">
                        <div class="label-dim mb-1">{{ $team['name'] }}</div>
                        <div class="fw-semibold" id="groupNameCard" style="color: #212529; font-size: 15px">
                            {{ $team['description'] }}
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="info-card p-3">
                        <div class="label-dim mb-1">Số thành viên</div>
                        <div class="fw-semibold" style="color: #212529; font-size: 15px">
                            {{ count($memberOfTeams) }} người
                        </div>
                    </div>
                </div>
            </div>
            {{-- Hiển thị thông báo --}}
            @if (isset($_SESSION['success']))
                <div class="alert alert-success mt-3" role="alert">
                    {{ $_SESSION['success'] }}
                </div>
                @php
                    unset($_SESSION['success']);
                @endphp
            @endif
            <!-- Members Without Group Section -->
            <div class="info-card p-4 mb-3">
                <!-- Member List -->
                <form class="checkBoxHandler" action="{{ route('member_team/delete') }}" method="post">
                    <input type="text" name="team_id" value="{{ $team['id'] }}" hidden>
                    <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
                        <div class="d-flex align-items-center gap-2">
                            <h5 class="fw-bold mb-0" style="color: #212529">
                                Thành viên nhóm
                            </h5>
                            <span class="badge-count" id="memberCount">{{ count($memberOfTeams) }}</span>
                        </div>
                        <div class="d-flex align-items-center gap-3">
                            <input type="checkbox" id="checkAll" class="checkAll" hidden>
                            <label for="checkAll" class="select-all-link" id="selectAllBtn">Chọn tất cả</label>
                        </div>
                    </div>
                    <div id="memberList" class="d-flex flex-column gap-2 mb-4"
                        style="
                            max-height: 420px;
                            overflow-y: auto;
                            padding-right: 4px;
                        ">
                        @foreach ($memberOfTeams as $member)
                            <div class="member-card" id="member-${m.id}">
                                <input class="form-check-input checkbox" type="checkbox" name="ids[]"
                                    value="{{ $member['id'] }}">
                                <div class="member-avatar" style="background:${color};">
                                    <img src="{{ route($member['img']) }}" alt="" height="50px" width="50px">
                                </div>
                                <div class="flex-grow-1 min-w-0">
                                    <div class="fw-semibold" style="font-size:15px; color:#212529;">{{ $member['name'] }}
                                    </div>
                                </div>
                                <span class="badge"
                                    style="background:#f1f3f5; color:#495057; font-size:12px; padding:5px 10px; border-radius:8px;">{{ $member['name'] }}</span>
                            </div>
                        @endforeach
                    </div>
                    <!-- Action Bar -->
                    <div class="d-flex justify-content-between align-items-center pt-3"
                        style="border-top: 1px solid #e9ecef">
                        <div class="text-muted" style="font-size: 14px">
                            Đã chọn:
                            <strong class="selectedCount" style="color: #0d6efd">0</strong>
                            thành viên
                        </div>
                        <button class="btn btn-primary btn-add-members btnDeleteAll">
                            <span class="d-flex align-items-center gap-2">
                                <span id="addBtnText">Xóa khỏi nhóm</span>
                            </span>
                        </button>
                    </div>
                </form>
            </div>
            <!-- Members Without Group Section -->
            <div class="info-card p-4">
                <form class="checkBoxHandler" action="{{ route('member_team/inser') }}" method="post">
                    <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
                        <div class="d-flex align-items-center gap-2">
                            <h5 class="fw-bold mb-0" style="color: #212529">
                                Thành viên khác
                            </h5>
                            <span class="badge-count" id="memberCount">{{ count($membersWithoutTeam) }}</span>
                        </div>
                        <div class="d-flex align-items-center gap-3">
                            <input type="checkbox" id="allWithoutTeam" class="checkAll" hidden>
                            <label for="allWithoutTeam" class="select-all-link" id="selectAllBtn">Chọn tất cả</label>
                        </div>
                    </div>
                    <!-- Search -->
                    <div class="search-wrapper mb-3">
                        <i data-lucide="search"></i>
                        <input type="text" class="form-control search-input" id="searchInput"
                            placeholder="Tìm kiếm thành viên..." oninput="filterMembers()" />
                    </div>
                    <!-- Member List -->
                    <input type="text" name="team_id" value="{{ $team['id'] }}" hidden>
                    <div id="memberList" class="d-flex flex-column gap-2 mb-4"
                        style="
                            max-height: 420px;
                            overflow-y: auto;
                            padding-right: 4px;
                        ">
                        @foreach ($membersWithoutTeam as $member)
                            <div class="member-card" id="member-${m.id}">
                                <input class="form-check-input checkbox" type="checkbox" name="ids[]"
                                    value="{{ $member['id'] }}">
                                <div class="member-avatar" style="background:${color};">
                                    <img src="{{ route($member['img']) }}" alt="" height="50px"
                                        width="50px">
                                </div>
                                <div class="flex-grow-1 min-w-0">
                                    <div class="fw-semibold" style="font-size:15px; color:#212529;">{{ $member['name'] }}
                                    </div>
                                </div>
                                <span class="badge"
                                    style="background:#f1f3f5; color:#495057; font-size:12px; padding:5px 10px; border-radius:8px;">{{ $member['name'] }}</span>
                            </div>
                        @endforeach
                    </div>
                    <!-- Action Bar -->
                    <div class="d-flex justify-content-between align-items-center pt-3"
                        style="border-top: 1px solid #e9ecef">
                        <div class="text-muted" style="font-size: 14px">
                            Đã chọn:
                            <strong class="selectedCount" style="color: #0d6efd">0</strong>
                            thành viên
                        </div>
                        <button class="btn btn-primary btn-add-members btnDeleteAll">
                            <span class="d-flex align-items-center gap-2">
                                <span id="addBtnText">Thêm vào nhóm</span>
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="{{ route('storage/assets/js/admins/user.js') }}"></script>
@endsection
