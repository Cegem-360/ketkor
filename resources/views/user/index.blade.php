<x-app-layout>
    <!-- Page Heading -->
    <x-slot name="header">
        <x-button-style-link text="Users" route="users.create">New user create</x-button-style-link>
    </x-slot>
    <x-alert />
    <div class="py-12">
        <div class="mx-auto max-w-full space-y-6 sm:px-6 lg:px-8">
            <div class="bg-white p-4 shadow sm:rounded-lg sm:p-8">
                @livewire('user-admin-table')
            </div>
        </div>
    </div>

</x-app-layout>
