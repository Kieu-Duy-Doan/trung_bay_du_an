@extends('layouts.admin')

@section('link_css')
    <link rel="stylesheet" href="{{ route('storage/assets/css/admins/members/memberDetail.css') }}">
@endsection

@section('content')
    <div class="container pb-5 mt-30">
        <div class="row g-4">
            <!-- Left Column: Profile -->
            <div class="col-lg-4">
                <div class="profile-card text-center pb-4">
                    <div class="d-flex justify-content-center mt-4">
                        <div class="avatar-wrapper">
                            <img src="{{ route($member['img']) }}" alt="Ảnh thành viên" />
                            <div class="avatar-badge"></div>
                        </div>
                    </div>
                    <h3 class="member-name" id="memberName">
                        {{ $member['name'] }}
                    </h3>
                    <div class="member-id-badge mb-3">
                        <i class="fas fa-fingerprint"></i>
                        <span id="memberId">{{ $member['id'] }}</span>
                    </div>
                    <div class="d-flex justify-content-center border-top mx-4 pt-2 mt-2">
                        <div class="stat-box">
                            <div class="stat-num">{{ $teamCount }}</div>
                            <div class="stat-label">Nhóm</div>
                        </div>
                        <div class="stat-box border-start border-end">
                            <div class="stat-num">12</div>
                            <div class="stat-label">Dự án</div>
                        </div>
                    </div>
                </div>
                <!-- Info Card -->
                <div class="info-card p-3 mt-4">
                    <h6 class="fw-bold mb-3" style=" color: var(--dark-color); font-size: 0.95rem; ">
                        <i class="fas fa-circle-info text-primary me-2"></i>Thông tin liên hệ
                    </h6>
                    <div class="info-row">
                        <div class="info-icon">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div>
                            <div class="info-label">Email</div>
                            <div class="info-value">
                                kieuduydoan2k2@gmail.com
                            </div>
                        </div>
                    </div>
                    <div class="info-row">
                        <div class="info-icon">
                            <i class="fas fa-phone"></i>
                        </div>
                        <div>
                            <div class="info-label">Điện thoại</div>
                            <div class="info-value">0398041418</div>
                        </div>
                    </div>
                    <div class="info-row">
                        <div class="info-icon">
                            <i class="fas fa-building"></i>
                        </div>
                        <div>
                            <div class="info-label">Phòng ban</div>
                            <div class="info-value">
                                Phát triển website
                            </div>
                        </div>
                    </div>
                    <div class="info-row">
                        <div class="info-icon">
                            <i class="fas fa-calendar"></i>
                        </div>
                        <div>
                            <div class="info-label">Ngày tham gia</div>
                            <div class="info-value">21/02/2002</div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Right Column: Team List -->
            <div class="col-lg-8">
                <div class="info-card p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <div class="section-title">
                            <i class="fas fa-people-group"></i> Danh Sách Nhóm Đang Tham Gia
                        </div>
                        <span class="badge rounded-pill"
                            style="
                                        background: var(--gradient-2);
                                        font-size: 0.8rem;
                                        padding: 0.4rem 0.85rem;
                                    ">
                            {{ $teamCount }} nhóm
                        </span>
                    </div>

                    @if (isset($_SESSION['success']))
                        <div class="alert alert-success alert-dismissible fade show mt-3 mb-3" role="alert">
                            {{ $_SESSION['success'] }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>

                        @php
                            unset($_SESSION['success']);
                        @endphp
                    @endif

                    @foreach ($teams as $team)
                        <!-- Team  -->
                        <div class="team-card mb-3">
                            <div class="team-icon"
                                style="background-image: url('{{ route($team['img']) }}'); background-size: cover; background-position: center;">
                            </div>
                            <div class="team-info">
                                <h6>{{ $team['name'] }}</h6>
                                <small>
                                    <i class="fas fa-users me-1"></i>
                                    {{ $team['count_member'] }} thành viên
                                </small>
                            </div>
                            <form action="{{ route('member_team/delete') }}" method="POST">
                                <input type="text" name="ids[]" value="{{ $member['id'] }}" hidden>
                                <input type="text" name="team_id" value="{{ $team['id'] }}" hidden>
                                <button class="btn-leave">
                                    <i class="fas fa-right-from-bracket"></i>
                                    Rời
                                </button>
                            </form>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
