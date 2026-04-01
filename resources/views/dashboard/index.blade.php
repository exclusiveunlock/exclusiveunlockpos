<x-app-layout>

<style>
/* ══════════════════════════════════════════
   DASHBOARD — usa variables --ef-*
   ══════════════════════════════════════════ */

/* ── Top header bar ── */
.dash-header {
    background: var(--ef-surface);
    border-bottom: 1px solid var(--ef-border);
    padding: 20px 0;
}

.dash-header-inner {
    max-width: 1280px;
    margin: 0 auto;
    padding: 0 16px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 16px;
}

.dash-welcome h1 {
    font-size: 20px;
    font-weight: 800;
    color: var(--ef-text);
    margin: 0 0 4px;
    letter-spacing: -0.3px;
}

.dash-welcome h1 span { color: var(--ef-mint); }

.dash-welcome p {
    font-size: 13px;
    color: var(--ef-muted);
    margin: 0;
}

.dash-header-actions {
    display: flex; align-items: center; gap: 8px;
}

.dash-btn-primary {
    display: inline-flex; align-items: center; gap: 7px;
    padding: 9px 16px;
    background: var(--ef-teal); color: #fff;
    border: none; border-radius: 7px;
    font-size: 13px; font-weight: 700;
    cursor: pointer; text-decoration: none;
    transition: opacity 0.15s;
}
.dash-btn-primary:hover { opacity: 0.85; }
.dash-btn-primary svg { width: 15px; height: 15px; }

.dash-btn-secondary {
    display: inline-flex; align-items: center; gap: 7px;
    padding: 8px 14px;
    background: var(--ef-surface2);
    border: 1px solid var(--ef-border);
    color: var(--ef-text2); border-radius: 7px;
    font-size: 13px; font-weight: 600;
    cursor: pointer; text-decoration: none;
    transition: border-color 0.15s, color 0.15s;
}
.dash-btn-secondary:hover { border-color: var(--ef-teal); color: var(--ef-mint); }
.dash-btn-secondary svg { width: 15px; height: 15px; }

/* ── Page wrapper ── */
.dash-page {
    max-width: 1280px;
    margin: 0 auto;
    padding: 28px 16px 64px;
}

/* ── Stat cards ── */
.dash-stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
    gap: 14px;
    margin-bottom: 28px;
}

.dash-stat-card {
    background: var(--ef-surface);
    border: 1px solid var(--ef-border);
    border-radius: 10px;
    padding: 18px;
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    gap: 12px;
    transition: border-color 0.2s, transform 0.2s;
}

.dash-stat-card:hover { border-color: var(--ef-teal); transform: translateY(-2px); }

.dash-stat-label {
    font-size: 11px;
    font-weight: 700;
    letter-spacing: 0.5px;
    text-transform: uppercase;
    color: var(--ef-muted);
    margin: 0 0 6px;
}

.dash-stat-value {
    font-size: 26px;
    font-weight: 800;
    color: var(--ef-text);
    line-height: 1;
    margin: 0 0 6px;
}

.dash-stat-sub {
    font-size: 11px;
    font-weight: 600;
    display: flex; align-items: center; gap: 4px;
    color: var(--ef-teal-text);
}
html.dark .dash-stat-sub { color: var(--ef-mint); }
.dash-stat-sub svg { width: 12px; height: 12px; }

.dash-stat-sub.muted { color: var(--ef-muted); }
.dash-stat-sub.blue  { color: var(--ef-blue-text); }
html.dark .dash-stat-sub.blue { color: var(--ef-blue-text); }

.dash-stat-icon {
    width: 40px; height: 40px;
    background: var(--ef-teal-bg);
    border: 1px solid var(--ef-teal);
    border-radius: 9px;
    display: flex; align-items: center; justify-content: center;
    flex-shrink: 0;
}
.dash-stat-icon svg { width: 18px; height: 18px; stroke: var(--ef-mint); }

/* Progress bar */
.dash-progress-wrap { margin: 10px 0 4px; }

