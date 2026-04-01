@extends('layouts.app')

@section('title', 'Store - GSMXSTORE')

@section('content')

<style>
/* ══════════════════════════════════════════
   STORE — usa las variables globales --ef-*
   ══════════════════════════════════════════ */

.store-wrap {
    max-width: 1280px;
    margin: 0 auto;
    padding: 28px 16px 64px;
}

/* ── Alert ── */
.store-alert {
    display: flex; align-items: center; gap: 10px;
    background: var(--ef-teal-bg);
    border: 1px solid var(--ef-teal);
    border-left: 3px solid var(--ef-teal);
    color: var(--ef-teal-text);
    border-radius: 8px;
    padding: 12px 16px;
    font-size: 13px;
    font-weight: 600;
    margin-bottom: 24px;
}

/* ── Hero ── */
.store-hero {
    background: var(--ef-surface);
    border: 1px solid var(--ef-border);
    border-top: 3px solid var(--ef-teal);
    border-radius: 10px;
    padding: 32px 28px;
    margin-bottom: 36px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 20px;
    flex-wrap: wrap;
}

.store-hero-text h1 {
    font-size: 24px;
    font-weight: 800;
    color: var(--ef-text);
    margin: 0 0 6px;
    letter-spacing: -0.4px;
}

.store-hero-text h1 span { color: var(--ef-mint); }

.store-hero-text p {
    font-size: 14px;
    color: var(--ef-muted);
    margin: 0 0 18px;
}

.store-hero-btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 10px 20px;
    background: var(--ef-teal);
    color: #fff;
    border-radius: 8px;
    font-size: 13px;
    font-weight: 700;
    text-decoration: none;
    transition: opacity 0.15s, transform 0.15s;
}
.store-hero-btn:hover { opacity: 0.85; transform: translateY(-1px); }
.store-hero-btn i { font-size: 13px; }

/* ── Section header ── */
.store-section { margin-bottom: 40px; }

.store-section-head {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 18px;
    flex-wrap: wrap;
    gap: 8px;
}

.store-section-head h2 {
    font-size: 14px;
    font-weight: 800;
    letter-spacing: 2px;
    text-transform: uppercase;
    color: var(--ef-mint);
    margin: 0;
    display: flex;
    align-items: center;
    gap: 8px;
}

.store-section-head h2::before {
    content: '';
    display: inline-block;
    width: 3px; height: 14px;
    background: var(--ef-teal);
    border-radius: 2px;
}

.store-view-all {
    font-size: 12px;
    font-weight: 700;
    color: var(--ef-teal);
    text-decoration: none;
    transition: color 0.15s;
    letter-spacing: 0.3px;
}
.store-view-all:hover { color: var(--ef-mint); }

/* ── Category cards ── */
.store-cat-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(160px, 1fr));
    gap: 12px;
}

.store-cat-card {
    background: var(--ef-surface);
    border: 1px solid var(--ef-border);
    border-radius: 9px;
    padding: 18px 12px;
    text-align: center;
    text-decoration: none;
    display: block;
    transition: border-color 0.2s, transform 0.2s, box-shadow 0.2s;
}

.store-cat-card:hover {
    border-color: var(--ef-teal);
    transform: translateY(-3px);
    box-shadow: 0 8px 24px rgba(0,0,0,0.08);
}

html.dark .store-cat-card:hover { box-shadow: 0 8px 24px rgba(0,0,0,0.4); }

.store-cat-icon {
    width: 48px; height: 48px;
    background: var(--ef-teal-bg);
    border: 1px solid var(--ef-teal);
    border-radius: 10px;
    display: flex; align-items: center; justify-content: center;
    margin: 0 auto 12px;
    transition: border-color 0.15s;
}
.store-cat-card:hover .store-cat-icon { border-color: var(--ef-mint); }
.store-cat-icon img { width: 24px; height: 24px; object-fit: contain; }
.store-cat-icon i { color: var(--ef-mint); font-size: 20px; }

