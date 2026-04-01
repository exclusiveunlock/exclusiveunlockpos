<x-app-layout>

<style>
/* ══════════════════════════════════════════
   USER DASHBOARD — variables --ef-*
   ══════════════════════════════════════════ */

.ud-page { max-width: 1280px; margin: 0 auto; padding: 24px 20px 64px; }

/* ══ HERO — nombre + plan + balance en una fila compacta ══ */
.ud-hero {
    background: var(--ef-surface);
    border: 1px solid var(--ef-border);
    border-top: 3px solid var(--ef-teal);
    border-radius: 10px;
    padding: 20px 24px;
    margin-bottom: 16px;
    display: flex;
    align-items: center;
    gap: 14px;
    flex-wrap: wrap;
}

.ud-hero-avatar {
    width: 44px; height: 44px;
    background: var(--ef-teal-bg);
    border: 2px solid var(--ef-teal);
    border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    font-size: 17px; font-weight: 800;
    color: var(--ef-mint); flex-shrink: 0;
}

.ud-hero-info { flex: 1; min-width: 0; }
.ud-hero-name {
    font-size: 16px; font-weight: 800;
    color: var(--ef-text); margin: 0 0 2px; letter-spacing: -0.3px;
    white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
}
.ud-hero-name span { color: var(--ef-mint); }
.ud-hero-sub { font-size: 12px; color: var(--ef-muted); margin: 0; }

/* pills row */
.ud-hero-pills {
    display: flex; align-items: center; gap: 8px; flex-wrap: wrap;
    margin-left: auto;
}

.ud-hero-pill {
    display: flex; align-items: center; gap: 8px;
    padding: 8px 14px;
    background: var(--ef-bg);
    border: 1px solid var(--ef-border);
    border-radius: 8px;
}
.ud-hero-pill-label { font-size: 10px; font-weight: 700; letter-spacing: 0.8px; text-transform: uppercase; color: var(--ef-muted); margin-bottom: 2px; }
.ud-hero-pill-val   { font-size: 15px; font-weight: 800; color: var(--ef-text); line-height: 1; }
.ud-hero-pill-sub   { font-size: 10px; color: var(--ef-teal-text); font-weight: 600; margin-top: 1px; }
html.dark .ud-hero-pill-sub { color: var(--ef-mint); }

/* status dot */
.ud-dot {
    width: 7px; height: 7px; border-radius: 50%;
    background: var(--ef-teal); display: inline-block;
    box-shadow: 0 0 0 2px rgba(26,168,122,0.2);
}

/* ══ STATS GRID — compactas ══ */
.ud-stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
    gap: 10px; margin-bottom: 16px;
}

.ud-stat {
    background: var(--ef-surface);
    border: 1px solid var(--ef-border);
    border-radius: 9px; padding: 14px;
    display: flex; align-items: center;
    justify-content: space-between; gap: 10px;
    transition: border-color 0.2s, transform 0.15s;
}
.ud-stat:hover { border-color: var(--ef-teal); transform: translateY(-2px); }

.ud-stat-label { font-size: 10px; font-weight: 700; letter-spacing: 0.8px; text-transform: uppercase; color: var(--ef-muted); margin: 0 0 5px; }
.ud-stat-value { font-size: 20px; font-weight: 800; color: var(--ef-text); line-height: 1; margin: 0 0 5px; }
.ud-stat-sub   { font-size: 11px; color: var(--ef-muted); display: flex; align-items: center; gap: 4px; }
.ud-stat-sub a { color: var(--ef-teal); text-decoration: none; transition: color 0.15s; }
.ud-stat-sub a:hover { color: var(--ef-mint); }

.ud-stat-icon {
    width: 36px; height: 36px; flex-shrink: 0;
    background: var(--ef-teal-bg); border: 1px solid var(--ef-teal);
    border-radius: 8px;
    display: flex; align-items: center; justify-content: center;
}
.ud-stat-icon svg { width: 16px; height: 16px; stroke: var(--ef-mint); }
.ud-stat-icon i   { color: var(--ef-mint); font-size: 13px; }

