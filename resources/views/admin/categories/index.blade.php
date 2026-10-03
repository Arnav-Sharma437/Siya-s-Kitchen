@extends('layouts.app')

@section('title', 'Menu Categories Management - Admin')

@section('content')
<section class="section-padding" style="padding-top: 8.5rem;">
    <div class="container">
        <div class="section-header">
            <div>
                <div class="section-eyebrow">Admin Management Foundation</div>
                <h1 class="section-title">Menu Categories</h1>
            </div>
            <a href="{{ route('menu') }}" class="btn btn-secondary">&larr; View Public Menu</a>
        </div>

        <div style="background: #fff; border-radius: var(--radius-md); padding: 1.5rem; box-shadow: var(--shadow-sm); overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse; text-align: left;">
                <thead>
                    <tr style="border-bottom: 2px solid var(--border-subtle);">
                        <th style="padding: 0.75rem;">Name</th>
                        <th style="padding: 0.75rem;">Slug</th>
                        <th style="padding: 0.75rem;">Items Count</th>
                        <th style="padding: 0.75rem;">Sort Order</th>
                        <th style="padding: 0.75rem;">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($categories as $category)
                    <tr style="border-bottom: 1px solid var(--border-subtle);">
                        <td style="padding: 0.75rem; font-weight: 600;">{{ $category->name }}</td>
                        <td style="padding: 0.75rem; color: var(--text-muted);">{{ $category->slug }}</td>
                        <td style="padding: 0.75rem;">{{ $category->menu_items_count }}</td>
                        <td style="padding: 0.75rem;">{{ $category->sort_order }}</td>
                        <td style="padding: 0.75rem;">
                            <span class="diet-badge {{ $category->is_active ? 'veg' : 'spicy' }}">
                                {{ $category->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" style="padding: 1.5rem; text-align: center; color: var(--text-muted);">No categories found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</section>
@endsection
