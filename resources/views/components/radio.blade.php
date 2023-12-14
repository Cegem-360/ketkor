@props(['name' => '', 'headText' => '', 'required' => true, 'product' => null])
@php
    $options = explode(',', $slot);
@endphp
<div class="basis-full">
    <div class="col-span-full">
        <label class="my-5 block text-left text-lg font-medium leading-6 text-gray-900" for="{{ $name }}">
            @if ($required)
                <span style="color:red;">*</span>
            @endif
            {{ __($headText) }}
        </label>
        <div class="mt-2">
            @foreach ($options as $option)
                <div
                    class="flex rounded-md shadow-sm focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                    {{ __($option) }}
                    @php
                        $option = strtolower($option);
                        if ($option == 'false') {
                            $option = false;
                        }
                        if ($option == 'true') {
                            $option = true;
                        }
                    @endphp
                    <input
                        class="@error($name) border-l-danger-600 @enderror block rounded border-0 p-2 py-1.5 text-2xl text-gray-900 shadow ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                        id="{{ __($name) }}" name="{{ $name }}" type="radio" value="{{ (int) $option }}"
                        {!! $attributes->merge(['class' => '']) !!}
                        @isset($product)
                       @if ($option == (bool) $product->access_to_wifi) checked @endif @endisset>

                </div>
            @endforeach
        </div>
    </div>
    @error($name)
        <span class="text-danger">{{ $message }}</span>
    @enderror
</div>
