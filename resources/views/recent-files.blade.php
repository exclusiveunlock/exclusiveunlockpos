<x-app-layout>
<x-slot name="title">Recent Files</x-slot>

<style>
/* ══════════════════════════════════════════
   RECENT FILES — usa las variables globales
   de app-layout (--ef-*)
   ══════════════════════════════════════════ */

/* ── Ticker bar ── */
.rf-ticker {
    background: var(--ef-surface);
    border-bottom: 1px solid var(--ef-border);
    height: 38px;
    overflow: hidden;
    position: relative;
}

.rf-ticker-label {
    position: absolute;
    left: 0; top: 0; bottom: 0;
    z-index: 2;
    background: var(--ef-teal);
    color: #fff;
    font-size: 10px;
    font-weight: 800;
    letter-spacing: 1.5px;
    text-transform: uppercase;
    padding: 0 14px;
    display: flex;
    align-items: center;
    white-space: nowrap;
}

/* fade edges */
.rf-ticker::after {
    content: '';
    position: absolute;
    right: 0; top: 0; bottom: 0;
    width: 60px;
    background: linear-gradient(to right, transparent, var(--ef-surface));
    z-index: 1;
    pointer-events: none;
}

.rf-ticker-track {
    position: absolute;
    left: 0; top: 0;
    display: inline-flex;
    align-items: center;
    height: 100%;
    padding-left: 130px; /* make room for label */
    white-space: nowrap;
    will-change: transform;
}

.rf-ticker-item {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 0 20px;
    font-size: 12px;
    color: var(--ef-text2);
}

.rf-ticker-item .ti-name {
    font-weight: 700;
    color: var(--ef-text);
    max-width: 150px;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}

.rf-ticker-item .ti-sep   { color: var(--ef-border); }
.rf-ticker-item .ti-meta  { color: var(--ef-muted); font-size: 11px; }

.rf-ticker-item .ti-new {
    font-size: 9px;
    font-weight: 800;
    background: var(--ef-blue);
    color: #fff;
    padding: 1px 6px;
    border-radius: 3px;
    letter-spacing: 0.5px;
}

/* ── Page wrapper ── */
.rf-page {
    background: var(--ef-bg);
    min-height: 100vh;
    padding: 40px 0 64px;
}

/* ── Page header ── */
.rf-page-header {
    text-align: center;
    margin-bottom: 36px;
}

.rf-page-header h1 {
    font-size: 26px;
    font-weight: 800;
    color: var(--ef-text);
    margin: 0 0 8px;
    letter-spacing: -0.5px;
}

.rf-page-header h1 span { color: var(--ef-mint); }

.rf-page-header p {
    font-size: 14px;
    color: var(--ef-muted);
    max-width: 460px;
    margin: 0 auto;
    line-height: 1.7;
}

/* ── File card ── */
.rf-card {
    background: var(--ef-surface);
    border: 1px solid var(--ef-border);
    border-radius: 10px;
    padding: 18px 20px;
    margin-bottom: 10px;
    display: flex;
    align-items: flex-start;
    gap: 16px;
    transition: border-color 0.2s, box-shadow 0.2s, transform 0.2s;
}

.rf-card:hover {
    border-color: var(--ef-teal);
    box-shadow: 0 6px 24px rgba(0,0,0,0.08);
    transform: translateY(-2px);
}

html.dark .rf-card:hover {
    box-shadow: 0 6px 24px rgba(0,0,0,0.4);
}