.store-cat-name {
    font-size: 13px;
    font-weight: 700;
    color: var(--ef-text);
    margin-bottom: 4px;
    transition: color 0.15s;
}
.store-cat-card:hover .store-cat-name { color: var(--ef-mint); }

.store-cat-desc {
    font-size: 11px;
    color: var(--ef-muted);
    line-height: 1.5;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

/* ── Product cards ── */
.store-prod-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
    gap: 14px;
}

.store-prod-card {
    background: var(--ef-surface);
    border: 1px solid var(--ef-border);
    border-radius: 9px;
    overflow: hidden;
    transition: border-color 0.2s, transform 0.2s, box-shadow 0.2s;
    display: flex;
    flex-direction: column;
}

.store-prod-card:hover {
    border-color: var(--ef-teal);
    transform: translateY(-3px);
    box-shadow: 0 8px 24px rgba(0,0,0,0.08);
}

html.dark .store-prod-card:hover { box-shadow: 0 8px 24px rgba(0,0,0,0.4); }

/* product image */
.store-prod-img {
    position: relative;
    height: 180px;
    background: var(--ef-surface2);
    overflow: hidden;
}

.store-prod-img img {
    width: 100%; height: 100%;
    object-fit: cover;
    transition: transform 0.3s;
}

.store-prod-card:hover .store-prod-img img { transform: scale(1.04); }

.store-prod-img-placeholder {
    width: 100%; height: 100%;
    display: flex; align-items: center; justify-content: center;
}

.store-prod-img-placeholder i { font-size: 36px; color: var(--ef-border2); }

/* badges on image */
.store-prod-badge {
    position: absolute;
    font-size: 9px;
    font-weight: 800;
    letter-spacing: 0.5px;
    padding: 3px 8px;
    border-radius: 4px;
}

