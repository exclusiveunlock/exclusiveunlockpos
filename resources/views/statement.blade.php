<x-app-layout>

<style>
/* ── Statement page — variables --ef-* ── */
.st-page { max-width: 1280px; margin: 0 auto; padding: 28px 20px 64px; }

/* ── Stats grid ── */
.st-stats {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 12px; margin-bottom: 20px;
}

.st-stat {
    background: var(--ef-surface);
    border: 1px solid var(--ef-border);
    border-radius: 10px; padding: 16px;
    display: flex; align-items: flex-start;
    justify-content: space-between; gap: 10px;
    transition: border-color 0.2s, transform 0.2s;
    position: relative; overflow: hidden;
}
.st-stat::after {
    content: ''; position: absolute; bottom: 0; left: 0; right: 0;
    height: 2px; background: var(--ef-teal);
    transform: scaleX(0); transform-origin: left;
    transition: transform 0.25s ease;
}
.st-stat:hover { border-color: var(--ef-teal); transform: translateY(-2px); }
.st-stat:hover::after { transform: scaleX(1); }

.st-stat-label {
    font-size: 10px; font-weight: 700; letter-spacing: 1px;
    text-transform: uppercase; color: var(--ef-muted); margin: 0 0 7px;
}
.st-stat-value {
    font-size: 24px; font-weight: 800;
    color: var(--ef-text); line-height: 1; margin: 0;
}

.st-stat-icon {
    width: 38px; height: 38px;
    background: var(--ef-teal-bg); border: 1px solid var(--ef-teal);
    border-radius: 9px;
    display: flex; align-items: center; justify-content: center; flex-shrink: 0;
}
.st-stat-icon svg { width: 17px; height: 17px; stroke: var(--ef-mint); }

