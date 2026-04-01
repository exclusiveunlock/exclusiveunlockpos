<x-app-layout>
    <x-slot name="title">
        @if($firmware->folder){{ $firmware->full_folder_path }} > @endif{{ $firmware->name }}
    </x-slot>

    <style>
    /* ══════════════════════════════════════════
       FIRMWARE SHOW — usa variables --ef-*
       ══════════════════════════════════════════ */

    .fw-page {
        max-width: 1280px;
        margin: 0 auto;
        padding: 28px 16px 64px;
    }

    /* ── Breadcrumb ── */
    .fw-breadcrumb {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 4px;
        margin-bottom: 24px;
        font-size: 12px;
    }

    .fw-breadcrumb a {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        color: var(--ef-muted);
        text-decoration: none;
        font-weight: 500;
        transition: color 0.15s;
        max-width: 200px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }
    .fw-breadcrumb a:hover { color: var(--ef-mint); }

    .fw-breadcrumb-sep {
        color: var(--ef-border2);
        font-size: 14px;
        line-height: 1;
    }

    .fw-breadcrumb-current {
        color: var(--ef-text2);
        font-weight: 600;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        max-width: min(280px, 50vw);
    }

    /* ── Layout ── */
    .fw-grid {
        display: grid;
        grid-template-columns: 1fr 300px;
        gap: 20px;
        align-items: start;
    }

    @media (max-width: 1024px) {
        .fw-grid { grid-template-columns: 1fr; }
    }

    /* ── Cards (shared) ── */
    .fw-card {
        background: var(--ef-surface);
        border: 1px solid var(--ef-border);
        border-radius: 10px;
        overflow: hidden;
        margin-bottom: 16px;
        transition: background 0.2s;
    }

    .fw-card-header {
        padding: 16px 20px 0;
        border-bottom: 1px solid var(--ef-border);
        padding-bottom: 14px;
        margin-bottom: 0;
    }

    .fw-card-title {
        font-size: 13px;
        font-weight: 800;
        letter-spacing: 1.5px;
        text-transform: uppercase;
        color: var(--ef-mint);
        margin: 0 0 3px;
        display: flex; align-items: center; gap: 7px;
    }

    .fw-card-title::before {
        content: '';
        display: inline-block;
        width: 3px; height: 13px;
        background: var(--ef-teal); border-radius: 2px;
    }

    .fw-card-subtitle {
        font-size: 12px;
        color: var(--ef-muted);
        margin: 0;
    }

    .fw-card-body { padding: 20px; }

    /* ── Header card ── */
    .fw-name-row {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 16px;
        flex-wrap: wrap;
        margin-bottom: 16px;
    }

    .fw-name-left { 
        flex: 1; 
        min-width: 0;
    }

    .fw-badge-row {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 8px;
        margin-bottom: 10px;
    }

    .fw-badge {
        display: inline-flex; align-items: center; gap: 4px;
        font-size: 10px; font-weight: 800;
        padding: 3px 9px; border-radius: 20px;
        white-space: nowrap;
    }

    .fw-badge svg { width: 10px; height: 10px; }

    .fw-badge-free     { background: var(--ef-teal-bg);  color: var(--ef-teal-text); }
    .fw-badge-featured { background: var(--ef-amber-bg); color: var(--ef-amber-text);}
    .fw-badge-paid     { background: var(--ef-blue-bg);  color: var(--ef-blue-text); }
    .fw-badge-new      { background: var(--ef-blue);     color: #fff; letter-spacing: 0.5px; }

    .fw-title {
        font-size: 22px;
        font-weight: 800;
        color: var(--ef-text);
        margin: 0 0 10px;
        letter-spacing: -0.4px;
        line-height: 1.25;
        word-break: break-word;
    }

    /* Stars */
    .fw-stars {
        display: flex; align-items: center; gap: 8px;
        margin-bottom: 12px;
    }

    .fw-star {
        width: 16px; height: 16px;
    }

    .fw-star-filled { fill: #d4a017; }
    .fw-star-empty  { fill: var(--ef-border2); }

    .fw-rating-val {
        font-size: 12px;
        color: var(--ef-muted);
        font-weight: 600;
    }

    .fw-description {
        font-size: 14px;
        color: var(--ef-muted);
        line-height: 1.7;
        margin: 0;
        word-break: break-word;
    }

    /* Price (paid) */
    .fw-price-block {
        text-align: right;
        flex-shrink: 0;
    }

    .fw-price {
        font-size: 26px;
        font-weight: 800;
        color: var(--ef-teal-text);
        line-height: 1;
        margin-bottom: 4px;
    }

    html.dark .fw-price { color: var(--ef-mint); }

    .fw-price-label {
        font-size: 11px;
        color: var(--ef-muted);
    }

    /* ── Action buttons ── */
    .fw-actions {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }

    .fw-btn-download {
        flex: 1;
        display: inline-flex; align-items: center; justify-content: center; gap: 8px;
        padding: 12px 20px;
        background: var(--ef-teal); color: #fff;
        border-radius: 8px;
        font-size: 14px; font-weight: 700;
        text-decoration: none;
        transition: opacity 0.15s, transform 0.15s;
        min-width: 160px;
    }
    .fw-btn-download:hover { opacity: 0.87; transform: translateY(-1px); }
    .fw-btn-download svg { width: 18px; height: 18px; flex-shrink: 0; }

    .fw-btn-secondary {
        display: inline-flex; align-items: center; justify-content: center; gap: 8px;
        padding: 11px 18px;
        background: var(--ef-surface2);
        border: 1px solid var(--ef-border);
        color: var(--ef-text2);
        border-radius: 8px;
        font-size: 13px; font-weight: 600;
        cursor: pointer;
        text-decoration: none;
        transition: border-color 0.15s, color 0.15s;
    }
    .fw-btn-secondary:hover { border-color: var(--ef-teal); color: var(--ef-mint); }
    .fw-btn-secondary svg { width: 16px; height: 16px; flex-shrink: 0; }

    /* ── Details grid ── */
    .fw-details-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 10px;
    }

    @media (max-width: 600px) {
        .fw-details-grid { grid-template-columns: 1fr; }
    }

    .fw-detail-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 12px 14px;
        background: var(--ef-bg);
        border: 1px solid var(--ef-border);
        border-radius: 8px;
        gap: 10px;
    }

    .fw-detail-left {
        display: flex; align-items: center; gap: 10px;
        min-width: 0;
        flex: 1;
    }

    .fw-detail-icon {
        width: 34px; height: 34px;
        background: var(--ef-teal-bg);
        border: 1px solid var(--ef-teal);
        border-radius: 7px;
        display: flex; align-items: center; justify-content: center;
        flex-shrink: 0;
    }
    .fw-detail-icon svg { width: 15px; height: 15px; stroke: var(--ef-mint); }

    .fw-detail-label {
        font-size: 12px; font-weight: 700;
        color: var(--ef-text2); margin: 0;
    }

    .fw-detail-sub {
        font-size: 10px; color: var(--ef-muted); margin: 0;
    }

    .fw-detail-value {
        font-size: 14px; font-weight: 800;
        color: var(--ef-text);
        white-space: nowrap;
    }

    /* ── Tags ── */
    .fw-tags {
        display: flex; flex-wrap: wrap; gap: 8px;
    }

    .fw-tag {
        display: inline-flex; align-items: center; gap: 5px;
        padding: 5px 12px;
        background: var(--ef-surface2);
        border: 1px solid var(--ef-border);
        border-radius: 20px;
        font-size: 12px; font-weight: 600;
        color: var(--ef-text2);
        transition: border-color 0.15s, color 0.15s;
        cursor: default;
        max-width: 100%;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }
    .fw-tag:hover { border-color: var(--ef-teal); color: var(--ef-mint); }
    .fw-tag svg { width: 12px; height: 12px; stroke: var(--ef-teal); flex-shrink: 0; }

    /* ── Sidebar ── */
    .fw-sidebar-card {
        background: var(--ef-surface);
        border: 1px solid var(--ef-border);
        border-radius: 10px;
        padding: 18px;
        margin-bottom: 16px;
    }

    .fw-sidebar-title {
        font-size: 11px;
        font-weight: 800;
        letter-spacing: 1.5px;
        text-transform: uppercase;
        color: var(--ef-mint);
        margin: 0 0 14px;
        display: flex; align-items: center; gap: 7px;
    }

    .fw-sidebar-title::before {
        content: '';
        display: inline-block;
        width: 3px; height: 11px;
        background: var(--ef-teal); border-radius: 2px;
    }

    /* Quick action links */
    .fw-action-link {
        display: flex; align-items: center; gap: 10px;
        padding: 10px 12px;
        background: var(--ef-bg);
        border: 1px solid var(--ef-border);
        border-radius: 7px;
        font-size: 13px; font-weight: 600;
        color: var(--ef-text2);
        text-decoration: none;
        transition: border-color 0.15s, color 0.15s;
        margin-bottom: 8px;
    }
    .fw-action-link:last-child { margin-bottom: 0; }
    .fw-action-link:hover { border-color: var(--ef-teal); color: var(--ef-mint); }
    .fw-action-link svg { width: 15px; height: 15px; stroke: var(--ef-teal); flex-shrink: 0; }

    /* Related files */
    .fw-related-item {
        display: flex; align-items: center; gap: 10px;
        padding: 9px 10px;
        border-radius: 7px;
        text-decoration: none;
        transition: background 0.15s;
        margin-bottom: 4px;
    }
    .fw-related-item:last-child { margin-bottom: 0; }
    .fw-related-item:hover { background: var(--ef-surface2); }

    .fw-related-icon {
        width: 30px; height: 30px;
        background: var(--ef-teal-bg);
        border: 1px solid var(--ef-teal);
        border-radius: 6px;
        display: flex; align-items: center; justify-content: center;
        flex-shrink: 0;
    }
    .fw-related-icon svg { width: 13px; height: 13px; stroke: var(--ef-mint); }

    .fw-related-name {
        font-size: 13px; font-weight: 600;
        color: var(--ef-text2);
        overflow: hidden;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        word-break: break-word;
        transition: color 0.15s;
    }
    .fw-related-item:hover .fw-related-name { color: var(--ef-mint); }

    .fw-related-size {
        font-size: 11px;
        color: var(--ef-muted);
        margin-top: 2px;
    }

    /* ── Responsive improvements ── */
    @media (max-width: 768px) {
        .fw-name-row {
            flex-direction: column;
        }
        
        .fw-price-block {
            text-align: left;
            width: 100%;
        }
        
        .fw-actions {
            flex-direction: column;
        }
        
        .fw-btn-download {
            width: 100%;
        }
    }

    @media (max-width: 640px) {
        .fw-page {
            padding: 16px 12px 48px;
        }
        
        .fw-title {
            font-size: 18px;
        }
        
        .fw-card-body {
            padding: 16px;
        }
        
        .fw-detail-row {
            padding: 10px 12px;
        }
        
        .fw-detail-value {
            font-size: 13px;
        }
        
        .fw-breadcrumb-current {
            max-width: 40vw;
        }
        
        .fw-breadcrumb a {
            max-width: 120px;
        }
        
        .fw-stars {
            flex-wrap: wrap;
        }
    }

    @media (max-width: 380px) {
        .fw-title {
            font-size: 16px;
        }
        
        .fw-badge-row {
            flex-direction: column;
            align-items: flex-start;
        }
        
        .fw-detail-left {
            min-width: 0;
        }
        
        .fw-detail-label {
            font-size: 11px;
        }
        
        .fw-detail-sub {
            display: none; /* Ocultar subtítulos en móvil muy pequeño */
        }
    }
    </style>

    <div class="fw-page">

        {{-- ── Breadcrumb ── --}}
        <nav class="fw-breadcrumb" aria-label="Breadcrumb">
            <a href="/" title="Home">
                <svg style="width:13px;height:13px;fill:currentColor;" viewBox="0 0 20 20">
                    <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"/>
                </svg>
                Home
            </a>
            @if($firmware->folder)
                <span class="fw-breadcrumb-sep">›</span>
                <a href="{{ route('folders.show', $firmware->folder) }}" title="{{ $firmware->folder->name }}">
                    {{ \Illuminate\Support\Str::words($firmware->folder->name, 3, '...') }}
                </a>
            @endif
            <span class="fw-breadcrumb-sep">›</span>
            <span class="fw-breadcrumb-current" title="{{ $firmware->name }}">{{ $firmware->name }}</span>
        </nav>

        {{-- ── Main grid ── --}}
        <div class="fw-grid">

            {{-- ══ Left column ══ --}}
            <div>

                {{-- ── Header card ── --}}
                <div class="fw-card">
                    <div class="fw-card-body">

                        <div class="fw-name-row">
                            <div class="fw-name-left">

                                {{-- Badges --}}
                                <div class="fw-badge-row">
                                    @php
                                        $iconUrl = asset('images/gsmxstore/file.png');
                                        if ($firmware->icon_path) {
                                            if (filter_var($firmware->icon_path, FILTER_VALIDATE_URL)) {
                                                $iconUrl = $firmware->icon_path;
                                            } elseif (Storage::disk('public')->exists($firmware->icon_path)) {
                                                $iconUrl = Storage::disk('public')->url($firmware->icon_path);
                                            } elseif (file_exists(public_path('storage/' . $firmware->icon_path))) {
                                                $iconUrl = asset('storage/' . $firmware->icon_path);
                                            } elseif (file_exists(public_path($firmware->icon_path))) {
                                                $iconUrl = asset($firmware->icon_path);
                                            }
                                        }
                                    @endphp
                                    
                                    @if($firmware->icon_path)
                                        <img src="{{ $iconUrl }}" alt="{{ $firmware->name }}"
                                             style="width:32px;height:32px;object-fit:cover;border-radius:6px;border:1px solid var(--ef-border);"
                                             onerror="this.src='{{ asset('images/gsmxstore/file.png') }}'">
                                    @endif
                                    
                                    @php
                                        $badgeClass = match($firmware->type) {
                                            'free'     => 'fw-badge-free',
                                            'featured' => 'fw-badge-featured',
                                            'paid'     => 'fw-badge-paid',
                                            default    => 'fw-badge-free',
                                        };
                                        $badgeIcon = match($firmware->type) {
                                            'free'     => 'M5 13l4 4L19 7',
                                            'featured' => 'M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z',
                                            'paid'     => 'M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1',
                                            default    => 'M5 13l4 4L19 7',
                                        };
                                    @endphp
                                    <span class="fw-badge {{ $badgeClass }}">
                                        <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="{{ $badgeIcon }}"/>
                                        </svg>
                                        {{ ucfirst($firmware->type) }}
                                    </span>
                                    @if($firmware->created_at->diffInHours(now()) < 24)
                                        <span class="fw-badge fw-badge-new">NEW</span>
                                    @endif
                                </div>

                                {{-- Title --}}
                                <h1 class="fw-title" title="{{ $firmware->name }}">{{ $firmware->name }}</h1>

                                {{-- Stars --}}
                                <div class="fw-stars">
                                    @for($i = 1; $i <= 5; $i++)
                                        <svg class="fw-star {{ $i <= $firmware->rating ? 'fw-star-filled' : 'fw-star-empty' }}" viewBox="0 0 20 20">
                                            <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                                        </svg>
                                    @endfor
                                    <span class="fw-rating-val">({{ number_format($firmware->rating, 1) }})</span>
                                </div>

                                @auth
                                    <div style="margin-bottom:12px;">
                                        <livewire:firmware-rating-manager :firmware="$firmware" />
                                    </div>
                                @endauth

                                @if($firmware->description)
                                    <p class="fw-description" title="{{ $firmware->description }}">{{ $firmware->description }}</p>
                                @endif
                            </div>

                            {{-- Price (paid only) --}}
                            @if($firmware->type === 'paid')
                                <div class="fw-price-block">
                                    <div class="fw-price">${{ number_format($firmware->price, 2) }}</div>
                                    <div class="fw-price-label">One-time purchase</div>
                                </div>
                            @endif
                        </div>

                        {{-- Action buttons --}}
                        <div class="fw-actions">
                            <a href="{{ route('firmware.download', $firmware) }}" class="fw-btn-download" target="_blank">
                                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10"/>
                                </svg>
                                Download Now
                            </a>
                            <button class="fw-btn-secondary">
                                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                </svg>
                                Favourites
                            </button>
                        </div>

                    </div>
                </div>

                {{-- ── File Details card ── --}}
                <div class="fw-card">
                    <div class="fw-card-header">
                        <h3 class="fw-card-title">File Details</h3>
                        <p class="fw-card-subtitle">Technical information about this firmware file</p>
                    </div>
                    <div class="fw-card-body">
                        <div class="fw-details-grid">

                            {{-- Size --}}
                            <div class="fw-detail-row">
                                <div class="fw-detail-left">
                                    <div class="fw-detail-icon">
                                        <svg fill="none" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="fw-detail-label">File Size</p>
                                        <p class="fw-detail-sub">Total download size</p>
                                    </div>
                                </div>
                                <div class="fw-detail-value">{{ $firmware->formatted_size }}</div>
                            </div>

                            {{-- Downloads --}}
                            <div class="fw-detail-row">
                                <div class="fw-detail-left">
                                    <div class="fw-detail-icon">
                                        <svg fill="none" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="fw-detail-label">Downloads</p>
                                        <p class="fw-detail-sub">Total downloads</p>
                                    </div>
                                </div>
                                <div class="fw-detail-value">{{ number_format($firmware->downloads_count) }}</div>
                            </div>

                            {{-- Views --}}
                            <div class="fw-detail-row">
                                <div class="fw-detail-left">
                                    <div class="fw-detail-icon">
                                        <svg fill="none" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="fw-detail-label">Views</p>
                                        <p class="fw-detail-sub">Total views</p>
                                    </div>
                                </div>
                                <div class="fw-detail-value">{{ number_format($firmware->views_count) }}</div>
                            </div>

                            {{-- Category --}}
                            @if($firmware->folder)
                            <div class="fw-detail-row">
                                <div class="fw-detail-left">
                                    <div class="fw-detail-icon">
                                        <svg fill="none" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="fw-detail-label">Category</p>
                                        <p class="fw-detail-sub">File category</p>
                                    </div>
                                </div>
                                <div class="fw-detail-value" title="{{ $firmware->folder->name }}">
                                    {{ \Illuminate\Support\Str::words($firmware->folder->name, 3, '...') }}
                                </div>
                            </div>
                            @endif

                        </div>
                    </div>
                </div>

                {{-- ── Tags card ── --}}
                @if($firmware->tags->isNotEmpty())
                <div class="fw-card">
                    <div class="fw-card-header">
                        <h3 class="fw-card-title">Tags</h3>
                        <p class="fw-card-subtitle">Related keywords and categories</p>
                    </div>
                    <div class="fw-card-body">
                        <div class="fw-tags">
                            @foreach($firmware->tags as $tag)
                                <span class="fw-tag" title="{{ $tag->name }}">
                                    <svg fill="none" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                                    </svg>
                                    {{ $tag->name }}
                                </span>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endif

            </div>

            {{-- ══ Sidebar ══ --}}
            <div>

                {{-- Quick Actions --}}
                <div class="fw-sidebar-card">
                    <h3 class="fw-sidebar-title">Quick Actions</h3>
                    <a href="{{ route('firmware.report.create', $firmware) }}" class="fw-action-link">
                        <svg fill="none" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Report Issue
                    </a>
                    <a href="{{ route('tickets.create') }}" class="fw-action-link">
                        <svg fill="none" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Get Help
                    </a>
                </div>

                {{-- Related Files --}}
                @if(isset($relatedFirmware) && $relatedFirmware->count() > 0)
                <div class="fw-sidebar-card">
                    <h3 class="fw-sidebar-title">Related Files</h3>
                    @foreach($relatedFirmware->take(5) as $related)
                        <a href="{{ route('firmware.show', $related) }}" class="fw-related-item">
                            <div class="fw-related-icon">
                                <svg fill="none" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                            </div>
                            <div style="flex:1;min-width:0;">
                                <div class="fw-related-name" title="{{ $related->name }}">{{ $related->name }}</div>
                                <div class="fw-related-size">{{ $related->formatted_size ?? $related->size }}</div>
                            </div>
                        </a>
                    @endforeach
                </div>
                @endif

            </div>

        </div>
    </div>

</x-app-layout>