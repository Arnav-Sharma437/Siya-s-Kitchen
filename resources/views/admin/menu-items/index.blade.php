@extends('layouts.app')

@section('title', 'Menu Items Management - Admin')

@section('content')
<section class="section-padding" style="padding-top: 8.5rem;">
    <div class="container">
        <div class="section-header">
            <div>
                <div class="section-eyebrow">Admin Management Foundation</div>
                <h1 class="section-title">Menu Items</h1>
            </div>
            <div style="display: flex; gap: 0.75rem;">
                <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">Manage Categories</a>
                <a href="{{ route('menu') }}" class="btn btn-secondary">&larr; Public Menu</a>
            </div>
        </div>

        <div style="background: #fff; border-radius: var(--radius-md); padding: 1.5rem; box-shadow: var(--shadow-sm); overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse; text-align: left;">
                <thead>
                    <tr style="border-bottom: 2px solid var(--border-subtle);">
                        <th style="padding: 0.75rem;">Item</th>
                        <th style="padding: 0.75rem;">Category</th>
                        <th style="padding: 0.75rem;">Price</th>
                        <th style="padding: 0.75rem;">Dietary</th>
                        <th style="padding: 0.75rem;">Customizations</th>
                        <th style="padding: 0.75rem;">Availability</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($items as $item)
                    <tr style="border-bottom: 1px solid var(--border-subtle);">
                        <td style="padding: 0.75rem;">
                            <div style="font-weight: 600;">{{ $item->name }}</div>
                            <div style="font-size: 0.78rem; color: var(--text-muted);">{{ $item->slug }}</div>
                        </td>
                        <td style="padding: 0.75rem;">{{ $item->category->name ?? 'Uncategorized' }}</td>
                        <td style="padding: 0.75rem; font-weight: 600; color: var(--primary-terracotta);">{{ $item->formatted_price }}</td>
                        <td style="padding: 0.75rem;">
                            <div style="display:flex; gap:0.25rem; flex-wrap:wrap;">
                                @if($item->is_vegetarian) <span class="diet-badge veg">Veg</span> @endif
                                @if($item->is_vegan) <span class="diet-badge vegan">Vegan</span> @endif
                                @if($item->is_spicy) <span class="diet-badge spicy">Spicy</span> @endif
                            </div>
                        </td>
                        <td style="padding: 0.75rem; font-size: 0.8rem; color: var(--text-muted);">
                            {{ $item->variations->count() }} Variations, {{ $item->addons->count() }} Extras
                        </td>
                        <td style="padding: 0.75rem;">
                            <span class="diet-badge {{ $item->is_available ? 'veg' : 'spicy' }}">
                                {{ $item->is_available ? 'Available' : 'Unavailable' }}
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" style="padding: 1.5rem; text-align: center; color: var(--text-muted);">No menu items found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</section>
@endsection
