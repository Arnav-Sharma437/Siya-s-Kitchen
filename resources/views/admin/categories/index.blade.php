@extends('layouts.admin')

@section('title', 'Menu Categories Management')
@section('page_title', 'Menu Categories')

@section('content')

<div class="card" style="padding: 1.25rem; margin-bottom: 1.5rem;">
    <div style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 1rem;">
        <div>
            <span style="font-weight: 700; font-size: 0.95rem;">Organize Menu Structure</span>
            <div style="font-size: 0.75rem; color: var(--text-muted);">Categories group dishes on your digital ordering menu</div>
        </div>

        <div>
            <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">
                <span>+ Add New Category</span>
            </a>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h2 class="card-title">All Categories ({{ $categories->total() }})</h2>
    </div>

    @if($categories->isEmpty())
        <div style="padding: 3rem 0; text-align: center; color: var(--text-muted);">
            <div style="font-size: 2.5rem; margin-bottom: 0.5rem;">📁</div>
            <div style="font-weight: 600;">No categories created yet</div>
            <a href="{{ route('admin.categories.create') }}" class="btn btn-primary btn-sm" style="margin-top: 1rem;">+ Add Your First Category</a>
        </div>
    @else
        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse; text-align: left; font-size: 0.88rem;">
                <thead>
                    <tr style="border-bottom: 2px solid var(--border-color); color: var(--text-muted); font-size: 0.75rem; text-transform: uppercase;">
                        <th style="padding: 0.75rem 1rem;">Category Name</th>
                        <th style="padding: 0.75rem 1rem;">Description</th>
                        <th style="padding: 0.75rem 1rem; text-align: center;">Dishes Count</th>
                        <th style="padding: 0.75rem 1rem; text-align: center;">Display Order</th>
                        <th style="padding: 0.75rem 1rem; text-align: center;">Active Status</th>
                        <th style="padding: 0.75rem 1rem; text-align: right;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categories as $category)
                        <tr style="border-bottom: 1px solid var(--border-color); transition: background 0.15s;">
                            <td style="padding: 0.85rem 1rem;">
                                <div style="font-weight: 700; color: #0f172a; font-size: 0.95rem;">{{ $category->name }}</div>
                                <div style="font-size: 0.72rem; color: var(--text-muted);">{{ $category->slug }}</div>
                            </td>

                            <td style="padding: 0.85rem 1rem; color: var(--text-muted); max-width: 250px;">
                                {{ $category->description ?: 'No description provided' }}
                            </td>

                            <td style="padding: 0.85rem 1rem; text-align: center;">
                                <span class="badge" style="background: #e0f2fe; color: #0369a1; font-weight: 700;">
                                    {{ $category->menu_items_count }} dish(es)
                                </span>
                            </td>

                            <td style="padding: 0.85rem 1rem; text-align: center; font-weight: 600; color: #64748b;">
                                {{ $category->sort_order }}
                            </td>

                            <!-- Active Toggle -->
                            <td style="padding: 0.85rem 1rem; text-align: center;">
                                <form action="{{ route('admin.categories.toggle-active', $category) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-sm" style="padding: 0.2rem 0.6rem; border-radius: 9999px; font-size: 0.72rem; font-weight: 700; {{ $category->is_active ? 'background: #dcfce7; color: #15803d; border-color: #bbf7d0;' : 'background: #f1f5f9; color: #94a3b8; border-color: #e2e8f0;' }}" title="Click to toggle active">
                                        {{ $category->is_active ? '● ACTIVE' : '○ INACTIVE' }}
                                    </button>
                                </form>
                            </td>

                            <!-- Actions -->
                            <td style="padding: 0.85rem 1rem; text-align: right;">
                                <div style="display: inline-flex; gap: 0.35rem;">
                                    <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-secondary btn-sm">
                                        Edit
                                    </a>

                                    <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete \'{{ $category->name }}\'? Any associated menu items will become uncategorized.');">
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
            {{ $categories->links() }}
        </div>
    @endif
</div>

@endsection
