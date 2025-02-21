@props(['align' => 'right', 'width' => '48', 'contentClasses' => 'py-1 bg-gray-200'])

@php
$alignmentClasses = match ($align) {
    'left' => 'ltr:origin-top-left rtl:origin-top-right start-0',
    'top' => 'origin-top',
    default => 'ltr:origin-top-right rtl:origin-top-left end-0',
};

$width = match ($width) {
    '48' => 'w-48',
    default => $width,
};
@endphp

<div class="relative" x-data="{ open: false }" @click.outside="open = false" @close.stop="open = false">
    <div @click="open = ! open">
        {{ $trigger }}
    </div>

    <div x-show="open"
            class="absolute z-50 mt-2 {{ $width }} rounded-md border-2 border-gray-400 bg-gray-200 {{ $alignmentClasses }}"
            style="display: none;"
            @click="open = false">
        <div class="rounded-md {{ $contentClasses }}">
            {{ $content }}
        </div>
    </div>
</div>
