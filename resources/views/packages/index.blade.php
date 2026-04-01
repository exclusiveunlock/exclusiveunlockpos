<x-app-layout>

<style>
/* ══════════════════════════════════════════
   PACKAGES — variables --ef-*
   ══════════════════════════════════════════ */
:root {
    --ef-teal      : #1aa87a;
    --ef-mint      : #3dd68c;
    --ef-blue      : #2563c8;
    --ef-bg        : #f4f4f4;
    --ef-surface   : #ffffff;
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

/* ── Page ── */
.pkg-page { min-height: 100vh; padding: 48px 0 64px; }
.pkg-wrap { max-width: 1100px; margin: 0 auto; padding: 0 20px; }

/* ══════════════════════════════════════════
   DISCOUNT BANNER CARD
   ══════════════════════════════════════════ */
.pkg-discount-banner {
    background: var(--ef-surface);
    border: 1px solid var(--ef-border);
    border-radius: 10px;
    margin-bottom: 32px;
    overflow: hidden;
    position: relative;
}

/* left teal accent bar */
.pkg-discount-banner::before {
    content: '';
    position: absolute; top: 0; left: 0; bottom: 0;
    width: 4px;
    background: var(--ef-teal);
}

.pkg-discount-inner {
    display: flex;
    align-items: center;
    flex-wrap: wrap;
    gap: 20px;
    padding: 20px 24px 20px 28px;
}

/* big % badge */
.pkg-discount-pct {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 64px; height: 64px;
    flex-shrink: 0;
    position: relative;
}

.pkg-discount-pct-circle {
    width: 64px; height: 64px;
    background: var(--ef-teal);
    border-radius: 50%;
    display: flex; flex-direction: column;
    align-items: center; justify-content: center;
    line-height: 1;
}

.pkg-discount-pct-num {
    font-size: 22px; font-weight: 900;
    color: #fff; letter-spacing: -1px; line-height: 1;
}

.pkg-discount-pct-label {
    font-size: 9px; font-weight: 800;
    color: rgba(255,255,255,0.85);
    letter-spacing: 1px; text-transform: uppercase;
    margin-top: 1px;
}

/* discount text */
.pkg-discount-text { flex: 1; min-width: 200px; }

.pkg-discount-title {
    font-size: 16px; font-weight: 800;
    color: var(--ef-text); margin: 0 0 4px; letter-spacing: -0.3px;
}

.pkg-discount-title span { color: var(--ef-mint); }

.pkg-discount-desc {
    font-size: 13px; color: var(--ef-muted); margin: 0 0 10px; line-height: 1.5;
}

/* countdown pills */
.pkg-discount-pills {
    display: flex; align-items: center; gap: 6px; flex-wrap: wrap;
}

.pkg-discount-pill {
    display: flex; align-items: center; gap: 5px;
    background: var(--ef-teal-bg);
    border: 1px solid var(--ef-teal);
    border-radius: 4px;
    padding: 3px 10px;
    font-size: 11px; font-weight: 700;
    color: var(--ef-teal-text);
}
html.dark .pkg-discount-pill { color: var(--ef-mint); }
.pkg-discount-pill svg { width: 12px; height: 12px; stroke: var(--ef-teal); }

.pkg-discount-pill-sep {
    font-size: 11px; color: var(--ef-border2); font-weight: 700;
}

/* timer */
.pkg-timer {
    display: flex; align-items: center; gap: 4px;
    flex-shrink: 0;
}

.pkg-timer-block {
    display: flex; flex-direction: column;
    align-items: center;
    background: var(--ef-bg);
    border: 1px solid var(--ef-border);
    border-radius: 6px;
    padding: 6px 10px;
    min-width: 44px;
}

.pkg-timer-num {
    font-size: 18px; font-weight: 800;
    color: var(--ef-text); line-height: 1;
    font-variant-numeric: tabular-nums;
}

.pkg-timer-label {
    font-size: 9px; font-weight: 700;
    letter-spacing: 0.5px; text-transform: uppercase;
    color: var(--ef-muted); margin-top: 2px;
}

.pkg-timer-sep {
    font-size: 20px; font-weight: 800;
    color: var(--ef-teal); line-height: 1;
    margin-bottom: 10px;
}

/* ── Header ── */
.pkg-header { text-align: center; margin-bottom: 32px; }
.pkg-header-icon {
    width: 44px; height: 44px;
    background: var(--ef-teal-bg); border: 1px solid var(--ef-teal);
    border-radius: 9px;
    display: flex; align-items: center; justify-content: center;
    margin: 0 auto 14px;
}
.pkg-header h1 { font-size: 24px; font-weight: 800; color: var(--ef-text); margin: 0 0 8px; letter-spacing: -0.4px; }
.pkg-header h1 span { color: var(--ef-mint); }
.pkg-header p { font-size: 13px; color: var(--ef-muted); max-width: 420px; margin: 0 auto; line-height: 1.7; }

/* ── Grid ── */
.pkg-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 16px; align-items: start; }

