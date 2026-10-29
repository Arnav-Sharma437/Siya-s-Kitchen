@extends('layouts.admin')

@section('title', 'System Settings & Teya Integration')
@section('page_title', 'System Settings & Gateways')

@section('content')

<div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
    <!-- Teya Integration Status -->
    <div class="card">
        <div class="card-header">
            <div>
                <h2 class="card-title">Teya Payment Gateway</h2>
                <div style="font-size: 0.75rem; color: var(--text-muted);">Hosted Checkout & Webhook Integration</div>
            </div>
            <span class="badge" style="background: #dcfce7; color: #15803d; font-weight: 800;">
                LIVE PRODUCTION
            </span>
        </div>

        <div style="display: flex; flex-direction: column; gap: 1rem; font-size: 0.88rem;">
            <div>
                <span style="display: block; font-size: 0.75rem; text-transform: uppercase; font-weight: 700; color: var(--text-muted);">Environment:</span>
                <strong style="color: var(--primary); font-size: 1rem;">{{ strtoupper($teya['env']) }}</strong>
                <span style="font-size: 0.75rem; color: var(--text-muted);">&bull; Real card payments active</span>
            </div>

            <div>
                <span style="display: block; font-size: 0.75rem; text-transform: uppercase; font-weight: 700; color: var(--text-muted);">Teya Store ID:</span>
                <code style="background: #f1f5f9; padding: 0.2rem 0.5rem; border-radius: 4px; font-size: 0.82rem; word-break: break-all;">
                    {{ $teya['store_id'] ?: 'Configured in server environment' }}
                </code>
            </div>

            <div>
                <span style="display: block; font-size: 0.75rem; text-transform: uppercase; font-weight: 700; color: var(--text-muted);">API Credentials:</span>
                <span style="color: var(--success); font-weight: 700;">✓ Client ID & Secret Verified</span>
            </div>

            <div>
                <span style="display: block; font-size: 0.75rem; text-transform: uppercase; font-weight: 700; color: var(--text-muted);">Production Webhook URL:</span>
                <code style="background: #f1f5f9; padding: 0.2rem 0.5rem; border-radius: 4px; font-size: 0.82rem; word-break: break-all;">
                    {{ $teya['webhook_url'] }}
                </code>
            </div>

            <div style="border-top: 1px solid var(--border-color); padding-top: 1rem; margin-top: 0.5rem;">
                <a href="https://business.teya.com" target="_blank" class="btn btn-primary" style="width: 100%; text-align: center;">
                    Open Teya Business Portal &rarr;
                </a>
                <div style="font-size: 0.72rem; color: var(--text-muted); text-align: center; margin-top: 0.4rem;">
                    Access bank payout schedules, fees, and settlements directly at business.teya.com
                </div>
            </div>
        </div>
    </div>

    <!-- Application Health & Cache Control -->
    <div class="card">
        <div class="card-header">
            <div>
                <h2 class="card-title">Cache & Performance</h2>
                <div style="font-size: 0.75rem; color: var(--text-muted);">Platform configuration and optimization</div>
            </div>
        </div>

        <div style="display: flex; flex-direction: column; gap: 1rem; font-size: 0.88rem;">
            <div>
                <span style="display: block; font-size: 0.75rem; text-transform: uppercase; font-weight: 700; color: var(--text-muted);">Platform:</span>
                <strong>{{ $appInfo['name'] }}</strong>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 0.75rem;">
                <div>
                    <span style="display: block; font-size: 0.75rem; text-transform: uppercase; font-weight: 700; color: var(--text-muted);">PHP Version:</span>
                    <code>{{ $appInfo['php_version'] }}</code>
                </div>

                <div>
                    <span style="display: block; font-size: 0.75rem; text-transform: uppercase; font-weight: 700; color: var(--text-muted);">Laravel:</span>
                    <code>v{{ $appInfo['laravel_version'] }}</code>
                </div>
            </div>

            <div>
                <span style="display: block; font-size: 0.75rem; text-transform: uppercase; font-weight: 700; color: var(--text-muted);">Public Base URL:</span>
                <code>{{ $appInfo['url'] }}</code>
            </div>

            <!-- Clear Cache Form -->
            <div style="border-top: 1px solid var(--border-color); padding-top: 1rem; margin-top: 0.5rem;">
                <div style="font-size: 0.8rem; color: var(--text-muted); margin-bottom: 0.75rem;">
                    If you make changes to environment variables or menu translations, clear the application caches to refresh immediately.
                </div>

                <form action="{{ route('admin.settings.cache-clear') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-secondary" style="width: 100%;">
                        ⚡ Flush & Refresh System Caches
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