.dash-progress-bar {
    width: 100%;
    height: 4px;
    background: var(--ef-border2);
    border-radius: 2px;
    overflow: hidden;
}

.dash-progress-fill {
    height: 100%;
    background: var(--ef-teal);
    border-radius: 2px;
    transition: width 0.6s ease;
}

.dash-progress-label {
    font-size: 11px;
    color: var(--ef-muted);
    margin-top: 4px;
}

/* Status dot */
.dash-status-dot {
    width: 8px; height: 8px;
    border-radius: 50%;
    background: var(--ef-teal);
    display: inline-block;
    box-shadow: 0 0 0 2px rgba(26,168,122,0.25);
}

/* ── Main grid ── */
.dash-main-grid {
    display: grid;
    grid-template-columns: 1fr 320px;
    gap: 20px;
    align-items: start;
}

@media (max-width: 1024px) {
    .dash-main-grid { grid-template-columns: 1fr; }
}

/* ── Panel (shared card shell) ── */
.dash-panel {
    background: var(--ef-surface);
    border: 1px solid var(--ef-border);
    border-radius: 10px;
    overflow: hidden;
    margin-bottom: 16px;
}

.dash-panel-head {
    display: flex; align-items: center; justify-content: space-between;
    padding: 16px 20px;
    border-bottom: 1px solid var(--ef-border);
}

.dash-panel-title {
    font-size: 13px; font-weight: 800;
    letter-spacing: 1.5px; text-transform: uppercase;
    color: var(--ef-mint); margin: 0;
    display: flex; align-items: center; gap: 7px;
}
.dash-panel-title::before {
    content: '';
    display: inline-block;
    width: 3px; height: 13px;
    background: var(--ef-teal); border-radius: 2px;
}

.dash-panel-action {
    font-size: 12px; font-weight: 700;
    color: var(--ef-teal); text-decoration: none;
    transition: color 0.15s;
    background: none; border: none; cursor: pointer;
}
.dash-panel-action:hover { color: var(--ef-mint); }

.dash-panel-body { padding: 16px 20px; }

/* ── Activity items ── */
.dash-activity-item {
    display: flex; align-items: flex-start; gap: 12px;
    padding: 12px;
    border-radius: 8px;
    margin-bottom: 8px;
    background: var(--ef-bg);
    border: 1px solid var(--ef-border);
    transition: border-color 0.15s;
}
.dash-activity-item:last-child { margin-bottom: 0; }
.dash-activity-item:hover { border-color: var(--ef-teal); }

.dash-activity-icon {
    width: 36px; height: 36px;
    border-radius: 50%;
    background: var(--ef-teal-bg);
    border: 1px solid var(--ef-teal);
    display: flex; align-items: center; justify-content: center;
    flex-shrink: 0;
}
.dash-activity-icon svg { width: 16px; height: 16px; stroke: var(--ef-mint); }

.dash-activity-name {
    font-size: 13px; font-weight: 600;
    color: var(--ef-text); margin: 0 0 3px;
}

.dash-activity-meta {
    font-size: 11px; color: var(--ef-muted); margin: 0;
}

/* Activity status badges */
.dash-act-badge {
    display: inline-block;
    font-size: 10px; font-weight: 700;
    padding: 3px 9px; border-radius: 20px;
    white-space: nowrap; flex-shrink: 0;
}
.dash-act-badge-green  { background: var(--ef-teal-bg);  color: var(--ef-teal-text); }
.dash-act-badge-blue   { background: var(--ef-blue-bg);  color: var(--ef-blue-text); }
html.dark .dash-act-badge-green { color: var(--ef-mint); }

/* ── Quick action links ── */
.dash-quick-link {
    display: flex; align-items: center; gap: 10px;
    padding: 10px 12px;
    background: var(--ef-bg);
    border: 1px solid var(--ef-border);
    border-radius: 7px;
    font-size: 13px; font-weight: 600;
    color: var(--ef-text2);
    text-decoration: none;
    cursor: pointer;
    width: 100%; text-align: left;
    transition: border-color 0.15s, color 0.15s, background 0.15s;
    margin-bottom: 8px;
}
.dash-quick-link:last-child { margin-bottom: 0; }
.dash-quick-link:hover { border-color: var(--ef-teal); color: var(--ef-mint); }
.dash-quick-link svg { width: 15px; height: 15px; stroke: var(--ef-teal); flex-shrink: 0; }

