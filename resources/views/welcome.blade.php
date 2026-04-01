<x-app-layout>

<style>
/* ══════════════════════════════════════════
   CSS TOKENS — light / dark
   (definidos también en app-layout, se repiten
    aquí como fallback por si este partial se
    carga antes del layout en dev)
   ══════════════════════════════════════════ */
:root {
    --ef-teal      : #1aa87a;
    --ef-mint      : #3dd68c;
    --ef-blue      : #2563c8;
    --ef-bg        : #f4f4f4;
    --ef-surface   : #ffffff;
    --ef-surface2  : #eeeeee;
    --ef-border    : #e0e0e0;
    --ef-border2   : #cccccc;
    --ef-text      : #111111;
    --ef-text2     : #444444;
    --ef-muted     : #888888;
    --ef-teal-bg   : #e8f8f2;
    --ef-teal-text : #0d6648;
    --ef-blue-bg   : #e8eeff;
    --ef-blue-text : #1a3e99;
    --ef-amber-bg  : #fff8e1;
    --ef-amber-text: #7a5500;
}

html.dark {
    --ef-bg        : #0a0a0a;
    --ef-surface   : #111111;
    --ef-surface2  : #161616;
    --ef-border    : #1e1e1e;
    --ef-border2   : #2a2a2a;
    --ef-text      : #f0f0f0;
    --ef-text2     : #bbbbbb;
    --ef-muted     : #555555;
    --ef-teal-bg   : #0a2018;
    --ef-teal-text : #3dd68c;
    --ef-blue-bg   : #0d1e40;
    --ef-blue-text : #6b9eff;
    --ef-amber-bg  : #1f1600;
    --ef-amber-text: #d4a017;
}

/* ══════════════════════════════════════════
   SEARCH BAR
   ══════════════════════════════════════════ */
.ef-search-wrap {
    max-width: 680px;
    margin: 20px auto 24px;
    padding: 0 16px;
}

.ef-search-form {
    display: flex;
    align-items: center;
    gap: 8px;
    background: var(--ef-surface);
    border: 1px solid var(--ef-border);
    border-radius: 10px;
    padding: 6px 6px 6px 0;
    transition: border-color 0.2s, box-shadow 0.2s;
}

.ef-search-form:focus-within {
    border-color: var(--ef-teal);
    box-shadow: 0 0 0 3px rgba(26,168,122,0.1);
}

.ef-search-input-wrap {
    position: relative;
    flex: 1;
    display: flex;
    align-items: center;
}

.ef-search-icon {
    position: absolute; left: 14px; top: 50%; transform: translateY(-50%);
    pointer-events: none; display: flex;
}
.ef-search-icon svg { width: 17px; height: 17px; stroke: var(--ef-muted); transition: stroke 0.15s; }
.ef-search-form:focus-within .ef-search-icon svg { stroke: var(--ef-teal); }

.ef-search-input {
    width: 100%;
    padding: 10px 40px 10px 44px;
    background: transparent; border: none; outline: none;
    font-size: 14px; color: var(--ef-text); font-family: inherit;
}
.ef-search-input::placeholder { color: var(--ef-muted); }

