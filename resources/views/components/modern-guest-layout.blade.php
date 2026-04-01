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

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        /* ══════════════════════════════════════════
           PALETA — idéntica a app-layout.blade.php
           ══════════════════════════════════════════ */
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

        *, *::before, *::after { box-sizing: border-box; }
        html { transition: background 0.2s, color 0.2s; }

        body {
            font-family: 'Figtree', sans-serif;
            background: var(--ef-bg);
            color: var(--ef-text);
            margin: 0; min-height: 100vh;
            transition: background 0.2s, color 0.2s;
        }

        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: var(--ef-bg); }
        ::-webkit-scrollbar-thumb { background: var(--ef-border2); border-radius: 3px; }
        ::-webkit-scrollbar-thumb:hover { background: var(--ef-teal); }

        /* ── Layout ── */
        .gl-pattern {
            position: fixed; inset: 0; pointer-events: none; z-index: 0;
            opacity: 0.025;
            background-image:
                linear-gradient(var(--ef-teal) 1px, transparent 1px),
                linear-gradient(90deg, var(--ef-teal) 1px, transparent 1px);
            background-size: 40px 40px;
        }
        html.dark .gl-pattern { opacity: 0.04; }

        .gl-accent-bar {
            position: fixed; top: 0; left: 0; right: 0;
            height: 3px; background: var(--ef-teal); z-index: 100;
        }

        .gl-theme-btn {
            position: fixed; top: 16px; right: 16px; z-index: 50;
            width: 36px; height: 36px;
            background: var(--ef-surface); border: 1px solid var(--ef-border);
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            cursor: pointer; color: var(--ef-muted);
            transition: border-color 0.15s, color 0.15s, background 0.15s;
        }
        .gl-theme-btn:hover { border-color: var(--ef-teal); color: var(--ef-mint); }
        .gl-theme-btn svg { width: 16px; height: 16px; }

        .gl-wrapper {
            position: relative; z-index: 1; min-height: 100vh;
            display: flex; flex-direction: column;
            align-items: center; justify-content: center;
            padding: 56px 16px 40px;
        }

        /* ── Logo ── */
        .gl-logo { text-align: center; margin-bottom: 20px; }
        .gl-logo a { display: inline-flex; align-items: center; gap: 12px; text-decoration: none; }
        .gl-logo-icon {
            width: 48px; height: 48px;
            background: var(--ef-teal-bg); border: 2px solid var(--ef-teal);
            border-radius: 11px;
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0; transition: border-color 0.15s;
        }
        .gl-logo a:hover .gl-logo-icon { border-color: var(--ef-mint); }
        .gl-logo-icon svg { width: 24px; height: 24px; stroke: var(--ef-mint); }
        .gl-logo-name {
            font-size: 18px; font-weight: 800;
            color: var(--ef-text); letter-spacing: -0.4px; line-height: 1.2;
        }
        .gl-logo-tagline { font-size: 11px; color: var(--ef-muted); margin-top: 1px; }

        /* ── Card ── */
        .gl-card {
            width: 100%; max-width: 420px;
            background: var(--ef-surface);
            border: 1px solid var(--ef-border);
            border-top: 3px solid var(--ef-teal);
            border-radius: 10px; padding: 28px;
            transition: background 0.2s, border-color 0.2s;
        }

        /* ── Footer ── */
        .gl-footer { margin-top: 20px; text-align: center; width: 100%; max-width: 420px; }
        .gl-footer-links {
            display: flex; flex-wrap: wrap;
            justify-content: center; align-items: center;
            gap: 4px 16px; margin-bottom: 8px;
        }
        .gl-footer-links a { font-size: 12px; color: var(--ef-muted); text-decoration: none; transition: color 0.15s; }
        .gl-footer-links a:hover { color: var(--ef-mint); }
        .gl-footer-sep { font-size: 12px; color: var(--ef-border2); }
        .gl-footer-copy { font-size: 11px; color: var(--ef-border2); margin: 0; }
        .gl-footer-copy a { color: var(--ef-muted); text-decoration: none; }
        .gl-footer-copy a:hover { color: var(--ef-mint); }

        /* ══════════════════════════════════════════
           AUTH FORM — compartido por login y register
           ══════════════════════════════════════════ */
        .auth-heading { text-align: center; margin-bottom: 28px; }
        .auth-heading h2 {
            font-size: 22px; font-weight: 800;
            color: var(--ef-text); margin: 0 0 6px; letter-spacing: -0.4px;
        }
        .auth-heading h2 span { color: var(--ef-mint); }
        .auth-heading p { font-size: 13px; color: var(--ef-muted); margin: 0; }

        .auth-field { margin-bottom: 16px; }

        .auth-label {
            display: block; font-size: 12px; font-weight: 700;
            color: var(--ef-text2); margin-bottom: 6px; letter-spacing: 0.3px;
        }

        .auth-input-wrap { position: relative; }

        .auth-input-icon {
            position: absolute; left: 12px; top: 50%; transform: translateY(-50%);
            pointer-events: none; display: flex;
        }
        .auth-input-icon svg { width: 16px; height: 16px; stroke: var(--ef-muted); transition: stroke 0.15s; }
        .auth-input-wrap:focus-within .auth-input-icon svg { stroke: var(--ef-teal); }

        .auth-input,
        .auth-select {
            width: 100%;
            padding: 10px 12px 10px 40px;
            background: var(--ef-surface);
            border: 1px solid var(--ef-border);
            border-radius: 8px; font-size: 14px; color: var(--ef-text);
            outline: none;
            transition: border-color 0.15s, box-shadow 0.15s;
            -webkit-appearance: none; appearance: none;
        }
        .auth-input::placeholder { color: var(--ef-muted); }
        .auth-select { cursor: pointer; }
        .auth-input:focus,
        .auth-select:focus {
            border-color: var(--ef-teal);
            box-shadow: 0 0 0 3px rgba(26,168,122,0.12);
        }
        .auth-input.has-error, .auth-select.has-error { border-color: #c0392b; }
        .auth-input.has-error:focus, .auth-select.has-error:focus { box-shadow: 0 0 0 3px rgba(192,57,43,0.12); }

        .auth-select-chevron {
            position: absolute; right: 12px; top: 50%; transform: translateY(-50%);
            pointer-events: none;
        }
        .auth-select-chevron svg { width: 14px; height: 14px; stroke: var(--ef-muted); }
        .auth-select option { background: var(--ef-surface); color: var(--ef-text); }

        .auth-input-right {
            position: absolute; right: 12px; top: 50%; transform: translateY(-50%);
            display: flex; align-items: center;
            background: none; border: none; cursor: pointer; padding: 0;
        }
        .auth-input-right svg { width: 16px; height: 16px; stroke: var(--ef-muted); transition: stroke 0.15s; }
        .auth-input-right:hover svg { stroke: var(--ef-teal); }

        .auth-error {
            display: flex; align-items: center; gap: 5px;
            font-size: 12px; color: #c0392b; margin-top: 5px;
        }
        .auth-error svg { width: 13px; height: 13px; flex-shrink: 0; }

        .auth-row {
            display: flex; align-items: center;
            justify-content: space-between;
            margin-bottom: 20px; flex-wrap: wrap; gap: 8px;
        }

        .auth-checkbox-label {
            display: flex; align-items: center; gap: 8px;
            cursor: pointer; font-size: 13px; color: var(--ef-muted);
        }
        .auth-checkbox-label input[type="checkbox"] {
            width: 15px; height: 15px; accent-color: var(--ef-teal); cursor: pointer;
        }

        .auth-forgot {
            font-size: 12px; font-weight: 700; color: var(--ef-teal);
            text-decoration: none; transition: color 0.15s; letter-spacing: 0.2px;
        }
        .auth-forgot:hover { color: var(--ef-mint); }

        .auth-terms {
            display: flex; align-items: flex-start; gap: 10px; margin-bottom: 18px;
        }
        .auth-terms input[type="checkbox"] {
            width: 15px; height: 15px; margin-top: 2px;
            accent-color: var(--ef-teal); cursor: pointer; flex-shrink: 0;
        }
        .auth-terms-text { font-size: 13px; color: var(--ef-muted); line-height: 1.5; }
        .auth-terms-text a { color: var(--ef-teal); font-weight: 700; text-decoration: none; transition: color 0.15s; }
        .auth-terms-text a:hover { color: var(--ef-mint); }

        .auth-submit {
            width: 100%; padding: 12px;
            background: var(--ef-teal); color: #fff;
            border: none; border-radius: 8px;
            font-size: 14px; font-weight: 700; cursor: pointer;
            display: flex; align-items: center; justify-content: center; gap: 8px;
            transition: opacity 0.15s, transform 0.15s;
            letter-spacing: 0.2px; margin-bottom: 20px;
        }
        .auth-submit:hover { opacity: 0.87; transform: translateY(-1px); }
        .auth-submit svg { width: 16px; height: 16px; transition: transform 0.15s; }
        .auth-submit:hover svg { transform: translateX(3px); }

        .auth-divider {
            display: flex; align-items: center; gap: 12px; margin: 4px 0 20px;
        }
        .auth-divider-line { flex: 1; height: 1px; background: var(--ef-border); }
        .auth-divider span { font-size: 11px; color: var(--ef-muted); white-space: nowrap; font-weight: 500; }

        .auth-register,
        .auth-login {
            display: flex; align-items: center; justify-content: center; gap: 8px;
            width: 100%; padding: 11px;
            background: var(--ef-surface); border: 1px solid var(--ef-border);
            border-radius: 8px; font-size: 14px; font-weight: 700;
            color: var(--ef-text2); text-decoration: none;
            transition: border-color 0.15s, color 0.15s;
            margin-bottom: 24px;
        }
        .auth-register:hover,
        .auth-login:hover { border-color: var(--ef-teal); color: var(--ef-mint); }
        .auth-register svg,
        .auth-login svg { width: 16px; height: 16px; transition: transform 0.15s; }
        .auth-login:hover svg { transform: translateX(3px); }

        .auth-features {
            border-top: 1px solid var(--ef-border);
            padding-top: 20px;
            display: grid; grid-template-columns: repeat(3,1fr);
            gap: 12px; text-align: center;
        }
        .auth-feat-item { display: flex; flex-direction: column; align-items: center; gap: 7px; }
        .auth-feat-icon {
            width: 34px; height: 34px;
            background: var(--ef-teal-bg); border: 1px solid var(--ef-teal);
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
        }
        .auth-feat-icon svg { width: 15px; height: 15px; stroke: var(--ef-mint); }
        .auth-feat-label { font-size: 11px; color: var(--ef-muted); font-weight: 500; }
    </style>

    {{-- Anti-flash --}}
    <script>
        (function () {
            const s = localStorage.getItem('theme');
            const d = window.matchMedia('(prefers-color-scheme: dark)').matches;
            if (s === 'dark' || (!s && d)) document.documentElement.classList.add('dark');
        })();
    </script>
</head>

<body>

    <div class="gl-accent-bar"></div>
    <div class="gl-pattern"></div>

    {{-- Theme toggle --}}
    <div x-data="{ darkMode: document.documentElement.classList.contains('dark') }"
         x-init="$watch('darkMode', val => {
             val ? document.documentElement.classList.add('dark')
                 : document.documentElement.classList.remove('dark');
             localStorage.setItem('theme', val ? 'dark' : 'light');
         })">
        <button @click="darkMode = !darkMode" class="gl-theme-btn" title="Toggle theme">
            <svg x-show="!darkMode" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>
            </svg>
            <svg x-show="darkMode" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/>
            </svg>
        </button>
    </div>

    <div class="gl-wrapper">

        {{-- Logo --}}
        <div class="gl-logo">
            <a href="{{ route('home') }}">
                @if(isset(app('settings')['site_logo']) && app('settings')['site_logo'])
                    <img src="{{ asset(app('settings')['site_logo']) }}"
                         alt="{{ app('settings')['site_name'] ?? config('app.name') }} Logo"
                         style="height:44px;">
                @else
                    <div class="gl-logo-icon">
                        <svg fill="none" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <div>
                        <div class="gl-logo-name">{{ app('settings')['site_name'] ?? config('app.name') }}</div>
                        <div class="gl-logo-tagline">The #1 source server</div>
                    </div>
                @endif
            </a>
        </div>

        {{-- Card --}}
        <div class="gl-card">
            {{ $slot }}
        </div>

        {{-- Footer --}}
        <div class="gl-footer">
            <div class="gl-footer-links">
                @if(isset($navigationLinks) && $navigationLinks->count())
                    @foreach ($navigationLinks as $link)
                        <a href="{{ url($link->url) }}">{{ $link->label }}</a>
                        @if(!$loop->last)<span class="gl-footer-sep">·</span>@endif
                    @endforeach
                @else
                    <a href="{{ route('home') }}">Home</a>
                    <span class="gl-footer-sep">·</span>
                    <a href="/pages/privacy">Privacy</a>
                    <span class="gl-footer-sep">·</span>
                    <a href="/pages/terms">Terms</a>
                    <span class="gl-footer-sep">·</span>
                    <a href="/pages/contact-us">Support</a>
                @endif
            </div>
            <p class="gl-footer-copy">
                © {{ date('Y') }}
                <a href="{{ route('home') }}">{{ app('settings')['site_name'] ?? config('app.name') }}</a>.
                All rights reserved.
            </p>
        </div>

    </div>

</body>
</html>