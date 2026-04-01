<x-app-layout>
<x-slot name="title">
    @php
        $path = [];
        $currentFolder = $folder;
        while ($currentFolder) {
            $path[] = $currentFolder->name;
            $currentFolder = $currentFolder->parent;
        }
        echo implode(' > ', array_reverse($path));
    @endphp
</x-slot>

<style>
/* ══════════════════════════════════════════
   FOLDER SHOW — usa variables --ef-*
   ══════════════════════════════════════════ */

.fld-page {
    max-width: 1280px;
    margin: 0 auto;
    padding: 28px 16px 64px;
}

/* ── Breadcrumb (reutiliza fw-breadcrumb) ── */
.fw-breadcrumb {
    display: flex; align-items: center; flex-wrap: wrap;
    gap: 4px; margin-bottom: 24px; font-size: 12px;
}
.fw-breadcrumb a {
    display: inline-flex; align-items: center; gap: 5px;
    color: var(--ef-muted); text-decoration: none; font-weight: 500;
    transition: color 0.15s;
}
.fw-breadcrumb a:hover { color: var(--ef-mint); }
.fw-breadcrumb-sep  { color: var(--ef-border2); font-size: 14px; }
.fw-breadcrumb-current {
    color: var(--ef-text2);
    font-weight: 600;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
    max-width: min(280px, 70vw);
}

/* ── Folder header card ── */
.fld-header {
    background: var(--ef-surface);
    border: 1px solid var(--ef-border);
    border-top: 3px solid var(--ef-teal);
    border-radius: 10px;
    padding: 24px;
    margin-bottom: 28px;
    display: flex;
    align-items: center;
    gap: 20px;
    flex-wrap: wrap;
}

.fld-header-icon {
    width: 72px; height: 72px;
    border-radius: 10px;
    border: 1px solid var(--ef-border);
    object-fit: cover;
    flex-shrink: 0;
}

.fld-header-name {
    font-size: 22px; font-weight: 800;
    color: var(--ef-text); margin: 0 0 6px;
    letter-spacing: -0.4px;
    word-break: break-word;
}

.fld-header-desc {
    font-size: 14px; color: var(--ef-muted);
    margin: 0 0 12px; line-height: 1.6;
    word-break: break-word;
}

.fld-header-meta {
    display: flex; align-items: center;
    flex-wrap: wrap; gap: 18px;
    font-size: 12px; font-weight: 600;
    color: var(--ef-muted);
}

.fld-header-meta span {
    display: inline-flex; align-items: center; gap: 6px;
}

.fld-header-meta svg {
    width: 14px; height: 14px; stroke: var(--ef-teal);
}

/* ── Section heading ── */
.fld-section { margin-bottom: 36px; }

.fld-section-head {
    display: flex; align-items: center; gap: 10px;
    margin-bottom: 16px;
}

.fld-section-head h2 {
    font-size: 13px; font-weight: 800;
    letter-spacing: 2px; text-transform: uppercase;
    color: var(--ef-mint); margin: 0;
    display: flex; align-items: center; gap: 7px;
}

.fld-section-head h2::before {
    content: '';
    display: inline-block;
    width: 3px; height: 13px;
    background: var(--ef-teal); border-radius: 2px;
}

/* ── Subfolder cards ── */
.fld-subfolder-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
    gap: 12px;
}

.fld-subfolder-card {
    background: var(--ef-surface);
    border: 1px solid var(--ef-border);
    border-radius: 9px;
    padding: 16px;
    display: flex; align-items: center; gap: 14px;
    cursor: pointer;
    text-decoration: none;
    transition: border-color 0.2s, transform 0.2s, box-shadow 0.2s;
}

.fld-subfolder-card:hover {
    border-color: var(--ef-teal);
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(0,0,0,0.08);
}

html.dark .fld-subfolder-card:hover { box-shadow: 0 6px 20px rgba(0,0,0,0.4); }

.fld-subfolder-img {
    width: 48px; height: 48px;
    border-radius: 8px;
    border: 1px solid var(--ef-border);
    object-fit: cover;
    flex-shrink: 0;
    transition: transform 0.2s;
}
.fld-subfolder-card:hover .fld-subfolder-img { transform: scale(1.05); }

.fld-subfolder-name {
    font-size: 13px;
    font-weight: 700;
    color: var(--ef-text);
    margin: 0 0 3px;
    overflow: hidden;
    display: -webkit-box;
    -webkit-line-clamp: 1;
    -webkit-box-orient: vertical;
    word-break: break-word;
    transition: color 0.15s;
}
.fld-subfolder-card:hover .fld-subfolder-name { color: var(--ef-mint); }

.fld-subfolder-desc {
    font-size: 11px; color: var(--ef-muted);
    overflow: hidden;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    word-break: break-word;
}