.ef-search-clear {
    position: absolute; right: 10px; top: 50%; transform: translateY(-50%);
    display: flex; align-items: center; justify-content: center;
    width: 20px; height: 20px; border-radius: 50%;
    background: var(--ef-border2); color: var(--ef-muted);
    text-decoration: none; transition: background 0.15s, color 0.15s;
}
.ef-search-clear:hover { background: var(--ef-teal); color: #fff; }
.ef-search-clear svg { width: 11px; height: 11px; }

.ef-search-btn {
    display: inline-flex; align-items: center; gap: 6px;
    padding: 9px 18px;
    background: var(--ef-teal); color: #fff;
    border: none; border-radius: 7px;
    font-size: 13px; font-weight: 700;
    cursor: pointer; white-space: nowrap;
    transition: opacity 0.15s; flex-shrink: 0;
}
.ef-search-btn:hover { opacity: 0.85; }
.ef-search-btn svg { width: 14px; height: 14px; }

.ef-search-result-bar {
    display: flex; align-items: center; gap: 7px;
    margin-top: 10px; padding: 7px 12px;
    background: var(--ef-teal-bg);
    border: 1px solid var(--ef-teal);
    border-radius: 7px; font-size: 12px;
    color: var(--ef-teal-text);
}
html.dark .ef-search-result-bar { color: var(--ef-mint); }
.ef-search-result-bar strong { font-weight: 700; }
.ef-search-result-clear {
    margin-left: auto; font-size: 11px; font-weight: 700;
    color: var(--ef-teal); text-decoration: none; transition: color 0.15s;
}
.ef-search-result-clear:hover { color: var(--ef-mint); }

/* ══════════════════════════════════════════
   MARQUEE
   ══════════════════════════════════════════ */
.mq-container { margin-bottom: 10px; }

.mq-header {
    background: var(--ef-surface);
    border: 1px solid var(--ef-border); border-bottom: none;
    border-radius: 8px 8px 0 0;
    padding: 7px 12px; display: flex; align-items: center; gap: 10px;
}

.mq-marker {
    font-size: 10px; font-weight: 800; letter-spacing: 1.5px;
    text-transform: uppercase; padding: 2px 10px;
    border-radius: 3px; white-space: nowrap;
}
.mq-marker-recent { background: var(--ef-blue); color: #fff; }
.mq-marker-top    { background: var(--ef-teal); color: #fff; }

.mq-header-label { font-size: 11px; color: var(--ef-muted); font-weight: 500; }

.marquee-set {
    height: 34px; overflow: hidden; position: relative;
    background: var(--ef-bg);
    border: 1px solid var(--ef-border); border-top: none;
    border-radius: 0 0 8px 8px;
}

.marquee-track, .marquee-track-slow {
    position: absolute; display: inline-flex;
    align-items: center; height: 100%;
    white-space: nowrap; will-change: transform;
}

.mq-file-item {
    font-size: 13px; padding: 0 5px; margin-right: 15px;
    display: inline-flex; align-items: center; gap: 6px;
    white-space: nowrap; color: var(--ef-muted);
}
.mq-file-item a { font-weight: 700; color: var(--ef-text2); text-decoration: none; transition: color 0.15s; }
.mq-file-item a:hover { color: var(--ef-mint); }
.mq-badge { font-size: 10px; font-weight: 600; padding: 1px 7px; border-radius: 20px; }
.mq-badge-blue  { background: var(--ef-blue-bg);  color: var(--ef-blue-text); }
.mq-badge-teal  { background: var(--ef-teal-bg);  color: var(--ef-teal-text); }
.mq-badge-amber { background: var(--ef-amber-bg); color: var(--ef-amber-text); }
.mq-detail { font-size: 11px; color: var(--ef-muted); }
.mq-sep    { color: var(--ef-border); margin: 0 2px; font-size: 12px; }

/* ══════════════════════════════════════════
   FOLDERS
   ══════════════════════════════════════════ */
.folder-home-item {
    height: 80px; overflow: hidden; margin: 8px; width: 280px; max-width: 100%;
    position: relative; border-radius: 10px;
    transition: transform 0.22s, box-shadow 0.22s, border-color 0.22s;
    border: 1px solid var(--ef-border); background: var(--ef-bg);
    cursor: pointer; flex-shrink: 0;
}
.folder-home-item:hover {
    transform: translateY(-3px); box-shadow: 0 10px 28px rgba(0,0,0,0.12);
    border-color: var(--ef-teal);
}
html.dark .folder-home-item:hover { box-shadow: 0 10px 28px rgba(0,0,0,0.5); }

.folder-ribbon {
    position: absolute; top: 0; left: 0; padding: 2px 8px;
    font-size: 10px; font-weight: 800; letter-spacing: 0.5px;
    background: var(--ef-blue); color: #fff;
    border-radius: 0 0 7px 0; z-index: 10; line-height: 18px;
}

.folder-image {
    float: left; width: 30%; height: 100%;
    display: flex; align-items: center; justify-content: center; padding: 8px;
}
.folder-image img { max-height: 50px; max-width: 50px; object-fit: contain; }

.folder-body {
    float: left; width: 68%; height: 100%;
    display: flex; flex-direction: column; justify-content: center;
    padding: 8px 12px 8px 4px; overflow: hidden;
}

.folder-title { font-weight: 700; font-size: 13px; line-height: 1.3; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; color: var(--ef-text); }
.folder-title a { color: inherit; text-decoration: none; }
.folder-title a:hover { color: var(--ef-mint); }

.folder-description { font-size: 11.5px; color: var(--ef-muted); margin-top: 3px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }

.folder-count {
    display: inline-flex; align-items: center; margin-top: 5px;
    font-size: 10px; font-weight: 600;
    color: var(--ef-teal-text); background: var(--ef-teal-bg);
    border-radius: 20px; padding: 1px 7px; width: fit-content;
}

.ef-section-heading { display: flex; align-items: center; gap: 10px; margin-bottom: 16px; }
.ef-section-heading h2 { font-size: 11px; font-weight: 700; letter-spacing: 2px; text-transform: uppercase; color: var(--ef-mint); margin: 0; }
.ef-section-heading svg { stroke: var(--ef-teal); flex-shrink: 0; }
.ef-count-pill { margin-left: auto; font-size: 11px; background: var(--ef-teal-bg); color: var(--ef-teal-text); padding: 2px 9px; border-radius: 20px; font-weight: 600; }
</style>

{{-- ══════════════════════════════════════════ --}}
{{-- MARQUEE: RECENT FILES                      --}}
{{-- ══════════════════════════════════════════ --}}
@if(isset($top10RecentFirmware) && $top10RecentFirmware->count() > 0)
<div class="mq-container">
    <div class="mq-header">
        <span class="mq-marker mq-marker-recent">Recent</span>
        <span class="mq-header-label">Latest uploaded firmware files</span>
    </div>
    <div class="marquee-set">
        <div class="marquee-track">
            @foreach($top10RecentFirmware as $firmware)
                <span class="mq-file-item">
                    <a href="{{ route('firmware.show', $firmware) }}">{{ $firmware->name }}</a>
                    <span class="mq-sep">|</span>
                    <span class="mq-detail">{{ $firmware->formatted_size ?? 'N/A' }}</span>
                    <span class="mq-sep">|</span>
                    <span class="mq-badge mq-badge-blue">{{ $firmware->type ?? 'N/A' }}</span>
                    <span class="mq-sep">|</span>
                    <span class="mq-detail">{{ $firmware->created_at->format('d-m-Y') }}</span>
                </span>
            @endforeach
            @foreach($top10RecentFirmware as $firmware)
                <span class="mq-file-item">
                    <a href="{{ route('firmware.show', $firmware) }}">{{ $firmware->name }}</a>
                    <span class="mq-sep">|</span>
                    <span class="mq-detail">{{ $firmware->formatted_size ?? 'N/A' }}</span>
                    <span class="mq-sep">|</span>
                    <span class="mq-badge mq-badge-blue">{{ $firmware->type ?? 'N/A' }}</span>
                    <span class="mq-sep">|</span>
                    <span class="mq-detail">{{ $firmware->created_at->format('d-m-Y') }}</span>
                </span>
            @endforeach
        </div>
    </div>
</div>
@endif

{{-- ══════════════════════════════════════════ --}}
{{-- MARQUEE: TOP DOWNLOADED                   --}}
{{-- ══════════════════════════════════════════ --}}
@if(isset($top10DownloadedFirmware) && $top10DownloadedFirmware->count() > 0)
<div class="mq-container">
    <div class="mq-header">
        <span class="mq-marker mq-marker-top">Top</span>
        <span class="mq-header-label">Most downloaded firmware files</span>
    </div>
    <div class="marquee-set">
        <div class="marquee-track-slow">
            @foreach($top10DownloadedFirmware as $firmware)
                <span class="mq-file-item">
                    <a href="{{ route('firmware.show', $firmware) }}">{{ $firmware->name }}</a>
                    <span class="mq-sep">|</span>
                    <span class="mq-detail">{{ $firmware->formatted_size ?? 'N/A' }}</span>
                    <span class="mq-sep">|</span>
                    <span class="mq-badge mq-badge-teal">{{ $firmware->type ?? 'N/A' }}</span>
                    <span class="mq-sep">|</span>
                    <span class="mq-detail">{{ $firmware->created_at->format('d-m-Y') }}</span>
                    <span class="mq-sep">|</span>
                    <span class="mq-badge mq-badge-amber">↓ {{ number_format($firmware->downloads_count) }}</span>
                </span>
            @endforeach
            @foreach($top10DownloadedFirmware as $firmware)
                <span class="mq-file-item">
                    <a href="{{ route('firmware.show', $firmware) }}">{{ $firmware->name }}</a>
                    <span class="mq-sep">|</span>
                    <span class="mq-detail">{{ $firmware->formatted_size ?? 'N/A' }}</span>
                    <span class="mq-sep">|</span>
                    <span class="mq-badge mq-badge-teal">{{ $firmware->type ?? 'N/A' }}</span>
                    <span class="mq-sep">|</span>
                    <span class="mq-detail">{{ $firmware->created_at->format('d-m-Y') }}</span>
                    <span class="mq-sep">|</span>
                    <span class="mq-badge mq-badge-amber">↓ {{ number_format($firmware->downloads_count) }}</span>
                </span>
            @endforeach
        </div>
    </div>
</div>
@endif

{{-- ══════════════════════════════════════════ --}}
{{-- SEARCH BAR                                 --}}
{{-- ══════════════════════════════════════════ --}}
<div class="ef-search-wrap">
    <form action="{{ route('home') }}" method="GET" class="ef-search-form">
        <div class="ef-search-input-wrap">
            <div class="ef-search-icon">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
            </div>
            <input type="text"
                   name="search"
                   value="{{ request('search') }}"
                   placeholder="Search firmware files by name, model or brand..."
                   class="ef-search-input"
                   autocomplete="off">
            @if(request('search'))
                <a href="{{ route('home') }}" class="ef-search-clear" title="Clear">
                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </a>
            @endif
        </div>
        <button type="submit" class="ef-search-btn">
            <svg fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
            <span>Search</span>
        </button>
    </form>

    @if(request('search'))
        <div class="ef-search-result-bar">
            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="width:13px;height:13px;flex-shrink:0;">
                <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            Showing results for <strong>"{{ request('search') }}"</strong>
            <a href="{{ route('home') }}" class="ef-search-result-clear">Clear ×</a>
        </div>
    @endif
</div>

{{-- ══════════════════════════════════════════ --}}
{{-- FOLDERS                                   --}}
{{-- ══════════════════════════════════════════ --}}
@if(isset($folders) && $folders->count() > 0)
<section class="py-10 px-4">
    <div class="max-w-7xl mx-auto">

        <div class="ef-section-heading">
            <svg style="width:16px;height:16px;" fill="none" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"/>
            </svg>
            <h2>Browse by Category</h2>
            <span class="ef-count-pill">{{ $folders->count() }} categories</span>
        </div>

        <div class="flex flex-wrap justify-center md:justify-start -m-2">
            @foreach ($folders as $folder)
                @php
                    $folderIconUrl = asset('images/gsmxstore/folder.png');
                    if ($folder->icon_path) {
                        if (filter_var($folder->icon_path, FILTER_VALIDATE_URL)) {
                            $folderIconUrl = $folder->icon_path;
                        } elseif (Storage::disk('public')->exists($folder->icon_path)) {
                            $folderIconUrl = Storage::disk('public')->url($folder->icon_path);
                        }
                    }
                @endphp

                <div class="folder-home-item"
                     onclick="window.location.href='{{ route('folders.show', $folder) }}'">

                    @if($folder->created_at->diffInHours(now()) < 24)
                        <div class="folder-ribbon">NEW</div>
                    @endif

                    <div class="folder-image">
                        <img src="{{ $folderIconUrl }}" alt="{{ $folder->name }}">
                    </div>

                    <div class="folder-body">
                        <div class="folder-title">
                            <a href="{{ route('folders.show', $folder) }}" onclick="event.stopPropagation()">
                                {{ $folder->name }}
                            </a>
                        </div>
                        <div class="folder-description">
                            {{ $folder->description ?? 'Firmware files for ' . $folder->name }}
                        </div>
                        @if(isset($folder->firmware_count))
                            <div class="folder-count">{{ number_format($folder->firmware_count) }} files</div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>

    </div>
</section>
@endif
   @if(isset($firmwareWithoutFolder) && $firmwareWithoutFolder->count() > 0)
        <section class="py-20 px-4">
            <div class="max-w-7xl mx-auto">
                <div class="text-center mb-12">
                    <div class="relative w-full h-1 bg-gradient-to-r from-transparent via-blue-500 to-transparent my-8 animate-pulse"></div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    @foreach ($firmwareWithoutFolder as $firmware)
                        <div class="card group cursor-pointer" onclick="window.location.href='{{ route('firmware.show', $firmware) }}'">
                            <div class="card-body text-center">
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">{{ $firmware->name }}</h3>
                                @if($firmware->created_at->diffInHours(now()) < 24)
                                    <span class="badge-animated badge-pulse bg-red-100 dark:bg-red-900/30 text-red-800 dark:text-red-300">New</span>
                                @endif
                                <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">
                                    {{ $firmware->formatted_size ?? 'N/A' }} •
                                    {{ number_format($firmware->downloads_count) }} downloads •
                                    {{ $firmware->file_extension ?? 'N/A' }} •
                                    <span class="font-bold text-blue-600 dark:text-blue-400">
                                        {{ $firmware->type ?? 'N/A' }}
                                        @if($firmware->type == 'Paid') ({{ $firmware->price ?? 'N/A' }}) @endif
                                    </span>
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

<script>
function initMarquee(selector, speed) {
    const track = document.querySelector(selector);
    if (!track) return;
    const wrapper = track.parentElement;
    let paused = false;
    wrapper.addEventListener('mouseenter', () => paused = true);
    wrapper.addEventListener('mouseleave', () => paused = false);
    let pos = 0, lastTime = null;
    let halfWidth = track.scrollWidth / 2;
    function tick(ts) {
        if (!lastTime) lastTime = ts;
        const delta = (ts - lastTime) / 1000;
        lastTime = ts;
        if (!paused) {
            pos += speed * delta;
            if (pos >= halfWidth) { pos -= halfWidth; halfWidth = track.scrollWidth / 2; }
            track.style.transform = `translateX(-${pos}px)`;
        }
        requestAnimationFrame(tick);
    }
    window.addEventListener('load', () => { halfWidth = track.scrollWidth / 2; requestAnimationFrame(tick); });
}
initMarquee('.marquee-track', 80);
initMarquee('.marquee-track-slow', 55);
</script>

</x-app-layout>