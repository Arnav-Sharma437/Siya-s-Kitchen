@extends('layouts.app')

@section('title', "Payment Incomplete #{$order->order_number} | Siya's Kitchen")

@section('content')
<section class="section-padding" style="padding-top: 100px; padding-bottom: 80px; min-height: 70vh;">
    <div class="container" style="max-width: 600px; margin: 0 auto; padding: 0 1rem;">
        <div style="background: var(--bg-card, #ffffff); border-radius: 16px; padding: 2.5rem 2rem; box-shadow: 0 10px 30px rgba(0,0,0,0.06); border: 1px solid rgba(0,0,0,0.08); text-align: center;">
            
            <!-- Warning/Cancel Icon -->
            <div style="width: 72px; height: 72px; background: rgba(239, 68, 68, 0.1); color: #dc2626; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.5rem;">
                <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
            </div>

            <span style="font-size: 0.85rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.08em; color: #dc2626; background: rgba(239, 68, 68, 0.08); padding: 4px 12px; border-radius: 9999px;">
                @if($isFailed)
                    Payment Unsuccessful
                @else
                    Checkout Cancelled
                @endif
            </span>

            <h1 style="font-family: var(--font-heading, 'Fraunces', serif); font-size: 2rem; margin: 1rem 0 0.5rem; color: var(--text-primary, #1e293b);">
                @if($isFailed)
                    We Couldn't Process Your Payment
                @else
                    Your Order Was Not Completed
                @endif
            </h1>

            <p style="color: var(--text-secondary, #64748b); font-size: 1.05rem; margin-bottom: 2rem;">
                @if($isFailed)
                    The card transaction was declined or interrupted. No charges have been deducted from your account. You can review your basket and try again.
                @else
                    You cancelled the payment on the hosted checkout page. Your dishes remain safely in your basket.
                @endif
            </p>

            <div style="background: #f8fafc; border-radius: 12px; padding: 1rem 1.25rem; text-align: left; margin-bottom: 2rem; border: 1px solid #e2e8f0;">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.5rem;">
                    <span style="color: #64748b; font-size: 0.9rem;">Order Reference</span>
                    <span style="font-weight: 600; font-family: monospace; color: #0f172a;">{{ $order->order_number }}</span>
                </div>
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <span style="color: #64748b; font-size: 0.9rem;">Amount</span>
                    <span style="font-weight: 700; color: #0f172a;">{{ $order->formatted_total }}</span>
                </div>
            </div>

            <div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
                <a href="{{ route('menu') }}" class="btn btn-primary" style="padding: 12px 28px;">
                    Return to Menu & Basket
                </a>
                <a href="{{ route('contact') }}" class="btn btn-secondary" style="padding: 12px 28px;">
                    Need Help? Contact Us
                </a>
            </div>

        </div>
    </div>
</section>
@endsection
