@props(['align' => 'right', 'width' => '48', 'contentClasses' => 'py-1 bg-white'])

@php
$alignmentClasses = match ($align) {
    'left' => 'start-0',
    'top' => 'top-0',
    default => 'end-0',
};

$dropdownWidth = match ($width) {
    '48' => 'w-48',
    default => $width,
};
@endphp

<div class="dropdown">
    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
        {{ $trigger }}
    </button>
    <ul class="dropdown-menu {{ $alignmentClasses }} {{ $dropdownWidth }} {{ $contentClasses }}" aria-labelledby="dropdownMenuButton">
        {{ $content }}
    </ul>
</div>