/* File icon */
.rf-card-icon {
    width: 44px;
    height: 44px;
    background: var(--ef-teal-bg);
    border: 1px solid var(--ef-teal);
    border-radius: 9px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

.rf-card-icon svg { width: 20px; height: 20px; stroke: var(--ef-mint); }

/* Content */
.rf-card-content { 
    flex: 1; 
    min-width: 0; 
}

.rf-card-title-row {
    display: flex;
    align-items: flex-start;
    flex-wrap: wrap;
    gap: 8px;
    margin-bottom: 6px;
    width: 100%;
}

.rf-card-title {
    font-size: 15px;
    font-weight: 700;
    color: var(--ef-text);
    text-decoration: none;
    transition: color 0.15s;
    overflow: hidden;
    display: -webkit-box;
    -webkit-line-clamp: 1;
    -webkit-box-orient: vertical;
    word-break: break-word;
    max-width: 100%;
    position: relative;
}

.rf-card-title:hover { color: var(--ef-mint); }

.rf-card-title:hover::after {
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

/* Badges */
.rf-badge {
    display: inline-flex;
    align-items: center;
    gap: 4px;
    font-size: 10px;
    font-weight: 700;
    padding: 2px 8px;
    border-radius: 20px;
    white-space: nowrap;
    flex-shrink: 0;
}

.rf-badge svg { width: 10px; height: 10px; }

.rf-badge-free     { background: var(--ef-teal-bg);  color: var(--ef-teal-text); }
.rf-badge-featured { background: var(--ef-amber-bg); color: var(--ef-amber-text);}
.rf-badge-paid     { background: var(--ef-blue-bg);  color: var(--ef-blue-text); }
.rf-badge-new      { background: var(--ef-blue);     color: #fff; letter-spacing: 0.5px; }

/* Description */
.rf-card-desc {
    font-size: 13px;
    color: var(--ef-muted);
    margin-bottom: 10px;
    line-height: 1.6;
    overflow: hidden;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    word-break: break-word;
}

/* Meta row */
.rf-card-meta {
    display: flex;
    flex-wrap: wrap;
    gap: 14px;
    font-size: 12px;
    color: var(--ef-muted);
}

.rf-card-meta-item {
    display: flex;
    align-items: center;
    gap: 5px;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}

.rf-card-meta-item svg { 
    width: 13px; 
    height: 13px; 
    stroke: var(--ef-teal); 
    flex-shrink: 0; 
}

/* Actions */
.rf-card-actions {
    display: flex;
    flex-direction: column;
    gap: 8px;
    flex-shrink: 0;
    margin-left: 8px;
}

.rf-btn-download {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 6px;
    padding: 9px 16px;
    background: var(--ef-teal);
    color: #fff;
    border-radius: 8px;
    font-size: 13px;
    font-weight: 700;
    text-decoration: none;
    white-space: nowrap;
    transition: opacity 0.15s, transform 0.15s;
}

.rf-btn-download:hover { opacity: 0.85; transform: translateY(-1px); }
.rf-btn-download svg { width: 15px; height: 15px; flex-shrink: 0; }

.rf-btn-detail {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 6px;
    padding: 8px 16px;
    background: var(--ef-surface2, var(--ef-bg));
    border: 1px solid var(--ef-border);
    color: var(--ef-text2);
    border-radius: 8px;
    font-size: 13px;
    font-weight: 600;
    text-decoration: none;
    white-space: nowrap;
    transition: border-color 0.15s, color 0.15s;
}

.rf-btn-detail:hover { border-color: var(--ef-teal); color: var(--ef-mint); }
.rf-btn-detail svg { width: 14px; height: 14px; flex-shrink: 0; }

/* ── Empty state ── */
.rf-empty {
    text-align: center;
    padding: 64px 0;
}

.rf-empty-icon {
    width: 64px; height: 64px;
    background: var(--ef-surface);
    border: 1px solid var(--ef-border);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 20px;
}

.rf-empty-icon svg { width: 28px; height: 28px; stroke: var(--ef-muted); }
.rf-empty h3       { font-size: 17px; font-weight: 700; color: var(--ef-text); margin: 0 0 6px; }
.rf-empty p        { font-size: 13px; color: var(--ef-muted); margin: 0; }

/* ── Responsive ── */
@media (max-width: 768px) {
    .rf-card-meta {
        gap: 10px;
    }
    
    .rf-card-meta-item {
        font-size: 11px;
    }
}

@media (max-width: 640px) {
    .rf-card {
        flex-direction: column;
        padding: 16px;
    }
    
    .rf-card-actions {
        flex-direction: row;
        margin-left: 0;
        width: 100%;
    }
    
    .rf-btn-download,
    .rf-btn-detail {
        flex: 1;
    }
    
    .rf-card-title-row {
        flex-direction: column;
        align-items: flex-start;
        gap: 6px;
    }
    
    .rf-card-title {
        font-size: 14px;
        -webkit-line-clamp: 2;
    }
    
    .rf-card-title:hover::after {
        display: none; /* Ocultar tooltip en móvil */
    }
    
    .rf-card-desc {
        -webkit-line-clamp: 3;
        font-size: 12px;
    }
    
    .rf-card-meta {
        flex-direction: column;
        gap: 8px;
    }
    
    .rf-card-meta-item {
        width: 100%;
    }
    
    .rf-ticker-item .ti-name {
        max-width: 100px;
    }
}

@media (max-width: 380px) {
    .rf-card-title {
        font-size: 13px;
        -webkit-line-clamp: 3;
    }
    
    .rf-card-desc {
        -webkit-line-clamp: 4;
    }
    
    .rf-ticker-item {
        padding: 0 12px;
        gap: 4px;
    }
    
    .rf-ticker-item .ti-name {
        max-width: 80px;
    }
    
    .rf-page-header h1 {
        font-size: 22px;
    }
    
    .rf-page-header p {
        font-size: 13px;
    }
}

/* Mejora para el ticker en móvil */
@media (max-width: 480px) {
    .rf-ticker-label {
        padding: 0 10px;
        font-size: 9px;
    }
    
    .rf-ticker-track {
        padding-left: 100px;
    }
    
    .rf-ticker-item .ti-meta {
        display: none; /* Ocultar metadatos en móvil para más espacio */
    }
    
    .rf-ticker-item .ti-sep {
        display: none;
    }
    
    .rf-ticker-item {
        padding: 0 15px;
    }
    
    .rf-ticker-item .ti-name {
        max-width: 120px;
    }
}
</style>

{{-- ══════════════════════════════════════════
     TICKER BAR
     ══════════════════════════════════════════ --}}
@if($recentFiles->count() > 0)
<div class="rf-ticker">
    <div class="rf-ticker-label">Latest</div>
    <div class="rf-ticker-track" id="rfTickerTrack">
        @foreach($recentFiles->take(10) as $firmware)
            <span class="rf-ticker-item">
                <svg style="width:13px;height:13px;stroke:var(--ef-teal);flex-shrink:0;" fill="none" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                </svg>
                <span class="ti-name" title="{{ $firmware->name }}">{{ \Illuminate\Support\Str::words($firmware->name, 6, '...') }}</span>
                <span class="ti-sep">|</span>
                <span class="ti-meta">{{ $firmware->formatted_size }}</span>
                <span class="ti-sep">|</span>
                <span class="ti-meta">{{ number_format($firmware->downloads_count) }} dl</span>
                @if($firmware->created_at->diffInHours(now()) < 24)
                    <span class="ti-new">NEW</span>
                @endif
            </span>
        @endforeach
        {{-- duplicate --}}
        @foreach($recentFiles->take(10) as $firmware)
            <span class="rf-ticker-item">
                <svg style="width:13px;height:13px;stroke:var(--ef-teal);flex-shrink:0;" fill="none" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                </svg>
                <span class="ti-name" title="{{ $firmware->name }}">{{ \Illuminate\Support\Str::words($firmware->name, 6, '...') }}</span>
                <span class="ti-sep">|</span>
                <span class="ti-meta">{{ $firmware->formatted_size }}</span>
                <span class="ti-sep">|</span>
                <span class="ti-meta">{{ number_format($firmware->downloads_count) }} dl</span>
                @if($firmware->created_at->diffInHours(now()) < 24)
                    <span class="ti-new">NEW</span>
                @endif
            </span>
        @endforeach
    </div>
</div>
@endif

{{-- ══════════════════════════════════════════
     PAGE CONTENT
     ══════════════════════════════════════════ --}}
<div class="rf-page">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Header --}}
        <div class="rf-page-header">
            <h1>Recent <span>Files</span></h1>
            <p>Discover the latest firmware files added to our collection. Stay updated with the newest releases.</p>
        </div>

        {{-- File list --}}
        <div>
            @forelse ($recentFiles as $firmware)

                @php
                    $badgeClass = match($firmware->type) {
                        'free'     => 'rf-badge-free',
                        'featured' => 'rf-badge-featured',
                        'paid'     => 'rf-badge-paid',
                        default    => 'rf-badge-free',
                    };
                    $badgeIcon = match($firmware->type) {
                        'free'     => 'M5 13l4 4L19 7',
                        'featured' => 'M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z',
                        'paid'     => 'M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1',
                        default    => 'M5 13l4 4L19 7',
                    };
                @endphp

                <div class="rf-card">

                    {{-- Icon --}}
                    <div class="rf-card-icon">
                        <svg fill="none" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>

                    {{-- Content --}}
                    <div class="rf-card-content">
                        <div class="rf-card-title-row">
                            <a href="{{ route('firmware.show', $firmware) }}" 
                               class="rf-card-title"
                               title="{{ $firmware->name }}">
                                {{ \Illuminate\Support\Str::words($firmware->name, 10, '...') }}
                            </a>
                            <span class="rf-badge {{ $badgeClass }}">
                                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="{{ $badgeIcon }}"/>
                                </svg>
                                {{ ucfirst($firmware->type) }}
                            </span>
                            @if($firmware->created_at->diffInHours(now()) < 24)
                                <span class="rf-badge rf-badge-new">NEW</span>
                            @endif
                        </div>

                        @if($firmware->description)
                            <p class="rf-card-desc" title="{{ $firmware->description }}">{{ Str::limit($firmware->description, 140) }}</p>
                        @endif

                        <div class="rf-card-meta">
                            @if($firmware->folder)
                                <span class="rf-card-meta-item" title="{{ $firmware->folder->name }}">
                                    <svg fill="none" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"/></svg>
                                    {{ \Illuminate\Support\Str::words($firmware->folder->name, 4, '...') }}
                                </span>
                            @endif
                            <span class="rf-card-meta-item">
                                <svg fill="none" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                                {{ $firmware->formatted_size }}
                            </span>
                            <span class="rf-card-meta-item">
                                <svg fill="none" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10"/></svg>
                                {{ number_format($firmware->downloads_count) }} downloads
                            </span>
                            <span class="rf-card-meta-item">
                                <svg fill="none" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                {{ $firmware->created_at->format('M d, Y') }}
                            </span>
                        </div>
                    </div>

                    {{-- Actions --}}
                    <div class="rf-card-actions">
                        <a href="{{ route('firmware.download', $firmware) }}" class="rf-btn-download">
                            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                            </svg>
                            Download
                        </a>
                        <a href="{{ route('firmware.show', $firmware) }}" class="rf-btn-detail">
                            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Details
                        </a>
                    </div>

                </div>

            @empty
                <div class="rf-empty">
                    <div class="rf-empty-icon">
                        <svg fill="none" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                    <h3>No Recent Files</h3>
                    <p>Check back later for new firmware releases.</p>
                </div>
            @endforelse
        </div>

    </div>
</div>

<script>
(function () {
    const track = document.getElementById('rfTickerTrack');
    if (!track) return;
    const wrapper = track.parentElement;
    let paused = false;
    wrapper.addEventListener('mouseenter', () => paused = true);
    wrapper.addEventListener('mouseleave', () => paused = false);
    
    // Pausar en móvil al tocar
    wrapper.addEventListener('touchstart', () => paused = true);
    wrapper.addEventListener('touchend', () => {
        setTimeout(() => { paused = false; }, 2000);
    });
    
    let pos = 0, lastTime = null;
    let halfWidth = 0;
    
    function tick(ts) {
        if (!lastTime) lastTime = ts;
        const delta = (ts - lastTime) / 1000;
        lastTime = ts;
        
        if (!paused) {
            pos += 70 * delta;
            if (pos >= halfWidth && halfWidth > 0) {
                pos -= halfWidth;
                halfWidth = track.scrollWidth / 2;
            }
            track.style.transform = `translateX(-${pos}px)`;
        }
        requestAnimationFrame(tick);
    }
    
    window.addEventListener('load', () => {
        halfWidth = track.scrollWidth / 2;
        requestAnimationFrame(tick);
    });
    
    // Recalcular al cambiar tamaño de ventana
    window.addEventListener('resize', () => {
        halfWidth = track.scrollWidth / 2;
    });
})();
</script>

</x-app-layout>