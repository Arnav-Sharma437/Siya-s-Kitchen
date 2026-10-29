@extends('layouts.admin')

@section('title', 'Edit ' . $menuItem->name)
@section('page_title', 'Edit Menu Item: ' . $menuItem->name)

@section('content')

<div style="margin-bottom: 1.5rem;">
    <a href="{{ route('admin.menu-items.index') }}" class="btn btn-secondary btn-sm">&larr; Back to Menu List</a>
</div>

<div class="card" style="max-width: 860px;">
    <div class="card-header">
        <div>
            <h2 class="card-title">Edit Dish Details</h2>
            <div style="font-size: 0.75rem; color: var(--text-muted);">Slug: {{ $menuItem->slug }}</div>
        </div>
        <span class="badge" style="background: {{ $menuItem->is_available ? '#dcfce7' : '#fee2e2' }}; color: {{ $menuItem->is_available ? '#15803d' : '#b91c1c' }};">
            {{ $menuItem->is_available ? 'IN STOCK' : 'OUT OF STOCK' }}
        </span>
    </div>

    @if($errors->any())
        <div class="alert alert-error">
            <ul style="margin-left: 1.25rem;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.menu-items.update', $menuItem) }}" method="POST">
        @csrf
        @method('PUT')

        <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 1.25rem; margin-bottom: 1.25rem;">
            <!-- Dish Name -->
            <div>
                <label style="display: block; font-size: 0.85rem; font-weight: 700; margin-bottom: 0.4rem;">
                    Dish Name <span style="color: var(--primary);">*</span>
                </label>
                <input type="text" name="name" value="{{ old('name', $menuItem->name) }}" required
                       style="width: 100%; padding: 0.65rem 0.85rem; border: 1px solid var(--border-color); border-radius: var(--radius-sm); font-size: 0.95rem;">
            </div>

            <!-- Price in GBP -->
            <div>
                <label style="display: block; font-size: 0.85rem; font-weight: 700; margin-bottom: 0.4rem;">
                    Base Price (£) <span style="color: var(--primary);">*</span>
                </label>
                <input type="number" step="0.01" min="0" name="price" value="{{ old('price', number_format($menuItem->price / 100, 2, '.', '')) }}" required
                       style="width: 100%; padding: 0.65rem 0.85rem; border: 1px solid var(--border-color); border-radius: var(--radius-sm); font-size: 0.95rem; font-weight: 700;">
            </div>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.25rem; margin-bottom: 1.25rem;">
            <!-- Category -->
            <div>
                <label style="display: block; font-size: 0.85rem; font-weight: 700; margin-bottom: 0.4rem;">
                    Menu Category <span style="color: var(--primary);">*</span>
                </label>
                <select name="menu_category_id" required style="width: 100%; padding: 0.65rem 0.85rem; border: 1px solid var(--border-color); border-radius: var(--radius-sm); font-size: 0.95rem; background: #fff;">
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ old('menu_category_id', $menuItem->menu_category_id) == $cat->id ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Display Order -->
            <div>
                <label style="display: block; font-size: 0.85rem; font-weight: 700; margin-bottom: 0.4rem;">
                    Sort / Menu Order
                </label>
                <input type="number" name="sort_order" value="{{ old('sort_order', $menuItem->sort_order) }}" min="0"
                       style="width: 100%; padding: 0.65rem 0.85rem; border: 1px solid var(--border-color); border-radius: var(--radius-sm); font-size: 0.95rem;">
            </div>
        </div>

        <!-- Description -->
        <div style="margin-bottom: 1.25rem;">
            <label style="display: block; font-size: 0.85rem; font-weight: 700; margin-bottom: 0.4rem;">
                Dish Description
            </label>
            <textarea name="description" rows="3"
                      style="width: 100%; padding: 0.65rem 0.85rem; border: 1px solid var(--border-color); border-radius: var(--radius-sm); font-size: 0.9rem; font-family: inherit;">{{ old('description', $menuItem->description) }}</textarea>
        </div>

        <!-- Dietary Badges -->
        <div style="margin-bottom: 1.5rem; padding: 1rem; background: #f8fafc; border: 1px solid var(--border-color); border-radius: var(--radius-sm);">
            <div style="font-size: 0.85rem; font-weight: 700; margin-bottom: 0.75rem;">Dietary & Special Tags:</div>
            
            <div style="display: flex; gap: 1.5rem; flex-wrap: wrap;">
                <label style="display: flex; align-items: center; gap: 0.45rem; font-size: 0.88rem; cursor: pointer;">
                    <input type="checkbox" name="is_vegetarian" value="1" {{ old('is_vegetarian', $menuItem->is_vegetarian) ? 'checked' : '' }}>
                    <span>🌱 Vegetarian</span>
                </label>

                <label style="display: flex; align-items: center; gap: 0.45rem; font-size: 0.88rem; cursor: pointer;">
                    <input type="checkbox" name="is_vegan" value="1" {{ old('is_vegan', $menuItem->is_vegan) ? 'checked' : '' }}>
                    <span>🌿 Vegan</span>
                </label>

                <label style="display: flex; align-items: center; gap: 0.45rem; font-size: 0.88rem; cursor: pointer;">
                    <input type="checkbox" name="is_spicy" value="1" {{ old('is_spicy', $menuItem->is_spicy) ? 'checked' : '' }}>
                    <span>🌶️ Spicy</span>
                </label>

                <label style="display: flex; align-items: center; gap: 0.45rem; font-size: 0.88rem; cursor: pointer;">
                    <input type="checkbox" name="is_popular" value="1" {{ old('is_popular', $menuItem->is_popular) ? 'checked' : '' }}>
                    <span>★ Chef's Special / Popular</span>
                </label>

                <label style="display: flex; align-items: center; gap: 0.45rem; font-size: 0.88rem; cursor: pointer;">
                    <input type="checkbox" name="is_available" value="1" {{ old('is_available', $menuItem->is_available) ? 'checked' : '' }}>
                    <span style="font-weight: 700; color: #16a34a;">● Available In Kitchen</span>
                </label>
            </div>
        </div>

        <div style="display: flex; gap: 0.75rem; justify-content: flex-end;">
            <a href="{{ route('admin.menu-items.index') }}" class="btn btn-secondary">Cancel</a>
            <button type="submit" class="btn btn-primary" style="padding: 0.65rem 1.75rem;">Save Changes &rarr;</button>
        </div>
    </form>
</div>

@endsection
