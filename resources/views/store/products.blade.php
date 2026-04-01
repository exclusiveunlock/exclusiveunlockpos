@extends('layouts.app')

@section('title', 'Products - GSMXSTORE')

@section('content')

<style>
/* ── Reutiliza las clases .store-* de store-index.blade.php ──
   Solo se agregan los estilos nuevos: filtros y paginación. */

.store-wrap {
    max-width: 1280px;
    margin: 0 auto;
    padding: 28px 16px 64px;
}

/* ── Filter bar ── */
.store-filters {
    background: var(--ef-surface);
    border: 1px solid var(--ef-border);
    border-radius: 10px;
    padding: 20px;
    margin-bottom: 28px;
}

.store-filters-grid {
    display: grid;
    grid-template-columns: 1fr 1fr 1fr auto;
    gap: 14px;
    align-items: end;
}

@media (max-width: 768px) {
    .store-filters-grid { grid-template-columns: 1fr 1fr; }
}

@media (max-width: 480px) {
    .store-filters-grid { grid-template-columns: 1fr; }
}

.store-filter-field label {
    display: block;
    font-size: 11px;
    font-weight: 700;
    letter-spacing: 0.5px;
    text-transform: uppercase;
    color: var(--ef-muted);
    margin-bottom: 6px;
}

.store-filter-wrap { position: relative; }

.store-filter-icon {
    position: absolute;
    left: 10px; top: 50%; transform: translateY(-50%);
    pointer-events: none;
    color: var(--ef-muted);
    font-size: 12px;
}

.store-filter-input,
.store-filter-select {
    width: 100%;
    padding: 9px 10px 9px 32px;
    background: var(--ef-bg);
    border: 1px solid var(--ef-border);
    border-radius: 7px;
    font-size: 13px;
    color: var(--ef-text);
    outline: none;
    transition: border-color 0.15s, box-shadow 0.15s;
    -webkit-appearance: none;
    appearance: none;
}

.store-filter-input::placeholder { color: var(--ef-muted); }
.store-filter-select { cursor: pointer; }

.store-filter-input:focus,
.store-filter-select:focus {
    border-color: var(--ef-teal);
    box-shadow: 0 0 0 3px rgba(26,168,122,0.1);
}

.store-filter-chevron {
    position: absolute;
    right: 10px; top: 50%; transform: translateY(-50%);
    pointer-events: none;
    color: var(--ef-muted);
    font-size: 11px;
}

.store-filter-select option {
    background: var(--ef-surface);
    color: var(--ef-text);
}

/* filter button */
.store-filter-btn {
    display: inline-flex; align-items: center; justify-content: center;
    gap: 7px;
    padding: 9px 20px;
    background: var(--ef-teal);
    color: #fff;
    border: none;
    border-radius: 7px;
    font-size: 13px;
    font-weight: 700;
    cursor: pointer;
    white-space: nowrap;
    transition: opacity 0.15s;
    height: 38px;
}
.store-filter-btn:hover { opacity: 0.85; }

/* ── Section head ── */
.store-section-head {
    display: flex; align-items: center;
    justify-content: space-between;
    margin-bottom: 18px; flex-wrap: wrap; gap: 8px;
}

.store-section-head h2 {
    font-size: 14px; font-weight: 800;
    letter-spacing: 2px; text-transform: uppercase;
    color: var(--ef-mint); margin: 0;
    display: flex; align-items: center; gap: 8px;
}

.store-section-head h2::before {
    content: '';
    display: inline-block;
    width: 3px; height: 14px;
    background: var(--ef-teal); border-radius: 2px;
}

.store-count {
    font-size: 12px;
    color: var(--ef-muted);
}

/* ── Product grid (same as store-index) ── */
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
    display: flex; flex-direction: column;
}

.store-prod-card:hover {
    border-color: var(--ef-teal);
    transform: translateY(-3px);
    box-shadow: 0 8px 24px rgba(0,0,0,0.08);
}

html.dark .store-prod-card:hover { box-shadow: 0 8px 24px rgba(0,0,0,0.4); }

.store-prod-img {
    position: relative; height: 180px;
    background: var(--ef-surface2); overflow: hidden;
}

.store-prod-img img {
    width: 100%; height: 100%; object-fit: cover;
    transition: transform 0.3s;
}

