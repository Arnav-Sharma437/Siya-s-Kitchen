@extends('layouts.admin')

@section('title', 'Edit Category: ' . $category->name)
@section('page_title', 'Edit Menu Category')

@section('content')

<div style="margin-bottom: 1.5rem;">
    <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary btn-sm">&larr; Back to Categories</a>
</div>

<div class="card" style="max-width: 680px;">
    <div class="card-header">
        <div>
            <h2 class="card-title">Edit Category</h2>
            <div style="font-size: 0.75rem; color: var(--text-muted);">Slug: {{ $category->slug }}</div>
        </div>
        <span class="badge" style="background: {{ $category->is_active ? '#dcfce7' : '#f1f5f9' }}; color: {{ $category->is_active ? '#15803d' : '#94a3b8' }};">
            {{ $category->is_active ? 'ACTIVE' : 'INACTIVE' }}
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

    <form action="{{ route('admin.categories.update', $category) }}" method="POST">
        @csrf
        @method('PUT')

        <div style="margin-bottom: 1.25rem;">
            <label style="display: block; font-size: 0.85rem; font-weight: 700; margin-bottom: 0.4rem;">
                Category Name <span style="color: var(--primary);">*</span>
            </label>
            <input type="text" name="name" value="{{ old('name', $category->name) }}" required
                   style="width: 100%; padding: 0.65rem 0.85rem; border: 1px solid var(--border-color); border-radius: var(--radius-sm); font-size: 0.95rem;">
        </div>

        <div style="margin-bottom: 1.25rem;">
            <label style="display: block; font-size: 0.85rem; font-weight: 700; margin-bottom: 0.4rem;">
                Description (Optional)
            </label>
            <textarea name="description" rows="3"
                      style="width: 100%; padding: 0.65rem 0.85rem; border: 1px solid var(--border-color); border-radius: var(--radius-sm); font-size: 0.9rem; font-family: inherit;">{{ old('description', $category->description) }}</textarea>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.25rem; margin-bottom: 1.5rem;">
            <div>
                <label style="display: block; font-size: 0.85rem; font-weight: 700; margin-bottom: 0.4rem;">
                    Display Sort Order
                </label>
                <input type="number" name="sort_order" value="{{ old('sort_order', $category->sort_order) }}" min="0"
                       style="width: 100%; padding: 0.65rem 0.85rem; border: 1px solid var(--border-color); border-radius: var(--radius-sm); font-size: 0.95rem;">
            </div>

            <div style="display: flex; align-items: flex-end; padding-bottom: 0.65rem;">
                <label style="display: flex; align-items: center; gap: 0.5rem; font-size: 0.9rem; font-weight: 600; cursor: pointer;">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', $category->is_active) ? 'checked' : '' }}>
                    <span>Active on Public Menu</span>
                </label>
            </div>
        </div>

        <div style="display: flex; gap: 0.75rem; justify-content: flex-end;">
            <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">Cancel</a>
            <button type="submit" class="btn btn-primary" style="padding: 0.65rem 1.75rem;">Save Changes &rarr;</button>
        </div>
    </form>
</div>

@endsection