/* Progress */
.ud-prog { width: 100%; height: 3px; background: var(--ef-border2); border-radius: 2px; overflow: hidden; margin: 5px 0 3px; }
.ud-prog-fill { height: 100%; background: var(--ef-teal); border-radius: 2px; }
.ud-prog-labels { display: flex; justify-content: space-between; font-size: 10px; color: var(--ef-muted); }

/* ══ CONTENT GRID — 2 cols ══ */
.ud-content-grid {
    display: grid;
    grid-template-columns: 2fr 1fr;
    gap: 14px;
    margin-bottom: 16px;
    align-items: start;
}
@media (max-width: 900px) { .ud-content-grid { grid-template-columns: 1fr; } }

/* ══ PANELS ══ */
.ud-panel {
    background: var(--ef-surface);
    border: 1px solid var(--ef-border);
    border-radius: 9px; overflow: hidden;
    margin-bottom: 0;
}

.ud-panel-head {
    display: flex; align-items: center; justify-content: space-between;
    padding: 12px 16px; border-bottom: 1px solid var(--ef-border);
}
.ud-panel-title {
    font-size: 10px; font-weight: 800;
    letter-spacing: 1.8px; text-transform: uppercase;
    color: var(--ef-mint); margin: 0;
    display: flex; align-items: center; gap: 6px;
}
.ud-panel-title::before {
    content: ''; display: inline-block;
    width: 3px; height: 11px;
    background: var(--ef-teal); border-radius: 2px;
}
.ud-panel-action {
    font-size: 11px; font-weight: 700; color: var(--ef-teal);
    text-decoration: none; background: none; border: none; cursor: pointer;
    transition: color 0.15s; display: flex; align-items: center; gap: 4px;
}
.ud-panel-action:hover { color: var(--ef-mint); }
.ud-panel-body { padding: 14px 16px; }

/* ══ ORDERS — 3 stat cards + list ══ */
.ud-orders-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(160px, 1fr));
    gap: 10px; margin-bottom: 16px;
}

/* ══ ORDER ITEMS ══ */
.ud-order-item {
    display: flex; align-items: center; justify-content: space-between;
    padding: 9px 0; border-bottom: 1px solid var(--ef-border); gap: 10px;
}
.ud-order-item:last-child { border-bottom: none; padding-bottom: 0; }
.ud-order-item:first-child { padding-top: 0; }

.ud-order-icon {
    width: 28px; height: 28px; flex-shrink: 0;
    background: var(--ef-teal-bg); border: 1px solid var(--ef-teal);
    border-radius: 6px; display: flex; align-items: center; justify-content: center;
}
.ud-order-icon i { color: var(--ef-mint); font-size: 10px; }
.ud-order-id   { font-size: 12px; font-weight: 700; color: var(--ef-text); margin: 0 0 1px; }
.ud-order-date { font-size: 10px; color: var(--ef-muted); margin: 0; }
.ud-order-amount { font-size: 12px; font-weight: 800; color: var(--ef-text); white-space: nowrap; }

/* ══ QUICK ACTIONS ══ */
.ud-actions-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
    gap: 10px; margin-bottom: 16px;
}

.ud-action-card {
    background: var(--ef-surface);
    border: 1px solid var(--ef-border);
    border-radius: 9px; padding: 16px;
    transition: border-color 0.2s, transform 0.15s;
}
.ud-action-card:hover { border-color: var(--ef-teal); transform: translateY(-2px); }

.ud-action-header { display: flex; align-items: center; gap: 10px; margin-bottom: 12px; }
.ud-action-icon {
    width: 34px; height: 34px; flex-shrink: 0;
    background: var(--ef-teal-bg); border: 1px solid var(--ef-teal);
    border-radius: 7px; display: flex; align-items: center; justify-content: center;
}
.ud-action-icon svg { width: 15px; height: 15px; stroke: var(--ef-mint); }
.ud-action-name { font-size: 13px; font-weight: 700; color: var(--ef-text); margin: 0 0 2px; }
.ud-action-desc { font-size: 11px; color: var(--ef-muted); margin: 0; }

