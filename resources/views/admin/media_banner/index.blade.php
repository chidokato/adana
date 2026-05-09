@extends('admin.layout.main')

@section('title', 'Slider & banner')
@section('page_title', 'Slider & banner')
@section('breadcrumb', 'Slider & banner')

@section('css')
    <style>
        .media-banner-list-card .card-header {
            border-bottom: 1px dashed var(--vz-border-color);
        }

        .media-banner-list {
            display: flex;
            flex-direction: column;
        }

        .media-banner-row {
            display: grid;
            grid-template-columns: minmax(0, 2.6fr) minmax(110px, .8fr) minmax(90px, .7fr) minmax(90px, .7fr) minmax(150px, .9fr) 130px;
            gap: 1.25rem;
            align-items: center;
            padding: 1rem 1.5rem;
            border-bottom: 1px solid var(--vz-border-color);
        }

        .media-banner-row:last-child {
            border-bottom: 0;
        }

        .media-banner-row--head {
            padding-top: .9rem;
            padding-bottom: .9rem;
            background: #f8fafc;
            color: #495057;
            font-size: .75rem;
            font-weight: 700;
            letter-spacing: .04em;
            text-transform: uppercase;
        }

        .media-banner-main {
            display: flex;
            align-items: center;
            gap: 1rem;
            min-width: 0;
        }

        .media-banner-thumb {
            width: 72px;
            height: 72px;
            border-radius: 14px;
            overflow: hidden;
            flex: 0 0 72px;
            background: #eef2f7;
            box-shadow: inset 0 0 0 1px rgba(64, 81, 137, .08);
        }

        .media-banner-thumb img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .media-banner-info {
            min-width: 0;
        }

        .media-banner-id {
            color: #405189;
            font-weight: 700;
            text-decoration: none;
        }

        .media-banner-title {
            margin: .125rem 0 .2rem;
            font-size: 1rem;
            font-weight: 600;
            color: #212529;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .media-banner-link {
            color: #878a99;
            font-size: .875rem;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .media-banner-meta strong {
            display: block;
            color: #212529;
            font-weight: 600;
            line-height: 1.2;
        }

        .media-banner-meta span {
            display: block;
            margin-top: .3rem;
            color: #878a99;
            font-size: .875rem;
        }

        .media-banner-type-badge {
            display: inline-flex;
            align-items: center;
            padding: .35rem .7rem;
            border-radius: 999px;
            background: rgba(64, 81, 137, .12);
            color: #405189;
            font-size: .75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .03em;
        }

        .media-banner-status {
            display: inline-flex;
            align-items: center;
            gap: .35rem;
            border-radius: 999px;
            padding: .35rem .7rem;
            font-size: .75rem;
            font-weight: 700;
        }

        .media-banner-status::before {
            content: "";
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: currentColor;
        }

        .media-banner-status.is-active {
            background: rgba(10, 179, 156, .14);
            color: #0ab39c;
        }

        .media-banner-status.is-inactive {
            background: rgba(240, 101, 72, .14);
            color: #f06548;
        }

        .media-banner-actions {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: .85rem;
        }

        .media-banner-actions a,
        .media-banner-actions button {
            width: 34px;
            height: 34px;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border: 0;
            background: transparent;
            transition: .2s ease;
        }

        .media-banner-actions a:hover,
        .media-banner-actions button:hover {
            background: #f3f6f9;
        }

        .media-banner-pagination {
            border-top: 1px solid var(--vz-border-color);
        }

        @media (max-width: 1199.98px) {
            .media-banner-row {
                grid-template-columns: 1fr;
                gap: .85rem;
            }

            .media-banner-row--head {
                display: none;
            }

            .media-banner-meta,
            .media-banner-actions {
                justify-content: flex-start;
            }

            .media-banner-actions {
                padding-top: .25rem;
            }
        }
    </style>
@endsection

@section('content')
    @include('admin.partials.list-hero', [
        'heroTitle' => 'Quan ly slider va banner',
        'heroSubtitle' => 'Danh sach hinh anh truyen thong va vi tri hien thi.',
        'heroPrimaryRoute' => route('admin.media-banners.create'),
        'heroPrimaryLabel' => 'Them moi',
    ])

    <div class="card media-banner-list-card">
        <div class="card-header">
            <h4 class="card-title mb-0">Best Selling Products</h4>
        </div>

        <div class="card-body border border-dashed border-end-0 border-start-0">
            <form method="GET" action="{{ route('admin.media-banners.index') }}" class="mb-3">
                <div class="row g-2 align-items-center">
                    <div class="col-lg-4">
                        <select class="form-select" name="type">
                            <option value="">Tat ca loai</option>
                            <option value="slider" {{ request('type') === 'slider' ? 'selected' : '' }}>Slider</option>
                            <option value="banner" {{ request('type') === 'banner' ? 'selected' : '' }}>Banner</option>
                        </select>
                    </div>
                    <div class="col-lg-auto">
                        <button type="submit" class="btn btn-primary">Tim kiem</button>
                    </div>
                    <div class="col-lg-auto">
                        <a href="{{ route('admin.media-banners.index') }}" class="btn btn-light">Dat lai</a>
                    </div>
                </div>
            </form>
        </div>

        <div class="px-0 pb-0">
            <div class="media-banner-list">
                <div class="media-banner-row media-banner-row--head">
                    <div>Banner</div>
                    <div>Ngay cap nhat</div>
                    <div>Thu tu</div>
                    <div>Loai</div>
                    <div>Trang thai</div>
                    <div class="text-end">Action</div>
                </div>

                @forelse ($items as $item)
                    <div class="media-banner-row">
                        <div class="media-banner-main">
                            <div class="media-banner-thumb">
                                <img src="{{ $item->image ? asset($item->image) : asset('data/no_image.jpg') }}" alt="{{ $item->title ?: 'Media banner' }}">
                            </div>
                            <div class="media-banner-info">
                                <a href="{{ route('admin.media-banners.edit', $item) }}" class="media-banner-id">
                                    #MB{{ str_pad((string) $item->id, 4, '0', STR_PAD_LEFT) }}
                                </a>
                                <div class="media-banner-title">{{ $item->title ?: 'Khong co tieu de' }}</div>
                                <div class="media-banner-link">{{ $item->link ?: 'Khong co duong dan' }}</div>
                            </div>
                        </div>

                        <div class="media-banner-meta">
                            <strong>{{ optional($item->updated_at ?? $item->created_at)->format('d M, Y') ?? '-' }}</strong>
                            <span>Date</span>
                        </div>

                        <div class="media-banner-meta">
                            <strong>{{ $item->position ?? 0 }}</strong>
                            <span>Position</span>
                        </div>

                        <div>
                            <span class="media-banner-type-badge">{{ $item->type === 'slider' ? 'Slider' : 'Banner' }}</span>
                        </div>

                        <div>
                            <span class="media-banner-status {{ $item->status ? 'is-active' : 'is-inactive' }}">
                                {{ $item->status ? 'Dang hien thi' : 'An' }}
                            </span>
                        </div>

                        <div class="media-banner-actions">
                            <a href="{{ route('admin.media-banners.edit', $item) }}" class="text-primary" title="View">
                                <i class="ri-eye-fill fs-16"></i>
                            </a>
                            <a href="{{ route('admin.media-banners.edit', $item) }}" class="text-primary" title="Sua">
                                <i class="ri-pencil-fill fs-16"></i>
                            </a>
                            <form action="{{ route('admin.media-banners.destroy', $item) }}" method="POST" class="d-inline" onsubmit="return confirm('Ban co chac muon xoa muc nay?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-danger" title="Xoa">
                                    <i class="ri-delete-bin-5-fill fs-16"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                @empty
                    <div class="text-center text-muted py-4">No data found.</div>
                @endforelse
            </div>
        </div>

        <div class="card-body media-banner-pagination">
            {{ $items->links('pagination::bootstrap-4') }}
        </div>
    </div>
@endsection