/* ── Card ── */
.pkg-card {
    background: var(--ef-surface);
    border: 1px solid var(--ef-border);
    border-radius: 10px; overflow: hidden;
    position: relative;
    transition: transform 0.2s, box-shadow 0.2s, border-color 0.2s;
}
.pkg-card:hover { transform: translateY(-4px); box-shadow: 0 14px 32px rgba(0,0,0,0.1); border-color: var(--ef-teal); }
html.dark .pkg-card:hover { box-shadow: 0 14px 32px rgba(0,0,0,0.45); }
.pkg-card.featured { border-color: var(--ef-teal); }

/* discount sticker on card */
.pkg-card-discount-sticker {
    position: absolute; top: 10px; left: 10px;
    background: var(--ef-teal);
    color: #fff;
    font-size: 9px; font-weight: 900;
    letter-spacing: 0.5px; text-transform: uppercase;
    padding: 3px 8px;
    border-radius: 4px;
    display: flex; align-items: center; gap: 4px;
    z-index: 5;
}

.pkg-card-discount-sticker::before {
    content: '';
    display: inline-block;
    width: 0; height: 0;
    border-top: 4px solid transparent;
    border-bottom: 4px solid transparent;
    border-right: 6px solid rgba(255,255,255,0.4);
}

.pkg-popular-badge {
    position: absolute; top: 0; right: 0;
    background: var(--ef-teal); color: #fff;
    font-size: 9px; font-weight: 800;
    letter-spacing: 1.2px; text-transform: uppercase;
    padding: 4px 12px; border-radius: 0 10px 0 8px;
    z-index: 5;
}

.pkg-card-header { padding: 20px 20px 12px; border-bottom: 1px solid var(--ef-border); }
.pkg-card-icon {
    width: 34px; height: 34px;
    background: var(--ef-teal-bg); border: 1px solid var(--ef-teal);
    border-radius: 7px;
    display: flex; align-items: center; justify-content: center; margin-bottom: 10px;
}
.pkg-card-icon svg { width: 15px; height: 15px; stroke: var(--ef-mint); }
.pkg-card-name     { font-size: 15px; font-weight: 800; color: var(--ef-text); margin: 0 0 2px; }
.pkg-card-duration { font-size: 11px; color: var(--ef-muted); }

/* ── Price with strikethrough ── */
.pkg-price-block { padding: 12px 20px; border-bottom: 1px solid var(--ef-border); }

.pkg-price-row { display: flex; align-items: baseline; gap: 8px; }
.pkg-price { font-size: 28px; font-weight: 800; color: var(--ef-text); line-height: 1; }
.pkg-price-original {
    font-size: 16px; font-weight: 600;
    color: var(--ef-muted);
    text-decoration: line-through;
}
.pkg-price-sub { font-size: 11px; color: var(--ef-muted); margin-top: 3px; }

.pkg-best-value {
    display: inline-block; margin-top: 6px;
    font-size: 9px; font-weight: 800;
    background: var(--ef-teal-bg); color: var(--ef-teal-text);
    border: 1px solid var(--ef-teal);
    padding: 2px 8px; border-radius: 3px;
    letter-spacing: 1px; text-transform: uppercase;
}

/* ── Features ── */
.pkg-features { padding: 12px 20px; list-style: none; margin: 0; display: flex; flex-direction: column; gap: 9px; }
.pkg-feature { display: flex; align-items: flex-start; gap: 8px; font-size: 12px; color: var(--ef-muted); line-height: 1.4; }
.pkg-feature strong { color: var(--ef-text2); font-weight: 600; }
.pkg-feature-check {
    width: 14px; height: 14px; border-radius: 50%;
    background: var(--ef-teal-bg); border: 1px solid var(--ef-teal);
    display: flex; align-items: center; justify-content: center;
    flex-shrink: 0; margin-top: 1px;
}
.pkg-feature-check svg { width: 8px; height: 8px; stroke: var(--ef-mint); }

