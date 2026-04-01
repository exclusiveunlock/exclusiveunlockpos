<nav x-data="{
         open: false,
         darkMode: document.documentElement.classList.contains('dark')
     }"
     x-init="
         $watch('darkMode', val => {
             if (val) {
                 document.documentElement.classList.add('dark');
                 localStorage.setItem('theme', 'dark');
             } else {
                 document.documentElement.classList.remove('dark');
                 localStorage.setItem('theme', 'light');
             }
         })
     "
     style="background:var(--ef-nav-bg);border-bottom:1px solid var(--ef-nav-border);position:relative;z-index:50;transition:background 0.2s;">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div style="display:flex;justify-content:space-between;align-items:center;height:56px;">

            {{-- ── Logo ── --}}
            <a href="{{ route('home') }}" style="display:flex;align-items:center;gap:10px;text-decoration:none;flex-shrink:0;">
                @if(isset(app('settings')['site_logo']) && app('settings')['site_logo'])
                    <img src="{{ asset(app('settings')['site_logo']) }}"
                         alt="{{ app('settings')['site_name'] ?? config('app.name') }} Logo"
                         style="height:34px;">
                @else
                    <div style="width:32px;height:32px;background:var(--ef-teal-bg);border:1px solid var(--ef-teal);border-radius:7px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                        <svg style="width:16px;height:16px;" fill="none" stroke="var(--ef-mint)" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <span class="hidden sm:block"
                          style="font-size:16px;font-weight:800;color:var(--ef-text);letter-spacing:-0.4px;">
                        {{ app('settings')['site_name'] ?? config('app.name') }}
                    </span>
                @endif
            </a>

            {{-- ── Desktop Links ── --}}
            <div class="hidden md:flex" style="align-items:center;gap:2px;">
                @if(isset($navigationLinks) && count($navigationLinks) > 0)
                    @foreach ($navigationLinks as $link)
                        <a href="{{ url($link->url) }}" class="ef-nav-link {{ request()->is($link->url) ? 'ef-nav-link--active' : '' }}">
                            {{ $link->label }}
                        </a>
                    @endforeach
                @else
                    @auth
                        <a href="{{ route('dashboard') }}"             class="ef-nav-link">Dashboard</a>
                        <a href="{{ route('packages.index') }}"        class="ef-nav-link">Packages</a>
                        <a href="{{ route('recent-files') }}"          class="ef-nav-link">Recent Files</a>
                        <a href="{{ route('password.access.index') }}" class="ef-nav-link">Password Access</a>
                    @else
                        <a href="{{ route('packages.index') }}"        class="ef-nav-link">Packages</a>
                        <a href="{{ route('recent-files') }}"          class="ef-nav-link">Recent Files</a>
                        <a href="{{ route('password.access.index') }}" class="ef-nav-link">Password</a>
                    @endauth
                @endif
            </div>

            {{-- ── Right Actions ── --}}
            <div style="display:flex;align-items:center;gap:8px;">

                {{-- Theme toggle --}}
                <button @click="darkMode = !darkMode" class="ef-icon-btn" title="Toggle theme">
                    <svg x-show="!darkMode" style="width:16px;height:16px;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>
                    </svg>
                    <svg x-show="darkMode" style="width:16px;height:16px;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/>
                    </svg>
                </button>

                {{-- User menu --}}
                @auth
                    <div class="hidden md:block" x-data="{ open: false }" style="position:relative;">
                        <button @click="open = !open" class="ef-user-btn">
                            <div class="ef-avatar">{{ substr(Auth::user()->name, 0, 1) }}</div>
                            <span class="hidden lg:block"
                                  style="font-size:13px;font-weight:600;color:var(--ef-text2);max-width:120px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">
                                {{ Auth::user()->name }}
                            </span>
                            <svg style="width:13px;height:13px;stroke:var(--ef-muted);flex-shrink:0;" fill="none" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>

                        <div x-show="open"
                             x-transition:enter="transition ease-out duration-150"
                             x-transition:enter-start="opacity-0 translate-y-1"
                             x-transition:enter-end="opacity-100 translate-y-0"
                             x-transition:leave="transition ease-in duration-100"
                             x-transition:leave-start="opacity-100"
                             x-transition:leave-end="opacity-0"
                             @click.away="open = false"
                             style="position:absolute;right:0;top:calc(100% + 8px);width:210px;background:var(--ef-dd-bg);border:1px solid var(--ef-border);border-radius:10px;overflow:hidden;z-index:60;box-shadow:0 16px 40px rgba(0,0,0,0.15);">

                            {{-- User info --}}
                            <div style="padding:11px 14px;border-bottom:1px solid var(--ef-border);">
                                <div style="font-size:13px;font-weight:700;color:var(--ef-text);overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">{{ Auth::user()->name }}</div>
                                <div style="font-size:11px;color:var(--ef-muted);overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">{{ Auth::user()->email }}</div>
                            </div>

                            <div style="padding:5px 0;">
                                <a href="{{ route('profile.edit') }}"   class="ef-dd-item">
                                    <svg class="ef-dd-icon" fill="none" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                    Profile
                                </a>
                                <a href="{{ route('dashboard') }}"      class="ef-dd-item">
                                    <svg class="ef-dd-icon" fill="none" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m0 0l-7 7m7-7v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                                    Dashboard
                                </a>
                                <a href="{{ route('user.statement') }}" class="ef-dd-item">
                                    <svg class="ef-dd-icon" fill="none" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/></svg>
                                    Statement
                                </a>
                                <a href="{{ route('reports.create') }}" class="ef-dd-item">
                                    <svg class="ef-dd-icon" fill="none" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 21v-4m0 0V5a2 2 0 012-2h6.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V21m-10 0h10a2 2 0 002-2v-6.586a1 1 0 00-.293-.707l-3.414-3.414a1 1 0 00-.707-.293H3a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                    Report
                                </a>
                                <a href="{{ route('password.edit') }}"  class="ef-dd-item">
                                    <svg class="ef-dd-icon" fill="none" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 7a2 2 0 012 2v5a2 2 0 01-2 2h-5a2 2 0 01-2-2V9a2 2 0 012-2h5z"/><path stroke-linecap="round" stroke-linejoin="round" d="M17 9v-3a2 2 0 00-2-2H9a2 2 0 00-2 2v3"/></svg>
                                    Change Password
                                </a>
                            </div>

                            <div style="border-top:1px solid var(--ef-border);padding:5px 0;">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="ef-dd-item ef-dd-item--danger" style="width:100%;background:none;border:none;cursor:pointer;text-align:left;">
                                        <svg class="ef-dd-icon" fill="none" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                                        Logout
                                    </button>
                                </form>
                            </div>

                            <div style="padding:10px 14px;border-top:1px solid var(--ef-border);background:var(--ef-surface2);">
                                <p style="font-size:10px;font-weight:700;color:var(--ef-mint);text-transform:uppercase;letter-spacing:1px;margin:0 0 6px;">Last Login IPs</p>
                                @forelse(Auth::user()->loginIps ?? [] as $loginIp)
                                    <p style="font-size:11px;color:var(--ef-muted);margin:0 0 2px;">
                                        {{ $loginIp->ip_address }}
                                        <span style="opacity:0.6;">· {{ $loginIp->created_at->diffForHumans() }}</span>
                                    </p>
                                @empty
                                    <p style="font-size:11px;color:var(--ef-muted);margin:0;">No history.</p>
                                @endforelse
                            </div>

                        </div>
                    </div>
                @else
                    <div class="hidden md:flex" style="gap:8px;">
                        <a href="{{ route('login') }}"    class="ef-btn-secondary">Login</a>
                        <a href="{{ route('register') }}" class="ef-btn-primary">Register</a>
                    </div>
                @endauth

                {{-- Hamburger --}}
                <button @click="open = !open" class="md:hidden ef-icon-btn">
                    <svg x-show="!open" style="width:18px;height:18px;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                    <svg x-show="open" style="width:18px;height:18px;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>

            </div>
        </div>
    </div>

    {{-- ── Mobile Menu ── --}}
    <div x-show="open"
         x-transition:enter="transition ease-out duration-150"
         x-transition:enter-start="opacity-0 -translate-y-2"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-100"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0 -translate-y-2"
         class="md:hidden"
         style="background:var(--ef-nav-bg);border-top:1px solid var(--ef-nav-border);">

        <div style="padding:10px 16px;display:flex;flex-direction:column;gap:2px;">
            @if(isset($navigationLinks) && count($navigationLinks) > 0)
                @foreach ($navigationLinks as $link)
                    <a href="{{ url($link->url) }}" class="ef-mob-link {{ request()->is($link->url) ? 'ef-mob-link--active' : '' }}">{{ $link->label }}</a>
                @endforeach
            @else
                @auth
                    <a href="{{ route('dashboard') }}"             class="ef-mob-link">Dashboard</a>
                    <a href="{{ route('packages.index') }}"        class="ef-mob-link">Packages</a>
                    <a href="{{ route('recent-files') }}"          class="ef-mob-link">Recent Files</a>
                    <a href="{{ route('password.access.index') }}" class="ef-mob-link">Password Access</a>
                @else
                    <a href="{{ route('packages.index') }}"        class="ef-mob-link">Packages</a>
                    <a href="{{ route('recent-files') }}"          class="ef-mob-link">Recent Files</a>
                    <a href="{{ route('login') }}"                 class="ef-mob-link">Login</a>
                    <a href="{{ route('register') }}"              class="ef-mob-link">Register</a>
                @endauth
            @endif
        </div>

        @auth
            <div style="border-top:1px solid var(--ef-border);padding:14px 16px;">
                <div style="display:flex;align-items:center;gap:12px;margin-bottom:12px;">
                    <div class="ef-avatar" style="width:38px;height:38px;font-size:15px;">{{ substr(Auth::user()->name, 0, 1) }}</div>
                    <div>
                        <div style="font-size:14px;font-weight:700;color:var(--ef-text);">{{ Auth::user()->name }}</div>
                        <div style="font-size:12px;color:var(--ef-muted);">{{ Auth::user()->email }}</div>
                    </div>
                </div>
                <div style="display:flex;flex-direction:column;gap:2px;">
                    <a href="{{ route('profile.edit') }}"   class="ef-mob-link"><svg class="ef-dd-icon" fill="none" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg> Profile</a>
                    <a href="{{ route('dashboard') }}"      class="ef-mob-link"><svg class="ef-dd-icon" fill="none" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m0 0l-7 7m7-7v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg> Dashboard</a>
                    <a href="{{ route('user.statement') }}" class="ef-mob-link"><svg class="ef-dd-icon" fill="none" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/></svg> Statement</a>
                    <a href="{{ route('reports.create') }}" class="ef-mob-link"><svg class="ef-dd-icon" fill="none" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 21v-4m0 0V5a2 2 0 012-2h6.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V21m-10 0h10a2 2 0 002-2v-6.586a1 1 0 00-.293-.707l-3.414-3.414a1 1 0 00-.707-.293H3a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg> Report</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="ef-mob-link ef-mob-link--danger" style="width:100%;background:none;border:none;cursor:pointer;text-align:left;">
                            <svg class="ef-dd-icon" fill="none" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        @endauth

    </div>

