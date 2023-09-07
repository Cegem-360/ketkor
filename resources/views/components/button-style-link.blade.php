@props(['route' => 'index', 'text' => ''])
<div class="mb-4 flex items-center justify-between font-bold">
    <div class="basis-auto">
        <h1 class="mx-4 px-20 text-primary">{{ __($text) }}</h1>
    </div>
    <div class="basis-auto">
        <a wire:navigate
            {{ $attributes->merge(['class' => 'grow focus:shadow-outline rounded bg-primary px-4 py-2 text-center font-bold text-white hover:bg-blue-700 focus:outline-none']) }}
            href="{{ route($route) }}">
            {{ __($slot->__toString()) }}
        </a>
    </div>
</div>
