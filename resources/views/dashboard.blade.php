<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Dashboard') }}
            </h2>
            <a href="{{ route('facilities.index') }}" class="btn btn-primary">
                List
            </a>
        </div>
    </x-slot>

    {{-- ✅ Dashboard content area --}}
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}

                    {{-- Profile + Password --}}
                    <div class="mt-4 flex space-x-2">
                        <a href="{{ route('profile.edit') }}" class="btn btn-primary">
                            {{ __('Edit Profile') }}
                        </a>

                        <a href="{{ route('profile.edit') }}#update-password" class="btn btn-secondary">
                            {{ __('Change Password') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
