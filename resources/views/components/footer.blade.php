<footer class="ef-footer">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">

            {{-- ── Company Info ── --}}
            <div class="lg:col-span-2">
                <div style="display:flex;align-items:center;gap:12px;margin-bottom:14px;">
                    @if(isset(app('settings')['site_logo']) && app('settings')['site_logo'])
                        <a href="{{ route('home') }}">
                            <img src="{{ asset(app('settings')['site_logo']) }}"
                                 alt="{{ app('settings')['site_name'] ?? config('app.name') }} Logo"
                                 style="height:36px;">
                        </a>
                    @else
                        <div class="ef-brand-icon">
                            <svg fill="none" stroke="#3dd68c" stroke-width="2" viewBox="0 0 24 24" style="width:18px;height:18px;">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <a href="{{ route('home') }}" class="ef-brand-name">
                            {{ app('settings')['site_name'] ?? config('app.name') }}
                        </a>
                    @endif
                </div>

                <p class="ef-footer-desc">
                    {{ app('settings')['footer_text'] ?? 'Professional GSM firmware solutions trusted by technicians and developers worldwide. Access the latest firmware updates with enterprise-grade security.' }}
                </p>

                <div style="display:flex;gap:8px;flex-wrap:wrap;">
                    @if(isset(app('settings')['facebook_url']))
                        <a href="{{ app('settings')['facebook_url'] }}" target="_blank" class="ef-social"><i class="fab fa-facebook-f"></i></a>
                    @endif
                    @if(isset(app('settings')['twitter_url']))
                        <a href="{{ app('settings')['twitter_url'] }}" target="_blank" class="ef-social"><i class="fab fa-twitter"></i></a>
                    @endif
                    @if(isset(app('settings')['instagram_url']))
                        <a href="{{ app('settings')['instagram_url'] }}" target="_blank" class="ef-social"><i class="fab fa-instagram"></i></a>
                    @endif
                    @if(isset(app('settings')['youtube_url']))
                        <a href="{{ app('settings')['youtube_url'] }}" target="_blank" class="ef-social"><i class="fab fa-youtube"></i></a>
                    @endif
                    @if(isset(app('settings')['footer_whatsapp_url']))
                        <a href="{{ app('settings')['footer_whatsapp_url'] }}" target="_blank" class="ef-social"><i class="fab fa-whatsapp"></i></a>
                    @endif
                    @if(isset(app('settings')['footer_hikma_url']))
                        <a href="{{ app('settings')['footer_hikma_url'] }}" target="_blank" class="ef-social"><i class="fas fa-globe"></i></a>
                    @endif
                </div>
            </div>

            {{-- ── Quick Links ── --}}
            <div>
                <h3 class="ef-col-title">Quick Links</h3>
                <ul class="ef-link-list">
                    @php $pages = App\Models\Page::where('show_in_footer', true)->get(); @endphp
                    @foreach($pages as $page)
                        <li><a href="{{ route('pages.show', $page->slug) }}" class="ef-link"><span class="ef-dot"></span>{{ $page->title }}</a></li>
                    @endforeach
                </ul>
            </div>

            {{-- ── Support ── --}}
            <div>
                <h3 class="ef-col-title">Support</h3>
                <ul class="ef-link-list">
                    <li><a href="{{ route('home') }}" class="ef-link"><span class="ef-dot"></span>Home</a></li>
                    <li><a href="{{ route('recent-files') }}" class="ef-link"><span class="ef-dot"></span>Recent Files</a></li>
                    <li><a href="{{ route('password.edit') }}" class="ef-link"><span class="ef-dot"></span>Password</a></li>
                    <li><a href="{{ route('packages.index') }}" class="ef-link"><span class="ef-dot"></span>Packages</a></li>
                </ul>
            </div>

        </div>

        {{-- ── Bottom bar ── --}}
        <div class="ef-footer-bottom">
            <p class="ef-copy">
                © {{ date('Y') }}
                <a href="{{ route('home') }}" class="ef-copy-link">{{ app('settings')['site_name'] ?? config('app.name') }}</a>.
                All rights reserved.
            </p>
            <p class="ef-copy">
                Powered by <a href="https://exclusiveunlock.com" target="_blank" class="ef-powered-link">exclusiveunlock</a>
            </p>
        </div>

    </div>
</footer>

