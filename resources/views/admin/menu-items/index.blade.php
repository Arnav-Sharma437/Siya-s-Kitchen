@extends('layouts.admin')

@section('title', 'Menu Dishes Management')
@section('page_title', 'Menu Dishes & Pricing')

@section('content')

<div class="card" style="padding: 1.25rem; margin-bottom: 1.5rem;">
    <div style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 1rem;">
        <!-- Category Filter -->
        <form action="{{ route('admin.menu-items.index') }}" method="GET" style="display: flex; gap: 0.75rem; align-items: center; flex-wrap: wrap;">
            <div>
                <select name="category_id" onchange="this.form.submit()" style="padding: 0.55rem 0.85rem; border: 1px solid var(--border-color); border-radius: var(--radius-sm); font-size: 0.88rem; background: #fff;">
                    <option value="">All Categories ({{ $categories->count() }})</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            @if(request('category_id'))
                <a href="{{ route('admin.menu-items.index') }}" class="btn btn-secondary btn-sm">Clear Filter</a>
            @endif
        </form>

        <!-- Add Dish Button -->
        <div>
            <a href="{{ route('admin.menu-items.create') }}" class="btn btn-primary">
                <span>+ Add New Dish</span>
            </a>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <div>
            <h2 class="card-title">All Menu Items ({{ $items->total() }})</h2>
            <div style="font-size: 0.75rem; color: var(--text-muted);">Manage dishes, update prices, and control real-time kitchen availability</div>
        </div>
    </div>

    @if($items->isEmpty())
        <div style="padding: 3rem 0; text-align: center; color: var(--text-muted);">
            <div style="font-size: 2.5rem; margin-bottom: 0.5rem;">🍲</div>
            <div style="font-weight: 600;">No dishes found</div>
            <p style="font-size: 0.85rem; margin-top: 0.25rem;">Create dishes or choose a different category filter.</p>
            <a href="{{ route('admin.menu-items.create') }}" class="btn btn-primary btn-sm" style="margin-top: 1rem;">+ Add Your First Dish</a>
        </div>
    @else
        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse; text-align: left; font-size: 0.88rem;">
                <thead>
                    <tr style="border-bottom: 2px solid var(--border-color); color: var(--text-muted); font-size: 0.75rem; text-transform: uppercase;">
                        <th style="padding: 0.75rem 1rem;">Dish</th>
                        <th style="padding: 0.75rem 1rem;">Category</th>
                        <th style="padding: 0.75rem 1rem;">Base Price</th>
                        <th style="padding: 0.75rem 1rem;">Dietary / Tags</th>
                        <th style="padding: 0.75rem 1rem; text-align: center;">Popular</th>
                        <th style="padding: 0.75rem 1rem; text-align: center;">Stock Status</th>
                        <th style="padding: 0.75rem 1rem; text-align: right;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($items as $item)
                        <tr style="border-bottom: 1px solid var(--border-color); transition: background 0.15s;">
                            <!-- Dish Name & Extras -->
                            <td style="padding: 0.85rem 1rem;">
                                <div style="font-weight: 700; color: #0f172a; font-size: 0.95rem;">{{ $item->name }}</div>
                                <div style="font-size: 0.72rem; color: var(--text-muted);">
                                    {{ $item->variations->count() }} variation(s) &bull; {{ $item->addons->count() }} addon(s)
                                </div>
                            </td>

                            <!-- Category -->
                            <td style="padding: 0.85rem 1rem;">
                                <span class="badge" style="background: #f1f5f9; color: #334155;">
                                    {{ $item->category->name ?? 'Uncategorized' }}
                                </span>
                            </td>

                            <!-- Price -->
                            <td style="padding: 0.85rem 1rem; font-weight: 800; color: var(--primary);">
                                {{ $item->formatted_price }}
                            </td>

                            <!-- Dietary Badges -->
                            <td style="padding: 0.85rem 1rem;">
                                <div style="display: flex; gap: 0.25rem; flex-wrap: wrap;">
                                    @if($item->is_vegetarian)
                                        <span class="badge" style="background: #ecfdf5; color: #065f46; font-size: 0.65rem;">Veg</span>
                                    @endif
                                    @if($item->is_vegan)
                                        <span class="badge" style="background: #f0fdf4; color: #166534; font-size: 0.65rem;">Vegan</span>
                                    @endif
                                    @if($item->is_spicy)
                                        <span class="badge" style="background: #fef2f2; color: #991b1b; font-size: 0.65rem;">Spicy</span>
                                    @endif
                                </div>
                            </td>

                            <!-- Popular Toggle Button -->
                            <td style="padding: 0.85rem 1rem; text-align: center;">
                                <form action="{{ route('admin.menu-items.toggle-popular', $item) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-sm" style="padding: 0.2rem 0.5rem; border-radius: 9999px; font-size: 0.72rem; {{ $item->is_popular ? 'background: #fef3c7; color: #b45309; border-color: #fde68a;' : 'background: #f8fafc; color: #94a3b8; border-color: #e2e8f0;' }}" title="Click to toggle Popular">
                                        {{ $item->is_popular ? '★ Popular' : '☆ Standard' }}
                                    </button>
                                </form>
                            </td>

                            <!-- In Stock / Out of Stock Toggle Button -->
                            <td style="padding: 0.85rem 1rem; text-align: center;">
                                <form action="{{ route('admin.menu-items.toggle-availability', $item) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-sm" style="padding: 0.25rem 0.65rem; border-radius: 9999px; font-size: 0.72rem; font-weight: 700; {{ $item->is_available ? 'background: #dcfce7; color: #15803d; border-color: #bbf7d0;' : 'background: #fee2e2; color: #b91c1c; border-color: #fecaca;' }}" title="Click to toggle stock status">
                                        {{ $item->is_available ? '● IN STOCK' : '✕ OUT OF STOCK' }}
                                    </button>
                                </form>
                            </td>

                            <!-- Actions -->
                            <td style="padding: 0.85rem 1rem; text-align: right;">
                                <div style="display: inline-flex; gap: 0.35rem;">
                                    <a href="{{ route('admin.menu-items.edit', $item) }}" class="btn btn-secondary btn-sm" title="Edit Dish">
                                        Edit
                                    </a>

                                    <form action="{{ route('admin.menu-items.destroy', $item) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete \'{{ $item->name }}\'?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm" style="background: rgba(239, 68, 68, 0.1); color: #ef4444; border: 1px solid rgba(239, 68, 68, 0.2);" title="Delete">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div style="margin-top: 1.5rem;">
            {{ $items->links() }}
        </div>
    @endif
</div>

@endsection
