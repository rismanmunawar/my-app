@props([
    'label' => null,
    'type' => 'text',
    'placeholder' => '',
    'disabled' => false,
    'viewable' => false,
])

<div class="form-control w-full">
    @if ($label)
        <label class="label mb-1">
            <span class="label-text text-black !text-black">{{ $label }}</span>
        </label>
    @endif

    <input type="{{ $type }}" placeholder="{{ $placeholder }}" {{ $disabled ? 'disabled' : '' }}
        {!! $attributes->merge([
            'class' => 'input input-bordered w-full bg-white text-black placeholder-gray-500 border-gray-300
                         focus:border-primary-500 focus:ring-primary-500
                         disabled:bg-gray-100 disabled:text-gray-400',
        ]) !!}>
</div>