<style>
/* ── Root tokens ── */
:root {
    --ef-teal  : #1aa87a;
    --ef-mint  : #3dd68c;
    --ef-blue  : #2563c8;

    /* light */
    --ef-bg        : #ffffff;
    --ef-surface   : #f5f5f5;
    --ef-border    : #e0e0e0;
    --ef-text      : #000000;
    --ef-muted     : #555555;  /* ⬅ más oscuro para mejor contraste */
    --ef-subtle    : #777777;  /* ⬅ más oscuro */

    /* teal variants for light */
    --ef-teal-bg   : #e8f8f2;
    --ef-teal-text : #0e6b4d;
}

.dark {
    --ef-bg        : #0d0d0d;
    --ef-surface   : #151515;
    --ef-border    : #1e1e1e;
    --ef-text      : #f0f0f0;
    --ef-muted     : #999999;  /* ⬅ más claro para dark mode */
    --ef-subtle    : #777777;  /* ⬅ más claro */

    --ef-teal-bg   : #0a2018;
    --ef-teal-text : #3dd68c;
}

/* ── Footer shell ── */
.ef-footer {
    background: var(--ef-bg);
    color: var(--ef-text);
    border-top: 3px solid var(--ef-teal);
    transition: background 0.3s, color 0.3s;
}

/* ── Brand ── */
.ef-brand-icon {
    width: 36px; height: 36px;
    background: var(--ef-surface);
    border: 1px solid var(--ef-teal);
    border-radius: 7px;
    display: flex; align-items: center; justify-content: center;
    flex-shrink: 0;
}

.ef-brand-name {
    font-size: 17px;
    font-weight: 800;
    color: var(--ef-text);
    text-decoration: none;
    letter-spacing: -0.4px;
}

/* ── Description ── */
.ef-footer-desc {
    font-size: 13px;
    color: var(--ef-muted);
    line-height: 1.75;
    max-width: 380px;
    margin-bottom: 18px;
}

/* ── Column title ── */
.ef-col-title {
    font-size: 10px;
    font-weight: 700;
    letter-spacing: 2px;
    text-transform: uppercase;
    color: var(--ef-teal);  /* ⬅ cambiado de mint a teal para más contraste */
    margin: 0 0 14px;
}

/* ── Link list ── */
.ef-link-list {
    list-style: none;
    padding: 0; margin: 0;
    display: flex; flex-direction: column; gap: 9px;
}

.ef-link {
    display: flex; align-items: center; gap: 8px;
    font-size: 13px;
    color: var(--ef-muted);
    text-decoration: none;
    transition: color 0.15s;
}

.ef-link:hover { 
    color: var(--ef-teal);  /* ⬅ ahora usa teal en hover */
}

.ef-dot {
    display: inline-block;
    width: 4px; height: 4px;
    border-radius: 50%;
    background: var(--ef-teal);
    flex-shrink: 0;
    transition: background 0.15s;
}

.ef-link:hover .ef-dot { 
    background: var(--ef-mint); 
}

/* ── Social buttons ── */
.ef-social {
    display: inline-flex; align-items: center; justify-content: center;
    width: 32px; height: 32px;
    background: var(--ef-surface);
    border: 1px solid var(--ef-border);
    border-radius: 6px;
    color: var(--ef-muted);
    font-size: 13px;
    text-decoration: none;
    transition: border-color 0.15s, color 0.15s, background 0.15s;
}

.ef-social:hover {
    border-color: var(--ef-teal);
    color: var(--ef-teal);  /* ⬅ cambiado a teal */
    background: var(--ef-teal-bg);
}

/* ── Bottom bar ── */
.ef-footer-bottom {
    border-top: 1px solid var(--ef-border);
    margin-top: 36px; padding-top: 18px;
    display: flex; flex-wrap: wrap;
    justify-content: space-between; align-items: center; gap: 10px;
}

.ef-copy {
    font-size: 12px;
    color: var(--ef-muted);  /* ⬅ cambiado de subtle a muted */
    margin: 0;
}

.ef-copy-link {
    color: var(--ef-text);  /* ⬅ cambiado de muted a text */
    text-decoration: none;
}

.ef-copy-link:hover {
    color: var(--ef-teal);  /* ⬅ hover con teal */
}

.ef-powered-link {
    color: var(--ef-teal);  /* ⬅ cambiado de mint a teal */
    font-weight: 700;
    text-decoration: none;
}

.ef-powered-link:hover {
    color: var(--ef-mint);  /* ⬅ hover con mint */
}
</style>