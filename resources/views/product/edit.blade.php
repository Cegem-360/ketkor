<x-app-layout>
    <div class="">
        <!-- Page Heading -->
        <x-slot name="header">
            @role('Admin|Operator')
                <x-button-style-link text="Edit product" route="products.index">
                    Back
                </x-button-style-link>
            @else
                <x-button-style-link text="Edit product" route="products.myproducts">
                    Back
                </x-button-style-link>
            @endrole
        </x-slot>
        {{-- Alert Messages --}}
        <x-alert />
        <div class="py-12">
            <div class="mx-auto max-w-7xl space-y-6 sm:px-6 lg:px-8">
                <div class="bg-white p-4 shadow sm:rounded-lg sm:p-8">
                    <div class="max-w-4xl">
                        <section>
                            <header>
                                <h2 class="text-lg font-medium text-gray-900">
                                    {{ __('Product Information') }}
                                </h2>
                                <p class="mt-1 text-sm text-gray-600">
                                    {{ __("Update product's informations.") }}
                                </p>
                            </header>
                            <form class="mt-6 space-y-6" method="POST"
                                action="{{ route('products.update', ['product' => $product->id]) }}">
                                @csrf
                                @method('PUT')
                                <div class="mb-4">
                                    @role('Organizer|Servicer')
                                        <x-create-input-text name="serial_number" headText="Serial number"
                                            :disabled="true">
                                            {{ $product->serial_number }}
                                        </x-create-input-text>
                                        <x-create-input-text name="mac" headText="MAC" :required="false">
                                            {{ $product->mac }}
                                        </x-create-input-text>
                                        <x-radio name="access_to_wifi" headText="Access to wifi" :required="false"
                                            :product="$product">
                                            True,False
                                        </x-radio>
                                        <x-create-input-text name="city" headText="City" :type="!$userVisibility ?? 'hidden'"
                                            :required="false">
                                            {{ $product->city }}
                                        </x-create-input-text>

                                        <x-create-input-text name="street" headText="Street" :type="!$userVisibility ?? 'hidden'"
                                            :required="false">
                                            {{ $product->street }}
                                        </x-create-input-text>

                                        <x-create-input-text name="zip" headText="Zip" :type="!$userVisibility ?? 'hidden'"
                                            :required="false">
                                            {{ $product->zip }}
                                        </x-create-input-text>
                                    @endrole
                                    @role('Admin|Operator')
                                        <x-create-input-text name="serial_number" headText="Serial number">
                                            {{ $product->serial_number }}
                                        </x-create-input-text>
                                        <x-create-input-text name="mac" headText="MAC" :required="false">
                                            {{ $product->mac }}
                                        </x-create-input-text>
                                        <x-radio name="access_to_wifi" headText="Access to wifi" :required="false"
                                            :product="$product">
                                            True,False
                                        </x-radio>
                                        <x-create-input-text name="city" headText="City" :disabled="!$userVisibility"
                                            :required="false">
                                            {{ $product->city }}
                                        </x-create-input-text>
                                        <x-create-input-text name="street" headText="Street" :disabled="!$userVisibility"
                                            :required="false">
                                            {{ $product->street }}
                                        </x-create-input-text>
                                        <x-create-input-text name="zip" headText="Zip" :disabled="!$userVisibility"
                                            :required="false">
                                            {{ $product->zip }}
                                        </x-create-input-text>
                                    @endrole
                                    <x-create-input-text name="owner_name" :disabled="Auth::user()->hasAnyRole('Organizer', 'Servicer') ?? false" headText="Owner name"
                                        :type="!$userVisibility ?? 'hidden'">
                                        {{ $product->owner_name }}
                                    </x-create-input-text>

                                    <div class="basis-full">
                                        <div class="col-span-full">
                                            <label
                                                class="my-5 block text-left text-sm font-medium leading-6 text-gray-900"
                                                for="purchase_date">
                                                <span style="color:red;">*</span>{{ __('Purchase date') }}</label>
                                            <div class="mt-2">
                                                <div
                                                    class="flex rounded-md shadow-sm focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                                    <input
                                                        class="@error('purchase_date') border-l-danger-600 @enderror block w-full rounded border-0 p-2 py-1.5 text-2xl text-gray-900 shadow ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                                        name="purchase_date" type="date"
                                                        value="{{ $product->serializeDate($product->purchase_date) }}"
                                                        @hasrole('Organizer|Servicer'){!! 'readonly ' !!} @endhasrole>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="basis-full">
                                        <div class="col-span-full">
                                            <label
                                                class="my-5 block text-left text-sm font-medium leading-6 text-gray-900"
                                                for="installation_date">
                                                <span style="color:red;">*</span>
                                                {{ __('Installation date') }}
                                            </label>
                                            <div class="mt-2">
                                                <div
                                                    class="flex rounded-md shadow-sm focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                                    <input
                                                        class="@error('installation_date') border-l-danger-600 @enderror block w-full rounded border-0 p-2 py-1.5 text-2xl text-gray-900 shadow ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                                        name="installation_date" type="date"
                                                        value="{{ $product->serializeDate($product->installation_date) }}"
                                                        @hasrole('Organizer|Servicer'){!! 'readonly ' !!} @endhasrole>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="basis-full">
                                        <div class="col-span-full">
                                            <label
                                                class="my-5 block text-left text-sm font-medium leading-6 text-gray-900"
                                                for="purchase_date">
                                                <span style="color:red;">*</span>
                                                {{ __('Warrantee date') }}
                                            </label>
                                            <div class="mt-2">
                                                <div
                                                    class="flex rounded-md shadow-sm focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                                    <input
                                                        class="@error('warrantee_date') border-l-danger-600 @enderror block w-full rounded border-0 p-2 py-1.5 text-2xl text-gray-900 shadow ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                                        name="warrantee_date" type="date"
                                                        value="{{ $product->serializeDate($product->warrantee_date) }}"
                                                        @hasrole('Organizer|Servicer'){!! 'readonly ' !!} @endhasrole>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="@role('Servicer|Organizer')hidden @endrole basis-full">
                                        <div class="col-span-full">
                                            <table class="w-full table-auto border-collapse text-sm">
                                                <tbody class="dark:bg-slate-800 bg-white">
                                                    @foreach ($product->users as $user)
                                                        <div class="mb-[0.125rem] block min-h-[1.5rem] pl-[1.5rem]">
                                                            <input
                                                                class="border-neutral-300 before:bg-transparent checked:after:bg-transparent checked:focus:after:bg-transparent dark:border-neutral-600 relative float-left -ml-[1.5rem] mr-[6px] mt-[0.15rem] h-[1.125rem] w-[1.125rem] appearance-none rounded-[0.25rem] border-[0.125rem] border-solid outline-none before:pointer-events-none before:absolute before:h-[0.875rem] before:w-[0.875rem] before:scale-0 before:rounded-full before:opacity-0 before:shadow-[0px_0px_0px_13px_transparent] before:content-[''] checked:border-primary checked:bg-primary checked:before:opacity-[0.16] checked:after:absolute checked:after:-mt-px checked:after:ml-[0.25rem] checked:after:block checked:after:h-[0.8125rem] checked:after:w-[0.375rem] checked:after:rotate-45 checked:after:border-[0.125rem] checked:after:border-l-0 checked:after:border-t-0 checked:after:border-solid checked:after:border-white checked:after:content-[''] hover:cursor-pointer hover:before:opacity-[0.04] hover:before:shadow-[0px_0px_0px_13px_rgba(0,0,0,0.6)] focus:shadow-none focus:transition-[border-color_0.2s] focus:before:scale-100 focus:before:opacity-[0.12] focus:before:shadow-[0px_0px_0px_13px_rgba(0,0,0,0.6)] focus:before:transition-[box-shadow_0.2s,transform_0.2s] focus:after:absolute focus:after:z-[1] focus:after:block focus:after:h-[0.875rem] focus:after:w-[0.875rem] focus:after:rounded-[0.125rem] focus:after:content-[''] checked:focus:before:scale-100 checked:focus:before:shadow-[0px_0px_0px_13px_#3b71ca] checked:focus:before:transition-[box-shadow_0.2s,transform_0.2s] checked:focus:after:-mt-px checked:focus:after:ml-[0.25rem] checked:focus:after:h-[0.8125rem] checked:focus:after:w-[0.375rem] checked:focus:after:rotate-45 checked:focus:after:rounded-none checked:focus:after:border-[0.125rem] checked:focus:after:border-l-0 checked:focus:after:border-t-0 checked:focus:after:border-solid checked:focus:after:border-white dark:checked:border-primary dark:checked:bg-primary dark:focus:before:shadow-[0px_0px_0px_13px_rgba(255,255,255,0.4)] dark:checked:focus:before:shadow-[0px_0px_0px_13px_#3b71ca]"
                                                                id="user_id" name="user_ids[]" type="checkbox"
                                                                value="{{ $user->id }}"
                                                                @checked(true) />
                                                            <label
                                                                class="inline-block pl-[0.15rem] hover:cursor-pointer"
                                                                for="user_id">
                                                                {{ $user->name }}
                                                            </label>
                                                        </div>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <x-select-input name="tool_id" headText="Tool">
                                        @foreach ($tools as $tool)
                                            <x-select-input-option :value="$tool->id" :selected="$product->tool_id == $tool->id ? true : false"
                                                :disabled="!$userVisibility">
                                                {{ $tool->name }}
                                            </x-select-input-option>
                                        @endforeach
                                    </x-select-input>
                                </div>
                                {{-- Save Button --}}
                                <div class="flex items-center gap-4">
                                    @if ($userVisibility)
                                        <x-primary-button class="bg-primary-400">
                                            {{ __('Save') }}
                                        </x-primary-button>
                                    @else
                                        <a href="{{ route('accestokens.createAccessToken', ['product' => $product->id]) }}"
                                            wire:navigate>
                                            <x-primary-button type="button">
                                                {{ __('Require access') }}
                                            </x-primary-button>
                                        </a>
                                    @endif
                                </div>
                            </form>
                        </section>
                    </div>
                </div>
            </div>
        </div>
        <div class="py-12">
            <div class="mx-auto max-w-7xl space-y-6 sm:px-6 lg:px-8">
                <div class="bg-white p-4 shadow sm:rounded-lg sm:p-8">
                    <div class="max-w-3xl">
                        <section>
                            <header>
                                <h2 class="text-lg font-medium text-gray-900">
                                    {{ __('Product Evensts') }}
                                </h2>
                                <p class="mt-1 text-sm text-gray-600">
                                    {{ __('Create product event.') }}
                                </p>
                            </header>
                            <form class="mt-6 space-y-6" method="POST" action="{{ route('productlogs.store') }}">
                                @csrf
                                <input id="product_id" name="product_id" type="hidden"
                                    value="{{ $product->id }}">
                                <div class="mb-4">
                                    <x-select-input name="what" headText="Operation type">
                                        <x-select-input-option value="installation">
                                            {{ __('Installation') }}
                                        </x-select-input-option>
                                        <x-select-input-option value="maintenance">
                                            {{ __('Maintenance') }}
                                        </x-select-input-option>
                                    </x-select-input>
                                    <div class="relative mb-3" data-te-input-wrapper-init>
                                        <textarea
                                            class="bg-transparent dark:text-neutral-200 dark:placeholder:text-neutral-200 peer my-4 block min-h-[auto] w-full rounded border-1 border-solid border-gray-200 px-3 py-[0.32rem] leading-[1.6] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 peer-focus:text-primary data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none dark:peer-focus:text-primary [&:not([data-te-input-placeholder-active])]:placeholder:opacity-0"
                                            id="exampleFormControlTextarea1" name="comment" rows="4" placeholder=" {{ __('comment') }}"></textarea>
                                        <label
                                            class="text-neutral-500 dark:text-neutral-200 pointer-events-none absolute left-3 top-0 mb-0 max-w-[90%] origin-[0_0] truncate pt-[0.37rem] leading-[1.6] transition-all duration-200 ease-out peer-focus:-translate-y-[0.9rem] peer-focus:scale-[0.8] peer-focus:text-primary peer-data-[te-input-state-active]:-translate-y-[0.9rem] peer-data-[te-input-state-active]:scale-[0.8] motion-reduce:transition-none dark:peer-focus:text-primary"
                                            for="exampleFormControlTextarea1">
                                            {{ __('comment') }}
                                        </label>
                                    </div>
                                </div>
                                {{-- Save Button --}}
                                <div class="flex items-center gap-4">
                                    <x-primary-button class="bg-primary-400">
                                        {{ __('Create') }}
                                    </x-primary-button>
                                </div>
                            </form>
                        </section>
                    </div>
                </div>
            </div>
        </div>
        <div class="py-12">
            <div class="mx-auto max-w-7xl space-y-6 sm:px-6 lg:px-8">
                <div class="bg-white p-4 shadow sm:rounded-lg sm:p-8">
                    <div class="max-w-3xl">
                        <section>
                            <header>
                                <h2 class="text-lg font-medium text-gray-900">
                                    {{ __('Product history') }}
                                </h2>
                                <p class="mt-1 text-sm text-gray-600">
                                    {{ __('Product history list') }}
                                </p>
                            </header>
                            <div class="mt-6 space-y-6">
                                <table class="w-min-full">
                                    <thead>
                                        <tr>
                                            <x-th-field class="px-2" scope="col">
                                                event
                                            </x-th-field>
                                            <x-th-field class="px-2" scope="col">
                                                event content
                                            </x-th-field>
                                            <x-th-field class="px-2" scope="col">
                                                event time
                                            </x-th-field>
                                        </tr>
                                    </thead>
                                    <tbody class="border-gray-300 even:border-y-1">
                                        @forelse  ($product->product_logs as $log)
                                            <tr>
                                                <x-table-td class="mx-auto px-5 py-4">
                                                    {{ __($log->what) }}
                                                </x-table-td>
                                                <x-table-td class="mx-auto px-5 py-4">
                                                    {{ $log->comment }}
                                                </x-table-td>
                                                <x-table-td class="mx-auto px-5 py-4">
                                                    {{ $product->serializeDate($log->when) }}
                                                </x-table-td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <x-table-td class="mx-auto px-5 py-4">
                                                </x-table-td>
                                                <x-table-td class="mx-auto px-5 py-4">
                                                    {{ __('No product log') }}
                                                </x-table-td>
                                                <x-table-td class="mx-auto px-5 py-4">
                                                </x-table-td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
        @if ($userVisibility)
            <div class="py-12">
                <div class="mx-auto max-w-7xl space-y-6 sm:px-6 lg:px-8">
                    <div class="bg-white p-4 shadow sm:rounded-lg sm:p-8">
                        <div class="max-w-3xl">
                            <section>
                                <header>
                                    <h2 class="text-lg font-medium text-gray-900">
                                        {{ __('Owner Datas') }}
                                    </h2>
                                    <p class="mt-1 text-sm text-gray-600">
                                        {{ __('Owner Datas') }}
                                    </p>
                                </header>

                                <form class="mt-6 space-y-6" method="POST" action="{{ route('partials.store') }}">
                                    @csrf
                                    <input id="product_id" name="product_id" type="hidden"
                                        value="{{ $product->id }}">
                                    <div class="mb-4">
                                        @foreach ($partials as $partial)
                                            @if ($loop->first)
                                                <x-create-input-text name="name" headText="Owner name">
                                                    {{ $partial->name }}
                                                </x-create-input-text>
                                                <x-create-input-text name="email" headText="Email">
                                                    {{ $partial->email }}
                                                </x-create-input-text>
                                                <x-create-input-text name="phone" headText="Mobile">
                                                    {{ $partial->phone }}
                                                </x-create-input-text>
                                            @endif
                                        @endforeach
                                        <div class="basis-full">
                                            <div class="mx-auto max-w-7xl space-y-6 sm:px-6 lg:px-8">
                                                <div class="bg-white p-4 shadow sm:rounded-lg sm:p-8">
                                                    <div class="max-w-3xl">
                                                        <section>
                                                            <header>
                                                                <h2 class="text-lg font-medium text-gray-900">
                                                                    {{ __('Ownership modifications history') }}
                                                                </h2>
                                                                <p class="mt-1 text-sm text-gray-600">
                                                                    {{ __('History of ownership data modifications.') }}
                                                                </p>
                                                            </header>
                                                            <div class="mt-6 space-y-6">
                                                                <table class="w-min-full">
                                                                    <thead class="bg-primary-200">
                                                                        <tr>
                                                                            <x-th-field class="w-1/3" scope="col">
                                                                                name
                                                                            </x-th-field>
                                                                            <x-th-field class="w-1/3" scope="col">
                                                                                email
                                                                            </x-th-field>
                                                                            <x-th-field class="w-1/3" scope="col">
                                                                                mobile
                                                                            </x-th-field>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody class="border-gray-300 even:border-y-1">
                                                                        @foreach ($partials as $partial)
                                                                            @if ($loop->first)
                                                                                @continue
                                                                            @endif
                                                                            <tr>
                                                                                <x-table-td class="w-1/3 py-5">
                                                                                    {{ $partial->name }}
                                                                                </x-table-td>
                                                                                <x-table-td class="w-1/3 py-5">
                                                                                    {{ $partial->email }}
                                                                                </x-table-td>
                                                                                <x-table-td class="w-1/3 py-5">
                                                                                    {{ $partial->phone }}
                                                                                </x-table-td>
                                                                            </tr>
                                                                        @endforeach
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </section>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- Save Button --}}
                                        <button
                                            class="rounded bg-blue-500 px-4 py-2 text-center font-bold text-white hover:bg-blue-700 focus:outline-none sm:inline-block">
                                            {{ __('Update') }}
                                        </button>
                                    </div>
                                </form>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</x-app-layout>