/* ── Firmware file rows ── */
.fld-file-list { display: flex; flex-direction: column; gap: 10px; }

.fld-file-row {
    background: var(--ef-surface);
    border: 1px solid var(--ef-border);
    border-radius: 9px;
    padding: 16px 18px;
    display: flex;
    align-items: flex-start;
    gap: 14px;
    transition: border-color 0.2s, transform 0.2s, box-shadow 0.2s;
}

.fld-file-row:hover {
    border-color: var(--ef-teal);
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(0,0,0,0.07);
}

html.dark .fld-file-row:hover { box-shadow: 0 6px 20px rgba(0,0,0,0.35); }

.fld-file-icon {
    width: 44px; height: 44px;
    border-radius: 8px;
    border: 1px solid var(--ef-border);
    object-fit: cover;
    flex-shrink: 0;
}

.fld-file-content { 
    flex: 1; 
    min-width: 0;
}

.fld-file-title-row {
    display: flex;
    align-items: flex-start;
    flex-wrap: wrap;
    gap: 8px;
    margin-bottom: 6px;
    width: 100%;
}

.fld-file-title {
    font-size: 15px;
    font-weight: 700;
    color: var(--ef-text);
    text-decoration: none;
    overflow: hidden;
    display: -webkit-box;
    -webkit-line-clamp: 1;
    -webkit-box-orient: vertical;
    word-break: break-word;
    transition: color 0.15s;
    position: relative;
}
.fld-file-title:hover { color: var(--ef-mint); }

.fld-file-title:hover::after {
    content: attr(title);
    position: absolute;
    bottom: 100%;
    left: 0;
    background: var(--ef-surface);
    border: 1px solid var(--ef-border);
    padding: 4px 8px;
    border-radius: 4px;
    font-size: 12px;
    white-space: nowrap;
    z-index: 1000;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}

/* Reuse fw-badge classes from firmware-show */
.fw-badge {
    display: inline-flex; align-items: center; gap: 4px;
    font-size: 10px; font-weight: 800;
    padding: 3px 9px; border-radius: 20px;
    flex-shrink: 0;
}
.fw-badge svg { width: 10px; height: 10px; }
.fw-badge-free     { background: var(--ef-teal-bg);  color: var(--ef-teal-text); }
.fw-badge-featured { background: var(--ef-amber-bg); color: var(--ef-amber-text);}
.fw-badge-paid     { background: var(--ef-blue-bg);  color: var(--ef-blue-text); }

.fld-file-desc {
    font-size: 12px; color: var(--ef-muted);
    line-height: 1.55; margin-bottom: 10px;
    overflow: hidden;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    word-break: break-word;
}

.fld-file-meta {
    display: flex; flex-wrap: wrap; gap: 14px;
    font-size: 12px; color: var(--ef-muted);
}

.fld-file-meta-item {
    display: flex; align-items: center; gap: 5px;
}
.fld-file-meta-item svg { width: 13px; height: 13px; stroke: var(--ef-teal); }

/* File action button */
.fld-file-actions {
    flex-shrink: 0;
    display: flex; flex-direction: column; gap: 8px;
    margin-left: 8px;
}

.fld-btn-details {
    display: inline-flex; align-items: center; justify-content: center; gap: 6px;
    padding: 9px 16px;
    background: var(--ef-teal);
    color: #fff;
    border-radius: 7px;
    font-size: 12px; font-weight: 700;
    text-decoration: none;
    white-space: nowrap;
    transition: opacity 0.15s, transform 0.15s;
}
.fld-btn-details:hover { opacity: 0.85; transform: translateY(-1px); }
.fld-btn-details svg { width: 14px; height: 14px; }

/* ── Empty state ── */
.fld-empty {
    text-align: center; padding: 48px 0;
}
.fld-empty-icon {
    width: 60px; height: 60px;
    background: var(--ef-surface);
    border: 1px solid var(--ef-border);
    border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    margin: 0 auto 16px;
}
.fld-empty-icon svg { width: 26px; height: 26px; stroke: var(--ef-muted); }
.fld-empty h3 { font-size: 16px; font-weight: 700; color: var(--ef-text); margin: 0 0 6px; }
.fld-empty p  { font-size: 13px; color: var(--ef-muted); margin: 0; }