/* ── CTA ── */
.pkg-cta { padding: 12px 20px 20px; }
.pkg-btn { display: block; width: 100%; padding: 10px; border-radius: 7px; font-size: 13px; font-weight: 700; text-align: center; cursor: pointer; border: none; transition: background 0.15s, color 0.15s, transform 0.15s; text-decoration: none; }
.pkg-btn-primary  { background: var(--ef-teal); color: #fff; }
.pkg-btn-primary:hover  { background: #158f68; transform: translateY(-1px); }
.pkg-btn-secondary { background: var(--ef-bg); color: var(--ef-muted); border: 1px solid var(--ef-border); }
.pkg-btn-secondary:hover { background: var(--ef-border); color: var(--ef-text); transform: translateY(-1px); }
.pkg-btn-active { background: var(--ef-teal-bg); color: var(--ef-teal-text); border: 1px solid var(--ef-teal); cursor: default; }

/* ── Modals ── */
.pkg-modal-overlay { position: fixed; inset: 0; background: rgba(0,0,0,0.55); z-index: 50; display: flex; align-items: center; justify-content: center; padding: 16px; }
.pkg-modal { background: var(--ef-surface); border: 1px solid var(--ef-border); border-radius: 10px; max-width: 380px; width: 100%; overflow: hidden; }
.pkg-modal-header { padding: 18px 20px 0; display: flex; align-items: center; gap: 12px; }
.pkg-modal-icon { width: 36px; height: 36px; border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
.pkg-modal-icon.danger  { background: #1a0505; border: 1px solid #4a1515; }
.pkg-modal-icon.success { background: var(--ef-teal-bg); border: 1px solid var(--ef-teal); }
.pkg-modal-icon.danger  svg { stroke: #e05050; width: 16px; height: 16px; }
.pkg-modal-icon.success svg { stroke: var(--ef-mint); width: 16px; height: 16px; }
.pkg-modal-title { font-size: 13px; font-weight: 700; color: var(--ef-text); margin: 0 0 3px; }
.pkg-modal-text  { font-size: 12px; color: var(--ef-muted); margin: 0; }
.pkg-modal-footer { padding: 12px 20px; background: var(--ef-bg); border-top: 1px solid var(--ef-border); display: flex; justify-content: flex-end; gap: 8px; margin-top: 14px; }
.pkg-modal-btn { padding: 7px 14px; border-radius: 6px; font-size: 12px; font-weight: 700; cursor: pointer; border: none; text-decoration: none; display: inline-flex; align-items: center; transition: background 0.15s; }
.pkg-modal-btn-primary  { background: var(--ef-teal); color: #fff; }
.pkg-modal-btn-primary:hover  { background: #158f68; }
.pkg-modal-btn-secondary { background: var(--ef-surface); color: var(--ef-muted); border: 1px solid var(--ef-border2); }
.pkg-modal-btn-secondary:hover { color: var(--ef-text); }
</style>

<div class="pkg-page">
<div class="pkg-wrap">

    {{-- ══════════════════════════════════════════
         DISCOUNT BANNER
         ══════════════════════════════════════════ --}}
    <div class="pkg-discount-banner">
        <div class="pkg-discount-inner">

            {{-- % circle --}}
            <div class="pkg-discount-pct">
                <div class="pkg-discount-pct-circle">
                    <span class="pkg-discount-pct-num">50%</span>
                    <span class="pkg-discount-pct-label">OFF</span>
                </div>
            </div>

            {{-- text + pills --}}
            <div class="pkg-discount-text">
                <p class="pkg-discount-title">Limited Time Offer — <span>50% off all plans</span></p>
                <p class="pkg-discount-desc">Upgrade today and get half off your first payment. Offer expires when the timer runs out.</p>
                <div class="pkg-discount-pills">
                    <span class="pkg-discount-pill">
                        <svg fill="none" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        Limited time
                    </span>
                    <span class="pkg-discount-pill-sep">·</span>
                    <span class="pkg-discount-pill">
                        <svg fill="none" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                        All plans included
                    </span>
                    <span class="pkg-discount-pill-sep">·</span>
                    <span class="pkg-discount-pill">
                        <svg fill="none" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                        Instant activation
                    </span>
                </div>
            </div>

            {{-- Countdown timer --}}
            <div class="pkg-timer">
                <div class="pkg-timer-block">
                    <span class="pkg-timer-num" id="t-days">07</span>
                    <span class="pkg-timer-label">Days</span>
                </div>
                <span class="pkg-timer-sep">:</span>
                <div class="pkg-timer-block">
                    <span class="pkg-timer-num" id="t-hours">00</span>
                    <span class="pkg-timer-label">Hours</span>
                </div>
                <span class="pkg-timer-sep">:</span>
                <div class="pkg-timer-block">
                    <span class="pkg-timer-num" id="t-min">00</span>
                    <span class="pkg-timer-label">Min</span>
                </div>
                <span class="pkg-timer-sep">:</span>
                <div class="pkg-timer-block">
                    <span class="pkg-timer-num" id="t-sec">00</span>
                    <span class="pkg-timer-label">Sec</span>
                </div>
            </div>

        </div>
    </div>

    {{-- ── Header ── --}}
    <div class="pkg-header">
        <div class="pkg-header-icon">
            <svg fill="none" stroke="var(--ef-mint)" stroke-width="2" viewBox="0 0 24 24" style="width:20px;height:20px;">
                <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
            </svg>
        </div>
        <h1>Choose Your <span>Perfect Plan</span></h1>
        <p>Unlock premium features and unlimited downloads with flexible pricing plans.</p>
    </div>

    {{-- ── Cards ── --}}
    <div class="pkg-grid">
        @foreach ($packages as $index => $package)
        <div class="pkg-card {{ $index === 1 ? 'featured' : '' }}">

            {{-- Discount sticker --}}
            @if($package->package_type !== 'free')
                <div class="pkg-card-discount-sticker">50% OFF</div>
            @endif

            @if($index === 1)
                <div class="pkg-popular-badge">Most Popular</div>
            @endif

            <div class="pkg-card-header" style="{{ $package->package_type !== 'free' ? 'padding-top:36px;' : '' }}">
                <div class="pkg-card-icon">
                    <svg fill="none" stroke-width="2" viewBox="0 0 24 24">
                        @if($index === 0)
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        @elseif($index === 1)
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/>
                        @else
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                        @endif
                    </svg>
                </div>
                <div class="pkg-card-name">{{ $package->title }}</div>
                <div class="pkg-card-duration">{{ $package->duration_in_months }} month{{ $package->duration_in_months > 1 ? 's' : '' }} access</div>
            </div>

            <div class="pkg-price-block">
                @if($package->package_type === 'free')
                    <div class="pkg-price">Free</div>
                    <div class="pkg-price-sub">No payment required</div>
                @else
                    <div class="pkg-price-row">
                        <div class="pkg-price">${{ number_format($package->price * 0.5, 0) }}</div>
                        <div class="pkg-price-original">${{ number_format($package->price, 0) }}</div>
                    </div>
                    <div class="pkg-price-sub">for {{ $package->duration_in_months }} month{{ $package->duration_in_months > 1 ? 's' : '' }} · 50% discount applied</div>
                @endif
                @if($index === 1)<span class="pkg-best-value">Best Value</span>@endif
            </div>

            <ul class="pkg-features">
                @if($package->total_bandwidth > 0)
                <li class="pkg-feature">
                    <span class="pkg-feature-check"><svg fill="none" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg></span>
                    <span>Bandwidth: <strong>{{ $package->total_bandwidth }} {{ $package->bandwidth_unit }}</strong></span>
                </li>
                @endif
                @if($package->daily_bandwidth > 0)
                <li class="pkg-feature">
                    <span class="pkg-feature-check"><svg fill="none" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg></span>
                    <span>Daily bandwidth: <strong>{{ $package->daily_bandwidth }} {{ $package->bandwidth_unit }}</strong></span>
                </li>
                @endif
                @if($package->total_files > 0)
                <li class="pkg-feature">
                    <span class="pkg-feature-check"><svg fill="none" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg></span>
                    <span>Files: <strong>{{ $package->total_files }} {{ $package->files_unit }}</strong></span>
                </li>
                @endif
                @if($package->daily_files > 0)
                <li class="pkg-feature">
                    <span class="pkg-feature-check"><svg fill="none" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg></span>
                    <span>Daily files: <strong>{{ $package->daily_files }} {{ $package->files_unit }}</strong></span>
                </li>
                @endif
                <li class="pkg-feature">
                    <span class="pkg-feature-check"><svg fill="none" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg></span>
                    <span>Password files: <strong>{{ $package->can_access_password_files ? 'Yes' : 'No' }}</strong></span>
                </li>
                <li class="pkg-feature">
                    <span class="pkg-feature-check"><svg fill="none" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg></span>
                    <span>Devices: <strong>{{ $package->device_limit == 0 ? 'Unlimited' : $package->device_limit }}</strong></span>
                </li>
            </ul>

            <div class="pkg-cta">
                @auth
                    @if(Auth::user()->package_id === $package->id)
                        <span class="pkg-btn pkg-btn-active">✓ Current Plan</span>
                    @else
                        <form action="{{ route('packages.activate', $package) }}" method="POST">
                            @csrf
                            <button type="submit" class="pkg-btn {{ $index === 1 ? 'pkg-btn-primary' : 'pkg-btn-secondary' }}">
                                {{ $index === 1 ? 'Get Started — 50% Off' : 'Choose ' . $package->title }}
                            </button>
                        </form>
                    @endif
                @else
                    <a href="{{ route('login') }}" class="pkg-btn pkg-btn-secondary">Login to Choose</a>
                @endauth
            </div>

        </div>
        @endforeach
    </div>

</div>
</div>

{{-- Insufficient Fund Modal --}}
<div id="insufficient-fund-modal" class="pkg-modal-overlay" style="display:none;">
    <div class="pkg-modal">
        <div class="pkg-modal-header">
            <div class="pkg-modal-icon danger">
                <svg fill="none" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
            </div>
            <div>
                <p class="pkg-modal-title">Insufficient Funds</p>
                <p class="pkg-modal-text">You don't have enough balance to activate this package.</p>
            </div>
        </div>
        <div class="pkg-modal-footer">
            <button class="pkg-modal-btn pkg-modal-btn-secondary" onclick="document.getElementById('insufficient-fund-modal').style.display='none'">Cancel</button>
            <a href="{{ route('funds.add.form') }}" class="pkg-modal-btn pkg-modal-btn-primary">Add Funds</a>
        </div>
    </div>
</div>

{{-- Package Activated Modal --}}
<div id="package-activated-modal" class="pkg-modal-overlay" style="display:none;">
    <div class="pkg-modal">
        <div class="pkg-modal-header">
            <div class="pkg-modal-icon success">
                <svg fill="none" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <div>
                <p class="pkg-modal-title">Package Activated!</p>
                <p class="pkg-modal-text">Your package has been activated successfully.</p>
            </div>
        </div>
        <div class="pkg-modal-footer">
            <button class="pkg-modal-btn pkg-modal-btn-primary" onclick="document.getElementById('package-activated-modal').style.display='none'">Close</button>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    @if(session('show_fund_modal'))
        document.getElementById('insufficient-fund-modal').style.display = 'flex';
    @endif
    @if(session('show_success_modal'))
        document.getElementById('package-activated-modal').style.display = 'flex';
    @endif

    /* ── Countdown timer ── */
    // Set end time: 24h from first visit, persisted in localStorage
    const key = 'ef_discount_end';
    let end = localStorage.getItem(key);
    if (!end) {
        end = Date.now() + 7 * 24 * 60 * 60 * 1000;
        localStorage.setItem(key, end);
    }
    end = parseInt(end);

    function pad(n) { return String(n).padStart(2, '0'); }

    function tick() {
        const diff = end - Date.now();
        if (diff <= 0) {
            document.getElementById('t-days').textContent  = '00';
            document.getElementById('t-hours').textContent = '00';
            document.getElementById('t-min').textContent   = '00';
            document.getElementById('t-sec').textContent   = '00';
            return;
        }
        const d = Math.floor(diff / 86400000);
        const h = Math.floor((diff % 86400000) / 3600000);
        const m = Math.floor((diff % 3600000) / 60000);
        const s = Math.floor((diff % 60000) / 1000);
        document.getElementById('t-days').textContent  = pad(d);
        document.getElementById('t-hours').textContent = pad(h);
        document.getElementById('t-min').textContent   = pad(m);
        document.getElementById('t-sec').textContent   = pad(s);
        setTimeout(tick, 1000);
    }
    tick();
});
</script>
@endpush

</x-app-layout>