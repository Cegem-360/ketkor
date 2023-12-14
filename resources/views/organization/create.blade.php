<x-app-layout>
    <div class="">

        <!-- Page Heading -->
        <x-slot name="header">
            <x-button-style-link text="Create organization" route="organizations.index">
                Back
            </x-button-style-link>
        </x-slot>
        <x-alert />
        <div class="py-12">
            <div class="mx-auto max-w-7xl space-y-6 sm:px-6 lg:px-8">
                <div class="bg-white p-4 shadow sm:rounded-lg sm:p-8">
                    <div class="max-w-xl">
                        <section>
                            <header>
                                <h2 class="text-lg font-medium text-gray-900">
                                    {{ __('Organization Information') }}
                                </h2>
                                <p class="mt-1 text-sm text-gray-600">
                                    {{ __('Create organization') }}
                                </p>
                            </header>
                            <form class="mt-6 space-y-6" method="POST" action="{{ route('organizations.store') }}">
                                @csrf
                                <div class="mb-4">
                                    <x-create-input-text name="name"
                                        headText="Organization name"></x-create-input-text>
                                    <x-create-input-text name="city" headText="City"></x-create-input-text>
                                    <x-create-input-text name="address" headText="Address"></x-create-input-text>
                                    <x-create-input-text name="tax_number" headText="Tax number"></x-create-input-text>
                                    <x-create-input-text name="zip" headText="Zip"></x-create-input-text>
                                </div>
                                {{-- Save Button --}}
                                <button
                                    class="rounded bg-blue-500 px-4 py-2 text-center font-bold text-white hover:bg-blue-700 focus:outline-none sm:inline-block"
                                    type="submit">
                                    {{ __('Save') }}
                                </button>

                            </form>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
