@extends('Provider.layouts.app')

@section('content')

<div class="container mx-auto px-4 py-8">
    <div x-data="{ 
        currentTab: new URLSearchParams(window.location.search).get('tab') || 'overview',
        
        init() {
            window.addEventListener('popstate', () => {
                this.currentTab = new URLSearchParams(window.location.search).get('tab') || 'overview';
            });
            
            const originalPushState = window.history.pushState;
            const originalReplaceState = window.history.replaceState;
            
            window.history.pushState = function() {
                originalPushState.apply(window.history, arguments);
                window.dispatchEvent(new Event('locationchange'));
            };
            
            window.history.replaceState = function() {
                originalReplaceState.apply(window.history, arguments);
                window.dispatchEvent(new Event('locationchange'));
            };
            
            window.addEventListener('locationchange', () => {
                this.currentTab = new URLSearchParams(window.location.search).get('tab') || 'overview';
            });
        }
    }" class="relative min-h-screen">

    @php
$storage = Storage::url('');
$provider = auth()->user()->providers()->first();
@endphp

    <div x-show="currentTab === 'overview'"
             x-transition:enter="transition ease-out duration-300 transform"
             x-transition:enter-start="opacity-0 translate-y-8"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-150 transform"
             x-transition:leave-start="opacity-100 translate-y-0"
             x-transition:leave-end="opacity-0 -translate-y-8">
            @include('Provider.dashboard.pages.overview', ['provider' => $provider, 'storage' => $storage])
        </div>

        <!-- صفحة Merchant Profile -->
        <div x-show="currentTab === 'merchant-profile'"
             x-transition:enter="transition ease-out duration-300 transform"
             x-transition:enter-start="opacity-0 translate-y-8"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-150 transform"
             x-transition:leave-start="opacity-100 translate-y-0"
             x-transition:leave-end="opacity-0 -translate-y-8">
            @include('Provider.dashboard.pages.providerProfile', ['provider' => $provider, 'storage' => $storage])        </div>

            <!-- صفحة Smart Notifications -->
            <div x-show="currentTab === 'smart-notifications'" 
                 x-transition:enter="transition ease-out duration-300 transform"
                 x-transition:enter-start="opacity-0 translate-y-8"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-150 transform"
                 x-transition:leave-start="opacity-100 translate-y-0"
                 x-transition:leave-end="opacity-0 -translate-y-8">
                @include('Provider.dashboard.pages.smart-notifications', ['provider' => $provider, 'storage' => $storage])            </div>

            <!-- صفحة Dashboard -->
            <div x-show="currentTab === 'dashboard'" 
                 x-transition:enter="transition ease-out duration-300 transform"
                 x-transition:enter-start="opacity-0 translate-y-8"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-150 transform"
                 x-transition:leave-start="opacity-100 translate-y-0"
                 x-transition:leave-end="opacity-0 -translate-y-8">
                @include('Provider.dashboard.pages.dashboard', ['provider' => $provider, 'storage' => $storage])            </div>

            <!-- صفحة Profile -->
            <div x-show="currentTab === 'profile'" 
                 x-transition:enter="transition ease-out duration-300 transform"
                 x-transition:enter-start="opacity-0 translate-y-8"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-150 transform"
                 x-transition:leave-start="opacity-100 translate-y-0"
                 x-transition:leave-end="opacity-0 -translate-y-8">
                @include('Provider.dashboard.pages.profile', ['provider' => $provider, 'storage' => $storage])            </div>

            <!-- صفحة My Bookings -->
            <div x-show="currentTab === 'my-bookings'" 
                 x-transition:enter="transition ease-out duration-300 transform"
                 x-transition:enter-start="opacity-0 translate-y-8"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-150 transform"
                 x-transition:leave-start="opacity-100 translate-y-0"
                 x-transition:leave-end="opacity-0 -translate-y-8">
                @include('Provider.dashboard.pages.my-bookings', ['provider' => $provider, 'storage' => $storage])            </div>

            <!-- صفحة View Dates -->
            <div x-show="currentTab === 'view-dates'" 
                 x-transition:enter="transition ease-out duration-300 transform"
                 x-transition:enter-start="opacity-0 translate-y-8"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-150 transform"
                 x-transition:leave-start="opacity-100 translate-y-0"
                 x-transition:leave-end="opacity-0 -translate-y-8">
                @include('Provider.dashboard.pages.view-dates', ['provider' => $provider, 'storage' => $storage])            </div>

            <!-- صفحة Notifications -->
            <div x-show="currentTab === 'notifications'" 
                 x-transition:enter="transition ease-out duration-300 transform"
                 x-transition:enter-start="opacity-0 translate-y-8"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-150 transform"
                 x-transition:leave-start="opacity-100 translate-y-0"
                 x-transition:leave-end="opacity-0 -translate-y-8">
                @include('Provider.dashboard.pages.notifications', ['provider' => $provider, 'storage' => $storage])            </div>

            <!-- صفحة Financial Record -->
            <div x-show="currentTab === 'financial-record'" 
                 x-transition:enter="transition ease-out duration-300 transform"
                 x-transition:enter-start="opacity-0 translate-y-8"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-150 transform"
                 x-transition:leave-start="opacity-100 translate-y-0"
                 x-transition:leave-end="opacity-0 -translate-y-8">
                @include('Provider.dashboard.pages.financial-record', ['provider' => $provider, 'storage' => $storage])            </div>

            <!-- صفحة Rewards -->
            <div x-show="currentTab === 'rewards'" 
                 x-transition:enter="transition ease-out duration-300 transform"
                 x-transition:enter-start="opacity-0 translate-y-8"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-150 transform"
                 x-transition:leave-start="opacity-100 translate-y-0"
                 x-transition:leave-end="opacity-0 -translate-y-8">
                @include('Provider.dashboard.pages.rewards', ['provider' => $provider, 'storage' => $storage])            </div>

            <!-- صفحة Reviews -->
            <div x-show="currentTab === 'reviews'" 
                 x-transition:enter="transition ease-out duration-300 transform"
                 x-transition:enter-start="opacity-0 translate-y-8"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-150 transform"
                 x-transition:leave-start="opacity-100 translate-y-0"
                 x-transition:leave-end="opacity-0 -translate-y-8">
                @include('Provider.dashboard.pages.reviews', ['provider' => $provider, 'storage' => $storage])            </div>

            <!-- صفحة Support -->
            <div x-show="currentTab === 'support'" 
                 x-transition:enter="transition ease-out duration-300 transform"
                 x-transition:enter-start="opacity-0 translate-y-8"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-150 transform"
                 x-transition:leave-start="opacity-100 translate-y-0"
                 x-transition:leave-end="opacity-0 -translate-y-8">
                @include('Provider.dashboard.pages.support', ['provider' => $provider, 'storage' => $storage])            </div>

            <!-- صفحة Contracts -->
            <div x-show="currentTab === 'contracts'" 
                 x-transition:enter="transition ease-out duration-300 transform"
                 x-transition:enter-start="opacity-0 translate-y-8"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-150 transform"
                 x-transition:leave-start="opacity-100 translate-y-0"
                 x-transition:leave-end="opacity-0 -translate-y-8">
                @include('Provider.dashboard.pages.contracts', ['provider' => $provider, 'storage' => $storage])            </div>

            <!-- صفحة Contract Management -->
            <div x-show="currentTab === 'contract-management'" 
                 x-transition:enter="transition ease-out duration-300 transform"
                 x-transition:enter-start="opacity-0 translate-y-8"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-150 transform"
                 x-transition:leave-start="opacity-100 translate-y-0"
                 x-transition:leave-end="opacity-0 -translate-y-8">
                @include('Provider.dashboard.pages.contract-management', ['provider' => $provider, 'storage' => $storage])            </div>

            <!-- صفحة Contract Templates -->
            <div x-show="currentTab === 'contract-templates'" 
                 x-transition:enter="transition ease-out duration-300 transform"
                 x-transition:enter-start="opacity-0 translate-y-8"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-150 transform"
                 x-transition:leave-start="opacity-100 translate-y-0"
                 x-transition:leave-end="opacity-0 -translate-y-8">
                @include('Provider.dashboard.pages.contract-templates', ['provider' => $provider, 'storage' => $storage])            </div>

            <!-- صفحة Customer Reviews -->
            <div x-show="currentTab === 'customer-reviews'" 
                 x-transition:enter="transition ease-out duration-300 transform"
                 x-transition:enter-start="opacity-0 translate-y-8"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-150 transform"
                 x-transition:leave-start="opacity-100 translate-y-0"
                 x-transition:leave-end="opacity-0 -translate-y-8">
                @include('Provider.dashboard.pages.customer-reviews', ['provider' => $provider, 'storage' => $storage])            </div>

            <!-- صفحة Internal Evaluation -->
            <div x-show="currentTab === 'internal-evaluation'" 
                 x-transition:enter="transition ease-out duration-300 transform"
                 x-transition:enter-start="opacity-0 translate-y-8"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-150 transform"
                 x-transition:leave-start="opacity-100 translate-y-0"
                 x-transition:leave-end="opacity-0 -translate-y-8">
                @include('Provider.dashboard.pages.internal-evaluation', ['provider' => $provider, 'storage' => $storage])            </div>

            <!-- صفحة Performance Reports -->
            <div x-show="currentTab === 'performance-reports'" 
                 x-transition:enter="transition ease-out duration-300 transform"
                 x-transition:enter-start="opacity-0 translate-y-8"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-150 transform"
                 x-transition:leave-start="opacity-100 translate-y-0"
                 x-transition:leave-end="opacity-0 -translate-y-8">
                @include('Provider.dashboard.pages.performance-reports', ['provider' => $provider, 'storage' => $storage])            </div>

            <!-- صفحة AI Analytics -->
            <div x-show="currentTab === 'ai-analytics'" 
                 x-transition:enter="transition ease-out duration-300 transform"
                 x-transition:enter-start="opacity-0 translate-y-8"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-150 transform"
                 x-transition:leave-start="opacity-100 translate-y-0"
                 x-transition:leave-end="opacity-0 -translate-y-8">
                @include('Provider.dashboard.pages.ai-analytics', ['provider' => $provider, 'storage' => $storage])            </div>

            <!-- صفحة Team Management -->
            <div x-show="currentTab === 'team-management'" 
                 x-transition:enter="transition ease-out duration-300 transform"
                 x-transition:enter-start="opacity-0 translate-y-8"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-150 transform"
                 x-transition:leave-start="opacity-100 translate-y-0"
                 x-transition:leave-end="opacity-0 -translate-y-8">
                @include('Provider.dashboard.pages.team-management', ['provider' => $provider, 'storage' => $storage])            </div>

            <!-- صفحة Activity Log -->
            <div x-show="currentTab === 'activity-log'" 
                 x-transition:enter="transition ease-out duration-300 transform"
                 x-transition:enter-start="opacity-0 translate-y-8"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-150 transform"
                 x-transition:leave-start="opacity-100 translate-y-0"
                 x-transition:leave-end="opacity-0 -translate-y-8">
                @include('Provider.dashboard.pages.activity-log', ['provider' => $provider, 'storage' => $storage])            </div>

            <!-- صفحة Temporary Offers -->
            <div x-show="currentTab === 'temporary-offers'" 
                 x-transition:enter="transition ease-out duration-300 transform"
                 x-transition:enter-start="opacity-0 translate-y-8"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-150 transform"
                 x-transition:leave-start="opacity-100 translate-y-0"
                 x-transition:leave-end="opacity-0 -translate-y-8">
                @include('Provider.dashboard.pages.temporary-offers', ['provider' => $provider, 'storage' => $storage])            </div>

            <!-- صفحة Coupons -->
            <div x-show="currentTab === 'coupons'" 
                 x-transition:enter="transition ease-out duration-300 transform"
                 x-transition:enter-start="opacity-0 translate-y-8"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-150 transform"
                 x-transition:leave-start="opacity-100 translate-y-0"
                 x-transition:leave-end="opacity-0 -translate-y-8">
                @include('Provider.dashboard.pages.coupons', ['provider' => $provider, 'storage' => $storage])            </div>

            <!-- صفحة Dynamic Pricing -->
            <div x-show="currentTab === 'dynamic-pricing'" 
                 x-transition:enter="transition ease-out duration-300 transform"
                 x-transition:enter-start="opacity-0 translate-y-8"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-150 transform"
                 x-transition:leave-start="opacity-100 translate-y-0"
                 x-transition:leave-end="opacity-0 -translate-y-8">
                @include('Provider.dashboard.pages.dynamic-pricing', ['provider' => $provider, 'storage' => $storage])            </div>

            <!-- صفحة Social Media -->
            <div x-show="currentTab === 'social-media'" 
                 x-transition:enter="transition ease-out duration-300 transform"
                 x-transition:enter-start="opacity-0 translate-y-8"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-150 transform"
                 x-transition:leave-start="opacity-100 translate-y-0"
                 x-transition:leave-end="opacity-0 -translate-y-8">
                @include('Provider.dashboard.pages.social-media', ['provider' => $provider, 'storage' => $storage])            </div>

            <!-- صفحة Email Campaigns -->
            <div x-show="currentTab === 'email-campaigns'" 
                 x-transition:enter="transition ease-out duration-300 transform"
                 x-transition:enter-start="opacity-0 translate-y-8"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-150 transform"
                 x-transition:leave-start="opacity-100 translate-y-0"
                 x-transition:leave-end="opacity-0 -translate-y-8">
                @include('Provider.dashboard.pages.email-campaigns', ['provider' => $provider, 'storage' => $storage])            </div>

            <!-- صفحة Loyalty Program -->
            <div x-show="currentTab === 'loyalty-program'" 
                 x-transition:enter="transition ease-out duration-300 transform"
                 x-transition:enter-start="opacity-0 translate-y-8"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-150 transform"
                 x-transition:leave-start="opacity-100 translate-y-0"
                 x-transition:leave-end="opacity-0 -translate-y-8">
                @include('Provider.dashboard.pages.loyalty-program', ['provider' => $provider, 'storage' => $storage])            </div>

            <!-- صفحة Login Settings -->
            <div x-show="currentTab === 'login-settings'" 
                 x-transition:enter="transition ease-out duration-300 transform"
                 x-transition:enter-start="opacity-0 translate-y-8"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-150 transform"
                 x-transition:leave-start="opacity-100 translate-y-0"
                 x-transition:leave-end="opacity-0 -translate-y-8">
                @include('Provider.dashboard.pages.login-settings', ['provider' => $provider, 'storage' => $storage])            </div>

            <!-- صفحة Login History -->
            <div x-show="currentTab === 'login-history'" 
                 x-transition:enter="transition ease-out duration-300 transform"
                 x-transition:enter-start="opacity-0 translate-y-8"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-150 transform"
                 x-transition:leave-start="opacity-100 translate-y-0"
                 x-transition:leave-end="opacity-0 -translate-y-8">
                @include('Provider.dashboard.pages.login-history', ['provider' => $provider, 'storage' => $storage])            </div>

            <!-- صفحة Error Review -->
            <div x-show="currentTab === 'error-review'" 
                 x-transition:enter="transition ease-out duration-300 transform"
                 x-transition:enter-start="opacity-0 translate-y-8"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-150 transform"
                 x-transition:leave-start="opacity-100 translate-y-0"
                 x-transition:leave-end="opacity-0 -translate-y-8">
                @include('Provider.dashboard.pages.error-review', ['provider' => $provider, 'storage' => $storage])            </div>

            <!-- صفحة Help Center -->
            <div x-show="currentTab === 'help-center'" 
                 x-transition:enter="transition ease-out duration-300 transform"
                 x-transition:enter-start="opacity-0 translate-y-8"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-150 transform"
                 x-transition:leave-start="opacity-100 translate-y-0"
                 x-transition:leave-end="opacity-0 -translate-y-8">
                @include('Provider.dashboard.pages.help-center', ['provider' => $provider, 'storage' => $storage])            </div>

            <!-- صفحة Support Ticket -->
            <div x-show="currentTab === 'support-ticket'" 
                 x-transition:enter="transition ease-out duration-300 transform"
                 x-transition:enter-start="opacity-0 translate-y-8"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-150 transform"
                 x-transition:leave-start="opacity-100 translate-y-0"
                 x-transition:leave-end="opacity-0 -translate-y-8">
                @include('Provider.dashboard.pages.support-ticket', ['provider' => $provider, 'storage' => $storage])            </div>

            <!-- صفحة FAQ -->
            <div x-show="currentTab === 'faq'" 
                 x-transition:enter="transition ease-out duration-300 transform"
                 x-transition:enter-start="opacity-0 translate-y-8"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-150 transform"
                 x-transition:leave-start="opacity-100 translate-y-0"
                 x-transition:leave-end="opacity-0 -translate-y-8">
                @include('Provider.dashboard.pages.faq', ['provider' => $provider, 'storage' => $storage])            </div>

            <!-- صفحة Branding -->
            <div x-show="currentTab === 'branding'" 
                 x-transition:enter="transition ease-out duration-300 transform"
                 x-transition:enter-start="opacity-0 translate-y-8"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-150 transform"
                 x-transition:leave-start="opacity-100 translate-y-0"
                 x-transition:leave-end="opacity-0 -translate-y-8">
                @include('Provider.dashboard.pages.branding', ['provider' => $provider, 'storage' => $storage])            </div>

            <!-- صفحة Service Order -->
            <div x-show="currentTab === 'service-order'" 
                 x-transition:enter="transition ease-out duration-300 transform"
                 x-transition:enter-start="opacity-0 translate-y-8"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-150 transform"
                 x-transition:leave-start="opacity-100 translate-y-0"
                 x-transition:leave-end="opacity-0 -translate-y-8">
                @include('Provider.dashboard.pages.service-order', ['provider' => $provider, 'storage' => $storage])            </div>

            <!-- صفحة About Section -->
            <div x-show="currentTab === 'about-section'" 
                 x-transition:enter="transition ease-out duration-300 transform"
                 x-transition:enter-start="opacity-0 translate-y-8"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-150 transform"
                 x-transition:leave-start="opacity-100 translate-y-0"
                 x-transition:leave-end="opacity-0 -translate-y-8">
                @include('Provider.dashboard.pages.about-section', ['provider' => $provider, 'storage' => $storage])            </div>

            <!-- صفحة Branch Management -->
            <div x-show="currentTab === 'branch-management'" 
                 x-transition:enter="transition ease-out duration-300 transform"
                 x-transition:enter-start="opacity-0 translate-y-8"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-150 transform"
                 x-transition:leave-start="opacity-100 translate-y-0"
                 x-transition:leave-end="opacity-0 -translate-y-8">
                @include('Provider.dashboard.pages.branch-management', ['provider' => $provider, 'storage' => $storage])            </div>

            <!-- صفحة Check-in -->
            <div x-show="currentTab === 'check-in'" 
                 x-transition:enter="transition ease-out duration-300 transform"
                 x-transition:enter-start="opacity-0 translate-y-8"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-150 transform"
                 x-transition:leave-start="opacity-100 translate-y-0"
                 x-transition:leave-end="opacity-0 -translate-y-8">
                @include('Provider.dashboard.pages.check-in', ['provider' => $provider, 'storage' => $storage])            </div>

            <!-- صفحة POS System -->
            <div x-show="currentTab === 'pos-system'" 
                 x-transition:enter="transition ease-out duration-300 transform"
                 x-transition:enter-start="opacity-0 translate-y-8"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-150 transform"
                 x-transition:leave-start="opacity-100 translate-y-0"
                 x-transition:leave-end="opacity-0 -translate-y-8">
                @include('Provider.dashboard.pages.pos-system', ['provider' => $provider, 'storage' => $storage])            </div>

            <!-- صفحة Corporate Booking -->
            <div x-show="currentTab === 'corporate-booking'" 
                 x-transition:enter="transition ease-out duration-300 transform"
                 x-transition:enter-start="opacity-0 translate-y-8"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-150 transform"
                 x-transition:leave-start="opacity-100 translate-y-0"
                 x-transition:leave-end="opacity-0 -translate-y-8">
                @include('Provider.dashboard.pages.corporate-booking', ['provider' => $provider, 'storage' => $storage])            </div>

            <!-- صفحة Platform Policies -->
            <div x-show="currentTab === 'platform-policies'" 
                 x-transition:enter="transition ease-out duration-300 transform"
                 x-transition:enter-start="opacity-0 translate-y-8"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-150 transform"
                 x-transition:leave-start="opacity-100 translate-y-0"
                 x-transition:leave-end="opacity-0 -translate-y-8">
                @include('Provider.dashboard.pages.platform-policies', ['provider' => $provider, 'storage' => $storage])            </div>

            <!-- صفحة Languages -->
            <div x-show="currentTab === 'languages'" 
                 x-transition:enter="transition ease-out duration-300 transform"
                 x-transition:enter-start="opacity-0 translate-y-8"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-150 transform"
                 x-transition:leave-start="opacity-100 translate-y-0"
                 x-transition:leave-end="opacity-0 -translate-y-8">
                @include('Provider.dashboard.pages.languages', ['provider' => $provider, 'storage' => $storage])            </div>

            <!-- صفحة API Integration -->
            <div x-show="currentTab === 'api-integration'" 
                 x-transition:enter="transition ease-out duration-300 transform"
                 x-transition:enter-start="opacity-0 translate-y-8"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-150 transform"
                 x-transition:leave-start="opacity-100 translate-y-0"
                 x-transition:leave-end="opacity-0 -translate-y-8">
                @include('Provider.dashboard.pages.api-integration', ['provider' => $provider, 'storage' => $storage])            </div>

            <!-- صفحة Message Center -->
            <div x-show="currentTab === 'message-center'" 
                 x-transition:enter="transition ease-out duration-300 transform"
                 x-transition:enter-start="opacity-0 translate-y-8"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-150 transform"
                 x-transition:leave-start="opacity-100 translate-y-0"
                 x-transition:leave-end="opacity-0 -translate-y-8">
                @include('Provider.dashboard.pages.message-center', ['provider' => $provider, 'storage' => $storage])            </div>

        </div>
    </div>

@endsection