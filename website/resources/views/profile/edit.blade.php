<x-app-layout>
    <x-slot name="header">
        <h2 class="font-extrabold text-2xl text-slate-900 dark:text-white uppercase tracking-tight">
            {{ __('Profile Settings') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            <div class="premium-card !p-10 border-none bg-white dark:bg-[#1e293b] shadow-xl dark:shadow-black/30 w-full">
                <div class="max-w-3xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            @if(auth()->user()->role !== 'staff')
                <div class="premium-card !p-10 border-none bg-white dark:bg-[#1e293b] shadow-xl dark:shadow-black/30 w-full">
                    <div class="max-w-3xl">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