/* ── Popular items ── */
.dash-popular-item {
    display: flex; align-items: center; gap: 12px;
    padding: 8px;
    border-radius: 7px;
    margin-bottom: 6px;
    transition: background 0.12s;
}
.dash-popular-item:last-child { margin-bottom: 0; }
.dash-popular-item:hover { background: var(--ef-surface2); }

.dash-popular-rank {
    width: 28px; height: 28px;
    background: var(--ef-teal-bg);
    border: 1px solid var(--ef-teal);
    border-radius: 6px;
    display: flex; align-items: center; justify-content: center;
    font-size: 11px; font-weight: 800;
    color: var(--ef-teal-text);
    flex-shrink: 0;
}
html.dark .dash-popular-rank { color: var(--ef-mint); }

.dash-popular-name {
    font-size: 13px; font-weight: 600;
    color: var(--ef-text); margin: 0 0 2px;
    white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
}

.dash-popular-count {
    font-size: 11px; color: var(--ef-muted);
}
</style>

{{-- ── Dashboard header ── --}}
<div class="dash-header">
    <div class="dash-header-inner">
        <div class="dash-welcome">
            <h1>Welcome back, <span>{{ auth()->user()->name }}</span></h1>
            <p>Here's what's happening with your firmware downloads today.</p>
        </div>
        <div class="dash-header-actions">
            <button class="dash-btn-primary">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                </svg>
                Upload Firmware
            </button>
            <button class="dash-btn-secondary">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                </svg>
                Analytics
            </button>
        </div>
    </div>
</div>