.store-prod-badge-sold   { top: 8px; right: 8px; background: #c0392b; color: #fff; }
.store-prod-badge-new    { top: 8px; left: 8px;  background: var(--ef-blue); color: #fff; }

/* product body */
.store-prod-body {
    padding: 14px;
    flex: 1;
    display: flex;
    flex-direction: column;
}

.store-prod-title {
    font-size: 14px;
    font-weight: 700;
    color: var(--ef-text);
    margin: 0 0 4px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.store-prod-desc {
    font-size: 12px;
    color: var(--ef-muted);
    line-height: 1.5;
    margin-bottom: 12px;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
    flex: 1;
}

.store-prod-meta {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 12px;
}

.store-prod-price {
    font-size: 16px;
    font-weight: 800;
    color: var(--ef-teal-text);
}

html.dark .store-prod-price { color: var(--ef-mint); }

.store-prod-stock {
    font-size: 11px;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 4px;
}

.store-prod-stock.in-stock  { color: var(--ef-teal-text); }
.store-prod-stock.out-stock { color: #c0392b; }

html.dark .store-prod-stock.in-stock { color: var(--ef-mint); }

/* product buttons */
.store-prod-actions { display: flex; gap: 8px; }

.store-btn-detail {
    flex: 1;
    display: inline-flex; align-items: center; justify-content: center;
    gap: 5px;
    padding: 8px;
    background: var(--ef-teal-bg);
    border: 1px solid var(--ef-teal);
    color: var(--ef-teal-text);
    border-radius: 7px;
    font-size: 12px;
    font-weight: 700;
    text-decoration: none;
    transition: background 0.15s, color 0.15s;
}

.store-btn-detail:hover { background: var(--ef-teal); color: #fff; }
html.dark .store-btn-detail { color: var(--ef-mint); }
html.dark .store-btn-detail:hover { color: #fff; }

.store-btn-cart {
    flex: 1;
    display: inline-flex; align-items: center; justify-content: center;
    gap: 5px;
    padding: 8px;
    background: var(--ef-teal);
    color: #fff;
    border: none;
    border-radius: 7px;
    font-size: 12px;
    font-weight: 700;
    cursor: pointer;
    transition: opacity 0.15s;
    width: 100%;
}

.store-btn-cart:hover { opacity: 0.85; }

.store-btn-sold {
    flex: 1;
    display: inline-flex; align-items: center; justify-content: center;
    gap: 5px;
    padding: 8px;
    background: var(--ef-surface2);
    border: 1px solid var(--ef-border);
    color: var(--ef-muted);
    border-radius: 7px;
    font-size: 12px;
    font-weight: 700;
    cursor: not-allowed;
    width: 100%;
}

/* ── Empty state ── */
.store-empty {
    padding: 48px 0;
    text-align: center;
    grid-column: 1 / -1;
}

.store-empty i { font-size: 40px; color: var(--ef-border2); display: block; margin-bottom: 12px; }
.store-empty h3 { font-size: 16px; font-weight: 700; color: var(--ef-text); margin: 0 0 6px; }
.store-empty p  { font-size: 13px; color: var(--ef-muted); margin: 0; }
</style>

<div class="store-wrap">

    {{-- Alert --}}
    @if(session('success'))
        <div class="store-alert">
            <svg style="width:16px;height:16px;stroke:var(--ef-teal);flex-shrink:0;" fill="none" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            {{ session('success') }}
        </div>
    @endif

    {{-- ── Hero ── --}}
    <section class="store-hero">
        <div class="store-hero-text">
            <h1>Welcome to <span>ExclusiveUnlockFiles</span></h1>
            <p>Discover the best products at competitive prices</p>
            <a href="{{ route('store.products') }}" class="store-hero-btn">
                <i class="fas fa-shopping-cart"></i>
                Shop Now
            </a>
        </div>
        <svg style="width:80px;height:80px;opacity:0.06;" fill="none" stroke="var(--ef-teal)" stroke-width="1" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
        </svg>
    </section>

    {{-- ── Categories ── --}}
    <section class="store-section">
        <div class="store-section-head">
            <h2>Categories</h2>
            <a href="{{ route('store.products') }}" class="store-view-all">View All →</a>
        </div>
        <div class="store-cat-grid">
            @forelse($categories as $category)
                <a href="{{ route('store.products', ['category' => $category->name]) }}" class="store-cat-card">
                    <div class="store-cat-icon">
                        @if($category->icon)
                            <img src="{{ asset('uploads/' . $category->icon) }}" alt="{{ $category->name }}">
                        @else
                            <i class="fas fa-box"></i>
                        @endif
                    </div>
                    <div class="store-cat-name">{{ $category->name }}</div>
                    @if($category->description)
                        <div class="store-cat-desc">{{ Str::limit($category->description, 60) }}</div>
                    @endif
                </a>
            @empty
                <div class="store-empty" style="grid-column:1/-1;">
                    <i class="fas fa-box-open"></i>
                    <h3>No Categories Available</h3>
                    <p>Check back later for new categories.</p>
                </div>
            @endforelse
        </div>
    </section>

    {{-- ── Featured Products ── --}}
    @if($featuredProducts->count() > 0)
    <section class="store-section">
        <div class="store-section-head">
            <h2>Featured Products</h2>
            <a href="{{ route('store.products') }}" class="store-view-all">View All →</a>
        </div>
        <div class="store-prod-grid">
            @foreach($featuredProducts as $product)
                <div class="store-prod-card">
                    <div class="store-prod-img">
                        @if($product->thumbnail)
                            <img src="{{ asset('uploads/' . $product->thumbnail) }}" alt="{{ $product->title }}">
                        @else
                            <div class="store-prod-img-placeholder"><i class="fas fa-image"></i></div>
                        @endif
                        @if($product->stock_count <= 0)
                            <span class="store-prod-badge store-prod-badge-sold">SOLD OUT</span>
                        @endif
                    </div>
                    <div class="store-prod-body">
                        <div class="store-prod-title">{{ $product->title }}</div>
                        <div class="store-prod-desc">{{ Str::limit($product->description, 80) }}</div>
                        <div class="store-prod-meta">
                            <span class="store-prod-price">@currency($product->price)</span>
                            @if($product->stock_count > 0)
                                <span class="store-prod-stock in-stock">
                                    <i class="fas fa-check-circle" style="font-size:11px;"></i>
                                    {{ $product->stock_count }} left
                                </span>
                            @else
                                <span class="store-prod-stock out-stock">
                                    <i class="fas fa-times-circle" style="font-size:11px;"></i>
                                    Out of Stock
                                </span>
                            @endif
                        </div>
                        <div class="store-prod-actions">
                            <a href="{{ route('store.product.show', $product->id) }}" class="store-btn-detail">
                                <i class="fas fa-eye" style="font-size:11px;"></i> Details
                            </a>
                            @if($product->stock_count > 0)
                                <form action="{{ route('store.cart.add') }}" method="POST" style="flex:1;">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <input type="hidden" name="quantity" value="1">
                                    <button type="submit" class="store-btn-cart">
                                        <i class="fas fa-shopping-cart" style="font-size:11px;"></i> Cart
                                    </button>
                                </form>
                            @else
                                <button class="store-btn-sold" disabled>
                                    <i class="fas fa-ban" style="font-size:11px;"></i> Sold
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
    @endif

    {{-- ── New Products ── --}}
    @if($products->count() > 0)
    <section class="store-section">
        <div class="store-section-head">
            <h2>New Products</h2>
            <a href="{{ route('store.products') }}" class="store-view-all">View All →</a>
        </div>
        <div class="store-prod-grid">
            @foreach($products as $product)
                <div class="store-prod-card">
                    <div class="store-prod-img">
                        @if($product->thumbnail)
                            <img src="{{ asset('uploads/' . $product->thumbnail) }}" alt="{{ $product->title }}">
                        @else
                            <div class="store-prod-img-placeholder"><i class="fas fa-image"></i></div>
                        @endif
                        @if($product->stock_count <= 0)
                            <span class="store-prod-badge store-prod-badge-sold">SOLD OUT</span>
                        @endif
                        @if($product->created_at->diffInDays(now()) <= 7)
                            <span class="store-prod-badge store-prod-badge-new">NEW</span>
                        @endif
                    </div>
                    <div class="store-prod-body">
                        <div class="store-prod-title">{{ $product->title }}</div>
                        <div class="store-prod-desc">{{ Str::limit($product->description, 80) }}</div>
                        <div class="store-prod-meta">
                            <span class="store-prod-price">@currency($product->price)</span>
                            @if($product->stock_count > 0)
                                <span class="store-prod-stock in-stock">
                                    <i class="fas fa-check-circle" style="font-size:11px;"></i>
                                    {{ $product->stock_count }} left
                                </span>
                            @else
                                <span class="store-prod-stock out-stock">
                                    <i class="fas fa-times-circle" style="font-size:11px;"></i>
                                    Out of Stock
                                </span>
                            @endif
                        </div>
                        <div class="store-prod-actions">
                            <a href="{{ route('store.product.show', $product->id) }}" class="store-btn-detail">
                                <i class="fas fa-eye" style="font-size:11px;"></i> Details
                            </a>
                            @if($product->stock_count > 0)
                                <form action="{{ route('store.cart.add') }}" method="POST" style="flex:1;">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <input type="hidden" name="quantity" value="1">
                                    <button type="submit" class="store-btn-cart">
                                        <i class="fas fa-shopping-cart" style="font-size:11px;"></i> Cart
                                    </button>
                                </form>
                            @else
                                <button class="store-btn-sold" disabled>
                                    <i class="fas fa-ban" style="font-size:11px;"></i> Sold
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
    @endif

</div>

@endsection