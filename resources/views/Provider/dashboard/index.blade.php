@extends('Provider.layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <div 
            x-data="{ 
                page: window.location.hash ? window.location.hash.substring(1) : 'overview',
                isTransitioning: false,
                changePage(newPage) {
                    this.isTransitioning = true;
                    setTimeout(() => {
                        this.page = newPage;
                        setTimeout(() => {
                            this.isTransitioning = false;
                        }, 50);
                    }, 150);
                }
            }"
            x-init="
                window.addEventListener('hashchange', () => { 
                    changePage(window.location.hash.substring(1)) 
                });
                $watch('page', () => {
                    window.scrollTo({top: 0, behavior: 'smooth'});
                });
            "
            class="relative min-h-screen"
        >

            <!-- صفحة Overview -->
            <div x-show="page === 'overview'" 
                 x-transition:enter="transition ease-out duration-300 transform"
                 x-transition:enter-start="opacity-0 translate-y-8"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-150 transform"
                 x-transition:leave-start="opacity-100 translate-y-0"
                 x-transition:leave-end="opacity-0 -translate-y-8">
                @include('Provider.dashboard.pages.overview')
            </div>

            <!-- صفحة Merchant Profile -->
            <div x-show="page === 'merchant-profile'" 
                 x-transition:enter="transition ease-out duration-300 transform"
                 x-transition:enter-start="opacity-0 translate-y-8"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-150 transform"
                 x-transition:leave-start="opacity-100 translate-y-0"
                 x-transition:leave-end="opacity-0 -translate-y-8">
                @include('Provider.dashboard.pages.providerProfile')
            </div>

            <!-- صفحة Smart Notifications -->
            <div x-show="page === 'smart-notifications'" 
                 x-transition:enter="transition ease-out duration-300 transform"
                 x-transition:enter-start="opacity-0 translate-y-8"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-150 transform"
                 x-transition:leave-start="opacity-100 translate-y-0"
                 x-transition:leave-end="opacity-0 -translate-y-8">
                @include('Provider.dashboard.pages.smart-notifications')
            </div>

            <!-- صفحة Dashboard -->
            <div x-show="page === 'dashboard'" 
                 x-transition:enter="transition ease-out duration-300 transform"
                 x-transition:enter-start="opacity-0 translate-y-8"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-150 transform"
                 x-transition:leave-start="opacity-100 translate-y-0"
                 x-transition:leave-end="opacity-0 -translate-y-8">
                @include('Provider.dashboard.pages.dashboard')
            </div>

            <!-- صفحة Profile -->
            <div x-show="page === 'profile'" 
                 x-transition:enter="transition ease-out duration-300 transform"
                 x-transition:enter-start="opacity-0 translate-y-8"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-150 transform"
                 x-transition:leave-start="opacity-100 translate-y-0"
                 x-transition:leave-end="opacity-0 -translate-y-8">
                @include('Provider.dashboard.pages.profile')
            </div>

            <!-- صفحة My Bookings -->
            <div x-show="page === 'my-bookings'" 
                 x-transition:enter="transition ease-out duration-300 transform"
                 x-transition:enter-start="opacity-0 translate-y-8"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-150 transform"
                 x-transition:leave-start="opacity-100 translate-y-0"
                 x-transition:leave-end="opacity-0 -translate-y-8">
                @include('Provider.dashboard.pages.my-bookings')
            </div>

            <!-- صفحة View Dates -->
            <div x-show="page === 'view-dates'" 
                 x-transition:enter="transition ease-out duration-300 transform"
                 x-transition:enter-start="opacity-0 translate-y-8"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-150 transform"
                 x-transition:leave-start="opacity-100 translate-y-0"
                 x-transition:leave-end="opacity-0 -translate-y-8">
                @include('Provider.dashboard.pages.view-dates')
            </div>

            <!-- صفحة Notifications -->
            <div x-show="page === 'notifications'" 
                 x-transition:enter="transition ease-out duration-300 transform"
                 x-transition:enter-start="opacity-0 translate-y-8"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-150 transform"
                 x-transition:leave-start="opacity-100 translate-y-0"
                 x-transition:leave-end="opacity-0 -translate-y-8">
                @include('Provider.dashboard.pages.notifications')
            </div>

            <!-- صفحة Financial Record -->
            <div x-show="page === 'financial-record'" 
                 x-transition:enter="transition ease-out duration-300 transform"
                 x-transition:enter-start="opacity-0 translate-y-8"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-150 transform"
                 x-transition:leave-start="opacity-100 translate-y-0"
                 x-transition:leave-end="opacity-0 -translate-y-8">
                @include('Provider.dashboard.pages.financial-record')
            </div>

            <!-- صفحة Rewards -->
            <div x-show="page === 'rewards'" 
                 x-transition:enter="transition ease-out duration-300 transform"
                 x-transition:enter-start="opacity-0 translate-y-8"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-150 transform"
                 x-transition:leave-start="opacity-100 translate-y-0"
                 x-transition:leave-end="opacity-0 -translate-y-8">
                @include('Provider.dashboard.pages.rewards')
            </div>

            <!-- صفحة Reviews -->
            <div x-show="page === 'reviews'" 
                 x-transition:enter="transition ease-out duration-300 transform"
                 x-transition:enter-start="opacity-0 translate-y-8"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-150 transform"
                 x-transition:leave-start="opacity-100 translate-y-0"
                 x-transition:leave-end="opacity-0 -translate-y-8">
                @include('Provider.dashboard.pages.reviews')
            </div>

            <!-- صفحة Support -->
            <div x-show="page === 'support'" 
                 x-transition:enter="transition ease-out duration-300 transform"
                 x-transition:enter-start="opacity-0 translate-y-8"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-150 transform"
                 x-transition:leave-start="opacity-100 translate-y-0"
                 x-transition:leave-end="opacity-0 -translate-y-8">
                @include('Provider.dashboard.pages.support')
            </div>

            <!-- صفحة Contracts -->
            <div x-show="page === 'contracts'" 
                 x-transition:enter="transition ease-out duration-300 transform"
                 x-transition:enter-start="opacity-0 translate-y-8"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-150 transform"
                 x-transition:leave-start="opacity-100 translate-y-0"
                 x-transition:leave-end="opacity-0 -translate-y-8">
                @include('Provider.dashboard.pages.contracts')
            </div>

            <!-- صفحة Contract Management -->
            <div x-show="page === 'contract-management'" 
                 x-transition:enter="transition ease-out duration-300 transform"
                 x-transition:enter-start="opacity-0 translate-y-8"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-150 transform"
                 x-transition:leave-start="opacity-100 translate-y-0"
                 x-transition:leave-end="opacity-0 -translate-y-8">
                @include('Provider.dashboard.pages.contract-management')
            </div>

            <!-- صفحة Contract Templates -->
            <div x-show="page === 'contract-templates'" 
                 x-transition:enter="transition ease-out duration-300 transform"
                 x-transition:enter-start="opacity-0 translate-y-8"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-150 transform"
                 x-transition:leave-start="opacity-100 translate-y-0"
                 x-transition:leave-end="opacity-0 -translate-y-8">
                @include('Provider.dashboard.pages.contract-templates')
            </div>

            <!-- صفحة Customer Reviews -->
            <div x-show="page === 'customer-reviews'" 
                 x-transition:enter="transition ease-out duration-300 transform"
                 x-transition:enter-start="opacity-0 translate-y-8"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-150 transform"
                 x-transition:leave-start="opacity-100 translate-y-0"
                 x-transition:leave-end="opacity-0 -translate-y-8">
                @include('Provider.dashboard.pages.customer-reviews')
            </div>

            <!-- صفحة Internal Evaluation -->
            <div x-show="page === 'internal-evaluation'" 
                 x-transition:enter="transition ease-out duration-300 transform"
                 x-transition:enter-start="opacity-0 translate-y-8"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-150 transform"
                 x-transition:leave-start="opacity-100 translate-y-0"
                 x-transition:leave-end="opacity-0 -translate-y-8">
                @include('Provider.dashboard.pages.internal-evaluation')
            </div>

            <!-- صفحة Performance Reports -->
            <div x-show="page === 'performance-reports'" 
                 x-transition:enter="transition ease-out duration-300 transform"
                 x-transition:enter-start="opacity-0 translate-y-8"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-150 transform"
                 x-transition:leave-start="opacity-100 translate-y-0"
                 x-transition:leave-end="opacity-0 -translate-y-8">
                @include('Provider.dashboard.pages.performance-reports')
            </div>

            <!-- صفحة AI Analytics -->
            <div x-show="page === 'ai-analytics'" 
                 x-transition:enter="transition ease-out duration-300 transform"
                 x-transition:enter-start="opacity-0 translate-y-8"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-150 transform"
                 x-transition:leave-start="opacity-100 translate-y-0"
                 x-transition:leave-end="opacity-0 -translate-y-8">
                @include('Provider.dashboard.pages.ai-analytics')
            </div>

            <!-- صفحة Team Management -->
            <div x-show="page === 'team-management'" 
                 x-transition:enter="transition ease-out duration-300 transform"
                 x-transition:enter-start="opacity-0 translate-y-8"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-150 transform"
                 x-transition:leave-start="opacity-100 translate-y-0"
                 x-transition:leave-end="opacity-0 -translate-y-8">
                @include('Provider.dashboard.pages.team-management')
            </div>

            <!-- صفحة Activity Log -->
            <div x-show="page === 'activity-log'" 
                 x-transition:enter="transition ease-out duration-300 transform"
                 x-transition:enter-start="opacity-0 translate-y-8"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-150 transform"
                 x-transition:leave-start="opacity-100 translate-y-0"
                 x-transition:leave-end="opacity-0 -translate-y-8">
                @include('Provider.dashboard.pages.activity-log')
            </div>

            <!-- صفحة Temporary Offers -->
            <div x-show="page === 'temporary-offers'" 
                 x-transition:enter="transition ease-out duration-300 transform"
                 x-transition:enter-start="opacity-0 translate-y-8"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-150 transform"
                 x-transition:leave-start="opacity-100 translate-y-0"
                 x-transition:leave-end="opacity-0 -translate-y-8">
                @include('Provider.dashboard.pages.temporary-offers')
            </div>

            <!-- صفحة Coupons -->
            <div x-show="page === 'coupons'" 
                 x-transition:enter="transition ease-out duration-300 transform"
                 x-transition:enter-start="opacity-0 translate-y-8"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-150 transform"
                 x-transition:leave-start="opacity-100 translate-y-0"
                 x-transition:leave-end="opacity-0 -translate-y-8">
                @include('Provider.dashboard.pages.coupons')
            </div>

            <!-- صفحة Dynamic Pricing -->
            <div x-show="page === 'dynamic-pricing'" 
                 x-transition:enter="transition ease-out duration-300 transform"
                 x-transition:enter-start="opacity-0 translate-y-8"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-150 transform"
                 x-transition:leave-start="opacity-100 translate-y-0"
                 x-transition:leave-end="opacity-0 -translate-y-8">
                @include('Provider.dashboard.pages.dynamic-pricing')
            </div>

            <!-- صفحة Social Media -->
            <div x-show="page === 'social-media'" 
                 x-transition:enter="transition ease-out duration-300 transform"
                 x-transition:enter-start="opacity-0 translate-y-8"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-150 transform"
                 x-transition:leave-start="opacity-100 translate-y-0"
                 x-transition:leave-end="opacity-0 -translate-y-8">
                @include('Provider.dashboard.pages.social-media')
            </div>

            <!-- صفحة Email Campaigns -->
            <div x-show="page === 'email-campaigns'" 
                 x-transition:enter="transition ease-out duration-300 transform"
                 x-transition:enter-start="opacity-0 translate-y-8"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-150 transform"
                 x-transition:leave-start="opacity-100 translate-y-0"
                 x-transition:leave-end="opacity-0 -translate-y-8">
                @include('Provider.dashboard.pages.email-campaigns')
            </div>

            <!-- صفحة Loyalty Program -->
            <div x-show="page === 'loyalty-program'" 
                 x-transition:enter="transition ease-out duration-300 transform"
                 x-transition:enter-start="opacity-0 translate-y-8"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-150 transform"
                 x-transition:leave-start="opacity-100 translate-y-0"
                 x-transition:leave-end="opacity-0 -translate-y-8">
                @include('Provider.dashboard.pages.loyalty-program')
            </div>

            <!-- صفحة Login Settings -->
            <div x-show="page === 'login-settings'" 
                 x-transition:enter="transition ease-out duration-300 transform"
                 x-transition:enter-start="opacity-0 translate-y-8"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-150 transform"
                 x-transition:leave-start="opacity-100 translate-y-0"
                 x-transition:leave-end="opacity-0 -translate-y-8">
                @include('Provider.dashboard.pages.login-settings')
            </div>

            <!-- صفحة Login History -->
            <div x-show="page === 'login-history'" 
                 x-transition:enter="transition ease-out duration-300 transform"
                 x-transition:enter-start="opacity-0 translate-y-8"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-150 transform"
                 x-transition:leave-start="opacity-100 translate-y-0"
                 x-transition:leave-end="opacity-0 -translate-y-8">
                @include('Provider.dashboard.pages.login-history')
            </div>

            <!-- صفحة Error Review -->
            <div x-show="page === 'error-review'" 
                 x-transition:enter="transition ease-out duration-300 transform"
                 x-transition:enter-start="opacity-0 translate-y-8"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-150 transform"
                 x-transition:leave-start="opacity-100 translate-y-0"
                 x-transition:leave-end="opacity-0 -translate-y-8">
                @include('Provider.dashboard.pages.error-review')
            </div>

            <!-- صفحة Help Center -->
            <div x-show="page === 'help-center'" 
                 x-transition:enter="transition ease-out duration-300 transform"
                 x-transition:enter-start="opacity-0 translate-y-8"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-150 transform"
                 x-transition:leave-start="opacity-100 translate-y-0"
                 x-transition:leave-end="opacity-0 -translate-y-8">
                @include('Provider.dashboard.pages.help-center')
            </div>

            <!-- صفحة Support Ticket -->
            <div x-show="page === 'support-ticket'" 
                 x-transition:enter="transition ease-out duration-300 transform"
                 x-transition:enter-start="opacity-0 translate-y-8"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-150 transform"
                 x-transition:leave-start="opacity-100 translate-y-0"
                 x-transition:leave-end="opacity-0 -translate-y-8">
                @include('Provider.dashboard.pages.support-ticket')
            </div>

            <!-- صفحة FAQ -->
            <div x-show="page === 'faq'" 
                 x-transition:enter="transition ease-out duration-300 transform"
                 x-transition:enter-start="opacity-0 translate-y-8"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-150 transform"
                 x-transition:leave-start="opacity-100 translate-y-0"
                 x-transition:leave-end="opacity-0 -translate-y-8">
                @include('Provider.dashboard.pages.faq')
            </div>

            <!-- صفحة Branding -->
            <div x-show="page === 'branding'" 
                 x-transition:enter="transition ease-out duration-300 transform"
                 x-transition:enter-start="opacity-0 translate-y-8"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-150 transform"
                 x-transition:leave-start="opacity-100 translate-y-0"
                 x-transition:leave-end="opacity-0 -translate-y-8">
                @include('Provider.dashboard.pages.branding')
            </div>

            <!-- صفحة Service Order -->
            <div x-show="page === 'service-order'" 
                 x-transition:enter="transition ease-out duration-300 transform"
                 x-transition:enter-start="opacity-0 translate-y-8"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-150 transform"
                 x-transition:leave-start="opacity-100 translate-y-0"
                 x-transition:leave-end="opacity-0 -translate-y-8">
                @include('Provider.dashboard.pages.service-order')
            </div>

            <!-- صفحة About Section -->
            <div x-show="page === 'about-section'" 
                 x-transition:enter="transition ease-out duration-300 transform"
                 x-transition:enter-start="opacity-0 translate-y-8"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-150 transform"
                 x-transition:leave-start="opacity-100 translate-y-0"
                 x-transition:leave-end="opacity-0 -translate-y-8">
                @include('Provider.dashboard.pages.about-section')
            </div>

            <!-- صفحة Branch Management -->
            <div x-show="page === 'branch-management'" 
                 x-transition:enter="transition ease-out duration-300 transform"
                 x-transition:enter-start="opacity-0 translate-y-8"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-150 transform"
                 x-transition:leave-start="opacity-100 translate-y-0"
                 x-transition:leave-end="opacity-0 -translate-y-8">
                @include('Provider.dashboard.pages.branch-management')
            </div>

            <!-- صفحة Check-in -->
            <div x-show="page === 'check-in'" 
                 x-transition:enter="transition ease-out duration-300 transform"
                 x-transition:enter-start="opacity-0 translate-y-8"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-150 transform"
                 x-transition:leave-start="opacity-100 translate-y-0"
                 x-transition:leave-end="opacity-0 -translate-y-8">
                @include('Provider.dashboard.pages.check-in')
            </div>

            <!-- صفحة POS System -->
            <div x-show="page === 'pos-system'" 
                 x-transition:enter="transition ease-out duration-300 transform"
                 x-transition:enter-start="opacity-0 translate-y-8"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-150 transform"
                 x-transition:leave-start="opacity-100 translate-y-0"
                 x-transition:leave-end="opacity-0 -translate-y-8">
                @include('Provider.dashboard.pages.pos-system')
            </div>

            <!-- صفحة Corporate Booking -->
            <div x-show="page === 'corporate-booking'" 
                 x-transition:enter="transition ease-out duration-300 transform"
                 x-transition:enter-start="opacity-0 translate-y-8"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-150 transform"
                 x-transition:leave-start="opacity-100 translate-y-0"
                 x-transition:leave-end="opacity-0 -translate-y-8">
                @include('Provider.dashboard.pages.corporate-booking')
            </div>

            <!-- صفحة Platform Policies -->
            <div x-show="page === 'platform-policies'" 
                 x-transition:enter="transition ease-out duration-300 transform"
                 x-transition:enter-start="opacity-0 translate-y-8"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-150 transform"
                 x-transition:leave-start="opacity-100 translate-y-0"
                 x-transition:leave-end="opacity-0 -translate-y-8">
                @include('Provider.dashboard.pages.platform-policies')
            </div>

            <!-- صفحة Languages -->
            <div x-show="page === 'languages'" 
                 x-transition:enter="transition ease-out duration-300 transform"
                 x-transition:enter-start="opacity-0 translate-y-8"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-150 transform"
                 x-transition:leave-start="opacity-100 translate-y-0"
                 x-transition:leave-end="opacity-0 -translate-y-8">
                @include('Provider.dashboard.pages.languages')
            </div>

            <!-- صفحة API Integration -->
            <div x-show="page === 'api-integration'" 
                 x-transition:enter="transition ease-out duration-300 transform"
                 x-transition:enter-start="opacity-0 translate-y-8"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-150 transform"
                 x-transition:leave-start="opacity-100 translate-y-0"
                 x-transition:leave-end="opacity-0 -translate-y-8">
                @include('Provider.dashboard.pages.api-integration')
            </div>

            <!-- صفحة Message Center -->
            <div x-show="page === 'message-center'" 
                 x-transition:enter="transition ease-out duration-300 transform"
                 x-transition:enter-start="opacity-0 translate-y-8"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-150 transform"
                 x-transition:leave-start="opacity-100 translate-y-0"
                 x-transition:leave-end="opacity-0 -translate-y-8">
                @include('Provider.dashboard.pages.message-center')
            </div>

        </div>
    </div>

@endsection