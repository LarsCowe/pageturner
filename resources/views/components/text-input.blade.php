@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border-stone-700 bg-stone-900 text-stone-100 focus:border-amber-500 focus:ring-amber-500 rounded-md shadow-sm placeholder-stone-500']) }}>