</nav>

<style>
/* ── Desktop nav link ── */
.ef-nav-link {
    display: inline-flex;
    align-items: center;
    padding: 6px 12px;
    border-radius: 6px;
    font-size: 13px;
    font-weight: 500;
      color: #3d3d3d;
    text-decoration: none;
    transition: color 0.15s, background 0.15s;
    white-space: nowrap;
}
.ef-nav-link:hover          { color: var(--ef-text);      background: var(--ef-surface2); }
.ef-nav-link--active        { color: var(--ef-mint) !important; background: var(--ef-teal-bg) !important; }

/* ── Icon button ── */
.ef-icon-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 34px; height: 34px;
    background: var(--ef-surface);
    border: 1px solid var(--ef-border);
    border-radius: 7px;
    color: var(--ef-muted);
    cursor: pointer;
    transition: border-color 0.15s, color 0.15s, background 0.15s;
}
.ef-icon-btn:hover { border-color: var(--ef-teal); color: var(--ef-mint); }

/* ── User button ── */
.ef-user-btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 5px 10px 5px 6px;
    background: var(--ef-surface);
    border: 1px solid var(--ef-border);
    border-radius: 8px;
    cursor: pointer;
    transition: border-color 0.15s, background 0.15s;
}
.ef-user-btn:hover { border-color: var(--ef-teal); }

