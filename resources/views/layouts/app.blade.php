<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@isset($title){{ $title }} - @endisset{{ app('settings')['site_name'] ?? config('app.name', 'Laravel') }}</title>

    @php $faviconPath = app('settings')['site_favicon'] ?? null; @endphp
    @if($faviconPath)
        <link rel="icon" type="image/x-icon" href="{{ asset($faviconPath) }}">
    @else
        <link rel="icon" type="image/x-icon" href="https://demo.gsmxtool.com/assets/images/favicon.jpeg">
    @endif

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="{{ asset('js/theme-toggle.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        /* ══════════════════════════════════════════════════════════════
           PALETA GLOBAL — Exclusive Files
           Todos los colores de fondo/texto se definen aquí en :root
           y se sobreescriben en html.dark. El body NUNCA tiene color
           hardcodeado — siempre usa var(--ef-bg) para responder al tema.
           ══════════════════════════════════════════════════════════════ */

        /* ── LIGHT ── */
        :root {
            --ef-blue        : #2563c8;
            --ef-teal        : #1aa87a;
            --ef-mint        : #3dd68c;

            --ef-bg          : #f4f4f4;
            --ef-surface     : #ffffff;
            --ef-surface2    : #eeeeee;
            --ef-border      : #e0e0e0;
            --ef-border2     : #cccccc;
            --ef-text        : #111111;
            --ef-text2       : #444444;
            --ef-muted       : #888888;

            --ef-teal-bg     : #e8f8f2;
            --ef-teal-text   : #0d6648;
            --ef-blue-bg     : #e8eeff;
            --ef-blue-text   : #1a3e99;
            --ef-amber-bg    : #fff8e1;
            --ef-amber-text  : #7a5500;

            --ef-topbar-bg   : #222222;
            --ef-topbar-text : #aaaaaa;
            --ef-nav-bg      : #ffffff;
            --ef-nav-border  : #e5e5e5;
            --ef-dd-bg       : #ffffff;
            --ef-dd-hover    : #f5f5f5;
        }

        /* ── DARK ── */
        html.dark {
            --ef-bg          : #0a0a0a;
            --ef-surface     : #111111;
            --ef-surface2    : #161616;
            --ef-border      : #1e1e1e;
            --ef-border2     : #2a2a2a;
            --ef-text        : #f0f0f0;
            --ef-text2       : #bbbbbb;
            --ef-muted       : #555555;

            --ef-teal-bg     : #0a2018;
            --ef-teal-text   : #3dd68c;
            --ef-blue-bg     : #0d1e40;
            --ef-blue-text   : #6b9eff;
            --ef-amber-bg    : #1f1600;
            --ef-amber-text  : #d4a017;

            --ef-topbar-bg   : #080808;
            --ef-topbar-text : #555555;
            --ef-nav-bg      : #0d0d0d;
            --ef-nav-border  : #1a1a1a;
            --ef-dd-bg       : #111111;
            --ef-dd-hover    : #151515;
        }

        /* ── BASE ── */
        *, *::before, *::after { box-sizing: border-box; }

        html { transition: background 0.2s, color 0.2s; }

        body {
            font-family: 'Figtree', sans-serif;
            background: var(--ef-bg);
            color: var(--ef-text);
            margin: 0;
            scrollbar-gutter: stable;
            transition: background 0.2s, color 0.2s;
        }

        /* ── Scrollbar ── */
        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: var(--ef-bg); }
        ::-webkit-scrollbar-thumb { background: var(--ef-border2); border-radius: 3px; }
        ::-webkit-scrollbar-thumb:hover { background: var(--ef-teal); }

        /* ── Top bar ── */
        .ef-topbar {
            background: var(--ef-topbar-bg);
            border-bottom: 1px solid var(--ef-border);
            color: var(--ef-topbar-text);
            font-size: 12px;
            padding: 6px 0;
            position: relative;
            z-index: 100;
            transition: background 0.2s;
        }

        .ef-topbar a {
            color: var(--ef-topbar-text);
            text-decoration: none;
            transition: color 0.15s;
        }

        .ef-topbar a:hover { color: var(--ef-mint); }

        /* Top bar currency dropdown */
        .ef-topbar-dd {
            position: absolute;
            top: calc(100% + 4px);
            left: 0;
            min-width: 160px;
            background: var(--ef-dd-bg);
            border: 1px solid var(--ef-border);
            border-radius: 8px;
            padding: 6px 0;
            z-index: 200;
            box-shadow: 0 12px 30px rgba(0,0,0,0.15);
        }

        html.dark .ef-topbar-dd {
            box-shadow: 0 12px 30px rgba(0,0,0,0.6);
        }

        .ef-topbar-dd button {
            display: block;
            width: 100%;
            text-align: left;
            padding: 7px 14px;
            font-size: 12px;
            color: var(--ef-text2);
            background: none;
            border: none;
            cursor: pointer;
            transition: background 0.12s, color 0.12s;
        }

        .ef-topbar-dd button:hover {
            background: var(--ef-dd-hover);
            color: var(--ef-mint);
        }

        /* ── Page header slot ── */
        .ef-page-header {
            background: var(--ef-surface);
            border-bottom: 1px solid var(--ef-border);
            padding: 16px 0;
            transition: background 0.2s;
        }
    </style>

    {{-- Block flash of wrong theme before Alpine loads --}}
    <script>
        (function () {
            const stored = localStorage.getItem('theme');
            const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
            const dark = stored === 'dark' || (!stored && prefersDark);
            if (dark) {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
        })();
    </script>
</head>

<body>

    {{-- ── Top bar ── --}}
    <div class="ef-topbar">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8"
             style="display:flex;justify-content:space-between;align-items:center;gap:16px;flex-wrap:wrap;">

            {{-- Left: currency + socials --}}
            <div style="display:flex;align-items:center;gap:14px;flex-wrap:wrap;">

                @if(isset($activeCurrencies) && $activeCurrencies->count() > 0)
                    <div x-data="{ open: false }" style="position:relative;">
                        <button @click="open = !open"
                                style="display:flex;align-items:center;gap:6px;background:none;border:none;cursor:pointer;color:var(--ef-topbar-text);font-size:12px;padding:0;">
                            <i class="fas fa-coins" style="color:var(--ef-teal);font-size:11px;"></i>
                            <span>{{ $selectedCurrency->name ?? $defaultCurrency->name }} ({{ $selectedCurrency->symbol ?? $defaultCurrency->symbol }})</span>
                            <svg style="width:10px;height:10px;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                        <div x-show="open" @click.away="open = false" class="ef-topbar-dd">
                            @foreach($activeCurrencies as $currency)
                                <form action="{{ route('currency.switch') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="currency_id" value="{{ $currency->id }}">
                                    <button type="submit">{{ $currency->name }} ({{ $currency->symbol }})</button>
                                </form>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if(isset(app('settings')['facebook_url']))   <a href="{{ app('settings')['facebook_url'] }}"   target="_blank"><i class="fab fa-facebook"  style="font-size:12px;"></i></a> @endif
                @if(isset(app('settings')['twitter_url']))    <a href="{{ app('settings')['twitter_url'] }}"    target="_blank"><i class="fab fa-twitter"   style="font-size:12px;"></i></a> @endif
                @if(isset(app('settings')['instagram_url']))  <a href="{{ app('settings')['instagram_url'] }}"  target="_blank"><i class="fab fa-instagram"  style="font-size:12px;"></i></a> @endif
                @if(isset(app('settings')['youtube_url']))    <a href="{{ app('settings')['youtube_url'] }}"    target="_blank"><i class="fab fa-youtube"    style="font-size:12px;"></i></a> @endif
                @if(isset(app('settings')['footer_whatsapp_url'])) <a href="{{ app('settings')['footer_whatsapp_url'] }}" target="_blank"><i class="fab fa-whatsapp" style="font-size:12px;"></i></a> @endif
                @if(isset(app('settings')['footer_hikma_url']))    <a href="{{ app('settings')['footer_hikma_url'] }}"    target="_blank"><i class="fas fa-globe"   style="font-size:12px;"></i></a> @endif
            </div>

            {{-- Right: pages + store --}}
            <div style="display:flex;align-items:center;gap:14px;">
                <a href="/pages/about-us">About Us</a>
                <a href="/pages/contact-us">Contact Us</a>
                <a href="{{ route('store.index') }}" style="display:flex;align-items:center;gap:4px;">
                    <i class="fas fa-shopping-bag" style="font-size:11px;color:var(--ef-teal);"></i> Store
                </a>
            </div>

        </div>
    </div>

    @if(isset(app('settings')['custom_header_html']))
        {!! app('settings')['custom_header_html'] !!}
    @endif

    <div style="min-height:100vh;">

        @include('layouts.modern-navigation')

        @isset($header)
            <div class="ef-page-header">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </div>
        @endisset

        <main style="padding-bottom:48px;">
            @isset($slot)
                {{ $slot }}
            @else
                @yield('content')
            @endisset
        </main>

        <x-footer />

    </div>

</body>
</html>