/* ── Responsive improvements ── */
@media (max-width: 640px) {
    .fld-page {
        padding: 16px 12px 48px;
    }
    
    .fld-header {
        padding: 16px;
        gap: 12px;
    }
    
    .fld-header-name {
        font-size: 18px;
    }
    
    .fld-file-row {
        flex-direction: column;
        padding: 12px;
    }
    
    .fld-file-actions {
        flex-direction: row;
        margin-left: 0;
        width: 100%;
    }
    
    .fld-btn-details {
        width: 100%;
    }
    
    .fld-file-title-row {
        flex-direction: column;
        align-items: flex-start;
        gap: 4px;
    }
    
    .fld-file-title {
        font-size: 14px;
        -webkit-line-clamp: 3;
        white-space: normal;
    }
    
    .fld-file-title:hover::after {
        display: none; /* Ocultar tooltip en móvil */
    }
    
    .fld-file-meta {
        flex-direction: column;
        gap: 8px;
    }
    
    .fld-subfolder-grid {
        grid-template-columns: 1fr;
    }
    
    .fld-subfolder-name {
        -webkit-line-clamp: 2;
        font-size: 12px;
    }
    
    .fld-subfolder-desc {
        -webkit-line-clamp: 3;
    }
    
    .fld-header-name,
    .fld-subfolder-name,
    .fld-file-title {
        hyphens: auto;
    }
    
    .fw-breadcrumb-current {
        max-width: 50vw;
    }
}

@media (max-width: 380px) {
    .fld-file-title {
        font-size: 13px;
        -webkit-line-clamp: 4;
    }
    
    .fld-subfolder-name {
        -webkit-line-clamp: 3;
    }
    
    .fld-header-icon {
        width: 56px;
        height: 56px;
    }
    
    .fld-header-meta {
        gap: 12px;
    }
}
</style>