<div class="dash-page">

    {{-- ── Stat cards ── --}}
    <div class="dash-stats-grid">

        {{-- Downloads --}}
        <div class="dash-stat-card">
            <div>
                <p class="dash-stat-label">Total Downloads</p>
                <p class="dash-stat-value" id="stat-downloads">{{ number_format(auth()->user()->downloads_count ?? 0) }}</p>
                <p class="dash-stat-sub">
                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                    </svg>
                    +12% from last month
                </p>
            </div>
            <div class="dash-stat-icon">
                <svg fill="none" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10"/>
                </svg>
            </div>
        </div>

        {{-- Active files --}}
        <div class="dash-stat-card">
            <div>
                <p class="dash-stat-label">Active Files</p>
                <p class="dash-stat-value">{{ number_format(auth()->user()->files_count ?? 0) }}</p>
                <p class="dash-stat-sub blue">
                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    All verified
                </p>
            </div>
            <div class="dash-stat-icon">
                <svg fill="none" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
            </div>
        </div>

        {{-- Storage --}}
        <div class="dash-stat-card">
            <div style="flex:1;">
                <p class="dash-stat-label">Storage Used</p>
                <p class="dash-stat-value">2.4 GB</p>
                <div class="dash-progress-wrap">
                    <div class="dash-progress-bar">
                        <div class="dash-progress-fill" style="width:65%;"></div>
                    </div>
                    <p class="dash-progress-label">65% of 5 GB used</p>
                </div>
            </div>
            <div class="dash-stat-icon">
                <svg fill="none" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4"/>
                </svg>
            </div>
        </div>

        {{-- Account status --}}
        <div class="dash-stat-card">
            <div>
                <p class="dash-stat-label">Account Status</p>
                <p class="dash-stat-value" style="font-size:18px;margin-bottom:8px;">
                    {{ auth()->user()->package?->title ?? 'Free' }}
                </p>
                <p class="dash-stat-sub">
                    <span class="dash-status-dot"></span>
                    Active
                </p>
            </div>
            <div class="dash-stat-icon">
                <svg fill="none" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/>
                </svg>
            </div>
        </div>

    </div>

    {{-- ── Main grid ── --}}
    <div class="dash-main-grid">

        {{-- ── Recent Activity ── --}}
        <div>
            <div class="dash-panel">
                <div class="dash-panel-head">
                    <h3 class="dash-panel-title">Recent Activity</h3>
                    <button class="dash-panel-action">View All</button>
                </div>
                <div class="dash-panel-body">

                    <div class="dash-activity-item">
                        <div class="dash-activity-icon">
                            <svg fill="none" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10"/>
                            </svg>
                        </div>
                        <div style="flex:1;min-width:0;">
                            <p class="dash-activity-name">Downloaded Samsung Galaxy S24 Firmware</p>
                            <p class="dash-activity-meta">Version 14.0.1 · 2.4 GB · 2 minutes ago</p>
                        </div>
                        <span class="dash-act-badge dash-act-badge-green">Completed</span>
                    </div>

                    <div class="dash-activity-item">
                        <div class="dash-activity-icon">
                            <svg fill="none" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                        </div>
                        <div style="flex:1;min-width:0;">
                            <p class="dash-activity-name">Uploaded iPhone 15 Pro Firmware</p>
                            <p class="dash-activity-meta">iOS 17.2 · 3.1 GB · 1 hour ago</p>
                        </div>
                        <span class="dash-act-badge dash-act-badge-blue">Verified</span>
                    </div>

                    <div class="dash-activity-item">
                        <div class="dash-activity-icon">
                            <svg fill="none" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                            </svg>
                        </div>
                        <div style="flex:1;min-width:0;">
                            <p class="dash-activity-name">Security scan completed</p>
                            <p class="dash-activity-meta">All files verified · No threats detected · 3 hours ago</p>
                        </div>
                        <span class="dash-act-badge dash-act-badge-green">Secure</span>
                    </div>

                </div>
            </div>
        </div>

        {{-- ── Sidebar ── --}}
        <div>

            {{-- Quick Actions --}}
            <div class="dash-panel">
                <div class="dash-panel-head">
                    <h3 class="dash-panel-title">Quick Actions</h3>
                </div>
                <div class="dash-panel-body">
                    <button class="dash-quick-link">
                        <svg fill="none" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10"/></svg>
                        Browse Firmware
                    </button>
                    <button class="dash-quick-link">
                        <svg fill="none" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
                        Upload File
                    </button>
                    <button class="dash-quick-link">
                        <svg fill="none" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                        View Analytics
                    </button>
                    <button class="dash-quick-link">
                        <svg fill="none" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        Settings
                    </button>
                </div>
            </div>

            {{-- Popular This Week --}}
            <div class="dash-panel">
                <div class="dash-panel-head">
                    <h3 class="dash-panel-title">Popular This Week</h3>
                </div>
                <div class="dash-panel-body">
                    <div class="dash-popular-item">
                        <div class="dash-popular-rank">1</div>
                        <div style="flex:1;min-width:0;">
                            <p class="dash-popular-name">Samsung Galaxy S24</p>
                            <p class="dash-popular-count">2.4k downloads</p>
                        </div>
                    </div>
                    <div class="dash-popular-item">
                        <div class="dash-popular-rank">2</div>
                        <div style="flex:1;min-width:0;">
                            <p class="dash-popular-name">iPhone 15 Pro</p>
                            <p class="dash-popular-count">1.8k downloads</p>
                        </div>
                    </div>
                    <div class="dash-popular-item">
                        <div class="dash-popular-rank">3</div>
                        <div style="flex:1;min-width:0;">
                            <p class="dash-popular-name">Pixel 8 Pro</p>
                            <p class="dash-popular-count">1.2k downloads</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
// Animate stat numbers on load
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('[id^="stat-"]').forEach(el => {
        const raw = el.textContent.replace(/,/g, '');
        const final = parseInt(raw) || 0;
        if (!final) return;
        let cur = 0;
        const step = final / 40;
        const t = setInterval(() => {
            cur = Math.min(cur + step, final);
            el.textContent = Math.floor(cur).toLocaleString();
            if (cur >= final) clearInterval(t);
        }, 25);
    });
});
</script>

</x-app-layout>