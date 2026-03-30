@extends('layouts.user')

@section('link_css')
    <link rel="stylesheet" href="{{ route('storage/assets/css/users/projectDetail.css') }}" />
@endsection
<div class="page-wrapper">
    <main class="content-section">
        <div class="container">
            <div class="detail-card" style="margin-top: 100px">
                <div class="row g-0">
                    <div class="col-lg-6 d-flex align-items-center justify-content-center p-4">
                        <div class="project-image-wrap"
                            style="
                                            max-width: 280px;
                                            border-radius: 18px;
                                            overflow: hidden;
                                        ">
                            <img class="project-image" src="{{ route($project['img']) }}"
                                alt="{{ $project['name'] }}" />
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="content-body">
                            <div class="mb-4">
                                <h2 class="section-title">
                                    <i class="fa-solid fa-file-lines"></i>
                                    Mô tả dự án
                                </h2>
                                <div class="description-box">
                                    <p>
                                        {{ $project['description'] }}
                                    </p>
                                </div>
                            </div>
                            <div class="mb-4">
                                <h2 class="section-title">
                                    <i class="fa-solid fa-circle-info"></i>
                                    Thông tin dự án
                                </h2>
                                <div class="info-box">
                                    <ul class="meta-list">
                                        <li class="meta-item">
                                            <div class="meta-icon">
                                                <i class="fa-solid fa-signature"></i>
                                            </div>
                                            <div>
                                                <div class="meta-label">
                                                    Tên dự án
                                                </div>
                                                <p class="meta-value">
                                                    {{ $project['name'] }}
                                                </p>
                                            </div>
                                        </li>
                                        <li class="meta-item">
                                            <div class="meta-icon">
                                                <i class="fa-solid fa-folder-open"></i>
                                            </div>
                                            <div>
                                                <div class="meta-label">
                                                    Danh mục dự án
                                                </div>
                                                <p class="meta-value">
                                                    {{ $project['category_name'] }}
                                                </p>
                                            </div>
                                        </li>
                                        <li class="meta-item">
                                            <div class="meta-icon">
                                                <i class="fa-solid fa-link"></i>
                                            </div>
                                            <div>
                                                <div class="meta-label">
                                                    Link demo sản phẩm
                                                </div>
                                                <p class="meta-value">
                                                    <a href="{{ $project['link_demo'] }}" target="_blank"
                                                        rel="noopener noreferrer" class="demo-link">
                                                        {{ $project['link_demo'] ? $project['link_demo'] : 'Không có link demo' }}
                                                    </a>
                                                </p>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div>
                                <h2 class="section-title">
                                    <i class="fa-solid fa-people-group"></i>
                                    Team phát triển
                                </h2>
                                <div class="team-box">
                                    <div class="row mb-3">
                                        <div class="col-12">
                                            <div class="meta-item">
                                                <div class="meta-icon">
                                                    <i class="fa-solid fa-users"></i>
                                                </div>
                                                <div>
                                                    <div class="meta-label">
                                                        Tên team
                                                    </div>
                                                    <p class="meta-value">
                                                        {{ $team['name'] }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="team-grid">
                                        @foreach ($members as $member)
                                            <div class="member-card text-center">
                                                <div class="member-avatar mx-auto">
                                                    <i class="fa-solid fa-user-tie"></i>
                                                </div>
                                                <div class="member-name">
                                                    {{ $member['name'] }}
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
@section('content')
@endsection