<div class="fld-page">

    {{-- ── Breadcrumb ── --}}
    <nav class="fw-breadcrumb" aria-label="Breadcrumb">
        <a href="/">
            <svg style="width:13px;height:13px;fill:currentColor;" viewBox="0 0 20 20">
                <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"/>
            </svg>
            Home
        </a>
        @php
            $breadcrumbPath = [];
            $currentFolder = $folder;
            while ($currentFolder) {
                $breadcrumbPath[] = $currentFolder;
                $currentFolder = $currentFolder->parent;
            }
            $breadcrumbPath = array_reverse($breadcrumbPath);
        @endphp
        @foreach($breadcrumbPath as $index => $breadcrumbFolder)
            <span class="fw-breadcrumb-sep">›</span>
            @if($index === count($breadcrumbPath) - 1)
                <span class="fw-breadcrumb-current" title="{{ $breadcrumbFolder->name }}">{{ $breadcrumbFolder->name }}</span>
            @else
                <a href="{{ route('folders.show', $breadcrumbFolder) }}" title="{{ $breadcrumbFolder->name }}">{{ $breadcrumbFolder->name }}</a>
            @endif
        @endforeach
    </nav>

    {{-- ── Folder header ── --}}
    @php
        $folderIconUrl = asset('images/gsmxstore/folder.png');
        if ($folder->icon_path) {
            if (filter_var($folder->icon_path, FILTER_VALIDATE_URL)) {
                $folderIconUrl = $folder->icon_path;
            } elseif (Storage::disk('public')->exists($folder->icon_path)) {
                $folderIconUrl = Storage::disk('public')->url($folder->icon_path);
            } elseif (file_exists(public_path('storage/' . $folder->icon_path))) {
                $folderIconUrl = asset('storage/' . $folder->icon_path);
            } elseif (file_exists(public_path($folder->icon_path))) {
                $folderIconUrl = asset($folder->icon_path);
            }
        }
    @endphp

    <div class="fld-header">
        <img src="{{ $folderIconUrl }}"
             alt="{{ $folder->name }}"
             class="fld-header-icon"
             onerror="this.src='{{ asset('images/gsmxstore/folder.png') }}'">
        <div style="flex:1;min-width:0;">
            <h1 class="fld-header-name" title="{{ $folder->name }}">{{ $folder->name }}</h1>
            @if($folder->description)
                <p class="fld-header-desc" title="{{ $folder->description }}">{{ $folder->description }}</p>
            @endif
            <div class="fld-header-meta">
                <span>
                    <svg fill="none" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"/>
                    </svg>
                    {{ $subfolders->count() }} subfolders
                </span>
                <span>
                    <svg fill="none" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    {{ $firmwareFiles->count() }} files
                </span>
            </div>
        </div>
    </div>

    {{-- ── Subfolders ── --}}
    @if($subfolders->count() > 0)
    <div class="fld-section">
        <div class="fld-section-head">
            <h2>Subfolders</h2>
        </div>
        <div class="fld-subfolder-grid">
            @foreach($subfolders as $subfolder)
                @php
                    $subIconUrl = asset('images/gsmxstore/folder.png');
                    if ($subfolder->icon_path) {
                        if (filter_var($subfolder->icon_path, FILTER_VALIDATE_URL)) {
                            $subIconUrl = $subfolder->icon_path;
                        } elseif (Storage::disk('public')->exists($subfolder->icon_path)) {
                            $subIconUrl = Storage::disk('public')->url($subfolder->icon_path);
                        } elseif (file_exists(public_path('storage/' . $subfolder->icon_path))) {
                            $subIconUrl = asset('storage/' . $subfolder->icon_path);
                        } elseif (file_exists(public_path($subfolder->icon_path))) {
                            $subIconUrl = asset($subfolder->icon_path);
                        }
                    }
                @endphp
                <a href="{{ route('folders.show', $subfolder) }}" class="fld-subfolder-card" title="{{ $subfolder->name }}">
                    <img src="{{ $subIconUrl }}"
                         alt="{{ $subfolder->name }}"
                         class="fld-subfolder-img"
                         onerror="this.src='{{ asset('images/gsmxstore/folder.png') }}'">
                    <div style="flex:1;min-width:0;">
                        <div class="fld-subfolder-name">{{ $subfolder->name }}</div>
                        @if($subfolder->description)
                            <div class="fld-subfolder-desc" title="{{ $subfolder->description }}">{{ Str::limit($subfolder->description, 55) }}</div>
                        @endif
                    </div>
                </a>
            @endforeach
        </div>
    </div>
    @endif

    {{-- ── Firmware files ── --}}
    <div class="fld-section">
        <div class="fld-section-head">
            <h2>Firmware Files</h2>
        </div>

        @if($firmwareFiles->count() > 0)
            <div class="fld-file-list">
                @foreach($firmwareFiles as $firmware)
                    @php
                        $fileIconUrl = asset('images/gsmxstore/file.png');
                        if ($firmware->icon_path) {
                            if (filter_var($firmware->icon_path, FILTER_VALIDATE_URL)) {
                                $fileIconUrl = $firmware->icon_path;
                            } elseif (Storage::disk('public')->exists($firmware->icon_path)) {
                                $fileIconUrl = Storage::disk('public')->url($firmware->icon_path);
                            } elseif (file_exists(public_path('storage/' . $firmware->icon_path))) {
                                $fileIconUrl = asset('storage/' . $firmware->icon_path);
                            } elseif (file_exists(public_path($firmware->icon_path))) {
                                $fileIconUrl = asset($firmware->icon_path);
                            }
                        }

                        $badgeClass = match(strtolower($firmware->type ?? '')) {
                            'free'     => 'fw-badge-free',
                            'featured' => 'fw-badge-featured',
                            'paid'     => 'fw-badge-paid',
                            default    => 'fw-badge-free',
                        };
                        $badgeIcon = match(strtolower($firmware->type ?? '')) {
                            'free'     => 'M5 13l4 4L19 7',
                            'featured' => 'M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z',
                            'paid'     => 'M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1',
                            default    => 'M5 13l4 4L19 7',
                        };
                    @endphp

                    <div class="fld-file-row">
                        <img src="{{ $fileIconUrl }}"
                             alt="{{ $firmware->name }}"
                             class="fld-file-icon"
                             onerror="this.src='{{ asset('images/gsmxstore/file.png') }}'">

                        <div class="fld-file-content">
                            <div class="fld-file-title-row">
                                <a href="{{ route('firmware.show', $firmware) }}" 
                                   class="fld-file-title" 
                                   title="{{ $firmware->name }}">
                                    {{ $firmware->name }}
                                </a>
                                @if($firmware->type)
                                    <span class="fw-badge {{ $badgeClass }}">
                                        <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="{{ $badgeIcon }}"/>
                                        </svg>
                                        {{ ucfirst($firmware->type) }}
                                    </span>
                                @endif
                            </div>

                            @if($firmware->description)
                                <p class="fld-file-desc" title="{{ $firmware->description }}">{{ Str::limit($firmware->description, 120) }}</p>
                            @endif

                            <div class="fld-file-meta">
                                <span class="fld-file-meta-item">
                                    <svg fill="none" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                                    {{ $firmware->formatted_size ?? 'N/A' }}
                                </span>
                                <span class="fld-file-meta-item">
                                    <svg fill="none" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10"/></svg>
                                    {{ number_format($firmware->downloads_count ?? 0) }} downloads
                                </span>
                                @if($firmware->created_at)
                                    <span class="fld-file-meta-item">
                                        <svg fill="none" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                        {{ $firmware->created_at->format('M d, Y') }}
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="fld-file-actions">
                            <a href="{{ route('firmware.show', $firmware) }}" class="fld-btn-details">
                                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                                View Details
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="fld-empty">
                <div class="fld-empty-icon">
                    <svg fill="none" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </div>
                <h3>No Files Found</h3>
                <p>This folder doesn't contain any firmware files yet.</p>
            </div>
        @endif
    </div>

</div>

</x-app-layout>