.store-prod-card:hover .store-prod-img img { transform: scale(1.04); }

.store-prod-img-placeholder {
    width: 100%; height: 100%;
    display: flex; align-items: center; justify-content: center;
}
.store-prod-img-placeholder i { font-size: 36px; color: var(--ef-border2); }

.store-prod-badge {
    position: absolute;
    font-size: 9px; font-weight: 800; letter-spacing: 0.5px;
    padding: 3px 8px; border-radius: 4px;
}
.store-prod-badge-sold { top:8px; right:8px; background:#c0392b; color:#fff; }
.store-prod-badge-new  { top:8px; left:8px;  background:var(--ef-blue); color:#fff; }

.store-prod-body {
    padding: 14px; flex: 1;
    display: flex; flex-direction: column;
}

.store-prod-title {
    font-size: 14px; font-weight: 700;
    color: var(--ef-text); margin: 0 0 5px;
    white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
}

/* Tags row */
.store-prod-tags {
    display: flex; flex-wrap: wrap; gap: 4px;
    margin-bottom: 8px;
}

.store-prod-tag {
    font-size: 10px; font-weight: 600;
    background: var(--ef-surface2);
    color: var(--ef-muted);
    border: 1px solid var(--ef-border);
    padding: 1px 7px; border-radius: 20px;
}

.store-prod-desc {
    font-size: 12px; color: var(--ef-muted);
    line-height: 1.5; margin-bottom: 10px;
    display: -webkit-box;
    -webkit-line-clamp: 2; -webkit-box-orient: vertical;
    overflow: hidden; flex: 1;
}

.store-prod-meta {
    display: flex; align-items: center;
    justify-content: space-between; margin-bottom: 10px;
}

.store-prod-price {
    font-size: 16px; font-weight: 800;
    color: var(--ef-teal-text);
}
html.dark .store-prod-price { color: var(--ef-mint); }

.store-prod-stock { font-size: 11px; font-weight: 600; display: flex; align-items: center; gap: 4px; }
.store-prod-stock.in-stock  { color: var(--ef-teal-text); }
.store-prod-stock.out-stock { color: #c0392b; }
html.dark .store-prod-stock.in-stock { color: var(--ef-mint); }

.store-prod-actions { display: flex; gap: 8px; }

.store-btn-detail {
    flex: 1; display: inline-flex; align-items: center; justify-content: center;
    gap: 5px; padding: 8px;
    background: var(--ef-teal-bg); border: 1px solid var(--ef-teal);
    color: var(--ef-teal-text); border-radius: 7px;
    font-size: 12px; font-weight: 700; text-decoration: none;
    transition: background 0.15s, color 0.15s;
}
.store-btn-detail:hover { background: var(--ef-teal); color: #fff; }
html.dark .store-btn-detail { color: var(--ef-mint); }
html.dark .store-btn-detail:hover { color: #fff; }

.store-btn-cart {
    flex: 1; display: inline-flex; align-items: center; justify-content: center;
    gap: 5px; padding: 8px;
    background: var(--ef-teal); color: #fff;
    border: none; border-radius: 7px;
    font-size: 12px; font-weight: 700;
    cursor: pointer; width: 100%;
    transition: opacity 0.15s;
}
.store-btn-cart:hover { opacity: 0.85; }

.store-btn-sold {
    flex: 1; display: inline-flex; align-items: center; justify-content: center;
    gap: 5px; padding: 8px;
    background: var(--ef-surface2); border: 1px solid var(--ef-border);
    color: var(--ef-muted); border-radius: 7px;
    font-size: 12px; font-weight: 700;
    cursor: not-allowed; width: 100%;
}

/* ── Empty state ── */
.store-empty {
    text-align: center; padding: 64px 0;
}
.store-empty i { font-size: 44px; color: var(--ef-border2); display: block; margin-bottom: 14px; }
.store-empty h3 { font-size: 17px; font-weight: 700; color: var(--ef-text); margin: 0 0 6px; }
.store-empty p  { font-size: 13px; color: var(--ef-muted); margin: 0 0 20px; }

.store-empty-btn {
    display: inline-flex; align-items: center; gap: 7px;
    padding: 10px 20px;
    background: var(--ef-teal); color: #fff;
    border-radius: 8px; font-size: 13px; font-weight: 700;
    text-decoration: none; transition: opacity 0.15s;
}
.store-empty-btn:hover { opacity: 0.85; }

/* ── Pagination override ── */
.pagination-wrap {
    margin-top: 28px;
}

/* Override Tailwind pagination to use --ef-* vars */
.pagination-wrap nav [aria-current="page"] span,
.pagination-wrap nav span[aria-current="page"] {
    background: var(--ef-teal) !important;
    border-color: var(--ef-teal) !important;
    color: #fff !important;
}

.pagination-wrap nav a {
    background: var(--ef-surface) !important;
    border-color: var(--ef-border) !important;
    color: var(--ef-text2) !important;
    transition: border-color 0.15s, color 0.15s !important;
}

.pagination-wrap nav a:hover {
    border-color: var(--ef-teal) !important;
    color: var(--ef-mint) !important;
}
</style>

<div class="store-wrap">

    {{-- ── Filters ── --}}
    <div class="store-filters">
        <form method="GET" action="{{ route('store.products') }}">
            <div class="store-filters-grid">

                {{-- Search --}}
                <div class="store-filter-field">
                    <label>Search</label>
                    <div class="store-filter-wrap">
                        <i class="fas fa-search store-filter-icon"></i>
                        <input type="text" name="search" value="{{ request('search') }}"
                               placeholder="Search products..."
                               class="store-filter-input">
                    </div>
                </div>

                {{-- Category --}}
                <div class="store-filter-field">
                    <label>Category</label>
                    <div class="store-filter-wrap">
                        <i class="fas fa-folder store-filter-icon"></i>
                        <select name="category" class="store-filter-select">
                            <option value="">All Categories</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->name }}" {{ request('category') == $category->name ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        <i class="fas fa-chevron-down store-filter-chevron"></i>
                    </div>
                </div>

                {{-- Tag --}}
                <div class="store-filter-field">
                    <label>Tag</label>
                    <div class="store-filter-wrap">
                        <i class="fas fa-tag store-filter-icon"></i>
                        <select name="tag" class="store-filter-select">
                            <option value="">All Tags</option>
                            @foreach($tags as $tag)
                                <option value="{{ $tag->name }}" {{ request('tag') == $tag->name ? 'selected' : '' }}>
                                    {{ $tag->name }}
                                </option>
                            @endforeach
                        </select>
                        <i class="fas fa-chevron-down store-filter-chevron"></i>
                    </div>
                </div>

                {{-- Submit --}}
                <div>
                    <button type="submit" class="store-filter-btn">
                        <i class="fas fa-filter"></i> Filter
                    </button>
                </div>

            </div>
        </form>
    </div>

    {{-- ── Products ── --}}
    <section>
        <div class="store-section-head">
            <h2>Products</h2>
            <span class="store-count">
                Showing {{ $products->count() }} of {{ $products->total() }} products
            </span>
        </div>

        @if($products->count() > 0)

            <div class="store-prod-grid">
                @foreach($products as $product)
                    <div class="store-prod-card">

                        {{-- Image --}}
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

                        {{-- Body --}}
                        <div class="store-prod-body">
                            <div class="store-prod-title">{{ $product->title }}</div>

                            {{-- Tags --}}
                            @if($product->tags->count())
                                <div class="store-prod-tags">
                                    @foreach($product->tags->take(3) as $tag)
                                        <span class="store-prod-tag">{{ $tag->name }}</span>
                                    @endforeach
                                    @if($product->tags->count() > 3)
                                        <span class="store-prod-tag">+{{ $product->tags->count() - 3 }}</span>
                                    @endif
                                </div>
                            @endif

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

            {{-- Pagination --}}
            <div class="pagination-wrap">
                {{ $products->links('vendor.pagination.tailwind') }}
            </div>

        @else

            <div class="store-empty">
                <i class="fas fa-box-open"></i>
                <h3>No Products Found</h3>
                <p>Try adjusting your search or filter criteria.</p>
                <a href="{{ route('store.products') }}" class="store-empty-btn">
                    <i class="fas fa-sync-alt"></i> Reset Filters
                </a>
            </div>

        @endif

    </section>

</div>

@endsection