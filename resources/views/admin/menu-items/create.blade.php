@extends('layouts.admin')

@section('title', 'Add New Menu Item')
@section('page_title', 'Create New Menu Item')

@section('content')

<div style="margin-bottom: 1.5rem;">
    <a href="{{ route('admin.menu-items.index') }}" class="btn btn-secondary btn-sm">&larr; Back to Menu List</a>
</div>

<div class="card" style="max-width: 860px;">
    <div class="card-header">
        <h2 class="card-title">Dish Details & Pricing</h2>
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

    <form action="{{ route('admin.menu-items.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Dish Image Upload & Preview -->
        <div style="margin-bottom: 1.5rem; padding: 1.25rem; background: #fafaf9; border: 1px solid var(--border-color); border-radius: var(--radius-sm);">
            <label style="display: block; font-size: 0.88rem; font-weight: 700; margin-bottom: 0.6rem; color: #1e293b;">
                Dish Photo / Menu Image
            </label>
            <div style="display: flex; gap: 1.25rem; align-items: center; flex-wrap: wrap;">
                <div style="position: relative; width: 120px; height: 90px; border-radius: 8px; overflow: hidden; border: 2px dashed var(--border-color); background: #f1f5f9; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                    <img id="dish-preview-img" src="{{ asset('images/about/about-interior.jpg') }}" alt="Preview" style="width: 100%; height: 100%; object-fit: cover; display: none;">
                    <div id="dish-preview-placeholder" style="font-size: 0.72rem; color: #94a3b8; text-align: center; padding: 0.5rem;">
                        No Image Selected
                    </div>
                </div>

                <div style="flex: 1; min-width: 240px;">
                    <div style="font-size: 0.8rem; color: var(--text-muted); margin-bottom: 0.5rem;">
                        Upload a photo for this new dish (PNG, JPG, WEBP - Max 10MB). Agar upload nahi karoge to category & dish name ke hisaab se automatic photo set ho jayegi:
                    </div>
                    <input type="file" name="image_file" id="image-file-input" accept="image/*" onchange="previewSelectedImage(event)"
                           style="display: block; width: 100%; font-size: 0.85rem; padding: 0.4rem 0;">
                </div>
            </div>
        </div>

        <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 1.25rem; margin-bottom: 1.25rem;">
            <!-- Dish Name -->
            <div>
                <label style="display: block; font-size: 0.85rem; font-weight: 700; margin-bottom: 0.4rem;">
                    Dish Name <span style="color: var(--primary);">*</span>
                </label>
                <input type="text" name="name" value="{{ old('name') }}" required placeholder="e.g. Butter Chicken Masala"
                       style="width: 100%; padding: 0.65rem 0.85rem; border: 1px solid var(--border-color); border-radius: var(--radius-sm); font-size: 0.95rem;">
            </div>

            <!-- Price in GBP -->
            <div>
                <label style="display: block; font-size: 0.85rem; font-weight: 700; margin-bottom: 0.4rem;">
                    Base Price (£) <span style="color: var(--primary);">*</span>
                </label>
                <input type="number" step="0.01" min="0" name="price" value="{{ old('price') }}" required placeholder="e.g. 12.95"
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
                    <option value="">Select Category...</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ old('menu_category_id') == $cat->id ? 'selected' : '' }}>
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
                <input type="number" name="sort_order" value="{{ old('sort_order', 0) }}" min="0"
                       style="width: 100%; padding: 0.65rem 0.85rem; border: 1px solid var(--border-color); border-radius: var(--radius-sm); font-size: 0.95rem;">
            </div>
        </div>

        <!-- Description -->
        <div style="margin-bottom: 1.25rem;">
            <label style="display: block; font-size: 0.85rem; font-weight: 700; margin-bottom: 0.4rem;">
                Dish Description
            </label>
            <textarea name="description" rows="3" placeholder="Describe the ingredients, flavors, and preparation..."
                      style="width: 100%; padding: 0.65rem 0.85rem; border: 1px solid var(--border-color); border-radius: var(--radius-sm); font-size: 0.9rem; font-family: inherit;">{{ old('description') }}</textarea>
        </div>

        <!-- Dietary Badges -->
        <div style="margin-bottom: 1.5rem; padding: 1rem; background: #f8fafc; border: 1px solid var(--border-color); border-radius: var(--radius-sm);">
            <div style="font-size: 0.85rem; font-weight: 700; margin-bottom: 0.75rem;">Dietary & Special Tags:</div>
            
            <div style="display: flex; gap: 1.5rem; flex-wrap: wrap;">
                <label style="display: flex; align-items: center; gap: 0.45rem; font-size: 0.88rem; cursor: pointer;">
                    <input type="checkbox" name="is_vegetarian" value="1" {{ old('is_vegetarian') ? 'checked' : '' }}>
                    <span>🌱 Vegetarian</span>
                </label>

                <label style="display: flex; align-items: center; gap: 0.45rem; font-size: 0.88rem; cursor: pointer;">
                    <input type="checkbox" name="is_vegan" value="1" {{ old('is_vegan') ? 'checked' : '' }}>
                    <span>🌿 Vegan</span>
                </label>

                <label style="display: flex; align-items: center; gap: 0.45rem; font-size: 0.88rem; cursor: pointer;">
                    <input type="checkbox" name="is_spicy" value="1" {{ old('is_spicy') ? 'checked' : '' }}>
                    <span>🌶️ Spicy</span>
                </label>

                <label style="display: flex; align-items: center; gap: 0.45rem; font-size: 0.88rem; cursor: pointer;">
                    <input type="checkbox" name="is_popular" value="1" {{ old('is_popular') ? 'checked' : '' }}>
                    <span>★ Chef's Special / Popular</span>
                </label>

                <label style="display: flex; align-items: center; gap: 0.45rem; font-size: 0.88rem; cursor: pointer;">
                    <input type="checkbox" name="is_available" value="1" {{ old('is_available', '1') == '1' ? 'checked' : '' }}>
                    <span style="font-weight: 700; color: #16a34a;">● Available In Kitchen</span>
                </label>
            </div>
        </div>

        <div style="display: flex; gap: 0.75rem; justify-content: flex-end;">
            <a href="{{ route('admin.menu-items.index') }}" class="btn btn-secondary">Cancel</a>
            <button type="submit" class="btn btn-primary" style="padding: 0.65rem 1.75rem;">Create Dish &rarr;</button>
        </div>
    </form>
</div>

<script>
function previewSelectedImage(event) {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const img = document.getElementById('dish-preview-img');
            const ph = document.getElementById('dish-preview-placeholder');
            img.src = e.target.result;
            img.style.display = 'block';
            if (ph) ph.style.display = 'none';
        };
        reader.readAsDataURL(file);
    }
}
</script>

@endsection
