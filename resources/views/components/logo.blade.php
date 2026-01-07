@props(['class' => '', 'size' => 'md'])

@php
    $sizes = [
        'sm' => 'text-xl',
        'md' => 'text-2xl',
        'lg' => 'text-3xl',
        'xl' => 'text-4xl',
    ];
    $textSize = $sizes[$size] ?? $sizes['md'];
    $iconSizes = [
        'sm' => 'w-5 h-5',
        'md' => 'w-7 h-7',
        'lg' => 'w-8 h-8',
        'xl' => 'w-10 h-10',
    ];
    $iconSize = $iconSizes[$size] ?? $iconSizes['md'];
@endphp

<a href="{{ route('home') }}" {{ $attributes->merge(['class' => "flex items-center gap-2 font-bold {$textSize} {$class}"]) }}>
    {{-- Book Icon SVG --}}
    <svg class="{{ $iconSize }} text-amber-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
        <path d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" stroke="currentColor" stroke-width="1.5" fill="none" stroke-linecap="round" stroke-linejoin="round"/>
    </svg>
    <span class="text-amber-500">
        PageTurner
    </span>
</a>
