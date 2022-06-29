<div {{ ((! $attributes->has('override')) || ($attributes->has('override') && ! in_array('class', explode(',', $attributes->get('override'))))) ? $attributes->merge(['class' => 'mb-14']) : $attributes }}
    x-data="{ {{ $type }} : {{ ($open) ? "'open'" : "'close'" }} }"
>
    @if (! empty($head) && $head->isNotEmpty())
    <div class="relative cursor-pointer" x-on:click="{{ $type }} !== 'open' ? {{ $type }} = 'open' : {{ $type }} = 'close'">
        {!! $head !!}

        <x-icon filled class="absolute right-0 top-0 transition-all transform" :icon="$icon" x-bind:class="{{ $type }} === 'open' ? 'rotate-180' : ''" />
    </div>
    @endif

    @if (! empty($body) && $body->isNotEmpty())
    <div class="overflow-hidden transition-transform origin-top-left ease-linear duration-100" 
        x-ref="accordion_{{ $type }}"
        x-bind:class="{{ $type }} == 'open' ? 'h-auto ' : 'scale-y-0 h-0'"
    >
        <div class="grid sm:grid-cols-7 gap-x-8 gap-y-6 my-3.5">
            {!! $body !!}
        </div>
    </div>
    @endif

    @if (! empty($foot) && $foot->isNotEmpty())
        {!! $foot !!}
    @endif
</div>
