<?php

use function Livewire\Volt\{state, rules, layout, on};
use App\Models\Providers;
use Illuminate\Support\Str;

layout('layouts.guest');

state([
    'businessName' => '',
    'serviceType'  => '',
    'otherService' => '',
    'crNumber'     => '',
    'city'         => '',
]);

rules([
    'businessName' => 'required|string|min:3|max:255|unique:providers,name',
    'serviceType'  => 'required|string',
    'otherService' => 'required_if:serviceType,other|string|min:2|max:255',
    'crNumber'     => 'required|string|min:5|max:20|unique:providers,cr_number',
    'city'         => 'required|string',
]);

$showOtherService = function() {
    return $this->serviceType === 'other';
};

$updatedServiceType = function($value) {
    if ($value !== 'other') {
        $this->otherService = '';
    }
};

$submit = function () {
    $this->validate();

    $serviceValue = $this->serviceType === 'other' ? $this->otherService : $this->serviceType;

    //dd($this->businessName, $serviceValue, $this->crNumber, $this->city);
    Providers::create([
        'owner_id'     => auth()->id(),
        'name'         => $this->businessName,
        'slug'         => Str::slug($this->businessName),
        'email'        => auth()->user()->email,
        'cr_number'    => $this->crNumber,
        'service_type' => $serviceValue,
        'city'         => $this->city,
        'status'       => 'active',
    ]);

    return redirect()->route('provider.Dashboard.overview');
};
?>

<div class="min-h-screen bg-slate-50 flex items-center justify-center py-12 px-4" dir="rtl">
    <div class="max-w-2xl w-full">
        <div class="border border-slate-200 bg-white text-slate-900 shadow-2xl rounded-2xl p-8">
            <h3 class="text-2xl font-bold mb-4 text-center">انضم كمزود خدمة</h3>

            <form wire:submit="submit" class="space-y-4">

                <!-- اسم النشاط التجاري -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">اسم النشاط التجاري</label>
                    <input type="text" wire:model="businessName"
                        class="w-full rounded-lg border px-3 py-2 @error('businessName') border-red-500 @enderror" required>
                    @error('businessName')
                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <!-- نوع الخدمة -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">نوع الخدمة المقدمة</label>
                    <select wire:model.live="serviceType"
                        class="w-full rounded-lg border px-3 py-2 @error('serviceType') border-red-500 @enderror" required>
                        <option value="">اختر نوع خدمتك</option>
                        <option value="venue">قاعات وقصور</option>
                        <option value="catering">إعاشة وبوفيه</option>
                        <option value="photography">تصوير وفيديو</option>
                        <option value="other">أخرى</option>
                    </select>
                    @error('serviceType')
                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                    @enderror

                    @if($this->showOtherService())
                        <input type="text" wire:model="otherService" placeholder="اكتب نوع خدمتك"
                            class="w-full mt-2 rounded-lg border px-3 py-2 @error('otherService') border-red-500 @enderror" required>
                        @error('otherService')
                            <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                        @enderror
                    @endif
                </div>

                <!-- رقم السجل التجاري -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">رقم السجل التجاري</label>
                    <input type="text" wire:model="crNumber"
                        class="w-full rounded-lg border px-3 py-2 @error('crNumber') border-red-500 @enderror" required>
                    @error('crNumber')
                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <!-- المدينة -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">المدينة</label>
                    <select wire:model="city" class="w-full rounded-lg border px-3 py-2 @error('city') border-red-500 @enderror" required>
                        <option value="">اختر المدينة</option>
                        <option value="riyadh">الرياض</option>
                        <option value="jeddah">جدة</option>
                        <option value="dammam">الدمام</option>
                        <option value="other_city">مدينة أخرى</option>
                    </select>
                    @error('city')
                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <div class="text-right mt-4">
                    <button type="submit" class="bg-primary hover:bg-primary/90 text-white px-6 py-2 rounded-lg font-semibold shadow-md transition">
                        التالي
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>