/* credit / debit color override */
.st-stat.credit .st-stat-value { color: var(--ef-teal-text); }
html.dark .st-stat.credit .st-stat-value { color: var(--ef-mint); }
.st-stat.debit  .st-stat-value { color: #c0392b; }

/* ── Panel ── */
.st-panel {
    background: var(--ef-surface);
    border: 1px solid var(--ef-border);
    border-radius: 10px; overflow: hidden;
}

.st-panel-head {
    display: flex; align-items: center; justify-content: space-between;
    padding: 14px 18px; border-bottom: 1px solid var(--ef-border);
}

.st-panel-title {
    font-size: 11px; font-weight: 800;
    letter-spacing: 2px; text-transform: uppercase;
    color: var(--ef-mint); margin: 0;
    display: flex; align-items: center; gap: 7px;
}
.st-panel-title::before {
    content: ''; display: inline-block;
    width: 3px; height: 12px;
    background: var(--ef-teal); border-radius: 2px;
}

.st-panel-sub { font-size: 11px; color: var(--ef-muted); margin-top: 2px; }

/* ── Table ── */
.st-table-wrap { overflow-x: auto; }
.st-table { width: 100%; border-collapse: collapse; font-size: 13px; }

.st-table thead tr {
    background: var(--ef-surface2);
    border-bottom: 1px solid var(--ef-border);
}
.st-table th {
    padding: 11px 16px; font-size: 10px; font-weight: 700;
    letter-spacing: 1px; text-transform: uppercase;
    color: var(--ef-muted); text-align: left; white-space: nowrap;
}

.st-table tbody tr {
    border-bottom: 1px solid var(--ef-border);
    transition: background 0.12s;
}
.st-table tbody tr:last-child { border-bottom: none; }
.st-table tbody tr:hover { background: var(--ef-surface2); }
.st-table td { padding: 12px 16px; vertical-align: middle; }

/* type badge */
.st-badge {
    display: inline-flex; align-items: center; gap: 5px;
    font-size: 10px; font-weight: 800;
    padding: 3px 9px; border-radius: 20px; letter-spacing: 0.3px;
    text-transform: uppercase;
}
.st-badge-credit { background: var(--ef-teal-bg); color: var(--ef-teal-text); }
html.dark .st-badge-credit { color: var(--ef-mint); }
.st-badge-debit  { background: #1a0505; color: #e05050; }

.st-badge-dot {
    width: 5px; height: 5px; border-radius: 50%; display: inline-block;
}
.st-badge-credit .st-badge-dot { background: var(--ef-teal); }
.st-badge-debit  .st-badge-dot { background: #e05050; }

/* amount */
.st-amount-credit { font-size: 13px; font-weight: 800; color: var(--ef-teal-text); }
html.dark .st-amount-credit { color: var(--ef-mint); }
.st-amount-debit  { font-size: 13px; font-weight: 800; color: #c0392b; }

.st-desc { font-size: 13px; font-weight: 600; color: var(--ef-text); margin: 0 0 2px; }
.st-pkg  { font-size: 11px; color: var(--ef-muted); margin: 0; }

/* ── Empty ── */
.st-empty { text-align: center; padding: 48px 20px; }
.st-empty-icon {
    width: 54px; height: 54px;
    background: var(--ef-surface); border: 1px solid var(--ef-border);
    border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    margin: 0 auto 14px;
}
.st-empty-icon svg { width: 24px; height: 24px; stroke: var(--ef-muted); }
.st-empty h3 { font-size: 15px; font-weight: 700; color: var(--ef-text); margin: 0 0 6px; }
.st-empty p  { font-size: 13px; color: var(--ef-muted); margin: 0; }
</style>

<div class="st-page">

    {{-- ── Stat cards ── --}}
    <div class="st-stats">

        {{-- Total Credit --}}
        <div class="st-stat credit">
            <div>
                <p class="st-stat-label">Total Credit</p>
                <p class="st-stat-value">${{ number_format($user->total_credit, 2) }}</p>
            </div>
            <div class="st-stat-icon">
                <svg fill="none" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"/>
                </svg>
            </div>
        </div>

        {{-- Total Debit --}}
        <div class="st-stat debit">
            <div>
                <p class="st-stat-label">Total Debit</p>
                <p class="st-stat-value">${{ number_format($user->total_debit, 2) }}</p>
            </div>
            <div class="st-stat-icon" style="background:#1a0505;border-color:#4a1515;">
                <svg fill="none" stroke-width="2" viewBox="0 0 24 24" style="stroke:#e05050;">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"/>
                </svg>
            </div>
        </div>

        {{-- Net Balance --}}
        <div class="st-stat">
            <div>
                <p class="st-stat-label">Net Balance</p>
                <p class="st-stat-value">${{ number_format($user->total_credit - $user->total_debit, 2) }}</p>
            </div>
            <div class="st-stat-icon">
                <svg fill="none" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                </svg>
            </div>
        </div>

    </div>

    {{-- ── Transaction history ── --}}
    <div class="st-panel">
        <div class="st-panel-head">
            <div>
                <h3 class="st-panel-title">Transaction History</h3>
                <p class="st-panel-sub">All your credit and debit transactions</p>
            </div>
        </div>

        @if($fundLogs->isEmpty())
            <div class="st-empty">
                <div class="st-empty-icon">
                    <svg fill="none" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                    </svg>
                </div>
                <h3>No transactions yet</h3>
                <p>Your credit and debit transactions will appear here.</p>
            </div>
        @else
            <div class="st-table-wrap">
                <table class="st-table">
                    <thead>
                        <tr>
                            <th>Type</th>
                            <th>Amount</th>
                            <th>Description</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($fundLogs as $log)
                        <tr>
                            <td>
                                <span class="st-badge {{ $log->type === 'credit' ? 'st-badge-credit' : 'st-badge-debit' }}">
                                    <span class="st-badge-dot"></span>
                                    {{ ucfirst($log->type) }}
                                </span>
                            </td>
                            <td>
                                <span class="{{ $log->type === 'credit' ? 'st-amount-credit' : 'st-amount-debit' }}">
                                    {{ $log->type === 'credit' ? '+' : '-' }}${{ number_format($log->amount, 2) }}
                                </span>
                            </td>
                            <td>
                                <p class="st-desc">{{ $log->description }}</p>
                                @if($log->package)
                                    <p class="st-pkg">Package: {{ $log->package->title }}</p>
                                @endif
                            </td>
                            <td>
                                <div style="font-size:13px;font-weight:600;color:var(--ef-text);">{{ $log->created_at->format('M d, Y') }}</div>
                                <div style="font-size:11px;color:var(--ef-muted);">{{ $log->created_at->format('h:i A') }}</div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

</div>

</x-app-layout>