.ud-action-btn {
    display: flex; align-items: center; justify-content: center; gap: 6px;
    width: 100%; padding: 8px;
    border-radius: 7px; font-size: 12px; font-weight: 700;
    text-decoration: none; transition: opacity 0.15s, border-color 0.15s, color 0.15s;
}
.ud-action-btn-primary  { background: var(--ef-teal); color: #fff; border: none; cursor: pointer; }
.ud-action-btn-primary:hover  { opacity: 0.85; }
.ud-action-btn-secondary { background: var(--ef-surface2); border: 1px solid var(--ef-border); color: var(--ef-text2); }
.ud-action-btn-secondary:hover { border-color: var(--ef-teal); color: var(--ef-mint); }
.ud-action-btn svg { width: 13px; height: 13px; }

/* ══ TABLE ══ */
.ud-table-wrap { overflow-x: auto; }
.ud-table { width: 100%; border-collapse: collapse; font-size: 13px; }
.ud-table thead tr { background: var(--ef-surface2); border-bottom: 1px solid var(--ef-border); }
.ud-table th { padding: 10px 14px; font-size: 10px; font-weight: 700; letter-spacing: 1px; text-transform: uppercase; color: var(--ef-muted); text-align: left; white-space: nowrap; }
.ud-table tbody tr { border-bottom: 1px solid var(--ef-border); transition: background 0.12s; }
.ud-table tbody tr:last-child { border-bottom: none; }
.ud-table tbody tr:hover { background: var(--ef-surface2); }
.ud-table td { padding: 11px 14px; vertical-align: middle; }

.ud-file-icon { width: 32px; height: 32px; background: var(--ef-teal-bg); border: 1px solid var(--ef-teal); border-radius: 6px; flex-shrink: 0; display: flex; align-items: center; justify-content: center; }
.ud-file-icon svg { width: 14px; height: 14px; stroke: var(--ef-mint); }
.ud-file-name { font-weight: 700; color: var(--ef-text); margin: 0 0 1px; }
.ud-file-size { font-size: 11px; color: var(--ef-muted); margin: 0; }

.ud-fw-badge { display: inline-block; font-size: 9px; font-weight: 800; padding: 2px 6px; border-radius: 20px; margin-top: 3px; }
.ud-badge-free     { background: var(--ef-teal-bg);  color: var(--ef-teal-text); }
.ud-badge-featured { background: var(--ef-amber-bg); color: var(--ef-amber-text); }
.ud-badge-paid     { background: var(--ef-blue-bg);  color: var(--ef-blue-text); }

.ud-ip-dot { width: 5px; height: 5px; border-radius: 50%; background: var(--ef-teal); display: inline-block; margin-right: 5px; }
.ud-table-link { color: var(--ef-teal); transition: color 0.15s; }
.ud-table-link:hover { color: var(--ef-mint); }

/* ══ EMPTY ══ */
.ud-empty { text-align: center; padding: 40px 20px; }
.ud-empty-icon { width: 52px; height: 52px; background: var(--ef-surface); border: 1px solid var(--ef-border); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 14px; }
.ud-empty-icon svg { width: 22px; height: 22px; stroke: var(--ef-muted); }
.ud-empty h3 { font-size: 15px; font-weight: 700; color: var(--ef-text); margin: 0 0 5px; }
.ud-empty p  { font-size: 13px; color: var(--ef-muted); margin: 0 0 16px; }
.ud-empty-btn { display: inline-flex; align-items: center; gap: 6px; padding: 9px 18px; background: var(--ef-teal); color: #fff; border-radius: 7px; font-size: 13px; font-weight: 700; text-decoration: none; transition: opacity 0.15s; }
.ud-empty-btn:hover { opacity: 0.85; }

/* ══ MODAL ══ */
.ud-modal-overlay { position: fixed; inset: 0; background: rgba(0,0,0,0.6); z-index: 50; display: flex; align-items: center; justify-content: center; padding: 16px; }
.ud-modal { background: var(--ef-surface); border: 1px solid var(--ef-border); border-radius: 10px; max-width: 380px; width: 100%; overflow: hidden; }
.ud-modal-header { padding: 16px 18px 0; display: flex; align-items: center; gap: 12px; }
.ud-modal-icon { width: 36px; height: 36px; border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
.ud-modal-icon.warn { background: #1a0505; border: 1px solid #4a1515; }
.ud-modal-icon.warn svg { stroke: #e05050; width: 16px; height: 16px; }
.ud-modal-title { font-size: 13px; font-weight: 700; color: var(--ef-text); margin: 0 0 3px; }
.ud-modal-text  { font-size: 12px; color: var(--ef-muted); margin: 0; }
.ud-modal-footer { padding: 12px 18px; background: var(--ef-surface2); border-top: 1px solid var(--ef-border); display: flex; justify-content: flex-end; gap: 8px; margin-top: 14px; }
.ud-modal-btn { padding: 7px 14px; border-radius: 6px; font-size: 12px; font-weight: 700; cursor: pointer; border: none; text-decoration: none; display: inline-flex; align-items: center; transition: opacity 0.15s; }
.ud-modal-btn-primary { background: var(--ef-teal); color: #fff; }
.ud-modal-btn-primary:hover { opacity: 0.85; }
</style>

<div class="ud-page">

    {{-- ══ HERO ══ --}}
    <div class="ud-hero">
        <div class="ud-hero-avatar">{{ strtoupper(substr($user->name, 0, 1)) }}</div>
        <div class="ud-hero-info">
            <h1 class="ud-hero-name">Welcome back, <span>{{ $user->name }}</span>!</h1>
            <p class="ud-hero-sub">Ready to download some firmware files?</p>
        </div>
        <div class="ud-hero-pills">
            <div class="ud-hero-pill">
                <div>
                    <p class="ud-hero-pill-label">Balance</p>
                    <p class="ud-hero-pill-val">{{ $user->currency->symbol ?? '$' }}{{ number_format($user->balance, 2) }}</p>
                    <p class="ud-hero-pill-sub">{{ $user->package->title ?? 'Free Plan' }}</p>
                </div>
            </div>
            <div class="ud-hero-pill">
                <div>
                    <p class="ud-hero-pill-label">Status</p>
                    <p class="ud-hero-pill-val" style="display:flex;align-items:center;gap:6px;">
                        <span class="ud-dot"></span> Active
                    </p>
                    <p class="ud-hero-pill-sub">Account OK</p>
                </div>
            </div>
        </div>
    </div>

    {{-- ══ STATS ══ --}}
    <div class="ud-stats-grid">

        <div class="ud-stat">
            <div>
                <p class="ud-stat-label">Package</p>
                <p class="ud-stat-value" style="font-size:16px;">{{ $user->package->title ?? 'Free' }}</p>
                <p class="ud-stat-sub"><span class="ud-dot"></span> Active</p>
            </div>
            <div class="ud-stat-icon">
                <svg fill="none" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
            </div>
        </div>

        @if($user->package)
        @php
            $bwUnit = $user->package->bandwidth_unit ?? 'MB';
            $bwRaw  = $user->bandwidth_used;
            $bwDisp = match($bwUnit) { 'GB' => $bwRaw/(1024**3), 'TB' => $bwRaw/(1024**4), default => $bwRaw/(1024**2) };
            $bwLimit = $user->package->bandwidth > 0 ? $user->package->bandwidth : 1;
            $bwPct   = min(round($bwRaw/(1024**3)/$bwLimit*100), 100);
        @endphp
        <div class="ud-stat" style="flex-direction:column;align-items:stretch;">
            <div style="display:flex;align-items:flex-start;justify-content:space-between;gap:10px;">
                <div>
                    <p class="ud-stat-label">Bandwidth</p>
                    <p class="ud-stat-value">{{ number_format($bwDisp,1) }}<span style="font-size:12px;font-weight:600;">{{ $bwUnit }}</span></p>
                </div>
                <div class="ud-stat-icon"><svg fill="none" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg></div>
            </div>
            <div class="ud-prog" style="margin-top:8px;"><div class="ud-prog-fill" style="width:{{ $bwPct }}%;"></div></div>
            <div class="ud-prog-labels"><span>{{ $bwPct }}%</span><span>{{ $user->package->total_bandwidth ?? '∞' }} {{ $bwUnit }}</span></div>
        </div>
        @endif

        <div class="ud-stat">
            <div>
                <p class="ud-stat-label">Downloads</p>
                <p class="ud-stat-value">{{ $downloadsThisMonth }}</p>
                <p class="ud-stat-sub">This month</p>
            </div>
            <div class="ud-stat-icon"><svg fill="none" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg></div>
        </div>

        @if($user->package)
        @php
            $filesUnit = $user->package->files_unit ?? 'Files';
            $filesTotal = $user->total_files_used;
            $filesDisp = match($filesUnit) { 'KFiles' => $filesTotal/1000, 'MFiles' => $filesTotal/1e6, default => $filesTotal };
            $filesLimit = $user->package->total_files > 0 ? $user->package->total_files : 1;
            $filesPct = min(round($filesTotal/$filesLimit*100), 100);
        @endphp
        <div class="ud-stat" style="flex-direction:column;align-items:stretch;">
            <div style="display:flex;align-items:flex-start;justify-content:space-between;gap:10px;">
                <div>
                    <p class="ud-stat-label">Total Files</p>
                    <p class="ud-stat-value">{{ number_format($filesDisp,0) }}<span style="font-size:11px;font-weight:600;">{{ $filesUnit }}</span></p>
                </div>
                <div class="ud-stat-icon"><svg fill="none" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 13h6m-3-3v6m5 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg></div>
            </div>
            <div class="ud-prog" style="margin-top:8px;"><div class="ud-prog-fill" style="width:{{ $filesPct }}%;"></div></div>
            <div class="ud-prog-labels"><span>{{ $filesPct }}%</span><span>{{ $user->package->total_files ?? '∞' }} limit</span></div>
        </div>

        @php
            $dailyDisp = match($filesUnit) { 'KFiles' => $user->daily_files_used/1000, 'MFiles' => $user->daily_files_used/1e6, default => $user->daily_files_used };
            $dailyLimit = $user->package->daily_files > 0 ? $user->package->daily_files : 1;
            $dailyPct = min(round($user->daily_files_used/$dailyLimit*100), 100);
        @endphp
        <div class="ud-stat" style="flex-direction:column;align-items:stretch;">
            <div style="display:flex;align-items:flex-start;justify-content:space-between;gap:10px;">
                <div>
                    <p class="ud-stat-label">Daily Files</p>
                    <p class="ud-stat-value">{{ number_format($dailyDisp,0) }}<span style="font-size:11px;font-weight:600;">{{ $filesUnit }}</span></p>
                </div>
                <div class="ud-stat-icon"><svg fill="none" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7v4a1 1 0 001 1h3m-3-3h.01M9 16h.01M12 16h.01M15 16h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg></div>
            </div>
            <div class="ud-prog" style="margin-top:8px;"><div class="ud-prog-fill" style="width:{{ $dailyPct }}%;"></div></div>
            <div class="ud-prog-labels"><span>{{ $dailyPct }}%</span><span>{{ $user->package->daily_files ?? '∞' }} limit</span></div>
        </div>
        @endif

        <div class="ud-stat">
            <div>
                <p class="ud-stat-label">Balance</p>
                <p class="ud-stat-value">{{ $user->currency->symbol ?? '$' }}{{ number_format($user->balance, 2) }}</p>
                <p class="ud-stat-sub"><a href="{{ route('funds.add.form') }}">Add Funds →</a></p>
            </div>
            <div class="ud-stat-icon"><svg fill="none" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/></svg></div>
        </div>

    </div>

    {{-- ══ ORDERS + ACTIONS ══ --}}
    <div class="ud-content-grid">

        {{-- Left: orders ++ actions ++ history --}}
        <div>

            {{-- Orders stats --}}
            <div class="ud-orders-grid">
                <div class="ud-stat">
                    <div>
                        <p class="ud-stat-label">Total Orders</p>
                        <p class="ud-stat-value">{{ $totalOrders }}</p>
                        <p class="ud-stat-sub"><a href="{{ route('store.order.tracking') }}">View All →</a></p>
                    </div>
                    <div class="ud-stat-icon"><i class="fas fa-shopping-bag"></i></div>
                </div>
                <div class="ud-stat">
                    <div>
                        <p class="ud-stat-label">Pending Orders</p>
                        <p class="ud-stat-value">{{ $pendingOrders }}</p>
                        <p class="ud-stat-sub"><a href="{{ route('store.order.tracking') }}?status=pending">View →</a></p>
                    </div>
                    <div class="ud-stat-icon"><i class="fas fa-clock"></i></div>
                </div>
            </div>

            {{-- Quick actions --}}
            <div class="ud-actions-grid">
                <div class="ud-action-card">
                    <div class="ud-action-header">
                        <div class="ud-action-icon"><svg fill="none" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg></div>
                        <div>
                            <p class="ud-action-name">Upgrade Package</p>
                            <p class="ud-action-desc">Get more bandwidth</p>
                        </div>
                    </div>
                    <a href="{{ route('packages.index') }}" class="ud-action-btn ud-action-btn-primary">
                        View Packages
                        <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                    </a>
                </div>
                <div class="ud-action-card">
                    <div class="ud-action-header">
                        <div class="ud-action-icon"><svg fill="none" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg></div>
                        <div>
                            <p class="ud-action-name">Browse Firmware</p>
                            <p class="ud-action-desc">Find files for your device</p>
                        </div>
                    </div>
                    <a href="/" class="ud-action-btn ud-action-btn-secondary">
                        Browse Files
                        <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                    </a>
                </div>
                <div class="ud-action-card">
                    <div class="ud-action-header">
                        <div class="ud-action-icon"><svg fill="none" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg></div>
                        <div>
                            <p class="ud-action-name">Account Settings</p>
                            <p class="ud-action-desc">Manage profile</p>
                        </div>
                    </div>
                    <a href="{{ route('profile.edit') }}" class="ud-action-btn ud-action-btn-secondary">
                        Manage
                        <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                    </a>
                </div>
            </div>

        </div>

        {{-- Right: recent orders list --}}
        <div class="ud-panel">
            <div class="ud-panel-head">
                <h3 class="ud-panel-title">Recent Orders</h3>
                <a href="{{ route('store.order.tracking') }}" class="ud-panel-action">All →</a>
            </div>
            <div class="ud-panel-body">
                @forelse($recentOrders as $order)
                    <div class="ud-order-item">
                        <div style="display:flex;align-items:center;gap:9px;min-width:0;">
                            <div class="ud-order-icon"><i class="fas fa-tag"></i></div>
                            <div style="min-width:0;">
                                <p class="ud-order-id">#{{ $order->order_id }}</p>
                                <p class="ud-order-date">{{ $order->created_at->format('M d, Y') }}</p>
                            </div>
                        </div>
                        <span class="ud-order-amount">{{ $user->currency->symbol ?? '$' }}{{ number_format($order->total_amount, 2) }}</span>
                    </div>
                @empty
                    <p style="font-size:12px;color:var(--ef-muted);margin:0;padding:8px 0;">No recent orders</p>
                @endforelse
            </div>
        </div>

    </div>

    {{-- ══ DOWNLOAD HISTORY ══ --}}
    <div class="ud-panel">
        <div class="ud-panel-head">
            <h3 class="ud-panel-title">Download History</h3>
            <div style="display:flex;gap:8px;">
                <button class="ud-panel-action" style="display:flex;align-items:center;gap:4px;">
                    <svg style="width:12px;height:12px;stroke:currentColor;" fill="none" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                    Export
                </button>
                <button class="ud-panel-action" style="display:flex;align-items:center;gap:4px;">
                    <svg style="width:12px;height:12px;stroke:currentColor;" fill="none" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/></svg>
                    Filter
                </button>
            </div>
        </div>

        @if($downloadLogs->isEmpty())
            <div class="ud-empty">
                <div class="ud-empty-icon"><svg fill="none" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg></div>
                <h3>No downloads yet</h3>
                <p>Start downloading firmware files to see your history here.</p>
                <a href="/" class="ud-empty-btn"><svg style="width:13px;height:13px;stroke:currentColor;" fill="none" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>Browse Firmware</a>
            </div>
        @else
            <div class="ud-table-wrap">
                <table class="ud-table">
                    <thead>
                        <tr>
                            <th>File Details</th>
                            <th class="hidden sm:table-cell">Bandwidth</th>
                            <th class="hidden md:table-cell">Location</th>
                            <th>Date</th>
                            <th style="width:42px;"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($downloadLogs as $log)
                        <tr>
                            <td>
                                <div style="display:flex;align-items:center;gap:10px;">
                                    <div class="ud-file-icon"><svg fill="none" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg></div>
                                    <div style="min-width:0;">
                                        <p class="ud-file-name" style="white-space:nowrap;overflow:hidden;text-overflow:ellipsis;max-width:200px;">{{ $log->firmware->name }}</p>
                                        <p class="ud-file-size">{{ $log->firmware->formatted_size ?? $log->firmware->size }}</p>
                                        <span class="ud-fw-badge {{ match($log->firmware->type) { 'free' => 'ud-badge-free', 'featured' => 'ud-badge-featured', 'paid' => 'ud-badge-paid', default => 'ud-badge-free' } }}">{{ ucfirst($log->firmware->type) }}</span>
                                    </div>
                                </div>
                            </td>
                            <td class="hidden sm:table-cell">
                                <div style="font-size:12px;font-weight:600;color:var(--ef-text);">{{ number_format($log->bandwidth_used/(1024**2),1) }} MB</div>
                                <div style="font-size:10px;color:var(--ef-muted);">Used</div>
                            </td>
                            <td class="hidden md:table-cell">
                                <div style="display:flex;align-items:center;"><span class="ud-ip-dot"></span><span style="font-size:12px;font-family:monospace;color:var(--ef-text2);">{{ $log->ip_address }}</span></div>
                            </td>
                            <td>
                                <div style="font-size:12px;font-weight:600;color:var(--ef-text);">{{ $log->created_at->format('M d, Y') }}</div>
                                <div style="font-size:10px;color:var(--ef-muted);">{{ $log->created_at->format('h:i A') }}</div>
                            </td>
                            <td>
                                <a href="{{ route('firmware.show', $log->firmware) }}" class="ud-table-link">
                                    <svg style="width:15px;height:15px;stroke:currentColor;" fill="none" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

</div>

{{-- Modals --}}
@if(session('show_login_modal'))
<div class="ud-modal-overlay">
    <div class="ud-modal">
        <div class="ud-modal-header">
            <div class="ud-modal-icon warn"><svg fill="none" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg></div>
            <div><p class="ud-modal-title">Please Log In</p><p class="ud-modal-text">You need to be logged in to download files.</p></div>
        </div>
        <div class="ud-modal-footer"><a href="{{ route('login') }}" class="ud-modal-btn ud-modal-btn-primary">Log In</a></div>
    </div>
</div>
@endif

@if(session('show_activate_package_modal'))
<div class="ud-modal-overlay">
    <div class="ud-modal">
        <div class="ud-modal-header">
            <div class="ud-modal-icon warn"><svg fill="none" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg></div>
            <div><p class="ud-modal-title">Activate a Package</p><p class="ud-modal-text">You need a paid package to download this file.</p></div>
        </div>
        <div class="ud-modal-footer"><a href="{{ route('packages.index') }}" class="ud-modal-btn ud-modal-btn-primary">View Packages</a></div>
    </div>
</div>
@endif

</x-app-layout>