/* ── Avatar ── */
.ef-avatar {
    width: 28px; height: 28px;
    background: var(--ef-teal-bg);
    border: 1px solid var(--ef-teal);
    border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    font-size: 12px; font-weight: 700;
    color: var(--ef-mint);
    flex-shrink: 0;
}

/* ── Dropdown item ── */
.ef-dd-item {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 8px 14px;
    font-size: 13px;
    font-weight: 500;
    color: var(--ef-text2);
    text-decoration: none;
    transition: color 0.12s, background 0.12s;
}
.ef-dd-item:hover            { background: var(--ef-dd-hover); color: var(--ef-text); }
.ef-dd-item--danger          { color: #c0392b !important; }
.ef-dd-item--danger:hover    { background: #fdf0ef !important; }
html.dark .ef-dd-item--danger:hover { background: #1a0505 !important; }

.ef-dd-icon {
    width: 14px; height: 14px;
    stroke: currentColor;
    flex-shrink: 0;
}

/* ── Mobile link ── */
.ef-mob-link {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 9px 12px;
    border-radius: 7px;
    font-size: 14px;
    font-weight: 500;
    color: var(--ef-muted);
    text-decoration: none;
    transition: color 0.12s, background 0.12s;
}
.ef-mob-link:hover         { background: var(--ef-surface2); color: var(--ef-text); }
.ef-mob-link--active       { color: var(--ef-mint) !important; background: var(--ef-teal-bg) !important; }
.ef-mob-link--danger       { color: #c0392b !important; }
.ef-mob-link--danger:hover { background: #fdf0ef !important; }
html.dark .ef-mob-link--danger:hover { background: #1a0505 !important; }

/* ── Auth buttons ── */
.ef-btn-primary {
    display: inline-flex;
    align-items: center;
    padding: 7px 16px;
    border-radius: 7px;
    font-size: 13px;
    font-weight: 700;
    background: var(--ef-teal);
    color: #fff;
    text-decoration: none;
    transition: opacity 0.15s;
}
.ef-btn-primary:hover { opacity: 0.85; }

.ef-btn-secondary {
    display: inline-flex;
    align-items: center;
    padding: 6px 14px;
    border-radius: 7px;
    font-size: 13px;
    font-weight: 600;
    background: var(--ef-surface);
    border: 1px solid var(--ef-border);
    color: var(--ef-text2);
    text-decoration: none;
    transition: border-color 0.15s, color 0.15s;
}
.ef-btn-secondary:hover { border-color: var(--ef-teal); color: var(--ef-mint); }
</style>