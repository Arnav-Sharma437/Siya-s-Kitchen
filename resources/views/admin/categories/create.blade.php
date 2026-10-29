@extends('layouts.admin')

@section('title', 'Add New Menu Category')
@section('page_title', 'Create Menu Category')

@section('content')

<div style="margin-bottom: 1.5rem;">
    <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary btn-sm">&larr; Back to Categories</a>
</div>

<div class="card" style="max-width: 680px;">
    <div class="card-header">
        <h2 class="card-title">Category Details</h2>
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

    <form action="{{ route('admin.categories.store') }}" method="POST">
        @csrf

        <div style="margin-bottom: 1.25rem;">
            <label style="display: block; font-size: 0.85rem; font-weight: 700; margin-bottom: 0.4rem;">
                Category Name <span style="color: var(--primary);">*</span>
            </label>
            <input type="text" name="name" value="{{ old('name') }}" required placeholder="e.g. Starters & Chaats, Main Curries, Breads..."
                   style="width: 100%; padding: 0.65rem 0.85rem; border: 1px solid var(--border-color); border-radius: var(--radius-sm); font-size: 0.95rem;">
        </div>

        <div style="margin-bottom: 1.25rem;">
            <label style="display: block; font-size: 0.85rem; font-weight: 700; margin-bottom: 0.4rem;">
                Description (Optional)
            </label>
            <textarea name="description" rows="3" placeholder="Brief description of this section on the menu..."
                      style="width: 100%; padding: 0.65rem 0.85rem; border: 1px solid var(--border-color); border-radius: var(--radius-sm); font-size: 0.9rem; font-family: inherit;">{{ old('description') }}</textarea>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.25rem; margin-bottom: 1.5rem;">
            <div>
                <label style="display: block; font-size: 0.85rem; font-weight: 700; margin-bottom: 0.4rem;">
                    Display Sort Order
                </label>
                <input type="number" name="sort_order" value="{{ old('sort_order', 0) }}" min="0"
                       style="width: 100%; padding: 0.65rem 0.85rem; border: 1px solid var(--border-color); border-radius: var(--radius-sm); font-size: 0.95rem;">
            </div>

            <div style="display: flex; align-items: flex-end; padding-bottom: 0.65rem;">
                <label style="display: flex; align-items: center; gap: 0.5rem; font-size: 0.9rem; font-weight: 600; cursor: pointer;">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', '1') == '1' ? 'checked' : '' }}>
                    <span>Active on Public Menu</span>
                </label>
            </div>
        </div>

        <div style="display: flex; gap: 0.75rem; justify-content: flex-end;">
            <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">Cancel</a>
            <button type="submit" class="btn btn-primary" style="padding: 0.65rem 1.75rem;">Create Category &rarr;</button>
        </div>
    </form>
</div>

@endsection
