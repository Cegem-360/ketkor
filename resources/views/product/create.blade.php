<x-app-layout>
    <div class="">

        <!-- Page Heading -->
        <x-slot name="header">
            <x-button-style-link text="Add product" route="products.index">
                Back
            </x-button-style-link>
        </x-slot>
        {{-- Alert Messages --}}
        <x-alert />
        <div class="py-12">
            <div class="mx-auto max-w-7xl space-y-6 sm:px-6 lg:px-8">
                <div class="bg-white p-4 shadow sm:rounded-lg sm:p-8">
                    <div class="max-w-xl">
                        <section>
                            <header>
                                <h2 class="text-lg font-medium text-gray-900">
                                    {{ __('Product Information') }}
                                </h2>
                                <p class="mt-1 text-sm text-gray-600">
                                    {{ __('Create product.') }}
                                </p>
                            </header>
                            <form class="mt-6 space-y-6" method="POST" action="{{ route('products.store') }}">
                                @csrf
                                <div class="mb-4">
                                    <x-create-input-text name="serial_number"
                                        headText="Serial number"></x-create-input-text>
                                    <x-create-input-text name="mac" headText="MAC"></x-create-input-text>
                                    <x-radio name="access_to_wifi" headText="Access to wifi" :required="false">
                                        True,False
                                    </x-radio>
                                    <x-create-input-text name="owner_name" headText="Owner name"></x-create-input-text>
                                    <x-create-input-text name="city" headText="City"
                                        :required="false"></x-create-input-text>
                                    <x-create-input-text name="street" headText="Street"
                                        :required="false"></x-create-input-text>
                                    <x-create-input-text name="zip" headText="Zip"
                                        :required="false"></x-create-input-text>
                                    <x-create-input-text name="email" type="email" :required="false"
                                        headText="Email"></x-create-input-text>
                                    <x-create-input-text name="phone" type="phone" :required="false"
                                        headText="Phone"></x-create-input-text>

                                    <div class="basis-full">
                                        <label class="my-5 block text-left text-lg font-medium leading-6 text-gray-900"
                                            for="purchase_date"> <span
                                                style="color:red;">*</span>{{ __('Purchase date') }}</label>
                                        <div class="mt-2">
                                            <div
                                                class="flex rounded-md shadow-sm focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                                <input
                                                    class="border @error('purchase_date') border-l-danger-600 @enderror block w-full rounded border-0 p-2 py-1.5 text-2xl text-gray-900 shadow ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                                    name="purchase_date" type="date"
                                                    value="{{ !empty(old('purchase_date')) ? old('purchase_date') : '' }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="basis-full">
                                        <label class="my-5 block text-left text-lg font-medium leading-6 text-gray-900"
                                            for="installation_date"> <span
                                                style="color:red;">*</span>{{ __('Installation date') }}</label>
                                        <div class="mt-2">
                                            <div
                                                class="flex rounded-md shadow-sm focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                                <input
                                                    class="border @error('installation_date') border-l-danger-600 @enderror block w-full rounded border-0 p-2 py-1.5 text-2xl text-gray-900 shadow ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                                    name="installation_date" type="date"
                                                    value="{{ !empty(old('installation_date')) ? old('installation_date') : '' }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="basis-full">
                                        <div class="col-span-full">
                                            <label
                                                class="my-5 block text-left text-lg font-medium leading-6 text-gray-900"
                                                for="warrantee_date"> <span
                                                    style="color:red;">*</span>{{ __('Warrantee date') }}</label>
                                            <div class="mt-2">
                                                <div
                                                    class="flex rounded-md shadow-sm focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                                    <input
                                                        class="border @error('warrantee_date') border-l-danger-600 @enderror block w-full rounded border-0 p-2 py-1.5 text-2xl text-gray-900 shadow ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                                        name="warrantee_date" type="date"
                                                        value="{{ !empty(old('warrantee_date')) ? old('warrantee_date') : '' }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <x-select-input name="user_id" headText="User">
                                        @foreach ($users as $user)
                                            <x-select-input-option value="{{ $user->id }}">
                                                {{ $user->name }}
                                            </x-select-input-option>
                                        @endforeach
                                    </x-select-input>
                                    <x-select-input name="tool_id" headText="Tool">
                                        @foreach ($tools as $tool)
                                            <x-select-input-option value="{{ $tool->id }}">
                                                {{ $tool->name }}
                                            </x-select-input-option>
                                        @endforeach
                                    </x-select-input>
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
</x-app-layout>
